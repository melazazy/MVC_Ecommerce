<?php
// this file for Functions that i make and use it throw all the app

function show($arr)
{
    echo "<pre>";
    print_r($arr);
    echo "</pre>";
}
function isArrayOfEmptyElements($array)
{
    foreach ($array as $element) {
        if (!empty($element)) {
            return false;
        }
    }
    return true;
}

function get_random_string_max($length)
{

    $array = array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z', 'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z');
    $text = "";

    $length = rand(4, $length);

    for ($i = 0; $i < $length; $i++) {

        $random = rand(0, 61);

        $text .= $array[$random];
    }

    return $text;
}

function check_message()
{

    if (isset($_SESSION['error']) && $_SESSION['error'] != "") {
        echo $_SESSION['error'];
        unset($_SESSION['error']);
    }
}

// Initialize an empty cart array if it doesn't exist in the session
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}
// Check if the cart is empty
function cartItems()
{
    $items = 0;
    if (is_array($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $cartItem) {
            $items++;
        }
    }
    return $items;
}
// Add an item to the cart
function addToCart($productId, $productName, $productPrice)
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
function removeFromCart($productId)
{
    foreach ($_SESSION['cart'] as $key => $cartItem) {
        if ($cartItem['id'] === $productId) {
            unset($_SESSION['cart'][$key]);
            return;
        }
    }
}

// Calculate the total price of items in the cart
function calculateTotal()
{
    $total = 0;
    if (is_array($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $cartItem) {
            // $total += $cartItem['price'] * $cartItem['quantity'];
            $total += $cartItem->price * $cartItem->quantity;
        }
    }
    return $total;
}

// Check if the cart is empty
function isCartEmpty()
{
    return empty($_SESSION['cart']);
}
