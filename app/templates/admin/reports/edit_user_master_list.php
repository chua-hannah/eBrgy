<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card custom-card">
                <div class="card-header">
                    <h3 class="text-center my-2">User Master List</h3>
                </div>
                <div class="card-body">
                    <?php if (empty($userDatas)): ?>
                        <p>There is no user to update information.</p>
                    <?php else: ?>
                        <?php foreach ($userDatas as $userData): ?>
                            <div class="card mb-4 shadow">
                                <div class="card-body">
                                    <form action="" method="post">
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
                                            <select class="form-control" id="scholar" name="scholar" disabled>
                                                <option value="1" <?php echo $userData['scholar'] === "1" ? 'selected' : ''; ?>>True</option>
                                                <option value="0" <?php echo $userData['scholar'] === "0" ? 'selected' : ''; ?>>False</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-6 mb-3">
                                            <label for="status">4PS:</label>
                                            <select class="form-control" id="four_ps" name="four_ps" disabled>
                                                <option value="1" <?php echo $userData['four_ps'] === "1" ? 'selected' : ''; ?>>True</option>
                                                <option value="0" <?php echo $userData['four_ps'] === "0" ? 'selected' : ''; ?>>False</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-6 mb-3">
                                            <label for="status">Solo Parent:</label>
                                            <select class="form-control" id="solo_parent" name="solo_parent" disabled>
                                                <option value="1" <?php echo $userData['solo_parent'] === "1" ? 'selected' : ''; ?>>True</option>
                                                <option value="0" <?php echo $userData['solo_parent'] === "0" ? 'selected' : ''; ?>>False</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-6 mb-3">
                                            <label for="status">Senior:</label>
                                            <select name="senior" class="form-control" id="senior" disabled>
                                                <option value="0" <?php echo $userData['senior'] === "0" ? 'selected' : ''; ?> style="<?php echo $userData['senior'] !== "0" ? 'display: none;' : ''; ?>">False</option>
                                                <option value="1" <?php echo $userData['senior'] === "1" ? 'selected' : ''; ?>>True</option>
                                            </select>

                                        </div>
                                        <input type="hidden" name="id" value="<?php echo $userData['id']; ?>">
                                        <div style="display: flex; justify-content: space-around;">
                                            <button type="button" class="btn btn-primary me-2" id="editButton"><i class="bi bi-pencil"></i> Edit</button>
                                            <button type="submit" class="btn btn-success me-2" id="saveButton" name="update_masterlist_user" style="display: none;"><i class="bi bi-check"></i> Save Changes</button>
                                            <a href="masterlist" class="btn btn-secondary">Cancel</a>
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
