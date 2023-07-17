<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <title>Barangay Tibay</title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="home">Barangay Tibay</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-between" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="home">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="officials">Officials</a>
            </li>
            <?php
                // Check if there is a logged-in user or session
                if (isset($_SESSION['user_id'])) {
                    echo '<li class="nav-item">
                            <a class="nav-link" href="services">Services</a>
                        </li>';
                }
            ?>
            <li class="nav-item">
                <a class="nav-link" href="contact">Contact</a>
            </li>
        </ul>

            <ul class="navbar-nav">
    <?php
    if (isset($_SESSION['username'])) {
        $fullname = $_SESSION['fullname'];
        echo '<li class="nav-item">';
        echo '<a class="nav-link" href="profile">'.$fullname.'</a>';
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


