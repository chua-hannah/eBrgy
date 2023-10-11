<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="services">Services</a></li>
    <li class="breadcrumb-item active" aria-current="page">Documents</li>
  </ol>
</nav>
<h2 class="text-center mt-2 mb-2">Document Request Form</h2>
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
    <div class="modal-dialog modal-dialog-centered">
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
                        <table class="table table-bordered table-striped custom-table">
                            <thead class="text-center">
                                <tr>
                                    <th>Document Type</th>
                                    <th>Status</th>
                                    <th>Request Date & Time</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($myrequest as $request) {
                                    $htmlFormattedDate = date("m/d/Y", strtotime($request['created_at']));
                                    $htmlFormattedTime = date("h:i A", strtotime($request['created_at']));
                                    ?>
                                    <tr>
                                        <td><?php echo $request['request_name']; ?></td>
                                        <td><?php echo $request['status']; ?></td>
                                        <td><?php echo $htmlFormattedDate . " " . $htmlFormattedTime; ?></td>
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




  