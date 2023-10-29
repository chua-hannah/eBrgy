<button id="printTableButton">Print Table</button>


<ul class="nav nav-tabs" id="myTabs" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="tab1-tab" data-toggle="tab" href="#tab1" role="tab" aria-controls="tab1" aria-selected="true">Reklamo Report</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="tab2-tab" data-toggle="tab" href="#tab2" role="tab" aria-controls="tab2" aria-selected="false">Document Report</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="tab3-tab" data-toggle="tab" href="#tab3" role="tab" aria-controls="tab3" aria-selected="false">Schedules Report</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="tab4-tab" data-toggle="tab" href="#tab4" role="tab" aria-controls="tab4" aria-selected="false">Equipments Report</a>
        </li>
    </ul>
    <div class="tab-content" id="myTabsContent">
        <div class="tab-pane fade show active" id="tab1" role="tabpanel" aria-labelledby="tab1-tab">
            <div class="count-summary text-end mt-2 me-2">
                <p>Total Approved Request: <?php echo $docReports['approvedCount']; ?></p>
                <p>Total Rejected Request: <?php echo $docReports['rejectedCount']; ?></p>
                
            </div>

            <div class="table-responsive text-center">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Reported Person</th>
                            <th>Username</th>
                            <th>Fullname</th>
                            <th>Email</th>
                            <th>Mobile</th>
                            <th>Status</th>
                            <th>Created at<br />(YY-MM-DD)</th>
                            <th>Proccess at</th>
                            <th>Process by</th>
                            <th>Message</th>

                        </tr>
                    </thead>
                    <tbody class="text-center">
                        <?php
                        foreach ($reklamoReports['reports'] as $reklamoReport) {
                            ?>
                            <tr>
                                <td><?php echo $reklamoReport['reported_person']; ?></td>
                                <td><?php echo $reklamoReport['username']; ?></td>
                                <td><?php echo $reklamoReport['firstname'] . ' ' . $reklamoReport['middlename'] . ' ' . $reklamoReport['lastname']; ?></td>

                                <td><?php echo $reklamoReport['email']; ?></td>
                                <td><?php echo $reklamoReport['mobile']; ?></td>
                                <td><?php echo $reklamoReport['status']; ?></td>
                                <td><?php echo $reklamoReport['created_at']; ?></td>
                                <td><?php echo $reklamoReport['process_at']; ?></td>
                                <td><?php echo $reklamoReport['process_by']; ?></td>
                                <td><?php echo $reklamoReport['note']; ?></td>


                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
          
        </div>
        <div class="tab-pane fade" id="tab2" role="tabpanel" aria-labelledby="tab2-tab">
        <div class="count-summary text-end mt-2 me-2">
                <p>Total Approved Request: <?php echo $docReports['approvedCount']; ?></p>
                <p>Total Rejected Request: <?php echo $docReports['rejectedCount']; ?></p>
                
            </div>

            <div class="table-responsive text-center">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Document Name</th>
                            <th>Username</th>
                            <th>Fullname</th>
                            <th>Email</th>
                            <th>Mobile</th>
                            <th>Status</th>
                            <th>Created at<br />(YY-MM-DD)</th>
                            <th>Proccess at</th>
                            <th>Process by</th>
                            <th>Message</th>

                        </tr>
                    </thead>
                    <tbody class="text-center">
                        <?php
                        foreach ($docReports['documents'] as $docReport) {
                            ?>
                            <tr>
                                <td><?php echo $docReport['request_name']; ?></td>
                                <td><?php echo $docReport['username']; ?></td>
                                <td><?php echo $docReport['firstname'] . ' ' . $docReport['middlename'] . ' ' . $docReport['lastname']; ?></td>

                                <td><?php echo $docReport['email']; ?></td>
                                <td><?php echo $docReport['mobile']; ?></td>
                                <td><?php echo $docReport['status']; ?></td>
                                <td><?php echo $docReport['created_at']; ?></td>
                                <td><?php echo $docReport['process_at']; ?></td>
                                <td><?php echo $docReport['process_by']; ?></td>
                                <td><?php echo $docReport['message']; ?></td>


                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="tab-pane fade" id="tab3" role="tabpanel" aria-labelledby="tab3-tab">
            <div class="count-summary text-end mt-2 me-2">
                    <p>Total Approved Request: <?php echo $scheduleReports['approvedCount']; ?></p>
                    <p>Total Rejected Request: <?php echo $scheduleReports['rejectedCount']; ?></p>
                    
                </div>

                <div class="table-responsive text-center">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Username</th>
                                <th>Mobile</th>
                                <th>Fullname</th>
                                <th>Schedule Date</th>
                                <th>Time in</th>
                                <th>Time out </th>
                                <th>Status</th>
                                <th>Created at</th>
                                <th>Proccess at</th>
                                <th>Process by</th>
                              

                            </tr>
                        </thead>
                        <tbody class="text-center">
                            <?php
                            foreach ($scheduleReports['schedules'] as $scheduleReport) {
                                ?>
                                <tr>
                                    <td><?php echo $scheduleReport['username']; ?></td>
                                    <td><?php echo $scheduleReport['mobile']; ?></td>
                                    <td><?php echo $scheduleReport['firstname'] . ' ' . $scheduleReport['middlename'] . ' ' . $scheduleReport['lastname']; ?></td>

                                    <td><?php echo $scheduleReport['schedule_date']; ?></td>
                                    <td><?php echo $scheduleReport['time_in']; ?></td>
                                    <td><?php echo $scheduleReport['time_out']; ?></td>
                                    <td><?php echo $scheduleReport['status']; ?></td>
                                    <td><?php echo $scheduleReport['created_at']; ?></td>
                                    <td><?php echo $scheduleReport['process_at']; ?></td>
                                    <td><?php echo $scheduleReport['process_by']; ?></td>


                                </tr>
                                <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
        </div>
        <div class="tab-pane fade" id="tab4" role="tabpanel" aria-labelledby="tab4-tab">
        <div class="count-summary text-end mt-2 me-2">
                    <p>Total Approved Request: <?php echo $equipmentReports['approvedCount']; ?></p>
                    <p>Total Rejected Request: <?php echo $equipmentReports['rejectedCount']; ?></p>
                    
                </div>

                <div class="table-responsive text-center">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Equipment name</th>
                                <th>Quantity</th>
                                <th>Duration</th>
                                <th>Username</th>
                                <th>Fullname</th>
                                <th>Status </th>
                                <th>Request Date</th>
                                <th>Proccess at</th>
                                <th>Process by</th>
                              

                            </tr>
                        </thead>
                        <tbody class="text-center">
                            <?php
                            foreach ($equipmentReports['equipments'] as $equipmentReport) {
                                ?>
                                <tr>
                                    <td><?php echo $equipmentReport['equipment_name']; ?></td>
                                    <td><?php echo $equipmentReport['total_equipment_borrowed']; ?></td>
                                    <td><?php echo $equipmentReport['days']; ?></td>
                                    <td><?php echo $equipmentReport['username']; ?></td>
                                    <td><?php echo $equipmentReport['firstname'] . ' ' . $equipmentReport['middlename'] . ' ' . $equipmentReport['lastname']; ?></td>
                                    <td><?php echo $equipmentReport['status']; ?></td>
                                    <td><?php echo $equipmentReport['request_date']; ?></td>
                                    <td><?php echo $equipmentReport['process_at']; ?></td>
                                    <td><?php echo $equipmentReport['process_by']; ?></td>


                                </tr>
                                <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
        </div>
    </div>

       <!--Additional div for sidebar-->
       </div>
    </div>
</div>

<script>
    document.getElementById("printTableButton").addEventListener("click", function() {
        var activeTab = document.querySelector('.nav-link.active'); // Get the active tab link
        var tabContentId = activeTab.getAttribute('href').substring(1); // Get the tab content ID

        var tableToPrint = document.getElementById(tabContentId).querySelector('table'); // Get the table in the active tab
        var username = "<?php echo $_SESSION['username']; ?>"; // Get the username from the PHP session

        // Apply CSS styles to add borders, center text in cells, and other styling
        tableToPrint.style.borderCollapse = "collapse";
        tableToPrint.style.border = "1px solid #000";
        tableToPrint.style.textAlign = "center"; // Center align the text in cells

        var newWin = window.open('', '', 'width=600,height=600');
        newWin.document.open();
        newWin.document.write('<html><head><style>table {border-collapse: collapse; text-align: center;} table, th, td {border: 1px solid #000; text-align: center;} </style></head><body>');
        newWin.document.write('<p>Printed by: ' + username + '</p>'); // Add "printed by" note with the username

        // Get the table's content dynamically
        var tableRows = tableToPrint.getElementsByTagName('tr');

        // Add column headers
        var headerRow = tableRows[0];
        newWin.document.write('<table>');
        newWin.document.write('<tr>');
        var headerCells = headerRow.getElementsByTagName('th');
        for (var h = 0; h < headerCells.length; h++) {
            newWin.document.write('<th>' + headerCells[h].innerHTML + '</th>');
        }
        newWin.document.write('</tr>');

        // Print the table, including all pages
        for (var i = 1; i < tableRows.length; i++) {
            newWin.document.write('<tr>');
            var tableCells = tableRows[i].getElementsByTagName('td');
            for (var j = 0; j < tableCells.length; j++) {
                newWin.document.write('<td>' + tableCells[j].innerHTML + '</td>');
            }
            newWin.document.write('</tr>');
        }

        newWin.document.write('</table>');
        newWin.document.write('</body></html>');
        newWin.document.close();
        newWin.print();
        newWin.close();
    });
</script>