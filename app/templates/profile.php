<div class="container rounded bg-white mt-5 mb-5">
    <div class="row">
        <div class="col-md-3 border-right">
            <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                <img class="rounded-circle mt-5" width="150px" src="assets/images/dummy-avatar.png" alt="profilepic"><h3>Resident</h3><?php echo $_SESSION['username']; ?><h5></h5></div>
            </div>
        <div class="col-md-8 border-right">
            <div class="p-3 py-5">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="text-right">Barangay Profile</h4>
                </div>
                <div class="row mt-3">
                    <div class="col-md-12"><label class="labels">Full Name</label><input type="text" class="form-control" value="<?php echo $_SESSION['fullname']; ?>" ></div>
                    <div class="col-md-12"><label class="labels">Mobile Number</label><input type="text" class="form-control" value="<?php echo $_SESSION['mobile']; ?>" ></div>
                    <div class="col-md-12"><label class="labels">Email</label><input type="text" class="form-control" value="<?php echo $_SESSION['email']; ?>"></div>
                    <div class="col-md-12"><label class="labels">Sex</label><input type="text" class="form-control" value="<?php echo $_SESSION['sex']; ?>"></div>
                <div class="mt-5 text-center">
                <button class="btn btn-primary profile-button" type="button">Edit</button>
                <button class="btn btn-primary profile-button" type="button">Save Changes</button>
                </div>
            </div>
        </div>
       
    </div>
</div>
</div>
</div>