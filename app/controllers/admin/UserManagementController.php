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
         $query = "SELECT * FROM users";
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
    
 

    // Function to count officials by position
    public function countOfficialsByPosition($position) {
        $query = "SELECT COUNT(*) as count FROM users WHERE position = '$position'";
        $result = $this->connection->query($query);

        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return (int)$row['count'];
        }

        return 0; // Something went wrong
    }

    public function add() {
        $errors = array(); // Initialize the $errors array to store validation errors
    
        if (isset($_POST['add-officials'])) {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $mobile = $_POST['mobile'];
            $email = $_POST['email'];
            $firstname = $_POST['firstname'];
            $middlename = $_POST['middlename'];
            $lastname = $_POST['lastname'];
            $birthdate = $_POST['birthdate'];
            $address = $_POST['address'];
           
            $minUsernameLength = 6;
            $minPasswordLength = 8;
            $emailPattern = "/^[a-zA-Z0-9._-]+@[a-zAZ0-9.-]+.[a-zA-Z]{2,4}$/";
            $mobilePattern = "/^9d{9}$/";
            $namePattern = '/^[A-Za-z\s\'.-]+$/';
            $four_ps = isset($_POST['membership_4ps']) ? 1 : 0;
            $pwd = isset($_POST['membership_pwd']) ? 1 : 0;
            $solo_parent = isset($_POST['membership_solo_parent']) ? 1 : 0;
            $scholar = isset($_POST['membership_scholar']) ? 1 : 0;
    
            // Handle undefined array error for sex
            $sex = isset($_POST['sex']) ? $_POST['sex'] : '';
    
            // Handle undefined array error for role
            $role = isset($_POST['role']) ? $_POST['role'] : '';
            $position = isset($_POST['position']) ? $_POST['position'] : '';
            $status = 'activated';
    
            if (empty($firstname)) {
                $errors["firstname"] = "Enter your First name";
            }
            
            if (empty($lastname)) {
                $errors["lastname"] = "Enter your Last name";
            }
            if ($birthdate === "") {
                $errors["birthdate"] = "Enter your Birthdate";
            }
            if (empty($sex)) {
                $errors["sex"] = "Select Gender";
            }
            if (empty($mobile)) {
                $errors["mobile"] = "Enter Mobile number";
            }
            if (empty($email)) {
                $errors["email"] = "Enter Email address";
            }
            if (empty($address)) {
                $errors["address"] = "Enter Address";
            }
            if (empty($position) || $position == '') {
                $errors['position'] = "Select Barangay position";
            }
            if (empty($username)) {
                $errors["username"] = "Enter Username";
            }
            if (empty($password)) {
                $errors["password"] = "Enter Password";
            }
            if (empty($role)) {
                $errors["role"] = "Select System role";
            }
            // Validate first name and last name
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
                $errors["id_selfie"] = "Please upload your Selfie w/ ID";
            }
            if (empty($_FILES['valid_id']['name'])) {
                $errors["valid_id"] = "Please upload your Valid ID";
            }
    
            if (empty($errors)) {
                $requiredPositionsLimits = array(
                    'captain' => 1,
                    'councilor' => 7,
                    'secretary' => 1,
                    'treasurer' => 1,
                    'exo1' => 1,
                    'exo2' => 1,
                    'skchairman' => 1,
                    'skcouncilor' => 1,
                    'sksecretary' => 1,
                    'sktreasurer' => 1
                );
                if (isset($requiredPositionsLimits[$position])) {
                    $limit = $requiredPositionsLimits[$position];
                    $existingCount = $this->countOfficialsByPosition($position);
    
                    if ($existingCount >= $limit) {
                        if ($position === "captain") {
                            $errors['position'] = "The position 'chairman' has reached its limit of $limit officials.";
                        } else {
                            $errors['position'] = "The position '$position' has reached its limit of $limit officials.";
                        }
                        
                    } else {
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
    
                        if (isset($_FILES['id_selfie']) && isset($_FILES['valid_id'])) {
                            $idSelfieUploadPath = 'uploads/id_selfie/';
                            $validIdUploadPath = 'uploads/valid_id/';
    
                            $idSelfieFileName = $_FILES['id_selfie']['name'];
                            $validIdFileName = $_FILES['valid_id']['name'];
    
                            $idSelfieTargetPath = $idSelfieUploadPath . $idSelfieFileName;
                            $validIdTargetPath = $validIdUploadPath . $validIdFileName;
    
                            if (move_uploaded_file($_FILES['id_selfie']['tmp_name'], $idSelfieTargetPath) && move_uploaded_file($_FILES['valid_id']['tmp_name'], $validIdTargetPath)) {
                                // Both image uploads were successful
                                // Proceed with the insertion
                                $query = "INSERT INTO users (username, password, email, mobile, position, firstname, middlename, lastname, birthdate, age, sex, address, role, id_selfie, valid_id, status, senior, four_ps, pwd, solo_parent, scholar) VALUES ('$username', '$password', '$email', '$mobile', '$position', '$firstname', '$middlename', '$lastname', '$birthdate', '$age', '$sex', '$address', '$role', '$idSelfieFileName', '$validIdFileName', '$status', '$senior', '$four_ps', '$pwd', '$solo_parent', '$scholar')";
    
                                if ($this->connection->query($query) === true) {
                                     // Retrieve the ID of the newly inserted row from users_masterlist
                                        $newUserId = $this->connection->insert_id;
                                
                                        // Get the latest ID from the health_info table and generate the next ID
                                        $query = "SELECT MAX(id) AS max_id FROM health_info";
                                        $result = $this->connection->query($query);
                                
                                        if ($result->num_rows > 0) {
                                            $row = $result->fetch_assoc();
                                            $latestHealthInfoId = $row['max_id'];
                                            // Generate the next ID by incrementing the latest ID
                                            $nextHealthInfoId = $latestHealthInfoId + 1;
                                        } else {
                                            // If the health_info table is empty, start with an ID of 1
                                            $nextHealthInfoId = 1;
                                        }
                                
                                        // Now, insert data into the health_info table using the generated ID
                                        $query = "INSERT INTO health_info (id, firstname, middlename, lastname, age)
                                        VALUES ('$nextHealthInfoId', '$firstname', '$middlename', '$lastname', '$age')";
                                
                                        if ($this->connection->query($query) === true) {
                                            // Both inserts were successful
                                            header("Location: non-user");
                                            $_SESSION['success'] = "The resident has been successfully added to User management and health information page.";
                                            exit();
                                        } else {
                                            $_SESSION['error'] = "Error inserting data into the health_info table." . $this->connection->error;
                                        }
                                } else {
                                    // Error occurred
                                    $_SESSION['error'] = "Error: " . $this->connection->error;
                                }
                            } else {
                                // Image uploads failed
                                $_SESSION['error'] = "Image upload failed. Please try again.";
                                // You can return or redirect to the registration page here.
                                return;
                            }
                        }
                    }
                } else {
                    $_SESSION['error'] = "The position '$position' is not defined with a limit.";
                }
            }
        }
        include 'templates/admin/user_management/add_user.php';

    }
    
    
    
   
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
                $stmt->close(); // Close the first prepared statement
    
                // Retrieve user data from the users table
                $userDataQuery = $this->connection->prepare("SELECT firstname, middlename, lastname, age FROM users WHERE user_id = ?");
                $userDataQuery->bind_param("i", $user_id);
                $userDataQuery->execute();
                $userDataQuery->bind_result($firstname, $middlename, $lastname, $age);
                $userDataQuery->fetch();
                $userDataQuery->close(); // Close the second prepared statement
                $newUserId = $this->connection->insert_id;
                // Insert data into the health_info table
                $query = "INSERT INTO health_info (id, firstname, middlename, lastname, age) VALUES (?, ?, ?, ?, ?)";
                $stmt = $this->connection->prepare($query);
                $stmt->bind_param("isssi", $newUserId, $firstname, $middlename, $lastname, $age);
    
                if ($stmt->execute()) {
                    // Both inserts were successful
                    $stmt->close(); // Close the third prepared statement
                    header("Location: user-management");
                    $_SESSION['success'] = "The resident has been successfully activated and added to the health information pages.";
                    exit();
                } else {
                    $_SESSION['error'] = "Error inserting data into the health_info table: " . $this->connection->error;
                }
            } else {
                // Activation failed
                $_SESSION['error'] = "Error updating user status: " . $stmt->error;
            }
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

        function downgradeOfficial() {

            $activationMessage = '';

            if (isset($_POST['remove_official'])) {
                // Retrieve the user ID from the form
                $user_id = $_POST['user_id'];
            
                // Use prepared statements to prevent SQL injection
                $stmt = $this->connection->prepare("UPDATE users SET role = 'residence', position = NULL WHERE user_id = ?");
                $stmt->bind_param("i", $user_id); // Assuming user_id is an integer
            
                if ($stmt->execute()) {
                    // Activation successful
                    header("Location: /eBrgy/app/user-management");
                    $_SESSION['success'] = "Official Remove successfully.";
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

        public function registerUser()
        {
            $role = 'residence';
            $errorMessages = [];

            if (isset($_POST['register_user'])) {
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
                        // Insert the data into the database
                        $query = "INSERT INTO users (username, password, email, mobile, firstname, middlename, lastname, birthdate, age, sex, address, role, id_selfie, valid_id, status, senior, four_ps, pwd, solo_parent, scholar)
                        VALUES ('$username', '$password', '$email', '$mobile', '$firstname', '$middlename', '$lastname', '$birthdate', '$age', '$sex', '$address', '$role', '$idSelfieFileName', '$validIdFileName', '$status', '$senior', '$four_ps', '$pwd', '$solo_parent', '$scholar')";
            
                        if ($this->connection->query($query) === true) {
                            // Registration successful
                            header("Location: user-management");
                            $_SESSION['registration_successful'] = true;
                            exit();
                        } else {
                            // Error occurred
                            $_SESSION['registerFailed'] = "Error: " . $this->connection->error;
                        }
                    }
                }
            }
        }
 
}
  
?>