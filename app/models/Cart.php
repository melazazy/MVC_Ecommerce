<?php
// app/models/Cart.php

class Cart
{
    private $id;
    private $userId;
    private $productId;
    private $quantity;
    private $DB;

    public function __construct()
    {
        $this->DB = new Database;
    }

    public function addToCart($user_id, $product_id)
    {
        // Your logic to add the product to the cart
        echo 'Added to Cart: user_id=' . $user_id . ', product_id=' . $product_id;
    }
    public function getId()
    {
        return $this->id;
    }

    public function getUserId()
    {
        return $this->userId;
    }

    public function setUserId($userId)
    {
        $this->userId = $userId;
    }

    public function getProductId()
    {
        return $this->productId;
    }

    public function setProductId($productId)
    {
        $this->productId = $productId;
    }

    public function getQuantity()
    {
        return $this->quantity;
    }

    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
    }

    // Additional methods for database interactions (e.g., save, fetch) would be added here
}
