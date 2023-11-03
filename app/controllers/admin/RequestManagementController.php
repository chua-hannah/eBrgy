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
    
   

    // Function to fetch user data from the database
    private function getReportUserData($report_id) {
        $sql = "SELECT u.firstname, u.middlename, u.lastname, u.address, d.*
        FROM users u
        JOIN report_requests d ON u.username = d.username
        WHERE d.id = ?";
       
       $stmt = $this->connection->prepare($sql);
       $stmt->bind_param("i", $report_id);
       $stmt->execute();
       $result = $stmt->get_result();
        
        // Fetch user data as an associative array
        $userData = $result->fetch_assoc();
        
        $stmt->close();

        return $userData;
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


    public function edit_report($report_id) {
        // Ensure that userId is available as a variable
        if ($report_id) {
            // Fetch user data based on the userId from the users table
            $userData = $this->getReportUserData($report_id);

            // Check if user data was found
            if ($userData) {
            
                include 'templates/admin/report_edit.php';
            } else {
                // Handle the case when the user with the provided userId is not found
                echo "Request not found!";
            }
        } else {
            // Handle the case when userId is not provided
            echo "Request not provided!";
        }
    }

    function approve_report($report_id) {

        if (isset($_POST['approve_report'])) {
            date_default_timezone_set('Asia/Manila');

            $report_id = $_POST['report_id'];
            $processBy = $_SESSION['username'];
            $date = date('Y-m-d');
            $time_in = date('H:i:s'); 
            $processAt = $date . ' ' . $time_in;
            // Use prepared statements to prevent SQL injection
            $stmt = $this->connection->prepare("UPDATE report_requests SET status = 'approved', process_by = ?, process_at = ? WHERE id = ?");
            $stmt->bind_param("ssi", $processBy, $processAt, $report_id); // Assuming user_id is an integer

        
            if ($stmt->execute()) {
                header("Location: /eBrgy/app/requests-reports");
                $_SESSION['success'] = "The report was successfully approved.";
                exit();
            } else {
                $_SESSION['error'] = "Error updating report status: " . $stmt->error;
            }
        
            // Close the prepared statement
            $stmt->close();
        }
    }

    function delete_report($report_id) {
        $processBy = $_SESSION['username'];
    
        date_default_timezone_set('Asia/Manila');

        // Get the current timestamp
        $processAt = date('Y-m-d H:i:s');

        if (isset($_POST['delete_report'])) {
            // Retrieve the user ID from the form
            $report_id = $_POST['report_id'];
        
            $stmt = $this->connection->prepare("UPDATE report_requests SET status = 'rejected', process_by = ?, process_at = ? WHERE id = ?");
            $stmt->bind_param("ssi", $processBy, $processAt, $report_id); // Assuming user_id is an integer
        
            if ($stmt->execute()) {
                header("Location: /eBrgy/app/requests-reports");
                $_SESSION['success'] = "The report was successfully rejected.";
                exit();
            } else {
                $_SESSION['error'] = "Error updating user status: " . $stmt->error;
            }
        
            // Close the prepared statement
            $stmt->close();
        }
    }

    //DOC
    private function getDocUserData($doc_id) {
        $sql = "SELECT u.firstname, u.middlename, u.lastname, u.address, d.*
        FROM users u
        JOIN doc_requests d ON u.username = d.username
        WHERE d.id = ?";
        
        $stmt = $this->connection->prepare($sql);
        $stmt->bind_param("i", $doc_id);
        $stmt->execute();
        $result = $stmt->get_result();
        
        // Fetch user data as an associative array
        $userData = $result->fetch_assoc();
        
        $stmt->close();
    
        return $userData;
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


    public function edit_doc($doc_id) {
     
        // Ensure that userId is available as a variable
        if ($doc_id ) {
            // Fetch user data based on the userId from the users table
            $userData = $this->getDocUserData($doc_id);

            // Check if user data was found
            if ($userData) {
            
                include 'templates/admin/doc_edit.php';
            } else {
                // Handle the case when the user with the provided userId is not found
                echo "Document not found!";
            }
        } else {
            // Handle the case when userId is not provided
            echo "Document not provided!";
        }
    }   

    function approve_doc($doc_id) {

        if (isset($_POST['approve_doc'])) {
            $doc_id = $_POST['doc_id'];
    
            date_default_timezone_set('Asia/Manila');
            $processBy = $_SESSION['username'];
            $date = date('Y-m-d');
            $time_in = date('H:i:s'); 
            $processAt = $date . ' ' . $time_in;
            // Use prepared statements to prevent SQL injection
            $stmt = $this->connection->prepare("UPDATE doc_requests SET status = 'approved', process_by = ?, process_at = ? WHERE id = ?");
            $stmt->bind_param("ssi", $processBy, $processAt, $doc_id); // Assuming user_id is an integer
    
            if ($stmt->execute()) {
                header("Location: /eBrgy/app/requests-documents");
                $_SESSION['success'] = "The document request was successfully approved.";
                exit();
            } else {
                $_SESSION['error'] = "Error updating user status: " . $stmt->error;
            }
    
            // Close the prepared statement
            $stmt->close();
        }
    }
    

    function delete_doc($doc_id) {

        if (isset($_POST['delete_doc'])) {
            $processBy = $_SESSION['username'];
    
            // Get the current timestamp
            $processAt = date('Y-m-d H:i:s');
    
            // Use prepared statements to prevent SQL injection
            $stmt = $this->connection->prepare("UPDATE doc_requests SET status = 'rejected', process_by = ?, process_at = ? WHERE id = ?");
            $stmt->bind_param("ssi", $processBy, $processAt, $doc_id); // Assuming user_id is an integer
    
            if ($stmt->execute()) {
                header("Location: /eBrgy/app/requests-documents");
                $_SESSION['success'] = "The document request was successfully rejected.";
                exit();
            } else {
                // Activation failed
                $_SESSION['error'] = "Error updating user status: " . $stmt->error;
            }
    
            // Close the prepared statement
            $stmt->close();
        }
    }

    //EQUIP
    private function getEquipmentUserData($equipment_id) {
        $sql = "SELECT u.firstname, u.middlename, u.lastname, u.address, u.mobile, u.email, d.*
        FROM users u
        JOIN equipment_requests d ON u.username = d.username
        WHERE d.id = ?";
       
       $stmt = $this->connection->prepare($sql);
       $stmt->bind_param("i", $equipment_id);
       $stmt->execute();
       $result = $stmt->get_result();
        
        // Fetch user data as an associative array
        $userData = $result->fetch_assoc();
        
        $stmt->close();

        return $userData;
    }

    public function edit_equipment($equipment_id) {
     
        // Ensure that userId is available as a variable
        if ($equipment_id ) {
            // Fetch user data based on the userId from the users table
            $userData = $this->getEquipmentUserData($equipment_id);

            // Check if user data was found
            if ($userData) {
                include 'templates/admin/equipment_edit.php';
            } else {
                // Handle the case when the user with the provided userId is not found
                echo "Equipment not found!";
            }
        } else {
            // Handle the case when userId is not provided
            echo "Equipment not provided!";
        }
    }   

    function add_remarks($equipment_id, $remarks) {
        if (isset($_POST['add_remarks'])) {
            $equipment_id = $_POST['equipment_id'];
            $remarks = $_POST['remarks'];
    
            // Use prepared statements to prevent SQL injection
            $stmt = $this->connection->prepare("UPDATE equipment_requests SET remarks = ? WHERE id = ?");
            $stmt->bind_param("si", $remarks, $equipment_id);
    
            if ($stmt->execute()) {
                // Remarks updated successfully
                header("Location: /eBrgy/app/requests-equipments");
                $_SESSION['success'] = "A remarks was added successfully.";
                exit();
            } else {
                // Update failed
                $_SESSION['error'] = "Error updating remarks: " . $stmt->error;
            }
    
            // Close the prepared statement
            $stmt->close();
        }
    }
    
    function approve_equipment($equipment_id, $message, $total_equipment_id) {
        if (isset($_POST['approve_equipment'])) {
            date_default_timezone_set('Asia/Manila');
            $equipment_id = $_POST['equipment_id'];
            $processBy = $_SESSION['username'];
            $message = $_POST['message'];
            $total_equipment_id = $_POST['total_equipment_id'];
            // Get the current timestamp
            $date = date('Y-m-d');
            $time_in = date('H:i:s'); 
            $processAt = $date . ' ' . $time_in;
            // Use prepared statements to prevent SQL injection
            $stmt = $this->connection->prepare("UPDATE equipment_requests SET status = 'approved', process_by = ?, process_at = ?, message = ? WHERE id = ?");
            $stmt->bind_param("sssi", $processBy, $processAt, $message, $equipment_id); // Assuming user_id is an integer
    
            if ($stmt->execute()) {
                header("Location: /eBrgy/app/requests-equipments");
                $_SESSION['success'] = "Equipment request was successfully approved.";
                exit();
            } else {
                // Activation failed
                $_SESSION['error'] = "Error updating request status: " . $stmt->error;
            }
    
            // Close the prepared statement
            $stmt->close();
    
            // Now, update the equipment_settings table to subtract the total_equipment_borrowed for the specific approved equipment
            $updateEquipmentQuery = "UPDATE equipment_settings es
            SET es.total_equipment = es.total_equipment - (
                SELECT COALESCE(SUM(er.total_equipment_borrowed), 0)
                FROM equipment_requests er
                WHERE er.status = 'approved' AND er.equipment_id = ? AND er.id = ? AND es.equipment_id = er.equipment_id
            )";
            $stmt2 = $this->connection->prepare($updateEquipmentQuery);
            $stmt2->bind_param("ii", $total_equipment_id, $equipment_id);
    
            if ($stmt2->execute()) {
                // Equipment settings updated successfully
            } else {
                // Equipment settings update failed
                $_SESSION['error'] =  "Error updating equipment settings: " . $stmt2->error;
            }
    
            // Close the prepared statement
            $stmt2->close();
        }
    }
    
    

    function returned_equipment($equipment_id, $total_equipment_id) {
    
        if (isset($_POST['returned_equipment'])) {
            date_default_timezone_set('Asia/Manila');
            $processReturned = $_SESSION['username'];
            $date = date('Y-m-d');
            $time_in = date('H:i:s');
            $returnedAt = $date . ' ' . $time_in;
            $equipment_id = $_POST['equipment_id'];
            $total_equipment_id = $_POST['total_equipment_id'];
    
            // Use prepared statements to prevent SQL injection
            $stmt = $this->connection->prepare("UPDATE equipment_requests SET status = 'returned', process_return = ?, returned_at = ? WHERE id = ?");
            $stmt->bind_param("ssi", $processReturned, $returnedAt, $equipment_id); // Assuming user_id is an integer
    
            if ($stmt->execute()) {
                header("Location: /eBrgy/app/requests-equipments");
                $_SESSION['success'] = "Equipment was returned successfully.";
                exit();
            } else {
                // Activation failed
                $_SESSION['error'] = "Error updating request status: " . $stmt->error;
            }
    
            // Close the prepared statement
            $stmt->close();
    
            // Update equipment_settings to add back the returned equipment
            // Now, update the equipment_settings table to add the total_equipment_borrowed back for the specific returned equipment
            $updateEquipmentQuery = "UPDATE equipment_settings es
            SET es.total_equipment = es.total_equipment + (
                SELECT COALESCE(SUM(er.total_equipment_borrowed), 0)
                FROM equipment_requests er
                WHERE er.status = 'returned' AND er.equipment_id = ? AND er.id = ? AND es.equipment_id = er.equipment_id
            )";
            $stmt2 = $this->connection->prepare($updateEquipmentQuery);
            $stmt2->bind_param("ii", $total_equipment_id, $equipment_id);
    
            if ($stmt2->execute()) {
                // Equipment settings updated successfully
            } else {
                // Equipment settings update failed
                $_SESSION['error'] = "Error updating equipment settings: " . $stmt2->error;
            }
    
            // Close the prepared statement
            $stmt2->close();
        }
    }
    
    

    function delete_equipment($equipment_id) {

            if (isset($_POST['delete_equipment'])) {
            
            date_default_timezone_set('Asia/Manila');
            $processReturned = $_SESSION['username'];
            $date = date('Y-m-d');
            $time_in = date('H:i:s');
            $returnedAt = $date . ' ' . $time_in;
            $equipment_id = $_POST['equipment_id'];
            $total_equipment_id = $_POST['total_equipment_id'];
    
            // Use prepared statements to prevent SQL injection
            $stmt = $this->connection->prepare("UPDATE equipment_requests SET status = 'rejected', process_return = ?, returned_at = ? WHERE id = ?");
            $stmt->bind_param("ssi", $processReturned, $returnedAt, $equipment_id); // Assuming user_id is an integer
    
            if ($stmt->execute()) {
                // Activation successful
                header("Location: /eBrgy/app/requests-equipments");
                $_SESSION['success'] = "Equipment request was successfully rejected.";
                exit();
            } else {
                // Activation failed
                $_SESSION['error'] = "Error updating request status: " . $stmt->error;
            }
    
            // Close the prepared statement
            $stmt->close();
    
            // Update equipment_settings to add back the returned equipment
            // Now, update the equipment_settings table to add the total_equipment_borrowed back for the specific returned equipment
            $updateEquipmentQuery = "UPDATE equipment_settings es
            SET es.total_equipment = es.total_equipment + (
                SELECT COALESCE(SUM(er.total_equipment_borrowed), 0)
                FROM equipment_requests er
                WHERE er.status = 'rejected' AND er.equipment_id = ? AND er.id = ? AND es.equipment_id = er.equipment_id
            )";
            $stmt2 = $this->connection->prepare($updateEquipmentQuery);
            $stmt2->bind_param("ii", $total_equipment_id, $equipment_id);
    
            if ($stmt2->execute()) {
                // Equipment settings updated successfully
            } else {
                // Equipment settings update failed
                $_SESSION['error'] = "Error updating equipment settings: " . $stmt2->error;
            }
    
            // Close the prepared statement
            $stmt2->close();
        }
    }
  

    public function equipment_requests() {
        // Render the home page content
        if ($this->connection->error) {
            die("Connection failed: " . $this->connection->error);
        }
    
        // Use a prepared statement to prevent SQL injection
        $query = "SELECT u.firstname, u.middlename, u.lastname, u.address, d.*
        FROM users u
        JOIN equipment_requests d ON u.username = d.username";
        $stmt = $this->connection->prepare($query);
        $stmt->execute();
    
        // Fetch pending request records as an associative array
        $result = $stmt->get_result();
        $pending_requests = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $pending_requests[] = $row;
            }
        }
    
        // Return the fetched pending request data
        return $pending_requests;
    }
    

    public function get_latest_list_schedules() {
      
            $currentDate = date('Y-m-d');
            
            $query = "SELECT u.firstname, u.middlename, u.lastname, u.address, u.mobile, u.email, s.* 
            FROM users u
            JOIN schedule_requests s ON u.username = s.username WHERE s.schedule_date >= ?   ORDER BY s.schedule_date ASC LIMIT 10";
            $stmt = $this->connection->prepare($query);
            $stmt->bind_param("s", $currentDate);
            $stmt->execute();
    
            $result = $stmt->get_result();
            $approved_schedules = array();
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $approved_schedules[] = $row;
                }
            }
            // Return the fetched request settings data
            return $approved_schedules;
        
    }

    public function get_latest_list_schedules_onClick() {
        if (isset($_POST['showLatest'])) {
            // Get the current date
            $currentDate = date('Y-m-d');
            
            $query = "SELECT * FROM schedule_requests WHERE schedule_date >= ? ORDER BY schedule_date ASC LIMIT 10";
            $stmt = $this->connection->prepare($query);
            $stmt->bind_param("s", $currentDate);
            $stmt->execute();
    
            $result = $stmt->get_result();
            $approved_schedules = array();
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $approved_schedules[] = $row;
                }
            }
            // Return the fetched request settings data
            return $approved_schedules;
        } else {
            // Handle other cases
            return "No Schedules found";
        }
    }
    

    public function get_list_schedules($reserved_schedule) {
      
        if (isset($_POST['showData'])) {
            // Convert birthdate to YYYY-MM-DD format
            $selectedDate = $reserved_schedule;
            $selectedDateTimestamp = strtotime($selectedDate);
            // Valid date format, convert it to YYYY-MM-DD
            $selectedDate = date('Y-m-d', $selectedDateTimestamp);
            // Get the selected date from the "Show Schedules" form
    
            $query = "SELECT u.firstname, u.middlename, u.lastname, u.address, u.mobile, u.email, s.* 
            FROM users u
            JOIN schedule_requests s ON u.username = s.username WHERE s.schedule_date = ?";
            $stmt = $this->connection->prepare($query);
            $stmt->bind_param("s", $selectedDate);
            $stmt->execute();
    
            $result = $stmt->get_result();
            $approved_schedules = array();
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $approved_schedules[] = $row;
                }
            }
            // Return the fetched request settings data
            return $approved_schedules;
            
            }  else {
                // Handle other cases
                return "No Schedules found";
            }
        }

        function approve_schedule($schedule_id) {
    
            if (isset($_POST['approve_schedule'])) {
                $schedule_id = $_POST['schedule_id'];
                date_default_timezone_set('Asia/Manila');
                $processBy = $_SESSION['username'];
                $date = date('Y-m-d');
                $time_in = date('H:i:s'); 
                $processAt = $date . ' ' . $time_in;
            
                $stmt = $this->connection->prepare("UPDATE schedule_requests SET status = 'approved', process_by = ?, process_at = ? WHERE id = ?");
                $stmt->bind_param("ssi", $processBy, $processAt, $schedule_id); // Assuming user_id is an integer
                if ($stmt->execute()) {
                    header("Location: /eBrgy/app/requests-schedules");
                    $_SESSION['success'] = "Schedule request was successfully approved.";
                    exit();
                } else {
                    $_SESSION['error'] = "Error updating request status: " . $stmt->error;
                }
            
                // Close the prepared statement
                $stmt->close();
            }    
        }

        function reject_schedule($schedule_id) {
    
            if (isset($_POST['reject_schedule'])) {
                $schedule_id = $_POST['schedule_id'];
                date_default_timezone_set('Asia/Manila');
                $processBy = $_SESSION['username'];
                $date = date('Y-m-d');
                $time_in = date('H:i:s'); 
                $processAt = $date . ' ' . $time_in;
            
                $stmt = $this->connection->prepare("UPDATE schedule_requests SET status = 'rejected', process_by = ?, process_at = ? WHERE id = ?");
                $stmt->bind_param("ssi", $processBy, $processAt, $schedule_id); // Assuming user_id is an integer
                if ($stmt->execute()) {
                    header("Location: /eBrgy/app/requests-schedules");
                    $_SESSION['success'] = "Schedule request was successfully rejected.";
                    exit();
                } else {
                    $_SESSION['error'] = "Error updating request status: " . $stmt->error;
                }
            
                // Close the prepared statement
                $stmt->close();
            }    
        }
  }  
?>