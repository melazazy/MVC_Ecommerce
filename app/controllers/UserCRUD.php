<?php
class UserCRUD extends Controller
{
    function index()
    {

        $data['title'] = "About";

        $this->view("zay_shop/about", $data);
    }
    function updateUser($userCRUD)
    {
        $userCRUD = $this->loadmodel('UserCRUD');
        if (isset($_POST['update_user'])) {
            $user_id = $_POST['user_id'];
            $password = $_POST['password'];
            $email = $_POST['email'];

            if ($userCRUD->updateUser($user_id, $password, $email)) {
                echo "User updated successfully!";
            } else {
                echo "Failed to update user.";
            }
        }
    }
    function deleteUser($userCRUD)
    {
        $userCRUD = $this->loadmodel('UserCRUD');
        if (isset($_GET['delete_user'])) {
            $user_id = $_GET['user_id'];

            if ($userCRUD->deleteUser($user_id)) {
                echo "User deleted successfully!";
            } else {
                echo "Failed to delete user.";
            }
        }
    }
}
