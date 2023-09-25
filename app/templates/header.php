<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

  <title>Barangay 95</title>
  <meta content="" name="description">
  <meta content="" name="keywords">
  
  <!-- CSS FILES -->
  <!-- <link href="assets/css/bootstrap.min.css" rel="stylesheet"> -->
  <!-- <link href="assets/css/bootstrap-icons.css" rel="stylesheet"> -->
  <link href="assets/css/style.css" rel="stylesheet">
</head>

<body id="section_1">
    
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
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
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
        if(isset($_SESSION['status'])) {
    ?>
        <div id="alert" class="alert alert-success fade show" style="margin-bottom: 0px;  border-radius: 0;" role="alert">
            <div class="row justify-content-center">
                <strong class="text-center" style="mx-auto">Success!</strong><?php echo $_SESSION['status']; ?>
        </div>
        <?php 
        unset($_SESSION['status']);
        }
    ?>
    </div>
