<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
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
   
</head>
<body>
    <?php $baseUrl = "http://localhost/eBrgy/app";?>
<nav class="navbar navbar-expand-lg navbar-dark bg-success">
    <div class="container">
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
            <ul class="navbar-nav">
            </ul>
            <ul class="navbar-nav">
    <?php

    if (isset($_SESSION['username'])) {
        $fullname = $_SESSION['fullname'];
        echo '<li class="nav-item">';
        echo '<a class="nav-link" href="'.$baseUrl.'/profile">'.$fullname.'</a>';
        echo '</li>';
        echo '<li class="nav-item">';
        echo '<a class="nav-link" href="logout.php">Logout</a>';
        echo '</li>';
        
    } else {
        echo '<li class="nav-item">';
        echo '<a class="nav-link" href="login">Login</a>';
        echo '</li>';
        echo '<li class="nav-item">';
        echo '<a class="nav-link" href="register">Register</a>';
        echo '</li>';
    }
  
    ?>
</ul>

        </div>
    </div>
</nav>

<div class="container-fluid">
    
    <div class="row">
    <div class="col-lg-3 bg-light">
    <ul class="nav flex-column">
        <li class="nav-item">
            <a class="nav-link" href="<?php echo $baseUrl;?>/dashboard">Dashboard</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?php echo $baseUrl;?>/attendance">Attendance</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?php echo $baseUrl;?>/request-management">Request</a>
        </li>
        <?php
        // Check the user's role from the session and conditionally show the "User Management" tab
        if ($_SESSION['role'] === 'captain') {
            ?>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo $baseUrl;?>/user-management">User Management</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo $baseUrl;?>/settings">Settings</a>
            </li>
            <?php
        }
        ?>
      
    </ul>
</div>

        <div class="col-lg-9">

            <!-- Place your page content here -->

