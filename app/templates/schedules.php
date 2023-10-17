<div class="text-center mt-4" >
<h1>Schedules</h1>
    Check Schedules
    <form method="post" action="">
    <label for="date">Select a Date:</label>
    <input type="date" id="reserved_schedule" name="reserved_schedule" required>
    <button type="submit" name="showData">Show Data</button>
    </form>

  
    <div class="table-responsive text-center">
    <?php if (is_array($schedulesData) || is_object($schedulesData)) { ?>
        <?php if (count($schedulesData) === 0) { ?>
            <div class="text-center">No schedules for this date</div>
        <?php } else { ?>
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Scheduled by</th>
                        <th style="min-width: 120px;">Date</th>
                        <th style="min-width: 120px;">Start at</th>
                        <th style="min-width: 120px;">End at</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($schedulesData as $scheduleData) { ?>
                        <tr>
                            <td><?php echo $scheduleData['username']; ?></td>
                            <td><?php echo $scheduleData['schedule_date']; ?></td>
                            <td><?php echo $scheduleData['time_in']; ?></td>
                            <td><?php echo $scheduleData['time_out']; ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        <?php } ?>
    <?php } else { ?>
        <div class="text-center">Select Date to check List of Schedules</div>
    <?php } ?>
</div>

        <a href="http://localhost/eBrgy/app/schedule-request" style="color: white; text-decoration: none;">
            <button class="btn btn-primary">
                Request Schedule
            </button>
        </a>
  

  
</div>