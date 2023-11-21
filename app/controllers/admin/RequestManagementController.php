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

   
    public function getDocById() {
        if ($this->connection->error) {
            die("Connection failed: " . $this->connection->error);
        }
        
        if (isset($_POST['edit_request_doc'])) {
            $id = $_POST['request_type_id'];
            $id = $this->connection->real_escape_string($id);
    
            // Create a SQL query to retrieve the health information for the given ID
            $query = "SELECT * FROM doc_settings WHERE request_type_id = '$id'";
    
            $result = $this->connection->query($query);
    
            if ($result) {
                $docdatas[] = $result->fetch_assoc(); 
                return $docdatas; // Return the data as an associative array
            }
        }
    
        return array(); // Return an empty array if the condition is not met or if the query fails
    }

    function updateDocbyId() {

        if (isset($_POST['update_doc_by_id'])) {
            $doc_id = $_POST['doc_id'];
            $status = $_POST['status'];
            $documentName = $_POST['request_name'];
            $purposeRemarks = $_POST['purposeRemarks'];

          
         
            // Use prepared statements to prevent SQL injection
            $stmt = $this->connection->prepare("UPDATE doc_settings SET request_status = ?, request_name = ?, description = ? WHERE request_type_id = ?");
            $stmt->bind_param("sssi", $status, $documentName, $purposeRemarks, $doc_id); // Assuming user_id is an integer
    
            if ($stmt->execute()) {
                header("Location: /eBrgy/app/requests-documents-management");
                $_SESSION['success'] = "The document updated successfully approved.";
                exit();
            } else {
                $_SESSION['error'] = "Error updating user status: " . $stmt->error;
            }
    
            // Close the prepared statement
            $stmt->close();
        }
    }

    public function getEquipById() {
        if ($this->connection->error) {
            die("Connection failed: " . $this->connection->error);
        }
        
        if (isset($_POST['edit_request_equip'])) {
            $id = $_POST['equipment_id'];
            $id = $this->connection->real_escape_string($id);
    
            // Create a SQL query to retrieve the health information for the given ID
            $query = "SELECT * FROM equipment_settings WHERE equipment_id = '$id'";
    
            $result = $this->connection->query($query);
    
            if ($result) {
                $docdatas[] = $result->fetch_assoc(); 
                return $docdatas; // Return the data as an associative array
            }
        }
    
        return array(); // Return an empty array if the condition is not met or if the query fails
    }

    function updateEquipById() {

        if (isset($_POST['update_equipment_by_id'])) {
            $equipment_id = $_POST['equipment_id'];
            $availability = $_POST['availability'];
            $total_equipment = $_POST['total_equipment'];

          
         
            // Use prepared statements to prevent SQL injection
            $stmt = $this->connection->prepare("UPDATE equipment_settings SET availability = ?, total_equipment = ? WHERE equipment_id = ?");
            $stmt->bind_param("sii", $availability, $total_equipment,  $equipment_id); // Assuming user_id is an integer
    
            if ($stmt->execute()) {
                header("Location: /eBrgy/app/requests-equipments-management");
                $_SESSION['success'] = "The material updated successfully approved.";
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

    public function getEquipRequestById() {
        if ($this->connection->error) {
            die("Connection failed: " . $this->connection->error);
        }
        
        if (isset($_POST['edit_equip_request'])) {
            $id = $_POST['id'];
            $id = $this->connection->real_escape_string($id);
    
            // Create a SQL query to retrieve the health information for the given ID
            $sql = "SELECT u.firstname, u.middlename, u.lastname, u.address, u.mobile, u.email, d.*
            FROM users u
            JOIN equipment_requests d ON u.username = d.username
            WHERE d.id = ?";
    
            $stmt = $this->connection->prepare($sql);
            $stmt->bind_param("i", $id); // Assuming 'id' is an integer
    
            if ($stmt->execute()) {
                $result = $stmt->get_result();
                $docdata = $result->fetch_assoc();
                $stmt->close();
                
                if ($docdata) {
                    return $docdata; // Return the data as an associative array
                }
            } else {
                // Handle query execution error here
                // You can log the error or return an appropriate response
            }
        }
    
        return null; // Return null if the condition is not met or if the query fails
    }
     

    function add_remarks() {
        if (isset($_POST['add_remarks'])) {
            $id = $_POST['id'];
            $remarks = $_POST['remarks'];
    
            // Use prepared statements to prevent SQL injection
            $stmt = $this->connection->prepare("UPDATE equipment_requests SET remarks = ? WHERE id = ?");
            $stmt->bind_param("si", $remarks, $id);
    
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
    
    function approve_equipment() {
        if (isset($_POST['approve_equipment'])) {
            date_default_timezone_set('Asia/Manila');
            $id = $_POST['id'];
            $equipment_id = $_POST['equipment_id'];
            $processBy = $_SESSION['username'];
            $message = $_POST['message'];
            $date = date('Y-m-d');
            $time_in = date('H:i:s'); 
            $processAt = $date . ' ' . $time_in;
            
            // Use prepared statements to prevent SQL injection
            $stmt = $this->connection->prepare("UPDATE equipment_requests SET status = 'approved', process_by = ?, process_at = ?, message = ? WHERE id = ?");
            $stmt->bind_param("sssi", $processBy, $processAt, $message, $id);
    
            // Check if total_equipment is 0 for the specific equipment_id
            $checkEquipmentQuery = "SELECT total_equipment FROM equipment_settings WHERE equipment_id = ?";
            $stmt3 = $this->connection->prepare($checkEquipmentQuery);
            $stmt3->bind_param("i", $equipment_id);
            $stmt3->execute();
            $result = $stmt3->get_result();
            $row = $result->fetch_assoc();
            $totalEquipment = $row['total_equipment'];
    
            if ($totalEquipment === 0) {
                header("Location: /eBrgy/app/requests-equipments");
                $_SESSION['error'] = "Error: The material is not available. Total equipment is 0.";
            } else {
                // Equipment is available, proceed with updating the status
                if ($stmt->execute()) {
                    // Start a transaction
                    $this->connection->begin_transaction();
    
                    $updateEquipmentQuery = "UPDATE equipment_settings es
                    SET es.total_equipment = es.total_equipment - (
                        SELECT COALESCE(SUM(er.total_equipment_borrowed), 0)
                        FROM equipment_requests er
                        WHERE er.status = 'approved' AND er.equipment_id = ? AND er.id = ? AND es.equipment_id = er.equipment_id
                    )";
    
                    $stmt2 = $this->connection->prepare($updateEquipmentQuery);
                    $stmt2->bind_param("ii", $equipment_id, $id);
    
                    if ($stmt2->execute()) {
                        // Both updates were successful, commit the transaction
                        $this->connection->commit();
    
                        header("Location: /eBrgy/app/requests-equipments");
                        $_SESSION['success'] = "Material request was successfully approved.";
                        exit();
                    } else {
                        // Equipment settings update failed
                        $_SESSION['error'] = "Error updating equipment settings: " . $stmt2->error;
    
                        // Rollback the transaction
                        $this->connection->rollback();
                    }
    
                    // Close the prepared statement
                    $stmt2->close();
                } else {
                    // Activation failed
                    $_SESSION['error'] = "Error updating request status: " . $stmt->error;
                }
            }
            
            // Close the prepared statement
            $stmt3->close();
        }
    }
    
    
    
    

    function returned_equipment() {
        if (isset($_POST['returned_equipment'])) {
            date_default_timezone_set('Asia/Manila');
            $processReturned = $_SESSION['username'];
            $date = date('Y-m-d');
            $time_in = date('H:i:s');
            $returnedAt = $date . ' ' . $time_in;
            $id = $_POST['id'];
            $equipment_id = $_POST['equipment_id'];
    
            // Use prepared statements to prevent SQL injection
            $stmt = $this->connection->prepare("UPDATE equipment_requests SET status = 'returned', process_return = ?, returned_at = ? WHERE id = ?");
            $stmt->bind_param("ssi", $processReturned, $returnedAt, $id); // Assuming 'id' is an integer
    
            if ($stmt->execute()) {
                // Start a transaction
                $this->connection->begin_transaction();
    
                // Update request status successfully
                // Update equipment_settings to add back the returned equipment
                $updateEquipmentQuery = "UPDATE equipment_settings es
                SET es.total_equipment = es.total_equipment + (
                    SELECT COALESCE(SUM(er.total_equipment_borrowed), 0)
                    FROM equipment_requests er
                    WHERE er.status = 'returned' AND er.equipment_id = ? AND er.id = ? AND es.equipment_id = er.equipment_id
                )";
                $stmt2 = $this->connection->prepare($updateEquipmentQuery);
                $stmt2->bind_param("ii", $equipment_id, $id);
    
                if ($stmt2->execute()) {
                    // Both updates were successful, commit the transaction
                    $this->connection->commit();
    
                    header("Location: /eBrgy/app/requests-equipments");
                    $_SESSION['success'] = "Material was returned successfully.";
                    exit();
                } else {
                    // Equipment settings update failed
                    $_SESSION['error'] = "Error updating materials settings: " . $stmt2->error;
    
                    // Rollback the transaction
                    $this->connection->rollback();
                }
    
                // Close the prepared statement
                $stmt2->close();
            } else {
                // Activation failed
                $_SESSION['error'] = "Error updating request status: " . $stmt->error;
            }
    
            // Close the prepared statement
            $stmt->close();
        }
    }

    function cancel_equipment() {
        if (isset($_POST['cancel_equipment_request'])) {
            $processReturned = $_SESSION['username'];
            $returnedAt = '';
            $id = $_POST['id'];
            $equipment_id = $_POST['equipment_id'];
    
            // Use prepared statements to prevent SQL injection
            $stmt = $this->connection->prepare("UPDATE equipment_requests SET status = 'cancelled', process_return = ?, returned_at = ? WHERE id = ?");
            $stmt->bind_param("ssi", $processReturned, $returnedAt, $id); // Assuming 'id' is an integer
    
            if ($stmt->execute()) {
                // Start a transaction
                $this->connection->begin_transaction();
    
                // Update request status successfully
                // Update equipment_settings to add back the returned equipment
                $updateEquipmentQuery = "UPDATE equipment_settings es
                SET es.total_equipment = es.total_equipment + (
                    SELECT COALESCE(SUM(er.total_equipment_borrowed), 0)
                    FROM equipment_requests er
                    WHERE er.status = 'cancelled' AND er.equipment_id = ? AND er.id = ? AND es.equipment_id = er.equipment_id
                )";
                $stmt2 = $this->connection->prepare($updateEquipmentQuery);
                $stmt2->bind_param("ii", $equipment_id, $id);
    
                if ($stmt2->execute()) {
                    // Both updates were successful, commit the transaction
                    $this->connection->commit();
    
                    header("Location: /eBrgy/app/requests-equipments");
                    $_SESSION['success'] = "Material was returned successfully.";
                    exit();
                } else {
                    // Equipment settings update failed
                    $_SESSION['error'] = "Error updating equipment settings: " . $stmt2->error;
    
                    // Rollback the transaction
                    $this->connection->rollback();
                }
    
                // Close the prepared statement
                $stmt2->close();
            } else {
                // Activation failed
                $_SESSION['error'] = "Error updating request status: " . $stmt->error;
            }
    
            // Close the prepared statement
            $stmt->close();
        }
    }
    
    
    

    function delete_equipment() {

            if (isset($_POST['delete_equipment'])) {
            $processReturned = $_SESSION['username'];
            $returnedAt = '';
            $id = $_POST['id'];
            $equipment_id = $_POST['equipment_id'];    
    
            // Use prepared statements to prevent SQL injection
            $stmt = $this->connection->prepare("UPDATE equipment_requests SET status = 'rejected', process_by = ?, returned_at = ? WHERE id = ?");
            $stmt->bind_param("ssi", $processReturned, $returnedAt,  $id); // Assuming user_id is an integer
    
            if ($stmt->execute()) {
                // Activation successful
                header("Location: /eBrgy/app/requests-equipments");
                $_SESSION['success'] = "Material request was successfully rejected.";
                exit();
            } else {
                // Activation failed
                $_SESSION['error'] = "Error updating request status: " . $stmt->error;
            }
    
            // Close the prepared statement
            $stmt->close();
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
        JOIN equipment_requests d ON u.username = d.username
        WHERE d.status IN ('pending', 'approved')"; // Filter by status 'pending' or 'approved'
    
        $stmt = $this->connection->prepare($query);
        $stmt->execute();
    
        // Fetch request records with 'pending' or 'approved' status as an associative array
        $result = $stmt->get_result();
        $requests = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $requests[] = $row;
            }
        }
    
        // Return the fetched request data
        return $requests;
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