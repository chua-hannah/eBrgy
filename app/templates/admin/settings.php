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
  

            <a href="http://localhost/eBrgy/app/attendance" style="color: white; text-decoration: none;">
            <button class="btn btn-secondary">
                Back to Attendance
                </button>
            </a>
       
  

</div>
    <!--Additional div for sidebar-->
    </div>
    </div>
</div>