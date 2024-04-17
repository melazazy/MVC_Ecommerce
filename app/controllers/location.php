<?php
class Location extends Controller
{
    function index()
    {

        $data['title'] = "Locations";
        $banner = $this->loadmodel('Brand');
        $brands = $banner->getAllBrands();
        $data['brands'] = $brands;

        $this->view("zay_shop/location", $data);
    }
}
