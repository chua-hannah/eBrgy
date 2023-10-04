<h2 class="text-center mt-4 mb-4">Equipment Request Form</h2>
<div class="col-lg-6 col-12 mx-auto">
    <form class="custom-form contact-form mb-4" action="#" method="post" role="form">
        <div class="row d-flex justify-content-center">
        <h3 class="mb-4">Borrow an equipment</h3>
            <div class="col-lg-12 col-md-6 col-12">
                <label class="labels">Type of Equipment</label>
                <select class="form-select" name="equipment_id" required>
                    <option value="" disabled selected>Select Equipment</option>
                    <?php
                        foreach ($requests as $request) {
                        // Display the data for each request
                    ?>
                        <option value="<?php echo $request['equipment_id']; ?>"><?php echo $request['equipment_name']; ?></option>    
                    <?php
                    }
                    ?>
                </select>
            </div>  
            <div class="col-lg-12 col-md-6 col-12">
                <label class="labels">Quantity</label>
                <input type="text" name="total_equipment_borrowed" id="total_equipment_borrowed" class="form-control mb-4" oninput="validateNumericInput(this)" required>
            </div>
        </div>
        <div class="d-grid gap-2 col-12 mx-auto">
            <button type="submit" name="request_equipment" class="form-control">Submit Request</button>
        </div>
    </form>
</div>