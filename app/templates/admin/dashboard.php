<div class="container-fluid">
    <div class="row">
        <!-- Users Card -->
        <div class="col-md-4 pb-4">
            <div class="card custom-card" style="background: linear-gradient(135deg, #FFA07A, #FF6B8B); height: 100vh;">
                <div class="card-header">
                    <h3 class="text-center my-2">
                        <i class="bi bi-people" style="font-size: 2rem;"></i> Users
                    </h3>
                </div>
                <div class="card-body">
                    <h6><i class="bi bi-person" style="font-size: 1rem;"></i> Active Users: <?php echo $data['totalActiveUsers']; ?></h6>
                    <h6><i class="bi bi-clock" style="font-size: 1rem;"></i> Pending Users: <?php echo $data['totalUsers']; ?></h6>
                    <h6><i class="bi bi-person-fill" style="font-size: 1rem;"></i> Admins: <?php echo $data['totalAdmins']; ?></h6>
                    <h6><i class="bi bi-house" style="font-size: 1rem;"></i> Resident Users: <?php echo $data['totalResidences']; ?></h6>
                    <h4 class="mt-5">Master List</h4>
                    <h6><i class="bi bi-people-fill" style="font-size: 1rem;"></i> Families: <?php echo $families; ?></h6>
                    <h6><i class="bi bi-house" style="font-size: 1rem;"></i> Residences: <?php echo $data['masterlistUsers']; ?></h6>
                    <h6><i class="bi bi-people" style="font-size: 1rem;"></i> Seniors: <?php echo $data['masterlistSenior']; ?></h6>
                    <h6><i class="bi bi-person" style="font-size: 1rem;"></i> PWD : <?php echo $data['masterlistPwd']; ?></h6>
                    <h6><i class="bi bi-bank" style="font-size: 1rem;"></i> 4PS: <?php echo $data['masterlistFourps']; ?></h6>
                    <h6><i class="bi bi-book" style="font-size: 1rem;"></i> Scholar: <?php echo $data['masterlistScholar']; ?></h6>


                </div>
              
            </div>
        </div>

        <!-- Request Card -->
        <div class="col-md-4 pb-4">
            <div class="card custom-card h-100" style="background: linear-gradient(135deg, #77FFD2, #78E4E3);">
                <div class="card-header">
                    <h3 class="text-center my-2">
                        <i class="bi bi-envelope" style="font-size: 2rem;"></i> Request
                    </h3>
                </div>
                <div class="card-body">
                    <h4>Documents</h4>
                    <h6><i class="bi bi-clock" style="font-size: 1rem;"></i> Pending: <?php echo $data['totalPending']; ?></h6>
                    <h6><i class="bi bi-check2" style="font-size: 1rem;"></i> Approved: <?php echo $data['totalApproved']; ?></h6>
                    <h6><i class="bi bi-x" style="font-size: 1rem;"></i> Rejected: <?php echo $data['totalRejected']; ?></h6>

                    <h4 class="mt-3">Equipments</h4>
                    <h6><i class="bi bi-clock" style="font-size: 1rem;"></i> Pending: <?php echo $data['totalEquipPending']; ?></h6>
                    <h6><i class="bi bi-check2" style="font-size: 1rem;"></i> Approved: <?php echo $data['totalEquipApproved']; ?></h6>
                    <h6><i class="bi bi-x" style="font-size: 1rem;"></i> Rejected: <?php echo $data['totalEquipRejected']; ?></h6>
                    <h6><i class="bi bi-arrow-counterclockwise" style="font-size: 1rem;"></i> Returned: <?php echo $data['totalReturned']; ?></h6>

                    <h4>Schedules</h4>
                    <h6><i class="bi bi-clock" style="font-size: 1rem;"></i> Pending: <?php echo $data['totalSchedulePending']; ?></h6>
                    <h6><i class="bi bi-check2" style="font-size: 1rem;"></i> Approved: <?php echo $data['totalScheduleApproved']; ?></h6>
                    <h6><i class="bi bi-x" style="font-size: 1rem;"></i> Rejected: <?php echo $data['totalScheduleRejected']; ?></h6>

                    <h4>Reports</h4>
                    <h6><i class="bi bi-clock" style="font-size: 1rem;"></i> Pending: <?php echo $data['totalReportsPending']; ?></h6>
                    <h6><i class="bi bi-check2" style="font-size: 1rem;"></i> Approved: <?php echo $data['totalReportsApproved']; ?></h6>
                    <h6><i class="bi bi-x" style="font-size: 1rem;"></i> Rejected: <?php echo $data['totalReportsRejected']; ?></h6>
                </div>
            </div>
        </div>

        <!-- Attendance Card -->
        <div class="col-md-4 pb-4">
            <div class="card custom-card h-100" style="background: linear-gradient(135deg, #FFC3A0, #FFAFBD);">
                <div class="card-header">
                    <h3 class="text-center my-2">
                        <i class="bi bi-calendar-check" style="font-size: 2rem;"></i> Attendance
                    </h3>
                </div>
                <div class="card-body">
                    <!-- Present Section -->
                    <h6><i class="bi bi-person-check" style="font-size: 1rem;"></i> Present: <?php echo $data['totalPresentAttendee'] . '/' . $data['totalKagawad']; ?></h6>
                    <?php foreach ($data['presentAttendees'] as $presentAttendee) { ?>
                        <p class="attendee-name present-attendee text-success">
                            <?php echo $presentAttendee['firstname'] . ' ' . $presentAttendee['middlename'] . ' ' . $presentAttendee['lastname']; ?>
                            <!-- Include other details you want to display -->
                        </p>
                    <?php } ?>

                    <!-- Late Section -->
                    <h6><i class="bi bi-person-dash" style="font-size: 1rem;"></i> Late: <?php echo $data['totalLateAttendee'] . '/' . $data['totalKagawad']; ?></h6>
                    <?php foreach ($data['lateAttendees'] as $lateAttendee) { ?>
                        <p class="attendee-name late-attendee text-warning">
                            <?php echo $lateAttendee['firstname'] . ' ' . $lateAttendee['middlename'] . ' ' . $lateAttendee['lastname']; ?>
                            <!-- Include other details you want to display -->
                        </p>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>


    <!--Additional div for sidebar-->
    </div>
    </div>
</div>