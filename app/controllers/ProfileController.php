<?php
class ProfileController {
   
  private $connection;

  public function __construct($connection)
  {
      $this->connection = $connection;
  }
    public function admin() {
      // Render the home page content
      include 'templates/dashboard.php';
    }

    public function profile($user_id) {
      if ($this->connection->error) {
          die("Connection failed: " . $this->connection->error);
      }
  
      // Use prepared statement to prevent SQL injection
      $query = "SELECT * FROM users WHERE user_id = ?";
      $stmt = $this->connection->prepare($query);
      $stmt->bind_param('i', $user_id);
      $stmt->execute();
  
      // Fetch user data as an associative array
      $result = $stmt->get_result();
      
      if ($result->num_rows > 0) {
          $user_data = $result->fetch_assoc();
          return $user_data;
      } else {
          // User not found, return null
          return null;
      }
  }

  
  function update_user_profile($user_id) {
    $errorMessages = [];
    if (isset($_POST['save_changes'])) {
        // Retrieve the user ID from the form
        $user_id = $_POST['user_id'];
        $newMobile = $_POST['mobile'];
        $newEmail = $_POST['email'];
        $newAddress = $_POST['address'];
        $emailPattern = "/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/";
        $mobilePattern = "/^9\d{9}$/";
        $newProfilePicture = null;

        // Handle profile picture upload
        if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] === UPLOAD_ERR_OK) {
            $newProfilePicture = $_FILES['profile_picture']['name'];
            $profilePicturePath = 'uploads/id_selfie/' . $newProfilePicture;
            move_uploaded_file($_FILES['profile_picture']['tmp_name'], $profilePicturePath);
        }

        if (!empty($newMobile)) {
            if  (!preg_match($mobilePattern, $newMobile)) {
                $errorMessages["mobile"] = "Invalid mobile number format";    
            }
        }
        if (!empty($newEmail)) {
            if (!preg_match($emailPattern, $newEmail)) {
                $errorMessages["email"] = "Invalid email format";
            }
        }
        // Use prepared statements to prevent SQL injection
        if ($newProfilePicture !== null) {
            $prefixMobileNumber = "+63";
            $newMobile = $prefixMobileNumber . $newMobile;
            // Update with the new profile picture
            $stmt = $this->connection->prepare("UPDATE users SET mobile = ?, email = ?, address = ?, id_selfie = ? WHERE user_id = ?");
            $stmt->bind_param("ssssi", $newMobile, $newEmail, $newAddress, $newProfilePicture, $user_id);
        } else {
            $prefixMobileNumber = "+63";
            $newMobile = $prefixMobileNumber . $newMobile;
            // Update without changing the profile picture
            $stmt = $this->connection->prepare("UPDATE users SET mobile = ?, email = ?, address = ? WHERE user_id = ?");
            $stmt->bind_param("sssi", $newMobile, $newEmail, $newAddress, $user_id);
        }
        if (!empty($errorMessages)) {
            // If there are errors, set them in the $errorMessages array
            $_SESSION['error'] = "There are one or more errors in the form:\n" . implode("\n& ", $errorMessages);
            header("Location: /eBrgy/app/profile");
            exit();
        }
        else {
            if ($stmt->execute()) {
                // Activation successful
                header("Location: /eBrgy/app/profile");
                $_SESSION['success'] = "Your profile has been successfully updated.";
                exit();
            } else {
                // Activation failed
                $_SESSION['error'] = "Error updating user profile: " . $stmt->error;
            }
        }

        // Close the prepared statement
        $stmt->close();
    }
}



function update_admin_profile($user_id) {
    $errorMessages = [];
    if (isset($_POST['save_changes'])) {
        // Retrieve the user ID from the form
        $user_id = $_POST['user_id'];
        $newMobile = $_POST['mobile'];
        $newEmail = $_POST['email'];
        $newAddress = $_POST['address'];
        $newBirthdate = $_POST['birthdate']; // Added Birthdate
        $newFirstname = $_POST['firstname'];
        $newMiddlename = $_POST['middlename']; // Fix variable names
        $newLastname = $_POST['lastname']; // Fix variable names
        $emailPattern = "/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/";
        $mobilePattern = "/^9\d{9}$/";
        // Calculate age based on the updated Birthdate
        $birthdate = new DateTime($newBirthdate);
        $today = new DateTime();
        $age = $today->diff($birthdate)->y;

        if (!empty($newMobile)) {
            if  (!preg_match($mobilePattern, $newMobile)) {
                $errorMessages["mobile"] = "Invalid mobile number format";    
            }
        }
        if (!empty($newEmail)) {
            if (!preg_match($emailPattern, $newEmail)) {
                $errorMessages["email"] = "Invalid email format";
            }
        }
        
        // Use prepared statements to prevent SQL injection
        if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] === UPLOAD_ERR_OK) {
            $newProfilePicture = $_FILES['profile_picture']['name'];
            $profilePicturePath = 'uploads/id_selfie/' . $newProfilePicture;
            move_uploaded_file($_FILES['profile_picture']['tmp_name'], $profilePicturePath);
            $prefixMobileNumber = "+63";
            $newMobile = $prefixMobileNumber . $newMobile;
            // Update with the new profile picture
            $stmt = $this->connection->prepare("UPDATE users SET firstname = ?, middlename = ?, lastname = ?, mobile = ?, email = ?, address = ?, birthdate = ?, age = ?, id_selfie = ? WHERE user_id = ?");
            $stmt->bind_param("sssssssssi", $newFirstname, $newMiddlename, $newLastname, $newMobile, $newEmail, $newAddress, $newBirthdate, $age, $newProfilePicture, $user_id);
        } else {
            $prefixMobileNumber = "+63";
            $newMobile = $prefixMobileNumber . $newMobile;
            // Update without changing the profile picture
            $stmt = $this->connection->prepare("UPDATE users SET firstname = ?, middlename = ?, lastname = ?, mobile = ?, email = ?, address = ?, birthdate = ?, age = ? WHERE user_id = ?");
            $stmt->bind_param("ssssssssi", $newFirstname, $newMiddlename, $newLastname, $newMobile, $newEmail, $newAddress, $newBirthdate, $age, $user_id);
        }
        if (!empty($errorMessages)) {
            // If there are errors, set them in the $errorMessages array
            $_SESSION['error'] = "There are one or more errors in the form:\n" . implode("\n& ", $errorMessages);
            header("Location: profile");
            exit();
        } 
        else {
            if ($stmt->execute()) {
                // Activation successful
                header("Location: profile");
                $_SESSION['success'] = "Your profile has been successfully updated.";
                exit();
            } else {
                // Activation failed
                $_SESSION['error'] = "Error updating user profile: " . $stmt->error;
            }
        }

        // Close the prepared statement
        $stmt->close();
    }
}
}
  
?>