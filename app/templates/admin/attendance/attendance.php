<form method="POST" action="">
    <?php if ($_SESSION['isCheckIn'] && $_SESSION['isCheckOut']): ?>
        <button type="button" class="btn btn-secondary" disabled>Checked-in and Checked-out</button>
       
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