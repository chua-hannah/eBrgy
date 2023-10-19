<h2 class="text-center mt-2 mb-2">Equipment Request Form</h2>
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
        </div>
    </div>
    <div class="d-grid gap-2 col-12 mx-auto">
        <button type="submit" name="request_equipment" class="form-control">Submit Request</button>
        <a href="#equipmentRequestListModal" class="text-center mb-0" data-bs-toggle="modal" data-bs-target="#equipmentRequestListModal">
            View Submitted Requests
        </a>
    </div>
</form>
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
