<?php
session_start();
require_once 'includes/User.php';
require_once 'controllers/HomeController.php';
require_once 'controllers/UserController.php';
//admin Controllers
require_once 'controllers/ProfileController.php';
require_once 'controllers/admin/UserManagementController.php';
require_once 'controllers/admin/DashboardController.php';
require_once 'controllers/admin/RequestManagementController.php';
require_once 'controllers/admin/AttendanceController.php';
require_once 'controllers/admin/SettingsController.php';

$userController = new UserController($connection);
$homeController = new HomeController($connection);
//Admin Controllers
$dashboardController = new DashboardController($connection);
$profileController = new ProfileController($connection);
$userManagementController = new UserManagementController($connection);
$requestManagementController = new RequestManagementController($connection);
$attendanceController = new AttendanceController($connection);
$settingsController = new SettingsController($connection);

$baseUrl = "http://localhost/eBrgy/app"; // Replace with your actual base URL
$requestUri = $_SERVER['REQUEST_URI'];
$basePath = parse_url($baseUrl, PHP_URL_PATH);
$trimmedPath = trim(str_replace($basePath, '', $requestUri), '/');
$filename = $trimmedPath;

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
        if ($role === 'kagawad') {
            // Admin-specific routes
            if ($filename === 'dashboard') {
                includeAdminContent(function() use ($dashboardController) {
                    $dashboardController->users();
                });
            }  else if ($filename === 'profile') {
                includeAdminContent(function() use ($profileController) {
                    $profileController->profile();
                });
            } else if ($filename === 'attendance') {
                includeAdminContent(function() use ($attendanceController) {
                    $attendanceController->attendance();
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
        } else if ($role === 'residence') {
            // Residence-specific routes
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
            } else {
                // Handle other residence routes or redirect to default page
                includeHeaderFooter(function() use ($homeController) {
                    $homeController->index();
                });
            }
        } else if ($role === 'captain') {
            // Captain-specific routes
            if ($filename === 'dashboard') {
                includeAdminContent(function() use ($dashboardController) {
                    $userData = $dashboardController->users();
                    $attendanceData = $dashboardController->attendance();
                    $data = array_merge($userData, $attendanceData);
                    // Pass the data to the template
                    include 'templates/admin/dashboard.php';
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
                    $userManagementController->index();
                });
            }else if ($filename === 'user-management/add-user') {
                includeAdminContent(function () use ($userManagementController) {
                    $userManagementController->add();
                });
            }  else if ($filename === 'request-management') {
                includeAdminContent(function() use ($requestManagementController) {
                    $requestManagementController->request_management();
                });
            }else if ($filename === 'settings') {
                includeAdminContent(function() use ($settingsController) {
                    $settingsController->attendance_setting();
                    include 'templates/admin/settings.php';
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
