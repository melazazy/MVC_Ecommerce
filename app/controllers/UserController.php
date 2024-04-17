<?php
// app/controllers/UserController.php

// Initialize an empty cart array if it doesn't exist in the session
if (!isset($_SESSION['cart'])) {
    // $sql = "SELECT product_id, quantity FROM cart WHERE user_id = :user_id";
    $DB = new Database;
    $sql = "SELECT product_id, quantity FROM cart WHERE user_id = 3";
    $cart = $DB->read($sql);
    $_SESSION['cart'] = $cart;
}
class UserController extends Controller
{
    public function total($as, $table)
    {
        $DB = new Database;
        $id = $_SESSION['user_id'];
        $d['id'] = $id;
        $query = 'SELECT COUNT(*) as ' . $as . ' FROM ' . $table . ' WHERE user_id = :id;';
        $totals = $DB->read($query, $d);
        return $totals;
    }
    public function profile()
    {
        if (isset($_SESSION['role'])) {
            if ($_SESSION['role'] == 'user') {
                $DB = new Database;
                $id = $_SESSION['user_id'];
                $par['id'] = $id;
                // $query = 'SELECT * FROM `Orders` WHERE user_id = :id';
                $qorders = 'SELECT o.order_id,o.status,o.order_date,COUNT(oi.product_id) AS product_count,pm.name AS PayType,p.transaction_id
             FROM orders AS o JOIN order_items AS oi ON o.order_id = oi.order_id 
             LEFT JOIN Payments AS p ON o.order_id = p.order_id 
             LEFT JOIN PaymentMethods AS pm ON p.method_id = pm.method_id
             WHERE o.user_id = :id GROUP BY o.order_id, o.order_date, p.payment_id;';
                // $qorders = 'SELECT o.order_id,o.status,o.order_date,COUNT(oi.product_id) AS product_count FROM orders AS o JOIN order_items AS oi ON o.order_id = oi.order_id WHERE o.user_id = :id GROUP BY o.order_id, o.order_date;';
                $quser = 'SELECT * FROM `users` WHERE user_id = :id';
                $qcount = 'SELECT COUNT(*) as order_count FROM orders WHERE user_id = :id;';
                $orders = $DB->read($qorders, $par);

                $orderscount = $this->total('order_count', 'orders');
                $cartcount = $this->total('cart_count', 'cart');
                $wishcount = $this->total('wish_count', 'wishlist');
                $user = $DB->read($quser, $par);

                $data['title'] = 'Profile';
                $data['orders'] = $orders;
                $data['user'] = $user;
                $data['orderscount'] = $orderscount[0]->order_count;
                $data['cartcount'] = $cartcount[0]->cart_count;
                $data['wishcount'] = $wishcount[0]->wish_count;
                $this->view("../user/profile", $data);
            } else {

                header("Location:" . ROOT . "AdminController/dashboard");
            }
        } else {
            header("Location:" . ROOT . "index");
        }
    }

    public function shoppingCart()
    {
        // Handle shopping cart logic here
    }
    public function cartItems()
    {
        // Handle shopping cart Items
        $items = count($_SESSION['cart']);
        return $items;
    }

    // Add an item to the cart
    public function addToCart($productId, $productName, $productPrice)
    {
        $item = [
            'id' => $productId,
            'name' => $productName,
            'price' => $productPrice,
            'quantity' => 1,
        ];

        // Check if the item is already in the cart
        foreach ($_SESSION['cart'] as &$cartItem) {
            if ($cartItem['id'] === $productId) {
                $cartItem['quantity']++;
                return;
            }
        }

        // If not, add it to the cart
        $_SESSION['cart'][] = $item;
    }

    // Remove an item from the cart
    public function removeFromCart($productId)
    {
        foreach ($_SESSION['cart'] as $key => $cartItem) {
            if ($cartItem['id'] === $productId) {
                unset($_SESSION['cart'][$key]);
                return;
            }
        }
    }

    // Calculate the total price of items in the cart
    public function calculateTotal()
    {
        $total = 0;
        foreach ($_SESSION['cart'] as $cartItem) {
            $total += $cartItem['price'] * $cartItem['quantity'];
        }
        return $total;
    }

    // Check if the cart is empty
    public function isCartEmpty()
    {
        return empty($_SESSION['cart']);
    }
}
