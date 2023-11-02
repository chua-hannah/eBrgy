<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="requests">Manage Requests</a></li>
    <li class="breadcrumb-item"><a href="requests-documents">Documents</a></li>
    <li class="breadcrumb-item active" aria-current="page">Manage Document Types</li>
  </ol>
</nav>
<div class="container-fluid">
    <h3>Manage Document Types</h3>
    <div class="col-md-12">
        <form class="custom-form" action="" method="post">
            <div class="row">
                <div class="col-md-3">
                    <label class="labels">Document Name</label>
                    <input class="form-control" type="text" name="request_name" placeholder="ex. Barangay Clearance" required>
                </div>
                <div class="col-md-3">
                    <label class="labels">Status</label>
                    <select class="form-select" name="status" required>
                        <option value="" disabled selected>Choose status</option>
                        <option value="1">Available</option>
                        <option value="2">Not Available</option>
                    </select>
                </div>
                <div class="col-md-3">
                <label class="labels">Description</label>
                    <input class="form-control" name="description" placeholder="(Optional)"></textarea>
                </div>
                <div class="col-md-3 align-self-end">
                    <button class="form-control" type="submit" name="add_request">Submit</button>
                </div>
            </div>
        </form>
    </div>

    <div>
         <h3>List of Documents</h3>
        <div>
            <?php
            // Check if there are any records fetched from the database
            if (!empty($requests)) {
            ?>
                <table class="table table-bordered table-striped custom-table datatable">
                    <thead>
                        <tr>
                            <th class="wrap-text">Document Name</th>
                            <th class="wrap-text">Description</th>
                            <th class="wrap-text">Status</th>
                            <th class="wrap-text">Created Date</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($requests as $request) {
                        // Display the data for each request
                    ?>
                        <tr>
                            <td><?php echo $request['request_name']; ?></td>
                            <td><?php echo empty($request['description']) ? "-" : $request['description']; ?></td>
                            <td>
                                <?php echo $request['request_status'] === "1" ? "Available" : "Not Available"; ?>
                            </td>
                            <td><?php echo date("m/d/Y", strtotime($request['created_at'])); ?></td>
                        </tr>
                    <?php
                    }
                    ?>
                    </tbody>
                </table>
            <?php
            } else {
                // Display a message if no records are found
                echo "No Data Available.";
            }
            ?>
        </div>

        </div>

            <!--Additional div for sidebar-->
    </div>
    </div>
</div>