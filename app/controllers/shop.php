<?php
class Shop extends Controller
{
    function index()
    {
        $DB = new Database;
        $cat_id = isset($_GET['cat']) ? htmlspecialchars($_GET['cat'], ENT_QUOTES, 'UTF-8') : '';
        $gender = isset($_GET['gender']) ? htmlspecialchars($_GET['gender'], ENT_QUOTES, 'UTF-8') : '';
        $tag_name = isset($_GET['tag']) ? htmlspecialchars($_GET['tag'], ENT_QUOTES, 'UTF-8') : '';
        $data['title'] = "Shop";
        $tags = "SELECT DISTINCT tag_name FROM ProductTags ORDER BY tag_name ASC";
        $tag_names = $DB->read($tags);
        $product = $this->loadmodel('Product');
        $category = $this->loadmodel('Category');
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
        } else if (isset($_GET['tag']) && !isset($_GET['gender'])) {
            $products = $product->getAllProductsWithtag($tag_name);
        }
        // show($_GET);
        $data['brands'] = $brands;
        $data['products'] = $products;
        $data['categories'] = $categories;
        $data['tags'] = $tag_names;

        $this->view("zay_shop/shop", $data);
    }
}
