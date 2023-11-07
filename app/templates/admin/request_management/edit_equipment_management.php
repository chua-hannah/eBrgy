<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card custom-card">
                <div class="card-header">
                    <h3 class="text-center my-2">Equipment</h3>
                </div>
                <div class="card-body">
                    <?php if (empty($equipmentDatas)): ?>
                        <p>There is no equipment to edit.</p>
                    <?php else: ?>
                        <?php foreach ($equipmentDatas as $docData): ?>
                            <div class="card mb-4 shadow">
                                <div class="card-body">
                                    <form action="" method="post">
                                        <div class="form-group">
                                            <label>Equipment name:</label>
                                            <input type="text" class="form-control" id="equipment_name" name="equipment_name" value="<?php echo $docData['equipment_name']; ?>" readonly>
                                        </div>
                                      
                                        <div class="form-group">
                                            <label>Total Equipment Available:</label>
                                            <input type="text" class="form-control" id="total_equipment" name="total_equipment" value="<?php echo $docData['total_equipment']; ?>" disabled>
                                        </div>
                                        <div class="form-group">
                                            <label for="status">Status:</label>
                                            <select class="form-control" id="availability" name="availability" disabled>
                                                <option value="1" <?php echo $docData['availability'] === "1" ? 'selected' : ''; ?>>Available</option>
                                                <option value="0" <?php echo $docData['availability'] === "0" ? 'selected' : ''; ?>>Not Available</option>
                                            </select>
                                        </div>

                                        <input type="hidden" name="equipment_id" value="<?php echo $docData['equipment_id']; ?>">
                                        <div style="display: flex; justify-conter: space-around;">
                                            <button type="button" class="btn btn-primary" id="editButton"><i class="bi bi-pencil"></i> Edit</button>
                                            <button type="submit" class="btn btn-success" id="saveButton" name="update_equipment_by_id" style="display: none;"><i class="bi bi-check"></i> Save Changes</button>
                                            <a href="requests-equipments-management" class="btn btn-secondary">Cancel</a>
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
