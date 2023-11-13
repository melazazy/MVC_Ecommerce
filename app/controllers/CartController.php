<?php
class CartController extends Controller
{
    public function index()
    {
        // Page Title
        $data['title'] = "Cart";
        $cart = '';
        if (isset($_SESSION['user_id'])) {
            $id = $_SESSION['user_id'];
            $qdata = [':id' => $id];
            $DB = new Database;
            $q = 'SELECT c.product_id, c.cart_id, p.name, p.price, p.image_url, c.quantity FROM cart c JOIN products p ON c.product_id = p.product_id WHERE c.user_id = :id ;';
            $cart = $DB->read($q, $qdata);
            $data['cart'] = $cart;
            $_SESSION['cart'] = $cart;
            $this->view("zay_shop/cart", $data);
        } else {
            $_SESSION['redirect_url'] = $_SERVER['REQUEST_URI'];
            header("Location:" . ROOT . "AuthController/login");
        }
    }
    public function addToCartold($user_id, $product_id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $user_id = filter_input(INPUT_GET, 'user_id', FILTER_VALIDATE_INT);
            $product_id = filter_input(INPUT_GET, 'product_id', FILTER_VALIDATE_INT);

            if ($user_id !== false && $product_id !== false) {
                // Create an instance of your Cart class and call the addToCart method
                $cart = new Cart();
                $cart->addToCart($user_id, $product_id);
            } else {
                echo 'Invalid user_id or product_id';
            }
        }
    }
    public function addToCart22()
    {
        // Ensure that user_id and product_id are set in the request
        if (isset($_GET['user_id']) && isset($_GET['product_id'])) {
            $user_id = $_GET['user_id'];
            $product_id = $_GET['product_id'];

            // Validate user_id and product_id if necessary
            // echo $user_id . ' //  ' . $product_id;
            $cart = $this->loadModel('Cart');
            $cart->addToCart($user_id, $product_id);

            // Redirect or render appropriate view
        } else {
            // Handle missing parameters error
            echo "Missing parameters: user_id and product_id are required.";
        }
    }
    public function addToCart()
    {
        // Assuming you're using native PHP MVC without a framework
        $user_id = isset($_GET['user_id']) ? $_GET['user_id'] : null;
        $product_id = isset($_GET['product_id']) ? $_GET['product_id'] : null;

        // Validate user_id and product_id if necessary

        if ($user_id !== null && $product_id !== null) {
            // Perform the logic to add the product to the cart
            // $cart = $this->loadModel('Cart');
            // $cart->addToCart($user_id, $product_id);
            ++$_SESSION['cartCount'];
            // Return a JSON response
            // header('Content-Type: application/json');
            echo json_encode(['success' => true]);
            // return json_encode(['success' => true]);
            exit;
        }

        // If the parameters are missing, return an error JSON response
        header('Content-Type: application/json');
        echo json_encode(['error' => 'Missing parameters: user_id and product_id are required.']);
        exit;
    }
}
