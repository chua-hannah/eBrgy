<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="requests">Manage Requests</a></li>
    <li class="breadcrumb-item"><a href="requests-equipments">Equipments</a></li>
    <li class="breadcrumb-item active" aria-current="page">Manage Equipment</li>
  </ol>
</nav>
</nav>
<div class="container-fluid">
<h3>Manage Equipment</h3>
<div class="col-md-12">
    <form class="custom-form mb-4" action="" method="post">
    <div class="row">
        <div class="col-md-3">
            <label class="labels">Equipment Name</label>
            <input type="text" class="form-control" name="equipment_name" placeholder="ex. Tables, Chairs" required>
        </div>
        <div class="col-md-3">
            <label class="labels">Number of Equipment</label>
            <input type="number" class="form-control" name="number_of_equipment" oninput="validateNumericInput(this)" required>
        </div>
        <div class="col-md-3">
            <label class="labels">Total Number of Equipment</label>
            <input type="number" class="form-control" name="total_equipment" oninput="validateNumericInput(this)" required>
        </div>
        <div class="col-md-3">
            <label class="labels">Availability</label>
            <select class="form-select" name="availability" required>
                <option value="" disabled selected>Choose status</option>
                <option value="1">Available</option>
                <option value="2">Not Available</option>
            </select>
        </div>
        <!-- <textarea name="description" placeholder="Description" required></textarea> -->
        <!-- Add more fields as needed -->
        <div class="col-md-12">
            <button type="submit" class="form-control mt-2" name="add_equipment">Add Equipment</button>
        </div>
    </div>
    </form>
    </div>
    <div>
    <h3>List of Equipments</h3>
        <div>
            <?php
            // Check if there are any records fetched from the database
            if (!empty($requests)) {
            ?>
                <table class="table table-bordered table-striped custom-table datatable">
                    <thead>
                        <tr>
                            <th class="wrap-text">Name</th>
                            <th class="wrap-text">Status</th>
                            <th class="wrap-text">Number to Borrow</th>
                            <th class="wrap-text">Total Number of Equipment</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($requests as $request) {
                        // Display the data for each request
                    ?>
                        <tr>
                            <td><?php echo $request['equipment_name']; ?></td>
                            <td><?php echo $request['availability'] = "1" ? "Available" : "Not Available"; ?></td>
                            <td><?php echo $request['number_of_equipment']; ?></td>
                            <td><?php echo $request['total_equipment']; ?></td>

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