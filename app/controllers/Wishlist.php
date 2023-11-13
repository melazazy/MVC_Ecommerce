<?php
class Wishlist extends Controller
{
    function index()
    {

        $data['title'] = "About";

        $this->view("zay_shop/about", $data);
    }
}
