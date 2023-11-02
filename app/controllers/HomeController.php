<?php
class HomeController {

  private $connection;

  public function __construct($connection)
  {
      $this->connection = $connection;
  }
  

  
    public function req_schedule()
{
    if (isset($_POST['request_schedule'])) {
        // Set the timezone to Manila
        
        $username = $_SESSION['username'];
        $mobile = $_SESSION['mobile'];
        $schedule_date = $_POST['schedule_date'];
        $time_in = date("H:i:s", strtotime($_POST['time_in']));
        $time_out = date("H:i:s", strtotime($_POST['time_out']));
        $status = 'pending';

        // Get the current time in Manila timezone
        $currentDateTime = date('Y-m-d H:i:s');
        
        // Convert schedule date to YYYY-MM-DD format
        $scheduledDateTimeStamp = strtotime($schedule_date);
        // Valid date format, convert it to YYYY-MM-DD
        $schedule_date = date('Y-m-d', $scheduledDateTimeStamp);

        // Validate input fields to ensure they are not empty or null
        if (empty($schedule_date) || empty($time_in) || empty($time_out)) {
            $_SESSION['error'] = "Please fill in all required fields.";
            return; // Exit without performing database operations
        }

        // Sanitize user input
        $schedule_date = htmlspecialchars($schedule_date);

        if ($time_in >= $time_out) {
            $_SESSION['error'] = "Time in must be earlier than time out.";
            return; // Exit without performing database operations
        }

        // Check if the user has already submitted a request for the same day
        $existingRequestQuery = "SELECT COUNT(*) as count FROM schedule_requests WHERE schedule_date = ? AND username = ?";
        $stmt = $this->connection->prepare($existingRequestQuery);
        $stmt->bind_param('ss', $schedule_date, $username);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $count = $row['count'];

        if ($count > 0) {
            $_SESSION['error'] = "You have already submitted a request for this day.";
            return; // Exit without performing database operations
        }

        // Check if there's an approved request for the same schedule
        $existingApprovedRequestQuery = "SELECT COUNT(*) as count FROM schedule_requests WHERE schedule_date = ? AND time_in = ? AND time_out = ? AND status = 'approved'";
        $stmt = $this->connection->prepare($existingApprovedRequestQuery);
        $stmt->bind_param('sss', $schedule_date, $time_in, $time_out);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $count = $row['count'];

        if ($count > 0) {
            $_SESSION['error'] = "The schedule is already taken by another user.";
            return; // Exit without performing database operations
        }

        // Proceed to insert the new request into the database
        $query = "INSERT INTO schedule_requests (username, mobile, schedule_date, time_in, time_out, status, created_at) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->connection->prepare($query);
        $stmt->bind_param('sssssss', $username, $mobile, $schedule_date, $time_in, $time_out, $status, $currentDateTime);
        if ($stmt->execute()) {
            // Request sent successfully
            $_SESSION['success'] = "The Schedule request has been sent successfully.";
            echo '<script>window.location.href = "schedules";</script>';
            exit();
        } else {
            // Error occurred
            $_SESSION['error'] = "Error: " . $stmt->error;
        }
    }
}

    


    // public function schedule_request()
    // {
    //     if (isset($_POST['schedule_request'])) {
    //         $username = $_SESSION['username'];
    //         $mobile = $_SESSION['mobile'];
    //         $schedule_date = $_POST['schedule_date'];
    //         $time_in = $_POST['time_in'];
    //         $time_out = $_POST['time_out'];
    //         $status = 'PENDING';
    
    //         // Validate input fields to ensure they are not empty or null
    //         if (empty($schedule_date) || is_null($schedule_date) || empty($time_in) || is_null($time_in) || empty($time_out) || is_null($time_out)) {
    //             $_SESSION['error'] = "Please fill in all required fields.";
    //             return; // Exit without performing database operations
    //         }
    //     }
    
    //     // Check if a similar request already exists based on schedule_date, time_in, time_out, username, mobile, and status
    //     $checkQuery = "SELECT COUNT(*) as count FROM schedule_requests WHERE schedule_date = ? AND time_in = ? AND time_out = ? AND username = ? AND mobile = ? AND status = ?";
    //     $stmt = $this->connection->prepare($checkQuery);
    //     $stmt->bind_param('ssssss', $schedule_date, $time_in, $time_out, $username, $mobile, $status);
    //     $stmt->execute();
    //     $result = $stmt->get_result();
    //     $row = $result->fetch_assoc();
    //     $count = $row['count'];
    
