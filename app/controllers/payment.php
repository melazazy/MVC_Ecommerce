<?php
class Payment extends Controller
{
    function index()
    {
        // Page Title
        $data['title'] = "Payment";

        $this->view("zay_shop/payment", $data);
    }
}
