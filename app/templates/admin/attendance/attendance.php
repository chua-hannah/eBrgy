    <div>
         Office Time
        <div>
            <?php
           
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
                   
                        <tr>
                            <td><?php echo $office_time['work_hours_start']; ?></td>
                            <td><?php echo $office_time['work_hours_end']; ?></td>
                            <td><?php echo $office_time['late_threshold'];  ?></td>
                        </tr>
                  
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
<?php  
date_default_timezone_set('Asia/Manila');

// Get the current time in Philippine Time as a timestamp
$current_time_timestamp = time();

// Convert the 'work_hours_end' string to a timestamp
$work_hours_start_timestamp = strtotime(date('Y-m-d') . ' ' . $office_time['work_hours_start']);
$work_hours_end_timestamp = strtotime(date('Y-m-d') . ' ' . $office_time['work_hours_end']);

 ?>
<form method="POST" action="">
    <?php if (
    ($_SESSION['isCheckIn'] && $_SESSION['isCheckOut']) ||
   ( $current_time_timestamp > $work_hours_end_timestamp &&
    $current_time_timestamp < strtotime(date('Y-m-d') . ' 23:59:59')) || ( $current_time_timestamp < $work_hours_start_timestamp &&
    $current_time_timestamp > strtotime(date('Y-m-d') . ' 00:00:01'))): ?>
        <button type="button" class="btn btn-secondary" disabled>Check in/out</button>
       
    <?php elseif (!$_SESSION['isCheckIn']): ?>
        <button type="submit" name="check_in" class="btn btn-primary">Check-in</button>
    <?php elseif ($_SESSION['isCheckIn'] && !$_SESSION['isCheckOut']): ?>
        <button type="submit" name="check_out" class="btn btn-danger">Check-out</button>
    <?php endif; ?>
</form>




<!-- Display the user's attendance data below the buttons -->
<div class="attendance-data">
    <h2>My Attendance</h2>
    <table class="table table-bordered table-striped">
        <thead class="thead-dark">
            <tr>
                <th>Date</th>
                <th>Time In</th>
                <th>Time Out</th>
                <th>Status</th>
                <th>Remarks</th>
            </tr>
        </thead>
        <tbody>
        <?php if (!empty($my_attendance)): ?>
            <?php foreach ($my_attendance as $attendance): ?>
                <tr>
                    <td><?php echo $attendance['date']; ?></td>
                    <td><?php echo $attendance['time_in']; ?></td>
                    <td><?php echo $attendance['time_out']; ?></td>
                    <td><?php echo $attendance['status']; ?></td>
                    <td><?php echo $attendance['remark']; ?></td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="5">No data available</td>
            </tr>
        <?php endif; ?>

        </tbody>
    </table>
</div>




    <!--Additional div for sidebar-->
    </div>
    </div>
</div>