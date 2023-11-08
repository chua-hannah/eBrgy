<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="user-management">User Management</a></li>
        <li class="breadcrumb-item active" aria-current="page">Add User</li>
    </ol>
</nav>

<div class="container-fluid">
    <form class="custom-form contact-form mb-4 align-items-center needs-validation" id="register" action="" method="post" enctype="multipart/form-data" role="form" novalidate>
    <h3 class="mb-4">Add Barangay Official</h3>

    <div class="row g-2">
        <div class="col-lg-12 col-12">
        <h6>Personal Information</h6>
        </div>
        <div class="col-lg-6 col-12 mb-2">
            <label class="labels">System Role</label>
            <select class="form-select <?php echo isset($errors["role"]) ? 'is-invalid' : ''; ?>" name="role" id="role" placeholder="Barangay Position">
                <option value="" disabled selected>Select System Role</option>
                <option value="captain" <?= isset($_POST["role"]) && $_POST["role"] == "captain" ? 'selected' : ''; ?>>Super Admin</option>
                <option value="kagawad" <?= isset($_POST["role"]) && $_POST["role"] == "kagawad" ? 'selected' : ''; ?>>Admin</option>
            </select>
            <?php if (isset($errors["role"])) : ?>
                <div class="text-danger" id="error_role"><?= $errors["role"] ?></div>
            <?php endif; ?>
        </div>
        <div class="col-lg-6 col-12 mb-2">
            <label class="labels">Barangay Position</label>
            <select class="form-select <?php echo isset($errors["position"]) ? 'is-invalid' : ''; ?>" name="position" id="position" placeholder="Barangay Position">
                <option value="" disabled selected>Select Barangay Position</option>
                <option value="captain" <?= isset($_POST["position"]) && $_POST["position"] == "captain" ? 'selected' : ''; ?>>Barangay Chairman</option>
                <option value="councilor" <?= isset($_POST["position"]) && $_POST["position"] == "councilor" ? 'selected' : ''; ?>>Councilor</option>
                <option value="secretary" <?= isset($_POST["position"]) && $_POST["position"] == "secretary" ? 'selected' : ''; ?>>Secretary</option>
                <option value="treasurer" <?= isset($_POST["position"]) && $_POST["position"] == "treasurer" ? 'selected' : ''; ?>>Treasurer</option>
                <option value="exo1" <?= isset($_POST["position"]) && $_POST["position"] == "exo1" ? 'selected' : ''; ?>>Ex-O (Dayshift)</option>
                <option value="exo2" <?= isset($_POST["position"]) && $_POST["position"] == "exo2" ? 'selected' : ''; ?>>Ex-O (Nightshift)</option>
                <option value="skchairman" <?= isset($_POST["position"]) && $_POST["position"] == "skchairman" ? 'selected' : ''; ?>>SK-Chairman</option>
                <option value="skcouncilor" <?= isset($_POST["position"]) && $_POST["position"] == "skcouncilor" ? 'selected' : ''; ?>>SK-Councilor</option>
                <option value="sksecretary" <?= isset($_POST["position"]) && $_POST["position"] == "sksecretary" ? 'selected' : ''; ?>>SK-Secretary</option>
                <option value="sktreasurer" <?= isset($_POST["position"]) && $_POST["position"] == "skcouncilor" ? 'selected' : ''; ?>>SK-Treasurer</option>
            </select>
            <?php if (isset($errors["position"])) : ?>
                <div class="text-danger" id="position"><?= $errors["position"] ?></div>
            <?php endif; ?>
        </div>
        <div class="col-lg-4 col-12">
            <label class="labels">First Name</label>
            <input type="text" name="firstname" class="form-control <?= isset($errors["firstname"]) ? 'is-invalid' : ''; ?>" id="firstname" value="<?= !empty($_POST["firstname"]) ? $_POST["firstname"] : ''; ?>" required>
            <?php if (isset($errors["firstname"])) : ?>
            <div class="text-danger" id="error_first"><?= $errors["firstname"] ?></div>
            <?php endif; ?>
        </div>

            <div class="col-lg-4 col-12">
                <label class="labels">Middle Name (Optional)</label>
                <input type="text" name="middlename" class="form-control <?= isset($errors["middlename"]) ? 'is-invalid' : ''; ?>" id="middlename" value="<?= !empty($_POST["middlename"]) ? $_POST["middlename"] : ''; ?>" required>
            <?php if (isset($errors["middlename"])) : ?>
            <div class="text-danger" id="error_middle"><?= $errors["middlename"] ?></div>
            <?php endif; ?>
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
                <div class="input-group">
                    <span class="input-group-text">
                        <i class="bi bi-calendar"></i> <!-- Bootstrap Icons calendar icon -->
                    </span>
                    <input type="text" name="birthdate" id="datepicker" class="form-control <?php echo isset($errors["birthdate"]) ? 'is-invalid' : ''; ?>" placeholder="MM/DD/YYYY" value="<?php if (!empty($_POST["birthdate"])) { echo $_POST["birthdate"]; } else { echo ''; }; ?>">
                </div>
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
                            <h6>Membership Information</h6>
                        </div>

                        <div class="col-lg-6 col-12">
                            <h6>Document Uploads</h6>
                        </div>

                        <div class="col-lg-6 col-12">
                        <div class="membership-info">
                        <p>Check any applicable status (optional):</p>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="checkbox_4ps" name="membership_4ps" value="1" <?php if (!empty($_POST["membership_4ps"])) echo 'checked'; ?>>
                            <label class="form-check-label" for="checkbox_4ps">Pantawid Pamilyang Pilipino Program (4Ps)</label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="checkbox_pwd" name="membership_pwd" value="1" <?php if (!empty($_POST["membership_pwd"])) echo 'checked'; ?>>
                            <label class="form-check-label" for="checkbox_pwd">Person with Disabilities (PWD)</label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="checkbox_solo_parent" name="membership_solo_parent" value="1" <?php if (!empty($_POST["membership_solo_parent"])) echo 'checked'; ?>>
                            <label class="form-check-label" for="checkbox_solo_parent">Solo Parent</label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="checkbox_scholar" name="membership_scholar" value="1" <?php if (!empty($_POST["membership_scholar"])) echo 'checked'; ?>>
                            <label class="form-check-label" for="checkbox_scholar">Government Scholar</label>
                        </div>
                    </div>
                    </div>

                        <!-- Add file upload fields -->
                        <div class="col-lg-6 col-12">
                            <div>
                                <label for="valid_id">Upload Valid ID / Proof of Membership (if any)</label>
                                <input type="file" name="valid_id" id="valid_id" class="form-control
                                <?php echo isset($errors["valid_id"]) ? 'is-invalid' : ''; ?>" accept="image/*" onchange="removeIdErrorMsg(event)">
                                <?php if (isset($errors["valid_id"])) : ?>
                                    <div class="text-danger" id="error_id"><?= $errors["valid_id"] ?></div>
                                <?php endif; ?>
                            </div>
                            <div>
                                <label for="id_selfie">Upload Selfie w/ ID</label>
                                <input type="file" name="id_selfie" id="id_selfie" class="form-control
                                <?php echo isset($errors["id_selfie"]) ? 'is-invalid' : ''; ?>" accept="image/*" onchange="removeIdSelfieErrorMsg(event)">
                                <?php if (isset($errors["id_selfie"])) : ?>
                                    <div class="text-danger" id="error_id_selfie"><?= $errors["id_selfie"] ?></div>
                                <?php endif; ?>
                            </div>
                        </div>
            <div class="col-lg-12 col-12">
                <h6 class="mb-3">Contact Details</h6>
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

        <div class="col-lg-12 col-12">
            <h6 class="mb-3">Access Credentials</h6>
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

        <!-- Display error message -->
        <?php if (isset($error)) : ?>
        <div class="text-danger mt-2 mb-4">Error: <?= $error ?></div>
        <?php endif; ?>

        <div class="form-check mt-2">
        <input type="checkbox" class="form-check-input" id="data_privacy_agreement" name="data_privacy_agreement">
        <label for="data_privacy_agreement" id="dpa" class="text-justify form-check-label" style="<?php echo isset($errors["terms"]) ? 'color: #dc3545' : ''; ?>">
            <strong>I have read and agree to the Data Privacy Act (Republic Act No. 10173 of 2012) and consent to the collection, processing, and storage of my personal data in accordance with its provisions.</strong>
        </label>
        <?php if (isset($errors["terms"])) : ?>
            <div class="text-danger mb-2" id="error_terms"><?= $errors["terms"] ?></div>
        <?php endif; ?>
        </div>

        <button type="submit" name="add-officials" class="form-control mt-2">Register Official</button>
    </form>
</div>

<!-- Additional div for sidebar -->
</div>
</div>
</div>
