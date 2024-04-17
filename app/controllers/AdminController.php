<?php
// app/controllers/AdminController.php

class AdminController extends Controller
{
    public function dashboard()
    {
        $user = $this->loadmodel('User');
        $logeduser = $user->check_logged_in();
        $id = $_SESSION['user_id'];
        $role = $user->getrole($id);

        // Handle admin dashboard logic here
        $data['title'] = 'Dashboard';
        // echo ($role[0]->role);
        // show($role);
        // die;
        // $data['role'] = $role[0]->role;
        $data['role'] = $role;
        // show($data['role']);
        // die;
        if ($logeduser and  $data['role'] == 'admin') {
            $this->view("../admin/dashboard", $data);
        } else if ($logeduser && $role[0]->role == 'user') {
            header("Location: ../UserController/profile");
            $this->view("../user/profile", $data);
        } else {
            header("Location: ../AuthController/login");
            die();
        }
    }

    public function manageProducts()
    {
        // Display and manage products logic here
        $Category = $this->loadmodel('Category');
        $product = $this->loadmodel('Product');
        $data['cats'] = $Category->getAllCategories();
        $data['products'] = $product->getAllProducts();
        $data['title'] = 'Manage Products';

        // Handle product management actions (Add, Edit, Delete)
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Check if it's an Add, Edit, or Delete action
            if (isset($_POST['action'])) {
                switch ($_POST['action']) {
                    case 'add':
                        $this->addProduct($product);
                        break;

                    case 'edit':
                        $this->editProduct($product);
                        break;

                    case 'delete':
                        $this->deleteProduct($product);
                        break;

                    default:
                        // Handle other cases or show an error
                        break;
                }
            }
        }

