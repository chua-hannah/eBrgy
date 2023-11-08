<div class="container-fluid">
    <div class="row d-flex justify-content-center align-items-center">
        <div class="custom-form volunteer-form mb-4 needs-validation" style="margin-bottom: -20px;">
            <h2 class="text-center">Barangay Profile</h2>
            <form method="post" action="" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-3 border-right">
                        <div class="d-flex flex-column align-items-center text-center my-5">
                            <?php
                            $idSelfiePath = 'uploads/id_selfie/' . $user_data['id_selfie'];
                            if (!empty($user_data['id_selfie']) && file_exists($idSelfiePath)):
                            ?>
                            <div class="image-container">
                                <img class="about-image ms-md-auto bg-light shadow-lg img-fluid mb-4" width="150px"
                                    src="<?php echo $idSelfiePath; ?>" alt="profilepic">
                                <?php if ($user_data && isset($user_data['username'])) { ?>
                                <h5><?php echo $user_data['username']; ?></h5>
                                <?php } else { ?>
                                <h3>User Data Not Available</h3>
                                <?php } ?>
                                <p class="text-bottom">Resident</p>
                            </div>
                            <?php else: ?>
                            <p>Profile picture is not available</p>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col-md-9 border-right">
                        <div class="p-3">
                            <div class="col-lg-12 col-12">
                                <h5 class="mb-3">Personal Information</h5>
                            </div>
                            <div class="row mt-3">
                                <?php if ($user_data) { ?>
                                <div class="col-lg-4 col-12">
                                    <label class="labels">First Name</label>
                                    <input type="text" class="form-control" id="firstname" name="firstname"
                                        value="<?php echo $user_data['firstname']; ?>" required disabled>
                                </div>
                                <div class="col-lg-4 col-12">
                                    <label class="labels">Middle Name</label>
                                    <input type="text" class="form-control" id="middlename" name="middlename"
                                        value="<?php echo $user_data['middlename']; ?>" required disabled>
                                </div>
                                <div class="col-lg-4 col-12">
                                    <label class="labels">Last Name</label>
                                    <input type="text" class="form-control" id="lastname" name="lastname"
                                        value="<?php echo $user_data['lastname']; ?>" required disabled>
                                </div>
                                <div class="col-lg-4 col-12">
                                    <label class="labels">Gender</label>
                                    <select class="form-control" id="sex" name="sex" required disabled>
                                        <option value="male" <?php if ($user_data['sex'] === 'male') echo 'selected'; ?>>Male
                                        </option>
                                        <option value="female" <?php if ($user_data['sex'] === 'female') echo 'selected'; ?>>
                                            Female</option>
                                        <option value="other" <?php if ($user_data['sex'] === 'other') echo 'selected'; ?>>
                                            Other</option>
                                    </select>
                                </div>

                                <div class="col-lg-4 col-12">
                                    <label class="labels">Birthdate</label>
                                    <input type="date" class="form-control" id="birthdate" name="birthdate"
                                        value="<?php echo $user_data['birthdate']; ?>" required disabled>
                                </div>
                                <div class="col-lg-4 col-12">
                                    <label class="labels">Age</label>
                                    <input type="text" class="form-control" id="age" value="<?php echo $user_data['age']; ?>"
                                        disabled>
                                </div>

                                <div class="col-lg-12 col-12 mt-2">
                                    <h5 class="mb-3">Contact Details</h5>
                                </div>
                                <div class="col-lg-6 col-12">
                                    <label class="labels">Mobile Number</label>
                                    <div class="input-group">
                                        <span class="input-group-text">+63</span>
                                        <input type="text" class="form-control" id="mobile" name="mobile" oninput="validateNumericInput(this)" maxlength="10"
                                            value="<?php echo substr($user_data['mobile'], 3); ?>" required disabled>
                                    </div>
                                        <div class="invalid-feedback" id="error_mobile2" <?php echo isset($errors["mobile"]) ? 'style="display: none; margin-top: -6px;"' : ''; ?>>Invalid mobile number format</div>
                                </div>
                                <div class="col-lg-6 col-12">
                                    <label class="labels">Email</label>
                                    <input type="text" class="form-control" id="email" name="email"
                                        value="<?php echo $user_data['email']; ?>" required disabled>
                                        <div class="invalid-feedback" id="error_email2" <?php echo isset($errors["email"]) ? 'style="display: none; margin-top: -6px;"' : ''; ?>>Invalid email format</div>
                                </div>
                                <input type="hidden" name="user_id" value="<?php echo $user_data['user_id']; ?>">
                                <div class="col-lg-12 col-12 mt-2">
                                    <h5 class="mb-3">Address Details</h5>
                                </div>
                                <div class="col-lg-4 col-12">
                                    <label class="labels">House No./Bldg./Street Name</label>
                                    <input type="text" class="form-control" id="address" name="address"
                                        value="<?php echo $user_data['address']; ?>" required disabled>
                                </div>
                                <div class="col-lg-4 col-12">
                                    <label class="labels">City</label>
                                    <input type="text" name="city" class="form-control" value="City of Manila" disabled>
                                </div>
                                <div class="col-lg-4 col-12">
                                    <label class="labels">Barangay</label>
                                    <input type="text" name="barangay" class="form-control" value="Barangay 95" disabled>
                                </div>
                                <?php } else { ?>
                                <div class="col-md-12">
                                    <p>User data not available.</p>
                                </div>
                                <?php } ?>
                                <div class="col-lg-12 col-12">
                                    <label class="labels">Profile Picture</label>
                                    <input type="file" class="form-control" id="profile_picture" name="profile_picture"
                                        accept="image/*" disabled>
                                </div>
                                <div class="col-lg-12 col-12 mt-2">
                                    <label for="image_upload" id="image_label" style="display: none;"><strong>Image Preview</strong></label>
                                    <img id="image_preview" class="img-fluid mb-4" style="width: 250px; height: 280px; display: none;">
                                </div>
                            </div>
                            <div class="text-center mt-2">
                                <!-- Button to edit the profile -->
                                <button type="button" name="edit_profile" id="edit_profile" class="form-control">Edit Profile</button>
                                <!-- Button to save changes (initially hidden) -->
                                <button type="submit" name="save_changes" id="save_changes" class="form-control"
                                    style="display: none;">Save Changes</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form> <!-- Close the form element -->
        </div>
    </div>
