<div class="container mt-4 mb-4">
    <div class="row">
        <div class="col-md-4">
            <div class="card custom-card">
                <div class="card-header">
                    <h3 class="text-center my-2">Users</h3>
                </div>
                <div class="card-body">
                    <h6>Users: <?php echo $data['totalUsers']; ?></h6>
                    <h6>Admins: <?php echo $data['totalAdmins']; ?></h6>
                    <h6>Residences: <?php echo $data['totalResidences']; ?></h6>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card custom-card">
                <div class="card-header">
                    <h3 class="text-center my-2">Request</h3>
                </div>
                <div class="card-body">
                    <h6>Pending: <?php echo $data['totalPending']; ?></h6>
                    <h6>Approved: <?php echo $data['totalApproved']; ?></h6>
                    <h6>Rejected: <?php echo $data['totalRejected']; ?></h6>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card custom-card">
                <div class="card-header">
                    <h3 class=" text-center my-2">Attendance</h3>
                </div>
                <div class="card-body">
                    <h6>Present: <?php echo $data['totalPresentAttendee'] . '/' . $data['totalKagawad']; ?></h6>
                    <h6>Late: <?php echo $data['totalLateAttendee'] . '/' . $data['totalKagawad']; ?></h6>
                </div>
            </div>
        </div>
    </div>
</div>


    <!--Additional div for sidebar-->
    </div>
    </div>
</div>