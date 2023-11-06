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
            <select class="form-select" name="selected_service" id="selected_service" required>
                <option value="" disabled selected>Select a document</option>
                <?php
                    foreach ($requests as $request) {
                        // Display the data for each request
                        ?>
                        <option value="<?php echo $request['request_name']; ?>"><?php echo strtoupper($request['request_name']); ?></option>
                        <?php
                    }
                ?>

            </select>
        </div>
        <div class="col-lg-12 col-md-6 col-12">
            <label class="labels" id="remarks_label">Remarks</label>
            <div id="remarks_field">
                <textarea name="service_message" rows="3" class="form-control mb-4" id="service_message" placeholder="Details" required></textarea>
            </div>
        </div>
        <div class="col-lg-12 col-md-6 col-12" id="purpose_field" style="display: none;">
            <label class="labels" id="purpose_label">Remarks</label>
            <input type="text" name="purpose" rows="3" class="form-control mb-4" id="purpose_input">
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
                                    <th>Purpose / Remarks</th>
                                    <th>Additional Details</th>
                                    <th>Request Date & Time</th>
                                    <th>Processed Date & Time</th>
                                    <th>Status</th>
                                    <th>Action/s</th>

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
                                        <td><?php echo strtoupper($request['request_name']); ?></td>
                                        <td><?php echo !empty($request['message']) ? $request['message'] : '-'; ?></td>
                                        <td><?php echo !empty($request['purpose']) ? $request['purpose'] : '-'; ?></td>
                                        <td><?php echo $createdAtDateFormattedDate . " " . $createdAtTimeFormattedTime; ?></td>
                                        <td><?php echo $processedAtFormattedDate . " " . $processedAtFormattedTime; ?></td>
                                        <td>
                                            <?php
                                            $status = strtoupper($request['status']);
                                            
                                            if ($status === 'PENDING') {
                                                echo '<span class="text-warning">' . $status . '</span>';
                                            } elseif ($status === 'APPROVED') {
                                                echo '<span class="text-success">' . $status . '</span>';
                                            } elseif ($status === 'REJECTED') {
                                                echo '<span class="text-danger">' . $status . '</span>';
                                            } else {
                                                // Handle other statuses here if needed
                                                echo $status; // Display the status as is
                                            }
                                            ?>
                                        </td>
                                        <td>
                                        <?php
                                            $status = strtoupper($request['status']);
                                            if ($status == 'APPROVED') {
                                                // If the status is 'APPROVED', change the button to a form and include an invisible input for the id.
                                                $action = ''; // Initialize the action variable
                                            
                                                if ($request['request_name'] === 'barangay certification (first time jobseekers assistance act - ra 11261)') {
                                                    $action = 'first-job-certificate';
                                                } 
                                                elseif ($request['request_name'] === 'certificate of indigency') {
                                                    $action = 'indigency-certificate';
                                                }
                                                elseif ($request['request_name'] === 'barangay certificate') {
                                                    $action = 'barangay-certificate';
                                                }
                                                elseif ($request['request_name'] === 'oath of undertaking') {
                                                    $action = 'oath-certificate';
                                                }
                                            
                                                if (!empty($action)) {
                                                    echo '<form method="POST" action="' . $action . '" target="_blank">
                                                            <input type="hidden" name="id" value="' . $request['id'] . '">
                                                            <button type="submit" class="btn btn-primary" name="print_request_doc">Print</button>
                                                        </form>';
                                                }
                                            } elseif ($status == 'PENDING') {
                                                // If the status is 'PENDING', add a button to cancel with a form and an invisible input to pass the $request['id'].
                                                echo '<form method="POST" action="">
                                                        <input type="hidden" name="id" value="' . $request['id'] . '">
                                                        <button type="submit" class="btn btn-danger" name="cancel_request_doc">Cancel</button>
                                                    </form>';
                                            } else {
                                                // If the status is 'REJECTED', echo 'N/A'.
                                                echo 'N/A';
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




<script>
  // Get references to the document type and remarks field
const selectedService = document.getElementById('selected_service');
const serviceMessage = document.getElementById('service_message');
const remarksLabel = document.getElementById('remarks_label');
const remarksField = document.getElementById('remarks_field');
const purposeField = document.getElementById('purpose_field');
const purposeInput = document.getElementById('purpose_input');

// Define the options for the "Barangay Certificate" document
const barangayCertificateOptions = [
    "Requirement for Employment",
    "Medical Purpose",
    "School Requirement",
    "Vending Permit",
    "Hospital Purposes",
    "Bank Requirements",
    "SSS/GSIS Requirement",
    "Transfer of Resident",
    "Calamity / Livelihood Loan",
    "ID for",
    "Others"
];

const allowedValues = ["Medical Purpose", "School Requirement", "Vending Permit", "Bank Requirements", "ID for", "Others"];

// Add an event listener to the document type selection
selectedService.addEventListener('change', function() {
    if (selectedService.value.toLowerCase() === "barangay certificate") {
        // If "Barangay Certificate" is selected, change the field to an option select input
        remarksLabel.innerText = "Purpose";
        remarksField.innerHTML = '<select name="service_message" class="form-select" required>' +
            '<option value="" disabled selected>Select Purpose</option>' +
            barangayCertificateOptions.map(option => `<option value="${option}">${option}</option>`).join('') +
            '</select>';
    }
    else if (selectedService.value.toLowerCase() === "certificate of indigency") {
        // If "Barangay Certificate" is selected, change the field to an option select input
        remarksLabel.innerText = "Purpose";
        remarksField.innerHTML = '<textarea name="service_message" rows="3" class="form-control mb-4" id="service_message" placeholder="Ex. Financial Assistance" required></textarea>';
    }
     else {
        // If a different document type is selected, revert to the text area
        remarksLabel.innerText = "Remarks";
        remarksField.innerHTML = '<textarea name="service_message" rows="3" class="form-control mb-4" id="service_message" placeholder="Details"></textarea>';
    }
});

// Add an event listener to the "service_message" select to check if one of the allowed values is selected
document.addEventListener('change', function(e) {
    if (e.target.name === "service_message") {
        const selectedValue = e.target.value;
        // Check if the selected value is in the allowed values array
        if (allowedValues.includes(selectedValue)) {
            // Show the "Purpose" field
            purposeField.style.display = 'block';

            // Dynamically change the placeholder for the "Purpose" field
            if (selectedValue === "School Requirement") {
                purposeInput.placeholder = "Ex. Admission";
            } else if (selectedValue === "ID for") {
                purposeInput.placeholder = "Ex. Senior ID Replacement";
            }
            else if (selectedValue === "Others") {
                purposeInput.placeholder = "Ex. Legal Purposes";
            }
            else {
                // Reset the placeholder for other cases
                purposeInput.placeholder = "Details";
            }
        } else {
            // Hide the "Purpose" field and reset the placeholder
            purposeField.style.display = 'none';
            purposeInput.placeholder = "";
        }
    }
});
selectedService.addEventListener("change", function() {
    purposeField.style.display = 'none';
    purposeInput.placeholder = "";
});
</script>
