<?php
session_start();
require_once 'includes/User.php';
require_once 'controllers/HomeController.php';
require_once 'controllers/UserController.php';
//admin Controllers
require_once 'controllers/ProfileController.php';
require_once 'controllers/admin/UserManagementController.php';
require_once 'controllers/admin/RequestManagementController.php';
require_once 'controllers/admin/AttendanceController.php';

$userController = new UserController($connection);
$homeController = new HomeController();
//Admin Controllers
$profileController = new ProfileController();
$userManagementController = new UserManagementController($connection);
$requestManagementController = new RequestManagementController();
$attendanceController = new AttendanceController();

$baseUrl = "http://localhost/eBrgy/app"; // Replace with your actual base URL
$requestUri = $_SERVER['REQUEST_URI'];
$path = parse_url($requestUri, PHP_URL_PATH);
$filename = basename($path);
$relativeUrl = substr($path, strlen($baseUrl));





function includeHeaderFooter($controller) {
    include 'templates/header.php';
    $controller();
    include 'templates/footer.php';
}

function includeAdminHeaderFooter($controller) {
    include 'templates/admin/header.php';
    $controller();
    include 'templates/admin/footer.php';
}

function includeAdminContent($controller) {
    include 'templates/admin/header.php';
    $controller();
    include 'templates/admin/footer.php';
}

if ($filename === 'login') {
    includeHeaderFooter(function() use ($userController) {
        $userController->login();
    });
} else if ($filename === 'register') {
    includeHeaderFooter(function() use ($userController) {
        $userController->register();
    });
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
                includeHeaderFooter(function() use ($homeController) {
                    $homeController->index();
                });
            }
        } else if ($role === 'residence') {
            // Residence-specific routes
            if ($filename === 'home') {
                includeHeaderFooter(function() use ($homeController) {
                    $homeController->index();
                });
            } else if ($filename === 'profile') {
                includeHeaderFooter(function() use ($profileController) {
                    $profileController->profile();
                });
            } else {
                // Handle other residence routes or redirect to default page
                includeHeaderFooter(function() use ($homeController) {
                    $homeController->index();
                });
            }
        } else if ($role === 'captain') {
            // Captain-specific routes
            if ($filename === 'dashboard') {
                includeAdminContent(function() use ($homeController) {
                    $homeController->admin();
                });
            } else if ($filename === 'profile') {
                includeAdminContent(function() use ($profileController) {
                    $profileController->profile();
                });
            } else if ($filename === 'attendance') {
                includeAdminContent(function() use ($attendanceController) {
                    $attendanceController->attendance();
                });
            } else if ($filename === 'user-management') {
                includeAdminContent(function () use ($userManagementController) {
                    $userManagementController->add();
                });
            } else if ($filename === 'request-management') {
                includeAdminContent(function() use ($requestManagementController) {
                    $requestManagementController->request_management();
                });
            } else {
                includeAdminHeaderFooter(function() use ($homeController) {
                    $homeController->admin();
                });
            }
        } else {
            // Unknown role, redirect to default page
            includeHeaderFooter(function() use ($homeController) {
                $homeController->index();
            });
        }
    } else {
        // User is not logged in
        if ($filename === 'home') {
            includeHeaderFooter(function() use ($homeController) {
                $homeController->index();
            });
        }
        else if ($filename === 'officials') {
            includeHeaderFooter(function() use ($homeController) {
                $homeController->officials();
            });
        }
        else if ($filename === 'services') {
            includeHeaderFooter(function() use ($homeController) {
                $homeController->services();
            });
        }
        else if ($filename === 'contact') {
            includeHeaderFooter(function() use ($homeController) {
                $homeController->contact();
            });
        }
        else {
            header('Location: login');
        }
    }
}
?>
