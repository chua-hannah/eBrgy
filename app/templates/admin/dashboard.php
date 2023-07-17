<div class="container">
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Users</h3>
                </div>
                <div class="card-body">
                    <p>Users: <?php echo $data['totalUsers']; ?></p>
                    <p>Admins: <?php echo $data['totalAdmins']; ?></p>
                    <p>Residences: <?php echo $data['totalResidences']; ?></p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Inventory</h3>
                </div>
                <div class="card-body">
                    <p>Total Sales: $10,000</p>
                    <p>Monthly Sales: $2,000</p>
                    <p>Daily Sales: $100</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Attendance</h3>
                </div>
                <div class="card-body">
                   Present: <?php echo $data['totalPresentAttendee'] . '/' . $data['totalKagawad']; ?>
                </div>
            </div>
        </div>
    </div>
</div>


    <!--Additional div for sidebar-->
    </div>
    </div>
</div>