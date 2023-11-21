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
    
        $query = "SELECT firstname, middlename, lastname, birthdate, age, sex, mobile, email, address, four_ps, solo_parent, scholar, senior, pwd FROM users
        UNION
        SELECT firstname, middlename, lastname, birthdate, age, gender, mobile, email, address, four_ps, solo_parent, scholar, senior, pwd FROM users_masterlist
        ORDER BY firstname";
    
        $result = $this->connection->query($query);
    
        // Initialize counts for senior, PWD, 4Ps, and solo parent
        $seniorCount = 0;
        $pwdCount = 0;
        $fourPsCount = 0;
        $soloParentCount = 0;
        $scholarCount = 0;
    
        // Fetch all user records as an associative array
        $users = array();
        $totalRows = $result->num_rows;  // Count of total rows
    
        if ($totalRows > 0) {
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
                if ($row['scholar'] == 1) {
                    $scholarCount++;
                }
            }
        }
    
        // Create an associative array to return user data, counts, and total row count
        $userReports = array(
            'users' => $users,
            'seniorCount' => $seniorCount,
            'pwdCount' => $pwdCount,
            'fourPsCount' => $fourPsCount,
            'soloParentCount' => $soloParentCount,
            'scholarCount' => $scholarCount,
            'totalRows' => $totalRows,
        );
    
        return $userReports;
    }    

    public function non_user_reports() {
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
        $scholarCount = 0;
    
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
                if ($row['scholar'] == 1) {
                    $scholarCount++;
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
            'scholarCount' => $scholarCount,
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
                $error = '';
                $errors = array();
                $email = $_POST['email'];
                $mobile = $_POST['mobile'];
                $firstname = $_POST['firstname'];
                $middlename = $_POST['middlename'];
                $lastname = $_POST['lastname'];
                $birthdate = $_POST['birthdate'];
                $address = $_POST['address'];
                $mobilePattern = "/^9\d{9}$/";
                $emailPattern = "/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/";
                $namePattern = '/^[A-Za-z\s\'.-]+$/';
                if (isset($_POST['sex'])) {
                    $sex = $_POST['sex'];
                } else {
                    $sex = ""; // or some default value
                }
                $four_ps = isset($_POST['membership_4ps']) ? 1 : 0;
                $pwd = isset($_POST['membership_pwd']) ? 1 : 0;
                $solo_parent = isset($_POST['membership_solo_parent']) ? 1 : 0;
                $scholar = isset($_POST['membership_scholar']) ? 1 : 0;
        
                if ($birthdate === "") {
                    $errors["birthdate"] = "Enter your Birthdate";
                }
                if (empty($sex)) {
                    $errors["sex"] = "Select Gender";
                }
                if (!empty($mobile)) {
                  if (!preg_match($mobilePattern, $mobile)) {
                    $errors["mobile"] = "Invalid mobile number format.";
                  }
                }
                if (!empty($email)) {
                    if (!preg_match($emailPattern, $email)) {
                    $errors["email"] = "Invalid email format";
                    }
                }
                if (empty($address)) {
                    $errors["address"] = "Enter Address";
                }
                // Validate first name and last name
                if (!preg_match($namePattern, $firstname)) {
                    $errors["firstname"] = "Please enter a valid first name using letters, spaces, dots, hyphens, and single quotes.";
                }
                if(!empty($middlename)) {
                    if (!preg_match($namePattern, $middlename)) {
                        $errors["middlename"] = "Please enter a valid middle name using letters, spaces, dots, hyphens, and single quotes.";
                    }
                }
                if (!preg_match($namePattern, $lastname)) {
                    $errors["lastname"] = "Please enter a last name using letters, spaces, dots, hyphens, and single quotes.";
                }
        
                if (empty($errors)) {
                    // Add prefix in mobile number input
                    if (!empty($mobile)){
                        $prefixMobileNumber = "+63";
                        $mobile = $prefixMobileNumber . $mobile;
                    }
        
                    // Convert birthdate to YYYY-MM-DD format
                    $birthdateTimestamp = strtotime($birthdate);
                    $birthdate = date('Y-m-d', $birthdateTimestamp);
        
                    // Calculate age from birthdate
                    $currentTimestamp = time();
                    $ageInSeconds = $currentTimestamp - $birthdateTimestamp;
                    $age = floor($ageInSeconds / (365 * 24 * 3600));
                    $senior = $age >= 60 ? 1 : 0;
        
                    // Check if the username or email already exists in the database
                    $query = "SELECT * FROM users_masterlist WHERE firstname = '$firstname' AND lastname = '$lastname' AND birthdate = '$birthdate'";
                    $result = $this->connection->query($query);
        
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            if ($row['firstname'] == $firstname && $row['lastname'] == $lastname && $row['birthdate'] == $birthdate) {
                                $duplicateFirstNameLastNameBirthdate = true;
                                $error = "A resident with the same first name, last name, and birthdate already exists.";
                            }
                        }
                    }
        
                    if ($duplicateFirstNameLastNameBirthdate) {
                        $_SESSION['error'] = $error;
                        header("Location: masterlist");
                        exit();
                    } elseif (empty($error) && empty($errors)) {
                        // Insert the data into the users_masterlist table
                        $query = "INSERT INTO users_masterlist ( mobile, email, firstname, middlename, lastname, birthdate, age, gender, address, position, senior, four_ps, pwd, solo_parent, scholar)
                        VALUES ( '$mobile', '$email', '$firstname', '$middlename', '$lastname', '$birthdate', '$age', '$sex', '$address', '$position', $senior, $four_ps, $pwd, $solo_parent, $scholar)";
        
                        if ($this->connection->query($query) === true) {
                            // Retrieve the ID of the newly inserted row from users_masterlist
                            $newUserId = $this->connection->insert_id;
                    
                            // Get the latest ID from the health_info table and generate the next ID
                            $query = "SELECT MAX(id) AS max_id FROM health_info";
                            $result = $this->connection->query($query);
                    
                            if ($result->num_rows > 0) {
                                $row = $result->fetch_assoc();
                                $latestHealthInfoId = $row['max_id'];
                                // Generate the next ID by incrementing the latest ID
                                $nextHealthInfoId = $latestHealthInfoId + 1;
                            } else {
                                // If the health_info table is empty, start with an ID of 1
                                $nextHealthInfoId = 1;
                            }
                    
                            // Now, insert data into the health_info table using the generated ID
                            $query = "INSERT INTO health_info (id, firstname, middlename, lastname, age)
                            VALUES ('$nextHealthInfoId', '$firstname', '$middlename', '$lastname', '$age')";
                    
                            if ($this->connection->query($query) === true) {
                                // Both inserts were successful
                                header("Location: non-user");
                                $_SESSION['success'] = "The resident has been successfully added to the Non-User Residence.";
                                exit();
                            } else {
                                $_SESSION['error'] = "Error inserting data into the health_info table." . $this->connection->error;
                            }
                        } else {
                            $_SESSION['error'] = "Error inserting data into the users_masterlist table." . $this->connection->error;
                        }
                    }
                }
            } 
            elseif (isset($_POST['batch_upload'])) {
                // Batch upload logic
        
                $this->processBatchUpload();
            }
        }

        private function processBatchUpload()
        {
            // Set default values
            $age = 0;
            $position = 'residence';
            $senior = 0;
            $four_ps = 0;
            $pwd = 0;
            $solo_parent = 0;
            $scholar = 0;

            // Check if a file is uploaded
            if ($_FILES['csv_file']['error'] == UPLOAD_ERR_OK) {
                $file_name = $_FILES['csv_file']['name'];
                $temp_file = $_FILES['csv_file']['tmp_name'];

                // Validate if it's a CSV file
                $file_extension = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
                if ($file_extension != 'csv') {
                    $_SESSION['error'] = "Please upload a valid CSV file.";
                    header("Location: non-user");
                    exit();
                }

                // Process the CSV file
                $csv_data = array_map('str_getcsv', file($temp_file));
                $header = array_shift($csv_data); // Assuming the first row is the header
                $existingEntries = []; // To store unique entries based on firstname, lastname, and birthdate

                foreach ($csv_data as $row) {
                    // Extract data from CSV row
                    $email = isset($row[0]) ? $row[0] : "";
                    $mobile = isset($row[1]) ? $row[1] : "";
                    $firstname = isset($row[2]) ? $row[2] : "";
                    $middlename = isset($row[3]) ? $row[3] : "";
                    $lastname = isset($row[4]) ? $row[4] : "";
                    $address = isset($row[5]) ? $row[5] : "";
                    $birthdate = isset($row[6]) ? $row[6] : "";
                    $age = $this->calculateAge($birthdate); // Calculate age
                    $gender = isset($row[8]) ? $row[8] : "";
                    $role = isset($row[9]) ? $row[9] : "";
                    $position = isset($row[10]) ? $row[10] : "residence";
                    $senior = $age >= 60 ? 1 : 0;
                    $pwd = isset($row[12]) ? $row[12] : "";
                    $four_ps = isset($row[13]) ? $row[13] : "";
                    $solo_parent = isset($row[14]) ? $row[14] : "";
                    $scholar = isset($row[15]) ? $row[15] : "";
                    $error = '';
                    $errors = array();


                    // Check for duplicates within the CSV file
                    $csvEntry = "$firstname|$lastname|$birthdate"; // Create a unique key based on the columns you want to check
                    if (in_array($csvEntry, $existingEntries)) {
                        $_SESSION['error'] = "Duplicate entry found in the CSV file.";
                        header("Location: non-user");
                        exit();
                    }

                    // Check if the entry already exists in the database
                    $existingEntryQuery = "SELECT * FROM users_masterlist WHERE firstname = '$firstname' AND lastname = '$lastname' AND birthdate = '$birthdate'";
                    $existingEntryResult = $this->connection->query($existingEntryQuery);

                    if ($existingEntryResult->num_rows > 0) {
                        // Handle the case when the entry already exists
                        $_SESSION['error'] = "An entry with the same first name, last name, and birthdate already exists in the database.";
                        header("Location: non-user");
                        exit();
                    }

                    // Insert data into the users_masterlist table
                    $query = "INSERT INTO users_masterlist (email, mobile, firstname, middlename, lastname, address, birthdate, age, gender, role, position, senior, pwd, four_ps, solo_parent, scholar)
                            VALUES ('$email', '$mobile', '$firstname', '$middlename', '$lastname', '$address', STR_TO_DATE('$birthdate', '%Y-%m-%d'), '$age', '$gender', '$role', '$position', '$senior', '$pwd', '$four_ps', '$solo_parent', '$scholar')";

                    if ($this->connection->query($query) !== true) {
                        $_SESSION['error'] = "Error inserting data into the users_masterlist table." . $this->connection->error;
                        header("Location: non-user");
                        exit();
                    }

                    // Insert data into the health_info table (similar to your existing logic)
                    // ...
                }

                $_SESSION['success'] = "Batch upload successful.";
                header("Location: non-user");
                exit();
            } else {
                $_SESSION['error'] = "Error uploading the CSV file.";
                header("Location: non-user");
                exit();
            }
        }

        private function calculateAge($birthdate)
        {
            if ($birthdate === null) {
                // Handle the case where birthdate is null
                return 0; // or handle it in a way that makes sense for your application
            }
        
            // Convert the date format from 'yyyy-mm-dd' to DateTime object
            $birthdate = DateTime::createFromFormat('Y-m-d', $birthdate);
        
            if (!$birthdate) {
                // Handle invalid date format
                throw new Exception("Invalid date format: $birthdate");
            }
        
            $currentDate = new DateTime();
            $age = $currentDate->diff($birthdate)->y;
            return $age;
        }     

    function delete_resident() {
        if (isset($_POST['delete_resident'])) {
            // Retrieve the resident_id from the form input
            $resident_id = $_POST['resident_id'];
    
            $stmt = $this->connection->prepare("DELETE FROM users_masterlist WHERE id = ?");
            $stmt->bind_param("i", $resident_id); // Assuming id is an integer
            if ($stmt->execute()) {
                header("Location: /eBrgy/app/non-user");
                $_SESSION['success'] = "Resident was successfully deleted.";
                exit();
            } else {
                $_SESSION['error'] = "Error deleting resident: " . $stmt->error;
                header("Location: /eBrgy/app/non-user"); // Redirect even on error
                exit();
            }
    
            // Close the prepared statement
            $stmt->close();
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
        $scholarCount = 0;
    
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
                if ($row['scholar'] == 1) {
                    $scholarCount++;
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
            'scholarCount' => $scholarCount,
        );
    
        return $userReports;
    }

    public function getUserInMasterList() {
        if ($this->connection->error) {
            die("Connection failed: " . $this->connection->error);
        }
        
        if (isset($_POST['edit_resident'])) {
            $id = $_POST['resident_id'];
            $id = $this->connection->real_escape_string($id);
    
            // Create a SQL query to retrieve the health information for the given ID
            $query = "SELECT * FROM users_masterlist WHERE id = '$id'";
    
            $result = $this->connection->query($query);
    
            if ($result) {
                $docdatas[] = $result->fetch_assoc(); 
                return $docdatas; // Return the data as an associative array
            }
        }
    
        return array(); // Return an empty array if the condition is not met or if the query fails
    }

    function updateUserInMasterList() {

        if (isset($_POST['update_masterlist_user'])) {
            $id = $_POST['id'];
            $mobile = $_POST['mobile'];
            $address = $_POST['address'];
            $scholar = $_POST['scholar'];
            $four_ps = $_POST['four_ps'];
            $solo_parent = $_POST['solo_parent'];
            $senior = $_POST['senior'];
            // Use prepared statements to prevent SQL injection
            $stmt = $this->connection->prepare("UPDATE users_masterlist SET mobile = ?, address = ?, scholar = ?, four_ps = ?, solo_parent = ?, senior = ?  WHERE id = ?");
            $stmt->bind_param("ssssssi", $mobile, $address, $scholar, $four_ps, $solo_parent, $senior, $id); // Assuming user_id is an integer
    
            if ($stmt->execute()) {
                header("Location: /eBrgy/app/non-user");
                $_SESSION['success'] = "The resident masterlist information was successfully updated";
                exit();
            } else {
                $_SESSION['error'] = "Error updating user status: " . $stmt->error;
            }
    
            // Close the prepared statement
            $stmt->close();
        }
    }

    function getColumnNamesFromHealthInfoTable() {
        $columnNames = array();
    
        if ($this->connection->error) {
            die("Connection failed: " . $this->connection->error);
        }
    
        // Query to fetch the column names from the health_info table
        $query = "DESCRIBE health_info";
        $result = $this->connection->query($query);
    
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $columnName = $row['Field'];
                $columnNames[] = $columnName;
            }
        } else {
            $columnNames[] = "Column 1";
            $columnNames[] = "Column 2";
            // Add more default columns as needed
        }
    
        return $columnNames;
    } 

    public function addHealthInfoColumn() {

        if (isset($_POST['add_health_info_column'])) {
            $newColumnName = strtolower($_POST['new_column_name']);
    
            // Check if the new column name is not empty
            if (empty($newColumnName)) {
                $_SESSION['error'] = "Column name cannot be empty.";
                header("Location: health-information");
                exit();
            }
    
            // Sanitize the input to prevent SQL injection
            $newColumnName = $this->connection->real_escape_string($newColumnName);
    
            // Check if the column name already exists in the table
            $existingColumns = $this->getExistingColumns(); // Create a function to retrieve existing column names
            if (in_array($newColumnName, $existingColumns)) {
                $_SESSION['error'] = "Column name already exists in the table.";
                header("Location: health-information");
                exit();
            }
    
            // SQL statement to add a new VARCHAR column with a length of 255 to the table
            $sql = "ALTER TABLE health_info ADD $newColumnName VARCHAR(255)";
    
            // Execute the SQL statement
            if ($this->connection->query($sql) === TRUE) {
                $_SESSION['success'] = "New column was added successfully.";
                header("Location: health-information");
                exit;
            } else {
                $_SESSION['error'] = "Error adding new column: " . $this->connection->error;
                header("Location: health-information");
                exit();
            }
        }
    }

    // Create a function to retrieve existing column names
    private function getExistingColumns() {
        $existingColumns = array();
        $query = "SHOW COLUMNS FROM health_info";
        $result = $this->connection->query($query);
    
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $existingColumns[] = strtolower($row['Field']); // Convert to lowercase for case-insensitive comparison
            }
            $result->free();
        }
    
        return $existingColumns;
    }
    
    

    function getAllHealthInfo() {
       
        if ($this->connection->error) {
            die("Connection failed: " . $this->connection->error);
        }
    
        // Query to retrieve all data from the health_info table
        $query = "SELECT * FROM health_info";
        $result = $this->connection->query($query);
    
        // Array to store the retrieved data
        $healthInfoData = array();
    
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $healthInfoData[] = $row;
            }
        }
    
        return $healthInfoData;
    }

    public function getHealthInfoById() {
        if ($this->connection->error) {
            die("Connection failed: " . $this->connection->error);
        }
      if(isset($_POST['edit_health_info']))
      {
        $id = $_POST['id'];
        $id = $this->connection->real_escape_string($id);
    
        // Create a SQL query to retrieve the health information for the given ID
        $query = "SELECT * FROM health_info WHERE id = '$id'";
        
        $result = $this->connection->query($query);
    
        if ($result) {
            return $result->fetch_assoc(); // Return the data as an associative array
        } else {
            return null; // Return null if the query fails
        }
      }
    }

    public function save_new_health_information() {
        if ($this->connection->error) {
            die("Connection failed: " . $this->connection->error);
        }
    
        if (isset($_POST['save_health'])) {
            // Ensure you escape and validate the ID
            $id = $_POST['id'];
    
            // Create a SQL query to retrieve the health information for the given ID
            $query = "SELECT * FROM health_info WHERE id = '$id'";
    
            // Execute the query
            $result = $this->connection->query($query);
    
            if ($result) {
                $existingData = $result->fetch_assoc(); // Fetch existing data as an associative array
            } else {
                return "Error fetching existing data: " . $this->connection->error;
            }
    
            // Get the column names dynamically based on the form input
            $columnNames = array_keys($_POST);
    
            // Construct an SQL query to update the data dynamically
            $updateQuery = "UPDATE health_info SET ";
    
            foreach ($columnNames as $columnName) {
                if ($columnName !== 'id' && $columnName !== 'save_health') { // Exclude 'save_health' column
                    $columnValue = $_POST[$columnName];
                    // Ensure you sanitize user input to prevent SQL injection
                    $columnValue = $this->connection->real_escape_string($columnValue);
    
                    $updateQuery .= "$columnName = '$columnValue', ";
                }
            }
    
            $updateQuery = rtrim($updateQuery, ', ');
            $updateQuery .= " WHERE id = '$id'";
    
            if ($this->connection->query($updateQuery)) {
                $_SESSION['success'] = "Resident health information was updated successfully.";
                header("Location: health-information");
                exit;

            } else {
                return "Error updating data: " . $this->connection->error;
            }
            
        }
    }
    
    
    function getMasterList() {
        // Initialize an array to store the results
        $results = array();
        if ($this->connection->error) {
            die("Connection failed: " . $this->connection->error);
        }
    
        // Query to select all users from the "users" table where status is 'activated'
        $queryUsers = "SELECT * FROM users WHERE status = 'activated'";
        $resultUsers = $this->connection->query($queryUsers);
    
        if ($resultUsers->num_rows > 0) {
            // Fetch data from the "users" table
            while ($row = $resultUsers->fetch_assoc()) {
                $results['users'][] = $row;
            }
        }
    
        // Query to select all users from the "users_masterlist" table
        $queryMasterlist = "SELECT * FROM users_masterlist";
        $resultMasterlist = $this->connection->query($queryMasterlist);
    
        if ($resultMasterlist->num_rows > 0) {
            // Fetch data from the "users_masterlist" table
            while ($row = $resultMasterlist->fetch_assoc()) {
                $results['masterlist'][] = $row;
            }
        }
        return $results;
    }
    
    
    
    
    
    
}
?>
