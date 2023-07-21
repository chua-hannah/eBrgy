<div>
    Request Management
</div>

<!-- templates/services.php -->
<div>
    <h1>Requests</h1>
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
                <?php
                foreach ($requests as $request) {
                    ?>
                    <tr>
                       
                        <td><?php echo $request['request_name']; ?></td>
                        <td><?php echo $request['fullname']; ?></td>
                        <td><?php echo $request['mobile']; ?></td>
                        <td><?php echo $request['email']; ?></td>
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