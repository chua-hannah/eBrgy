<?php
session_start();

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

switch ($filename) {
    case 'login':
        includeHeaderFooter(function() use ($userController) {
            $userController->login();
        });
        break;

    case 'register':
        includeHeaderFooter(function() use ($userController) {
            $userController->register();
        });
        break;

    case 'logout.php':
        $userController->logout();
        break;

    default:
        $user = isset($_SESSION['username']) ? $_SESSION['username'] : null;
        $role = isset($_SESSION['role']) ? $_SESSION['role'] : null;

        if ($user && $role) {
            switch ($role) {
                case 'kagawad':
                    switch ($filename) {
                        case 'dashboard':
                            includeAdminContent(function() use ($dashboardController) {
                                $userData = $dashboardController->users_count();
                                $attendanceData = $dashboardController->attendance_count();
                                $requestData = $dashboardController->request_count();
                                $data = array_merge($userData, $attendanceData, $requestData);
                                include 'templates/admin/dashboard.php';
                            });
                            break;
                        case 'profile':
                            includeAdminContent(function() use ($profileController) {
                                $profileController->profile();
                            });
                            break;
                        case 'attendance':
                            includeAdminContent(function() use ($attendanceController) {
                                $attendanceData = $attendanceController->attendance();
                                $my_attendance = $attendanceController->my_attendance();
                                $office_time = $attendanceController->get_time_settings();
                              
                                include 'templates/admin/attendance/attendance.php';
                            });
                            break;
                        case 'request-management':
                            includeAdminContent(function() use ($requestManagementController) {
                                $requests = $requestManagementController->request_management();
                                include 'templates/admin/request_management.php';
                            });
                            break;
                        default:
                        header("Location: " . $baseUrl . "/dashboard");
                        exit;
                    }
                    break;

                case 'residence':
                    switch ($filename) {
                        case 'home':
                        case 'officials':
                        case 'contact':
                      
                            includeHeaderFooter(function() use ($homeController, $filename) {
                                $homeController->$filename();
                            });
                            break;
                        case 'profile':
                            includeHeaderFooter(function() use ($profileController, $filename) {
                                $user_id = $_SESSION['user_id'];
                                $user_data = $profileController->$filename($user_id);
                                include 'templates/profile.php';
                            });
                            break;
                        case 'services':
                            includeHeaderFooter(function() use ($homeController, $filename) {
                                $homeController->$filename();        
                            });
                            break;
                        case 'documents':
                            includeHeaderFooter(function() use ($homeController, $filename, $settingsController) {
                                $username = $_SESSION['username'];
                                $mobile = $_SESSION['mobile'];
                                $email = $_SESSION['email'];
                                $homeController->$filename();
                                $requests = $settingsController->get_request_settings(); // Call the function here
                                $myrequest = $homeController->get_doc_requests($username, $mobile, $email);
                                include 'templates/docs.php';
                            });
                            break;
                        case 'reports':
                            includeHeaderFooter(function() use ($homeController, $filename, $settingsController) {
                                $username = $_SESSION['username'];
                                $mobile = $_SESSION['mobile'];
                                $email = $_SESSION['email'];
                                $homeController->$filename();  
                             
                                include 'templates/reports.php';      
                            });
                            break;      
                        case 'equipments':
                            includeHeaderFooter(function() use ($homeController, $filename, $settingsController) {
                                $username = $_SESSION['username'];
                                $mobile = $_SESSION['mobile'];
                                $email = $_SESSION['email'];
                                $homeController->$filename();   
                                $requests = $settingsController->get_equipments_list(); // Call the function here
                                $myrequest = $homeController->get_equipment_requests($username, $mobile, $email);   

                                include 'templates/equipments.php';      
  
                            });
                            break; 
                        default:
                        header("Location: " . $baseUrl . "/home");
                        exit();
                    }
                    break;

                case 'captain':
                    switch ($filename) {
                        case 'dashboard':
                            includeAdminContent(function() use ($dashboardController) {
                                $userData = $dashboardController->users_count();
                                $attendanceData = $dashboardController->attendance_count();
                                $requestData = $dashboardController->request_count();
                                $data = array_merge($userData, $attendanceData, $requestData);
                                include 'templates/admin/dashboard.php';
                            });
                            break;
                        case 'profile':
                            includeAdminContent(function() use ($profileController, $filename) {
                                $user_id = $_SESSION['user_id'];
                                $user_data = $profileController->$filename($user_id);
                                include 'templates/admin/profile.php';
                            });
                            break;
                        case 'attendance':
                            includeAdminContent(function() use ($attendanceController) {
                                $attendanceData = $attendanceController->attendance();
                                $my_attendance = $attendanceController->my_attendance();
                                $office_time = $attendanceController->get_time_settings();
                              
                                include 'templates/admin/attendance/attendance.php';
                            });
                            break;
                        case 'user-management':
                            includeAdminContent(function () use ($userManagementController) {
                                $userManagementController->index();
                            });
                            break;
                        case 'user-management/add-user':
                            includeAdminContent(function () use ($userManagementController) {
                                $userManagementController->add();
                            });
                            break;
                            case 'user-management/edit-user':
                                // Check if the userId parameter is present in the POST data
                                $userId = isset($_POST['userId']) ? $_POST['userId'] : null;
                                
                                includeAdminContent(function () use ($userManagementController, $userId) {
                                    $userManagementController->edit($userId);
                                    $userManagementController->activate_user($userId);
                                    $userManagementController->deactivate_user($userId);
                                });
                                break;
                        case 'requests':
                            includeAdminContent(function() use ($requestManagementController) {
                                include 'templates/admin/requests.php';   
                            });
                            break;
                        case 'requests/documents':
                            includeAdminContent(function() use ($requestManagementController) {
                                $requests = $requestManagementController->doc_requests();
                                include 'templates/admin/doc_requests.php';
                                
                            });
                            break;
                        case 'requests/documents-management':
                            includeAdminContent(function() use ($requestManagementController, $settingsController) {
                                $settingsController->request_setting();
                                $requests = $settingsController->get_request_settings();
                                include 'templates/admin/request_management/doc_management.php';
                                
                            });
                            break;
                        case 'requests/reports':
                            includeAdminContent(function() use ($requestManagementController) {
                                $requests = $requestManagementController->report_requests();
                                include 'templates/admin/report_requests.php';
                                
                            });
                            break;
                        case 'requests/equipments':
                            includeAdminContent(function() use ($requestManagementController) {
                                $requests = $requestManagementController->equipment_requests();
                                include 'templates/admin/equipment_requests.php';
                                
                            });
                            break;
                        case 'requests/equipments-management':
                            includeAdminContent(function() use ($requestManagementController, $settingsController) {
                                $settingsController->add_equipment_setting();
                                $requests = $settingsController->get_equipments_list();
                                include 'templates/admin/request_management/equipment_management.php';
                                
                            });
                            break;
                        case 'settings':
                            includeAdminContent(function() use ($settingsController) {
                                $settingsController->attendance_setting();
                                $office_time = $settingsController->get_time_settings();
                                include 'templates/admin/settings.php';
                            });
                            break;
                        default:
                            
                        header("Location: " . $baseUrl . "/dashboard");
                        exit;
                    }
                    break;

                default:
                    includeHeaderFooter(function() use ($homeController) {
                        $homeController->home();
                    });
                    break;
            }
        } else {
            switch ($filename) {
                case 'home':
                case 'officials':
                case 'contact':
                    includeHeaderFooter(function() use ($homeController, $filename) {
                        $homeController->$filename();
                    });
                    break;
                default:
                    header('Location: login');
                    break;
            }
        }
        break;
      
}
$connection->close();
?>