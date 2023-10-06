<?php
class RequestManagementController {

  private $connection;

  public function __construct($connection)
  {
      $this->connection = $connection;
  }
  
    public function index() {
      // Render the home page content
      include 'templates/dashboard.php';
    }
    
    public function report_requests() {
      // Render the home page content
      if ($this->connection->error) {
          die("Connection failed: " . $this->connection->error);
      }
  
      // Use prepared statement to prevent SQL injection
      $query = "SELECT u.firstname, u.middlename, u.lastname, u.address, d.*
                FROM users u
                JOIN report_requests d ON u.username = d.username";
      $stmt = $this->connection->prepare($query);
      $stmt->execute();
  
      // Fetch the requested user data and doc_requests data as an associative array
      $result = $stmt->get_result();
      $data = array();
      if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
              $data[] = $row;
          }
      }
      return $data;
  }

    public function doc_requests() {
      // Render the home page content
      if ($this->connection->error) {
          die("Connection failed: " . $this->connection->error);
      }
  
      // Use prepared statement to prevent SQL injection
      $query = "SELECT u.firstname, u.middlename, u.lastname, u.address, d.*
                FROM users u
                JOIN doc_requests d ON u.username = d.username";
      $stmt = $this->connection->prepare($query);
      $stmt->execute();
  
      // Fetch the requested user data and doc_requests data as an associative array
      $result = $stmt->get_result();
      $data = array();
      if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
              $data[] = $row;
          }
      }
      return $data;
  }
  

    public function equipment_requests() {
      // Render the home page content
      if ($this->connection->error) {
        die("Connection failed: " . $this->connection->error);
    }

    // Use prepared statement to prevent SQL injection
    $query = "SELECT * FROM equipment_requests";
    $stmt = $this->connection->prepare($query);
    $stmt->execute();

    // Fetch all request settings records as an associative array
    $result = $stmt->get_result();
    $all_request = array();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $all_request[] = $row;
        }
    }
    // Return the fetched request settings data
    return $all_request;
    }
  }
  
?>