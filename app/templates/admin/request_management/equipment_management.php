<div>Add Equipment </div>
    <div>
    <form action="" method="post">
        <input type="text" name="equipment_name" placeholder="Equipment Name" required>
        <input type="text" name="number_of_equipment" placeholder="Number of Equipment" required>
        <input type="text" name="total_equipment" placeholder="Total Number of Equipment" required>

        <select name="availability" required>
            <option value="">Choose status</option>
            <option value="1">Available</option>
            <option value="2">Not Available</option>
        </select>
        <!-- <textarea name="description" placeholder="Description" required></textarea> -->
        <!-- Add more fields as needed -->
        <button type="submit" name="add_equipment">Submit</button>
    </form>
    </div>

    <div>
         List of Equipments
        <div>
            <?php
            // Check if there are any records fetched from the database
            if (!empty($requests)) {
            ?>
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Status</th>
                            <th>Number to Borrow</th>
                            <th>Total Number of Equipment</th>
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
        <button class="btn btn-secondary">
        <a href="http://localhost/eBrgy/app/requests/equipments" style="color: white; text-decoration: none;">
            Back to Equipment Requests
        </a>
    </button>
        </div>

            <!--Additional div for sidebar-->
    </div>
    </div>
</div>