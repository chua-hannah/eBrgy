<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="services">Services</a></li>
    <li class="breadcrumb-item active" aria-current="page">Request a Document</li>
  </ol>
</nav>
<div class="col-lg-6 col-12 mx-auto">
    <form class="custom-form contact-form mb-4" action="#" method="post" role="form">
        <div class="row d-flex justify-content-center">
        <h3 class="mb-4">Get a Barangay Document</h3>
            <div class="col-lg-12 col-md-6 col-12">
                <label class="labels">Document Type</label>
                <select class="form-select" name="selected_service" required>
                    <option value="" disabled selected>Select a document</option>
                    <?php
                        foreach ($requests as $request) {
                            // Display the data for each request
                            ?>
                            <option value="<?php echo $request['request_name']; ?>"><?php echo $request['request_name']; ?></option>    
                            <?php
                        }
                    ?>
                </select>
            </div>
            <div class="col-lg-12 col-md-6 col-12">
                <label class="labels">Remarks (Optional)</label>
                <textarea name="service_message" rows="3" class="form-control mb-4" id="service_message" placeholder="Details"></textarea>
            </div>
        </div>
        <div class="d-grid gap-2 col-12 mx-auto">
            <button type="submit" name="request_service" class="form-control">Submit Request</button>
            <a href="#requestListModal" class="text-center mb-0" data-bs-toggle="modal" data-bs-target="#requestListModal">
                View Submitted Requests
            </a>
        </div>
    </form>
</div>
<!-- Modal -->
<div class="modal fade" id="requestListModal" tabindex="-1" aria-labelledby="requestListModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h5 class="modal-title">Document Requests</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <!-- Modal Body (Your Table) -->
            <div class="modal-body">
                <?php if (empty($myrequest)) { ?>
                    <div class="text-center"><p>No requests are currently available.</p></div>
                <?php } else { ?>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped custom-table datatable">
                            <thead class="text-center">
                                <tr>
                                    <th>Document Type</th>
                                    <th>Remarks</th>
                                    
                                    <th>Request Date & Time</th>
                                    <th>Processed Date & Time</th>
                                    <th>Status</th>
                                    <th>action</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($myrequest as $request) {
                                    $createdAtDateFormattedDate = date("m/d/Y", strtotime($request['created_at']));
                                    $createdAtTimeFormattedTime = date("h:i A", strtotime($request['created_at']));
                                    if (!is_null($request['process_at'])) {
                                        $processAt = strtotime($request['process_at']);
                                    } else {
                                        $processAt = "-";
                                    }
                                    
                                    if ($request['created_at'] == "0000-00-00 00:00:00") {
                                        $processedFormattedDate = "-";
                                        $processedFormattedTime = "-";
                                    }

                                    if ($processAt == "-") {
                                        $processedAtFormattedDate = "-";
                                        $processedAtFormattedTime = "-";
                                    }
                                    else {
                                        $processedAtFormattedDate = date("m/d/Y", $processAt);
                                        $processedAtFormattedTime = date("h:i A", $processAt);

                                    }
                                    ?>
                                    <tr>
                                        <td><?php echo $request['request_name']; ?></td>
                                        <td><?php echo $request['message']; ?></td>
                                       
                                        <td><?php echo $createdAtDateFormattedDate . " " . $createdAtTimeFormattedTime; ?></td>
                                        <td><?php echo $processedAtFormattedDate . " " . $processedAtFormattedTime; ?></td>
                                        <td><?php echo strtoupper($request['status']); ?></td>
                                        <td>
                                        <?php
                                            $status = strtoupper($request['status']);
                                            if ($status == 'APPROVED') {
                                                // If the status is 'APPROVED', change the button to a form and include an invisible input for the id.
                                                echo '<form method="POST" action="barangay-certificate" target="_blank">
                                                        <input type="hidden" name="id" value="' . $request['id'] . '">
                                                        <button type="submit" class="btn btn-secondary" name="print_request_doc">Print</button>
                                                    </form>';
                                            } elseif ($status == 'PENDING') {
                                                // If the status is 'PENDING', add a button to cancel with a form and an invisible input to pass the $request['id'].
                                                echo '<form method="POST" action="">
                                                        <input type="hidden" name="id" value="' . $request['id'] . '">
                                                        <button type="submit" class="btn btn-danger" name="cancel_request_doc">Cancel</button>
                                                    </form>';
                                            } else {
                                                // If the status is 'REJECTED', echo an empty string.
                                                echo '';
                                            }
                                            ?>


                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>




  