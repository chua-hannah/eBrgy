<div class="container-fluid">
        <h3 class="mt-2 mb-2 text-center">Resident Masterlist</h3>
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="users-tab" data-toggle="tab" href="#users" role="tab" aria-controls="users" aria-selected="true">Users</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="non-users-tab" data-toggle="tab" href="#non-users" role="tab" aria-controls="non-users" aria-selected="false">Non Users</a>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <!-- Users Tab -->
            <div class="tab-pane fade show active" id="users" role="tabpanel" aria-labelledby="users-tab">
                <!-- Your table and data for Users here -->
                <div class="table-responsive">
                    <h4 class="mt-2 mb-2">Users</h4>
                    <table class="table table-bordered table-striped custom-table datatable" id="myUserTable">
                    <thead>
                        <tr>
                            <th class="wrap-text">First name</th>
                            <th class="wrap-text">Middle name</th>
                            <th class="wrap-text">Last name</th>
                            <th class="wrap-text">Birthdate</th>
                            <th class="wrap-text">Age</th>
                            <th class="wrap-text">Gender</th>
                            <th class="wrap-text">Mobile</th>
                            <th class="wrap-text">Email</th>
                            <th class="wrap-text">House Address</th>
                            <th class="wrap-text">4PS</th>
                            <th class="wrap-text">PWD</th>
                            <th class="wrap-text">Solo Parent</th>
                            <th class="wrap-text">Scholar</th>
                            <th class="wrap-text">Senior</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        <?php
                        foreach ($mastersDatas['users'] as $mastersData) {
                            ?>
                            <tr>
                                <td><?php echo $mastersData['firstname']; ?></td>
                                <td><?php echo $mastersData['middlename']; ?></td>
                                <td><?php echo $mastersData['lastname']; ?></td>
                                <td><?php echo date('m/d/Y', strtotime($mastersData['birthdate'])); ?></td>
                                <td><?php echo $mastersData['age']; ?></td>
                                <td><?php echo $mastersData['sex']; ?></td>
                                <td><?php echo $mastersData['mobile']; ?></td>
                                <td><?php echo $mastersData['email']; ?></td>
                                <td><?php echo $mastersData['address']; ?></td>
                                <td><?php echo $mastersData['four_ps'] == 1 ? '&#10003;' : ''; ?></td>
                                <td><?php echo $mastersData['pwd'] == 1 ? '&#10003;' : ''; ?></td>
                                <td><?php echo $mastersData['solo_parent'] == 1 ? '&#10003;' : ''; ?></td>
                                <td><?php echo $mastersData['scholar'] == 1 ? '&#10003;' : ''; ?></td>
                                <td><?php echo $mastersData['senior'] == 1 ? '&#10003;' : ''; ?></td>
                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                    </table>
                </div>
            </div>

            <!-- Non-Users Tab -->
            <div class="tab-pane fade" id="non-users" role="tabpanel" aria-labelledby="non-users-tab">
                <!-- Your table and data for Non-Users here -->
                <div class="table-responsive">
                    <h4 class="mt-2 mb-2">Non Users</h4>
                    <table class="table table-bordered table-striped custom-table datatable" id="myNonUserTable">
                    <thead>
                        <tr>
                            <th class="wrap-text">First name</th>
                            <th class="wrap-text">Middle name</th>
                            <th class="wrap-text">Last name</th>
                            <th class="wrap-text">Birthdate</th>
                            <th class="wrap-text">Age</th>
                            <th class="wrap-text">Gender</th>
                            <th class="wrap-text">Mobile</th>
                            <th class="wrap-text">Email</th>
                            <th class="wrap-text">House Address</th>
                            <th class="wrap-text">4PS</th>
                            <th class="wrap-text">PWD</th>
                            <th class="wrap-text">Solo Parent</th>
                            <th class="wrap-text">Scholar</th>
                            <th class="wrap-text">Senior</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        <?php
                        foreach ($mastersDatas['masterlist'] as $mastersData) {
                            ?>
                            <tr>
                                <td><?php echo $mastersData['firstname']; ?></td>
                                <td><?php echo $mastersData['middlename']; ?></td>
                                <td><?php echo $mastersData['lastname']; ?></td>
                                <td><?php echo date('m/d/Y', strtotime($mastersData['birthdate'])); ?></td>
                                <td><?php echo $mastersData['age']; ?></td>
                                <td><?php echo $mastersData['gender']; ?></td>
                                <td><?php echo $mastersData['mobile']; ?></td>
                                <td><?php echo $mastersData['email']; ?></td>
                                <td><?php echo $mastersData['address']; ?></td>
                                <td><?php echo $mastersData['four_ps'] == 1 ? '&#10003;' : ''; ?></td>
                                <td><?php echo $mastersData['pwd'] == 1 ? '&#10003;' : ''; ?></td>
                                <td><?php echo $mastersData['solo_parent'] == 1 ? '&#10003;' : ''; ?></td>
                                <td><?php echo $mastersData['scholar'] == 1 ? '&#10003;' : ''; ?></td>
                                <td><?php echo $mastersData['senior'] == 1 ? '&#10003;' : ''; ?></td>
                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    <!--Additional div for sidebar-->
    </div>
    </div>
</div>




