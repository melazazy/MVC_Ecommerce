<?php
// app/models/Cart.php

class Address
{
    private $DB;

    public function __construct()
    {
        $this->DB = new Database;
    }
    public function addAddress($recipientName, $country, $city, $state, $postalCode, $addressLine1, $addressLine2 = '')
    {
        $user_id = $_SESSION['user_id'];  // Retrieve and sanitize form data
        try {
            // Insert data into the database
            $sql = "INSERT INTO shipping_addresses (user_id, recipient_name, address_line1, address_line2, city, state, postal_code, country) 
        VALUES (:user_id, :recipient_name, :address_line1, :address_line2, :city, :state, :postal_code, :country)";

            $data = [
                ':user_id' => $user_id,
                ':recipient_name' => $recipientName,
                ':address_line1' => $addressLine1,
                ':address_line2' => $addressLine2,
                ':city' => $city,
                ':state' => $state,
                ':postal_code' => $postalCode,
                ':country' => $country
            ];
            return $this->DB->write($sql, $data);
        } catch (PDOException $e) {
            error_log("Add to Address failed: " . $e->getMessage());
            return false; // Add to cart failed
        }
        return "Address: ";
    }
}
