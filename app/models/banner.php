<?php
// app/models/Category.php

class Banner
{
    private $DB;
    public function __construct()
    {
        $this->DB = new Database;
    }

    // Method to retrieve a list of all categories from the database
    public function getAllBanners()
    {
        $query = "SELECT banner_products.*, products.* FROM banner_products
        INNER JOIN products ON banner_products.product_id = products.product_id;";
        return $this->DB->read($query);
    }
    public function get3Banners()
    {
        $query = "SELECT banner_products.*, Products.* FROM banner_products
        INNER JOIN Products ON banner_products.product_id = Products.product_id limit 3;";
        return $this->DB->read($query);
    }
    // Method to add a new category to the database
    public function addBanner($product_id, $header, $title)
    {
        $items['product_id'] = $product_id;
        $items['header'] = $header;
        $items['title'] = $title;
        $addB = "INSERT INTO banner_products (product_id, header, title) VALUES (:product_id,:header,:title)";
        try {
            return $this->DB->write($addB, $items);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    // Additional methods for database interactions (e.g., save, fetch) would be added here
}
