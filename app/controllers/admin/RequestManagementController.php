<?php
class RequestManagementController {
    public function index() {
      // Render the home page content
      include 'templates/dashboard.php';
    }
    public function request_management() {
      // Render the home page content
      include 'templates/admin/request_management.php';
    }
  }
  
?>