<?php
// app/models/wishlist.php

class Wishlist
{
    private $DB;

    public function __construct()
    {
        $this->DB = new Database;
    }
    public function addToList($user_id, $product_id)
    {
        try {
            // Check if the product is already in the wishlist
            $existingProduct = $this->getListItem($user_id, $product_id);

            if ($existingProduct) {
                // Product is already in the wishlist, Remove it
                return $this->removeListItem($user_id, $product_id);
            } else {
                // Product is not in the wishlist, add it
                return $this->addProductToList($user_id, $product_id);
            }
        } catch (PDOException $e) {
            error_log("Add to wishlist failed: " . $e->getMessage());
            return false; // Add to wishlist failed
        }
    }

    public function getList($user_id)
    {
        // Get the wishlist item for a specific user 
        $query = "SELECT w.*,p.image_url, p.name FROM wishlist AS w join products AS p ON w.product_id = p.product_id WHERE user_id = :user_id";
        $data = [
            ':user_id' => $user_id,
        ];

        $result = $this->DB->read($query, $data);

        return ($result) ? $result : null;
    }
    private function getListItem($user_id, $product_id)
    {
        // Get the wishlist item for a specific user and product
        $query = "SELECT * FROM wishlist WHERE user_id = :user_id AND product_id = :product_id";
        $data = [
            ':user_id' => $user_id,
            ':product_id' => $product_id,
        ];

        $result = $this->DB->read($query, $data);

        return ($result) ? $result[0] : null;
    }

    private function addProductToList($user_id, $product_id)
    {
        // Add a new product to the wishlist
        $query = "INSERT INTO wishlist (user_id, product_id) VALUES (:user_id, :product_id)";
        $data = [
            ':user_id' => $user_id,
            ':product_id' => $product_id,
        ];

        return $this->DB->write($query, $data);
    }
    public function removeListItem($user_id, $product_id)
    {
        try {
            // Update the quantity in the wishlist
            $query = "DELETE FROM wishlist WHERE user_id = :user_id AND product_id = :product_id";
            $data = [
                ':user_id' => $user_id,
                ':product_id' => $product_id,
            ];

            return $this->DB->write($query, $data);
        } catch (PDOException $e) {
            error_log("Update quantity failed: " . $e->getMessage());
            return false; // Update failed
        }
    }

    function getListQuantity($user_id)
    {
        // Get the count of wishlist item for a specific user 
        $query = "SELECT COUNT(*) AS wishlistcount FROM wishlist WHERE user_id = :user_id";
        $data = [
            ':user_id' => $user_id,
        ];

        $result = $this->DB->read($query, $data);

        return ($result[0]->wishlistcount > 0) ? $result[0]->wishlistcount : 0;
    }
    // Additional methods for database interactions (e.g., save, fetch) would be added here
}
