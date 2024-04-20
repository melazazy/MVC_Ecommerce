<?php
// this file for Functions that i make and use it throw all the app

function show($arr)
{
    echo "<pre>";
    print_r($arr);
    echo "</pre>";
}
// Function to sanitize and validate input
function sanitizeInput($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
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
function isCartEmpty()
{
    return empty(getCartQuantity($_SESSION['user_id']));
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

    return ($result[0]->cartcount > 0) ? $result[0]->cartcount : null;
}
function getListQuantity($user_id)
{
    $DB = new Database;
    // Get the count of wishlist item for a specific user 
    $query = "SELECT COUNT(*) AS wishlistcount FROM wishlist WHERE user_id = :user_id";
    $data = [
        ':user_id' => $user_id,
    ];

    $result = $DB->read($query, $data);

    return ($result[0]->wishlistcount > 0) ? $result[0]->wishlistcount : 0;
}
function getList($user_id)
{
    $DB = new Database;
    // Get the wishlist item for a specific user and product
    $query = "SELECT w.*,p.image_url, p.name FROM wishlist AS w join products AS p ON w.product_id = p.product_id WHERE user_id = :user_id";
    $data = [
        ':user_id' => $user_id,
    ];

    $result = $DB->read($query, $data);

    return ($result) ? $result : null;
}
function isInCart($user_id, $product_id)
{
    $DB = new Database;
    // Get the cart item for a specific user and product
    $query = "SELECT product_id FROM Cart Where user_id = :user_id and product_id = :product_id  ";
    $data = [
        ':user_id' => $user_id,
        ':product_id' => $product_id,
    ];

    $result = $DB->read($query, $data);

    return $result;
}
function isInList($user_id, $product_id)
{
    $DB = new Database;
    // Get the wishlist item for a specific user and product
    $query = "SELECT product_id FROM Wishlist Where user_id = :user_id and product_id = :product_id  ";
    $data = [
        ':user_id' => $user_id,
        ':product_id' => $product_id,
    ];

    $result = $DB->read($query, $data);
    return $result;

    // return ($result[0]->product_id == $product_id) ? true : false;
}
function printRate($average_rating, $justify, $price = 'no')
{
    echo '<ul class="list-unstyled d-flex justify-content-' . $justify . ' mb-1">
    <span>
    <svg style="display:none;">
        <defs>
            <symbol id="fivestars">
                <path d="M12 .587l3.668 7.568 8.332 1.151-6.064 5.828 1.48 8.279-7.416-3.967-7.417 3.967 1.481-8.279-6.064-5.828 8.332-1.151z M0 0 h24 v24 h-24 v-24" fill="white" fill-rule="evenodd" />
                <path d="M12 .587l3.668 7.568 8.332 1.151-6.064 5.828 1.48 8.279-7.416-3.967-7.417 3.967 1.481-8.279-6.064-5.828 8.332-1.151z M0 0 h24 v24 h-24 v-24" fill="white" fill-rule="evenodd" transform="translate(24)" />
                <path d="M12 .587l3.668 7.568 8.332 1.151-6.064 5.828 1.48 8.279-7.416-3.967-7.417 3.967 1.481-8.279-6.064-5.828 8.332-1.151z M0 0 h24 v24 h-24 v-24" fill="white" fill-rule="evenodd" transform="translate(48)" />
                <path d="M12 .587l3.668 7.568 8.332 1.151-6.064 5.828 1.48 8.279-7.416-3.967-7.417 3.967 1.481-8.279-6.064-5.828 8.332-1.151z M0 0 h24 v24 h-24 v-24" fill="white" fill-rule="evenodd" transform="translate(72)" />
                <path d="M12 .587l3.668 7.568 8.332 1.151-6.064 5.828 1.48 8.279-7.416-3.967-7.417 3.967 1.481-8.279-6.064-5.828 8.332-1.151z M0 0 h24 v24 h-24 v-24" fill="white" fill-rule="evenodd" transform="translate(96)" />
            </symbol>
        </defs>
    </svg>
    <div class="rating">
        <!-- Progress bar with dynamic width based on the average rating -->
        <progress class="rating-bg" value="' . $average_rating . '" max="5"></progress>
        <svg>
            <use xlink:href="#fivestars" />
        </svg>
    </div>
</span>';
    if ($price != 'no') {
        echo    '<li class="text-muted text-right">$' . $price . '</li></ul>';
    }
    echo '</ul>';
}
