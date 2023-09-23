<section class="contact-section section-padding" id="section_6">
    <div class="container">
    <h2 class="mb-4 text-center">Register an account</h2>
        <div class="row d-flex justify-content-center align-items-center">
            <div class="col-lg-8 col-12">
                <form class="custom-form contact-form mb-4 align-items-center" id="register" action="" method="post" enctype="multipart/form-data" role="form" novalidate>
                    <h3 class="mb-4">Become a member today</h3>
                    <div class="row g-2">
                        <div class="col-lg-12 col-12">
                            <h5 class="mb-3">Personal information</h5>
                        </div>

                        <div class="col-lg-4 col-12">
                            <input type="text" name="fullname" class="form-control <?php echo isset($errors["fullname"]) ? 'is-invalid' : ''; ?>" id="firstname" placeholder="First name" value="<?php if (!empty($_POST["fullname"])) { echo $_POST["fullname"]; } else { echo ''; };?>" >
                            <?php if (isset($errors["fullname"])) : ?>
                                <div class="text-danger"><?= $errors["fullname"] ?></div>
                            <?php endif; ?>
                        </div>

                        <div class="col-lg-4 col-12">
                            <input type="text" name="middlename" class="form-control" id="middlename" placeholder="Middle name (Optional)" value="<?php if (!empty($_POST["fullname"])) { echo $_POST["fullname"]; } else { echo ''; };?>">
                        </div>

                        <div class="col-lg-4 col-12">
                            <input type="text" name="lastname" class="form-control" id="lastname" placeholder="Last name" value="<?php if (!empty($_POST["lastname"])) { echo $_POST["lastname"]; } else { echo ''; };?>" >
                            <?php if (isset($errors["lastname"])) : ?>
                                <div class="text-danger"><?= $errors["lastname"] ?></div>
                            <?php endif; ?>
                        </div>

                        <div class="col-lg-6 col-12">
                            <input type="text" name="age" class="form-control" id="birthdate" placeholder="Birthdate (MM/DD/YYYY)" value="<?php if (!empty($_POST["age"])) { echo $_POST["age"]; } else { echo ''; };?>" >
                            <div class="invalid-feedback">
                                Please enter a valid birthdate in mm/dd/yyyy format.
                            </div>
                        </div>

                        <div class="col-lg-6 col-12">
                            <select class="form-select" name="sex" placeholder="Gender">
                                <option value="" disabled selected>Gender</option>
                                <option value="male" <?php if(isset($_POST["sex"]) && $_POST["sex"]=="male"){ echo 'selected';} ?>>Male</option>
                                <option value="female" <?php if(isset($_POST["sex"]) && $_POST["sex"]=="female"){ echo 'selected';} ?>>Female</option>
                                <option value="others" <?php if(isset($_POST["sex"]) && $_POST["sex"]=="others"){ echo 'selected';} ?>>Others</option>
                            </select>
                            <?php if (isset($errors["sex"])) : ?>
                                <div class="text-danger"><?= $errors["sex"] ?></div>
                            <?php endif; ?>
                        </div> 

                        <div class="col-lg-12 col-12">
                            <h5 class="mb-3">Contact Info</h5>
                        </div>

                        <div class="col-lg-6 col-12">
                            <div class="input-group">
                                <span class="input-group-text">+63</span>
                                <input type="text" name="mobile" class="form-control" id="mobile" placeholder="Mobile Number" oninput="validateNumericInput(this)" maxlength="10" >
                            </div>
                            <?php if (isset($errors["mobile"])) : ?>
                                    <div class="text-danger"><?= $errors["mobile"] ?></div>
                            <?php endif; ?>
                        </div>

                        <div class="col-lg-6 col-12">
                            <input type="email" name="email" pattern="[^ @]*@[^ @]*" class="form-control" id="email" placeholder="Email address" value="<?php if (!empty($_POST["email"])) { echo $_POST["email"]; } else { echo ''; };?>" >
                            <?php if (isset($errors["email"])) : ?>
                                    <div class="text-danger"><?= $errors["email"] ?></div>
                            <?php endif; ?>
                        </div>
                        
                        <div class="col-lg-12 col-12">
                            <h5 class="mb-3">Documents</h5>
                        </div>

                        <!-- Add file upload fields -->
                        <div class="col-lg-6 col-12">
                            <label for="id_selfie">Upload Selfie w/ ID:</label>
                            <input type="file" name="id_selfie" id="id_selfie" class="form-control" accept="image/*" >
                            <?php if (isset($errors["id_selfie"])) : ?>
                                    <div class="text-danger"><?= $errors["id_selfie"] ?></div>
                            <?php endif; ?>
                        </div>

                        <div class="col-lg-6 col-12">
                            <label for="valid_id">Upload Valid ID:</label>
                            <input type="file" name="valid_id" id="valid_id" class="form-control" accept="image/*" >
                            <?php if (isset($errors["valid_id"])) : ?>
                                    <div class="text-danger"><?= $errors["valid_id"] ?></div>
                            <?php endif; ?>
                        </div>

                        <div class="col-lg-12 col-12">
                            <h5 class="mb-3">Access Credentials</h5>
                        </div>
                        
                        <div class="col-lg-6 col-12">
                            <input type="text" name="username" class="form-control" id="username" placeholder="Create Username (Must be 6 characters long)" value="<?php if (!empty($_POST["username"])) { echo $_POST["username"]; } else { echo ''; };?>">
                            <?php if (isset($errors["username"])) : ?>
                                <div class="text-danger"><?= $errors["username"] ?></div>
                            <?php endif; ?>
                            <div class="invalid-feedback"></div>
                        </div>

                        <div class="col-lg-6 col-12">
                            <input type="password" name="password" class="form-control" id="password" placeholder="Nominate Password (Minimum of 8 characters)">
                            <?php if (isset($errors["password"])) : ?>
                                <div class="text-danger"><?= $errors["password"] ?></div>
                            <?php endif; ?>
                            <div class="invalid-feedback"></div>
                        </div>
                        <!-- Display error message -->
                        <?php if (isset($error)) : ?>
                            <div class="text-danger mt-2 mb-2"><?= $error ?></div>
                        <?php endif; ?>
                        <button type="submit" name="register" class="form-control mt-4">Register</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>