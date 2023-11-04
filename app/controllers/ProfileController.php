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
        // Use prepared statements to prevent SQL injection
        $stmt = $this->connection->prepare("UPDATE users SET mobile = ?, email = ?, address = ? WHERE user_id = ?");
        $stmt->bind_param("sssi", $newMobile, $newEmail, $newAddress, $user_id); // Assuming user_id is an integer
    
        if ($stmt->execute()) {
            // Activation successful
            header("Location: /eBrgy/app/profile");
            $_SESSION['success'] = "Profile Update successfully.";
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




  
}
  
?>