<?php
class UserCRUD
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    // Create a new user
    public function getAllUser()
    {
        $query = "SELECT * FROM users ";

        return $this->db->read($query);
    }
    public function createUser($user_id, $password, $email)
    {
        $query = "INSERT INTO users (user_id, password, email) VALUES (:user_id, :password, :email)";
        $data = [
            'user_id' => $user_id,
            'password' => $password,
            'email' => $email
        ];

        return $this->db->write($query, $data);
    }

    // Read user data by user_id
    public function readUserById($user_id)
    {
        $query = "SELECT * FROM users WHERE user_id = :user_id";
        $data = ['user_id' => $user_id];

        return $this->db->read($query, $data);
    }

    // Update user data
    public function updateUser($user_id, $password, $email)
    {
        $query = "UPDATE users SET password = :password, email = :email WHERE user_id = :user_id";
        $data = [
            'user_id' => $user_id,
            'password' => $password,
            'email' => $email
        ];

        return $this->db->write($query, $data);
    }

    // Delete user by user ID
    public function deleteUser($user_id)
    {
        $query = "DELETE FROM users WHERE user_id = :user_id";
        $data = ['user_id' => $user_id];

        return $this->db->write($query, $data);
    }
}
