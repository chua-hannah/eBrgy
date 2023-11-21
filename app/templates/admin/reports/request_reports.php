<div class="container-fluid">
<ul class="nav nav-tabs" id="myTabs" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="tab1-tab" data-toggle="tab" href="#tab1" role="tab" aria-controls="tab1" aria-selected="true">Blotter / Complaint Report</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="tab2-tab" data-toggle="tab" href="#tab2" role="tab" aria-controls="tab2" aria-selected="false">Document Report</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="tab3-tab" data-toggle="tab" href="#tab3" role="tab" aria-controls="tab3" aria-selected="false">Schedule Report</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="tab4-tab" data-toggle="tab" href="#tab4" role="tab" aria-controls="tab4" aria-selected="false">Materials Report</a>
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
                            <th class="wrap-text">Reported Person</th>
                            <th class="wrap-text">Username</th>
                            <th class="wrap-text">Fullname</th>
                            <th class="wrap-text">Email</th>
                            <th class="wrap-text">Mobile</th>
                            <th class="wrap-text">Status</th>
                            <th class="wrap-text">Created at</th>
                            <th class="wrap-text">Proccessed at</th>
                            <th class="wrap-text">Processed by</th>
                            <th class="wrap-text">Message</th>

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
                                <td><?php echo strtoupper($reklamoReport['status']); ?></td>
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
                            <th class="wrap-text">Document Name</th>
                            <th class="wrap-text">Username</th>
                            <th class="wrap-text">Fullname</th>
                            <th class="wrap-text">Email</th>
                            <th class="wrap-text">Mobile</th>
                            <th class="wrap-text">Status</th>
                            <th class="wrap-text">Created at<br />(YY-MM-DD)</th>
                            <th class="wrap-text">Proccess at</th>
                            <th class="wrap-text">Process by</th>
                            <th class="wrap-text">Message</th>

                        </tr>
                    </thead>
                    <tbody class="text-center">
                        <?php
                        foreach ($docReports['documents'] as $docReport) {
                            ?>
                            <tr>
                                <td><?php echo strtoupper($docReport['request_name']); ?></td>
                                <td><?php echo $docReport['username']; ?></td>
                                <td><?php echo $docReport['firstname'] . ' ' . $docReport['middlename'] . ' ' . $docReport['lastname']; ?></td>

                                <td><?php echo $docReport['email']; ?></td>
                                <td><?php echo $docReport['mobile']; ?></td>
                                <td><?php echo strtoupper($docReport['status']); ?></td>
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
                                <th class="wrap-text">Username</th>
                                <th class="wrap-text">Mobile</th>
                                <th class="wrap-text">Fullname</th>
                                <th class="wrap-text">Schedule Date</th>
                                <th class="wrap-text">Time in</th>
                                <th class="wrap-text">Time out </th>
                                <th class="wrap-text">Status</th>
                                <th class="wrap-text">Created at</th>
                                <th class="wrap-text">Proccess at</th>
                                <th class="wrap-text">Process by</th>
                              

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
                                    <td><?php echo strtoupper($scheduleReport['status']); ?></td>
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
                                <th class="wrap-text">Material name</th>
                                <th class="wrap-text">Quantity</th>
                                <th class="wrap-text">Username</th>
                                <th class="wrap-text">Fullname</th>
                                <th class="wrap-text">Request Date</th>
                                <th class="wrap-text">Initial Proccess at</th>
                                <th class="wrap-text">End Proccess at</th>
                                <th class="wrap-text">Initial Process by</th>
                                <th class="wrap-text">End Process by</th>
                                <th class="wrap-text">Status </th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            <?php
                            foreach ($equipmentReports['equipments'] as $equipmentReport) {
                                ?>
                                <tr>
                                    <td><?php echo strtoupper($equipmentReport['equipment_name']); ?></td>
                                    <td><?php echo $equipmentReport['total_equipment_borrowed']; ?></td>
                                    <td><?php echo $equipmentReport['username']; ?></td>
                                    <td><?php echo $equipmentReport['firstname'] . ' ' . $equipmentReport['middlename'] . ' ' . $equipmentReport['lastname']; ?></td>
                                    <td><?php echo $equipmentReport['request_date']; ?></td>
                                    <td><?php echo $equipmentReport['process_at']; ?></td>
                                    <td><?php echo $equipmentReport['returned_at']; ?></td>
                                    <td><?php echo $equipmentReport['process_by']; ?></td>
                                    <td><?php echo $equipmentReport['process_return']; ?></td>
                                    <td><?php echo $equipmentReport['status']; ?></td>
                                </tr>
                                <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
        <!-- Content in the left side of the row (if any) -->
        </div>
        <div class="col">
        <div class="d-flex justify-content-end mt-4">
            <button id="printTableButton">Print Table</button>
        </div>
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
    var tabLabel = activeTab.textContent.trim(); // Get the text content of the active tab and remove leading/trailing spaces
    var tabContentId = activeTab.getAttribute('href').substring(1); // Get the tab content ID

    var tableToPrint = document.getElementById(tabContentId).querySelector('table'); // Get the table in the active tab
    var username = "<?php echo $_SESSION['username']; ?>"; // Get the username from the PHP session

    // Apply CSS styles to add borders, center text in cells, and other styling
    tableToPrint.style.borderCollapse = "collapse";
    tableToPrint.style.border = "1px solid #000";
    tableToPrint.style.textAlign = "center"; // Center align the text in cells

    var newWin = window.open('', '', 'width=600,height=600');
    newWin.document.open();
    newWin.document.write('<html><head><style>table {border-collapse: collapse; text-align: center;} table, th, td {border: 1px solid #000; text-align: center;} .header {text-align: center; font-weight: bold; margin-top: 60px;} </style></head><body>');

    newWin.document.write('<div class="header">');
    newWin.document.write('<p class="fw-bold">REPUBLIC OF THE PHILIPPINES</p>');
    newWin.document.write('<p>City of Manila</p>');
    newWin.document.write('<p>OFFICE OF THE BARANGAY CHAIRMAN</p>');
    newWin.document.write('<p>BARANGAY 95 - ZONE 8 DISTRICT 1</p>');
    newWin.document.write('<p>TELEPHONE NO. 08-294-47-66</p>');
    newWin.document.write('</div>');
    newWin.document.write('<h3 style="text-align: center; margin-top: 24px;">' + tabLabel + '</h3>');
    newWin.document.write('<p>Printed by: ' + username + '</p>'); // Add "printed by" note with the username

    // Get the table's content dynamically
    var tableRows = tableToPrint.getElementsByTagName('tr');

    // Add column headers
    var headerRow = tableRows[0];
    newWin.document.write('<table>');
    newWin.document.write('<tr>');
    newWin.document.write('<th>#</th>'); // Add Row Number header
    var headerCells = headerRow.getElementsByTagName('th');
    for (var h = 0; h < headerCells.length; h++) {
        newWin.document.write('<th>' + headerCells[h].innerHTML + '</th>');
    }
    newWin.document.write('</tr>');

    // Print the table, including all pages, with row numbers
    for (var i = 1; i < tableRows.length; i++) {
        newWin.document.write('<tr>');
        newWin.document.write('<td>' + i + '</td>'); // Add Row Number
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