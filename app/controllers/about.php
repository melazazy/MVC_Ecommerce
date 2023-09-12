<?php
class About extends Controller
{
    function index(){

        $data['title'] = "About";

        $this->view("zay_shop/about",$data);
    }
}