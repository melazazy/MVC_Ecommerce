<?php
class Login extends Controller
{
    function index()
    {
        // Page Title
        $data['title'] = "LOGIN";
        $this->view("../auth/login", $data);
    }
}
