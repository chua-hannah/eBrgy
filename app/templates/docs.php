<div class="container" style="margin: 16px;">
            <div class="text-center"> 
                <div><h4>DOCUMENTS</h4></div>
                <form action="" method="post">
                        <select name="selected_service" required>
                            <option value="">Choose a service</option>
                            <?php
                            foreach ($requests as $request) {
                                // Display the data for each request
                                ?>
                                <option value="<?php echo $request['request_name']; ?>"><?php echo $request['request_name']; ?></option>    
                                <?php
                            }
                            ?>
                        </select>
                    <textarea name="service_message" placeholder="Message" required></textarea>
                    <!-- Add more fields as needed -->
                    <button type="submit" name="request_service">Submit</button>
                </form>
                 <!-- templates/services.php -->
                <div class="mt-2">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                
                                    <th>Request Name</th>
                                    <th>Status</th>
                                    <th>Request Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($myrequest as $request) {
                                    ?>
                                    <tr>
                                    
                                        <td><?php echo $request['request_name']; ?></td>
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
        </div>
</div>


  