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
  
      $query = "SELECT * FROM users WHERE role = 'captain' OR role = 'kagawad'";
      $result = $this->connection->query($query);
  
      // Fetch all user records as an associative array
      $users = array();
      if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
              $users[] = $row;
          }
      }
  
      // Render the home page content
      include 'templates/officials.php';
  
      // Return the fetched user data
      return $users;
  }
  
  public function services() {
    // Render the home page content
    if (isset($_POST['request_service'])) {
        date_default_timezone_set('Asia/Manila');
        $fullname = $_SESSION['fullname'];
        $email = $_SESSION['email'];
        $mobile = $_SESSION['mobile'];
        $status = 'pending';
        $request_name = $_POST['selected_service'];
        $service_message = $_POST['service_message'];
        $date = date('Y-m-d');
        $time_in = date('H:i:s'); // Philippine time

        // Combine date and time into a single datetime string
        $datetime = $date . ' ' . $time_in;

        // Check if a similar request already exists based on request_name, fullname, email, and mobile
        $checkQuery = "SELECT COUNT(*) as count FROM user_requests WHERE request_name = ? AND fullname = ? AND email = ? AND mobile = ?";
        $stmt = $this->connection->prepare($checkQuery);
        $stmt->bind_param('ssss', $request_name, $fullname, $email, $mobile);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $count = $row['count'];

        if ($count === 0) {
            // No similar request exists with the same fullname, email, mobile, and request_name
            // Proceed to insert the new request into the database
            $query = "INSERT INTO user_requests (request_name, fullname, email, mobile, message, status, created_at) VALUES (?, ?, ?, ?, ?, ?, ?)";
            $stmt = $this->connection->prepare($query);
            $stmt->bind_param('sssssss', $request_name, $fullname, $email, $mobile, $service_message, $status, $datetime);
            if ($stmt->execute()) {
                // Request sent successfully
                echo "Request sent successfully";
                header("Location: services");
                exit();
            } else {
                // Error occurred
                echo "Error: " . $this->connection->error;
            }
        } else {
            // A similar request already exists with the same fullname, email, mobile, and request_name
            echo "Error: Similar request already exists.";
        }
    }
}


      public function get_user_requests($fullname, $mobile, $email) {
        
        if ($this->connection->error) {
            die("Connection failed: " . $this->connection->error);
        }

        // Use prepared statement to prevent SQL injection
        $query = "SELECT * FROM user_requests WHERE fullname = ? AND mobile = ? AND email = ?";
        $stmt = $this->connection->prepare($query);
        $stmt->bind_param('sss', $fullname, $mobile, $email);
        $stmt->execute();

        // Fetch all request settings records as an associative array
        $result = $stmt->get_result();
        $myrequests = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $myrequests[] = $row;
            }
        }

        // Return the fetched request settings data
        return $myrequests;
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
          $query = "INSERT INTO messages (firstname, lastname, email, mobile, subject, contact_message, created_at) VALUES ('$firstname', '$lastname', '$email', '$mobile', '$subject', '$contact_message', '$datetime')";
  
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