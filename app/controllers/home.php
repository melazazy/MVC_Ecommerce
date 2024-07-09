<?php
class Home extends Controller
{
    function index()
    {
        // Page Title
        $data['title'] = "Home";
        $banner = $this->loadmodel('banner');
        $cat = $this->loadmodel('category');
        $products = $this->loadmodel('Product');
        $data['banner'] = $banner->get3Banners();
        $data['cats'] = $cat->get3Categories();
        echo $data['cats'];
        die;
        $data['products'] = $products->get3FeaturedProducts();
        $this->view("zay_shop/index", $data);
    }
}
