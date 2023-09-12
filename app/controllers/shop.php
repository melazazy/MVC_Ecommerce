<?php
class Shop extends Controller
{
    function index(){
        // Page Title
        $data['title'] = "Home";

        $this->view("zay_shop/shop",$data);
    }
}