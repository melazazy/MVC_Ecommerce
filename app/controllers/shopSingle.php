<?php
class shopSingle extends Controller
{
    function index()
    {
        // Page Title
        $data['title'] = "Home";
        $productId = '';
        $data['product'] = '';
        $product = $this->loadmodel('Product');
        if (isset($_GET['id']) && filter_var($_GET['id'], FILTER_VALIDATE_INT) !== false) {
            $productId = $_GET['id'];
        }
        if ($productId != '') {
            $data['product'] = $product->getProductDetails($productId);
        }

        $this->view("zay_shop/shopSingle", $data);
    }
}
