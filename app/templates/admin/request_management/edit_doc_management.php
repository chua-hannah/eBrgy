<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="requests">Manage Requests</a></li>
        <li class="breadcrumb-item"><a href="requests-documents">Documents</a></li>
        <li class="breadcrumb-item"><a href="requests-documents-management">Manage Document Types</a></li>
        <li class="breadcrumb-item active" aria-current="page">Edit Document</li>
    </ol>
</nav>
<div class="container-fluid">
<h3>Edit Document File</h3>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="text-center my-2">Document File</h5>
                </div>
                <div class="card-body">
                    <?php if (empty($docDatas)): ?>
                        <p>There is no document file to edit.</p>
                    <?php else: ?>
                        <?php foreach ($docDatas as $docData): ?>
                            <div class="card mb-4">
                                <div class="card-body">
                                    <form action="" class="custom-form" method="post">
                                    <div class="row d-flex justify-content-center align-items-center">
                                        <div class="form-group col-md-6 mb-3">
                                            <label for="purposeRemarks">Document name:</label>
                                            <input type="text" class="form-control disabled-style" id="request_name" name="request_name" value="<?php echo $docData['request_name']; ?>" readonly>
                                        </div>
                                        <div class="form-group col-md-6 mb-3">
                                            <label for="dateTimeCreated">Date & Time Created:</label>
                                            <input type="text" class="form-control" id="dateTimeCreated" name="dateTimeCreated" value="<?php echo date("m/d/Y", strtotime($docData['created_at'])); ?>" disabled>
                                        </div>
                                        <div class="form-group col-md-6 mb-3">
                                            <label for="status">Status:</label>
                                            <select class="form-select" id="status" name="status" disabled>
                                                <option value="1" <?php echo $docData['request_status'] === "1" ? 'selected' : ''; ?>>Available</option>
                                                <option value="0" <?php echo $docData['request_status'] === "0" ? 'selected' : ''; ?>>Not Available</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-6 mb-3">
                                            <label for="purposeRemarks">Purpose / Remarks:</label>
                                            <input type="text" class="form-control" id="purposeRemarks" name="purposeRemarks" value="<?php echo $docData['description']; ?>" disabled>
                                        </div>
                                        <input type="hidden" name="doc_id" value="<?php echo $docData['request_type_id']; ?>">
                                        <div class="col-lg-6 mb-3">
                                            <a href="requests-documents-management" class="form-control cancel-button">Cancel</a>
                                        </div>
                                        <div class="col-lg-6 mb-3">
                                            <button type="button" class="form-control" id="editButton">Edit</button>
                                            <button type="submit" class="form-control" id="saveButton" name="update_doc_by_id" style="display: none;"></i> Save Changes</button>
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
