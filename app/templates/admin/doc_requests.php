<div class="container-fluid">
<div style="float:right;">
        <a href="http://localhost/eBrgy/app/requests/documents-management" style="color: white; text-decoration: none;" <?php if(!($_SESSION['role']=="captain")) { echo "hidden"; } ?>>
            <button class="form-control custom-button">
            <i class="bi bi-file-text"></i>
                Manage Document Types
            </button>
        </a>
        </div>
        <div>
        <h3 class="mt-2 mb-2">Document Requests</h3>
        <div class="table-responsive">
        <table class="table table-bordered table-striped custom-table">
            <thead>
                <tr>
                    <th>Action</th>
                    <th>Request Name</th>
                    <th>First Name</th>
                    <th>Middle Name</th>
                    <th>Last Name</th>
                    <th>Address</th>
                    <th>Mobile</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th>Created At</th>
                </tr>
            </thead>
            <tbody>
        <?php
                if (empty($requests)) {
                    ?>      
                    <div class="text-center bg-danger text-white mt-2"><?php echo "No Request/s Available."; ?></div>
                    <?php
                }
                else
                {
                    foreach ($requests as $request) {
                    ?>
   
              
                    <tr>
                    <td>
                          
                          <form action="documents/edit-document" method="post">
                              <input type="hidden" name="doc_id" value="<?php echo $request['id']; ?>">
                              <input type="hidden" name="username" value="<?php echo $request['username']; ?>">
                              <button type="submit" class="btn btn-primary btn-sm">Edit</button>
                          </form>
                            
                       
                      </td>
                        <td><?php echo $request['request_name']; ?></td>
                        <td><?php echo $request['firstname']; ?></td>
                        <td><?php echo $request['middlename']; ?></td>
                        <td><?php echo $request['lastname']; ?></td>
                        <td><?php echo $request['address']; ?></td>
                        <td><?php echo $request['mobile']; ?></td>
                        <td><?php echo $request['email']; ?></td>
                        <td><?php echo $request['status']; ?></td>
                        <td><?php echo $request['created_at']; ?></td>
                    </tr>
                <?php
                                }
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