        $this->view("../admin/products", $data);
    }
    public function manageCategories()
    {
        // Handle product management logic here
        $data['cats'] = '';
        $data['title'] = 'Manage Categories';
        $Category = $this->loadmodel('Category');
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Check if all required fields are filled
            if (
                isset($_POST["category_name"]) &&
                isset($_POST["category_description"]) &&
                isset($_FILES["category_image"])
            ) {

                // Extract form data
                $name = $_POST["category_name"];
                $description = $_POST["category_description"];
                // Upload image
                $uploadDirectory = 'uploads/'; // Change to your desired directory
                $uploadedFile = $_FILES['category_image']['tmp_name'];
                $targetFile = $uploadDirectory . $_FILES['category_image']['name'];

                if (move_uploaded_file($uploadedFile, $targetFile)) {
                    // Image uploaded successfully
                    // Now, you can store product data and image URL in the database
                    try {
                        $Category->addCategory($name, $description, $targetFile);
                        // echo "Category Added successfully!";
                        header("Location: ../adminController/manageCategories");
                        // $this->view("../admin/categories", $data);
                    } catch (PDOException $e) {
                        echo "Error: " . $e->getMessage();
                    }
                } else {
                    echo "Error uploading image.";
                }
            } else {
                echo "Please fill in all required fields.";
            }
        } else {

            $data['cats'] = $Category->getAllCategories();
        }
        $this->view("../admin/categories", $data);
    }
    public function manageBanners()
    {
        // Handle banner management logic here
        $data['title'] = 'Manage banner';
        $product = $this->loadmodel('product');
        $data['products'] = $product->getAllProducts();
        $banner = $this->loadmodel('banner');
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Check if all required fields are filled
            if (
                isset($_POST["productID"]) &&
                isset($_POST["header"]) &&
                isset($_POST["title"])
            ) {

                // Extract form data
                $id = $_POST["productID"];
                $header = $_POST["header"];
                $title = $_POST["title"];
                try {
                    $banner->addBanner($id, $header, $title);
                    // echo "Category Added successfully!";
                    header("Location: ../adminController/manageBanners");
                    // $this->view("../admin/categories", $data);
                } catch (PDOException $e) {
                    echo "Error: " . $e->getMessage();
                }
            } else {
                echo "Please fill in all required fields.";
            }
        } else {

            $data['banners'] = $banner->getAllBanners();
        }
        $this->view("../admin/banner", $data);
    }
    public function manageUsers()
    {
        // Handle banner management logic here
        $data['title'] = 'Manage Users';
        $users = $this->loadmodel('UserCRUD');
        $data['users'] = $users->getAllUser();
        // $banner = $this->loadmodel('banner');
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Check if all required fields are filled
            if (
                isset($_POST["productID"]) &&
                isset($_POST["header"]) &&
                isset($_POST["title"])
            ) {

                // Extract form data
                $id = $_POST["productID"];
                $header = $_POST["header"];
                $title = $_POST["title"];
                // try {
                //     $banner->addBanner($id, $header, $title);
                //     // echo "Category Added successfully!";
                //     header("Location: ../adminController/manageBanners");
                //     // $this->view("../admin/categories", $data);
                // } catch (PDOException $e) {
                //     echo "Error: " . $e->getMessage();
                // }
            } else {
                echo "Please fill in all required fields.";
            }
        } else {

            // $data['banners'] = $banner->getAllBanners();
        }
        $this->view("../admin/userCRUD", $data);
    }
    private function addProduct($product)
    {
        // Handle add product logic
        if (
            isset($_POST["product_name"]) &&
            isset($_POST["description"]) &&
            isset($_POST["Price"]) &&
            isset($_POST["productCategory"]) &&
            isset($_FILES["product_image"])
        ) {
            // Extract form data
            $productName = $_POST["product_name"];
            $description = $_POST["description"];
            $price = $_POST["Price"];
            $cat = $_POST["productCategory"];
            $featured  = isset($_POST['featured']) ? $_POST['featured'] : 0;
            $stock = $_POST["stock"];

            // Upload image
            $uploadDirectory = 'uploads/';
            $uploadedFile = $_FILES['product_image']['tmp_name'];
            $targetFile = $uploadDirectory . $_FILES['product_image']['name'];

            if (move_uploaded_file($uploadedFile, $targetFile)) {
                // Image uploaded successfully
                // Now, you can store product data and image URL in the database
                try {
                    $product->addProduct($cat, $productName, $description, $price, $targetFile, $featured, $stock);
                    // Add success message or redirection if needed
                } catch (PDOException $e) {
                    // Handle database error
                    echo "Error: " . $e->getMessage();
                }
            } else {
                // Handle image upload error
                echo "Error uploading image.";
            }
        } else {
            // Handle validation error for add product
            echo "Please fill in all required fields for adding a product.";
        }
    }

    public function editProductDetails($productId)
    {
        $productDetails = "Data From Database $productId";
        return ($productDetails);
        return json_encode($productDetails);
    }
    public function editProduct($productModel)
    {
        // show("uytuytyt uytuy u ty");
        // die;
        // $this->view("../user/profile", $productModel);
        // return 'EEEEDDDDIIITTT';
        // Handle edit product logic here and return data 

        if (
            isset($_POST["edit_product_id"]) &&
            isset($_POST["edit_product_name"]) &&
            isset($_POST["edit_description"]) &&
            isset($_POST["edit_Price"]) &&
            isset($_POST["edit_productCategory"]) &&
            isset($_FILES["edit_product_image"])
        ) {
            // Extract form data
            $editProductId = $_POST["edit_product_id"];
            $editProductName = $_POST["edit_product_name"];
            $editDescription = $_POST["edit_description"];
            $editPrice = $_POST["edit_Price"];
            $editCat = $_POST["edit_productCategory"];
            $editFeatured  = isset($_POST['edit_featured']) ? $_POST['edit_featured'] : 0;
            $editStock = $_POST["edit_stock"];

            // Upload image
            $uploadDirectory = 'uploads/'; // Change to your desired directory
            $editUploadedFile = $_FILES['edit_product_image']['tmp_name'];
            $editTargetFile = $uploadDirectory . $_FILES['edit_product_image']['name'];

            if (move_uploaded_file($editUploadedFile, $editTargetFile)) {
                // Image uploaded successfully
                // Now, you can update product data and image URL in the database
                try {
                    $productModel->editProduct($editProductId, $editCat, $editProductName, $editDescription, $editPrice, $editTargetFile, $editFeatured, $editStock);
                    // Edit success message or redirection if needed
                } catch (PDOException $e) {
                    // Handle database error
                    echo "Error: " . $e->getMessage();
                }
            } else {
                // Handle image upload error
                echo "Error uploading image for editing product.";
            }
        } else {
            // Handle validation error for edit product
            echo "Please fill in all required fields for editing a product.";
        }
    }

    private function deleteProduct($productModel)
    {
        // Handle delete product logic
        if (isset($_POST["delete_product_id"])) {
            $deleteProductId = $_POST["delete_product_id"];
            // Perform deletion logic
            try {
                $productModel->deleteProduct($deleteProductId);
                // Delete success message or redirection if needed
            } catch (PDOException $e) {
                // Handle database error
                echo "Error: " . $e->getMessage();
            }
        } else {
            // Handle validation error for delete product
            echo "Invalid request for deleting a product.";
        }
    }
}
