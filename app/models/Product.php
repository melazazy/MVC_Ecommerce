<?php
// app/models/Product.php

// models/ProductModel.php
class Product
{
    private $DB;
    private $product_id = [];

    public function __construct()
    {
        // Initialize your database connection here or inject it via constructor
        $this->DB = new Database();
    }
    public function getProductDetails($id)
    {
        $this->product_id['id'] = $id;
        $q = "SELECT p.product_id, p.name,p.image_url, p.description AS product_description,s.size_char,c.color_name,p.price,b.name AS Brand_name,pi.image_url AS Pimage_url,
        GROUP_CONCAT(pi_all.image_url) AS all_images,
        AVG(pr.rating) AS average_rating,(
        SELECT GROUP_CONCAT(review)
        FROM productRatings AS pr_comment
        WHERE pr_comment.product_id = p.product_id
        ORDER BY pr.created_at DESC) AS comments,(SELECT COUNT(*)
        FROM productRatings AS pr_count
        WHERE pr_count.product_id = p.product_id) AS review_count FROM products AS p
        LEFT JOIN product_details AS pd ON p.product_id = pd.product_id
        LEFT JOIN sizes AS s ON pd.size_id = s.size_id
        LEFT JOIN colors AS c ON pd.color_id = c.color_id
        LEFT JOIN brands AS b ON pd.brand_id = b.brand_id
        LEFT JOIN productImages AS pi ON p.product_id = pi.product_id AND pi.is_primary = true
        LEFT JOIN productImages AS pi_all ON p.product_id = pi_all.product_id
        LEFT JOIN productRatings AS pr ON p.product_id = pr.product_id
        WHERE p.product_id =:id
        GROUP BY p.product_id, p.name, p.image_url, product_description, s.size_char, c.color_name, p.price, b.name, pi.image_url";
        return $this->DB->read($q, $this->product_id);
    }

