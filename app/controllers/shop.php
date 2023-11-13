<?php
class Shop extends Controller
{
    function index()
    {
        $cat_id = isset($_GET['cat']) ? htmlspecialchars($_GET['cat'], ENT_QUOTES, 'UTF-8') : '';
        $gender = isset($_GET['gender']) ? htmlspecialchars($_GET['gender'], ENT_QUOTES, 'UTF-8') : '';
        $data['title'] = "Shop";
        $product = $this->loadmodel('Product');
        $category = $this->loadmodel('category');
        $banner = $this->loadmodel('Brand');
        $brands = $banner->getAllBrands();
        $products = $product->getAllProductsDetails();
        $categories = $category->getAllCategories();
        if (isset($_GET['cat']) && !isset($_GET['gender'])) {
            $products = $product->getAllProductsWithCat($cat_id);
        } else if (isset($_GET['cat']) && isset($_GET['gender'])) {
            $products = $product->getAllProductsWithCat($cat_id, $gender);
        } else if (!isset($_GET['cat']) && isset($_GET['gender'])) {
            $products = $product->getAllProductsWithCat(null, $gender);
        }
        // show($_GET);
        $data['brands'] = $brands;
        $data['products'] = $products;
        $data['categories'] = $categories;

        $this->view("zay_shop/shop", $data);
    }
}
