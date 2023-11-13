<?php
class Contact extends Controller
{
    function index()
    {
        // Page Title
        $data['title'] = "Home";

        $this->view("zay_shop/contact", $data);
    }
}
