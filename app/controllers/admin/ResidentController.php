<?php
require_once 'Resident.php';

// Database configuration
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "admin_dashboard";

// Handle the request
$resident = new Resident($servername, $username, $password, $dbname);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Create a new resident
    if (isset($_POST["create"])) {
        $name = $_POST["name"];
        $email = $_POST["email"];
        $phone = $_POST["phone"];
        $address = $_POST["address"];
        $profilePicture = $_FILES["profile_picture"];
        
        $resident->createResident($name, $email, $phone, $address, $profilePicture);
        // Redirect to resident list page or display a success message
    }
    
    // Update an existing resident
    if (isset($_POST["update"])) {
        $id = $_POST["id"];
        $name = $_POST["name"];
        $email = $_POST["email"];
        $phone = $_POST["phone"];
        $address = $_POST["address"];
        $profilePicture = $_FILES["profile_picture"];
        
        $resident->updateResident($id, $name, $email, $phone, $address, $profilePicture);
        // Redirect to resident list page or display a success message
    }
}

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // Delete a customer
    if (isset($_GET["delete"])) {
        $id = $_GET["delete"];
        $resident->deleteResident($id);
        // Redirect to resident list page or display a success message
    }
}

// Fetch customers for display
$residents = $resident->getResidents();

$resident->closeConnection();
