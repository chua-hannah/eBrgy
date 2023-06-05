<?php
    class UserController {
        public function login() {
          // Render the login page content
          include 'templates/login.php';
        }
      
        public function register() {
          // Render the register page content
          include 'templates/register.php';
        }
      }
      
?>