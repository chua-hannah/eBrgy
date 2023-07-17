<?php

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
 
         // Close the database connection
         $result->close();
 
         // Return the fetched user data
         return $users;
      // Render the home page content
      include 'templates/admin/user_management.php';
    }

    public function add()
    {
        if (isset($_POST['add-officials'])) {
            // Retrieve the submitted form data
            $username = $_POST['username'];
            $password = $_POST['password'];
            $email = $_POST['email'];
            $fullname = $_POST['fullname'];
            $age = $_POST['age'];
            $sex = $_POST['sex'];
            $role = $_POST['role'];
    
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
                // Check if there are already 7 users with the role 'kagawad'
                $kagawadCountQuery = "SELECT COUNT(*) AS count FROM users WHERE role = 'kagawad'";
                $kagawadCountResult = $this->connection->query($kagawadCountQuery);
                $kagawadCount = $kagawadCountResult->fetch_assoc()['count'];
    
                if ($role === 'kagawad' && $kagawadCount >= 7) {
                    echo "Maximum number of kagawad users reached.";
                } else {
                    // Insert the data into the database
                    $query = "INSERT INTO users (username, password, email, fullname, age, sex, role) VALUES ('$username', '$password', '$email', '$fullname', '$age', '$sex', '$role')";
                    if ($this->connection->query($query) === true) {
                        // Registration successful
                        echo "Registration successful";
                        header("Location: /eBrgy/app/user-management");
                        exit();
                    } else {
                        // Error occurred
                        echo "Error: " . $this->connection->error;
                    }
                }
            }
        }
    
        // Render the register page content
        include 'templates/admin/user_management/add_user.php';
    }
    
  }
  
?>