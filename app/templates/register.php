<?php if (!empty($errorMessages)) { ?>
    <div id="alert-error" class="alert alert-danger mb-0" role="alert">
        <div class="row justify-content-center">
            <h6 class="alert-heading text-center">Error!</h6>
                <?php foreach ($errorMessages as $errorMessage) { ?>
                    <p class="text-center mb-0"><?php echo $errorMessage; ?></p>
                <?php } ?>  
        </div>
    </div>
<?php } ?>
<section class="contact-section section-padding" id="section_6">
    <div class="container-fluid">
        <div class="row d-flex justify-content-center align-items-center">
            <div class="col-lg-9 col-12">
                <form class="custom-form contact-form mb-4 align-items-center needs-validation" id="register" action="" method="post" enctype="multipart/form-data" role="form" novalidate>
                    <h3 class="mb-4">Become a member today</h3>
                    <div class="row g-2">
                    <h6>Personal Information</h6>
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
                            <label class="labels">Mobile Number</label>
                            <div class="input-group">
                                <span class="input-group-text">+63</span>
                                <input type="text" class="form-control 
                                <?php echo isset($errors["mobile"]) ? 'is-invalid' : ''; ?>" name="mobile" id="mobile" oninput="validateNumericInput(this)" maxlength="10" value="<?php if (!empty($_POST["mobile"])) { echo $_POST["mobile"]; } else { echo ''; };?>">
                            </div>
                            <div class="invalid-feedback" id="error_mobile2" <?php echo isset($errors["mobile"]) ? 'style="display: none; margin-top: -6px;"' : ''; ?>>Invalid mobile number format</div>
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
                        
                        <div class="col-lg-6 col-12">
                            <h6>Membership Information</h6>
                        </div>

                        <div class="col-lg-6 col-12">
                            <h6>Document Upload</h6>
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

                    <div class="form-check mt-2">
                    <input type="checkbox" class="form-check-input" id="data_privacy_agreement" name="data_privacy_agreement">
                    <label for="data_privacy_agreement" id="dpa" class="text-justify form-check-label" style="<?php echo isset($errors["terms"]) ? 'color: #dc3545' : ''; ?>">
                        <strong>I have read and agree to the <a href="#" id="openDpnModal" class="blue-link">Data Privacy Act (Republic Act No. 10173 of 2012)</a> and consent to the collection, processing, and storage of my personal data in accordance with its provisions.</strong>
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
                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                                    <h5 class="modal-title">Data Privacy Notice</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p><strong>Data Privacy Notice</strong></p>

                                    <p>We respect your privacy and are committed to protecting your personal information. This Data Privacy Notice explains how we collect, use, and protect your data when you use our Barangay Registration Account website. By using our services, you consent to the practices described in this notice.</p>

                                    <p><strong>Information We Collect</strong></p>

                                    <p>We may collect the following types of personal data:</p>

                                    <ul>
                                        <li>Name</li>
                                        <li>Address</li>
                                        <li>Contact information (e.g., email address, phone number)</li>
                                        <li>Date of birth</li>
                                        <li>Barangay registration details</li>
                                        <li>Other information relevant to the registration process</li>
                                    </ul>

                                    <p><strong>How We Use Your Information</strong></p>

                                    <p>We use the information we collect for the following purposes:</p>

                                    <ul>
                                        <li>To process and manage Barangay registration applications</li>
                                        <li>To verify your identity</li>
                                        <li>To communicate with you regarding your registration</li>
                                        <li>To improve our services</li>
                                        <li>To comply with legal and regulatory requirements</li>
                                    </ul>

                                    <p><strong>Data Security</strong></p>

                                    <p>We are committed to ensuring the security of your personal data. We implement appropriate technical and organizational measures to protect your data from unauthorized access, disclosure, alteration, and destruction.</p>

                                    <p><strong>Sharing of Information</strong></p>

                                    <p>We do not sell, trade, or otherwise transfer your personal data to third parties without your consent, except as required by law or for the purposes mentioned in this notice.</p>

                                    <p><strong>Your Rights</strong></p>

                                    <p>You have the right to:</p>

                                    <ul>
                                        <li>Access the personal data we hold about you</li>
                                        <li>Correct any inaccuracies in your personal data</li>
                                        <li>Delete your personal data, subject to legal and regulatory requirements</li>
                                        <li>Object to the processing of your data</li>
                                        <li>Withdraw your consent for data processing</li>
                                    </ul>

                                    <p><strong>Contact Us</strong></p>

                                    <p>If you have any questions or concerns regarding your personal data and our data processing practices, please contact us at 8-294-47-66.</p>

                                    <p><strong>Changes to this Notice</strong></p>

                                    <p>We may update this Data Privacy Notice from time to time to reflect changes in our practices or for legal reasons. Please review this notice periodically for any updates.</p>

                                    <p>By using our website and services, you acknowledge that you have read and understood this Data Privacy Notice. If you do not agree with our data processing practices, please do not use our website.</p>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<!-- Add this JavaScript code at the bottom of your HTML page -->
<script>
    $(document).ready(function() {
        // Open the DPN modal when the link is clicked
        $('#openDpnModal').click(function() {
            $('#dpnModal').modal('show');
        });
    });
</script>
