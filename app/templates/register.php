<section class="contact-section section-padding" id="section_6">
    <div class="container">
    <h2 class="mb-4 text-center">Registration</h2>
        <div class="row">
            <div class="col-lg-6 col-12 mx-auto">
                <form class="custom-form contact-form mb-4" action="" method="post" enctype="multipart/form-data" role="form">
                    <h3 class="mb-4">Become a member today</h3>
                    <p class="text-secondary">Please provide your information</p>
                    <div class="row">
                        <div class="form-floating col-lg-6 col-6 gx-1">
                            <input type="text" name="fullname" class="form-control" id="fullname" placeholder="Full name" value="<?php if (!empty($_POST["fullname"])) { echo $_POST["fullname"]; } else { echo ''; };?>" required>
                            <label for="fullname">Full name</label>
                        </div>

                        <div class="col-lg-6 col-6">
                            <input type="text" name="mobile" class="form-control" placeholder="Mobile number" value="<?php if (!empty($_POST["mobile"])) { echo $_POST["mobile"]; } else { echo ''; };?>" required>
                        </div>

                        <div class="col-lg-12 col-12">
                            <input type="email" name="email" pattern="[^ @]*@[^ @]*" class="form-control" placeholder="Email address" value="<?php if (!empty($_POST["email"])) { echo $_POST["email"]; } else { echo ''; };?>" required>
                        </div>

                        <div class="col-lg-6 col-12">
                            <input type="text" name="age" class="form-control" placeholder="Age" value="<?php if (!empty($_POST["age"])) { echo $_POST["age"]; } else { echo ''; };?>" required>
                        </div>

                        <div class="col-lg-6 col-12">
                            <select class="form-select" name="sex" placeholder="Gender" required>
                                <option value="" disabled selected>Gender</option>
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

                        <!-- Add file upload fields -->
                        <div class="col-lg-6 col-12">
                            <label for="id_selfie">Upload Selfie w/ ID:</label>
                            <input type="file" name="id_selfie" id="id_selfie" accept="image/*" required>
                        </div>

                        <div class="col-lg-6 col-12">
                            <label for="valid_id">Upload Valid ID:</label>
                            <input type="file" name="valid_id" id="valid_id" accept="image/*" required>
                        </div>
                        <button type="submit" name="register" class="form-control">Register</button>
                    </div>
                </form>
            </div>
            <div class="col-lg-6 col-md-6 col-12">
                <div class="custom-text-box mb-lg-0">
                    <h5 class="mb-3">Our Vision</h5>

                    <p>Sed leo nisl, posuere at molestie ac, suscipit auctor quis metus</p>

                    <ul class="custom-list mt-2">
                        <li class="custom-list-item d-flex">
                            <i class="bi-check custom-text-box-icon me-2"></i>
                            List 1
                        </li>

                        <li class="custom-list-item d-flex">
                            <i class="bi-check custom-text-box-icon me-2"></i>
                            List 2
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
