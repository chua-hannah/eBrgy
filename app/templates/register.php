<section class="contact-section section-padding" id="section_6">
    <div class="container">
    <h2 class="mb-4 text-center">Register an account</h2>
        <div class="row d-flex justify-content-center align-items-center">
            <div class="col-lg-8 col-12">
                <form class="custom-form contact-form mb-4 align-items-cente" action="" method="post" enctype="multipart/form-data" role="form">
                    <h3 class="mb-4">Become a member today</h3>
                    <div class="row g-2">
                        <div class="col-lg-12 col-12">
                            <h5 class="mb-3">Personal information</h5>
                        </div>

                        <div class="col-lg-4 col-12">
                            <input type="text" name="firstname" class="form-control" id="firstname" placeholder="First name" value="<?php if (!empty($_POST["fullname"])) { echo $_POST["fullname"]; } else { echo ''; };?>" required>
                        </div>

                        <div class="col-lg-4 col-12">
                            <input type="text" name="middlename" class="form-control" id="middlename" placeholder="Middle name" value="<?php if (!empty($_POST["fullname"])) { echo $_POST["fullname"]; } else { echo ''; };?>">
                        </div>

                        <div class="col-lg-4 col-12">
                            <input type="text" name="lastname" class="form-control" id="lastname" placeholder="Last name" value="<?php if (!empty($_POST["fullname"])) { echo $_POST["fullname"]; } else { echo ''; };?>" required>
                        </div>

                        <div class="col-lg-6 col-12">
                            <input type="text" name="birthdate" class="form-control" id="birthdate" placeholder="Birthdate (MM/DD/YYYY)"  value="<?php if (!empty($_POST["age"])) { echo $_POST["age"]; } else { echo ''; };?>" required>
                        </div>

                        <div class="col-lg-6 col-12">
                            <select class="form-select" name="sex" placeholder="Gender" required>
                                <option value="" disabled selected>Gender</option>
                                <option value="male" <?php if(isset($_POST["sex"]) && $_POST["sex"]=="male"){ echo 'selected';} ?>>Male</option>
                                <option value="female" <?php if(isset($_POST["sex"]) && $_POST["sex"]=="female"){ echo 'selected';} ?>>Female</option>
                                <option value="others" <?php if(isset($_POST["sex"]) && $_POST["sex"]=="others"){ echo 'selected';} ?>>Others</option>
                            </select>
                        </div> 

                        <div class="col-lg-12 col-12">
                            <h5 class="mb-3">Contact Info</h5>
                        </div>

                        <div class="col-lg-6 col-12">
                            <div class="input-group">
                                <span class="input-group-text">+63</span>
                                <input type="text" class="form-control" id="mobileNumber" placeholder="Mobile Number" oninput="validateNumericInput(this)" maxlength="10" required>
                            </div>
                        </div>

                        <div class="col-lg-6 col-12">
                            <input type="email" name="email" pattern="[^ @]*@[^ @]*" class="form-control" id="email" placeholder="Email address" value="<?php if (!empty($_POST["email"])) { echo $_POST["email"]; } else { echo ''; };?>" required>
                        </div>
                        
                        <div class="col-lg-12 col-12">
                            <h5 class="mb-3">Documents</h5>
                        </div>

                        <!-- Add file upload fields -->
                        <div class="col-lg-6 col-12">
                            <label for="id_selfie">Upload Selfie w/ ID:</label>
                            <input type="file" name="id_selfie" id="id_selfie" class="form-control" accept="image/*" required>
                        </div>

                        <div class="col-lg-6 col-12">
                            <label for="valid_id">Upload Valid ID:</label>
                            <input type="file" name="valid_id" id="valid_id" class="form-control" accept="image/*" required>
                        </div>

                        <div class="col-lg-12 col-12">
                            <h5 class="mb-3">Access Credentials</h5>
                        </div>
                        
                        <div class="col-lg-6 col-12">
                            <input type="text" name="username" class="form-control" placeholder="Create Username (Must be 6 characters long)" value="<?php if (!empty($_POST["username"])) { echo $_POST["username"]; } else { echo ''; };?>" required>
                        </div>

                        <div class="col-lg-6 col-12">
                            <input type="password" name="password" class="form-control mb-4" placeholder="Nominate Password (Minimum of 8 characters)" required>
                        </div>
                        
                        <button type="submit" name="register" class="form-control">Register</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
