<?php
session_start();
require_once 'includes/User.php';
require_once 'controllers/HomeController.php';
require_once 'controllers/UserController.php';
require_once 'controllers/admin/UserManagementController.php';
require_once 'controllers/admin/RequestManagementController.php';


$userController = new UserController($connection);
$homeController = new HomeController();
$userManagementController = new UserManagementController();
$requestManagementController = new RequestManagementController();

$requestUri = $_SERVER['REQUEST_URI'];
$path = parse_url($requestUri, PHP_URL_PATH);
$filename = basename($path);

if ($filename === 'login') {
    $userController->login();
} else if ($filename === 'register') {
    $userController->register();
} else if ($filename === 'logout.php') {
    $userController->logout();
} else {
    $user = isset($_SESSION['username']) ? $_SESSION['username'] : null;
    $role = isset($_SESSION['role']) ? $_SESSION['role'] : null;

    if ($user && $role) {
        // User is logged in, check their role
        if ($role === 'admin') {
            // Admin-specific routes
            if ($filename === 'admin-page.php') {
                // Handle admin page
            } else if ($filename === 'manage-users.php') {
                // Handle user management
            } else {
                // Handle other admin routes or redirect to default page
                $homeController->index();
            }
        } else if ($role === 'residence') {
            // Residence-specific routes
            if ($filename === 'home') {
                include 'templates/header.php';

                // Handle residence page
                $homeController->index();
                include 'templates/footer.php';
            } else {
                // Handle other residence routes or redirect to default page
                $homeController->index();
            }
        } else if ($role === 'captain') {
            // Captain-specific routes
            if ($filename === 'dashboard') {
                include 'templates/admin/header.php';
                // Handle captain page
                $homeController->admin();
                include 'templates/admin/footer.php';
            }
            else if ($filename === 'user-management') {
                include 'templates/admin/header.php';
                // Handle captain page
                $userManagementController->user_management();
                include 'templates/admin/footer.php';
            }
            else if ($filename === 'request-management') {
                include 'templates/admin/header.php';
                // Handle captain page
                $requestManagementController->request_management();
                include 'templates/admin/footer.php';
            }
            else {
                include 'templates/admin/header.php';
                // Handle other captain routes or redirect to default page
                $homeController->admin();
                include 'templates/admin/footer.php';
            }
        } else {
            // Unknown role, redirect to default page
            $homeController->index();
        }
    } else {
        // User is not logged in, redirect to login page
        header('Location: login.php');
    }
}


?>
