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
        $role = 'residence';
        if (isset($_POST['register'])) {
            // Retrieve the submitted form data
            $username = $_POST['username'];
            $password = $_POST['password'];
            $email = $_POST['email'];
            $fullname = $_POST['fullname'];
            $age = $_POST['age'];
    
            // Add more fields as needed
    
            // Check if the username or email already exists in the database
            $query = "SELECT * FROM users WHERE username = '$username' OR email = '$email'";
            $result = $this->connection->query($query);
    
            $existingUsername = false;
            $existingEmail = false;
    
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    if ($row['username'] == $username) {
                        $existingUsername = true;
                    }
                    if ($row['email'] == $email) {
                        $existingEmail = true;
                    }
                }
            }
    
            if ($existingUsername && $existingEmail) {
                // Both username and email already exist, display an error message
                echo "Username and email already exist. Please choose different ones.";
            } elseif ($existingUsername) {
                // Username already exists, display an error message
                echo "Username already exists. Please choose a different one.";
            } elseif ($existingEmail) {
                // Email already exists, display an error message
                echo "Email already exists. Please choose a different one.";
            } else {
                // Insert the data into the database
                $query = "INSERT INTO users (username, password, email, fullname, age, role) VALUES ('$username', '$password', '$email', '$fullname', '$age', '$role')";
                if ($this->connection->query($query) === true) {
                    // Registration successful
                    echo "Registration successful";
                } else {
                    // Error occurred
                    echo "Error: " . $this->connection->error;
                }
            }
        }
    
        // Render the register page content
        include 'templates/register.php';
    }
    
}


