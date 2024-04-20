<?php
class CartController extends Controller
{
    public function index()
    {

        // Page Title
        $DB = new Database;
        $data['title'] = "Cart";
        $cart = '';
        if (isset($_SESSION['user_id'])) {
            $user_id = $_SESSION['user_id'];
            echo "<script>const user_id = $user_id;</script>";
            $cart = $this->loadModel('Cart');
            $cartItems = $cart->getCartItems($user_id);
            $subtotal = $cart->calculatesubTotal($user_id);
            $discount = $cart->calculateDiscount($user_id);
            $shipping = $cart->calculateShippingCost($user_id);
            $addresses = $cart->getUserAdresses($user_id);
            $total = $subtotal - $discount + $shipping;
            $data['cart'] = $cartItems;
            $data['discount'] = $discount;
            $data['shipping'] = $shipping;
            $data['subtotal'] = $subtotal;
            $data['total'] = $total;
            $data['pay'] = $total;
            $data['addresses'] = $addresses;

            $this->view("zay_shop/cart", $data);
        } else {
            $_SESSION['redirect_url'] = $_SERVER['REQUEST_URI'];
            header("Location:" . ROOT . "AuthController/login");
        }
    }
    public function addToCart()
    {
        $user_id = isset($_GET['user_id']) ? $_GET['user_id'] : null;
        $product_id = isset($_GET['product_id']) ? $_GET['product_id'] : null;

        // Validate user_id and product_id

        if ($user_id !== null && $product_id !== null) {
            // Perform the logic to add the product to the cart
            $cart = $this->loadModel('Cart');
            $result = $cart->addToCart($user_id, $product_id);
            $cartCount = $cart->getCartQuantity($user_id);

            header('Content-Type: application/json');
            echo json_encode(['cartCount' => $cartCount]);
            exit;
        }

        // If the parameters are missing, return an error JSON response
        header('Content-Type: application/json');
        echo json_encode(['error' => 'Missing parameters: user_id and product_id are required.']);
        exit;
    }
    public function updateCartOnchange()
    {
        $user_id = isset($_GET['user_id']) ? $_GET['user_id'] : null;
        $product_id = isset($_GET['product_id']) ? $_GET['product_id'] : null;
        $newQuantity = isset($_GET['newQuantity']) ? $_GET['newQuantity'] : null;
        // Validate user_id and product_id if necessary
        if ($user_id !== null) {
            $cart = $this->loadModel('Cart');
            $productQuantity = $cart->updateQuantity($user_id, $product_id, $newQuantity);
            $subtotal = $cart->calculatesubTotal($user_id);
            $discount = $cart->calculateDiscount($user_id);
            $shipping = $cart->calculateShippingCost($user_id);
            $total = $subtotal - $discount + $shipping;
            header('Content-Type: application/json');
            echo json_encode([
                'productQuantity' => $productQuantity,
                'subtotal' => $subtotal,
                'discount' => $discount,
                'shipping' => $shipping,
                'total' => round($total, 2),
                'pay' => round($total, 2),
            ]);
            exit;
        }

        // If the parameters are missing, return an error JSON response
        header('Content-Type: application/json');
        echo json_encode(
            [
                'error' => 'Missing parameters: user_id and product_id are required.',
            ]
        );
        exit;
    }
    public function updateCartOnremove()
    {
        $user_id = isset($_GET['user_id']) ? $_GET['user_id'] : null;
        $product_id = isset($_GET['product_id']) ? $_GET['product_id'] : null;
        if ($user_id !== null) {
            $cart = $this->loadModel('Cart');
            $remove = $cart->removeProductFromCart($user_id, $product_id);
            $subtotal = $cart->calculatesubTotal($user_id);
            $discount = $cart->calculateDiscount($user_id);
            $shipping = $cart->calculateShippingCost($user_id);
            $CartQuantity = $cart->getCartQuantity($user_id);
            $total = $subtotal - $discount + $shipping;
            header('Content-Type: application/json');
            echo json_encode([
                'subtotal' =>  round($subtotal, 2),
                'discount' =>  round($discount, 2),
                'shipping' => round($shipping, 2),
                'CartQuantity' => round($CartQuantity, 2),
                'total' => round($total, 2),
                'pay' => round($total, 2),
            ]);
            exit;
        }

        // If the parameters are missing, return an error JSON response
        header('Content-Type: application/json');
        echo json_encode(
            [
                'error' => 'Missing parameters: user_id and product_id are required.',
            ]
        );
        exit;
    }
    private function calculateDiscount()
    {
        $user_id = $_SESSION['user_id'];
        if ($user_id !== null) {
            $cart = $this->loadModel('Cart');
            $discount = $cart->calculateDiscount($user_id);
            return $discount;
        }
    }
    public function address()
    {
        $user_id = $_SESSION['user_id'];
        if ($user_id !== null) {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $recipientName = sanitizeInput($_POST['recipientName']);
                $addressLine1 = sanitizeInput($_POST['addressLine1']);
                $addressLine2 = sanitizeInput($_POST['addressLine2']);
                $city = sanitizeInput($_POST['city']);
                $state = sanitizeInput($_POST['state']);
                $postalCode = sanitizeInput($_POST['postalCode']);
                $country = sanitizeInput($_POST['country']);
                // Validate form data
                if (empty($recipientName) || empty($addressLine1) || empty($city) || empty($state) || empty($postalCode) || empty($country)) {
                    // Handle validation error
                    echo json_encode(['success' => false, 'message' => 'All fields are required!']);
                } else {
                    $adress = $this->loadModel('Address');
                    $result = $adress->addAddress($recipientName, $country, $city, $state, $postalCode, $addressLine1, $addressLine2);
                    if ($result) {
                        echo json_encode(['success' => true, 'message' => 'Address added successfully']);
                    } else {
                        echo json_encode(['success' => false, 'message' => 'Failed to add address']);
                    }
                }
            } else {
                // Handle other HTTP methods if needed
                echo json_encode(['success' => false, 'message' => 'Invalid request method']);
            }
        } else {
            // Handle missing user_id
            echo json_encode(['success' => false, 'message' => 'Missing user_id parameter']);
        }
    }
    public function getAddresses()
    {
        $user_id = isset($_GET['user_id']) ? $_GET['user_id'] : null;

        $cart = $this->loadModel('Cart');
        return $cart->printUserAdresses($user_id);
    }
}
