<?php
class Home extends Controller
{
    function index(){
        // Page Title
        $data['title'] = "Home";

        $this->view("zay_shop/index",$data);
    }
}