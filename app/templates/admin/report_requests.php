

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
                    <th style="min-width: 120px;">Processed at</th>
                    <th style="min-width: 120px;">Process by</th>

                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($requests as $request) {
                    ?>
                    <tr>
                    <td>
                            <div class="btn-group" style="display: flex; gap: 8px; justify-content: space-around;">
                            <form action="reports/edit-report" method="post">
                                <input type="hidden" name="username" value="<?php echo $request['username']; ?>">
                                <button type="submit" class="btn btn-primary" style="padding: 8px;">Edit</button>
                            </form>
                                <button class="btn btn-danger" style="padding: 8px;" >Delete</button>
                               
                            </div>
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
                        <td><?php echo $request['process_at']; ?></td>
                        <td><?php echo $request['process_by']; ?></td>

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