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
        $query = "SELECT COUNT(*) AS total_users FROM users WHERE status = 'deactivate'";
        $result = $this->connection->query($query);
        $row = $result->fetch_assoc();
        $totalUsers = $row['total_users'];

        
        // Fetch the count of users with role 'admin'
        $queryActiveUsers = "SELECT COUNT(*) AS total_active FROM users WHERE status = 'activated'";
        $resultActiveUsers = $this->connection->query($queryActiveUsers);
        $activeUsersRow = $resultActiveUsers->fetch_assoc();
        $totalActiveUsers = $activeUsersRow['total_active'];
        
    
        // Fetch the count of users with role 'admin'
        $queryAdmin = "SELECT COUNT(*) AS total_admins FROM users WHERE role = 'kagawad'  AND status = 'activated'";
        $resultAdmin = $this->connection->query($queryAdmin);
        $rowAdmin = $resultAdmin->fetch_assoc();
        $totalAdmins = $rowAdmin['total_admins'];
    
        // Fetch the count of users with role 'residence' and status 'activated'
        $queryResidence = "SELECT COUNT(*) AS total_residences FROM users WHERE role = 'residence' AND status = 'activated'";
        $resultResidence = $this->connection->query($queryResidence);
        $rowResidence = $resultResidence->fetch_assoc();
        $totalResidences = $rowResidence['total_residences'];

        // Fetch the count of users with role 'admin'
        $queryActiveUsers = "SELECT COUNT(*) AS userlist_senior FROM users WHERE senior = '1'";
        $resultActiveUsers = $this->connection->query($queryActiveUsers);
        $activeUsersRow = $resultActiveUsers->fetch_assoc();
        $totalActiveUsers = $activeUsersRow['userlist_senior'];
        

        // Fetch the count of users with role 'admin'
        $queryAdmin = "SELECT COUNT(*) AS userlist_pwd FROM users WHERE pwd = '1'";
        $resultAdmin = $this->connection->query($queryAdmin);
        $rowAdmin = $resultAdmin->fetch_assoc();
        $totalAdmins = $rowAdmin['userlist_pwd'];

        // Fetch the count of users with role 'residence' and status 'activated'
        $queryResidence = "SELECT COUNT(*) AS userlist_four_ps FROM users WHERE four_ps = '1'";
        $resultResidence = $this->connection->query($queryResidence);
        $rowResidence = $resultResidence->fetch_assoc();
        $totalResidences = $rowResidence['userlist_four_ps'];

        // Fetch the count of users with role 'residence' and status 'activated'
        $queryScholar = "SELECT COUNT(*) AS userlist_scholar FROM users WHERE scholar = '1'";
        $resultScholar = $this->connection->query($queryScholar);
        $rowScholar = $resultScholar->fetch_assoc();
        $totalScholar= $rowScholar['userlist_scholar'];

        // Fetch the count of users with role 'residence' and status 'activated'
        $querySoloParent = "SELECT COUNT(*) AS userlist_soloparent FROM users WHERE solo_parent = '1'";
        $resultSoloParent = $this->connection->query($querySoloParent);
        $rowSoloParent = $resultSoloParent->fetch_assoc();
        $totalSoloParent= $rowSoloParent['userlist_soloparent'];

    
        // Return the data as an array
        return [
            'totalUsers' => $totalUsers,
            'totalAdmins' => $totalAdmins,
            'totalResidences' => $totalResidences,
            'totalActiveUsers' => $totalActiveUsers,
            'totalSenior' => $totalActiveUsers,
            'totalPwd' => $totalAdmins,
            'totalFourps' => $totalResidences,
            'totalScholar' => $totalScholar,
            'totalSoloParent' => $totalSoloParent,
        ];
    }

    public function masterlist_count() {
        // Check the database connection
        if ($this->connection->error) {
            die("Connection failed: " . $this->connection->error);
        }
    
        // Fetch the users count from the users table
        $query = "SELECT COUNT(*) AS masterlist_users FROM users_masterlist";
        $result = $this->connection->query($query);
        $row = $result->fetch_assoc();
        $totalUsers = $row['masterlist_users'];

        
        // Fetch the count of users with role 'admin'
        $queryActiveUsers = "SELECT COUNT(*) AS masterlist_senior FROM users_masterlist WHERE senior = '1'";
        $resultActiveUsers = $this->connection->query($queryActiveUsers);
        $activeUsersRow = $resultActiveUsers->fetch_assoc();
        $totalActiveUsers = $activeUsersRow['masterlist_senior'];
        
    
        // Fetch the count of users with role 'admin'
        $queryAdmin = "SELECT COUNT(*) AS masterlist_pwd FROM users_masterlist WHERE pwd = '1'";
        $resultAdmin = $this->connection->query($queryAdmin);
        $rowAdmin = $resultAdmin->fetch_assoc();
        $totalAdmins = $rowAdmin['masterlist_pwd'];
    
        // Fetch the count of users with role 'residence' and status 'activated'
        $queryResidence = "SELECT COUNT(*) AS masterlist_four_ps FROM users_masterlist WHERE four_ps = '1'";
        $resultResidence = $this->connection->query($queryResidence);
        $rowResidence = $resultResidence->fetch_assoc();
        $totalResidences = $rowResidence['masterlist_four_ps'];

        // Fetch the count of users with role 'residence' and status 'activated'
        $queryScholar = "SELECT COUNT(*) AS masterlist_scholar FROM users_masterlist WHERE scholar = '1'";
        $resultScholar = $this->connection->query($queryScholar);
        $rowScholar = $resultScholar->fetch_assoc();
        $totalScholar= $rowScholar['masterlist_scholar'];

        // Fetch the count of users with role 'residence' and status 'activated'
        $querySoloParent = "SELECT COUNT(*) AS masterlist_soloparent FROM users_masterlist WHERE solo_parent = '1'";
        $resultSoloParent = $this->connection->query($querySoloParent);
        $rowSoloParent = $resultSoloParent->fetch_assoc();
        $totalSoloParent= $rowSoloParent['masterlist_soloparent'];

    
        // Return the data as an array
        return [
            'masterlistUsers' => $totalUsers,
            'masterlistSenior' => $totalActiveUsers,
            'masterlistPwd' => $totalAdmins,
            'masterlistFourps' => $totalResidences,
            'masterlistScholar' => $totalScholar,
            'masterlistSoloParent' => $totalSoloParent,

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

    public function attendees() {
        // Check the database connection
        if ($this->connection->error) {
            die("Connection failed: " . $this->connection->error);
        }
    
        date_default_timezone_set('Asia/Manila');
        
        // Get the current date
        $currentDate = date("Y-m-d");
    
        // Query to select attendees with "Late" status for the current date
        $queryLate = "SELECT attendance.*, users.firstname, users.middlename, users.lastname
                      FROM attendance
                      JOIN users ON attendance.username = users.username
                      WHERE attendance.status = 'Late' AND DATE(attendance.date) = '$currentDate'";
        $resultLate = $this->connection->query($queryLate);
    
        // Query to select attendees with "Present" status for the current date
        $queryPresent = "SELECT attendance.*, users.firstname, users.middlename, users.lastname
                         FROM attendance
                         JOIN users ON attendance.username = users.username
                         WHERE attendance.status = 'Present' AND DATE(attendance.date) = '$currentDate'";
        $resultPresent = $this->connection->query($queryPresent);
    
        // Return the data as an array
        return [
            'lateAttendees' => $resultLate->fetch_all(MYSQLI_ASSOC),
            'presentAttendees' => $resultPresent->fetch_all(MYSQLI_ASSOC),
        ];
    }
    

    

        public function getCountOfUniqueAddressesWithMultipleUsers()
        {
            // SQL query to get the count of unique addresses with more than one user
            $query = "SELECT COUNT(*) AS total_count
            FROM (
            SELECT address, lastname, COUNT(*) AS address_count
            FROM users_masterlist
            GROUP BY address, lastname
            HAVING address_count > 1
            ) AS grouped_addresses";

            // Execute the query
            $result = $this->connection->query($query);

            if ($result) {
                $row = $result->fetch_assoc();
                return $row['total_count'];
            } else {
                // Handle the case where the query fails (e.g., database connection issue)
                return 0; // You can return an error code or message as needed
            }
        }


    public function request_count() {
        // Check the database connection
        if ($this->connection->error) {
            die("Connection failed: " . $this->connection->error);
        }
       
    
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

    public function equipment_request_count() {
        // Check the database connection
        if ($this->connection->error) {
            die("Connection failed: " . $this->connection->error);
        }
        // Query to count the number of attendees present today
        $queryPending = "SELECT COUNT(*) AS pending FROM equipment_requests WHERE status = 'pending'";
        $resultPending = $this->connection->query($queryPending);
        $rowPending = $resultPending->fetch_assoc();
        $totalPending = $rowPending['pending'];

        $queryApproved = "SELECT COUNT(*) AS approved FROM equipment_requests WHERE status = 'approved'";
        $resultApproved = $this->connection->query($queryApproved);
        $rowApproved = $resultApproved->fetch_assoc();
        $totalApproved = $rowApproved['approved'];
    
        $queryRejected = "SELECT COUNT(*) AS rejected FROM equipment_requests WHERE status = 'rejected'";
        $resultRejected = $this->connection->query($queryRejected);
        $rowRejected = $resultRejected->fetch_assoc();
        $totalRejected = $rowRejected['rejected'];
        
        $queryReturned = "SELECT COUNT(*) AS returned FROM equipment_requests WHERE status = 'returned'";
        $resultReturned = $this->connection->query($queryReturned);
        $rowReturned = $resultReturned->fetch_assoc();
        $totalReturned = $rowReturned['returned'];
    
       
        // Return the data as an array
        return [
            'totalEquipPending' => $totalPending,
            'totalEquipApproved' => $totalApproved,
            'totalEquipRejected' => $totalRejected,
            'totalReturned' => $totalReturned,
        ];
    }

    public function schedule_request_count() {
        // Check the database connection
        if ($this->connection->error) {
            die("Connection failed: " . $this->connection->error);
        }
       
    
        // Query to count the number of attendees present today
        $queryPending = "SELECT COUNT(*) AS pending FROM schedule_requests WHERE status = 'pending'";
        $resultPending = $this->connection->query($queryPending);
        $rowPending = $resultPending->fetch_assoc();
        $totalPending = $rowPending['pending'];

        $queryApproved = "SELECT COUNT(*) AS approved FROM schedule_requests WHERE status = 'approved'";
        $resultApproved = $this->connection->query($queryApproved);
        $rowApproved = $resultApproved->fetch_assoc();
        $totalApproved = $rowApproved['approved'];
    
        $queryRejected = "SELECT COUNT(*) AS rejected FROM schedule_requests WHERE status = 'rejected'";
        $resultRejected = $this->connection->query($queryRejected);
        $rowRejected = $resultRejected->fetch_assoc();
        $totalRejected = $rowRejected['rejected'];
    
    
       
        // Return the data as an array
        return [
            'totalSchedulePending' => $totalPending,
            'totalScheduleApproved' => $totalApproved,
            'totalScheduleRejected' => $totalRejected
        ];
    }

    public function reports_request_count() {
        // Check the database connection
        if ($this->connection->error) {
            die("Connection failed: " . $this->connection->error);
        }
       
    
        // Query to count the number of attendees present today
        $queryPending = "SELECT COUNT(*) AS pending FROM report_requests WHERE status = 'pending'";
        $resultPending = $this->connection->query($queryPending);
        $rowPending = $resultPending->fetch_assoc();
        $totalPending = $rowPending['pending'];

        $queryApproved = "SELECT COUNT(*) AS approved FROM report_requests WHERE status = 'approved'";
        $resultApproved = $this->connection->query($queryApproved);
        $rowApproved = $resultApproved->fetch_assoc();
        $totalApproved = $rowApproved['approved'];
    
        $queryRejected = "SELECT COUNT(*) AS rejected FROM report_requests WHERE status = 'rejected'";
        $resultRejected = $this->connection->query($queryRejected);
        $rowRejected = $resultRejected->fetch_assoc();
        $totalRejected = $rowRejected['rejected'];
    
    
       
        // Return the data as an array
        return [
            'totalReportsPending' => $totalPending,
            'totalReportsApproved' => $totalApproved,
            'totalReportsRejected' => $totalRejected,
        ];
    }

    
    
}
?>
