<?php

class AttendanceController {

  private $connection;

  public function __construct($connection)
  {
      $this->connection = $connection;
  }
    public function index() {
      // Render the home page content
      include 'templates/dashboard.php';
    }
   
    public function attendance()
{
    // Check if the attendance check-in button is clicked
if (isset($_POST['check_in'])) {
    // Set the timezone to Philippine time
    date_default_timezone_set('Asia/Manila');

    // Get the employee ID and other relevant data from the form
    $employeeId = $_SESSION['user_id'];
    $fullName = $_SESSION['fullname'];
    $date = date('Y-m-d');
    $time_in = date('H:i:s'); // Philippine time

    // Query the settings table to get the late threshold value
    $settingsQuery = "SELECT late_threshold FROM settings";
    $settingsResult = $this->connection->query($settingsQuery);

    if ($settingsResult->num_rows > 0) {
        $settingsRow = $settingsResult->fetch_assoc();
        $lateThreshold = $settingsRow['late_threshold'];

        // Compare the time_in with the late_threshold to determine the status
        $lateThresholdTime = strtotime($lateThreshold);
        $timeInTime = strtotime($time_in);

        if ($timeInTime > $lateThresholdTime) {
            $status = 'Late';
        } else {
            $status = 'Present';
        }

        // Perform the database query to insert the attendance record
        // Assuming you have already established a connection to your MySQL database
        $query = "INSERT INTO attendance (user_id, fullname, date, time_in, time_out, status, remark)
        VALUES ('$employeeId', '$fullName', '$date', '$time_in', NULL, '$status', '')";

        // Execute the query
        if ($this->connection->query($query) === true) {
            echo "Attendance check-in successful";
            $isCheckIn = true; // Set $isCheckIn to true after successful check-in
        } else {
            echo "Error: " . $this->connection->error;
        }
    } else {
        echo "No late threshold found in settings.";
    }
}


    // Check if the attendance check-out button is clicked
    if (isset($_POST['check_out'])) {
        // Set the timezone to Philippine time
        date_default_timezone_set('Asia/Manila');

        // Get the employee ID and other relevant data from the form
        $employeeId = $_SESSION['user_id'];
        $date = date('Y-m-d');
        $time_out = date('H:i:s'); // Philippine time

        // Check if the user has already checked out for the current date
        $query = "SELECT id FROM attendance WHERE user_id = '$employeeId' AND date = '$date' AND time_out IS NOT NULL";
        $result = $this->connection->query($query);

        if ($result->num_rows > 0) {
            echo "You have already checked out for today.";
        } else {
            // Perform the database query to update the attendance record with check-out time
            // Assuming you have already established a connection to your MySQL database
            $query = "UPDATE attendance SET time_out = '$time_out' WHERE user_id = '$employeeId' AND date = '$date'";

            // Execute the query
            if ($this->connection->query($query) === true) {
                echo "Attendance check-out successful";
            } else {
                echo "Error: " . $this->connection->error;
            }
        }
    }

    // Check if the user is already checked in
    $employeeId = $_SESSION['user_id'];
    $date = date('Y-m-d');

    // Query the database to check if there is an existing check-in record for the user and date
    $query = "SELECT id FROM attendance WHERE user_id = '$employeeId' AND date = '$date'";
    $result = $this->connection->query($query);

    // Set the value of $isCheckIn based on the query result
    $isCheckIn = ($result->num_rows > 0);

    // Render the attendance page content with the $isCheckIn variable
    include 'templates/admin/attendance/attendance.php';
}
  
  }
  
?>