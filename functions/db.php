<?php
    // Example: Database connection function
    function connectDB() {
        $dbHost = 'localhost';
        $dbUser = 'username';
        $dbPassword = 'password';
        $dbName = 'database_name';

        $conn = mysqli_connect($dbHost, $dbUser, $dbPassword, $dbName);
        if (!$conn) {
            die('Database connection error: ' . mysqli_connect_error());
        }

        return $conn;
    }

    // Other database-related functions
    // ...
?>
