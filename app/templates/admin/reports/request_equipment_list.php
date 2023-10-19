<div>
    <h1>Equipment Report</h1>

    <div class="table-responsive">
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
            <tbody>
                <?php
                foreach ($usersReports as $usersReport) {
                    ?>
                    <tr>
                        <td><?php echo $usersReport['username']; ?></td>
                        <td><?php echo $usersReport['firstname'] . ' ' . $usersReport['middlename'] . ' ' . $usersReport['lastname']; ?></td>
                        <td><?php echo $usersReport['age']; ?></td>
                        <td><?php echo $usersReport['mobile']; ?></td>
                        <td><?php echo $usersReport['email']; ?></td>
                        <td><?php echo $usersReport['address']; ?></td>
                        <td><?php echo $usersReport['birthdate']; ?></td>
                        <td><?php echo $usersReport['four_ps']; ?></td>
                        <td><?php echo $usersReport['pwd']; ?></td>
                        <td><?php echo $usersReport['solo_parent']; ?></td>
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