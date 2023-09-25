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
        $query = "SELECT * FROM users WHERE username = '$username' AND password = '$password' AND status = 'activated'";
        $result = $this->connection->query($query);

        if ($result->num_rows > 0) {
            // User exists, login successful
            $user = $result->fetch_assoc();
            $username = $user['username'];
            $email = $user['email'];
            $mobile = $user['mobile'];
            $user_id = $user['user_id'];
            $role = $user['role'];
           

            // Store the user's data in the session
            $_SESSION['username'] = $username;
            $_SESSION['user_id'] = $user_id;
            $_SESSION['role'] = $role;
            $_SESSION['mobile'] = $mobile;
            $_SESSION['email'] = $email;
           
            
            // Redirect to appropriate page based on user role
            switch ($role) {
                case 'residence':
                    header("Location: home");
                    exit();
                case 'captain':
                    header("Location: dashboard");
                    exit();
                case 'kagawad':
                    header("Location: dashboard");
                    exit();
                default:
                    echo "Invalid user role.";
                    return;
            }
        } else {
            // Invalid username or password
            $_SESSION['status'] = "Invalid username or password.";
            
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
        $mobile = $_POST['mobile'];
        $firstname = $_POST['firstname'];
        $middlename = $_POST['middlename'];
        $lastname = $_POST['lastname'];
        $birthdate = $_POST['birthdate'];
        $sex = $_POST['sex'];
        $status = 'deactivate';
        // Convert birthdate to YYYY-MM-DD format
        $birthdateTimestamp = strtotime($birthdate);
        if ($birthdateTimestamp === false) {
            // Invalid date format, handle the error
            $_SESSION['status'] = "Invalid date format for birthdate. Please use MM/DD/YYYY format.";
            // You can return or redirect to the registration page here.
            return;
        } else {
            // Valid date format, convert it to YYYY-MM-DD
            $birthdate = date('Y-m-d', $birthdateTimestamp);
        }

        // Calculate age from birthdate
        $currentTimestamp = time();
        $ageInSeconds = $currentTimestamp - $birthdateTimestamp;
        $age = floor($ageInSeconds / (365 * 24 * 3600));
        // Handle image uploads
        $idSelfieFileName = '';
        $validIdFileName = '';

        if (isset($_FILES['id_selfie']) && isset($_FILES['valid_id'])) {
            $idSelfieUploadPath = 'uploads/id_selfie/';
            $validIdUploadPath = 'uploads/valid_id/';

            $idSelfieFileName = $_FILES['id_selfie']['name'];
            $validIdFileName = $_FILES['valid_id']['name'];

            $idSelfieTargetPath = $idSelfieUploadPath . $idSelfieFileName;
            $validIdTargetPath = $validIdUploadPath . $validIdFileName;

            if (move_uploaded_file($_FILES['id_selfie']['tmp_name'], $idSelfieTargetPath) && move_uploaded_file($_FILES['valid_id']['tmp_name'], $validIdTargetPath)) {
                // Both image uploads were successful
            } else {
                // Image uploads failed
                $_SESSION['status'] = "Image upload failed. Please try again.";
                // You can return or redirect to the registration page here.
                return;
            }
        }

        // Check if the username or email already exists in the database
        $query = "SELECT * FROM users WHERE username = '$username' OR email = '$email' OR mobile = '$mobile'";
        $result = $this->connection->query($query);

        $existingUsername = false;
        $existingEmail = false;
        $existingMobile = false;

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                if ($row['username'] == $username) {
                    $existingUsername = true;
                }
                if ($row['email'] == $email) {
                    $existingEmail = true;
                }
                if ($row['mobile'] == $mobile) {
                    $existingMobile = true;
                }
            }
        }

        if ($existingUsername && $existingEmail && $existingMobile) {
            // Both username and email already exist, display an error message
            $_SESSION['status'] = "Username , email and mobile already exist. Please choose different ones.";
        } elseif ($existingUsername) {
            // Username already exists, display an error message
            $_SESSION['status'] = "Username already exists. Please choose a different one.";
        } elseif ($existingEmail) {
            // Email already exists, display an error message
            $_SESSION['status'] = "Email already exists. Please choose a different one.";
        } elseif ($existingMobile) {
            // Email already exists, display an error message
            $_SESSION['status'] = "Mobile already exists. Please choose a different one.";
        } else {
            // Insert the data into the database
            $query = "INSERT INTO users (username, password, email, mobile, firstname, middlename, lastname, birthdate, age, sex, role, id_selfie, valid_id, status) 
                      VALUES ('$username', '$password', '$email', '$mobile', '$firstname', '$middlename', '$lastname', '$birthdate', '$age', '$sex', '$role', '$idSelfieFileName', '$validIdFileName', '$status')";
          if ($this->connection->query($query) === true) {
            // Registration successful
            $_SESSION['status'] = "Registration successful";
            sleep(3); // Sleep for 3 seconds
            header("Location: login");
            exit();
        } else {
            // Error occurred
            $_SESSION['status'] = "Error: " . $this->connection->error;
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


