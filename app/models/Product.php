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
        $q = "SELECT p.name,p.image_url ,p.description AS product_description,s.size_char,c.color_name,p.price,b.name AS Brand_name
        FROM products AS p
        LEFT JOIN product_details AS pd ON p.product_id = pd.product_id
        LEFT JOIN sizes AS s ON pd.size_id = s.size_id
        LEFT JOIN colors AS c ON pd.color_id = c.color_id
        LEFT JOIN brands AS b ON pd.brand_id = b.brand_id
        WHERE p.product_id = :id;";
        return $this->DB->read($q, $this->product_id);
    }
    public function getAllProducts()
    {
        $q = "SELECT * FROM Products";
        return $this->DB->read($q);
    }
    public function getAllProductsDetails()
    {
        $query = "SELECT p.product_id,p.name,p.image_url ,p.description AS product_description,
        IFNULL(GROUP_CONCAT(DISTINCT s.size_char ORDER BY s.size_char ASC),'') AS size_chars,
        IFNULL(GROUP_CONCAT(DISTINCT c.color_name ORDER BY c.color_name ASC),'') AS color_names,
        p.price,b.name AS Brand_name
        FROM products AS p
        LEFT JOIN product_details AS pd ON p.product_id = pd.product_id
        LEFT JOIN sizes AS s ON pd.size_id = s.size_id
        LEFT JOIN colors AS c ON pd.color_id = c.color_id
        LEFT JOIN brands AS b ON pd.brand_id = b.brand_id
        GROUP BY p.product_id;";
        $products =  $this->DB->read($query);
        if ($products) {
            foreach ($products as &$product) {
                // Split and format sizes
                // $product->size_chars = implode(' / ', explode(',', $product->size_chars));

                // Split and format colors
                // $product->color_names = implode(',', explode(',', $product->color_names));
                $product->color_names = explode(',', $product->color_names);
            }
        }
        // return $this->DB->read($q);
        return $products;
    }
    public function getAllProductsWithCat($cat = 0, $gender = null)
    {
        $cat_id = (int)($cat);
        $query = "SELECT p.product_id,p.name,p.image_url ,p.description AS product_description,
        IFNULL(GROUP_CONCAT(DISTINCT s.size_char ORDER BY s.size_char ASC),'') AS size_chars,
        IFNULL(GROUP_CONCAT(DISTINCT c.color_name ORDER BY c.color_name ASC),'') AS color_names,
        p.price,b.name AS Brand_name
        FROM products AS p
        LEFT JOIN product_details AS pd ON p.product_id = pd.product_id
        LEFT JOIN sizes AS s ON pd.size_id = s.size_id
        LEFT JOIN colors AS c ON pd.color_id = c.color_id
        LEFT JOIN brands AS b ON pd.brand_id = b.brand_id";
        // GROUP BY p.product_id;
        // $params['cat_id'] = $cat_id;

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
        // show($query);
        // die();
        $products =  $this->DB->read($query, $params);
        if ($products) {
            foreach ($products as &$product) {
                // Split and format sizes
                // $product->size_chars = implode(' / ', explode(',', $product->size_chars));

                // Split and format colors
                // $product->color_names = implode(',', explode(',', $product->color_names));
                $product->color_names = explode(',', $product->color_names);
            }
        }
        // return $this->DB->read($q);
        return $products;
    }
    public function get3Products()
    {
        $q = "SELECT * FROM Products where featured =1 LIMIT 3";
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
}
