<!DOCTYPE html>
<html>
<head>
    <title>Barangay 69</title>
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
   
</head>
<body>
    <!-- Your header content here -->
   
   <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="index.php">My Website</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item <?php echo (isset($_GET['page']) && $_GET['page'] == 'home') ? 'active' : ''; ?>">
                <a class="nav-link" href="index.php?page=home">Home</a>
            </li>
            <li class="nav-item <?php echo (isset($_GET['page']) && $_GET['page'] == 'officials') ? 'active' : ''; ?>">
                <a class="nav-link" href="index.php?page=officials">Officials</a>
            </li>
            <li class="nav-item <?php echo (isset($_GET['page']) && $_GET['page'] == 'contact') ? 'active' : ''; ?>">
                <a class="nav-link" href="index.php?page=contact">Contact</a>
            </li>
            <!-- Add more navigation links as needed -->
        </ul>
        <ul class="navbar-nav">
            <li class="nav-item <?php echo (isset($_GET['page']) && ($_GET['page'] == 'login' || $_GET['page'] == 'register')) ? 'active' : ''; ?>">
                <a class="nav-link" href="index.php?page=login">Login</a>
            </li>
            <li class="nav-item <?php echo (isset($_GET['page']) && $_GET['page'] == 'register') ? 'active' : ''; ?>">
                <a class="nav-link" href="index.php?page=register">Register</a>
            </li>
        </ul>
    </div>
</nav>

    
