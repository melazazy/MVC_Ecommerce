<?php
class shopSingle extends Controller
{
    function index(){
        // Page Title
        $data['title'] = "Home";

        $this->view("zay_shop/shopSingle",$data);
    }
}