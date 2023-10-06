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
    include 'templates/services.php';
}
  
public function documents() {
    // Render the home page content
    if (isset($_POST['request_service'])) {
        date_default_timezone_set('Asia/Manila');
        $username = $_SESSION['username'];
        $email = $_SESSION['email'];
        $mobile = $_SESSION['mobile'];
        $status = 'PENDING';
        $request_name = $_POST['selected_service'];
        $service_message = $_POST['service_message'];
        $date = date('Y-m-d');
        $time_in = date('H:i:s'); // Philippine time

        // Combine date and time into a single datetime string
        $datetime = $date . ' ' . $time_in;

        // Check if a similar request already exists based on request_name, fullname, email, and mobile
        $checkQuery = "SELECT COUNT(*) as count FROM doc_requests WHERE request_name = ? AND username = ? AND email = ? AND mobile = ?";
        $stmt = $this->connection->prepare($checkQuery);
        $stmt->bind_param('ssss', $request_name, $username, $email, $mobile);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $count = $row['count'];

        if ($count === 0) {
            // No similar request exists with the same fullname, email, mobile, and request_name
            // Proceed to insert the new request into the database
            $query = "INSERT INTO doc_requests (request_name, username, email, mobile, message, status, created_at) VALUES (?, ?, ?, ?, ?, ?, ?)";
            $stmt = $this->connection->prepare($query);
            $stmt->bind_param('sssssss', $request_name, $username, $email, $mobile, $service_message, $status, $datetime);
            if ($stmt->execute()) {
                // Request sent successfully
                header("Location: documents");
                $_SESSION['success'] = "The document request has been sent successfully.";
                exit();
            } else {
                // Error occurred
                echo "Error: " . $this->connection->error;
            }
        } 
        else {
            // A similar request already exists with the same fullname, email, mobile, and request_name
            header("Location: documents");
            $_SESSION['error'] = "You can only request the same document type once.";
        }
    }
     
}

public function get_doc_requests($username, $mobile, $email) {
        
    if ($this->connection->error) {
        die("Connection failed: " . $this->connection->error);
    }

    // Use prepared statement to prevent SQL injection
    $query = "SELECT * FROM doc_requests WHERE username = ? AND mobile = ? AND email = ?";
    $stmt = $this->connection->prepare($query);
    $stmt->bind_param('sss', $username, $mobile, $email);
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


public function reports() {
    if (isset($_POST['report_form'])) {
        date_default_timezone_set('Asia/Manila');
        $firstname = $_SESSION['firstname'];
        $middlename = $_SESSION['middlename'];
        $lastname = $_SESSION['lastname'];
        $email = $_SESSION['email'];
        $mobile = $_SESSION['mobile'];
        $status = 'PENDING';
        $reported_person_name = $_POST['reported_person_name'];
        $subject_person = $_POST['subject_person'];
        $place_of_incident = $_POST['place_of_incident'];
        $time_of_incident = $_POST['time_of_incident'];
        $date_of_incident = $_POST['date_of_incident'];
        $note = $_POST['note'];
        $date = date('Y-m-d');
        $time_in = date('H:i:s'); // Philippine time

        // Combine date and time into a single datetime string
        $datetime = $date . ' ' . $time_in;

        // Check if a similar request already exists based on request_name, fullname, email, and mobile
        $checkQuery = "SELECT COUNT(*) as count FROM report_requests WHERE reported_person = ? AND subject_person = ? AND firstname = ? AND middlename = ? AND lastname = ? AND email = ? AND mobile = ?";
        $stmt = $this->connection->prepare($checkQuery);
        $stmt->bind_param('sssssss', $reported_person_name, $subject_person, $firstname, $middlename, $lastname, $email, $mobile);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $count = $row['count'];

        if ($count === 0) {
            // No similar request exists with the same fullname, email, mobile, and request_name
            // Proceed to insert the new request into the database
            $query = "INSERT INTO report_requests (reported_person, subject_person, place_of_incident, date_of_incident, time_of_incident, firstname, middlename, lastname, email, mobile, note, status, created_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $this->connection->prepare($query);
            $stmt->bind_param('sssssssssssss', $reported_person_name, $subject_person, $place_of_incident, $date_of_incident, $time_of_incident, $firstname, $middlename, $lastname, $email, $mobile, $note, $status, $datetime);
            if ($stmt->execute()) {
                // Request sent successfully
                header("Location: reports");
                $_SESSION['success'] = "The report has been sent successfully.";
                exit();
            } else {
                // Error occurred
                echo "Error: " . $this->connection->error;
            }
        } else {          
            header("Location: reports");  
            $_SESSION['error'] = "A similar report already exists.";
        }
    }
}

public function equipments() {
    // Render the home page content
    if (isset($_POST['request_equipment'])) {
        date_default_timezone_set('Asia/Manila');
        $username = $_SESSION['username'];
        $email = $_SESSION['email'];
        $mobile = $_SESSION['mobile'];
        $status = 'PENDING';
        $equipment_id = $_POST['equipment_id'];
        $total_equipment_borrowed = $_POST['total_equipment_borrowed'];
        $date = date('Y-m-d');
        $time_in = date('H:i:s'); // Philippine time

        // Combine date and time into a single datetime string
        $datetime = $date . ' ' . $time_in;
        $processed_date = '-';
        // Check if a similar request already exists based on equipment_id, fullname, email, and mobile
        $checkQuery = "SELECT COUNT(*) as count FROM equipment_requests WHERE equipment_id = ? AND username = ? AND email = ? AND mobile = ? AND total_equipment_borrowed = ?";
        $stmt = $this->connection->prepare($checkQuery);
        $stmt->bind_param('sssss', $equipment_id, $username, $email, $mobile, $total_equipment_borrowed);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $count = $row['count'];

        
            // No similar request exists with the same fullname, email, mobile, and request_name
            // Proceed to insert the new request into the database
            $equipmentNameQuery = "SELECT equipment_name FROM equipment_settings WHERE equipment_id = ?";
            $stmt = $this->connection->prepare($equipmentNameQuery);
            $stmt->bind_param('s', $equipment_id);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();
            $equipment_name = $row['equipment_name'];

            $query = "INSERT INTO equipment_requests (equipment_id, equipment_name, username, email, mobile, total_equipment_borrowed, status, request_date, processed_date) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $this->connection->prepare($query);
            $stmt->bind_param('sssssssss', $equipment_id, $equipment_name, $username, $email, $mobile, $total_equipment_borrowed, $status, $datetime, $processed_date);
        
        if ($stmt->execute()) {
            // Request sent successfully
            header("Location: equipments");
            $_SESSION['success'] = "The equipment request has been sent successfully.";
            exit();
        } else {
            // Error occurred
            echo "Error: " . $this->connection->error;
        }
        
    }     
}


      public function get_equipment_requests($username, $mobile, $email) {
        
        if ($this->connection->error) {
            die("Connection failed: " . $this->connection->error);
        }

        // Use prepared statement to prevent SQL injection
        $query = "SELECT * FROM equipment_requests WHERE username = ? AND mobile = ? AND email = ?";
        $stmt = $this->connection->prepare($query);
        $stmt->bind_param('sss', $username, $mobile, $email);
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
            // Message successful
            header("Location: contact");
            $_SESSION["success"] = "Message sent successfully.";
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