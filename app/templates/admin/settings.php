<div>
   
    <div style="margin: 16px">Settings</div>
    <div>Set Work Hours</div>
    <div>
        <form action="" method="post">
        <input type="time" name="start" placeholder="Set Working Hours Start" required>
        <input type="time" name="end" placeholder="Set Working Hours End" required>
        <input type="time" name="late" placeholder="Set Late Threshold" required>
        <!-- Add more fields as needed -->
        <button type="submit" name="settings">Update</button>
        </form>
    </div>

    <div>
         Office Time
        <div>
            <?php
            // Check if there are any records fetched from the database
            if (!empty($office_time)) {
            ?>
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Time in</th>
                            <th>Time out</th>
                            <th>Late Thereshold</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($office_time as $time) {
                        // Display the data for each request
                    ?>
                        <tr>
                            <td><?php echo $time['work_hours_start']; ?></td>
                            <td><?php echo $time['work_hours_end']; ?></td>
                            <td><?php echo $time['late_threshold']  ?></td>
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
  

    <div>Manage Requests </div>
    <div>
    <form action="" method="post">
        <input type="text" name="request_name" placeholder="Request Type Name" required>
        <select name="status" required>
            <option value="">Choose status</option>
            <option value="1">Available</option>
            <option value="2">Not Available</option>
        </select>
        <textarea name="description" placeholder="Description" required></textarea>
        <!-- Add more fields as needed -->
        <button type="submit" name="add_request">Submit</button>
    </form>
    </div>

    <div>
         Requests
        <div>
            <?php
            // Check if there are any records fetched from the database
            if (!empty($requests)) {
            ?>
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($requests as $request) {
                        // Display the data for each request
                    ?>
                        <tr>
                            <td><?php echo $request['request_name']; ?></td>
                            <td><?php echo $request['description']; ?></td>
                            <td><?php echo $request['status'] = "1" ? "Available" : "Not Available"; ?></td>
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

</div>
    <!--Additional div for sidebar-->
    </div>
    </div>
</div>