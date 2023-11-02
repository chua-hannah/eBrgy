    <div class="container-fluid">
        <div style="float:right;">
        <a href="http://localhost/eBrgy/app/settings" style="color: white; text-decoration: none;" <?php if(!($_SESSION['role']=="captain")) { echo "hidden"; } ?>>
            <button class="form-control custom-button">
            <i class="bi bi-clock"></i>
                Manage Office Time
            </button>
        </a>
        </div>
        <div>
            <h3>Office Time</h3>
            <?php 
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
                            <tr>
                                <?php 
                                $startFormattedTime = date("h:i A", strtotime($office_time['work_hours_start']));
                                $endFormattedTime = date("h:i A", strtotime($office_time['work_hours_end']));
                                $lateThresholdFormattedTime = date("h:i A", strtotime($office_time['late_threshold']));
                                ?>
                                <td><?php echo $startFormattedTime; ?></td>
                                <td><?php echo $endFormattedTime; ?></td>
                                <td><?php echo $lateThresholdFormattedTime; ?></td>
                            </tr>
                        </tbody>
                    </table>
                <?php
                } else { ?>
                    <p class="text-center">No data available</p>
            <?php } ?>
        </div>
    <!-- Display the user's attendance data below the buttons -->
    <div class="mt-4">
        <h3>My Attendance</h3>
        <?php if (!empty($my_attendance)): ?>
            <table class="table table-bordered table-striped custom-table" id="attendanceTable">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Time In</th>
                        <th>Time Out</th>
                        <th>Status</th>
                        <th>Remarks</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($my_attendance as $attendance): 
                        $attendanceFormattedDate = date("m/d/Y", strtotime($attendance['date']));
                        $timeInFormattedTime = date("h:i A", strtotime($attendance['time_in']));
                        $timeOutFormattedTime = date("h:i A", strtotime($attendance['time_out']));
                        if ($attendance['time_out'] == null){
                            $timeOutFormattedTime = "-";
                        }
                    ?>
                        <tr>
                            <td><?php echo $attendanceFormattedDate; ?></td>
                            <td><?php echo $timeInFormattedTime; ?></td>
                            <td><?php echo $timeOutFormattedTime; ?></td>
                            <td><?php echo $attendance['status']; ?></td>
                            <td><?php echo $attendance['remark']; ?></td>
                        </tr>
                    <?php endforeach; ?>

                </tbody>
            </table>
        <?php else: ?>
            <div class="text-center"><h6>No data available</h6></div>
        <?php endif; ?>
    </div>
    <?php  
            date_default_timezone_set('Asia/Manila');

            // Get the current time in Philippine Time as a timestamp
            $current_time_timestamp = time();

            // Convert the 'work_hours_end' string to a timestamp
            $work_hours_start_timestamp = strtotime(date('Y-m-d') . ' ' . $office_time['work_hours_start']);
            $work_hours_end_timestamp = strtotime(date('Y-m-d') . ' ' . $office_time['work_hours_end']);
        ?>
        <form method="POST" class="custom-form" action="">
            <?php if (
            ($_SESSION['isCheckIn'] && $_SESSION['isCheckOut']) ||
        ( $current_time_timestamp > $work_hours_end_timestamp &&
            $current_time_timestamp < strtotime(date('Y-m-d') . ' 23:59:59')) || ( $current_time_timestamp < $work_hours_start_timestamp &&
            $current_time_timestamp > strtotime(date('Y-m-d') . ' 00:00:01'))): ?>
            <button type="button" class="form-control" disabled>Time In / Out</button>
            
            <?php elseif (!$_SESSION['isCheckIn']): ?>
                <button type="submit" name="check_in" class="form-control">Time In</button>
            <?php elseif ($_SESSION['isCheckIn'] && !$_SESSION['isCheckOut']): ?>
                <button type="submit" name="check_out" class="form-control">Time Out</button>
            <?php endif; ?>
        </form>
    </div>  
<script>
$(document).ready(function () {
    $('#attendanceTable').DataTable({
        order: [[0, 'desc']], // Sort the first column (index 0) in descending order
        paging: true, // Enable pagination
        pageLength: 5, // Number of rows per page
        lengthMenu: [10, 25, 50, 100], // Dropdown for rows per page
        responsive: true // Enable responsive behavior
    });
});
</script>
  <!--Additional div for sidebar-->
    </div>
    </div>
</div>