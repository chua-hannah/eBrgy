<?php
$error = "";
$errors = array();
class UserManagementController {

  private $connection;

  public function __construct($connection)
  {
      $this->connection = $connection;
  }
    public function index() {
      // Render the home page content
      include 'templates/admin/user_management/user_management.php';
    }
    public function user_management() {
         // Prepare and execute the query
         $query = "SELECT * FROM users WHERE role != 'captain'";
         $result = $this->connection->query($query);
 
         // Fetch all user records as an associative array
         $users = array();
         if ($result->num_rows > 0) {
             while ($row = $result->fetch_assoc()) {
                 $users[] = $row;
             }
         }
 
         // Return the fetched user data
         return $users;
      // Render the home page content
      include 'templates/admin/user_management.php';
    }

    public function add() {
        if (isset($_POST['add-officials'])) {
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
        // Handle undefined array error for sex
        if (isset($_POST['sex'])) {
            $sex = $_POST['sex'];
            // Now you can safely access $selectOption without an "undefined array key" error.
        } else {
            // Handle the case when 'selectOption' is not set.
            $sex = ""; // or some default value
        }
        if (isset($_POST['role'])) {
            $role = $_POST['role'];
            // Now you can safely access $selectOption without an "undefined array key" error.
        } else {
            // Handle the case when 'selectOption' is not set.
            $role = ""; // or some default value
        }
        $status = 'pending';

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
        if (empty($role)) {
            $errors["role"] = "Select Barangay Position";
        }
        if (!(isset($_POST["data_privacy_agreement"]))) {
            // The checkbox was checked
            $errors["terms"] = "In order to proceed, I must agree to the data privacy consent.";
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
                    $_SESSION['error'] = "Image upload failed. Please try again.";
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
            }  elseif (empty($error) && empty($errors)) {
                // Insert the data into the database
                $query = "INSERT INTO users (username, password, email, mobile, firstname, middlename, lastname, birthdate, age, sex, address, role, id_selfie, valid_id, status) 
                        VALUES ('$username', '$password', '$email', '$mobile', '$firstname', '$middlename', '$lastname', '$birthdate', '$age', '$sex', '$address', '$role', '$idSelfieFileName', '$validIdFileName', '$status')";
                if ($this->connection->query($query) === true) {
                    // Registration successful
                    header("Location: user-management");
                    $_SESSION['success'] = "Registration successful.";
                    exit();
                } else {
                    // Error occurred
                    $_SESSION['error'] = "Error: " . $this->connection->error;
                }
            }
        }
        }
    
        // Render the register page content
        include 'templates/admin/user_management/add_user.php';
    }
     // Function to fetch user data from the database
     private function getUserData($userId) {
        $sql = "SELECT * FROM users WHERE user_id = ?";
        $stmt = $this->connection->prepare($sql);
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();
        
        // Fetch user data as an associative array
        $userData = $result->fetch_assoc();
        
        $stmt->close();

        return $userData;
    }

    public function edit($userId) {
        // Ensure that userId is available as a variable
        if ($userId) {
            // Fetch user data based on the userId from the users table
            $userData = $this->getUserData($userId);

            // Check if user data was found
            if ($userData) {
                // You can now use $userData to populate your edit form or display user information
                // For example, $userData['username'], $userData['email'], etc.

                // Include your template to display the edit user form or information
                include 'templates/admin/user_management/edit_user.php';
            } else {
                // Handle the case when the user with the provided userId is not found
                echo "User not found!";
            }
        } else {
            // Handle the case when userId is not provided
            echo "User ID not provided!";
        }
    }

   

        function activate_user($user_id) {

            $activationMessage = '';

            if (isset($_POST['activate_user'])) {
                // Retrieve the user ID from the form
                $user_id = $_POST['user_id'];
            
                // Use prepared statements to prevent SQL injection
                $stmt = $this->connection->prepare("UPDATE users SET status = 'activated' WHERE user_id = ?");
                $stmt->bind_param("i", $user_id); // Assuming user_id is an integer
            
                if ($stmt->execute()) {
                    // Activation successful
                    header("Location: /eBrgy/app/user-management");
                    $_SESSION['success'] = "User activated successfully.";
                    exit();

                } else {
                    // Activation failed
                    $_SESSION['error'] = "Error updating user status: " . $stmt->error;
                }
            
                // Close the prepared statement
                $stmt->close();
            }
            return $activationMessage;

        }

        function deactivate_user($user_id) {

            if (isset($_POST['deactivate_user'])) {
                // Retrieve the user ID from the form
                $user_id = $_POST['user_id'];
            
                // Use prepared statements to prevent SQL injection
                $stmt = $this->connection->prepare("UPDATE users SET status = 'deactivated' WHERE user_id = ?");
                $stmt->bind_param("i", $user_id); // Assuming user_id is an integer
            
                if ($stmt->execute()) {
                    // Activation successful
                    header("Location: /eBrgy/app/user-management");
                    $_SESSION['success'] = "User deactivated successfully.";
                    exit();
                } else {
                    // Activation failed
                    $_SESSION['error'] = "Error updating user status: " . $stmt->error;
                }
            
                // Close the prepared statement
                $stmt->close();
            }
        }

        function delete_user($user_id) {

            if (isset($_POST['delete_user'])) {
                // Retrieve the user ID from the form
                $user_id = $_POST['user_id'];
            
                $stmt = $this->connection->prepare("DELETE FROM users WHERE user_id = ?");
                $stmt->bind_param("i", $user_id); // Assuming user_id is an integer
            
                if ($stmt->execute()) {
                    // Activation successful
                    header("Location: /eBrgy/app/user-management");
                    $_SESSION['success'] = "User deleted successfully.";
                    exit();
                } else {
                    // Activation failed
                    $_SESSION['error'] = "Error updating user status: " . $stmt->error;
                }
            
                // Close the prepared statement
                $stmt->close();
            }
        }
 
}
  
?>