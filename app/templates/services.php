<div class="container mt-5">
        <h1>Services</h1>
        
       <div class="row">
            <div class="col-md-4 text-center"> 
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
        <div class="col-md-4 text-center">
            <div><h4>EQUIPMENTS FORM</h4></div>
            <form action="process_form.php" method="post">
        <label for="equipment_name">Equipment Name:</label>
        <input type="text" id="equipment_name" name="equipment_name" required><br><br>

        <label for="fullname">Full Name:</label>
        <input type="text" id="fullname" name="fullname" required><br><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br><br>

        <label for="mobile">Mobile:</label>
        <input type="tel" id="mobile" name="mobile" required><br><br>

        <label for="status">Status:</label>
        <select id="status" name="status" required>
            <option value="Active">Active</option>
            <option value="Inactive">Inactive</option>
            <option value="Repair">Repair</option>
        </select><br><br>

        <label for="equipment_count">Equipment Count:</label>
        <input type="number" id="equipment_count" name="equipment_count" required><br><br>

        <input type="submit" value="Submit">
    </form>
        </div>
        <div class="col-md-4 text-center">
            <div>
                <h4>REPORTS</h4>
            </div>
        </div>
       </div>
</div>

<div class="text-center">
<h1>Select a Service</h1>
    <form>
      
        <select id="display_option" onchange="updateDivDisplay()">
            <option value="option">Select</option>
            <option value="option1">DOCUMENTS</option>
            <option value="option2">EQUIPMENTS</option>
            <option value="option3">REPORTS</option>
        </select>
    </form>
    <div id="content_display">
        <!-- This is where the content will change dynamically based on the selected option -->
    </div>
</div>
    <script>
        function updateDivDisplay() {
            var selectOption = document.getElementById("display_option").value;
            var contentDiv = document.getElementById("content_display");

            // Replace the content of the div based on the selected option
            switch (selectOption) {
                case "option1":
                    // PHP-generated content for Option 1
                    contentDiv.innerHTML = `
                    <div class="text-center"><h4>DOCUMENTS</h4>
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
                    </div>`;
                    break;
                case "option2":
                    contentDiv.innerHTML = "<p>Content for Option 2</p>";
                    break;
                case "option3":
                    contentDiv.innerHTML = "<p>Content for Option 3</p>";
                    break;
                default:
                    contentDiv.innerHTML = ""; // Empty the content if no option is selected
            }
        }
    </script>