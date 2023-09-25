<h2 class="text-center mt-4 mb-4">Document Request Form</h2>
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
        </div>
    </form>
    <!-- templates/services.php -->
    <div class="table-responsive">
    <h3 class="mb-4">Request List</h3>
        <table class="table table-bordered table-striped custom-table">
            <thead class="text-center">
                <tr>
                    <th>Document Type</th>
                    <th>Status</th>
                    <th>Request Date</th>
                </tr>
            </thead>
            <tbody>
            <?php
                foreach ($myrequest as $request) {
            ?>
            <tr>
                <td><?php echo $request['request_name']; ?></td>
                <td><?php echo $request['status']; ?></td>
                <td><?php echo $request['created_at']; ?></td>
            </tr>
            <?php
                }
            ?>
            </tbody>
        </table>
    </div>
</div>



  