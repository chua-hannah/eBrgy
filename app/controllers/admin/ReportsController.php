<?php
class ReportsController {

    private $connection;

    public function __construct($connection)
    {
        $this->connection = $connection;
    }

    public function user_reports() {
        if ($this->connection->error) {
            die("Connection failed: " . $this->connection->error);
        }
    
        $query = "SELECT * FROM users WHERE status = 'activated'";
        $result = $this->connection->query($query);
    
        // Initialize counts for senior, PWD, 4Ps, and solo parent
        $seniorCount = 0;
        $pwdCount = 0;
        $fourPsCount = 0;
        $soloParentCount = 0;
    
        // Fetch all user records as an associative array
        $users = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $users[] = $row;
    
                // Check user attributes and update counts
                if ($row['senior'] == 1) {
                    $seniorCount++;
                }
                if ($row['pwd'] == 1) {
                    $pwdCount++;
                }
                if ($row['four_ps'] == 1) {
                    $fourPsCount++;
                }
                if ($row['solo_parent'] == 1) {
                    $soloParentCount++;
                }
            }
        }
    
        // Create an associative array to return user data and counts
        $userReports = array(
            'users' => $users,
            'seniorCount' => $seniorCount,
            'pwdCount' => $pwdCount,
            'fourPsCount' => $fourPsCount,
            'soloParentCount' => $soloParentCount,
        );
    
        return $userReports;
    }

    public function request_document_reports() {
        if ($this->connection->error) {
            die("Connection failed: " . $this->connection->error);
        }
    
        // Initialize counts
        $approvedCount = 0;
        $rejectedCount = 0;
    
        $query = "SELECT doc_requests.*, users.firstname, users.middlename, users.lastname
                  FROM doc_requests 
                  JOIN users ON doc_requests.username = users.username 
                  WHERE doc_requests.status IN ('approved', 'rejected');";
        
        $result = $this->connection->query($query);
    
        $documents = array(); // Array to store all relevant data
    
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                // Check status and update counts
                if ($row['status'] === 'approved') {
                    $approvedCount++;
                } elseif ($row['status'] === 'rejected') {
                    $rejectedCount++;
                }
    
                // Store only firstname, middlename, and lastname in the user data
                $userData = array(
                    'firstname' => $row['firstname'],
                    'middlename' => $row['middlename'],
                    'lastname' => $row['lastname'],
                );
    
                $row['user_data'] = $userData; // Add user data to the row    
                $documents[] = $row; // Add the row to the array
            }
        }
    
        // Create an associative array to return user data, documents, and counts
        $reportData = array(
            'documents' => $documents,
            'approvedCount' => $approvedCount,
            'rejectedCount' => $rejectedCount,
        );
    
        return $reportData;
    }

  

    public function request_reklamo_reports() {
        if ($this->connection->error) {
            die("Connection failed: " . $this->connection->error);
        }
    
        // Initialize counts
        $approvedCount = 0;
        $rejectedCount = 0;
    
        $query = "SELECT report_requests.*, users.firstname, users.middlename, users.lastname
                  FROM report_requests 
                  JOIN users ON report_requests.username = users.username 
                  WHERE report_requests.status IN ('approved', 'rejected');";
        
        $result = $this->connection->query($query);
    
        $documents = array(); // Array to store all relevant data
    
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                // Check status and update counts
                if ($row['status'] === 'approved') {
                    $approvedCount++;
                } elseif ($row['status'] === 'rejected') {
                    $rejectedCount++;
                }
    
                // Store only firstname, middlename, and lastname in the user data
                $userData = array(
                    'firstname' => $row['firstname'],
                    'middlename' => $row['middlename'],
                    'lastname' => $row['lastname'],
                );
    
                $row['user_data'] = $userData; // Add user data to the row    
                $documents[] = $row; // Add the row to the array
            }
        }
    
        // Create an associative array to return user data, documents, and counts
        $reportData = array(
            'reports' => $documents,
            'approvedCount' => $approvedCount,
            'rejectedCount' => $rejectedCount,
        );
    
        return $reportData;
    }

    public function request_schedule_reports() {
        if ($this->connection->error) {
            die("Connection failed: " . $this->connection->error);
        }
    
        // Initialize counts
        $approvedCount = 0;
        $rejectedCount = 0;
    
        $query = "SELECT schedule_requests.*, users.firstname, users.middlename, users.lastname
                  FROM schedule_requests 
                  JOIN users ON schedule_requests.username = users.username 
                  WHERE schedule_requests.status IN ('approved', 'rejected');";
        
        $result = $this->connection->query($query);
    
        $documents = array(); // Array to store all relevant data
    
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                // Check status and update counts
                if ($row['status'] === 'approved') {
                    $approvedCount++;
                } elseif ($row['status'] === 'rejected') {
                    $rejectedCount++;
                }
    
                // Store only firstname, middlename, and lastname in the user data
                $userData = array(
                    'firstname' => $row['firstname'],
                    'middlename' => $row['middlename'],
                    'lastname' => $row['lastname'],
                );
    
                $row['user_data'] = $userData; // Add user data to the row    
                $documents[] = $row; // Add the row to the array
            }
        }
    
        // Create an associative array to return user data, documents, and counts
        $reportData = array(
            'schedules' => $documents,
            'approvedCount' => $approvedCount,
            'rejectedCount' => $rejectedCount,
        );
    
        return $reportData;
    }
    
    public function request_equipment_reports() {
        if ($this->connection->error) {
            die("Connection failed: " . $this->connection->error);
        }
    
        // Initialize counts
        $approvedCount = 0;
        $rejectedCount = 0;
    
        $query = "SELECT equipment_requests.*, users.firstname, users.middlename, users.lastname
                  FROM equipment_requests 
                  JOIN users ON equipment_requests.username = users.username 
                  WHERE equipment_requests.status IN ('returned', 'rejected');";
        
        $result = $this->connection->query($query);
    
        $documents = array(); // Array to store all relevant data
    
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                // Check status and update counts
                if ($row['status'] === 'returned') {
                    $approvedCount++;
                } elseif ($row['status'] === 'rejected') {
                    $rejectedCount++;
                }
    
                // Store only firstname, middlename, and lastname in the user data
                $userData = array(
                    'firstname' => $row['firstname'],
                    'middlename' => $row['middlename'],
                    'lastname' => $row['lastname'],
                );
    
                $row['user_data'] = $userData; // Add user data to the row    
                $documents[] = $row; // Add the row to the array
            }
        }
    
        // Create an associative array to return user data, documents, and counts
        $reportData = array(
            'equipments' => $documents,
            'approvedCount' => $approvedCount,
            'rejectedCount' => $rejectedCount,
        );
    
        return $reportData;
    }
    
    


    
}
?>
