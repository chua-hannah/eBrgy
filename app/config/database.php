<?php
$hostname = 'localhost'; // Replace with your database server hostname
$username = 'root'; // Replace with your database username
$password = ''; // Replace with your database password
$database = 'barangay_db'; // Replace with your database name

// Create a connection
$connection = new mysqli($hostname, $username, $password, $database);

// Check the connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}
?>
