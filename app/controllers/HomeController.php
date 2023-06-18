<?php
class HomeController {
    public function index() {
      // Render the home page content
      include 'templates/home.php';
    }
    public function admin() {
      // Render the home page content
      include 'templates/admin/dashboard.php';
    }
  }
  
?>