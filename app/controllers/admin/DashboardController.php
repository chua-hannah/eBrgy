<?php
class DashboardController {

    private $connection;

    public function __construct($connection)
    {
        $this->connection = $connection;
    }

    public function users_count() {
        // Check the database connection
        if ($this->connection->error) {
            die("Connection failed: " . $this->connection->error);
        }
    
        // Fetch the users count from the users table
        $query = "SELECT COUNT(*) AS total_users FROM users";
        $result = $this->connection->query($query);
        $row = $result->fetch_assoc();
        $totalUsers = $row['total_users'];
    
        // Fetch the count of users with role 'admin'
        $queryAdmin = "SELECT COUNT(*) AS total_admins FROM users WHERE role = 'kagawad'";
        $resultAdmin = $this->connection->query($queryAdmin);
        $rowAdmin = $resultAdmin->fetch_assoc();
        $totalAdmins = $rowAdmin['total_admins'];
    
        // Fetch the count of users with role 'residence'
        $queryResidence = "SELECT COUNT(*) AS total_residences FROM users WHERE role = 'residence'";
        $resultResidence = $this->connection->query($queryResidence);
        $rowResidence = $resultResidence->fetch_assoc();
        $totalResidences = $rowResidence['total_residences'];
    
        // Return the data as an array
        return [
            'totalUsers' => $totalUsers,
            'totalAdmins' => $totalAdmins,
            'totalResidences' => $totalResidences
        ];
    }

    public function attendance_count() {
        // Check the database connection
        if ($this->connection->error) {
            die("Connection failed: " . $this->connection->error);
        }
        date_default_timezone_set('Asia/Manila');
        // Get the current date
        $currentDate = date("Y-m-d");
    
        // Query to count the number of attendees present today
        $queryPresent = "SELECT COUNT(*) AS present FROM attendance WHERE status = 'Present' AND DATE(date) = '$currentDate'";
        $resultPresent = $this->connection->query($queryPresent);
        $rowPresent = $resultPresent->fetch_assoc();
        $totalPresentAttendee = $rowPresent['present'];

        $queryLate = "SELECT COUNT(*) AS late FROM attendance WHERE status = 'Late' AND DATE(date) = '$currentDate'";
        $resultLate = $this->connection->query($queryLate);
        $rowLate = $resultLate->fetch_assoc();
        $totalLateAttendee = $rowLate['late'];
    
        // Query to count the total number of attendees for today
        $queryTotal = "SELECT COUNT(*) AS totalKagawad FROM users WHERE role != 'residence'";
        $resultTotal = $this->connection->query($queryTotal);
        $rowTotal = $resultTotal->fetch_assoc();
        $totalKagawad = $rowTotal['totalKagawad'];
    
     
       
        // Return the data as an array
        return [
            'totalPresentAttendee' => $totalPresentAttendee,
            'totalLateAttendee' => $totalLateAttendee,
            'totalKagawad' => $totalKagawad
        ];
    }

    public function request_count() {
        // Check the database connection
        if ($this->connection->error) {
            die("Connection failed: " . $this->connection->error);
        }
        date_default_timezone_set('Asia/Manila');
        // Get the current date
        $currentDate = date("Y-m-d");
    
        // Query to count the number of attendees present today
        $queryPending = "SELECT COUNT(*) AS pending FROM doc_requests WHERE status = 'pending'";
        $resultPending = $this->connection->query($queryPending);
        $rowPending = $resultPending->fetch_assoc();
        $totalPending = $rowPending['pending'];

        $queryApproved = "SELECT COUNT(*) AS approved FROM doc_requests WHERE status = 'approved'";
        $resultApproved = $this->connection->query($queryApproved);
        $rowApproved = $resultApproved->fetch_assoc();
        $totalApproved = $rowApproved['approved'];
    
        $queryRejected = "SELECT COUNT(*) AS rejected FROM doc_requests WHERE status = 'rejected'";
        $resultRejected = $this->connection->query($queryRejected);
        $rowRejected = $resultRejected->fetch_assoc();
        $totalRejected = $rowRejected['rejected'];
    
    
       
        // Return the data as an array
        return [
            'totalPending' => $totalPending,
            'totalApproved' => $totalApproved,
            'totalRejected' => $totalRejected
        ];
    }
    
}
?>
