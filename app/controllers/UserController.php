<?php
require './config/database.php';

class UserController {
    private $connection;

    public function __construct($connection)
    {
        $this->connection = $connection;
    }

    public function login()
    {
        // Render the login page content
        include 'templates/login.php';
    }

    public function register()
    {
        if (isset($_POST['register'])) {
            // Retrieve the submitted form data
            $username = $_POST['username'];
            $password = $_POST['password'];
            $email = $_POST['email'];
            // Add more fields as needed

            // Insert the data into the database
            $query = "INSERT INTO users (username, password, email) VALUES ('$username', '$password', '$email')";
            if ($this->connection->query($query) === true) {
                // Registration successful
                echo "Registration successful";
            } else {
                // Error occurred
                echo "Error: " . $this->connection->error;
            }
        }

        // Render the register page content
        include 'templates/register.php';
    }
}
