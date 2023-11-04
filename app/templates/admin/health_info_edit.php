<div class="card">
    <div class="card-header">
        <h5 class="card-title">Health Information</h5>
    </div>
    <div class="card-body">
        <button id="editButton" class="btn btn-primary">Edit</button>
        <form method="post" action="">
            <input type="hidden" name="id" value="<?php echo isset($usersHealthInfo['id']) ? $usersHealthInfo['id'] : ''; ?>">
            <button type="submit" class="btn btn-primary" name="save_health" id="saveButton">Save Changes</button>

            <table class="table table-bordered">
                <?php
                if ($usersHealthInfo !== null) {
                    // $healthInfoColumns should contain the column names fetched from your database
                    $healthInfoColumns = array_keys($usersHealthInfo);

                    // Iterate through columns to display them vertically
                    foreach ($healthInfoColumns as $column) {
                        $value = isset($usersHealthInfo[$column]) ? $usersHealthInfo[$column] : '';
                        echo "<tr><th>$column:</th><td><input type='text' name='$column' value='$value'></td></tr>";
                    }
                } else {
                    echo '<script>window.location.href = "health-information";</script>';
                }
                ?>
            </table>
        </form>
    </div>
</div>





    <!--Additional div for sidebar-->
    </div>
    </div>
</div>
