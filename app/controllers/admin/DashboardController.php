<?php
class DashboardController {

    private $connection;

    public function __construct($connection)
    {
        $this->connection = $connection;
    }
    public function index() {
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
        $queryAdmin = "SELECT COUNT(*) AS total_admins FROM users WHERE role = 'admin'";
        $resultAdmin = $this->connection->query($queryAdmin);
        $rowAdmin = $resultAdmin->fetch_assoc();
        $totalAdmins = $rowAdmin['total_admins'];
    
        // Fetch the count of users with role 'residence'
        $queryResidence = "SELECT COUNT(*) AS total_residences FROM users WHERE role = 'residence'";
        $resultResidence = $this->connection->query($queryResidence);
        $rowResidence = $resultResidence->fetch_assoc();
        $totalResidences = $rowResidence['total_residences'];
    
        // Pass the total users counts to the template
        $data['totalUsers'] = $totalUsers;
        $data['totalAdmins'] = $totalAdmins;
        $data['totalResidences'] = $totalResidences;
    
        // Render the home page content
        include 'templates/admin/dashboard.php';
    
        // Close the database connections
        $result->close();
        $resultAdmin->close();
        $resultResidence->close();
    }
    

   
  }
  
?>