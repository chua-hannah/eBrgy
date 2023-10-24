<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="services">Services</a></li>
    <li class="breadcrumb-item active" aria-current="page">Book a Schedule</li>
  </ol>
</nav>
<div class="container-fluid">
    <div class="col-lg-6 col-12 mx-auto mb-0">
        <form class="custom-form contact-form mb-4" action="#" id ="scheduleForm" method="post" role="form">
        <div class="row d-flex justify-content-center">
            <h3>Check Scheduled Event</h3>
            <p class="form-group text-justify">
                <i class="bi bi-exclamation-circle"></i>
                Reminder: We can only accept requests for events taking place for tomorrow and within the next month.
            </p>
            <div class="col-lg-12 col-md-6 col-12">
                <label class="labels">Enter a date:</label>
                <div class="input-group">
                    <span class="input-group-text">
                        <i class="bi bi-calendar"></i> <!-- Bootstrap Icons calendar icon -->
                    </span>
                    <input type="text" name="reserved_schedule" id="datepicker-future" class="form-control" value="<?php if (!empty($_POST["reserved_schedule"])) { echo $_POST["reserved_schedule"]; } 
                    else { date_default_timezone_set(date_default_timezone_get()); $current_time = time(); $future_time = strtotime('+1 day', $current_time); echo date('m/d/Y', $future_time); }; ?>">
                </div>
                <div class="d-grid gap-2 col-12 mx-auto">
                    <button type="submit" name="showData" id="showData" class="form-control mb-0">Submit</button>
                    <a href="#submittedScheduleModal" class="text-center mb-0" data-bs-toggle="modal" data-bs-target="#submittedScheduleModal">
                    View Submitted Requests
                </a>
                </div>
            </div>
        </form>
    </div>
    <!-- Check Schedule Modal -->
    <div class="modal fade" id="scheduleModal" tabindex="-1" aria-labelledby="scheduleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">List of Scheduled Events</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive text-center">
                        <?php if (is_array($schedulesData) || is_object($schedulesData)) { ?>
                            <table class="table table-bordered table-striped custom-table datatable" id="">
                                <thead>
                                    <tr>
                                        <th>Booked By</th>
                                        <th>Date</th>
                                        <th>Start at</th>
                                        <th>End at</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($schedulesData as $scheduleData) {
                                        $status = $scheduleData['status'];
                                        if (strcasecmp($status, "approved") === 0) {
                                            $status = "BOOKED";
                                        }
                                        if ($scheduleData['username'] == $username) {
                                            $name = $username . " (You)";
                                        } else {
                                            $name = "Anonymous";
                                        }
                                    ?>
                                        <tr>
                                            <td><?php echo $name; ?></td>
                                            <td><?php echo $scheduleData['schedule_date']; ?></td>
                                            <td><?php echo $scheduleData['time_in']; ?></td>
                                            <td><?php echo $scheduleData['time_out']; ?></td>
                                            <td><?php echo $status; ?></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        <?php } else { ?>
                            <div class="text-center">There are no scheduled events on the selected date.</div>
                        <?php } ?>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="requestSchedule">
                        <i class="bi bi-calendar"></i> Request an Event Schedule
                    </button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal for Submitted Request -->
    <div class="modal fade" id="submittedScheduleModal" tabindex="-1" aria-labelledby="submittedScheduleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h5 class="modal-title">List of Schedule</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <!-- Modal Body (Your Table) -->
                <div class="modal-body">
                    <div class="container">
                        <div class="row">
                            <div class="col-12">
                                <div class="table-responsive text-center">
                                    <?php if (empty($myScheduleData)) { ?>
                                        <div class="text-center"><p>No requests are currently available.</p></div>
                                    <?php } else { ?>
                                        <table class="table table-bordered table-striped custom-table datatable">
                                            <thead>
                                                <tr>
                                                    <th>Scheduled Date</th>
                                                    <th>Start at</th>
                                                    <th>End at</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($myScheduleData as $request) {
                                                    $requestScheduleDate = date("m/d/Y", strtotime($request['schedule_date']));
                                                    $requestScheduleStart = date("h:i A", strtotime($request['time_in']));
                                                    $requestScheduleEnd = date("h:i A", strtotime($request['time_out']));
                                                ?>
                                                    <tr>
                                                        <td><?php echo $requestScheduleDate; ?></td>
                                                        <td><?php echo $requestScheduleStart; ?></td>
                                                        <td><?php echo $requestScheduleEnd; ?></td>
                                                        <td><?php echo strtoupper($request['status']); ?></td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
    if (isset($_POST['showData'])) {
        // Display the modal if registration was successful
        echo '<script>$(document).ready(function() { showScheduleModal(); });</script>';
    }
?>
<script>
function showScheduleModal() {
    $('#scheduleModal').modal('show');
}
document.getElementById("requestSchedule").addEventListener("click", function() {
    window.location.href = "http://localhost/eBrgy/app/schedule-request";
});
</script>