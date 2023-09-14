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
  
}
  
?>