<div class="container rounded bg-white mt-5 mb-5">
    <div class="row">
        <div class="col-md-3 border-right">
            <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                <img class="rounded-circle mt-5" width="150px" src="assets/images/dummy-avatar.png" alt="profilepic">
               
                <?php if ($user_data && isset($user_data['username'])) { ?>
                    <h3><?php echo $user_data['username']; ?></h3>
                <?php } else { ?>
                    <h3>User Data Not Available</h3>
                <?php } ?>
                <h6 style="color: grey;">Brgy Official<h6>
            </div>
        </div>
        <div class="col-md-8 border-right">
            <div class="p-3 py-5">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="text-right">Barangay Profile</h4>
                </div>
                <div class="row mt-3">
                    <?php if ($user_data) { ?>
                        <div class="col-md-4">
                            <label class="labels">First Name</label>
                            <input type="text" class="form-control" value="<?php echo $user_data['firstname']; ?>">
                        </div>
                        <div class="col-md-4">
                            <label class="labels">Middle Name</label>
                            <input type="text" class="form-control" value="<?php echo $user_data['middlename']; ?>">
                        </div>
                        <div class="col-md-4">
                            <label class="labels">Last Name</label>
                            <input type="text" class="form-control" value="<?php echo $user_data['lastname']; ?>">
                        </div>                        <div class="col-md-12">
                            <label class="labels">Mobile Number</label>
                            <input type="text" class="form-control" value="<?php echo $user_data['mobile']; ?>">
                        </div>
                        <div class="col-md-12">
                            <label class="labels">Email</label>
                            <input type="text" class="form-control" value="<?php echo $user_data['email']; ?>">
                        </div>
                        <div class="col-md-12">
                            <label class="labels">Sex</label>
                            <input type="text" class="form-control" value="<?php echo $user_data['sex']; ?>">
                        </div>
                    <?php } else { ?>
                        <div class="col-md-12">
                            <p>User data not available.</p>
                        </div>
                    <?php } ?>
                    <div class="mt-5 text-center">
                        <button class="btn btn-primary profile-button" type="button">Save Changes</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

    <!--Additional div for sidebar-->
    </div>
    </div>
</div>