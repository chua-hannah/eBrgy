<?php
class SettingsController {

    private $connection;

    public function __construct($connection)
    {
        $this->connection = $connection;
    }

    public function attendance_setting() {
        // Check the database connection
        if (isset($_POST['settings'])) {
            // Retrieve the submitted form data
            $start = $_POST['start'];
            $end = $_POST['end'];
            $late = $_POST['late'];
    
            // Add more fields as needed
    
            // Check if a record already exists in the settings table
            $existingRecordQuery = "SELECT * FROM time_settings";
            $existingRecordResult = $this->connection->query($existingRecordQuery);
    
            if ($existingRecordResult->num_rows > 0) {
                // Update the existing record in the settings table
                $updateQuery = "UPDATE time_settings SET work_hours_start = '$start', work_hours_end = '$end', late_threshold = '$late'";
                $updateResult = $this->connection->query($updateQuery);
    
                if ($updateResult === true) {
                    // Update successful
                    header("Location:  /eBrgy/app/settings");
                    $_SESSION["success"] = "Office time settings have been updated successfully.";
                    exit();
                } else {
                    // Error occurred
                    echo "Error: " . $this->connection->error;
                }
            } else {
                // No record found, insert a new record
                $insertQuery = "INSERT INTO time_settings (work_hours_start, work_hours_end, late_threshold) VALUES ('$start', '$end', '$late')";
                $insertResult = $this->connection->query($insertQuery);
    
                if ($insertResult === true) {
                    // Insertion successful
                    $_SESSION["success"] = "Office hours have been successfully updated.";
                    header("Location: /eBrgy/app/settings");
                    exit();
                } else {
                    // Error occurred
                    echo "Error: " . $this->connection->error;
                }
            }
        }
    }

    public function request_setting() {
        if (isset($_POST['add_request'])) {
            date_default_timezone_set('Asia/Manila');
            $request_name = $_POST['request_name'];
            $status = $_POST['status'];
            $description = $_POST['description'];
            $date = date('Y-m-d');
            $time_in = date('H:i:s'); // Philippine time
    
            // Combine date and time into a single datetime string
            $datetime = $date . ' ' . $time_in;
    
            // Use prepared statement to insert data into the database
            $query = "INSERT INTO doc_settings (request_name, request_status, description, created_at) VALUES ('$request_name', '$status', '$description', '$datetime')";
    
            // Prepare the statement
            if ($this->connection->query($query) === true) {
              // Registration successful
              $_SESSION["success"] = "Message sent successfully.";
           
          } else {
              // Error occurred
              echo "Error: " . $this->connection->error;
          }
        }
    
        // Render the contact page content
     
    }

    public function get_request_settings() {
        if ($this->connection->error) {
            die("Connection failed: " . $this->connection->error);
        }
    
        $query = "SELECT * FROM doc_settings";
        $result = $this->connection->query($query);
    
        // Fetch all request settings records as an associative array
        $requests = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $requests[] = $row; // Corrected variable name to $requests[]
            }
        }
    
        // Return the fetched request settings data
        return $requests;
    }

    public function add_equipment_setting() {
        if (isset($_POST['add_equipment'])) {
            $equipment_name = $_POST['equipment_name'];
            $availability = $_POST['availability'];
            $number_of_equipment = $_POST['number_of_equipment'];
            $total_equipment = $_POST['total_equipment'];
    
    
            // Use prepared statement to insert data into the database
            $query = "INSERT INTO equipment_settings (equipment_name, availability, number_of_equipment, total_equipment) VALUES ('$equipment_name', '$availability', '$number_of_equipment', '$total_equipment')";
    
            // Prepare the statement
            if ($this->connection->query($query) === true) {
              // Registration successful
              echo '<script>window.location.href = "requests-equipments-management";</script>';
              $_SESSION["success"] = "New equipment has been added successfully.";
           
          } else {
              // Error occurred
              echo "Error: " . $this->connection->error;
          }
        }
    
        // Render the contact page content
     
    }


    public function get_equipments_list() {
        if ($this->connection->error) {
            die("Connection failed: " . $this->connection->error);
        }
    
        $query = "SELECT * FROM equipment_settings";
        $result = $this->connection->query($query);
    
        // Fetch all request settings records as an associative array
        $requests = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $requests[] = $row; // Corrected variable name to $requests[]
            }
        }
    
        // Return the fetched request settings data
        return $requests;
    }

    public function get_time_settings() {
        if ($this->connection->error) {
            die("Connection failed: " . $this->connection->error);
        }
    
        $query = "SELECT * FROM time_settings";
        $result = $this->connection->query($query);
    
        // Fetch all request settings records as an associative array
        $office_time = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $office_time[] = $row; 
            }
        }
    
        // Return the fetched request settings data
        return $office_time;
    }
    
}
?>
