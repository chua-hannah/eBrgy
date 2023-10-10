<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/inputmask/5.0.4/inputmask.min.js"></script>  

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
        $username = $_SESSION['username'];
        echo '<li class="nav-item">';
        echo '<a class="nav-link" href="'.$baseUrl.'/profile">'.$username.'</a>';
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
</header>

<!-- Alerts -->
<?php
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
</script>

<div class="container">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-lg-2 mt-4">
            <ul class="nav flex-column mx-auto">
                <li class="nav-item mb-2">
                    <a class="nav-link" href="<?php echo $baseUrl; ?>/dashboard">Dashboard</a>
                </li>
                <li class="nav-item mb-2">
                    <a class="nav-link" href="<?php echo $baseUrl; ?>/attendance">Attendance</a>
                </li>
                <li class="nav-item mb-2">
                    <a class="nav-link" href="<?php echo $baseUrl; ?>/requests">Requests</a>
                </li>
                <?php if ($_SESSION['role'] === 'captain') { ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo $baseUrl; ?>/user-management">User Management</a>
                    </li>
                <?php } ?>
            </ul>
        </div>
        <div class="col-lg-10">
            <!-- Place your page content here -->