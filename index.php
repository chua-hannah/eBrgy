<?php
    // Include necessary files and start your application logic here
    require_once 'config.php';
    require_once 'functions/db.php';
    require_once 'functions/auth.php';

    // Include the HomeController class file
    require_once 'controllers/HomeController.php';

    // Create an instance of the HomeController class
    $homeController = new HomeController();

    // Determine the page to display based on the "page" parameter in the URL
    $page = isset($_GET['page']) ? $_GET['page'] : 'home';

    // Call the appropriate method based on the page parameter
    switch ($page) {
        case 'home':
            $homeController->index();
            break;
        case 'officials':
            $homeController->officials();
            break;
        case 'contact':
            $homeController->contact();
            break;
        default:
            $homeController->index();
            break;
    }
?>
