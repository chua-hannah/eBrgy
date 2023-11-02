<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="requests">Manage Requests</a></li>
    <li class="breadcrumb-item active" aria-current="page">Schedules</li>
  </ol>
</nav>
<div class="container-fluid">
    <h3>Schedules</h3>
    
    <form class="custom-form" method="post" action="">
        <div class="row d-flex justify-content-center">
        <div class="col-md-5">
            <label class="labels">Enter a date:</label>
            <div class="input-group">
                <span class="input-group-text">
                    <i class="bi bi-calendar"></i> <!-- Bootstrap Icons calendar icon -->
                </span>
                <input type="text" name="reserved_schedule" id="datepicker-regular" class="form-control" value="<?php if (!empty($_POST["reserved_schedule"])) { echo $_POST["reserved_schedule"]; } 
                else { date_default_timezone_set(date_default_timezone_get()); $current_time = time(); echo date('m/d/Y', $current_time); }; ?>">
            </div>
        </div>
        <div class="col-md-5 align-self-end">
            <button class="form-control" type="submit" name="showData">Show Schedules</button>
        </div>
        </div>
    </form>
                <div class="table-responsive text-center">
                <?php if (is_array($schedulesData) || is_object($schedulesData)) { ?>
                    <?php if (count($schedulesData) === 0) { ?>
                        <div class="text-center">No schedule/s available for the selected date. </div>
                        <form method="post" action="">

                        <button type="submit" name="showLatest">Show Latest</button>

                        </form>
                    <?php } else { ?>
                        <table class="table table-bordered table-striped custom-table datatable">
                            <thead>
                                <tr>                          
                                    <th class="wrap-text">Scheduled by</th>
                                    <th class="wrap-text">Date</th>
                                    <th class="wrap-text">Start at</th>
                                    <th class="wrap-text">End at</th>
                                    <th class="wrap-text">Status</th>
                                    <th class="wrap-text">Action/s</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($schedulesData as $scheduleData) { ?>
                <tr>
                    <td><?php echo $scheduleData['username']; ?></td>
                    <td><?php echo $scheduleData['schedule_date']; ?></td>
                    <td><?php echo $scheduleData['time_in']; ?></td>
                    <td><?php echo $scheduleData['time_out']; ?></td>
                    <td>
                    <?php
                    $status = strtoupper($scheduleData['status']);
                    
                    if ($status === 'APPROVED') {
                        echo '<span class="text-success">' . $status . '</span>';
                    } elseif ($status === 'PENDING') {
                        echo '<span class="text-warning">' . $status . '</span>';
                    } elseif ($status === 'REJECTED') {
                        echo '<span class="text-danger">' . $status . '</span>';
                    }
                    ?>
                    </td>
                    <td>
                        <?php if ($scheduleData['status'] === 'pending') { ?>
                            <button class="btn btn-primary" data-toggle="modal" data-target="#approveModal<?php echo $scheduleData['id']; ?>">Approve</button>
                            <button class="btn btn-danger" data-toggle="modal" data-target="#deleteModal<?php echo $scheduleData['id']; ?>">Reject</button>
                        <?php } else { ?>
                            N/A
                        <?php } ?>
                    </td>
                </tr>

                <!-- Approve Modal -->
                <div class="modal fade" id="approveModal<?php echo $scheduleData['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="approveModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="approveModalLabel">Are you sure to approve this schedule?</h5>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                <?php echo $scheduleData['status'] === 'approved' ? 
                                    '' : 
                                    '<form method="post" action="">
                                        <input type="hidden" name="schedule_id" value="' . $scheduleData['id'] . '">
                                        <input type="hidden" name="username" value="' . $scheduleData['username'] . '">
                                        <button name="approve_schedule" type="submit" class="btn btn-primary">
                                        Confirm
                                        </button>
                                    </form>';
                                ?>
                            </div>
                        </div>
                    </div>
                </div>


                <!-- Delete Modal -->
                <div class="modal fade" id="deleteModal<?php echo $scheduleData['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document" style="position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%);">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="deleteModalLabel">Are you sure to reject this schedule?</h5>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                <?php echo $scheduleData['status'] === 'approved' ? 
                                    '' : 
                                    '<form method="post" action="">
                                        <input type="hidden" name="schedule_id" value="' . $scheduleData['id'] . '">
                                        <input type="hidden" name="username" value="' . $scheduleData['username'] . '">
                                        <button name="reject_schedule" type="submit" class="btn btn-danger">
                                        Confirm
                                        </button>
                                    </form>';
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>

                </tbody>
            </table>
            <form class="custom-form" method="post" action="">
                <button type="submit" class="form-control" name="showLatest">Show Latest Schedule</button>
            </form>
        <?php } ?>
    <?php } else { ?>
        <h6>List of Latest Schedule</h6>
        <div class="table-responsive">
                <?php if (is_array($latestSchedulesData) || is_object($latestSchedulesData)) { ?>
                    <?php if (count($latestSchedulesData) === 0) { ?>
                        <div class="text-center">No latest schedules are available</div>
                    <?php } else { ?>
                        <table class="table table-bordered table-striped custom-table datatable">
                            <thead>
                                <tr>
                                    <th class="wrap-text">Scheduled Date</th>
                                    <th class="wrap-text">First Name</th>
                                    <th class="wrap-text">Middle Name</th>
                                    <th class="wrap-text">Last Name</th>
                                    <th class="wrap-text">Mobile Number</th>
                                    <th class="wrap-text">Start at</th>
                                    <th class="wrap-text">End at</th>
                                    <th class="wrap-text">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($latestSchedulesData as $latestScheduleData) { ?>
                <tr>
                    <td><?php echo date('m/d/Y', strtotime($latestScheduleData['schedule_date'])); ?></td>
                    <td><?php echo $latestScheduleData['firstname'] ; ?></td>
                    <td><?php echo $latestScheduleData['middlename'] ; ?></td>
                    <td><?php echo $latestScheduleData['lastname'] ; ?></td>
                    <td><?php echo $latestScheduleData['mobile'] ; ?></td>
                    <td><?php echo date('h:i a', strtotime($latestScheduleData['time_in'])); ?></td>
                    <td><?php echo date('h:i a', strtotime($latestScheduleData['time_out'])); ?></td>
                    <td>
                        <?php
                        $status = strtoupper( $latestScheduleData['status'] );
                        echo $latestScheduleData['status'] === 'approved' ?
                            '<span class="text-success">' . $status . '</span>' :
                            '<span class="text-warning">' . $status. '</span>';
                        ?>
                    </td>
                </tr>
            <?php } ?>

                </tbody>
            </table>
        <?php } 
            }  ?>
   
</div>    <?php } ?>

</div>
</div>
    <!--Additional div for sidebar-->
    </div>
    </div>
</div>