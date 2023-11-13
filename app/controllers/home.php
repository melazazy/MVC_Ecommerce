<?php
class Home extends Controller
{
    function index()
    {
        // Page Title
        $data['title'] = "Home";
        $banner = $this->loadmodel('Banner');
        $cat = $this->loadmodel('category');
        $products = $this->loadmodel('Product');
        $data['banner'] = $banner->get3Banners();
        $data['cats'] = $cat->get3Categories();
        $data['products'] = $products->get3Products();
        $this->view("zay_shop/index", $data);
    }
}
