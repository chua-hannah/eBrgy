

<!-- templates/services.php -->
<div>
    <h1>Equiptment Requests</h1>
   
        <a href="http://localhost/eBrgy/app/requests/equipments-management" style="color: white; text-decoration: none;">
        <button class="btn btn-primary">
            Manage Documents
            </button>
        </a>
    

    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                  
                    <th>Request Name</th>
                    <th>Username</th>
                    <th>Quantity</th>
                    <th>Mobile</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th>Request Date</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($requests as $request) {
                    ?>
                    <tr>
                       
                        <td><?php echo $request['equipment_name']; ?></td>
                        <td><?php echo $request['username']; ?></td>
                        <td><?php echo $request['total_equipment_borrowed']; ?></td>
                        <td><?php echo $request['mobile']; ?></td>
                        <td><?php echo $request['email']; ?></td>
                        <td><?php echo $request['status']; ?></td>
                        <td><?php echo $request['request_date']; ?></td>
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