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
                        <form method="post" action="">

                        <button type="submit" name="showLatest">ShowLatest</button>

                        </form>
                    <?php } else { ?>
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Actions</th>
                                    <th>Scheduled by</th>

                                    <th style="min-width: 120px;">Date</th>
                                    <th style="min-width: 120px;">Start at</th>
                                    <th style="min-width: 120px;">End at</th>
                                    <th style="min-width: 120px;">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($schedulesData as $scheduleData) { ?>
                <tr>
                    <td>
                        <?php if ($scheduleData['status'] !== 'approved') { ?>
                            <button class="btn btn-primary" data-toggle="modal" data-target="#approveModal<?php echo $scheduleData['id']; ?>">Approve</button>
                            <button class="btn btn-danger" data-toggle="modal" data-target="#deleteModal<?php echo $scheduleData['id']; ?>">Delete</button>
                        <?php } else { ?>
                            --
                        <?php } ?>
                    </td>
                    <td><?php echo $scheduleData['username']; ?></td>
                    <td><?php echo $scheduleData['schedule_date']; ?></td>
                    <td><?php echo $scheduleData['time_in']; ?></td>
                    <td><?php echo $scheduleData['time_out']; ?></td>
                    <td>
                        <?php
                        echo $scheduleData['status'] === 'approved' ?
                            '<span style="color: green;">' . $scheduleData['status'] . '</span>' :
                            '<span style="color: #ffae00;">' . $scheduleData['status'] . '</span>';
                        ?>
                    </td>
                </tr>

                <!-- Approve Modal -->
                <div class="modal fade" id="approveModal<?php echo $scheduleData['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="approveModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="approveModalLabel">Are you sure to approve this schedule?</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                <?php echo $scheduleData['status'] === 'approved' ? 
                                    '' : 
                                    '<form method="post" action="">
                                        <input type="hidden" name="schedule_id" value="' . $scheduleData['id'] . '">
                                        <input type="hidden" name="username" value="' . $scheduleData['username'] . '">
                                        <button name="approve_schedule" type="submit" class="btn btn-primary" style="padding: 8px;">
                                        Approve
                                        </button>
                                    </form>';
                                ?>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Delete Modal -->
                <div class="modal fade" id="deleteModal<?php echo $scheduleData['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="deleteModalLabel">Are you sure to delete this schedule?</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                <button type="button" class="btn btn-danger">Confirm</button>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>

                </tbody>
            </table>
            <form method="post" action="">

<button type="submit" name="showLatest">ShowLatest</button>

</form>
        <?php } ?>
    <?php } else { ?>
        
        <div class="table-responsive text-center">
                <?php if (is_array($latestSchedulesData) || is_object($latestSchedulesData)) { ?>
                    <?php if (count($latestSchedulesData) === 0) { ?>
                        <div class="text-center">No Latest Schedules Found</div>
                    <?php } else { ?>
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Scheduled by</th>
                                    <th style="min-width: 120px;">Date</th>
                                    <th style="min-width: 120px;">Start at</th>
                                    <th style="min-width: 120px;">End at</th>
                                    <th style="min-width: 120px;">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($latestSchedulesData as $latestScheduleData) { ?>
                <tr>
                    <td><?php echo $latestScheduleData['username']; ?></td>
                    <td><?php echo $latestScheduleData['schedule_date']; ?></td>
                    <td><?php echo $latestScheduleData['time_in']; ?></td>
                    <td><?php echo $latestScheduleData['time_out']; ?></td>
                    <td>
                        <?php
                        echo $latestScheduleData['status'] === 'approved' ?
                            '<span style="color: green;">' . $latestScheduleData['status'] . '</span>' :
                            '<span style="color: #ffae00;">' . $latestScheduleData['status'] . '</span>';
                        ?>
                    </td>
                </tr>
            <?php } ?>

                </tbody>
            </table>
        <?php }}  ?>
   
</div>    <?php } ?>

</div>
</div>
    <!--Additional div for sidebar-->
    </div>
    </div>
</div>