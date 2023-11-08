<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="requests">Manage Requests</a></li>
        <li class="breadcrumb-item"><a href="requests-equipments">Equipment</a></li>
        <li class="breadcrumb-item"><a href="requests-equipments-management">Manage Equipment</a></li>
        <li class="breadcrumb-item active" aria-current="page">Edit Equipment</li>
    </ol>
</nav>
<div class="container-fluid">
<h3>Edit Equipment</h3>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="text-center my-2">Equipment Details</h5>
                </div>
                <div class="card-body">
                    <?php if (empty($equipmentDatas)): ?>
                        <p>There is no equipment to edit.</p>
                    <?php else: ?>
                        <?php foreach ($equipmentDatas as $docData): ?>
                            <div class="card mb-4 shadow">
                                <div class="card-body">
                                    <form action="" class="custom-form" method="post">
                                    <div class="row d-flex justify-content-center align-items-center">
                                        <div class="form-group col-md-12 mb-3">
                                            <label>Equipment name:</label>
                                            <input type="text" class="form-control disabled-style" id="equipment_name" name="equipment_name" value="<?php echo $docData['equipment_name']; ?>" readonly>
                                        </div>
                                      
                                        <div class="form-group col-md-6 mb-3">
                                            <label>Total Equipment Available:</label>
                                            <input type="number" class="form-control" id="total_equipment" name="total_equipment" value="<?php echo $docData['total_equipment']; ?>" min="1" maxlength="6" disabled>
                                        </div>
                                        <div class="form-group col-md-6 mb-3">
                                            <label for="status">Status:</label>
                                            <select class="form-select" id="availability" name="availability" disabled>
                                                <option value="1" <?php echo $docData['availability'] === "1" ? 'selected' : ''; ?>>Available</option>
                                                <option value="0" <?php echo $docData['availability'] === "0" ? 'selected' : ''; ?>>Not Available</option>
                                            </select>
                                        </div>
                                        <input type="hidden" name="equipment_id" value="<?php echo $docData['equipment_id']; ?>">
                                        <div class="col-lg-6 mb-3">
                                            <a href="requests-equipments-management" class="form-control cancel-button">Cancel</a>
                                        </div>
                                        <div class="col-lg-6 mb-3">
                                            <button type="button" class="form-control" id="editButton">Edit</button>
                                            <button type="submit" class="form-control" id="saveButton" name="update_equipment_by_id" style="display: none;">Save Changes</button>
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
