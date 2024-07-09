<?php
// app/models/Category.php

class Tag
{
    private $DB;
    public function __construct()
    {
        $this->DB = new Database;
    }

    // Method to retrieve a list of all Tags from the database
    public function getAllTags()
    {
        // $query = "SELECT * FROM ProductTags";
        $query = "SELECT DISTINCT tag_name FROM productTags ORDER BY tag_name ASC";
        return $this->DB->read($query);
    }
}
