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
require_once 'controllers/admin/ReportsController.php';
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
$reportsController = new ReportsController($connection);

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


function includeAdminContent($controller) {
    include 'templates/admin/header.php';
    $controller();
    include 'templates/admin/footer.php';
}

switch ($filename) {
    case 'login':
        includeHeaderFooter(function() use ($userController, $filename) {
            $userController->$filename();
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
                        exit();
                    }
                    break;

                case 'residence':
                    switch ($filename) {
                        case 'home':
                        includeHeaderFooter(function() use ($homeController, $filename) {
                            $homeSettings = $homeController->getHomeSettings();
                            include 'templates/home.php';                        
                        });
                        break;
                        case 'officials':
                            includeHeaderFooter(function() use ($homeController, $filename) {
                                $homeController->$filename();
                            });
                            break;
                        case 'schedules':
                            $username = $_SESSION['username'];
                            $reserved_schedule = isset($_POST['reserved_schedule']) ? $_POST['reserved_schedule'] : null;
                            includeHeaderFooter(function() use ($homeController, $username, $reserved_schedule) {
                                $myScheduleData = $homeController->get_schedule_requests($username);
                                $schedulesData = $homeController->get_schedules($reserved_schedule);
                                $reject_schedule = $homeController->reject_schedules($username);
                                include 'templates/schedules.php';      
                            });
                            break;
                        case 'schedule-request':
                            $homeController->req_schedule(); 
                            includeHeaderFooter(function() use ($homeController) {
                                include 'templates/schedule_request.php';   
                            });
                            break;
                        case 'contact':
                            includeHeaderFooter(function() use ($homeController, $filename) {
                                $homeController->$filename();
                            });
                            $homeSettings = $homeController->getHomeSettings();
                            break;
                        case 'profile':
                            includeHeaderFooter(function() use ($profileController, $filename) {
                                $user_id = $_SESSION['user_id'];
                                $user_data = $profileController->$filename($user_id);
                                $profileController->update_user_profile($user_id);
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
                                $requests = $settingsController->get_request_settings();
                                $myrequest = $homeController->get_doc_requests($username, $mobile, $email);
                                $reject_document = $homeController->reject_document($username);
                                include 'templates/docs.php';
                            });
                            break;
                        case 'indigency-certificate':
                            $docId = $_POST['id'];
                            $docRequestUserData = $homeController->print_doc($docId);
                            if (empty($docRequestUserData) || $docRequestUserData['status'] !== 'approved') {
                                header("Location: documents"); // Redirect to the 'documents.php' page
                                exit; 
                            }
                            include 'templates/certificates/indigency_cert.php';
                            break;
                        case 'first-job-certificate':
                            $docId = $_POST['id'];
                            $docRequestUserData = $homeController->print_doc($docId);
                            if (empty($docRequestUserData) || $docRequestUserData['status'] !== 'approved') {
                                header("Location: documents"); // Redirect to the 'documents.php' page
                                exit; 
                            }
                            include 'templates/certificates/firstjob_cert.php';
                            break;
                        case 'barangay-certificate':
                            $docId = $_POST['id'];
                            $docRequestUserData = $homeController->print_doc($docId);
                            if (empty($docRequestUserData) || $docRequestUserData['status'] !== 'approved') {
                                header("Location: documents"); // Redirect to the 'documents.php' page
                                exit; 
                            }
                            include 'templates/certificates/barangay_cert.php';
                            break;
                        case 'oath-certificate':
                            $docId = $_POST['id'];
                            $docRequestUserData = $homeController->print_doc($docId);
                            if (empty($docRequestUserData) || $docRequestUserData['status'] !== 'approved') {
                                header("Location: documents"); // Redirect to the 'documents.php' page
                                exit; 
                            }
                            include 'templates/certificates/oath_cert.php';
                            break;
                        case 'reports':
                            includeHeaderFooter(function() use ($homeController, $filename, $settingsController) {
                                $username = $_SESSION['username'];
                                $mobile = $_SESSION['mobile'];
                                $email = $_SESSION['email'];
                                $homeController->$filename();  
                                $myrequest = $homeController->get_reports($username, $mobile, $email);   
                                $reject_reports = $homeController->reject_reports($username);   
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
                                $reject_equipment = $homeController->reject_equipments();
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
                                $masterlistData = $dashboardController->masterlist_count();
                                $attendanceData = $dashboardController->attendance_count();
                                $equipRequestData = $dashboardController->equipment_request_count();
                                $scheduleRequestData = $dashboardController->schedule_request_count();
                                $reportsRequestData = $dashboardController->reports_request_count();
                                $requestData = $dashboardController->request_count();
                                $attendees = $dashboardController->attendees();
                                $data = array_merge($userData, $masterlistData, $attendanceData, $requestData, $equipRequestData, $scheduleRequestData, $reportsRequestData,  $attendees );
                                $families = $dashboardController->getCountOfUniqueAddressesWithMultipleUsers();
                                include 'templates/admin/dashboard.php';
                            });
                            break;
                        case 'profile':
                            includeAdminContent(function() use ($profileController, $filename) {
                                $user_id = $_SESSION['user_id'];
                                $user_data = $profileController->$filename($user_id);
                                $profileController->update_admin_profile($user_id);
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
                        case 'user-management-add-user':
                            includeAdminContent(function () use ($userManagementController) {
                                $userManagementController->add();
                            });
                            break;
                        case 'user-management-edit-user':
                            // Check if the userId parameter is present in the POST data
                            $userId = isset($_POST['userId']) ? $_POST['userId'] : null;
                            
                            includeAdminContent(function () use ($userManagementController, $userId) {
                                $userManagementController->edit($userId);
                                $userManagementController->activate_user($userId);
                                $userManagementController->deactivate_user($userId);
                                $userManagementController->delete_user($userId);
                            });
                            break;
                        case 'requests':
                            includeAdminContent(function() use ($requestManagementController) {
                                include 'templates/admin/requests.php';   
                            });
                            break;
                        case 'requests-documents':
                            includeAdminContent(function() use ($requestManagementController) {
                                $requests = $requestManagementController->doc_requests();
                                include 'templates/admin/doc_requests.php';
                                
                            });
                            break;
                        case 'requests-edit-document':
                            $doc_id = isset($_POST['doc_id']) ? $_POST['doc_id'] : null;
                            includeAdminContent(function() use ($requestManagementController,  $doc_id) {
                                $requestManagementController->edit_doc($doc_id);
                                $requestManagementController->approve_doc( $doc_id);
                                $requestManagementController->delete_doc($doc_id);
                            });
                            break;   
                        case 'requests-documents-management':
                            includeAdminContent(function() use ($requestManagementController, $settingsController) {
                                $settingsController->request_setting();
                                $requests = $settingsController->get_request_settings();
                                include 'templates/admin/request_management/doc_management.php';
                                
                            });
                            break;
                        case 'edit-document-management':
                            includeAdminContent(function() use ($requestManagementController, $settingsController) {
                                $docDatas = $requestManagementController->getDocById();
                                $requestManagementController->updateDocbyId();
                                include 'templates/admin/request_management/edit_doc_management.php';
                                
                            });
                            break;
                        case 'requests-reports':
                            includeAdminContent(function() use ($requestManagementController) {
                                $requests = $requestManagementController->report_requests();
                                include 'templates/admin/report_requests.php';
                                
                            });
                            break;
                        case 'requests-edit-report':
                            $report_id = isset($_POST['report_id']) ? $_POST['report_id'] : null;
                            includeAdminContent(function() use ($requestManagementController, $report_id) {
                                $requestManagementController->edit_report($report_id);
                                $requestManagementController->approve_report($report_id);
                                $requestManagementController->delete_report($report_id);
                            });
                            break;    
                        case 'requests-equipments':
                            includeAdminContent(function() use ($requestManagementController) {
                                $requests = $requestManagementController->equipment_requests();
                                include 'templates/admin/equipment_requests.php';
                                
                            });
                            break;
                        case 'requests-edit-equipment':
                            $equipment_id = isset($_POST['equipment_id']) ? $_POST['equipment_id'] : null;
                            $remarks = isset($_POST['remarks']) ? $_POST['remarks'] : null;
                            $message = isset($_POST['message']) ? $_POST['message'] : null;
                            $total_equipment_id = isset($_POST['total_equipment_id']) ? $_POST['total_equipment_id'] : null;

                            includeAdminContent(function() use ($requestManagementController, $equipment_id, $remarks, $message, $total_equipment_id) {
                                $requestManagementController->edit_equipment($equipment_id);
                                $requestManagementController->approve_equipment($equipment_id, $message, $total_equipment_id);
                                $requestManagementController->add_remarks($equipment_id, $remarks);
                                $requestManagementController->delete_equipment($equipment_id, $remarks, $total_equipment_id);
                                $requestManagementController->returned_equipment($equipment_id, $total_equipment_id);
                            });
                            break;     
                        case 'requests-equipments-management':
                            includeAdminContent(function() use ($requestManagementController, $settingsController) {
                                $settingsController->add_equipment_setting();
                                $requests = $settingsController->get_equipments_list();
                                include 'templates/admin/request_management/equipment_management.php';
                                
                            });
                            break;
                        case 'requests-schedules':
                            $reserved_schedule = isset($_POST['reserved_schedule']) ? $_POST['reserved_schedule'] : null;
                            $schedule_id = isset($_POST['schedule_id']) ? $_POST['schedule_id'] : null;

                            includeAdminContent(function() use ($requestManagementController, $reserved_schedule, $schedule_id) {
                                $latestSchedulesData = $requestManagementController->get_latest_list_schedules();
                                $latestSchedulesDataonClick = $requestManagementController->get_latest_list_schedules_onClick();
                                $schedulesData = $requestManagementController->get_list_schedules($reserved_schedule);
                                $requestManagementController->approve_schedule($schedule_id);
                                $requestManagementController->reject_schedule($schedule_id);
                                include 'templates/admin/schedule_requests.php';      
                            });
                            break; 
                        case 'requests/schedules-management':
                            includeAdminContent(function() use ($requestManagementController, $settingsController) {
                                $settingsController->add_equipment_setting();
                                $requests = $settingsController->get_equipments_list();
                                include 'templates/admin/request_management/equipment_management.php';
                                
                            });   
                        case 'users-report':
                            includeAdminContent(function() use ($reportsController, $filename) {
                                $usersReports = $reportsController->user_reports();
                                include 'templates/admin/reports/users_list.php';
                            });
                            break;
                        case 'requests-report':
                            includeAdminContent(function() use ($reportsController, $filename) {
                                $docReports = $reportsController->request_document_reports();
                                $reklamoReports = $reportsController->request_reklamo_reports();
                                $scheduleReports = $reportsController->request_schedule_reports();
                                $equipmentReports = $reportsController->request_equipment_reports();
                                include 'templates/admin/reports/request_reports.php';
                            });
                            break;
                        case 'masterlist':
                            includeAdminContent(function() use ($reportsController) {
                                $reportsController->register_to_masterlist();
                                $masterListReports = $reportsController->masterlist_reports();
                                $delete_resident = $reportsController->delete_resident();
                                include 'templates/admin/reports/users_master_list.php';
                            });
                            break;
                        case 'health-information':
                            includeAdminContent(function() use ($reportsController) {
                                $headers = $reportsController->getColumnNamesFromHealthInfoTable();
                                $healthInfos = $reportsController->getAllHealthInfo();
                                $reportsController->addHealthInfoColumn();
                                // $masterListReports = $reportsController->masterlist_reports();
                                // $delete_resident = $reportsController->delete_resident();
                                include 'templates/admin/health_info.php';
                            });
                            break;
                        case 'edit-health-information':
                            includeAdminContent(function() use ($reportsController) {
                                $usersHealthInfo = $reportsController->getHealthInfoById();
                                $reportsController->save_new_health_information();
                                include 'templates/admin/health_info_edit.php';
                            });
                            break;
                        case 'settings':
                            includeAdminContent(function() use ($settingsController) {
                                $settingsController->attendance_setting();
                                $office_time = $settingsController->get_time_settings();
                                include 'templates/admin/settings.php';
                            });
                            break;
                        case 'home-setting':
                            includeAdminContent(function() use ($settingsController, $homeController) {
                                $homeSettings = $homeController->getHomeSettings();
                                $settingsController->home_setting();
                                $settingsController->update_home_setting();
                                include 'templates/admin/homepage_settings.php';
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
                    includeHeaderFooter(function() use ($homeController, $filename) {
                       $homeSettings = $homeController->getHomeSettings();
                       include 'templates/home.php';

                    });
                    break;
                case 'officials':
                    includeHeaderFooter(function() use ($homeController, $filename) {
                        $homeController->officials();

                    });
                    break;
                case 'contact':
                    includeHeaderFooter(function() use ($homeController, $filename) {
                        $homeController->contact();
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