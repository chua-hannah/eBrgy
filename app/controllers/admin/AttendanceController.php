<?php

class AttendanceController {

    private $connection;
    private $isCheckIn; // Declare $isCheckIn as a class property


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
    // Set the timezone to Philippine time
    date_default_timezone_set('Asia/Manila');

    // Get the employee ID and other relevant data from the form
    $employeeId = $_SESSION['user_id'];
    $fullname = $_SESSION['fullname'];
    $date = date('Y-m-d');
    $time_in = date('H:i:s'); // Philippine time

     // Check if the user has already checked in or checked out for the current date
     $query = "SELECT time_in, time_out FROM attendance WHERE user_id = '$employeeId' AND date = '$date'";
     $result = $this->connection->query($query);
     $attendanceData = $result->fetch_assoc();
     if(!empty($attendanceData['time_in']))
     {
        $time_in_db = $attendanceData['time_in'];
     }
     else
     {
        $time_in_db = null;
     }
     if(!empty($attendanceData['time_out']))
     {
        $time_out_db = $attendanceData['time_out'];
     }
     else
     {
        $time_out_db = null;
     }
    
 
     // Initialize the flags based on the query results
     $isCheckIn = ($time_in_db !== null);
     $isCheckOut = ($time_out_db !== null);

    if (isset($_POST['check_in'])) {
        if (!$isCheckIn) {
            // User has not checked in yet, so allow check-in
            // Query the settings table to get the late threshold value
            $settingsQuery = "SELECT late_threshold FROM time_settings";
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
                $query = "INSERT INTO attendance (user_id, fullname, date, time_in, time_out, status, remark)
                VALUES ('$employeeId', '$fullname', '$date', '$time_in', NULL, '$status', '')";

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
        } else {
            echo "You have already checked in for today.";
        }
    } elseif (isset($_POST['check_out'])) {
        if ($isCheckIn && !$isCheckOut) {
            // User has checked in but not checked out, so allow check-out
            // Update the attendance record with check-out time
            $time_out = date('H:i:s'); // Philippine time
            $query = "UPDATE attendance SET time_out = '$time_out' WHERE user_id = '$employeeId' AND date = '$date'";

            // Execute the query
            if ($this->connection->query($query) === true) {
                echo "Attendance check-out successful";
                $isCheckOut = true; // Set $isCheckOut to true after successful check-out
            } else {
                echo "Error: " . $this->connection->error;
            }
        } elseif (!$isCheckIn) {
            echo "You need to check-in first before checking out.";
        } else {
            echo "You have already checked out for today.";
        }
    }

    // Save the updated flag values in session variables
    $_SESSION['isCheckIn'] = $isCheckIn;
    $_SESSION['isCheckOut'] = $isCheckOut;

  
}

    
        

    public function my_attendance(){
        // Check the connection
    if ($this->connection->error) {
        die("Connection failed: " . $this->connection->error);
    }

    // Escape the user_id to prevent SQL injection
    $user_id = $this->connection->real_escape_string($_SESSION['user_id']);

    // Prepare the SQL query
    $query = "SELECT * FROM attendance WHERE user_id = '$user_id'";

    // Execute the query
    $result =  $this->connection->query($query);

    // Initialize an array to store the attendance data
    $my_attendance_data = array();

    // Check if any rows were returned
    if ($result->num_rows > 0) {
        // Fetch the data and store it in the array
        while ($row = $result->fetch_assoc()) {
            $my_attendance_data[] = $row;
        }
    }

    // Close the database connection
    $this->connection->close();

    // Return the attendance data
    return $my_attendance_data;
    }

      // Add a method to get the value of $isCheckIn
      public function getIsCheckIn()
      {
          return $this->isCheckIn;
      }
  
  }
  
?>