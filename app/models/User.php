<?php
// app/models/User.php

class User
{
    private $id;
    private $username;
    private $role;
    private $email;
    private $password;
    private $permissions;

    public function getrole($id)
    {
        $DB = new Database;

        $q = 'SELECT role FROM users where user_id = ' . $id;
        $this->role = ($DB->read($q))[0]->role;
        return $this->role;
    }

    public function login($POST)
    {
        $DB = new Database;
        $_SESSION['error'] = '';
        if (isset($POST['username']) && isset($POST['password'])) {
            $arr['username'] = $POST['username'];
            // $arr['password']=password_hash($POST['password'], PASSWORD_DEFAULT);
            $hashed_passquery = "SELECT password FROM users WHERE username = :username LIMIT 1";
            $hashed_password = $DB->read($hashed_passquery, $arr);
            $password = $POST['password'];
            if (password_verify($password, $hashed_password[0]->password)) {
                $query = "SELECT * FROM users WHERE username = :username LIMIT 1";
                $cartquery = "SELECT c.quantity FROM cart AS c WHERE user_id = :user_id ";
                $countquery = "SELECT COUNT(*) AS cartcount FROM cart  WHERE user_id = :user_id ";
                $data = $DB->read($query, $arr);
                $items['user_id'] = $data[0]->user_id;
                $cart = $DB->read($cartquery, $items);
                $count = $DB->read($countquery, $items);

                // show($cart);
                // die();
                if (is_array($data)) {
                    // Logged in
                    $_SESSION['user_id'] = $data[0]->user_id;
                    $_SESSION['user_name'] = $data[0]->username;
                    $_SESSION['user_url'] = $data[0]->url_address;
                    $_SESSION['image_url'] = $data[0]->image_url;
                    $_SESSION['role'] = $this->getrole($data[0]->user_id);
                    $_SESSION['cart'] = $cart;
                    $_SESSION['cartCount'] = $count[0]->cartcount;
                    $role =  $this->role;

                    if (isset($_SESSION['redirect_url'])) {
                        // User is not logged in and a redirect URL is stored
                        $redirect_url = $_SESSION['redirect_url'];
                        unset($_SESSION['redirect_url']); // Remove the stored URL from the session

                        // Redirect the user back to the stored URL (cart page)
                        header("Location: " . $redirect_url);
                    } elseif ($role == 'admin') {
                        header("Location:" . ROOT . "AdminController/dashboard");
                        die;
                    } elseif ($role == 'user') {
                        header("Location:" . ROOT . "UserController/profile");
                        die;
                    }
                } else {
                    $_SESSION['error'] = "Wrong username or Password";
                }
            }
        } else {
            // $_SESSION['error'] = "Please Enter a Valid username and password";
        }
    }
    public function check_logged_in()
    {
        $DB = new Database;
        if (isset($_SESSION['user_url'])) {
            $arr['user_url'] = $_SESSION['user_url'];
            $query = "SELECT * FROM users WHERE url_address = :user_url LIMIT 1";
            $data = $DB->read($query, $arr);
            if (is_array($data)) {
                $_SESSION['user_id'] = $data[0]->user_id;
                $_SESSION['user_name'] = $data[0]->username;
                $_SESSION['user_url'] = $data[0]->url_address;
                return true;
            }
        }
        return false;
    }
    public function register($POST)
    {
        $DB = new Database;
        $_SESSION['error'] = '';
        if (isset($POST['username']) && isset($POST['password'])) {
            $arr['username'] = $POST['username'];
            $arr['email'] = $POST['email'];
            $arr['password'] = password_hash($POST['password'], PASSWORD_DEFAULT);
            $arr['url_address'] = get_random_string_max(60);
            $arr['created_at'] = date("Y-m-d H:i:s");

            $query = 'SELECT * FROM users WHERE username = "' . $arr['username'] . '" ';
            $existingUser = $DB->read($query);
            if ($existingUser > 0) {
                $_SESSION['error'] =  "Username already in use. Please choose a different username.";
            } else {
                try {
                    $insertQuery = "INSERT INTO users (username,email ,password,url_address,created_at) VALUES (:username,:email,:password,:url_address,:created_at)";
                    $data = $DB->write($insertQuery, $arr);
                    header("Location:" . ROOT . "AuthController/login");
                    echo "Sign-up successful!";
                    die;
                } catch (PDOException $e) {
                    echo "Error: " . $e->getMessage();
                }
            }
        } else {
            $_SESSION['error'] = "Please Enter a Valid Data";
        }
    }


    public function getId()
    {
        return $this->id;
    }

    public function getUsername()
    {
        return $this->username;
    }


    public function setUsername($username)
    {
        $this->username = $username;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        // You should hash the password before setting it
        $this->password = password_hash($password, PASSWORD_BCRYPT);
    }
    // User.php

    public function hasPermission($permission)
    {
        return in_array($permission, $this->permissions);
    }
    public function logout()
    {
        unset($_SESSION['user_id']);
        unset($_SESSION['user_name']);
        unset($_SESSION['user_url']);
        unset($_SESSION['role']);
        unset($_SESSION['cart']);

        header("Location:" . ROOT . "AuthController/login");
        // die;
    }
    // Additional methods for database interactions (e.g., save, fetch) would be added here
}
