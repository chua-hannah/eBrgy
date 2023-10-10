<div class="col-md-12 mt-4 mb-4">
    <h3 class="mt-4">Set Office Time</h3>
    <?php
    // Check if there are any records fetched from the database
    if (!empty($office_time)) {
    ?>
        <table class="table table-bordered table-striped custom-table">
            <thead>
                <tr>
                    <th>Time in</th>
                    <th>Time out</th>
                    <th>Late Threshold</th>
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
    <h3 class="mt-4">Manage Office Time</h3>
    <form class="custom-form" action="" method="post">
    <div class="row">
        <!-- Input for Set Time In -->
        <div class="col-md-4">
            <label class="labels">Set Time In</label>
            <input type="time" class="form-control" name="start" placeholder="Set Working Hours Start" 
                value="<?php if (!empty($time['work_hours_start'])) { echo $time['work_hours_start']; } else { echo ''; };?>" required>
        </div>
        
        <!-- Input for Set Time Out -->
        <div class="col-md-4">
            <label class="labels">Set Time Out</label>
            <input type="time" class="form-control" name="end" placeholder="Set Working Hours End" 
                value="<?php if (!empty($time['work_hours_end'])) { echo $time['work_hours_end']; } else { echo ''; };?>" required>
        </div>
        
        <!-- Input for Set Late Threshold -->
        <div class="col-md-4">
            <label class="labels">Set Late Threshold</label>
            <input type="time" class="form-control" name="late" placeholder="Set Late Threshold" 
                value="<?php if (!empty($time['late_threshold'])) { echo $time['late_threshold']; } else { echo ''; };?>" required>
        </div>
        
        <!-- Back Button to Attendance Page -->
        <div class="col-md-6">
            <button type="button" class="form-control back-button" onclick="goBackToAttendance()">Back to Attendance</button>
        </div>
        
        <!-- Submit Button for Updating Settings -->
        <div class="col-md-6">
            <button type="submit" class="form-control" name="settings">Update</button>
        </div>
    </div>
</form>
<script>
    function goBackToAttendance() {
        window.location.href = "http://localhost/eBrgy/app/attendance"; // Redirect to the Attendance page
    }
</script>
</div>


    </div>
        </div>
        
    <!--Additional div for sidebar-->
    </div>
    </div>
</div>