<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="services">Services</a></li>
    <li class="breadcrumb-item active" aria-current="page">Borrow an Equipment</li>
  </ol>
</nav>
<div class="col-lg-6 col-12 mx-auto">
<form class="custom-form contact-form mb-4" action="#" method="post" role="form">
    <div class="row d-flex justify-content-center">
        <h3 class="mb-4">Borrow an equipment</h3>
        <div class="col-lg-12 col-md-6 col-12">
            <label class="labels">Type of Equipment</label>
            <select class="form-select" name="equipment_id" id="equipment_id" required>
                <option value="" disabled selected>Select Equipment</option>
                <?php
                foreach ($requests as $request) {
                // Display the data for each request
                ?>
                <option value="<?php echo $request['equipment_id']; ?>" data-max-quantity="<?php echo $request['total_equipment']; ?>"><?php echo $request['equipment_name']; ?></option>
                <?php
                }
                ?>
            </select>
        </div>
        <div class="col-lg-12 col-md-6 col-12">
            <label class="labels">Quantity <span id="available-quantity"></span></label>
            <input type="text" name="total_equipment_borrowed" id="total_equipment_borrowed" class="form-control mb-4" oninput="validateNumericInput(this)" required>
        </div>
        <div class="col-lg-12 col-md-6 col-12">
            <label class="labels">Duration(days)</label>
            <input type="text" name="duration" id="duration" class="form-control mb-4" oninput="validateNumericInput(this)" required>
        <div class="d-grid gap-2 col-12 mx-auto">
            <button type="submit" name="request_equipment" class="form-control">Submit Request</button>
            <a href="#equipmentRequestListModal" class="text-center mb-0" data-bs-toggle="modal" data-bs-target="#equipmentRequestListModal">
                View Submitted Requests
            </a>
        </div>
    </form>
</div>

<!-- Modal -->
<div class="modal fade" id="equipmentRequestListModal" tabindex="-1" aria-labelledby="equipmentRequestListModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h5 class="modal-title">Equipment Request</h5>
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
                                    <th class="wrap-text">Equipment</th>
                                    <th class="wrap-text">Quantity</th>
                                    <th class="wrap-text">Duration <br> (Days)</th>
                                    <th class="wrap-text">Request Date & Time</th>
                                    <th class="wrap-text">Status</th>
                                    <th class="wrap-text">Remarks</th>
                                   
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($myrequest as $request) { 
                                        $requestDate = date("m/d/Y", strtotime($request['request_date']));
                                        $requestTime = date("h:i A", strtotime($request['request_date']));
                                      
                                ?>
                                    <tr>
                                        <td><?php echo $request['equipment_name']; ?></td>
                                        <td><?php echo $request['total_equipment_borrowed']; ?></td>
                                        <td><?php echo $request['days']; ?></td>
                                        <td><?php echo $requestDate . " " . $requestTime; ?></td>
                                        <td><?php echo strtoupper($request['status']); ?></td>
                                        <td><?php echo $request['message']; ?></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                <?php } ?>
            </div>
        </div>
</div>
<script>
document.addEventListener("DOMContentLoaded", function() {
    // Get references to the equipment select and quantity input elements
    var equipmentSelect = document.getElementById("equipment_id");
    var quantityInput = document.getElementById("total_equipment_borrowed");
    var availableQuantitySpan = document.getElementById("available-quantity");
    
    // Add an event listener to the equipment select element
    equipmentSelect.addEventListener("change", function() {
        // Get the selected option
        var selectedOption = equipmentSelect.options[equipmentSelect.selectedIndex];
        
        // Get the available quantity from the "data-max-quantity" attribute
        var maxQuantity = selectedOption.getAttribute("data-max-quantity");
        
        // Update the content of the availableQuantitySpan
        availableQuantitySpan.textContent = " (Available: " + maxQuantity + ")";
    });
});
</script>
