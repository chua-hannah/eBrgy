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
                    $_SESSION["success"] = "Office time settings have been updated successfully.";
                    header("Location:  /eBrgy/app/settings");
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
                    header("Location: /eBrgy/app/settings");
                    $_SESSION["success"] = "Office hours have been successfully updated.";
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
            $db_request_name = $this->connection->real_escape_string($request_name); // Sanitize input

            // Check if the request_name already exists in the database
            $check_query = "SELECT request_name FROM doc_settings WHERE request_name = '$db_request_name'";
            $result = $this->connection->query($check_query);

            if ($result) {
                if ($result->num_rows > 0) {
                    // Request_name already exists
                    header("Location: /eBrgy/app/requests-documents-management");
                    $_SESSION["error"] = "Document name already exists.";
                    exit();
                } else {
                    // Use prepared statement to insert data into the database
                    $query = "INSERT INTO doc_settings (request_name, request_status, description, created_at) VALUES ('$db_request_name', '$status', '$description', '$datetime')";
                    
                    // Prepare the statement
                    if ($this->connection->query($query) === true) {
                        // Registration successful
                        header("Location: /eBrgy/app/requests-documents-management");
                        $_SESSION["success"] = "A new document type has been successfully created.";
                        exit();
                    } else {
                        // Error occurred
                        echo "Error: " . $this->connection->error;
                    }
                }
            } else {
                // Error occurred in the query
                echo "Error: " . $this->connection->error;
            }
        }
    
        // Render the contact page content
     
    }

    public function get_request_settings() {
        if ($this->connection->error) {
            die("Connection failed: " . $this->connection->error);
        }
    
        $query = "SELECT * FROM doc_settings WHERE request_status = 1"; // Updated query
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
              header("Location: requests-equipments-management");
              $_SESSION["success"] = "New equipment has been added successfully.";
              exit();           
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

    public function insertHomeSettings($announcementText, $missionText,  $visionText, $slide1, $slide2, $slide3, $slide4) {
        // Prepare and execute an SQL query to insert data into your "home_setting" table
        $query = "INSERT INTO home_setting (announcement_text, mission_text, vision_text, slide1, slide2, slide3, slide4) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->connection->prepare($query);
        $stmt->bind_param("sssssss", $announcementText, $missionText,  $visionText, $slide1, $slide2, $slide3, $slide4);
    
        if ($stmt->execute()) {
            // Insertion was successful
            return true;
        } else {
            // Insertion failed
            return false;
        }
    }

    
    public function home_setting()
    {    
        if (isset($_POST['home_page_setting'])) {
            $announcementText = $_POST['announcement'];
            $missionText = $_POST['mission'];
            $visionText = $_POST['vision'];
    
            // Check if the announcement text is not empty
            if (empty($announcementText) && empty($missionText) && empty($vision)) {
                $error = "Announcement text is required.";
                // Handle the error (e.g., display an error message).
            } else {
                // Handle slide file uploads
                $slideDirectory = 'uploads/homepage/';
                $slide1 = $_FILES['slide1']['name'];
                $slide2 = $_FILES['slide2']['name'];
                $slide3 = $_FILES['slide3']['name'];
                $slide4 = $_FILES['slide4']['name'];
    
                // Move uploaded files to the destination directory
                if (move_uploaded_file($_FILES['slide1']['tmp_name'], $slideDirectory . $slide1) &&
                    move_uploaded_file($_FILES['slide2']['tmp_name'], $slideDirectory . $slide2) &&
                    move_uploaded_file($_FILES['slide3']['tmp_name'], $slideDirectory . $slide3) &&
                    move_uploaded_file($_FILES['slide4']['tmp_name'], $slideDirectory . $slide4)) {
    
                    // Files were successfully uploaded
                    // Now, insert data into your "home_setting" table
                    $inserted = $this->insertHomeSettings($announcementText, $missionText,  $visionText, $slide1, $slide2, $slide3, $slide4);
    
                    if ($inserted) {
                        // Insertion was successful
                        // Handle the success (e.g., redirect to a success page).
                    } else {
                        // Insertion failed
                        $error = "Database insertion failed. Please try again.";
                        // Handle the error (e.g., display an error message).
                    }
                } else {
                    // Image uploads failed
                    $error = "Image upload failed. Please try again.";
                    // Handle the error (e.g., display an error message).
                }
            }
        }
    }

    public function update_home_setting()
    {    
        if (isset($_POST['edit_home_page_setting'])) {
            $announcementText = $_POST['announcement'];
            $missionText = $_POST['mission'];
            $visionText = $_POST['vision'];
            // Check if the announcement text is not empty
            if (empty($announcementText)) {
                $error = "Announcement text is required.";
                // Handle the error (e.g., display an error message).
            } else {
                // Handle slide file uploads
                $slideDirectory = 'uploads/homepage/';
                $slide1 = $_FILES['slide1']['name'];
                $slide2 = $_FILES['slide2']['name'];
                $slide3 = $_FILES['slide3']['name'];
                $slide4 = $_FILES['slide4']['name'];
    
                // Move uploaded files to the destination directory
                if (move_uploaded_file($_FILES['slide1']['tmp_name'], $slideDirectory . $slide1) &&
                    move_uploaded_file($_FILES['slide2']['tmp_name'], $slideDirectory . $slide2) &&
                    move_uploaded_file($_FILES['slide3']['tmp_name'], $slideDirectory . $slide3) &&
                    move_uploaded_file($_FILES['slide4']['tmp_name'], $slideDirectory . $slide4)) {
    
                    // Files were successfully uploaded
                    // Now, update data in your "home_setting" table
                    $updated = $this->updateHomeSettings($announcementText, $missionText,  $visionText, $slide1, $slide2, $slide3, $slide4);
    
                    if ($updated) {
                        // Update was successful
                        // Use JavaScript to reload the page
                        echo '<script>window.location.href = window.location.href;</script>';
                    } else {
                        // Update failed
                        $error = "Database update failed. Please try again.";
                        // Handle the error (e.g., display an error message).
                    }
                } else {
                    // Image uploads failed
                    $error = "Image upload failed. Please try again.";
                    // Handle the error (e.g., display an error message).
                }
            }
        }
    }
    

// Create a new function to update the data in your "home_setting" table
public function updateHomeSettings($announcementText, $missionText,  $visionText, $slide1, $slide2, $slide3, $slide4) {
    // Assuming you have an established database connection
    $connection = $this->connection;

    // Sanitize input data to prevent SQL injection (you may need to use prepared statements)
    $announcementText = $connection->real_escape_string($announcementText);
    $slide1 = $connection->real_escape_string($slide1);
    $slide2 = $connection->real_escape_string($slide2);
    $slide3 = $connection->real_escape_string($slide3);
    $slide4 = $connection->real_escape_string($slide4);

    // Construct the SQL query to update the data
    $query = "UPDATE home_setting SET announcement_text = '$announcementText', mission_text = '$missionText', vision_text = '$visionText', slide1 = '$slide1', slide2 = '$slide2', slide3 = '$slide3', slide4 = '$slide4' WHERE id = 1";

    // Execute the query
    $result = $connection->query($query);

    // Check if the query was successful
    if ($result) {
        return true; // Update successful
    } else {
        return false; // Update failed
    }
}


    
    
    
}
?>
