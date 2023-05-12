<?php
     // Define the HomeController class
     class HomeController {
        public function index() {
            // Example: Home page controller logic
            include 'pages/header.php';
            include 'pages/home.php';
            include 'pages/footer.php';
        }

        public function officials() {
            // Example: About page controller logic
            include 'pages/header.php';
            include 'pages/officials.php';
            include 'pages/footer.php';
        }
        public function contact() {
            // Example: About page controller logic
            include 'pages/header.php';
            include 'pages/contact.php';
            include 'pages/footer.php';
        }

        // Other home-related controller methods
        // ...
    }
?>
