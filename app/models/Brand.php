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
}
