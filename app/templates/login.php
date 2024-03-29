<!-- <h2>Login</h2>
    <form method="POST" action="">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br><br>
        
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br><br>
        
        <input type="submit" name="login">
    </form> -->
    <section class="volunteer-section section-padding" id="section_4">
  <div class="container">
  <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-lg-6 col-12">
          <h2 class="text-white mb-4 text-center">Login</h2>

          <form class="custom-form volunteer-form mb-5 mb-lg-0" action="" method="post" role="form">
              <h3 class="mb-4">Sign into your account</h3>

              <div class="row">

              <div class="col-lg-12 col-12">
                <input type="text" name="username" class="form-control" placeholder="Enter Username" value="<?php if (!empty($_POST["username"])) { echo $_POST["username"]; } else { echo ''; };?>" required>
              </div>

              <div class="col-lg-12 col-12">
                <input type="password" name="password" class="form-control" placeholder="Enter Password" required>
              </div>

              </div>

              <button type="submit" name="login" class="form-control">Login</button>
              <?php
              if(isset($_SESSION['status']))
              {
                echo $_SESSION['status'];
                unset($_SESSION['status']);
              }
              ?>
              
          </form>
      </div>
  </div>
</section>