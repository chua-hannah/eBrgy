<div class="container-fluid">
    <div class="custom-form needs-validation" action="" id="login" method="post" role="form">
        <h2 class="text-center">Barangay Profile</h2>
        <div class="row">
            <div class="col-lg-2">
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
            <div class="col-md-10">
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
                            <div class="col-lg-12 col-12 mt-2">
                                <h5 class="mb-3">Contact Details</h5>
                            </div>
                            <div class="col-lg-6 col-12">
                                <label class="labels">Mobile Number</label>
                                <input type="text" class="form-control" id="mobile" value="<?php echo $user_data['mobile']; ?>" disabled>
                            </div>
                            <div class="col-lg-6 col-12">
                                <label class="labels">Email</label>
                                <input type="text" class="form-control" id="email" value="<?php echo $user_data['email']; ?>" disabled>
                            </div>
                            <div class="col-lg-12 col-12 mt-2">
                                <h5 class="mb-3">Address Details</h5>
                            </div>
                            <div class="col-lg-4 col-12">
                                <label class="labels">House No./Bldg./Street Name</label>
                                <input type="text" class="form-control" id="address" value="<?php echo $user_data['address']; ?>" disabled>
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
                                <button type="submit" name="edit" id="edit" class="form-control">Edit Profile</button>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
// Get references to the input fields and the edit button
const firstnameInput = document.getElementById('firstname');
const middlenameInput = document.getElementById('middlename');
const lastnameInput = document.getElementById('lastname');
const sexInput = document.getElementById('sex');
const birthdateInput = document.getElementById('birthdate');
const mobileInput = document.getElementById('mobile');
const emailInput = document.getElementById('email');
const addressInput = document.getElementById('address');
const editButton = document.getElementById('edit');

// Function to enable/disable input fields
function toggleInputs() {
    firstnameInput.disabled = !firstnameInput.disabled;
    middlenameInput.disabled = !middlenameInput.disabled;
    lastnameInput.disabled = !lastnameInput.disabled;
    sexInput.disabled = !sexInput.disabled;
    birthdateInput.disabled = !birthdateInput.disabled;
    mobileInput.disabled = !mobileInput.disabled;
    emailInput.disabled = !emailInput.disabled;
    addressInput.disabled = !addressInput.disabled;
  
    // Change the text of the edit button based on the input field state
    if (mobileInput.disabled && emailInput.disabled && addressInput.disabled 
    && firstnameInput.disabled && middlenameInput.disabled && lastnameInput.disabled 
    && sexInput.disabled && birthdateInput.disabled ) {
        editButton.textContent = 'Edit Profile';
    } else {
        editButton.textContent = 'Save Changes';
    }
}

// Add a click event listener to the edit button
editButton.addEventListener('click', toggleInputs);

</script>
    