<?php
require './config/database.php';
$error = "";
$errors = array();
class UserController {
    private $connection;
    

    public function __construct($connection)
    {
        $this->connection = $connection;
    }

    public function login()
    {
        if (isset($_POST['login'])) {
            $username = trim($_POST['username']);
            $password = $_POST['password'];
    
            // Validate username and password
            if (empty($username) || empty($password)) {
                // Invalid login, display an error message
                $error = "Enter username and password.";
            } else {
                // Retrieve hashed password from the database
                $query = "SELECT * FROM users WHERE username = '$username'";
                $result = $this->connection->query($query);
    
                if ($result->num_rows > 0) {
                    // User exists
                    $user = $result->fetch_assoc();
                    $hashedPassword = $user['password'];
    
                    // Verify the entered password with the hashed password
                    if (password_verify($password, $hashedPassword)) {
                        // Passwords match, proceed with login
                        $username = $user['username'];
                        $firstname = $user['firstname'];
                        $middlename = $user['middlename'];
                        $lastname = $user['lastname'];
                        $email = $user['email'];
                        $mobile = $user['mobile'];
                        $user_id = $user['user_id'];
                        $role = $user['role'];
                        $status = $user['status'];
    
                        // User is not yet activated
                        if ($status === "pending") {
                            $error = "Account is not yet activated. Please wait for your account to be verified by the administrator within 24 hours.";
                        }
                        
                        else if ($status === "deactivated") {
                            $error = "Account is deactivated. Please contact administrator.";
                        }
    
                        // User is activated
                        else {
                            // Store the user's data in the session
                            $_SESSION['username'] = $username;
                            $_SESSION['firstname'] = $firstname;
                            $_SESSION['middlename'] = $middlename;
                            $_SESSION['lastname'] = $lastname;
                            $_SESSION['user_id'] = $user_id;
                            $_SESSION['role'] = $role;
                            $_SESSION['mobile'] = $mobile;
                            $_SESSION['email'] = $email;
    
                            // Redirect to appropriate page based on user role
                            switch ($role) {
                                case 'residence':
                                    header("Location: home");
                                    exit();
                                    break;
                                case 'captain':
                                case 'kagawad':
                                    header("Location: dashboard");
                                    exit();
                                    break;
                                default:
                                    echo "Invalid user role.";
                                    return;
                                    header("Location: login");
                                    exit();
                            }
                        }
                    } else {
                        // Invalid password
                        $error = "Invalid password.";
                    }
                } else {
                    // Invalid username
                    $error = "Invalid username or password.";
                }
            }
        }
    
        // Render the login page content
        include 'templates/login.php';
    }
    
    


