<?php
class UserManagementController {
    public function index() {
      // Render the home page content
      include 'templates/dashboard.php';
    }
    public function user_management() {
      // Render the home page content
      include 'templates/admin/user_management.php';
    }
  }
  
?>