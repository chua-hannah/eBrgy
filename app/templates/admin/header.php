<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">  
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

  <title>Barangay 95</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <link href="assets/css/style.css" rel="stylesheet">

    <?php
        // Check the user's role from the session and conditionally show the "User Management" tab
        if ($_SESSION['role'] === 'captain') {
            ?>
            <title>Captain Portal</title>
            <?php
        }
        else {
            ?>
             <title>Admin Portal</title>
            <?php
        }
        ?>

    <script>
            // Function to disable dates before the current date
            function disablePastDates() {
                var today = new Date().toISOString().split('T')[0];
                document.getElementById("date").setAttribute("min", today);
            }

            // Call the function when the page is fully loaded
            window.onload = disablePastDates;
    </script>
   
</head>
<body>
<header>
    <?php $baseUrl = "http://localhost/eBrgy/app";?>
    <nav class="navbar navbar-expand-lg bg-light shadow-lg">
    <div class="container-fluid">
    <?php
        // Check the user's role from the session and conditionally show the "User Management" tab
        if ($_SESSION['role'] === 'captain') {
            ?>
             <a class="navbar-brand" href="<?php echo $baseUrl;?>/dashboard">Captain Portal</a>
            <?php
        }
        else {
            ?>
             <a class="navbar-brand" href="<?php echo $baseUrl;?>/dashboard">Admin Portal</a>
            <?php
        }
        ?>
       
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-between" id="navbarNav">
            <ul class="navbar-nav"></ul>
            <ul class="navbar-nav">
            <?php
            if (isset($_SESSION['username'])) {
                $username = $_SESSION['username'];
                echo '<li class="nav-item">';
                echo '<a class="nav-link '; echo basename($_SERVER['REQUEST_URI']) == 'profile' ? 'active' : ''; echo '"href="'.$baseUrl.'/profile">'.$username.'</a>';
                echo '</li>';
                echo '<li class="nav-item">';
                echo '<a class="nav-link" href="logout.php">Logout</a>';
                echo '</li>';
                
            }
            ?>
            </ul>
        </div>
    </nav>
</header>
<main>
    <!-- Alerts -->
    <?php
    ob_start();
        if(isset($_SESSION['success'])) {
    ?>
        <div id="alert" class="alert alert-success mb-0" role="alert">
            <div class="row justify-content-center">
                <h6 class="alert-heading text-center">Success!</h6>
                <?php echo $_SESSION['success']; ?>
            </div>
        </div>
    <?php 
        unset($_SESSION['success']);
        }
    ?>
    <?php
        if(isset($_SESSION['error'])) {
    ?>
        <div id="alert" class="alert alert-danger mb-0" role="alert">
            <div class="row justify-content-center">
                <h6 class="alert-heading text-center">Error!</h6>
                <?php echo $_SESSION['error']; ?>
            </div>
        </div>
    <?php 
        unset($_SESSION['error']);
        }
    ?>
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-lg-2" id="sidebar">
            <ul class="nav flex-column">
                <li class="nav-item mb-2 <?php echo basename($_SERVER['REQUEST_URI']) == 'dashboard' ? 'active' : ''; ?>">
                    <a class="nav-link" href="<?php echo $baseUrl; ?>/dashboard">
                        <i class="bi bi-house-door"></i> Dashboard
                    </a>
                </li>
                <li class="nav-item mb-2 <?php echo basename($_SERVER['REQUEST_URI']) == 'attendance' ? 'active' : ''; ?>">
                    <a class="nav-link" href="<?php echo $baseUrl; ?>/attendance">
                        <i class="bi bi-calendar"></i> Attendance
                    </a>
                </li>
                <li class="nav-item mb-2 <?php echo basename($_SERVER['REQUEST_URI']) == 'requests' ? 'active' : ''; ?>">
                    <a class="nav-link" href="<?php echo $baseUrl; ?>/requests">
                        <i class="bi bi-file-earmark-text"></i> Requests
                    </a>
                </li>
                <?php if ($_SESSION['role'] === 'captain') { ?>
                    <li class="nav-item <?php echo basename($_SERVER['REQUEST_URI']) == 'user-management' ? 'active' : ''; ?>">
                        <a class="nav-link" href="<?php echo $baseUrl; ?>/user-management">
                            <i class="bi bi-person"></i> User Management
                        </a>
                    </li>
                <?php } ?>
            
                <li class="nav-item mb-2">
                    <a class="nav-link" href="javascript:void(0);" id="dropdownLink">
                        <i class="bi bi-file-earmark"></i> Report
                    </a>
                </li>

                <div class="collapse" id="dropdownTabs">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link <?php echo basename($_SERVER['REQUEST_URI']) == 'tab1' ? 'active' : ''; ?>" href="<?php echo $baseUrl; ?>/users-report">Users</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo basename($_SERVER['REQUEST_URI']) == 'tab2' ? 'active' : ''; ?>" href="<?php echo $baseUrl; ?>/requests-report">Requests</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo basename($_SERVER['REQUEST_URI']) == 'tab3' ? 'active' : ''; ?>" href="<?php echo $baseUrl; ?>/tab3">Free Tab</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo basename($_SERVER['REQUEST_URI']) == 'tab4' ? 'active' : ''; ?>" href="<?php echo $baseUrl; ?>/tab4">Free Tab 1</a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link <?php echo basename($_SERVER['REQUEST_URI']) == 'tab4' ? 'active' : ''; ?>" href="<?php echo $baseUrl; ?>/tab4">Free Tab 2</a>
                        </li>
                    </ul>
                </div>
            </ul>
        </div>
    <div class="col-lg-10" style="padding: 20px;">
    <!-- Place your page content here -->

<script>
document.addEventListener("DOMContentLoaded", function() {
    const dropdownLink = document.getElementById("dropdownLink");
    const dropdownTabs = document.getElementById("dropdownTabs");

    dropdownLink.addEventListener("click", function() {
        if (dropdownTabs.classList.contains("show")) {
            dropdownTabs.classList.remove("show");
        } else {
            dropdownTabs.classList.add("show");
        }
    });
});
</script>
