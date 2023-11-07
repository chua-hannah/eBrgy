<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card custom-card">
                <div class="card-header">
                    <h3 class="text-center my-2">Document File</h3>
                </div>
                <div class="card-body">
                    <?php if (empty($docDatas)): ?>
                        <p>There is no document file to edit.</p>
                    <?php else: ?>
                        <?php foreach ($docDatas as $docData): ?>
                            <div class="card mb-4 shadow">
                                <div class="card-body">
                                    <form action="" method="post">
                                        <div class="form-group">
                                            <label for="purposeRemarks">Document name:</label>
                                            <input type="text" class="form-control" id="request_name" name="request_name" value="<?php echo $docData['request_name']; ?>" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="purposeRemarks">Purpose / Remarks:</label>
                                            <input type="text" class="form-control" id="purposeRemarks" name="purposeRemarks" value="<?php echo $docData['description']; ?>" disabled>
                                        </div>
                                        <div class="form-group">
                                            <label for="status">Status:</label>
                                            <select class="form-control" id="status" name="status" disabled>
                                                <option value="1" <?php echo $docData['request_status'] === "1" ? 'selected' : ''; ?>>Available</option>
                                                <option value="0" <?php echo $docData['request_status'] === "0" ? 'selected' : ''; ?>>Not Available</option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="dateTimeCreated">Date & Time Created:</label>
                                            <input type="text" class="form-control" id="dateTimeCreated" name="dateTimeCreated" value="<?php echo date("m/d/Y", strtotime($docData['created_at'])); ?>" disabled>
                                        </div>
                                        <input type="hidden" name="doc_id" value="<?php echo $docData['request_type_id']; ?>">
                                        <div style="display: flex; justify-conter: space-around;">
                                            <button type="button" class="btn btn-primary" id="editButton"><i class="bi bi-pencil"></i> Edit</button>
                                            <button type="submit" class="btn btn-success" id="saveButton" name="update_doc_by_id" style="display: none;"><i class="bi bi-check"></i> Save Changes</button>
                                            <a href="requests-documents-management" class="btn btn-secondary">Cancel</a>
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
