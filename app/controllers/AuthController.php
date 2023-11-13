<?php
// app/controllers/AuthController.php

class AuthController extends Controller
{
    public function index()
    {
    }
    public function login()
    {
        // Handle user login logic here
        $user = $this->loadmodel('User');
        $user->login($_POST);
        if (isset($_SESSION['user_url']) && isset($_SESSION['role'])) {
            // if ($_SESSION['user_url']) {
            if ($_SESSION['role'] == 'admin') {
                // $data['title'] = "Dashboard";
                // $this->view("../admin/dashboard", $data);
                header("Location:" . ROOT . "AdminController/dashboard");
                die;
            } else if ($_SESSION['role'] == 'user') {
                // $data['title'] = "profile";
                // $this->view("../user/profile", $data);
                header("Location:" . ROOT . "UserController/profile");
                die;
            } else {
                header("Location:" . ROOT . "index");
                die;
            }
        } else {
            $data['title'] = "Login";
            $this->view("../auth/login", $data);
        }
    }

    public function register()
    {
        $user = $this->loadmodel('User');
        $user->register($_POST);
        // Handle user registration logic here
        $data['title'] = "Register";
        $this->view("../auth/register", $data);
    }

    public function logout()
    {
        $user = $this->loadmodel('User');
        $user->logout();

        header("Location:" . ROOT . "index");
        die;
        // Handle user logout logic here
    }
}
