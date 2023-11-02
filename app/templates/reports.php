<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="services">Services</a></li>
    <li class="breadcrumb-item active" aria-current="page">Submit a Complaint or Report</li>
  </ol>
</nav>
<div class="col-lg-6 col-12 mx-auto">
    <form class="custom-form contact-form mb-4" action="#" method="post" role="form">
        <div class="row d-flex justify-content-center">
        <h3 class="mb-4">File a report or a complaint</h3>
            <div class="col-lg-12 col-md-6 col-12">
                <label class="labels">Person to Report (if applicable)</label>
                <input type="text" name="reported_person_name" id="reported_person_name" class="form-control" placeholder="Full name (Optional)">
            </div>  

            <div class="col-lg-12 col-md-6 col-12">
                <label class="labels">Place of Incident</label>
                <input type="text" name="place_of_incident" id="place" class="form-control" placeholder="Location" required>
            </div>

            <div class="col-lg-6 col-md-6 col-12">
                <label class="labels">Date of Incident</label>
                <div class="input-group">
                    <span class="input-group-text">
                        <i class="bi bi-calendar"></i>
                    </span>
                    <input type="text" name="date_of_incident" id="datepicker" class="form-control" placeholder="MM/DD/YYYY" required>
                </div>
            </div>
            
            <div class="col-lg-6 col-md-6 col-12">
                <label class="labels">Time of Incident</label>
                <div class="input-group">
                    <span class="input-group-text">
                    <i class="bi bi-alarm"></i></i>
                    </span>
                    <input type="time" name="time_of_incident" class="form-control" required>
                </div>
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
                        <table class="table table-bordered table-striped custom-table datatable">
                            <thead class="text-center">
                                <tr>
                                    <th class="wrap-text">Subject</th>
                                    <th class="wrap-text">Status</th>
                                    <th class="wrap-text">Request Date & Time</th>
                                    <th class="wrap-text">Processed Date & Time</th>
                                    <th class="wrap-text">Processed By</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($myrequest as $request) { 
                                        $createdAtFormattedDate = date("m/d/Y", strtotime($request['created_at']));
                                        $createdAtFormattedTime = date("h:i A", strtotime($request['created_at']));
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
                                        
                                        $process_by = $request['process_by'];
                                        if ($process_by == "") {
                                            $process_by = "-";
                                        }
                                ?>
                                    <tr>
                                        <td><?php echo $request['subject_person']; ?></td>
                                        <td><?php echo strtoupper($request['status']); ?></td>
                                        <td><?php echo $createdAtFormattedDate . " " . $createdAtFormattedTime; ?></td>
                                        <td><?php echo $processedAtFormattedDate . " " . $processedAtFormattedTime; ?></td>
                                        <td><?php echo $process_by; ?></td>
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