    public function getAllProducts()
    {
        $q = "SELECT * FROM products";
        return $this->DB->read($q);
    }
    public function getAllProductsDetails()
    {
        $query = "SELECT p.product_id,p.name,p.image_url ,p.description AS product_description,
        IFNULL(GROUP_CONCAT(DISTINCT s.size_char ORDER BY s.size_char ASC),'') AS size_chars,
        IFNULL(GROUP_CONCAT(DISTINCT c.color_name ORDER BY c.color_name ASC),'') AS color_names,
        p.price,b.name AS Brand_name,
        IFNULL(AVG(pr.rating), 0) AS average_rating
        FROM products AS p
        LEFT JOIN product_details AS pd ON p.product_id = pd.product_id
        LEFT JOIN sizes AS s ON pd.size_id = s.size_id
        LEFT JOIN colors AS c ON pd.color_id = c.color_id
        LEFT JOIN brands AS b ON pd.brand_id = b.brand_id
        LEFT JOIN productRatings AS pr ON p.product_id = pr.product_id
        GROUP BY p.product_id;";
        $products =  $this->DB->read($query);
        if ($products) {
            foreach ($products as &$product) {
                $product->color_names = explode(',', $product->color_names);
            }
        }
        // return $this->DB->read($q);
        return $products;
    }
    public function getAllProductsRelated1($id)
    {
        $this->product_id['id'] = $id;
        // -- Assuming $specialProductId contains the ID of the special product
        $query = " SELECT p.product_id, p.name, p.image_url, p.description AS product_description,
                    IFNULL(GROUP_CONCAT(DISTINCT s.size_char ORDER BY s.size_char ASC), '') AS size_chars,
                    IFNULL(GROUP_CONCAT(DISTINCT c.color_name ORDER BY c.color_name ASC), '') AS color_names,
                    p.price, b.name AS Brand_name
                FROM products AS p
                LEFT JOIN product_details AS pd ON p.product_id = pd.product_id
                LEFT JOIN sizes AS s ON pd.size_id = s.size_id
                LEFT JOIN colors AS c ON pd.color_id = c.color_id
                LEFT JOIN brands AS b ON pd.brand_id = b.brand_id
                WHERE p.product_id != :id
                    AND (pd.brand_id = (SELECT brand_id FROM product_details WHERE product_id = :id)
                        OR p.category_id = (SELECT category_id FROM products WHERE product_id = :id))
                GROUP BY p.product_id;
            ";

        $products =  $this->DB->read($query, $this->product_id);
        return $products;
    }
    public function getAllProductsRelated($id)
    {
        $this->product_id['id'] = $id;
        $query = " SELECT
                p.product_id,
                p.name,
                p.image_url,
                p.description AS product_description,
                -- IFNULL(GROUP_CONCAT(DISTINCT s.size_char ORDER BY s.size_char ASC), '') AS size_chars,
                -- IFNULL(GROUP_CONCAT(DISTINCT c.color_name ORDER BY c.color_name ASC), '') AS color_names,
                GROUP_CONCAT(DISTINCT s.size_char ORDER BY s.size_char ASC) AS size_chars,
                GROUP_CONCAT(DISTINCT c.color_name ORDER BY c.color_name ASC) AS color_names,
                p.price,
                b.name AS Brand_name,
                AVG(pr.rating) AS average_rating
            FROM
                products AS p
                LEFT JOIN product_details AS pd ON p.product_id = pd.product_id
                LEFT JOIN sizes AS s ON pd.size_id = s.size_id
                LEFT JOIN colors AS c ON pd.color_id = c.color_id
                LEFT JOIN brands AS b ON pd.brand_id = b.brand_id
                LEFT JOIN ProductRatings AS pr ON p.product_id = pr.product_id
            WHERE
                p.product_id != :id
                AND (pd.brand_id = (SELECT brand_id FROM product_details WHERE product_id = :id)
                    OR p.category_id = (SELECT category_id FROM products WHERE product_id = :id))
            GROUP BY
                p.product_id;";


        $products =  $this->DB->read($query, $this->product_id);
        return $products;
        // return "products";
    }
    public function getAllProductsWithCat($cat = 0, $gender = null)
    {
        $cat_id = (int)($cat);
        $query = "SELECT p.product_id,p.name,p.image_url ,p.description AS product_description,
        IFNULL(GROUP_CONCAT(DISTINCT s.size_char ORDER BY s.size_char ASC),'') AS size_chars,
        IFNULL(GROUP_CONCAT(DISTINCT c.color_name ORDER BY c.color_name ASC),'') AS color_names,
        p.price,b.name AS Brand_name
        FROM Products AS p
        LEFT JOIN product_details AS pd ON p.product_id = pd.product_id
        LEFT JOIN sizes AS s ON pd.size_id = s.size_id
        LEFT JOIN colors AS c ON pd.color_id = c.color_id
        LEFT JOIN brands AS b ON pd.brand_id = b.brand_id";

        if (!is_null($cat)) {
            $query .= " WHERE p.category_id=:cat_id";
            $params['cat_id'] = $cat_id;
        }
        if (!is_null($gender) && !is_null($cat)) {
            $query .= " AND pd.gender = :gender";
            $params['gender'] = $gender;
        } elseif (!is_null($gender) && is_null($cat)) {
            $query .= " WHERE pd.gender = :gender";
            $params['gender'] = $gender;
        }

        $query .= " GROUP BY p.product_id";
        $products =  $this->DB->read($query, $params);
        if ($products) {
            foreach ($products as &$product) {
                $product->color_names = explode(',', $product->color_names);
            }
        }
        return $products;
    }
    public function getAllProductsWithTag($tag = '')
    {
        $tag_name = (string)($tag);
        $query = "SELECT p.product_id,p.name,p.image_url ,p.description AS product_description,
        IFNULL(GROUP_CONCAT(DISTINCT s.size_char ORDER BY s.size_char ASC),'') AS size_chars,
        IFNULL(GROUP_CONCAT(DISTINCT c.color_name ORDER BY c.color_name ASC),'') AS color_names,
        p.price,b.name AS Brand_name
        FROM products AS p
        LEFT JOIN product_details AS pd ON p.product_id = pd.product_id
        LEFT JOIN sizes AS s ON pd.size_id = s.size_id
        LEFT JOIN colors AS c ON pd.color_id = c.color_id
        LEFT JOIN ProductTags AS pt ON p.product_id = pt.product_id
        LEFT JOIN brands AS b ON pd.brand_id = b.brand_id";

        if (!is_null($tag_name)) {
            $query .= " WHERE pt.tag_name=:tag_name";
            $params['tag_name'] = $tag_name;
        }

        $query .= " GROUP BY p.product_id";
        $products =  $this->DB->read($query, $params);
        if ($products) {
            foreach ($products as &$product) {
                $product->color_names = explode(',', $product->color_names);
            }
        }
        return $products;
    }
    public function get3FeaturedProducts()
    {
        $q = "SELECT p.*, AVG(pr.rating) AS average_rating,COUNT(pr.rating) AS review_count FROM products AS p LEFT JOIN productRatings AS pr ON p.product_id = pr.product_id where featured =1 GROUP BY p.product_id  LIMIT 3";
        return $this->DB->read($q);
    }

    public function addProduct($cat, $productName, $description, $price, $targetFile, $stock, $featured)
    {
        $data['cat'] = $cat;
        $data['productName'] = $productName;
        $data['description'] = $description;
        $data['price'] = $price;
        $data['targetFile'] = $targetFile;
        $data['stock'] = $stock;
        $data['featured'] = $featured;

        $query = 'INSERT INTO products (category_id, name, description, price, image_url, stock, featured)
            VALUES (:cat, :productName, :description, :price, :targetFile, :stock, :featured)';

        try {
            return $this->DB->write($query, $data);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
    public function checkIdExists($id)
    {
        try {
            // Prepare a SQL query to check if the ID exists in the database
            $query = "SELECT COUNT(*) AS count FROM products WHERE product_id = :id";
            $data = [':id' => $id];

            // Execute the query using your read function
            $result = $this->DB->read($query, $data);

            // Check the count
            if ($result && isset($result[0]->count) && $result[0]->count > 0) {
                // ID exists in the database
                return true;
            } else {
                // ID does not exist in the database
                return false;
            }
        } catch (PDOException $e) {
            // Handle exceptions if necessary
            error_log($e->getMessage());
            return false;
        }
    }
}
