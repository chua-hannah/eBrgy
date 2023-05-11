<?php
     // Define the HomeController class
     class HomeController {
        public function index() {
            // Example: Home page controller logic
            include 'pages/header.php';
            include 'pages/home.php';
            include 'pages/footer.php';
        }

        public function about() {
            // Example: About page controller logic
            include 'pages/header.php';
            include 'pages/about.php';
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
