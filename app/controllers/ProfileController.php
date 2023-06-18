<?php
class ProfileController {
    public function profile() {
      // Render the home page content
      include 'templates/profile.php';
    }
    public function admin() {
      // Render the home page content
      include 'templates/dashboard.php';
    }
  }
  
?>