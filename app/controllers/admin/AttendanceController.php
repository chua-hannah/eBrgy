<?php
class AttendanceController {
    public function index() {
      // Render the home page content
      include 'templates/dashboard.php';
    }
    public function attendance() {
      // Render the home page content
      include 'templates/admin/attendance.php';
    }
  }
  
?>