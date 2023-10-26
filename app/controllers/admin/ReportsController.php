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

    public function register_to_masterlist()
    {
        $position = 'residence';
    
        if (isset($_POST['add_to_user_masterlist'])) {
            $email = $_POST['email'];
            $mobile = $_POST['mobile'];
            $firstname = $_POST['firstname'];
            $middlename = $_POST['middlename'];
            $lastname = $_POST['lastname'];
            $birthdate = $_POST['birthdate'];
            $address = $_POST['address'];
            $mobilePattern = "/^9\d{9}$/";
            $emailPattern = "/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/";
            if (isset($_POST['sex'])) {
                $sex = $_POST['sex'];
                // Now you can safely access $selectOption without an "undefined array key" error.
            } else {
                // Handle the case when 'selectOption' is not set.
                $sex = ""; // or some default value
            }          
            $four_ps = isset($_POST['membership_4ps']) ? 1 : 0;
            $pwd = isset($_POST['membership_pwd']) ? 1 : 0;
            $solo_parent = isset($_POST['membership_solo_parent']) ? 1 : 0;
            $scholar = isset($_POST['membership_scholar']) ? 1 : 0;
    
            // Validate empty input fields & date pattern
    
            if ($birthdate==="") {
                $errors["birthdate"] = "Enter your Birthdate";
            }
            if (empty($sex)) {
                $errors["sex"] = "Select Gender";
            }
            if (empty($mobile)) {
                $errors["mobile"] = "Enter Mobile number";
            }
            else if (!preg_match($mobilePattern, $mobile)) {
                $errors["mobile"] = "Invalid mobile number format.";    
            }
            if (empty($email)) {
                $errors["email"] = "Enter Email address";
            }
            else if (!preg_match($emailPattern, $email)) {
                $errors["email"] = "Invalid email format";
            }
            if (empty($address)) {
                $errors["address"] = "Enter Address";
            }
    
            if (empty($errors)) {
                // Add prefix in mobile number input
                $prefixMobileNumber = "+63";
                $mobile = $prefixMobileNumber . $mobile;
    
                // Convert birthdate to YYYY-MM-DD format
                $birthdateTimestamp = strtotime($birthdate);
                // Valid date format, convert it to YYYY-MM-DD
                $birthdate = date('Y-m-d', $birthdateTimestamp);
    
                // Calculate age from birthdate
                $currentTimestamp = time();
                $ageInSeconds = $currentTimestamp - $birthdateTimestamp;
                $age = floor($ageInSeconds / (365 * 24 * 3600));
                $senior = $age >= 60 ? 1 : 0;
               
                // Check if the username or email already exists in the database
                $query = "SELECT * FROM users WHERE mobile = '$mobile'";
                $result = $this->connection->query($query);
                $existingMobile = false;
    
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        if ($row['mobile'] == $mobile) {
                            $existingMobile = true;
                        }
                        if ($row['email'] == $email) {
                            $existingEmail = true;
                        }
                    }
                }
    
                if ($existingMobile) {
                    // Mobile number already exists, display an error message
                    $error = "Given mobile number already exists.";
                }
                elseif ($existingEmail) {
                    // Email already exists, display an error message
                    $error = "Given email already exists.";
                } elseif (empty($error) && empty($errors)) {
                    // Insert the data into the database
                    $query = "INSERT INTO users_masterlist ( mobile, email, firstname, middlename, lastname, birthdate, age, gender, address, position, senior, four_ps, pwd, solo_parent, scholar)
                    VALUES ( '$mobile', '$email', '$firstname', '$middlename', '$lastname', '$birthdate', '$age', '$sex', '$address', '$position', $senior, $four_ps, $pwd, $solo_parent, $scholar)";
        
                    if ($this->connection->query($query) === true) {
                        // Registration successful
                        header("Location: masterlist");
                        $_SESSION['Added Successfully'] = true;
                        exit();
                    } else {
                        // Error occurred
                        $_SESSION['registerFailed'] = "Error: " . $this->connection->error;
                    }
                }
            }
        }
    }
    
    public function masterlist_reports() {
        if ($this->connection->error) {
            die("Connection failed: " . $this->connection->error);
        }
    
        $query = "SELECT * FROM users_masterlist";
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
    
}
?>
