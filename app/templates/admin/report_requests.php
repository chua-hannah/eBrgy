<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="requests">Manage Requests</a></li>
    <li class="breadcrumb-item active" aria-current="page">Reports / Complaints</li>
  </ol>
</nav>
<div class="container-fluid">
    <h3>Report / Complaint Requests</h3>
    <div class="table-responsive text-center">
    <table class="table table-bordered table-striped custom-table" id="reportsTable">
            <thead>
                <tr>
                    <th class="wrap-text">Informant Name</th>
                    <th class="wrap-text">Person to Report</th>
                    <th class="wrap-text">Subject</th>
                    <th class="wrap-text">Place of Incident</th>
                    <th class="wrap-text">Date of Incident</th>
                    <th class="wrap-text">Date & Time Submitted</th>
                    <th class="wrap-text">Status</th>
                    <th class="wrap-text">Action/s</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($requests as $request) {
                    $createdAtFormattedDate = date("m/d/Y", strtotime($request['created_at']));
                    $createdAtFormattedTime = date("h:i A", strtotime($request['created_at']));
                    ?>
                    <tr>
                        <td><?php echo $request['firstname'] . ' '  . $request['lastname']; ?></td>
                        <td><?php echo $request['reported_person']; ?></td>
                        <td><?php echo $request['subject_person']; ?></td>
                        <td><?php echo $request['place_of_incident']; ?></td>
                        <td><?php echo date('m/d/Y', strtotime($request['date_of_incident'])); ?></td>
                        <td><?php echo $createdAtFormattedDate . " " . $createdAtFormattedTime; ?></td>
                        <?php
                        $status = strtoupper($request['status']);
                        $statusClass = '';

                        if ($status === 'PENDING') {
                            $statusClass = 'text-warning';
                        } elseif ($status === 'APPROVED') {
                            $statusClass = 'text-success';
                        } elseif ($status === 'REJECTED') {
                            $statusClass = 'text-danger';
                        }

                        echo '<td class="' . $statusClass . '">' . $status . '</td>';
                        ?>
                        <td>
                            <form action="requests-edit-report" method="post">
                                <input type="hidden" name="report_id" value="<?php echo $request['id']; ?>">
                                <input type="hidden" name="username" value="<?php echo $request['username']; ?>">
                                <button type="submit" class="btn btn-primary" style="padding: 8px;">Edit</button>
                            </form>
                        </td>
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
<script>
    $(document).ready(function () {
        var userTable = $('#reportsTable').DataTable({
            paging: true, // Enable pagination
            pageLength: 10, // Number of rows per page
            lengthMenu: [10, 25, 50, 100], // Dropdown for rows per page
            responsive: true, // Enable responsive behavior
            order: [[6, 'desc']], // Sort the first column (index 0) in descending order
        });

        // Add a page change event listener to the DataTable
        userTable.on('page.dt', function () {
            // Smooth scroll to the top of the page
            $('html, body').animate({
                scrollTop: 0
            }, 0.5); // 500ms animation duration
        });
        
    });
</script>