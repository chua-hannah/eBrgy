<?php
class HomeController {

  private $connection;

  public function __construct($connection)
  {
      $this->connection = $connection;
  }

    public function index() {
      // Render the home page content
      include 'templates/home.php';
    }

    public function officials() {
      if ($this->connection->error) {
          die("Connection failed: " . $this->connection->error);
      }
  
      $query = "SELECT * FROM users WHERE role = 'kagawad'";
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
  
      // Render the home page content
      include 'templates/officials.php';
  
      // Return the fetched user data
      return $users;
  }
  
    public function services() {
      // Render the home page content
      include 'templates/services.php';
    }
    public function contact() {
      // Render the home page content
      include 'templates/contact.php';
    }
    public function admin() {
      // Render the home page content
      include 'templates/admin/dashboard.php';
    }
  }
  
?>