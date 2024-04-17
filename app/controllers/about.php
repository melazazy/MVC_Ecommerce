<?php
class About extends Controller
{
    function index()
    {

        $data['title'] = "About";
        $banner = $this->loadmodel('Brand');
        $brands = $banner->getAllBrands();
        $data['brands'] = $brands;

        $this->view("zay_shop/about", $data);
    }
}
