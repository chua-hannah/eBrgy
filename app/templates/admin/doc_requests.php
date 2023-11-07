<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="requests">Manage Requests</a></li>
        <li class="breadcrumb-item active" aria-current="page">Documents</li>
    </ol>
</nav>
<div class="container-fluid">
    <div style="float: right;">
    <a href="http://localhost/eBrgy/app/requests-documents-management" style="color: white; text-decoration: none;">
      <button class="form-control custom-button">
        <i class="bi bi-file-text"></i> Manage Documents
      </button>
    </a>
    </div>

    <h3 class="mt-2 mb-2">Document Requests</h3>
    <div class="table-responsive">
    <?php if (empty($requests)): ?>
        <div class="text-center"><p>There are no available document requests.</p></div>
    <?php else: ?>
            <table class="table table-bordered table-striped custom-table" id="docuTable">
                <thead>
                    <tr>
                    <th class="wrap-text">Document</th>
                    <th class="wrap-text">Purpose / Remarks</th>
                    <th class="wrap-text">First Name</th>
                    <th class="wrap-text">Middle Name</th>
                    <th class="wrap-text">Last Name</th>
                    <th class="wrap-text">Date & Time Submitted</th>
                    <th class="wrap-text">Status</th>
                    <th class="wrap-text">Action/s</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($requests as $request): ?>
                    <tr>
                        <td><?php echo strtoupper($request['request_name']); ?></td>
                        <td><?php echo !empty($request['message']) ? $request['message'] : '-'; ?></td>
                        <td><?php echo $request['firstname']; ?></td>
                        <td>                    
                        <?php
                        if (empty($userData['middlename'])) {
                            echo "-";
                        } else {
                            echo $userData['middlename'];
                        }
                        ?>
                        </td>
                        <td><?php echo $request['lastname']; ?></td>
                        <?php
                        $createdAt = strtotime($request['created_at']);

                        $formattedDate = date('m/d/Y h:i A', $createdAt);

                        echo '<td>' . $formattedDate . '</td>';
                        ?>
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
                        <td style="display: flex;">
                        <form action="requests-edit-document" method="post">
                            <input type="hidden" name="doc_id" value="<?php echo $request['id']; ?>">
                            <input type="hidden" name="username" value="<?php echo $request['username']; ?>">
                            <button type="submit" class="btn btn-primary btn-md">Edit</button>
                        </form>
                        <?php
                                            $status = strtoupper($request['status']);
                                            if ($status == 'APPROVED') {
                                                // If the status is 'APPROVED', change the button to a form and include an invisible input for the id.
                                                $action = ''; // Initialize the action variable
                                            
                                                if ($request['request_name'] === 'firstjob certificate') {
                                                    $action = 'first-job-certificate';
                                                } 
                                                elseif ($request['request_name'] === 'indigency certificate') {
                                                    $action = 'indigency-certificate';
                                                }
                                                elseif ($request['request_name'] === 'barangay certificate') {
                                                    $action = 'barangay-certificate';
                                                }
                                                elseif ($request['request_name'] === 'oath certificate') {
                                                    $action = 'oath-certificate';
                                                }
                                            
                                                if (!empty($action)) {
                                                    echo '<form method="POST" action="' . $action . '" target="_blank">
                                                            <input type="hidden" name="id" value="' . $request['id'] . '">
                                                            <button type="submit" class="btn btn-secondary ms-2" name="print_request_doc">Print</button>
                                                        </form>';
                                                }
                                            }  else {
                                                // If the status is 'REJECTED', echo 'N/A'.
                                                echo '';
                                            }
                                            
                                            ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
        </div>
    </div>
</div>

     <!--Additional div for sidebar-->
    </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        var userTable = $('#docuTable').DataTable({
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