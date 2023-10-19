<div>
    <h1>Users Report</h1>

    <!-- Display counts here -->
    <div class="count-summary">
        <p>Total Senior Users: <?php echo $usersReports['seniorCount']; ?></p>
        <p>Total PWD Users: <?php echo $usersReports['pwdCount']; ?></p>
        <p>Total 4Ps Users: <?php echo $usersReports['fourPsCount']; ?></p>
        <p>Total Solo Parent Users: <?php echo $usersReports['soloParentCount']; ?></p>
    </div>

    <div class="table-responsive text-center">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Username</th>
                    <th>Full name</th>
                    <th>Age</th>
                    <th>Mobile</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th>Birthday<br />(YY-MM-DD)</th>
                    <th>4PS</th>
                    <th>PWD</th>
                    <th>SOLO PARENT</th>
                </tr>
            </thead>
            <tbody class="text-center">
                <?php
                foreach ($usersReports['users'] as $usersReport) {
                    ?>
                    <tr>
                        <td><?php echo $usersReport['username']; ?></td>
                        <td><?php echo $usersReport['firstname'] . ' ' . $usersReport['middlename'] . ' ' . $usersReport['lastname']; ?></td>
                        <td><?php echo $usersReport['age']; ?></td>
                        <td><?php echo $usersReport['mobile']; ?></td>
                        <td><?php echo $usersReport['email']; ?></td>
                        <td><?php echo $usersReport['address']; ?></td>
                        <td><?php echo $usersReport['birthdate']; ?></td>
                        <td><?php echo $usersReport['four_ps'] == 1 ? '<i class="bi bi-check"></i>' : ''; ?></td>
                        <td><?php echo $usersReport['pwd'] == 1 ? '<i class="bi bi-check"></i>' : ''; ?></td>
                        <td><?php echo $usersReport['solo_parent'] == 1 ? '<i class="bi bi-check"></i>' : ''; ?></td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</div>


    <!--Additional div for sidebar-->
    </div>
    </div>
</div>