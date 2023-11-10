<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="attendance">Attendance</a></li>
        <li class="breadcrumb-item active" aria-current="page">Manage Office Time</li>
    </ol>
</nav>
<div class="container-fluid">
    <h3>Current Office Time</h3>
    <?php
    // Check if there are any records fetched from the database
    if (!empty($office_time)) {
    ?>
    <div class="col-md-12">
        <table class="table table-bordered table-striped custom-table">
            <thead>
                <tr>
                    <th class="wrap-text">Time in</th>
                    <th class="wrap-text">Time out</th>
                    <th class="wrap-text">Late Threshold</th>
                </tr>
            </thead>
            <tbody>
            <?php
            foreach ($office_time as $time) {
                // Display the data for each request
            ?>
                <tr>
                    <td><?php echo date('h:i A', strtotime($time['work_hours_start'])); ?></td>
                    <td><?php echo date('h:i A', strtotime($time['work_hours_end'])); ?></td>
                    <td><?php echo date('h:i A', strtotime($time['late_threshold'])); ?></td>
                </tr>
            <?php
            }
            ?>
            </tbody>
        </table>
    </div>
    <?php
    } else {
        // Display a message if no records are found
        echo "No Data Available.";
    }
    ?>
    <div class="col-md-12">
        <h3 class="mt-4">Manage Office Time</h3>
        <form class="custom-form" action="" method="post">
            <div class="row">
            <!-- Input for Set Time In -->
                <div class="col-md-3">
                    <label class="labels">Set Time In</label>
                    <input type="time" class="form-control" name="start" placeholder="Set Working Hours Start" 
                        value="<?php if (!empty($time['work_hours_start'])) { echo $time['work_hours_start']; } else { echo ''; };?>" required>
                </div>
                
                <!-- Input for Set Time Out -->
                <div class="col-md-3">
                    <label class="labels">Set Time Out</label>
                    <input type="time" class="form-control" name="end" placeholder="Set Working Hours End" 
                        value="<?php if (!empty($time['work_hours_end'])) { echo $time['work_hours_end']; } else { echo ''; };?>" required>
                </div>
                
                <!-- Input for Set Late Threshold -->
                <div class="col-md-3">
                    <label class="labels">Set Late Threshold</label>
                    <input type="time" class="form-control" name="late" placeholder="Set Late Threshold" 
                        value="<?php if (!empty($time['late_threshold'])) { echo $time['late_threshold']; } else { echo ''; };?>" required>
                </div>

                <!-- Submit Button for Updating Settings -->
                <div class="col-md-3 align-self-end">
                    <button type="submit" class="form-control" name="settings">Update</button>
                </div>
            </div>
        </form>
    </div>
</div> 
</div>


    </div>
        </div>
        
    <!--Additional div for sidebar-->
    </div>
    </div>
</div>

