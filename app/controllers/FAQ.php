<?php
class FAQ extends Controller
{
    function index()
    {

        $data['title'] = "FAQ";
        // $banner = $this->loadmodel('Brand');
        // $brands = $banner->getAllBrands();
        // $data['brands'] = $brands;

        $this->view("zay_shop/faq", $data);
    }
}
