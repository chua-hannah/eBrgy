<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="health-information">Health Information</a></li>
        <li class="breadcrumb-item active" aria-current="page"><?php echo $usersHealthInfo['firstname']; ?>'s Health Info</li>
    </ol>
</nav>
<div class="container-fluid edit-user">
    <h5>Health Information</h5>
    <form method="post" class="custom-form" action="">
        <input type="hidden" name="id" value="<?php echo isset($usersHealthInfo['id']) ? $usersHealthInfo['id'] : ''; ?>">
        <table class="table table-bordered">
            <?php
            if ($usersHealthInfo !== null) {
                // $healthInfoColumns should contain the column names fetched from your database
                $healthInfoColumns = array_keys($usersHealthInfo);

                foreach ($healthInfoColumns as $column) {
                    $value = isset($usersHealthInfo[$column]) ? $usersHealthInfo[$column] : '';
                    echo "<tr>
                            <th class='wrap-text text-center'>$column:</th>
                            <td><input type='text' class='form-control mb-0' name='$column' value='$value'></td>
                        </tr>";
                }
            } else {
                echo '<script>window.location.href = "health-information";</script>';
            }
            ?>
        </table>
        <button type="submit" class="form-control" name="save_health" id="saveButton">Save Changes</button>
    </form>
</div>





    <!--Additional div for sidebar-->
    </div>
    </div>
</div>
