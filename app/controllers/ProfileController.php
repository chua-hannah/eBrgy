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
    $activationMessage = '';

    if (isset($_POST['save_changes'])) {
        // Retrieve the user ID from the form
        $user_id = $_POST['user_id'];

        $newMobile = $_POST['mobile'];
        $newEmail = $_POST['email'];
        $newAddress = $_POST['address'];
        $newProfilePicture = null;

        // Handle profile picture upload
        if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] === UPLOAD_ERR_OK) {
            $newProfilePicture = $_FILES['profile_picture']['name'];
            $profilePicturePath = 'uploads/id_selfie/' . $newProfilePicture;
            move_uploaded_file($_FILES['profile_picture']['tmp_name'], $profilePicturePath);
        }

        // Use prepared statements to prevent SQL injection
        if ($newProfilePicture !== null) {
            // Update with the new profile picture
            $stmt = $this->connection->prepare("UPDATE users SET mobile = ?, email = ?, address = ?, id_selfie = ? WHERE user_id = ?");
            $stmt->bind_param("ssssi", $newMobile, $newEmail, $newAddress, $newProfilePicture, $user_id);
        } else {
            // Update without changing the profile picture
            $stmt = $this->connection->prepare("UPDATE users SET mobile = ?, email = ?, address = ? WHERE user_id = ?");
            $stmt->bind_param("sssi", $newMobile, $newEmail, $newAddress, $user_id);
        }

        if ($stmt->execute()) {
            // Activation successful
            echo '<script>window.location.href = "profile";</script>';
            $_SESSION['success'] = "Profile updated successfully.";
            exit();
        } else {
            // Activation failed
            $_SESSION['error'] = "Error updating user profile: " . $stmt->error;
        }

        // Close the prepared statement
        $stmt->close();
    }

    return $activationMessage;
}



function update_admin_profile($user_id) {
    $activationMessage = '';

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
        $newSex = $_POST['sex'];
        // Calculate age based on the updated Birthdate
        $birthdate = new DateTime($newBirthdate);
        $today = new DateTime();
        $age = $today->diff($birthdate)->y;

        // Use prepared statements to prevent SQL injection
        if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] === UPLOAD_ERR_OK) {
            $newProfilePicture = $_FILES['profile_picture']['name'];
            $profilePicturePath = 'uploads/id_selfie/' . $newProfilePicture;
            move_uploaded_file($_FILES['profile_picture']['tmp_name'], $profilePicturePath);

            // Update with the new profile picture
            $stmt = $this->connection->prepare("UPDATE users SET mobile = ?, email = ?, address = ?, birthdate = ?, age = ?, id_selfie = ? WHERE user_id = ?");
            $stmt->bind_param("ssssssi", $newMobile, $newEmail, $newAddress, $newBirthdate, $age, $newProfilePicture, $user_id);
        } else {
            // Update without changing the profile picture
            $stmt = $this->connection->prepare("UPDATE users SET mobile = ?, email = ?, address = ?, birthdate = ?, age = ? WHERE user_id = ?");
            $stmt->bind_param("sssssi", $newMobile, $newEmail, $newAddress, $newBirthdate, $age, $user_id);
        }

        if ($stmt->execute()) {
            // Activation successful
            header("Location: profile");
            $_SESSION['success'] = "Profile updated successfully.";
            exit();
        } else {
            // Activation failed
            $_SESSION['error'] = "Error updating user profile: " . $stmt->error;
        }

        // Close the prepared statement
        $stmt->close();
    }

    return $activationMessage;
}






  
}
  
?>