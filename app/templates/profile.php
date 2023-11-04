<section class="volunteer-section section-padding" id="section_4">
    <div class="container">
        <div class="row d-flex justify-content-center align-items-center">
            <div class="custom-form volunteer-form mb-4 needs-validation" style="margin-bottom: -20px;">
                <h2 class="text-center">Barangay Profile</h2>
                <form method="post" action=""> 
                    <div class="row">
                        <div class="col-md-3 border-right">
                            <div class="d-flex flex-column align-items-center text-center my-5">
                                <?php
                                    $idSelfiePath = 'uploads/id_selfie/' . $user_data['id_selfie'];
                                    if (!empty($user_data['id_selfie']) && file_exists($idSelfiePath)):
                                ?>
                                <img class="about-image ms-md-auto bg-light shadow-lg img-fluid mb-4" width="150px" src="<?php echo $idSelfiePath; ?>" alt="profilepic">
                                <?php else: ?>
                                    <p>Profile picture is not available</p>
                                <?php endif; ?>
                                <?php if ($user_data && isset($user_data['username'])) { ?>
                                    <h5><?php echo $user_data['username']; ?></h5>
                                <?php } else { ?>
                                    <h3>User Data Not Available</h3>
                                <?php } ?>
                                <p>Resident</p>
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
                                            <input type="text" class="form-control" id="firstname" value="<?php echo $user_data['firstname']; ?>" disabled>
                                        </div>
                                        <div class="col-lg-4 col-12">
                                            <label class="labels">Middle Name</label>
                                            <input type="text" class="form-control" id="middlename" value="<?php echo $user_data['middlename']; ?>" disabled>
                                        </div>
                                        <div class="col-lg-4 col-12">
                                            <label class="labels">Last Name</label>
                                            <input type="text" class="form-control" id="lastname" value="<?php echo $user_data['lastname']; ?>" disabled>
                                        </div>
                                        <div class="col-lg-4 col-12">
                                            <label class="labels">Gender</label>
                                            <input type="text" class="form-control" id="sex" value="<?php echo $user_data['sex']; ?>" disabled>
                                        </div>
                                        <div class="col-lg-4 col-12">
                                            <label class="labels">Birthdate</label>
                                            <?php $formattedBirthdate = date("m/d/Y", strtotime($user_data['birthdate']));?>
                                            <input type="text" class="form-control" id="birthdate" value="<?php echo $formattedBirthdate ?>" disabled>
                                        </div>
                                        <div class="col-lg-4 col-12">
                                            <label class="labels">Age</label>
                                            <input type="text" class="form-control" id="age" value="<?php echo $user_data['age']; ?>" disabled>
                                        </div>
                                        <p class="form-group text-justify">
                                            <i class="bi bi-exclamation-circle"></i>
                                            Please contact the administrator in case of a personal information discrepancy.
                                        </p>
                                        <div class="col-lg-12 col-12 mt-2">
                                            <h5 class="mb-3">Contact Details</h5>
                                        </div>
                                        <div class="col-lg-6 col-12">
                                            <label class="labels">Mobile Number</label>
                                            <input type="text" class="form-control" id="mobile" name="mobile" value="<?php echo $user_data['mobile']; ?>" disabled>
                                        </div>
                                        <div class="col-lg-6 col-12">
                                            <label class="labels">Email</label>
                                            <input type="text" class="form-control" id="email" name="email" value="<?php echo $user_data['email']; ?>" disabled>
                                        </div>
                                        <input type="hidden" name="user_id" value="<?php echo $user_data['user_id']; ?>">
                                        <div class="col-lg-12 col-12 mt-2">
                                            <h5 class="mb-3">Address Details</h5>
                                        </div>
                                        <div class="col-lg-4 col-12">
                                            <label class="labels">House No./Bldg./Street Name</label>
                                            <input type="text" class="form-control" id="address" name="address" value="<?php echo $user_data['address']; ?>" disabled>
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
                                    <div class="text-center mt-2">
                                    <!-- Button to edit the profile -->
                                    <button type="button" name="edit_profile" id="edit_profile" class="form-control">Edit Profile</button>
                                    <!-- Button to save changes (initially hidden) -->
                                    <button type="submit" name="save_changes" id="save_changes" class="form-control" style="display: none;">Save Changes</button>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form> <!-- Close the form element -->
            </div>
        </div>
    </div>
</section>
<script>
// Get references to the input fields and buttons
const mobileInput = document.getElementById('mobile');
const emailInput = document.getElementById('email');
const addressInput = document.getElementById('address');

const editProfileButton = document.getElementById('edit_profile');
const saveChangesButton = document.getElementById('save_changes');

// Function to toggle between edit and save buttons
function toggleButtons() {
    addressInput.disabled = !mobileInput.disabled;
    mobileInput.disabled = !mobileInput.disabled;
    emailInput.disabled = !emailInput.disabled;
    editProfileButton.style.display = editProfileButton.style.display === 'none' ? 'block' : 'none';
    saveChangesButton.style.display = saveChangesButton.style.display === 'none' ? 'block' : 'none';
}

// Add a click event listener to the edit profile button
editProfileButton.addEventListener('click', toggleButtons);
</script>