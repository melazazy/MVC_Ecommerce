<?php
// app/models/Cart.php

class Cart
{
    private $DB;

    public function __construct()
    {
        $this->DB = new Database;
    }
    public function addToCart($user_id, $product_id)
    {
        try {
            // Check if the product is already in the cart
            $existingProduct = $this->getCartItem($user_id, $product_id);

            if ($existingProduct) {
                // Product is already in the cart, update the quantity
                $newQuantity = $existingProduct->quantity + 1;
                return $this->updateQuantity($user_id, $product_id, $newQuantity);
            } else {
                // Product is not in the cart, add it
                return $this->addProductToCart($user_id, $product_id);
            }
        } catch (PDOException $e) {
            error_log("Add to cart failed: " . $e->getMessage());
            return false; // Add to cart failed
        }
    }

    public function getCartItems($user_id)
    {
        // Get the cart item for a specific user and product
        $query = "SELECT c.product_id, c.cart_id, p.name, p.price, SUBSTRING(p.description, 1, 125) AS description,p.image_url, c.quantity FROM cart c JOIN products p ON c.product_id = p.product_id WHERE c.user_id = :user_id;";
        $data = [
            ':user_id' => $user_id,
        ];

        $result = $this->DB->read($query, $data);

        return ($result) ? $result : null;
    }
    private function getCartItem($user_id, $product_id)
    {
        // Get the cart item for a specific user and product
        $query = "SELECT * FROM cart WHERE user_id = :user_id AND product_id = :product_id";
        $data = [
            ':user_id' => $user_id,
            ':product_id' => $product_id,
        ];

        $result = $this->DB->read($query, $data);

        return ($result) ? $result[0] : null;
    }

    private function addProductToCart($user_id, $product_id)
    {
        // Add a new product to the cart
        $query = "INSERT INTO cart (user_id, product_id, quantity) VALUES (:user_id, :product_id, 1)";
        $data = [
            ':user_id' => $user_id,
            ':product_id' => $product_id,
        ];

        return $this->DB->write($query, $data);
    }
    public function updateQuantity($user_id, $product_id, $newQuantity)
    {
        try {
            // Update the quantity in the cart
            $query = "UPDATE cart SET quantity = :newQuantity WHERE user_id = :user_id AND product_id = :product_id";
            $data = [
                ':newQuantity' => $newQuantity,
                ':user_id' => $user_id,
                ':product_id' => $product_id,
            ];

            return $this->DB->write($query, $data);
        } catch (PDOException $e) {
            error_log("Update quantity failed: " . $e->getMessage());
            return false; // Update failed
        }
    }
    function getCartQuantity($user_id)
    {
        $DB = new Database;
        // Get the count of cart item for a specific user 
        $query = "SELECT COUNT(*) AS cartcount FROM cart WHERE user_id = :user_id";
        $data = [
            ':user_id' => $user_id,
        ];

        $result = $DB->read($query, $data);

        return ($result[0]->cartcount > 0) ? $result[0]->cartcount : 0;
    }
    public function removeFromCart($user_id, $product_id)
    {
        try {
            // Check if the product is in the cart
            $existingProduct = $this->getCartItem($user_id, $product_id);

            if ($existingProduct) {
                // Product is in the cart, remove it
                return $this->removeProductFromCart($user_id, $product_id);
            } else {
                // Product is not in the cart
                return false;
            }
        } catch (PDOException $e) {
            error_log("Remove from cart failed: " . $e->getMessage());
            return false; // Remove from cart failed
        }
    }

    public function removeProductFromCart($user_id, $product_id)
    {
        // Remove the product from the cart
        $query = "DELETE FROM cart WHERE user_id = :user_id AND product_id = :product_id";
        $data = [
            ':user_id' => $user_id,
            ':product_id' => $product_id,
        ];

        return $this->DB->write($query, $data);
    }
    public function calculatesubTotal($user_id)
    {
        // Calculate the total price of items in the cart for a specific user
        $query = "SELECT SUM(p.price * c.quantity) AS total_price
                FROM cart c
                JOIN products p ON c.product_id = p.product_id
                WHERE c.user_id = :user_id";
        $data = [
            ':user_id' => $user_id,
        ];

        $result = $this->DB->read($query, $data);

        return ($result && isset($result[0]->total_price)) ? $result[0]->total_price : 0;
    }

    public function calculateDiscount($user_id)
    {
        // Calculate the discount for all products in the user cart 
        $query = "SELECT c.user_id,c.product_id,c.quantity,d.discount_value 
        FROM cart c JOIN discounted_products dp ON c.product_id = dp.product_id 
                    JOIN discounts d ON dp.discount_id = d.discount_id 
                    WHERE c.user_id = :user_id;";
        $data = [
            ':user_id' => $user_id,
        ];

        $result = $this->DB->read($query, $data);
        // Assuming you have fetched the results into an array called $discounts
        $totalDiscount = 0;

        foreach ($result as $discount) {
            $totalDiscount += $discount->discount_value * $discount->quantity;
        }
        return $totalDiscount;
    }
    public function calculateShippingCost($shippingOptionId)
    {
        return 20;
    }
    public function getUserAdresses($user_id)
    {
        // Calculate the total price of items in the cart for a specific user
        $query = "SELECT * FROM shipping_addresses
        WHERE user_id = :user_id;";
        $data = [
            ':user_id' => $user_id,
        ];

        return  $this->DB->read($query, $data);
    }
    public function printUserAdresses($user_id)
    {
        $query = "SELECT * FROM shipping_addresses WHERE user_id = :user_id;";
        $data['user_id'] = $user_id;

        $addresses = $this->DB->read($query, $data);
        if (count($addresses) > 0) {
            echo "<select>";
            echo "<option value=''>Select a shipping address</option>";
            foreach ($addresses as $address) {
                echo '<option value="' . $address->address_id . '">' . $address->country . ',' . $address->city . '</option>';
            }
            echo "</select>";
            exit;
        } else {
            show($addresses);
            echo 'userid: ' . $user_id;
            echo 'Enter new Adress';
            exit;
        }
    }
}
