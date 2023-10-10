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

        $activationMessage = '';

        if (isset($_POST['approve_report'])) {
            $report_id = $_POST['report_id'];
        
            // Use prepared statements to prevent SQL injection
            $stmt = $this->connection->prepare("UPDATE report_requests SET status = 'approved' WHERE id = ?");
            $stmt->bind_param("i", $report_id); // Assuming user_id is an integer
        
            if ($stmt->execute()) {
                // Activation successful
                $activationMessage = "Report Approved successfully.";
                header("Location: /eBrgy/app/requests/reports");
            } else {
                // Activation failed
                $activationMessage = "Error updating user status: " . $stmt->error;
            }
        
            // Close the prepared statement
            $stmt->close();
        }
        return $activationMessage;

    }

    function delete_report($report_id) {

        $activationMessage = '';

        if (isset($_POST['delete_report'])) {
            // Retrieve the user ID from the form
            $report_id = $_POST['report_id'];
        
            $stmt = $this->connection->prepare("DELETE FROM report_requests WHERE id = ?");
            $stmt->bind_param("i", $report_id); // Assuming user_id is an integer
        
            if ($stmt->execute()) {
                // Activation successful
                $activationMessage = "User deleted successfully.";
                header("Location: /eBrgy/app/requests/reports");
            } else {
                // Activation failed
                $activationMessage = "Error updating user status: " . $stmt->error;
            }
        
            // Close the prepared statement
            $stmt->close();
        }
        return $activationMessage;

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

        $activationMessage = '';

        if (isset($_POST['approve_doc'])) {
            $doc_id = $_POST['doc_id'];
        
            // Use prepared statements to prevent SQL injection
            $stmt = $this->connection->prepare("UPDATE doc_requests SET status = 'approved' WHERE id = ?");
            $stmt->bind_param("i", $doc_id); // Assuming user_id is an integer
        
            if ($stmt->execute()) {
                // Activation successful
                $activationMessage = "Report Approved successfully.";
                header("Location: /eBrgy/app/requests/documents");
            } else {
                // Activation failed
                $activationMessage = "Error updating user status: " . $stmt->error;
            }
        
            // Close the prepared statement
            $stmt->close();
        }
        return $activationMessage;

    }

    function delete_doc($doc_id) {

        $activationMessage = '';

        if (isset($_POST['delete_doc'])) {
            // Retrieve the user ID from the form
            $doc_id = $_POST['doc_id'];
        
            $stmt = $this->connection->prepare("DELETE FROM doc_requests WHERE id = ?");
            $stmt->bind_param("i", $doc_id); // Assuming user_id is an integer
        
            if ($stmt->execute()) {
                // Activation successful
                $activationMessage = "User deleted successfully.";
                header("Location: /eBrgy/app/requests/documents");
            } else {
                // Activation failed
                $activationMessage = "Error updating user status: " . $stmt->error;
            }
        
            // Close the prepared statement
            $stmt->close();
        }
        return $activationMessage;

    }

    //EQUIP
    private function getEquipmentUserData($equipment_id) {
        $sql = "SELECT u.firstname, u.middlename, u.lastname, u.address, d.*
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

    function approve_equipment($equipment_id) {

        $activationMessage = '';

        if (isset($_POST['approve_equipment'])) {
            $equipment_id = $_POST['equipment_id'];
        
            // Use prepared statements to prevent SQL injection
            $stmt = $this->connection->prepare("UPDATE equipment_requests SET status = 'approved' WHERE id = ?");
            $stmt->bind_param("i", $equipment_id); // Assuming user_id is an integer
        
            if ($stmt->execute()) {
                // Activation successful
                $activationMessage = "Equipment Request Approved successfully.";
                header("Location: /eBrgy/app/requests/equipments");
            } else {
                // Activation failed
                $activationMessage = "Error updating request status: " . $stmt->error;
            }
        
            // Close the prepared statement
            $stmt->close();
        }
        return $activationMessage;

    }

    function delete_equipment($equipment_id) {

        $activationMessage = '';

        if (isset($_POST['delete_equipment'])) {
            // Retrieve the user ID from the form
            $equipment_id = $_POST['equipment_id'];
        
            $stmt = $this->connection->prepare("DELETE FROM equipment_requests WHERE id = ?");
            $stmt->bind_param("i", $equipment_id); // Assuming user_id is an integer
        
            if ($stmt->execute()) {
                // Activation successful
                $activationMessage = "Equipment request deleted successfully.";
                header("Location: /eBrgy/app/requests/documents");
            } else {
                // Activation failed
                $activationMessage = "Error updating user status: " . $stmt->error;
            }
        
            // Close the prepared statement
            $stmt->close();
        }
        return $activationMessage;

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