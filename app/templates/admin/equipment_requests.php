<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="requests">Manage Requests</a></li>
        <li class="breadcrumb-item active" aria-current="page">Equipments</li>
    </ol>
</nav>
<div class="container-fluid">
    <div style="float: right;">
        <a href="http://localhost/eBrgy/app/requests-equipments-management" style="color: white; text-decoration: none;">
        <button class="form-control custom-button">
            <i class="bi bi-tools"></i> Manage Equipments
        </button>
        </a>
    </div>
    <h3 class="mt-2 mb-2">Equipment Requests</h3>
    <div class="table-responsive">
        <table class="table table-bordered table-striped custom-table" id="equipTable">
            <thead>
                <tr>
                    <th class="text-wrap">Equipment</th>
                    <th class="wrap-text">Quantity</th>
                    <th class="wrap-text">Return Date</th>
                    <th class="wrap-text">First Name</th>
                    <th class="wrap-text">Middle Name</th>
                    <th class="wrap-text">Last Name</th>
                    <th class="wrap-text">Request Date and Time</th>
                    <th class="wrap-text">Status</th>
                    <th class="wrap-text">Action/s</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($requests as $request) {
                    ?>
                    <tr>
                        <td><?php echo $request['equipment_name']; ?></td>
                        <td><?php echo $request['total_equipment_borrowed']; ?></td>
                        <td><?php echo date('m/d/Y', strtotime($request['return_date'])); ?></td>
                        <td><?php echo $request['firstname']; ?></td>
                        <td>                    
                        <?php
                        if (empty($request['middlename'])) {
                            echo "-";
                        } else {
                            echo $request['middlename'];
                        }
                        ?>
                        </td>
                        <td><?php echo $request['lastname']; ?></td>
                        <td><?php echo date('m/d/Y h:i a', strtotime($request['request_date'])); ?></td>
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
                        elseif ($status === 'RETURNED') {
                            $statusClass = 'text-primary';
                        }

                        echo '<td class="' . $statusClass . '">' . $status . '</td>';
                        ?>
                        <td>
                            <form action="requests-edit-equipment" method="post">
                                <input type="hidden" name="equipment_id" value="<?php echo $request['id']; ?>">
                                <input type="hidden" name="username" value="<?php echo $request['username']; ?>">
                                <button type="submit" class="btn btn-primary btn-md">Edit</button>
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
        var userTable = $('#equipTable').DataTable({
            paging: true, // Enable pagination
            pageLength: 10, // Number of rows per page
            lengthMenu: [10, 25, 50, 100], // Dropdown for rows per page
            responsive: true, // Enable responsive behavior
            order: [[5, 'desc']], // Sort the first column (index 0) in descending order
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