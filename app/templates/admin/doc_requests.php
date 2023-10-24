<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="services">Services</a></li>
        <li class="breadcrumb-item active" aria-current="page">Document Requests</li>
    </ol>
</nav>

<div class="container-fluid">
    <div style="float: right;">
    <a href="http://localhost/eBrgy/app/requests-documents-management" style="color: white; text-decoration: none;" <?php if (!($_SESSION['role'] == "captain")) { echo "hidden"; } ?>>
      <button class="form-control custom-button">
        <i class="bi bi-file-text"></i> Manage Document Types
      </button>
    </a>
    </div>

    <h3 class="mt-2 mb-2">Document Requests</h3>
    <div class="table-responsive">
    <?php if (empty($requests)): ?>
        <div class="text-center"><p>There are no available document requests.</p></div>
    <?php else: ?>
            <table class="table table-bordered table-striped custom-table datatable">
                <thead>
                    <tr>
                    <th>Request Name</th>
                    <th>First Name</th>
                    <th>Middle Name</th>
                    <th>Last Name</th>
                    <th>Address</th>
                    <th>Mobile</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th>Created At</th>
                    <th>Action/s</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($requests as $request): ?>
                    <tr>
                        <td><?php echo $request['request_name']; ?></td>
                        <td><?php echo $request['firstname']; ?></td>
                        <td><?php echo $request['middlename']; ?></td>
                        <td><?php echo $request['lastname']; ?></td>
                        <td><?php echo $request['address']; ?></td>
                        <td><?php echo $request['mobile']; ?></td>
                        <td><?php echo $request['email']; ?></td>
                        <td><?php echo strtoupper($request['status']); ?></td>
                        <td><?php echo $request['created_at']; ?></td>
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