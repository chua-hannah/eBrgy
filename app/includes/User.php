<?php

class User
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function register($username, $email, $password)
    {
        // Hash the password for security
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    
        // Insert the user data into the database
        $sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$hashedPassword')";
        $result = mysqli_query($this->conn, $sql);
    
        return $result;
    }
    

    public function login($username, $password)
    {
        // Implement user login logic here
    }

    public function assignRole($userId, $role)
    {
        // Implement role assignment logic here
    }

    public function checkRole($userId, $role)
    {
        // Implement role checking logic here
    }
}
