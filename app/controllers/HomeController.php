<?php
class HomeController {

  private $connection;

  public function __construct($connection)
  {
      $this->connection = $connection;
  }

    public function home() {
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
      if (isset($_POST['submit_message'])) {
          date_default_timezone_set('Asia/Manila');
          $firstname = $_POST['firstname'];
          $lastname = $_POST['lastname'];
          $email = $_POST['email'];
          $mobile = $_POST['mobile'];
          $subject = $_POST['subject'];
          $contact_message = $_POST['contact_message'];
          $date = date('Y-m-d');
          $time_in = date('H:i:s'); // Philippine time
  
          // Combine date and time into a single datetime string
          $datetime = $date . ' ' . $time_in;
  
          // Use prepared statement to insert data into the database
          $query = "INSERT INTO messages (firstname, lastname, email, mobile, subject, contact_message, created_at) VALUES ('$firstname', '$lastname', '$email', '$mobile', '$subject', '$contact_message', '$created_at')";
  
          // Prepare the statement
          if ($this->connection->query($query) === true) {
            // Registration successful
            echo "Message sent successful";
            header("Location: contact");
            exit();
        } else {
            // Error occurred
            echo "Error: " . $this->connection->error;
        }
      }
  
      // Render the contact page content
      include 'templates/contact.php';
  }
  
    public function admin() {
      // Render the home page content
      include 'templates/admin/dashboard.php';
    }
  }
  
?>