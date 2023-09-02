<!-- <div class="container mt-5">
        <h1>Register</h1>
        register.php
<form action="" method="post">
    <input type="text" name="username" placeholder="Username" required>
    <input type="password" name="password" placeholder="Password" required>
    <input type="email" name="email" placeholder="Email" required>
    <input type="mobile" name="mobile" placeholder="Mobile number" required>
    <input type="text" name="fullname" placeholder="Full name" required>
    <input type="text" name="age" placeholder="Age" required>
    <select name="sex" required>
            <option value="">Sex</option>
            <option value="male">Male</option>
            <option value="female">Female</option>
        </select>
     Add more fields as needed
    <button type="submit" name="register">Register</button>
</form>

    </div>  -->


<section class="volunteer-section section-padding" id="section_4">
  <div class="container">
  <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-lg-6 col-12">
          <h2 class="text-white mb-4 text-center">Registration</h2>

          <form class="custom-form volunteer-form mb-5 mb-lg-0" action="" method="post" role="form">
              <h3 class="mb-4">Become a member today</h3>
              <p class="text-secondary">Plese provide your information</p>

              <div class="row">

                <div class="col-lg-12 col-12">
                  <input type="text" name="fullname" class="form-control" placeholder="Full name" value="<?php if (!empty($_POST["fullname"])) { echo $_POST["fullname"]; } else { echo ''; };?>" required>
                </div>

                <div class="col-lg-12 col-12">
                  <input type="text" name="mobile" class="form-control" placeholder="Mobile number" value="<?php if (!empty($_POST["mobile"])) { echo $_POST["mobile"]; } else { echo ''; };?>" required>
                </div>

                <div class="col-lg-12 col-12">
                    <input type="email" name="email"
                        pattern="[^ @]*@[^ @]*" class="form-control" placeholder="Email address" value="<?php if (!empty($_POST["email"])) { echo $_POST["email"]; } else { echo ''; };?>" required>
                </div>
                
                <div class="col-lg-6 col-12">
                  <input type="text" name="age" class="form-control" placeholder="Age" value="<?php if (!empty($_POST["age"])) { echo $_POST["age"]; } else { echo ''; };?>" required>
                </div>

                <div class="col-lg-6 col-12">
                  <select class="form-select" name="sex" required>
                    <option value="" hidden>Gender</option>
                    <option value="male" <?php if(isset($_POST["sex"]) && $_POST["sex"]=="male"){ echo 'selected';} ?>>Male</option>
                    <option value="female" <?php if(isset($_POST["sex"]) && $_POST["sex"]=="female"){ echo 'selected';} ?>>Female</option>
                    <option value="others" <?php if(isset($_POST["sex"]) && $_POST["sex"]=="others"){ echo 'selected';} ?>>Others</option>
                  </select>
                </div> 

                <div class="col-lg-6 col-12">
                    <input type="text" name="username" class="form-control" placeholder="Create Username" value="<?php if (!empty($_POST["username"])) { echo $_POST["username"]; } else { echo ''; };?>" required>
                </div>

                <div class="col-lg-6 col-12">
                    <input type="password" name="password" class="form-control" placeholder="Nominate Password" required>
                </div>

              </div>

              <button type="submit" name="register" class="form-control">Register</button>
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
