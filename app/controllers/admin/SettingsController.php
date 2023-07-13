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
            $existingRecordQuery = "SELECT * FROM settings";
            $existingRecordResult = $this->connection->query($existingRecordQuery);
    
            if ($existingRecordResult->num_rows > 0) {
                // Update the existing record in the settings table
                $updateQuery = "UPDATE settings SET work_hours_start = '$start', work_hours_end = '$end', late_threshold = '$late'";
                $updateResult = $this->connection->query($updateQuery);
    
                if ($updateResult === true) {
                    // Update successful
                    echo "Update successfully";
                    header("Location:  /eBrgy/app/settings");
                    exit();
                } else {
                    // Error occurred
                    echo "Error: " . $this->connection->error;
                }
            } else {
                // No record found, insert a new record
                $insertQuery = "INSERT INTO settings (work_hours_start, work_hours_end, late_threshold) VALUES ('$start', '$end', '$late')";
                $insertResult = $this->connection->query($insertQuery);
    
                if ($insertResult === true) {
                    // Insertion successful
                    echo "Add successfully";
                    header("Location: /eBrgy/app/settings");
                    exit();
                } else {
                    // Error occurred
                    echo "Error: " . $this->connection->error;
                }
            }
        }
    }
 
    
}
?>
