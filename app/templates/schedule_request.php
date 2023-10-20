<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="services">Services</a></li>
    <li class="breadcrumb-item"><a href="schedules">Book a Schedule</a></li>
    <li class="breadcrumb-item active" aria-current="page">Request Schedule</li>
  </ol>
</nav>
<div class="container-fluid">
<div class="col-lg-6 col-12 mx-auto mb-0">
        <form class="custom-form contact-form mb-4" action="#" id ="scheduleForm" method="post" role="form">
        <div class="row d-flex justify-content-center">
            <h3 class="mb-4">Request Schedule</h3>
            <div class="col-lg-12 col-md-6 col-12">
                <div class="row">
                    <div class="col-lg-12 col-12">
                        <label class="labels">Select a Date:</label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="bi bi-calendar"></i> <!-- Bootstrap Icons calendar icon -->
                            </span>
                            <input type="text" name="schedule_date" id="datepicker-future" class="form-control" value="<?php if (!empty($_POST["schedule_date"])) { echo $_POST["schedule_date"]; } 
                                else { date_default_timezone_set(date_default_timezone_get()); $current_time = time(); $future_time = strtotime('+1 day', $current_time); echo date('m/d/Y', $future_time); }; ?>">
                        </div>
                    </div>
                    <label class="labels">Available Time Slots</label>
                    <div class="col-lg-6 col-12">
                        <label class="labels">Start Time</label>
                        <select class="form-select" name="time_in" id="time_in" required>
                            <option value="" disabled selected>Select a Start Time</option>
                            <option value="1:00 PM">1:00 PM</option>
                            <option value="2:00 PM">2:00 PM</option>
                            <option value="3:00 PM">3:00 PM</option>
                            <option value="4:00 PM">4:00 PM</option>
                            <option value="5:00 PM">5:00 PM</option>
                            <option value="6:00 PM">6:00 PM</option>
                            <option value="7:00 PM">7:00 PM</option>
                            <option value="8:00 PM">8:00 PM</option>
                            <option value="9:00 PM">9:00 PM</option>
                            <option value="10:00 PM">10:00 PM</option>
                        </select>
                    </div>
                    <div class="col-lg-6 col-12">
                        <label class="labels">End Time</label>
                        <select class="form-select" name="time_out" id="time_out" required disabled>    
                            <option value="" disabled selected>Select an End Time</option>

                        </select>
                    </div>
                </div>
                <div class="d-grid gap-2 col-12 mx-auto">
                    <button type="submit" name="request_schedule" class="form-control mb-0">Submit Request</button>
                </div>
            </div>
        </form>
    </div>
<script>
$(document).ready(function() {
    // Cache the select elements
    var $timeIn = $('#time_in');
    var $timeOut = $('#time_out');

    // Function to update the End Time options and enable the dropdown
    function updateTimeOutOptions() {
        // Clear and reset the End Time dropdown
        $timeOut.empty();

        // Get the selected start time
        var selectedStartTime = $timeIn.val();

        if (selectedStartTime) {
            // Parse the selected start time to a valid date format
            var startTime = new Date('2000-01-01 ' + selectedStartTime);

            // Define end time options based on the selected start time
            var endTimeOptions = ["2:00 PM", "3:00 PM", "4:00 PM", "5:00 PM", "6:00 PM", "7:00 PM", "8:00 PM", "9:00 PM", "10:00 PM", "11:00 PM", "12:00 AM"];

            // Filter end time options to ensure they are greater than the selected start time
            var filteredEndTimeOptions = endTimeOptions.filter(function(endTime) {
                return new Date('2000-01-01 ' + endTime) > startTime;
            });

            // Add the filtered end time options to the dropdown
            filteredEndTimeOptions.forEach(function(option) {
                $timeOut.append('<option value="' + option + '">' + option + '</option>');
            });

            // Enable the "End Time" dropdown
            $timeOut.prop('disabled', false);
        } else {
            $timeOut.append('<option value="" disabled selected>Select an End Time</option>');
            // Disable the "End Time" dropdown if no "Start Time" is selected
            $timeOut.prop('disabled', true);
        }
    }

    // Attach an event listener to the "Start Time" dropdown
    $timeIn.on('change', function() {
        updateTimeOutOptions();
    });
});
</script>


