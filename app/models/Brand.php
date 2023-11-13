<?php
// app/models/Category.php

class Brand
{
    private $DB;
    public function __construct()
    {
        $this->DB = new Database;
    }

    // Method to retrieve a list of all categories from the database
    public function getAllBrands()
    {
        $query = "SELECT * FROM brands";
        return $this->DB->read($query);
    }
    // public function get3Categories()
    // {
    //     $query = "SELECT * FROM categories LIMIT 3";
    //     return $this->DB->read($query);
    // }
    // // Method to add a new category to the database
    // public function addCategory($name, $description, $targetFile)
    // {
    //     $items['name'] = $name;
    //     $items['description'] = $description;
    //     $items['targetFile'] = $targetFile;
    //     $addq = "INSERT INTO Categories (name, description, image) VALUES (:name,:description,:targetFile)";
    //     return $this->DB->write($addq, $items);
    // }

    // Additional methods for database interactions (e.g., save, fetch) would be added here
}
