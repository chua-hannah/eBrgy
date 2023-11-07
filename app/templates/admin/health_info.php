<div class="container-fluid">
    <div style="float: right;">
        <button type="button" class="form-control custom-button" data-bs-toggle="modal" data-bs-target="#registrationModal" <?php if(!($_SESSION['role']=="captain")) { echo "hidden"; } ?>>
            <i class="bi bi-plus-square"></i> Add New Health Information
        </button>
    </div>
    <h3>Resident Health Information</h3>
    <!-- Bootstrap Modal -->
    <div class="modal fade" id="registrationModal" tabindex="-1" aria-labelledby="registrationModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="registrationModalLabel">Add new column</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row d-flex justify-content-center align-items-center">
                            <form class="custom-form" method="post" action="">
                                <div class="col-lg-12 col-12">
                                    <input type="text" name="new_column_name" class="form-control"  placeholder="New Column Name" required>
                                </div>
                                <div class="col-lg-12 col-12">
                                    <button type="submit" class="form-control" name="add_health_info_column">Add Column</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div>
    <div class="table-responsive">
        <table class="table table-bordered table-striped custom-table datatable">
            <thead>
                <tr>
                    <?php
                    foreach ($headers as $header) {
                        if ($header !== 'id') { // Exclude 'id' column
                            echo "<th class='wrap-text'>$header</th>";
                        }
                    }
                    echo "<th class='wrap-text'>Action</th>"; // Add "Action" column header
                    ?>
                </tr>
            </thead>
            <tbody class="text-center">
                <?php foreach ($healthInfos as $healthInfo): ?>
                    <tr>
                        <?php foreach ($healthInfo as $key => $value): ?>
                            <?php if ($key !== 'id') { // Exclude 'id' column
                                echo "<td id='$key'>$value</td>";
                            } ?>
                        <?php endforeach; ?>
                        <td>
                            <form method="post" action="edit-health-information">
                                <input type="hidden" name="id" value="<?php echo $healthInfo['id']; ?>">
                                <button type="submit" class="btn btn-primary" name="edit_health_info">Edit</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>

        </table>
    </div>
</div>

    <!--Additional div for sidebar-->
    </div>
    </div>
</div>




