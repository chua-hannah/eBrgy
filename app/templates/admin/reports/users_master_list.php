<div class="container-fluid">
<div style="float:right;">
<button type="button" class="form-control custom-button" data-bs-toggle="modal" data-bs-target="#registrationModal">
    <i class="bi bi-person"></i> Add Resident
</button>
</div>
<h3 class="mt-2 mb-2 text-center">Resident Masterlist</h3>
<!-- Bootstrap Modal -->
<div class="modal fade" id="registrationModal" tabindex="-1" aria-labelledby="registrationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="registrationModalLabel">Register a resident</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row d-flex justify-content-center align-items-center">
                        <div class="col-lg-12 col-12">
                        <form class="custom-form mb-4 align-items-center needs-validation" id="register-form" action="" method="post" enctype="multipart/form-data" role="form" novalidate>
                                <div class="row g-2">
                                    <h6>Personal Information</h6>
                                    <div class="col-lg-4 col-12">
                                        <label class="labels">First Name</label>
                                        <input type="text" name="firstname" class="form-control <?php echo isset($errors["firstname"]) ? 'is-invalid' : ''; ?>" id="firstname" value="<?php if (!empty($_POST["firstname"])) { echo $_POST["firstname"]; } else { echo ''; };?>">
                                        <div class="text-danger error-message" data-field="firstname" id="error_first"><?= isset($errors["firstname"]) ? $errors["firstname"] : ''; ?></div>
                                    </div>

                                    <div class="col-lg-4 col-12">
                                    <label class="labels">Middle Name (Optional)</label>
                                        <input type="text" name="middlename" class="form-control
                                        <?php echo isset($errors["middlename"]) ? 'is-invalid' : ''; ?>" 
                                        id="middlename" value="<?php if (!empty($_POST["middlename"])) { echo $_POST["middlename"]; } else { echo ''; };?>">
                                        <?php if (isset($errors["middlename"])) : ?>
                                            <div class="text-danger" id="error_middle"><?= $errors["middlename"] ?></div>
                                        <?php endif; ?>
                                    </div>

                                    <div class="col-lg-4 col-12">
                                        <label class="labels">Last Name</label>
                                        <input type="text" name="lastname" class="form-control <?php echo isset($errors["lastname"]) ? 'is-invalid' : ''; ?>" id="lastname" value="<?php if (!empty($_POST["lastname"])) { echo $_POST["lastname"]; } else { echo ''; };?>">
                                        <div class="text-danger error-message" data-field="lastname" id="error_last"><?= isset($errors["lastname"]) ? $errors["lastname"] : ''; ?></div>
                                    </div>

                                    <div class="col-lg-6 col-12">
                                        <label class="labels">Birthdate</label>
                                        <div class="input-group">
                                            <span class="input-group-text">
                                                <i class="bi bi-calendar"></i>
                                            </span>
                                            <input type="text" name="birthdate" id="datepicker" class="form-control <?php echo isset($errors["birthdate"]) ? 'is-invalid' : ''; ?>" placeholder="MM/DD/YYYY" value="<?php if (!empty($_POST["birthdate"])) { echo $_POST["birthdate"]; } else { echo ''; }; ?>">
                                        </div>
                                        <div class="text-danger error-message" data-field="birthdate" id="error_birth"><?= isset($errors["birthdate"]) ? $errors["birthdate"] : ''; ?></div>
                                    </div>

                                    <div class="col-lg-6 col-12">
                                        <label class="labels">Gender</label>
                                        <select class="form-select <?php echo isset($errors["sex"]) ? 'is-invalid' : ''; ?>" name="sex" id="sex" placeholder="Gender">
                                            <option value="" disabled selected>Select gender</option>
                                            <option value="Male" <?php if(isset($_POST["sex"]) && $_POST["sex"]=="Male"){ echo 'selected';} ?>>Male</option>
                                            <option value="Female" <?php if(isset($_POST["sex"]) && $_POST["sex"]=="Female"){ echo 'selected';} ?>>Female</option>
                                            <option value="Others" <?php if(isset($_POST["sex"]) && $_POST["sex"]=="Others"){ echo 'selected';} ?>>Others</option>
                                        </select>
                                        <div class="text-danger error-message" data-field="sex" id="error_sex"><?= isset($errors["sex"]) ? $errors["sex"] : ''; ?></div>
                                    </div>

                                    <div class="col-lg-6 col-12">
                                        <label class="labels">Mobile Number (Optional)</label>
                                        <div class="input-group">
                                            <span class="input-group-text">+63</span>
                                            <input type="text" class="form-control <?php echo isset($errors["mobile"]) ? 'is-invalid' : ''; ?>" name="mobile" id="mobile" oninput="validateNumericInput(this)" maxlength="10" value="<?php if (!empty($_POST["mobile"])) { echo $_POST["mobile"]; } else { echo ''; };?>">                                        </div>

                                    </div>

                                    <div class="col-lg-6 col-12">
                                        <label class="labels">Email Address (Optional)</label>
                                        <input type="email" name="email" pattern="[^ @]*@[^ @]*" class="form-control <?php echo isset($errors["email"]) ? 'is-invalid' : ''; ?>" id="email" value="<?php if (!empty($_POST["email"])) { echo $_POST["email"]; } else { echo ''; };?>">                                        
                                    </div>

                                    <div class="col-lg-4 col-12">
                                        <label class="long-label" style="font-size: 16px;">House No./Bldg./Street Name</label>
                                        <input type="text" name="address" class="form-control <?php echo isset($errors["address"]) ? 'is-invalid' : ''; ?>" id="address" value="<?php if (!empty($_POST["address"])) { echo $_POST["address"]; } else { echo ''; };?>">
                                        <div class="text-danger error-message" data-field="address" id="error_address"><?= isset($errors["address"]) ? $errors["address"] : ''; ?></div>
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
                                        <h6>Membership Information</h6>
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
                                </div>
                                <div class="row g-2 mt-2">
                                    <div class="col-md-6 col-12">
                                        <button type="" class="form-control cancel-button" data-bs-dismiss="modal">Cancel</button>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <button type="submit" name="add_to_user_masterlist" id="registerButton" class="btn btn-primary form-control mb-0">Register</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div>
    <div class="table-responsive">
    <h4 class="mt-2 mb-2">Demographic Information</h4>
        <table class="table table-bordered table-striped custom-table">
            <thead>
                <tr>
                    <th class="wrap-text">Total Senior Citizen</th>
                    <th class="wrap-text">Total PWD</th>
                    <th class="wrap-text">Total 4Ps</th>
                    <th class="wrap-text">Total Solo Parents</th>
                    <th class="wrap-text">Total Scholars</th>
                </tr>
            </thead>
            <tbody class="text-center">
                <td><?php echo $masterListReports['seniorCount']; ?></td>
                <td><?php echo $masterListReports['pwdCount']; ?></td>
                <td><?php echo $masterListReports['fourPsCount']; ?></td>
                <td><?php echo $masterListReports['soloParentCount']; ?></td>
                <td><?php echo $masterListReports['scholarCount']; ?></td>
            </tbody>
        </table>
    </div>
    <div class="table-responsive">
    <h4 class="mt-2 mb-2">Resident Information</h4>
        <table class="table table-bordered table-striped custom-table datatable" id="myTable">
            <thead>
                <tr>
                    <th class="wrap-text">Action/s</th>
                    <th class="wrap-text">First name</th>
                    <th class="wrap-text">Middle name</th>
                    <th class="wrap-text">Last name</th>
                    <th class="wrap-text">Birthdate</th>
                    <th class="wrap-text">Age</th>
                    <th class="wrap-text">Gender</th>
                    <th class="wrap-text">Mobile</th>
                    <th class="wrap-text">Email</th>
                    <th class="wrap-text">House Address</th>
                    <th class="wrap-text">4PS</th>
                    <th class="wrap-text">PWD</th>
                    <th class="wrap-text">Solo Parent</th>
                    <th class="wrap-text">Scholar</th>
                    <th class="wrap-text">Senior</th>
                </tr>
            </thead>
            <tbody class="text-center">
                <?php
                foreach ($masterListReports['users'] as $masterListReport) {
                    ?>
                    <tr>
                    <td style="display: flex;"> 
                        <form method="POST" action="edit-non-user">
                            <input type="hidden" name="resident_id" value="<?php echo $masterListReport['id'] ?>">
                            <button type="" class="btn btn-primary me-2" name="edit_resident">Edit</button>
                        </form>
                        <form method="POST" action="">
                            <input type="hidden" name="resident_id" value="<?php echo $masterListReport['id'] ?>">
                            <button type="" class="btn btn-danger" name="delete_resident">Delete</button>
                        </form>
                        </td>
                        <td><?php echo $masterListReport['firstname']; ?></td>
                        <td><?php echo $masterListReport['middlename']; ?></td>
                        <td><?php echo $masterListReport['lastname']; ?></td>
                        <td><?php echo date('m/d/Y', strtotime($masterListReport['birthdate'])); ?></td>
                        <td><?php echo $masterListReport['age']; ?></td>
                        <td><?php echo $masterListReport['gender']; ?></td>
                        <td><?php echo $masterListReport['mobile']; ?></td>
                        <td><?php echo $masterListReport['email']; ?></td>
                        <td><?php echo $masterListReport['address']; ?></td>
                        <td><?php echo $masterListReport['four_ps'] == 1 ? '&#10003;' : ''; ?></td>
                        <td><?php echo $masterListReport['pwd'] == 1 ? '&#10003;' : ''; ?></td>
                        <td><?php echo $masterListReport['solo_parent'] == 1 ? '&#10003;' : ''; ?></td>
                        <td><?php echo $masterListReport['scholar'] == 1 ? '&#10003;' : ''; ?></td>
                        <td><?php echo $masterListReport['senior'] == 1 ? '&#10003;' : ''; ?></td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
<div class="row">
    <div class="col">
        <!-- Content in the left side of the row (if any) -->
    </div>
    <div class="col">
        <div class="d-flex justify-content-end mt-4">
            <button id="printTableButton">Print Table</button>
        </div>
    </div>
</div>
</div>
    <!--Additional div for sidebar-->
    </div>
    </div>
</div>
<script>
document.getElementById("printTableButton").addEventListener("click", function() {
    var table = $('#myTable').DataTable(); // Initialize DataTables on your table
    var username = "<?php echo $_SESSION['username']; ?>"; // Get the username from the PHP session
    var newWin = window.open('', '_blank', 'width=800,height=1100');
   
    newWin.document.open();
    newWin.document.write('<html><head><style>table {border-collapse: collapse; text-align: center;} table, th, td {border: 1px solid #000; text-align: center;} </style></head><body>');

    // Add a header above the table
    newWin.document.write('<h1>Non Users Report</h1>');
    newWin.document.write('<p>Printed by: ' + username + '</p>'); // Add "printed by" note with the username

    var tableData = table.data().toArray(); // Get all the data from DataTables

    newWin.document.write('<table>');

    // Add column headers, including the "Row Number" column
    var headerCells = $('#myTable thead th:not(:last-child)'); // Get column headers from the table
    newWin.document.write('<tr>');
    newWin.document.write('<th class="wrap-text">#</th>'); // Add Row Number header
    headerCells.each(function () {
        newWin.document.write('<th class="wrap-text">' + $(this).text() + '</th>');
    });
    newWin.document.write('</tr>');

    // Add data rows with row numbers
    tableData.forEach(function (dataRow, rowIndex) {
        newWin.document.write('<tr>');
        newWin.document.write('<td>' + (rowIndex + 1) + '</td>'); // Add Row Number
        dataRow.slice(0, -1).forEach(function (cellData) {
            newWin.document.write('<td>' + cellData + '</td>');
        });
        newWin.document.write('</tr>');
    });

    newWin.document.write('</table>');

    newWin.document.write('</body></html>');
    newWin.document.close();
    newWin.print();
    newWin.close();
});

    // Display error messages
    document.addEventListener("DOMContentLoaded", function () {
    const registerForm = document.getElementById("register-form");
    const registerButton = document.getElementById("registerButton");

    registerForm.addEventListener("submit", function (event) {
        // Your form validation logic here
        const errors = validateForm();

        if (Object.keys(errors).length > 0) {
            event.preventDefault(); // Prevent the default form submission behavior
            // Handle errors, display error messages, etc.
        } else {
            // If validation passes, you can submit the form programmatically
            this.submit(); // Uncomment this line if you want to submit the form programmatically
        }
    });

        function validateForm() {
        const errors = {};
        
        // First Name
        const firstname = document.getElementById("firstname").value;
        if (!firstname) {
            errors["firstname"] = "Enter First Name";
        }


        // Last Name
        const lastname = document.getElementById("lastname").value;
        if (!lastname) {
            errors["lastname"] = "Enter Last Name";
        }

        // Birthdate
        const birthdate = document.getElementById("datepicker").value;
        if (!birthdate) {
            errors["birthdate"] = "Enter Birthdate";
        }

        // Gender
        const gender = document.getElementById("sex").value;
        if (!gender || gender === "Select gender") {
            errors["sex"] = "Select Gender";
        }

        // Mobile Number

        // Address
        const address = document.getElementById("address").value;
        if (!address) {
            errors["address"] = "Enter Address";
        }
        const errorElements = document.querySelectorAll(".error-message");
        errorElements.forEach((errorElement) => {
            const fieldName = errorElement.getAttribute("data-field");
            if (errors[fieldName]) {
                errorElement.textContent = errors[fieldName];
            } else {
                errorElement.textContent = "";
            }
        });

        return errors;
    }
    });
</script>



