<?php
class Cart extends Controller
{
    function index(){
        // Page Title
        $data['title'] = "Cart";

        $this->view("zay_shop/cart",$data);
    }
}