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
    if (isset($_POST['login'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Validate username and password
        if (empty($username) || empty($password)) {
            echo "Please enter both username and password.";
            return;
        }

        // Retrieve user data from the database
        $query = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
        $result = $this->connection->query($query);

        if ($result->num_rows > 0) {
            // User exists, login successful
            $user = $result->fetch_assoc();
            $username = $user['username'];
            $user_id = $user['user_id'];
            $role = $user['role'];
            $fullname = $user['fullname'];

            // Store the user's data in the session
            $_SESSION['username'] = $username;
            $_SESSION['user_id'] = $user_id;
            $_SESSION['role'] = $role;
            $_SESSION['fullname'] = $fullname;

            // Redirect to appropriate page based on user role
            switch ($role) {
                case 'residence':
                    header("Location: home");
                    exit();
                case 'captain':
                    header("Location: dashboard");
                    exit();
                case 'admin':
                    header("Location: dashboard");
                    exit();
                default:
                    echo "Invalid user role.";
                    return;
            }
        } else {
            // Invalid username or password
            echo "Invalid username or password.";
            return;
        }
    }

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
                    header("Location: login");
                    exit();
                } else {
                    // Error occurred
                    echo "Error: " . $this->connection->error;
                }
            }
        }
    
        // Render the register page content
        include 'templates/register.php';
    }

    public function logout()
    {
        session_start();
        
        // Clear all session variables
        $_SESSION = [];

        // Destroy the session
        session_destroy();

        // Redirect to the login page or any other page you prefer
        header("Location: login");
        exit();
    }
    
}


