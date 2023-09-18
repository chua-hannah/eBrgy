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
    public function request() {
      // Render the home page content
      if ($this->connection->error) {
        die("Connection failed: " . $this->connection->error);
    }

    // Use prepared statement to prevent SQL injection
    $query = "SELECT * FROM doc_requests";
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

    public function doc_requests() {
      // Render the home page content
      if ($this->connection->error) {
        die("Connection failed: " . $this->connection->error);
    }

    // Use prepared statement to prevent SQL injection
    $query = "SELECT * FROM doc_requests";
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