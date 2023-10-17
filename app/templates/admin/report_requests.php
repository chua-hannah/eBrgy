

<!-- templates/services.php -->
<div>
    <h1>Reports</h1>
   

    <div class="table-responsive text-center">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>action</th>
                    <th style="min-width: 220px;">Informant Name</th>
                    <th>Informant Address</th>
                    <th>Informant Mobile</th>
                    <th style="min-width: 220px;">Person to report</th>
                    <th style="min-width: 220px;">Subject</th>
                    <th>Place of Incident</th>
                    <th style="min-width: 120px;">Date of Incident</th>
                    <th style="min-width: 120px;">Time of Incident</th>
                    <th>Notes</th>
                    <th>Status</th>
                    <th style="min-width: 120px;">Time of Report</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($requests as $request) {
                    ?>
                    <tr>
                        <td>
                            <form action="requests-edit-report" method="post">
                                <input type="hidden" name="report_id" value="<?php echo $request['id']; ?>">
                                <input type="hidden" name="username" value="<?php echo $request['username']; ?>">
                                <button type="submit" class="btn btn-primary btn-sm">Edit</button>
                            </form>
                        </td>
                        <td><?php echo $request['firstname'] . ' '  . $request['lastname']; ?></td>
                        <td><?php echo $request['address']; ?></td>
                        <td><?php echo $request['mobile']; ?></td>
                        <td><?php echo $request['reported_person']; ?></td>
                        <td><?php echo $request['subject_person']; ?></td>
                        <td><?php echo $request['place_of_incident']; ?></td>
                        <td><?php echo $request['date_of_incident']; ?></td>
                        <td><?php echo $request['time_of_incident']; ?></td>
                        <td><?php echo $request['note']; ?></td>
                        <td><?php echo $request['status']; ?></td>
                        <td><?php echo $request['created_at']; ?></td>
                        
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