</div>

<script>
    const firstnameInput = document.getElementById('firstname');
    const middlenameInput = document.getElementById('middlename');
    const lastnameInput = document.getElementById('lastname');
    const sexInput = document.getElementById('sex');
    const birthdateInput = document.getElementById('birthdate');
    const mobileInput = document.getElementById('mobile');
    const emailInput = document.getElementById('email');
    const addressInput = document.getElementById('address');
    const profilePictureInput = document.getElementById('profile_picture');
    const imagePreview = document.getElementById('image_preview');
    const imageLabel = document.getElementById('image_label');
    const editProfileButton = document.getElementById('edit_profile');
    const saveChangesButton = document.getElementById('save_changes');

    function toggleButtons() {
        firstnameInput.disabled = !firstnameInput.disabled;
        middlenameInput.disabled = !middlenameInput.disabled;
        lastnameInput.disabled = !lastnameInput.disabled;
        sexInput.disabled = !sexInput.disabled;
        birthdateInput.disabled = !birthdateInput.disabled;
        mobileInput.disabled = !mobileInput.disabled;
        emailInput.disabled = !emailInput.disabled;
        addressInput.disabled = !addressInput.disabled;
        profilePictureInput.disabled = !profilePictureInput.disabled;

        editProfileButton.style.display = editProfileButton.style.display === 'none' ? 'block' : 'none';
        saveChangesButton.style.display = saveChangesButton.style.display === 'none' ? 'block' : 'none';
    }

profilePictureInput.addEventListener('change', function () {
    const selectedImage = profilePictureInput.files[0];
    if (selectedImage) {
        const reader = new FileReader();

        reader.onload = function (e) {
            imagePreview.src = e.target.result;
            imagePreview.style.display = 'block';
            imageLabel.style.display = 'block'; // Show the label
        };

        reader.readAsDataURL(selectedImage);
    }
});

    // Add a click event listener to the edit button
    editProfileButton.addEventListener('click', toggleButtons);

</script>
