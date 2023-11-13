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
}
