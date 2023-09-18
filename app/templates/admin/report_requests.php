

<!-- templates/services.php -->
<div>
    <h1>Reports</h1>
   

    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                  
                    <th>Informant Name</th>
                    <th>Informant Email</th>
                    <th>Informant Mobile</th>
                    <th>Person to report</th>
                    <th>Subject</th>
                    <th>Place of Incident</th>
                    <th>Date of Incident</th>
                    <th>Time of Incident</th>
                    <th>Notes</th>
                    <th>Status</th>
                    <th>Created At</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($requests as $request) {
                    ?>
                    <tr>
                       
                        <td><?php echo $request['fullname']; ?></td>
                        <td><?php echo $request['email']; ?></td>
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