<?php
// app/controllers/ProductController.php

class ProductController extends Controller
{
    private $db;
    public function viewProduct($productId)
    {
        // Handle viewing a product logic here
    }
    public function searchProducts($searchQuery)
    {
        // Sanitize and construct the SQL query
        $searchQuery = $this->db->real_escape_string($searchQuery);
        $sql = "SELECT * FROM products WHERE name LIKE '%$searchQuery%'";

        // Execute the query
        $result = $this->db->query($sql);

        // Process the result and return data
        $products = [];
        while ($row = $result->fetch_assoc()) {
            $products[] = $row;
        }
        return $products;
    }
    public function addToWishlist($id)
    {
        // Check if the user is logged in and has a session
        if (isset($_SESSION['user_id'])) {
            $userId = $_SESSION['user_id'];
            $productId = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);

            // Validate product ID and check if it exists in the products table

            // Check if the product is already in the user's wishlist

            // If not, insert the product into the wishlist table

            // Redirect to the product page or wishlist page
        } else {
            // Redirect to the login page or display a message
        }
    }
    public function removeFromWishlist($id)
    {
        // Check if the user is logged in and has a session
        if (isset($_SESSION['user_id'])) {
            $userId = $_SESSION['user_id'];
            $productId = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);

            // Validate product ID and check if it exists in the products table

            // Check if the product is already in the user's wishlist

            // If not, insert the product into the wishlist table

            // Redirect to the product page or wishlist page
        } else {
            // Redirect to the login page or display a message
        }
    }

    public function viewWishlist()
    {
        // Retrieve wishlist items for the logged-in user from the database

        // Pass wishlist data to the view
    }
    public function editProduct($id)
    {
        // Retrieve wishlist items for the logged-in user from the database

        // Pass wishlist data to the view
        show($id);
    }
}
