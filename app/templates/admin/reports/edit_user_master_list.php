<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="masterlist">Non-User</a></li>
        <li class="breadcrumb-item active" aria-current="page"><?php foreach ($userDatas as $userData): echo  $userData['firstname']; endforeach;?> Info</li>
    </ol>
</nav>
<div class="container-fluid">
<h3>Update Non-User Information</h3>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="text-center mb-0">Resident Information</h5>
                </div>
                <div class="card-body">
                    <?php if (empty($userDatas)): ?>
                        <p>There is no user to update information.</p>
                    <?php else: ?>
                        <?php foreach ($userDatas as $userData): ?>
                            <div class="card mb-4">
                                <div class="card-body">
                                    <form action="" class="custom-form"  method="post">
                                        <div class="row d-flex justify-content-center align-items-center">
                                            <div class="form-group col-md-6 mb-3">
                                                <label for="purposeRemarks">Mobile Number:</label>
                                                <input type="text" class="form-control" id="mobile" name="mobile" value="<?php echo $userData['mobile']; ?>" disabled>
                                            </div>
                                            <div class="form-group col-md-6 mb-3">
                                                <label for="purposeRemarks">House Address:</label>
                                                <input type="text" class="form-control" id="address" name="address" value="<?php echo $userData['address']; ?>" disabled>
                                            </div>

                                            <div class="form-group col-md-6 mb-3">
                                                <label for="status">Scholar:</label>
                                                <select class="form-select" id="scholar" name="scholar" disabled>
                                                    <option value="1" <?php echo $userData['scholar'] === "1" ? 'selected' : ''; ?>>True</option>
                                                    <option value="0" <?php echo $userData['scholar'] === "0" ? 'selected' : ''; ?>>False</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-6 mb-3">
                                                <label for="status">4PS:</label>
                                                <select class="form-select" id="four_ps" name="four_ps" disabled>
                                                    <option value="1" <?php echo $userData['four_ps'] === "1" ? 'selected' : ''; ?>>True</option>
                                                    <option value="0" <?php echo $userData['four_ps'] === "0" ? 'selected' : ''; ?>>False</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-6 mb-3">
                                                <label for="status">Solo Parent:</label>
                                                <select class="form-select" id="solo_parent" name="solo_parent" disabled>
                                                    <option value="1" <?php echo $userData['solo_parent'] === "1" ? 'selected' : ''; ?>>True</option>
                                                    <option value="0" <?php echo $userData['solo_parent'] === "0" ? 'selected' : ''; ?>>False</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-6 mb-3">
                                                <label for="status">Senior:</label>
                                                <select name="senior" class="form-select" id="senior" disabled>
                                                    <option value="0" <?php echo $userData['senior'] === "0" ? 'selected' : ''; ?> style="<?php echo $userData['senior'] !== "0" ? 'display: none;' : ''; ?>">False</option>
                                                    <option value="1" <?php echo $userData['senior'] === "1" ? 'selected' : ''; ?>>True</option>
                                                </select>
                                            </div>
                                            <input type="hidden" name="id" value="<?php echo $userData['id']; ?>">
                                            <div class="col-md-6 mb-3">
                                                    <a href="non-user" class="form-control cancel-button">Cancel</a>
                                            </div>  
                                            <div class="col-md-6 mb-3">
                                                <button type="button" class="form-control" id="editButton">Edit</button>                                            
                                                <button type="submit" class="form-control" id="saveButton" name="update_masterlist_user" style="display: none;">Save Changes</button>
                                            </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<!--Additional div for sidebar or other content -->
</div>
</div>
</div>
<script>
    $(document).ready(function() {
        $("#editButton").click(function() {
            // Disable the "Edit" button
            $(this).prop("disabled", true);
            // Enable the form fields except for the date field
            $("input:not(#dateTimeCreated), select").prop("disabled", false);
            // Hide the "Edit" button
            $(this).hide();
            // Show the "Save Changes" button
            $("button#saveButton").show();
        });
    });
</script>
