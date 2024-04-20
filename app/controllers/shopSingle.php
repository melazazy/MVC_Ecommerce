<?php
class shopSingle extends Controller
{
    function index()
    {
        // Page Title
        $data['title'] = "Home";
        $productId = '';
        $data['product'] = '';
        $data['related'] = '';
        $product = $this->loadmodel('Product');
        if (!isset($_GET['id']) || empty($_GET['id'])) {
            // Redirect to the index page
            header('Location: ' . ROOT . 'index');
            exit;
        }
        if (isset($_GET['id']) && filter_var($_GET['id'], FILTER_VALIDATE_INT) !== false) {
            $productId = ($product->checkIdExists($_GET['id'])) ? $_GET['id'] : '';
        }
        if ($productId != '') {
            $data['product'] = $product->getProductDetails($productId);
            $data['related'] = $product->getAllProductsRelated($productId);
            $data['title'] = $data['product'][0]->name;
        }

        $this->view("zay_shop/shopSingle", $data);
    }
}
