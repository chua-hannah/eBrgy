<section class="volunteer-section section-padding" id="section_4">
  <div class="container">
    <div class="row d-flex justify-content-center align-items-center">
      <div class="col-lg-6 col-12">
        <h2 class="mt-4 mb-4 text-center">Login</h2>
        <form class="custom-form volunteer-form mb-4 needs-validation" action="" id="login" method="post" role="form">
        <h3 class="mb-4">Sign into your account</h3>
        <div class="row">
          <div class="col-lg-12 col-12">
            <input type="text" name="username" id="username-login" class="form-control
            <?php echo isset($error) ? 'is-invalid' : ''; ?>" 
              placeholder="Enter Username" value="<?php if (!empty($_POST["username"])) { echo $_POST["username"]; } else { echo ''; };?>">
          </div>

          <div class="col-lg-12 col-12">
            <input type="password" name="password" id="password-login" class="form-control
            <?php echo isset($error) ? 'is-invalid' : ''; ?> mb-4"  placeholder="Enter Password">
          </div>
          <!-- Display error message -->
          <?php if (isset($error)) : ?>
            <div class="text-danger mb-4"><?= $error ?></div>
          <?php endif; ?>
        </div>
        <button type="submit" name="login" class="form-control">Login</button>
        </form>
      </div>
    </div>
  </div>
</section>