<!-- Button to trigger the modal -->
<button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#registrationModal">
    + Master List
</button>
<button id="printTableButton">Print Table</button>

<!-- Bootstrap Modal -->
<div class="modal fade" id="registrationModal" tabindex="-1" aria-labelledby="registrationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="registrationModalLabel">Register to Masterlist</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-0">
                <!-- Your registration form content goes here -->
                <section class="contact-section section-padding" id="section_6">
                    <div class="container-fluid">
                        <div class="row d-flex justify-content-center align-items-center">
                            <div class="col-lg-12 col-12">
                            <form class="custom-form contact-form mb-4 align-items-center needs-validation" id="register" action="" method="post" enctype="multipart/form-data" role="form" novalidate>
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
                   
                    
                    <button type="submit" name="add_to_user_masterlist" class="form-control mt-2">Register</button>
                    <button type="button" class="form-control mt-2" data-bs-dismiss="modal">Cancel</button>
                </form>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
           
        </div>
    </div>
</div>

<div>
    <h1>Master List</h1>

    <!-- Display counts here -->
    <div class="count-summary">
        <p>Total Senior Users: <?php echo $masterListReports['seniorCount']; ?></p>
        <p>Total PWD Users: <?php echo $masterListReports['pwdCount']; ?></p>
        <p>Total 4Ps Users: <?php echo $masterListReports['fourPsCount']; ?></p>
        <p>Total Solo Parent Users: <?php echo $masterListReports['soloParentCount']; ?></p>
    </div>

    <div class="table-responsive text-center" id="myTable">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Full name</th>
                    <th>Age</th>
                    <th>Mobile</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th>Birthday<br />(YY-MM-DD)</th>
                    <th>4PS</th>
                    <th>PWD</th>
                    <th>Solo Parent</th>
                    <th>Scholar</th>

                </tr>
            </thead>
            <tbody class="text-center">
                <?php
                foreach ($masterListReports['users'] as $masterListReport) {
                    ?>
                    <tr>
                       
                        <td><?php echo $masterListReport['firstname'] . ' ' . $masterListReport['middlename'] . ' ' . $masterListReport['lastname']; ?></td>
                        <td><?php echo $masterListReport['age']; ?></td>
                        <td><?php echo $masterListReport['mobile']; ?></td>
                        <td><?php echo $masterListReport['email']; ?></td>
                        <td><?php echo $masterListReport['address']; ?></td>
                        <td><?php echo $masterListReport['birthdate']; ?></td>
                        <td><?php echo $masterListReport['four_ps'] == 1 ? 'YES' : ''; ?></td>
                        <td><?php echo $masterListReport['pwd'] == 1 ? 'YES' : ''; ?></td>
                        <td><?php echo $masterListReport['solo_parent'] == 1 ? 'YES' : ''; ?></td>
                        <td><?php echo $masterListReport['scholar'] == 1 ? 'YES' : ''; ?></td>

                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</div>


    <!--Additional div for sidebar-->
    </div>
    </div>
</div>
<script>
    document.getElementById("printTableButton").addEventListener("click", function() {
        var tableToPrint = document.getElementById("myTable");
        var username = "<?php echo $_SESSION['username']; ?>"; // Get the username from the PHP session

        // Apply CSS styles to add borders and center text in cells
        tableToPrint.style.borderCollapse = "collapse";
        tableToPrint.style.border = "1px solid #000";
        tableToPrint.style.textAlign = "center"; // Center align the text in cells

        var newWin = window.open('', '', 'width=600,height=600');
        newWin.document.open();
        newWin.document.write('<html><head><style>table {border-collapse: collapse; text-align: center;} table, th, td {border: 1px solid #000; text-align: center;} </style></head><body>');
        newWin.document.write('<p>Printed by: ' + username + '</p>'); // Add "printed by" note with the username

        // Get the table's content dynamically
        var tableRows = tableToPrint.getElementsByTagName('tr');
        newWin.document.write('<table>');

        // Add column headers
        var headerRow = tableRows[0];
        newWin.document.write('<tr>');
        var headerCells = headerRow.getElementsByTagName('th');
        for (var h = 0; h < headerCells.length; h++) {
            newWin.document.write('<th>' + headerCells[h].innerHTML + '</th>');
        }
        newWin.document.write('</tr>');

        // Add data rows
        for (var i = 1; i < tableRows.length; i++) {
            newWin.document.write('<tr>');
            var tableCells = tableRows[i].getElementsByTagName('td');
            for (var j = 0; j < tableCells.length; j++) {
                newWin.document.write('<td>' + tableCells[j].innerHTML + '</td>');
            }
            newWin.document.write('</tr>');
        }

        newWin.document.write('</table>');

        newWin.document.write('</body></html>');
        newWin.document.close();
        newWin.print();
        newWin.close();
    });
</script>

