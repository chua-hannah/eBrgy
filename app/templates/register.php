<section class="contact-section section-padding" id="section_6">
    <div class="container">
    <h2 class="mb-4 text-center">Register an account</h2>
        <div class="row d-flex justify-content-center align-items-center">
            <div class="col-lg-9 col-12">
                <form class="custom-form contact-form mb-4 align-items-center needs-validation" id="register" action="" method="post" enctype="multipart/form-data" role="form" novalidate>
                    <h3 class="mb-4">Become a member today</h3>
                    <div class="row g-2">

                        <div class="col-lg-4 col-12">
                            <label class="labels">First Name</label>
                            <input type="text" name="firstname" class="form-control
                            <?php echo isset($errors["firstname"]) ? 'is-invalid' : ''; ?>" 
                            id="firstname" value="<?php if (!empty($_POST["firstname"])) { echo $_POST["firstname"]; } else { echo ''; };?>">
                            <?php if (isset($errors["firstname"])) : ?>
                                <div class="text-danger" id="error_first"><?= $errors["firstname"] ?></div>
                            <?php endif; ?>
                        </div>

                        <div class="col-lg-4 col-12">
                            <label class="labels">Middle Name (Optional)</label>
                            <input type="text" name="middlename" class="form-control" id="middlename" value="<?php if (!empty($_POST["middlename"])) { echo $_POST["middlename"]; } else { echo ''; };?>">
                        </div>

                        <div class="col-lg-4 col-12">
                            <label class="labels">Last Name</label>
                            <input type="text" name="lastname" class="form-control 
                            <?php echo isset($errors["lastname"]) ? 'is-invalid' : ''; ?>" id="lastname" value="<?php if (!empty($_POST["lastname"])) { echo $_POST["lastname"]; } else { echo ''; };?>">
                            <?php if (isset($errors["lastname"])) : ?>
                                <div class="text-danger" id="error_last"><?= $errors["lastname"] ?></div>
                            <?php endif; ?>
                        </div>

                        <div class="col-lg-6 col-12">
                        <label class="labels">Birthdate</label>
                            <input type="text" name="birthdate" class="form-control 
                            <?php echo isset($errors["birthdate"]) ? 'is-invalid' : ''; ?>" id="birthdate" placeholder="MM/DD/YYYY" value="<?php if (!empty($_POST["birthdate"])) { echo $_POST["birthdate"]; } else { echo ''; };?>">
                            <div class="invalid-feedback" id="error_birth2" <?php echo isset($errors["firstname"]) ? 'style="display: none; margin-top: -6px;"' : ''; ?>>Invalid date format. Please use mm/dd/yyyy.</div>
                            <?php if (isset($errors["birthdate"])) : ?>
                                <div class="text-danger" id="error_birth"><?= $errors["birthdate"] ?></div>
                            <?php endif; ?>
                        </div>

                        <div class="col-lg-6 col-12">
                            <label class="labels">Gender</label>
                            <select class="form-select <?php echo isset($errors["sex"]) ? 'is-invalid' : ''; ?>" name="sex" id="sex" placeholder="Gender">
                                <option value="" disabled selected>Select gender</option>
                                <option value="Male" <?php if(isset($_POST["sex"]) && $_POST["sex"]=="Male"){ echo 'selected';} ?>>Male</option>
                                <option value="Female" <?php if(isset($_POST["sex"]) && $_POST["sex"]=="Female"){ echo 'selected';} ?>>Female</option>
                                <option value="Others" <?php if(isset($_POST["sex"]) && $_POST["sex"]=="Others"){ echo 'selected';} ?>>Others</option>
                            </select>
                            <?php if (isset($errors["sex"])) : ?>
                                <div class="text-danger" id="error_sex"><?= $errors["sex"] ?></div>
                            <?php endif; ?>
                        </div> 

                        <div class="col-lg-6 col-12">
                            <label class="labels">Mobile Number</label>
                            <div class="input-group">
                                <span class="input-group-text">+63</span>
                                <input type="text" class="form-control 
                                <?php echo isset($errors["mobile"]) ? 'is-invalid' : ''; ?>" name="mobile" id="mobile" oninput="validateNumericInput(this)" maxlength="10" value="<?php if (!empty($_POST["mobile"])) { echo $_POST["mobile"]; } else { echo ''; };?>">
                                <div class="invalid-feedback" id="error_mobile2" <?php echo isset($errors["mobile"]) ? 'style="display: none; margin-top: -6px;"' : ''; ?>>Invalid mobile number format</div>
                            </div>
                            <?php if (isset($errors["mobile"])) : ?>
                                <div class="text-danger" id="error_mobile"><?= $errors["mobile"] ?></div>
                            <?php endif; ?>
                        </div>

                        <div class="col-lg-6 col-12">
                            <label class="labels">Email Address</label>
                            <input type="email" name="email" pattern="[^ @]*@[^ @]*" class="form-control 
                            <?php echo isset($errors["email"]) ? 'is-invalid' : ''; ?>" id="email" value="<?php if (!empty($_POST["email"])) { echo $_POST["email"]; } else { echo ''; };?>">
                            <div class="invalid-feedback" id="error_email2" <?php echo isset($errors["email"]) ? 'style="display: none; margin-top: -6px;"' : ''; ?>>Invalid email format</div>
                            <?php if (isset($errors["email"])) : ?>
                                <div class="text-danger" id="error_email"><?= $errors["email"] ?></div>
                            <?php endif; ?>
                        </div>

                        <div class="col-lg-4 col-12">
                            <label class="long-label">House No./Bldg./Street Name</label>
                            <input type="text" name="address" class="form-control 
                            <?php echo isset($errors["address"]) ? 'is-invalid' : ''; ?>" id="address" value="<?php if (!empty($_POST["address"])) { echo $_POST["address"]; } else { echo ''; };?>">
                            <?php if (isset($errors["address"])) : ?>
                                <div class="text-danger" id="error_address"><?= $errors["address"] ?></div>
                            <?php endif; ?>
                        </div>

                        <div class="col-lg-4 col-12">
                            <label class="labels">City</label>
                            <input type="text" name="city" class="form-control" value="City of Manila" disabled>
                        </div>

                        <div class="col-lg-4 col-12">
                            <label class="labels">Barangay</label>
                            <input type="text" name="barangay" class="form-control" value="Barangay 95" disabled>
                        </div>

                        <!-- Add file upload fields -->
                        <div class="col-lg-6 col-12">
                            <label for="id_selfie">Upload Selfie w/ ID</label>
                            <input type="file" name="id_selfie" id="id_selfie" class="form-control
                            <?php echo isset($errors["id_selfie"]) ? 'is-invalid' : ''; ?>" accept="image/*">
                            <?php if (isset($errors["id_selfie"])) : ?>
                                <div class="text-danger" id="error_id_selfie"><?= $errors["id_selfie"] ?></div>
                            <?php endif; ?>
                        </div>

                        <div class="col-lg-6 col-12">
                            <label for="valid_id">Upload Valid ID</label>
                            <input type="file" name="valid_id" id="valid_id" class="form-control
                            <?php echo isset($errors["valid_id"]) ? 'is-invalid' : ''; ?>" accept="image/*">
                            <?php if (isset($errors["valid_id"])) : ?>
                                <div class="text-danger" id="error_id"><?= $errors["valid_id"] ?></div>
                            <?php endif; ?>
                        </div>

                        <div class="col-lg-6 col-12">
                            <label class="labels">Create Username (Must be 6 characters long)</label>
                            <input type="text" name="username" class="form-control
                            <?php echo isset($errors["username"]) ? 'is-invalid' : ''; ?>" id="username" placeholder="" value="<?php if (!empty($_POST["username"])) { echo $_POST["username"]; } else { echo ''; };?>">
                            <?php if (isset($errors["username"])) : ?>
                                <div class="text-danger mb-2" id="error_username"><?= $errors["username"] ?></div>
                            <?php endif; ?>
                            <div class="invalid-feedback mb-2"></div>
                        </div>

                        <div class="col-lg-6 col-12">
                            <label class="labels">Nominate Password (Minimum of 8 characters)</label>
                            <input type="password" name="password" class="form-control 
                            <?php echo isset($errors["password"]) ? 'is-invalid' : ''; ?>" id="password" placeholder="" required>
                            <?php if (isset($errors["password"])) : ?>
                                <div class="text-danger mb-2" id="error_password"><?= $errors["password"] ?></div>
                            <?php endif; ?>
                            <div class="invalid-feedback mb-2"></div>
                        </div>
                    </div>
                     <!-- Display error message -->
                     <?php if (isset($error)) : ?>
                        <div class="text-danger mt-2 mb-4">Error: <?= $error ?></div>
                     <?php endif; ?>

                    <div class="form-group mt-2">
                        <label for="data_privacy_agreement" id="dpa" class="text-justify" style="<?php echo isset($errors["terms"]) ? 'color: #dc3545' : ''; ?>">
                            <input type="checkbox" id="data_privacy_agreement" name="data_privacy_agreement">
                            <strong>I have read and agree to the terms of the Republic Act No. 10173, also known as the Data Privacy Act of 2012 (DPA), and consent to the collection, processing, and storage of my personal data in accordance with its provisions.</strong>
                        </label>
                        <?php if (isset($errors["terms"])) : ?>
                            <div class="text-danger mb-2" id="error_terms"><?= $errors["terms"] ?></div>
                        <?php endif; ?>
                    </div>

                    <p class="form-group text-justify">
                        <i class="bi bi-exclamation-circle"></i>
                        Please keep in mind that after a successful registration, the submitted information will be validated by the administrator within 24 hours before the user can login.
                    </p>
                  
                    
                    <button type="submit" name="register" class="form-control mt-2">Register</button>
                    
                    <p class="text-center" style="margin-bottom: -8px"><a href="login">I am already a member</a></p>
                </form>
            </div>
        </div>
    </div>
</section>