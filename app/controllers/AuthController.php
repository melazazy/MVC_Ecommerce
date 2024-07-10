<?php
// app/controllers/AuthController.php

class AuthController extends Controller
{
    public function login()
    {
        // Handle user login logic 
        echo 'Login page:/';
        die;

        $user = $this->loadmodel('User');
        $user->login($_POST);
        if (isset($_SESSION['user_url']) && isset($_SESSION['role'])) {
            if ($_SESSION['role'] == 'admin') {
                header("Location:" . ROOT . "AdminController/dashboard");
                die;
            } else if ($_SESSION['role'] == 'user') {
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
        $data['title'] = "Register";
        $this->view("../auth/register", $data);
    }

    public function logout()
    {
        $user = $this->loadmodel('User');
        $user->logout();

        header("Location:" . ROOT . "index");
        die;
    }
}
