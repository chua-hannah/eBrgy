<div>Add Equipment </div>
    <div>
    <form action="" method="post">
        <input type="text" name="request_name" placeholder="Request Type Name" required>
        <select name="status" required>
            <option value="">Choose status</option>
            <option value="1">Available</option>
            <option value="2">Not Available</option>
        </select>
        <textarea name="description" placeholder="Description" required></textarea>
        <!-- Add more fields as needed -->
        <button type="submit" name="add_request">Submit</button>
    </form>
    </div>

    <div>
         List of Equipments
        <div>
            <?php
            // Check if there are any records fetched from the database
            if (!empty($requests)) {
            ?>
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($requests as $request) {
                        // Display the data for each request
                    ?>
                        <tr>
                            <td><?php echo $request['request_name']; ?></td>
                            <td><?php echo $request['description']; ?></td>
                            <td><?php echo $request['status'] = "1" ? "Available" : "Not Available"; ?></td>
                        </tr>
                    <?php
                    }
                    ?>
                    </tbody>
                </table>
            <?php
            } else {
                // Display a message if no records are found
                echo "No Data Available.";
            }
            ?>
        </div>
        <button class="btn btn-secondary">
        <a href="http://localhost/eBrgy/app/requests/documents" style="color: white; text-decoration: none;">
            Back to Document Requests
        </a>
    </button>
        </div>

            <!--Additional div for sidebar-->
    </div>
    </div>
</div>