    public function register()
{
    $role = 'residence';
    $errorMessages = [];

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
        $address = $_POST['address'];
        $minUsernameLength = 6;
        $minPasswordLength = 8;
        $emailPattern = "/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/";
        $mobilePattern = "/^9\d{9}$/";
        $namePattern = '/^[A-Za-z\s\'.-]+$/';
        // Handle undefined array error for sex
        if (isset($_POST['sex'])) {
            $sex = $_POST['sex'];
            // Now you can safely access $selectOption without an "undefined array key" error.
        } else {
            // Handle the case when 'selectOption' is not set.
            $sex = ""; // or some default value
        }
        $status = 'pending';
      
        $four_ps = isset($_POST['membership_4ps']) ? 1 : 0;
        $pwd = isset($_POST['membership_pwd']) ? 1 : 0;
        $solo_parent = isset($_POST['membership_solo_parent']) ? 1 : 0;
        $scholar = isset($_POST['membership_scholar']) ? 1 : 0;

        // Validate empty input fields & date pattern

        if (empty($firstname)) {
            $errors["firstname"] = "Enter your First name";
        }
        if (empty($lastname)) {
            $errors["lastname"] = "Enter your Last name";
        }  
        if ($birthdate==="") {
            $errors["birthdate"] = "Enter your Birthdate";
        }
        if (empty($sex)) {
            $errors["sex"] = "Select Gender";
        }
        if (empty($mobile)) {
            $errors["mobile"] = "Enter Mobile number";
        }
        else if (!preg_match($mobilePattern, $mobile)) {
            $errors["mobile"] = "Invalid mobile number format.";    
        }
        if (empty($email)) {
            $errors["email"] = "Enter Email address";
        }
        else if (!preg_match($emailPattern, $email)) {
            $errors["email"] = "Invalid email format";
        }
        if (empty($address)) {
            $errors["address"] = "Enter Address";
        }
        if (empty($username)) {
            $errors ["username"] = "Enter Username";
        }
        if (empty($password)) {
            $errors["password"] = "Enter Password";
        }
        if (!(isset($_POST["data_privacy_agreement"]))) {
            // The checkbox was checked
            $errors["terms"] = "In order to proceed, I must agree to the data privacy consent.";
        }
        //Validate first name and last name
        if (!preg_match($namePattern, $firstname)) {
            $errors["firstname"] = "Please enter a valid first name using letters, spaces, dots, hyphens, and single quotes.";
        }
        if(!empty($middlename)) {
            if (!preg_match($namePattern, $middlename)) {
                $errors["middlename"] = "Please enter a valid middle name using letters, spaces, dots, hyphens, and single quotes.";
            }
        }
        if (!preg_match($namePattern, $lastname)) {
            $errors["lastname"] = "Please enter a last name using letters, spaces, dots, hyphens, and single quotes.";
        }
        
        // Validate username length
        if (!(empty($username)) && strlen($username) < $minUsernameLength) {
            $errors["username"] = "Username must be at least {$minUsernameLength} characters long.";
        }

        // Validate password length
        if (!(empty($password)) && strlen($password) < $minPasswordLength) {
            $errors["password"] = "Password must be at least {$minPasswordLength} characters long.";
        }

        // File input is empty
        if (empty($_FILES['id_selfie']['name'])) {
            $errors ["id_selfie"] = "Please upload your Selfie w/ ID";
        }
        if (empty($_FILES['valid_id']['name'])) {
            $errors ["valid_id"] = "Please upload your Valid ID";
        }

        if (!empty($errors) || !empty($error)) {
            // If there are errors, set them in the $errorMessages array
            $errorMessages[] = "There are one or more errors in the form";
        }   

        if (empty($errors)) {
            // Add prefix in mobile number input
            $prefixMobileNumber = "+63";
            $mobile = $prefixMobileNumber . $mobile;

            // Convert birthdate to YYYY-MM-DD format
            $birthdateTimestamp = strtotime($birthdate);
            // Valid date format, convert it to YYYY-MM-DD
            $birthdate = date('Y-m-d', $birthdateTimestamp);

            // Calculate age from birthdate
            $currentTimestamp = time();
            $ageInSeconds = $currentTimestamp - $birthdateTimestamp;
            $age = floor($ageInSeconds / (365 * 24 * 3600));
            $senior = $age >= 60 ? 1 : 0;
            // Handle image uploads
            $idSelfieFileName = '';
            $validIdFileName = '';

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
                $error = "Image upload failed. Please try again.";
                // You can return or redirect to the registration page here.
                return;
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
                $error = "Given username, email, and mobile number already exist.";
            } elseif ($existingUsername) {
                // Username already exists, display an error message
                $error = "Given username already exists.";
            } elseif ($existingEmail) {
                // Email already exists, display an error message
                $error = "Given email already exists.";
            } elseif ($existingMobile) {
                // Mobile number already exists, display an error message
                $error = "Given mobile number already exists.";
            } elseif (empty($error) && empty($errors)) {
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                $query = "INSERT INTO users (username, password, email, mobile, firstname, middlename, lastname, birthdate, age, sex, address, role, id_selfie, valid_id, status, senior, four_ps, pwd, solo_parent, scholar)
                VALUES ('$username', '$hashedPassword', '$email', '$mobile', '$firstname', '$middlename', '$lastname', '$birthdate', '$age', '$sex', '$address', '$role', '$idSelfieFileName', '$validIdFileName', '$status', '$senior', '$four_ps', '$pwd', '$solo_parent', '$scholar')";
    
                if ($this->connection->query($query) === true) {
                    // Registration successful
                    header("Location: home");
                    $_SESSION['registration_successful'] = true;
                    exit();
                } else {
                    // Error occurred
                    $_SESSION['registerFailed'] = "Error: " . $this->connection->error;
                }
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


