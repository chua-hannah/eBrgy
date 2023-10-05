<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.6/jquery.inputmask.min.js"></script>


  <title>Barangay 95</title>
  <meta content="" name="description">
  <meta content="" name="keywords">
  
  <link href="assets/css/style.css" rel="stylesheet">
  
</head>

<body>
    
<!-- ======= Header ======= -->
<nav class="navbar navbar-expand-lg bg-light shadow-lg">
    <div class="container">
        <a class="navbar-brand" href="home">
            <img src="assets/images/Barangay.png" class="logo img-fluid" alt="Barangay 95">
            <span>
                Barangay 95
                <small>Manila</small>
            </span>
        </a>
        
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link <?php echo basename($_SERVER['REQUEST_URI']) == 'home' ? 'active' : ''; ?>" href="home">Home</a>
                    </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo basename($_SERVER['REQUEST_URI']) == 'officials' ? 'active' : ''; ?>" href="officials">Officials</a>
                </li>
                <?php
                    // Check if there is a logged-in user or session
                    if (isset($_SESSION['user_id'])) {
                        echo '<li class="nav-item">';
                        echo '<a class="nav-link '; echo basename($_SERVER['REQUEST_URI']) == 'services' ? 'active' : ''; echo '"href="services">Services</a>';
                    }
                ?>
                <li class="nav-item">
                    <a class="nav-link <?php echo basename($_SERVER['REQUEST_URI']) == 'contact' ? 'active' : ''; ?>" href="contact">Contact</a>
                </li>
                <?php
                        if (isset($_SESSION['username'])) {
                            $username = $_SESSION['username'];
                            echo '<li class="nav-item">';
                            echo '<a class="nav-link '; echo basename($_SERVER['REQUEST_URI']) == 'profile' ? 'active' : ''; echo '"href="profile">'.$username.'</a>';
                            echo '</li>';
                            echo '<li class="nav-item">';
                            echo '<a class="nav-link" href="logout.php">Logout</a>';
                            echo '</li>';
                            
                        } else {
                            echo '<li class="nav-item">';
                            echo '<a class="nav-link '; echo basename($_SERVER['REQUEST_URI']) == 'login' ? 'active' : ''; echo '"href="login">Login</a>';
                            echo '</li>';
                            echo '<li class="nav-item">';
                            echo '<a class="nav-link ';  echo basename($_SERVER['REQUEST_URI']) == 'register' ? 'active' : ''; echo '"href="register">Register</a>';
                            echo '</li>';
                        }
                    ?>
                </ul>
            </div>
        </div>
    </nav>
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
<!-- Modal for success registration -->
<div class="modal fade" id="registrationSuccessModal" tabindex="-1" role="dialog" aria-labelledby="registrationSuccessModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
        <div class="modal-header text-center">
            <h4 class="modal-title w-100" id="registrationSuccessModalLabel">Registration Success!</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <h6>Thank you for registering, Ka-Barangay 95.</h6>
        <p class="mt-4 mb-0"><i class="bi bi-exclamation-circle"></i> Before you can log in, please wait for your account to be verified by the administrator within 24 hours.</p>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
        </div>
    </div>
  </div>
</div>
<?php
if (isset($_SESSION['registration_successful']) && $_SESSION['registration_successful']) {
    // Display the modal if registration was successful
    echo '<script>$(document).ready(function() { showRegistrationSuccessModal(); });</script>';
    // Reset the session variable
    $_SESSION['registration_successful'] = false;
}
?>
<script>
function showRegistrationSuccessModal() {
    $('#registrationSuccessModal').modal('show');
}
</script>