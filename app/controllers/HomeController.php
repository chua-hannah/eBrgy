<?php
class HomeController {
    public function index() {
      // Render the home page content
      include 'templates/home.php';
    }

    public function officials() {
      // Render the home page content
      include 'templates/officials.php';
    }
    public function services() {
      // Render the home page content
      include 'templates/services.php';
    }
    public function contact() {
      // Render the home page content
      include 'templates/contact.php';
    }
    public function admin() {
      // Render the home page content
      include 'templates/admin/dashboard.php';
    }
  }
  
?>