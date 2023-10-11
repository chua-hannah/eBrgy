<div class="container my-5">
  <div class="row d-flex justify-content-center align-items-center">
    <div class="col col-xl-10">
      <div class="card" style="border-radius: 1rem;">
        <div class="row g-0">
          <div class="col-md-6 col-lg-5 d-none d-md-block">
            <img src="assets/images/10061f000001gqvp3B034.jpg"
              alt="login form" class="img-fluid" style="border-radius: 1rem 0 0 1rem;" />
          </div>
          <div class="col-md-6 col-lg-7 d-flex align-items-center">
            <div class="card-body p-4 p-lg-5 text-black">

              <form class="custom-form needs-validation" action="" id="login" method="post" role="form">

                <div class="d-flex align-items-center mb-3 pb-1">
                  <img src="assets/images/Barangay.png" class="logo img-fluid" alt="Barangay 95">
                  <span class="h3 fw-bold mb-0" style="margin-left: 12px;color: #001e77">Welcome Ka-Barangay!</span>
                </div>

                <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Sign into your account</h5>

                <div class="form-outline mb-4">
                  <input type="text" name="username" id="username-login" class="form-control <?php echo isset($error) ? 'is-invalid' : ''; ?>" placeholder="Enter Username" value="<?php if (!empty($_POST["username"])) { echo $_POST["username"]; } else { echo ''; }; ?>">
                </div>

                <div class="form-outline mb-4">
                  <input type="password" name="password" id="password-login" class="form-control <?php echo isset($error) ? 'is-invalid' : ''; ?> mb-4" placeholder="Enter Password">
                  
                </div>
                <?php if (isset($error)) : ?>
                  <div class="col-lg-12 col-12 text-danger mb-4"><?= $error ?></div>
                <?php endif; ?>
                <div class="pt-1 mb-4">
                  <button type="submit" name="login" class="form-control">Login</button>
                </div>

                <p class="mb-5 pb-lg-2" style="color: #393f81;">Don't have an account? <a href="register"
                    >Register here</a></p>
              </form>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>