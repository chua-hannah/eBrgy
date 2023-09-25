

<!-- templates/services.php -->
<div>
    <h1>Documents Requests</h1>
   
       <div>
            <a href="http://localhost/eBrgy/app/requests/documents-management" style="color: white; text-decoration: none;">
                <button class="btn btn-primary">
                    Manage Documents
                    </button>
                </a>
        </div>
    
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
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                  
                    <th>Request Name</th>
                    <th>Fullname</th>
                    <th>Mobile</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th>Created At</th>
                </tr>
            </thead>
            <tbody>
              
                    <tr>
                       
                        <td><?php echo $request['request_name']; ?></td>
                        <td><?php echo $request['fullname']; ?></td>
                        <td><?php echo $request['mobile']; ?></td>
                        <td><?php echo $request['email']; ?></td>
                        <td><?php echo $request['status']; ?></td>
                        <td><?php echo $request['created_at']; ?></td>
                    </tr>
             
            </tbody>
        </table>
    </div>
    <?php
                    }
                }
                ?>
</div>

    <!--Additional div for sidebar-->
    </div>
    </div>
</div>