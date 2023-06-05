<?php
require_once 'includes/User.php';
require_once 'controllers/HomeController.php';
require_once 'controllers/UserController.php';
include 'templates/header.php';

$userController = new UserController($connection);
$homeController = new HomeController();

$requestUri = $_SERVER['REQUEST_URI'];
$path = parse_url($requestUri, PHP_URL_PATH);
$filename = basename($path);

if ($filename === 'login') {
    $userController->login();
} else if ($filename === 'register') {
    $userController->register();
} else {
    $homeController->index();
}

include 'templates/footer.php';
?>