    //     if ($count === 0) {
    //         // No similar request exists with the same parameters
    //         // Proceed to insert the new request into the database
    //         $query = "INSERT INTO schedule_requests (username, mobile, schedule_date, time_in, time_out, status) VALUES (?, ?, ?, ?, ?, ?)";
    //         $stmt = $this->connection->prepare($query);
    //         $stmt->bind_param('ssssss', $username, $mobile, $schedule_date, $time_in, $time_out, $status);
    //         if ($stmt->execute()) {
    //             // Request sent successfully
    //             $_SESSION['success'] = "The Schedule request has been sent successfully.";
    //         } else {
    //             // Error occurred
    //             echo "Error: " . $this->connection->error;
    //         }
    //     } else {
    //         $_SESSION['error'] = "You can only request one schedule a day.";
    //     }
    // }
    


    public function get_schedules($reserved_schedule) {
        $errors = array(); // Initialize an errors array
    
        if (isset($_POST['showData'])) {
            if (empty($_POST['reserved_schedule'])) {
                $errors["reserved_schedule"] = "Enter a date";
            } else {
                $selectedDateTimeStamp = strtotime($reserved_schedule);
                $selectedDate = date('Y-m-d', $selectedDateTimeStamp);
                $status = 'approved';
    
                $query = "SELECT * FROM schedule_requests WHERE schedule_date = ? AND status = ?";
                $stmt = $this->connection->prepare($query);
                $stmt->bind_param("ss", $selectedDate, $status);
                $stmt->execute();
    
                $result = $stmt->get_result();
                $approved_schedules = array();
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $approved_schedules[] = $row;
                    }
                    // Return the fetched request settings data
                    return $approved_schedules;
                    
                } else {
                    // No schedules found
                    return "No Schedules found";
                }
            }
        }
    }
    
    public function get_schedule_requests($username) {
        
        if ($this->connection->error) {
            die("Connection failed: " . $this->connection->error);
        }

        // Use prepared statement to prevent SQL injection
        $query = "SELECT * FROM schedule_requests WHERE username = ? ORDER BY schedule_date";
        $stmt = $this->connection->prepare($query);
        $stmt->bind_param('s', $username);
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
        $status = 'pending';
        $request_name = $_POST['selected_service'];
        $service_message = $_POST['service_message'];
        $date = date('Y-m-d');
        $time_in = date('H:i:s'); // Philippine time

        // Combine date and time into a single datetime string
        $datetime = $date . ' ' . $time_in;
        // Add mobile prefix
        $prefixMobileNumber = "+63";
        $mobile = $prefixMobileNumber . $mobile;

        // Check if a similar request already exists based on request_name, fullname, email, and mobile
        $checkQuery = "SELECT COUNT(*) as count FROM doc_requests WHERE request_name = ? AND username = ? AND email = ? AND mobile = ? AND status IN ('PENDING')";
        $stmt = $this->connection->prepare($checkQuery);
        $stmt->bind_param('ssss', $request_name, $username, $email, $mobile);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $count = $row['count'];

        if ($count === 0) {
            // No similar request exists with the same fullname, email, mobile, and request_name
            // Proceed to insert the new request into the database
            $query = "INSERT INTO doc_requests (request_name, username, email, mobile, status, message, created_at) VALUES (?, ?, ?, ?, ?, ?, ?)";
            $stmt = $this->connection->prepare($query);
            $stmt->bind_param('sssssss', $request_name, $username, $email, $mobile, $status, $service_message, $datetime);
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
        $username = $_SESSION['username'];
        $email = $_SESSION['email'];
        $mobile = $_SESSION['mobile'];
        $status = 'pending';
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
        // Convert birthdate to YYYY-MM-DD format
        $birthdateTimestamp = strtotime($date_of_incident);
        // Valid date format, convert it to YYYY-MM-DD
        $date_of_incident = date('Y-m-d', $birthdateTimestamp);

        // Check if a similar request already exists based on request_name, fullname, email, and mobile
        $checkQuery = "SELECT COUNT(*) as count FROM report_requests WHERE reported_person = ? AND subject_person = ? AND username = ?  AND email = ? AND mobile = ?";
        $stmt = $this->connection->prepare($checkQuery);
        $stmt->bind_param('sssss', $reported_person_name, $subject_person, $username, $email, $mobile);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $count = $row['count'];

        if ($count === 0) {
            // No similar request exists with the same fullname, email, mobile, and request_name
            // Proceed to insert the new request into the database
            $query = "INSERT INTO report_requests (reported_person, subject_person, place_of_incident, date_of_incident, time_of_incident, username, email, mobile, note, status, created_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $this->connection->prepare($query);
            $stmt->bind_param('sssssssssss', $reported_person_name, $subject_person, $place_of_incident, $date_of_incident, $time_of_incident, $username, $email, $mobile, $note, $status, $datetime);
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

public function get_reports($username, $mobile, $email) {
        
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

public function equipments() {
    // Render the home page content
    if (isset($_POST['request_equipment'])) {
        date_default_timezone_set('Asia/Manila');
        $username = $_SESSION['username'];
        $status = 'pending';
        $duration = $_POST['duration'];
        $equipment_id = $_POST['equipment_id'];
        $total_equipment_borrowed = $_POST['total_equipment_borrowed'];
        $date = date('Y-m-d');
        $time_in = date('H:i:s'); // Philippine time

        // Combine date and time into a single datetime string
        $datetime = $date . ' ' . $time_in;

        // Check if the requested quantity is valid
        if ($this->isRequestedQuantityValid($equipment_id, $total_equipment_borrowed)) {
            // Valid quantity, proceed with the request
            // Check if a similar request already exists based on equipment_id, username, and total_equipment_borrowed
            $checkQuery = "SELECT COUNT(*) as count FROM equipment_requests WHERE equipment_id = ? AND username = ? AND total_equipment_borrowed = ?";
            $stmt = $this->connection->prepare($checkQuery);
            $stmt->bind_param('sss', $equipment_id, $username, $total_equipment_borrowed);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();
            $count = $row['count'];

            // No similar request exists with the same equipment_id, username, and total_equipment_borrowed
            // Proceed to insert the new request into the database
            $equipmentNameQuery = "SELECT equipment_name FROM equipment_settings WHERE equipment_id = ?";
            $stmt = $this->connection->prepare($equipmentNameQuery);
            $stmt->bind_param('s', $equipment_id);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();
            $equipment_name = $row['equipment_name'];

            $query = "INSERT INTO equipment_requests (equipment_id, equipment_name, username, total_equipment_borrowed, status, days, request_date) VALUES ( ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $this->connection->prepare($query);
            $stmt->bind_param('sssssss', $equipment_id, $equipment_name, $username, $total_equipment_borrowed, $status, $duration, $datetime);

            if ($stmt->execute()) {
                // Request sent successfully
                header("Location: equipments");
                $_SESSION['success'] = "The equipment request has been sent successfully.";
                exit();
            } else {
                // Error occurred
                echo "Error: " . $this->connection->error;
            }
        } else {
            // Invalid quantity, show an error message
            echo "Error: The requested quantity exceeds the available equipment.";
        }
    }
}

public function isRequestedQuantityValid($equipment_id, $requestedQuantity) {
    // Check if the requested quantity is less than or equal to the available equipment
    $query = "SELECT total_equipment FROM equipment_settings WHERE equipment_id = ?";
    $stmt = $this->connection->prepare($query);
    $stmt->bind_param("s", $equipment_id);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows == 1) {
        $stmt->bind_result($availableQuantity);
        $stmt->fetch();

        if ($requestedQuantity <= $availableQuantity) {
            return true;
        }
    }

    return false;
}



      public function get_equipment_requests($username) {
        
        if ($this->connection->error) {
            die("Connection failed: " . $this->connection->error);
        }

        // Use prepared statement to prevent SQL injection
        $query = "SELECT * FROM equipment_requests WHERE username = ?";
        $stmt = $this->connection->prepare($query);
        $stmt->bind_param('s', $username);
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

    public function getHomeSettings() {
        // Prepare and execute an SQL query to retrieve all data from the "home_setting" table
        $query = "SELECT * FROM home_setting";
        $result = $this->connection->query($query);
    
        if ($result) {
            $settings = array();
    
            while ($row = $result->fetch_assoc()) {
                $settings[] = $row;
            }
    
            return $settings;
        } else {
            // Query failed
            return false;
        }
    }
    
  }
  
?>