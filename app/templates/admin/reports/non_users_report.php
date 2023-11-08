<div class="container-fluid">
<h3 class="mt-2 mb-2 text-center">Non Users Report</h3>
    <!-- Display counts here -->
    <div class="table-responsive">
    <h4 class="mt-2 mb-2">Demographic Information</h4>
        <table class="table table-bordered table-striped custom-table">
            <thead>
                <tr>
                    <th class="wrap-text">Total Senior Citizen</th>
                    <th class="wrap-text">Total PWD</th>
                    <th class="wrap-text">Total 4Ps</th>
                    <th class="wrap-text">Total Solo Parents</th>
                    <th class="wrap-text">Total Scholars</th>
                </tr>
            </thead>
            <tbody class="text-center">
                <td><?php echo $nonusersReports['seniorCount']; ?></td>
                <td><?php echo $nonusersReports['pwdCount']; ?></td>
                <td><?php echo $nonusersReports['fourPsCount']; ?></td>
                <td><?php echo $nonusersReports['soloParentCount']; ?></td>
                <td><?php echo $nonusersReports['scholarCount']; ?></td>
            </tbody>
        </table>
    </div>

    <div class="table-responsive">
    <h4 class="mt-2 mb-2">Resident Information</h4>
    <table class="table table-bordered table-striped custom-table datatable" id="myTable">
            <thead>
                <tr>
                    <th>Full name</th>
                    <th>Age</th>
                    <th>Mobile</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th>Birthday<br />(YY-MM-DD)</th>
                    <th>4PS</th>
                    <th>PWD</th>
                    <th>Solo Parent</th>
                    <th>Scholar</th>
                </tr>
            </thead>
            <tbody class="text-center">
                <?php
                foreach ($nonusersReports['users'] as $usersReport) {
                    ?>
                    <tr>
                        <td><?php echo $usersReport['firstname'] . ' ' . $usersReport['middlename'] . ' ' . $usersReport['lastname']; ?></td>
                        <td><?php echo $usersReport['age']; ?></td>
                        <td><?php echo $usersReport['mobile']; ?></td>
                        <td><?php echo $usersReport['email']; ?></td>
                        <td><?php echo $usersReport['address']; ?></td>
                        <td><?php echo $usersReport['birthdate']; ?></td>
                        <td><?php echo $usersReport['four_ps'] == 1 ? '&#10003;' : ''; ?></td>
                        <td><?php echo $usersReport['pwd'] == 1 ? '&#10003;' : ''; ?></td>
                        <td><?php echo $usersReport['solo_parent'] == 1 ? '&#10003;' : ''; ?></td>
                        <td><?php echo $usersReport['scholar'] == 1 ? '&#10003;' : ''; ?></td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
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


    <!--Additional div for sidebar-->
    </div>
    </div>
</div>
<script>
document.getElementById("printTableButton").addEventListener("click", function() {
    var table = $('#myTable').DataTable(); // Initialize DataTables on your table
    var username = "<?php echo $_SESSION['username']; ?>"; // Get the username from the PHP session
    var newWin = window.open('', '_blank', 'width=800,height=1100');
   
    newWin.document.open();
    newWin.document.write('<html><head><style>table {border-collapse: collapse; text-align: center;} table, th, td {border: 1px solid #000; text-align: center;} </style></head><body>');

    // Add a header above the table
    newWin.document.write('<h1>Users Report</h1>');
    newWin.document.write('<p>Printed by: ' + username + '</p>'); // Add "printed by" note with the username

    var tableData = table.data().toArray(); // Get all the data from DataTables

    newWin.document.write('<table>');

    // Add column headers, including the "Row Number" column
    var headerCells = $('#myTable thead th'); // Get column headers from the table
    newWin.document.write('<tr>');
    newWin.document.write('<th class="wrap-text">#</th>'); // Add Row Number header
    headerCells.each(function () {
        newWin.document.write('<th class="wrap-text">' + $(this).text() + '</th>');
    });
    newWin.document.write('</tr>');

    // Add data rows with row numbers
    tableData.forEach(function (dataRow, rowIndex) {
        newWin.document.write('<tr>');
        newWin.document.write('<td>' + (rowIndex + 1) + '</td>'); // Add Row Number
        dataRow.forEach(function (cellData) {
            newWin.document.write('<td>' + cellData + '</td>');
        });
        newWin.document.write('</tr>');
    });

    newWin.document.write('</table>');

    newWin.document.write('</body></html>');
    newWin.document.close();
    newWin.print();
    newWin.close();
});

</script>
