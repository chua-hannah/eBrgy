<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="services">Services</a></li>
    <li class="breadcrumb-item active" aria-current="page">Reports</li>
  </ol>
</nav>
<h2 class="text-center mt-2 mb-2">Report Form</h2>
<div class="col-lg-6 col-12 mx-auto">
    <form class="custom-form contact-form mb-4" action="#" method="post" role="form">
        <div class="row d-flex justify-content-center">
        <h3 class="mb-4">File a report or a complaint</h3>
            <div class="col-lg-12 col-md-6 col-12">
                <label class="labels">Person to Report</label>
                <input type="text" name="reported_person_name" id="reported_person_name" class="form-control" placeholder="Full name" required>
            </div>  

            <div class="col-lg-12 col-md-6 col-12">
                <label class="labels">Place of Incident</label>
                <input type="text" name="place_of_incident" id="place" class="form-control" placeholder="Location" required>
            </div>

            <div class="col-lg-6 col-md-6 col-12">
                <label class="labels">Date of Incident</label>
                <input type="date" name="date_of_incident" id="date" class="form-control" required>
            </div>
            
            <div class="col-lg-6 col-md-6 col-12">
                <label class="labels">Time of Incident</label>
                <input type="time" name="time_of_incident" id="time" class="form-control" required>
            </div>

            <div class="col-lg-12 col-md-6 col-12">
                <label class="labels">Details of the Incident</label>
                <input type="text" name="subject_person" id="subject" class="form-control" placeholder="Subject" required>
                <textarea name="note" rows="5" class="form-control mb-4" id="note" placeholder="Complaint"></textarea>
            </div>
        </div>
        <div class="d-grid gap-2 col-12 mx-auto">
            <button type="submit" name="report_form" class="form-control">Submit Report</button>
            <a href="#reportModal" class="text-center mb-0" data-bs-toggle="modal" data-bs-target="#reportModal">
                View Submitted Reports
            </a>
        </div>
    </form>
</div>
<!-- Modal -->
<div class="modal fade" id="reportModal" tabindex="-1" aria-labelledby="reportModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h5 class="modal-title">Submitted Reports</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <!-- Modal Body (Your Table) -->
            <div class="modal-body modal-body-scrollable">
                <?php if (empty($myrequest)) { ?>
                    <div class="text-center"><p>No requests are currently available.</p></div>
                <?php } else { ?>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped custom-table">
                            <thead class="text-center">
                                <tr>
                                    <th class="wrap-text">Username</th>
                                    <th class="wrap-text">Mobile</th>
                                    <th class="wrap-text">Status</th>
                                    <th class="wrap-text">Request Date & Time</th>
                                    <th class="wrap-text">Processed Date & Time</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($myrequest as $request) { 
                                        $htmlFormattedDate = date("m/d/Y", strtotime($request['created_at']));
                                        $htmlFormattedTime = date("h:i A", strtotime($request['created_at']));
                                        if ($request['created_at']== "0000-00-00 00:00:00"){
                                            $processedFormattedDate = "-";
                                            $processedFormattedTime = "-";
                                        }
                                        else {
                                            // Convert and format date and time as before
                                            $processedFormattedDate = date("m/d/Y", strtotime($request['created_at']));
                                            $processedFormattedTime = date("h:i A", strtotime($request['created_at']));
                                        }
                                ?>
                                    <tr>
                                        <td><?php echo $request['username']; ?></td>
                                        <td><?php echo $request['mobile']; ?></td>
                                        <td><?php echo $request['status']; ?></td>
                                        <td><?php echo $htmlFormattedDate . " " . $htmlFormattedTime; ?></td>
                                        <td><?php echo $processedFormattedDate . " " . $processedFormattedTime; ?></td>
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



