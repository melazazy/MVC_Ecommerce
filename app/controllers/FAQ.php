<?php
class FAQ extends Controller
{
    function index()
    {

        $data['title'] = "FAQ";

        $this->view("zay_shop/faq", $data);
    }
}
