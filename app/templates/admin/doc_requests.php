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
                    <th>Document</th>
                    <th>First Name</th>
                    <th>Middle Name</th>
                    <th>Last Name</th>
                    <th>Address</th>
                    <th>Mobile</th>
                    <th>Date & Time Submitted</th>
                    <th>Status</th>
                    <th>Action/s</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($requests as $request): ?>
                    <tr>
                        <td><?php echo $request['request_name']; ?></td>
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
                        <td><?php echo $request['address']; ?></td>
                        <td><?php echo $request['mobile']; ?></td>
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
                        <td>
                        <form action="requests-edit-document" method="post">
                            <input type="hidden" name="doc_id" value="<?php echo $request['id']; ?>">
                            <input type="hidden" name="username" value="<?php echo $request['username']; ?>">
                            <button type="submit" class="btn btn-primary btn-md">Edit</button>
                        </form>
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