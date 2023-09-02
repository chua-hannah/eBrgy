<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

  <title>Barangay 95</title>
  <meta content="" name="description">
  <meta content="" name="keywords">
  
  <!-- CSS FILES -->
  <link href="assets/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/css/bootstrap-icons.css" rel="stylesheet">
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
                        echo '<li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle"
                            id="navbarLightDropdownMenuLink" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">Services</a>

                        <ul class="dropdown-menu dropdown-menu-light" aria-labelledby="navbarLightDropdownMenuLink">
                            <li><a class="dropdown-item" href="services">Service 1</a></li>

                            <li><a class="dropdown-item" href="services">Service 2</a></li>
                        </ul>                        
                        </li>';
                    }
                ?>
                <li class="nav-item">
                    <a class="nav-link <?php echo basename($_SERVER['REQUEST_URI']) == 'contact' ? 'active' : ''; ?>" href="contact">Contact</a>
                </li>
                <?php
                        if (isset($_SESSION['username'])) {
                            $fullname = $_SESSION['fullname'];
                            echo '<li class="nav-item">';
                            echo '<a class="nav-link '; echo basename($_SERVER['REQUEST_URI']) == 'profile' ? 'active' : ''; echo '"href="profile">'.$fullname.'</a>';
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