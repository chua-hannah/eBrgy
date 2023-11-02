<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="requests">Requests</a></li>
        <li class="breadcrumb-item"><a href="requests-reports">Reports</a></li>
        <li class="breadcrumb-item active" aria-current="page"><?php echo $userData['username']; ?>'s Submitted Report</li>
    </ol>
</nav>
<?php
$username = isset($_POST['username']) ? $_POST['username'] : null;

// Ensure that userId is available as a variable
if ($username) {
    if ($username) {
        // Now, you can display the user data in a Bootstrap card format
        ?>
  <div>
</div>

<div class="container-fluid edit-user">
    <h5>Manage Report / Complaint Request</h5>
    <div class="card">
        <div class="card-header">
            <h6 class="mb-0">Report Information</h6>
        </div>
        <div class="card-body">
            <div class="row justify-content-center">
                <div class="col-md-4 mb-3">
                    <p class="card-text"><strong>Status:
                    <?php
                    $status = strtoupper($userData['status']);
                    $colorClass = '';

                    switch ($status) {
                        case 'REJECTED':
                            $colorClass = 'text-danger';
                            break;
                        case 'PENDING':
                            $colorClass = 'text-warning';
                            break;
                        case 'APPROVED':
                            $colorClass = 'text-success';
                            break;
                        default:
                            // Handle other statuses if needed
                            break;
                    }
                    ?>

                    <span class="<?php echo $colorClass; ?>"><?php echo $status; ?></strong></span>
                </div>
                <div class="col-md-8 mb-3"></div>
                <?php
                if ($status === "APPROVED" || $status === "REJECTED") {
                    echo '<div class="col-md-12 mb-3">';
                    echo '<p class="card-text"><strong>Processed by: </strong>';
                    if (empty($userData['process_by'])) {
                        echo "-";
                    } else {
                        echo $userData['process_by'];
                    }
                    echo '</p>';
                    echo '</div>';
                    echo '<div class="col-md-12 mb-3">';
                    echo '<p class="card-text"><strong>Processed at (Date & Time): </strong>';
                    if (empty($userData['process_at'])) {
                        echo "-";
                    } else {
                        echo date('m/d/Y h:i A', strtotime($userData['process_at']));
                    }
                    echo '</p>';
                    echo '</div>';
                    echo '<div class="col-md-12 mb-3"></div>';
                }
                ?>
                <h6 class="mb-3">Informant Details</h6>
                <div class="col-md-4 mb-3">
                    <p class="card-text"><strong>Informant Name:</strong> <?php echo $userData['firstname'] . ' ' . $userData['middlename'] . ' ' . $userData['lastname']; ?></p>
                </div>
                <div class="col-md-4 mb-3">
                    <p class="card-text"><strong>Informant Mobile:</strong> <?php echo $userData['mobile']; ?></p>
                </div>
                <div class="col-md-4 mb-3">
                    <p class="card-text"><strong>Informant Address:</strong> <?php echo $userData['address']; ?></p>
                </div>
                <h6 class="mb-3">Submitted Report Details</h6>
                <div class="col-md-12 mb-3">
                    <p class="card-text"><strong>Requested at:</strong> <?php echo date('m/d/Y h:i A', strtotime($userData['created_at'])); ?></p>
                </div>
                <div class="col-md-12 mb-3">
                    <p class="card-text"><strong>Reported Person:</strong>
                        <?php
                        if (empty($userData['reported_person'])) {
                            echo '-';
                        } else {
                            echo $userData['reported_person'];
                        }
                        ?>
                    </p>
                </div>
                <div class="col-md-12 mb-3">
                    <p class="card-text"><strong>Place of Incident:</strong> <?php echo $userData['place_of_incident']; ?></p>
                </div>
                <div class="col-md-12 mb-3">
                    <p class="card-text"><strong>Date of Incident:</strong> <?php echo date('m/d/Y', strtotime($userData['date_of_incident'])); ?></p>
                </div>
                <div class="col-md-12 mb-3">
                    <p class="card-text"><strong>Time of Incident:</strong> <?php echo date('h:i A', strtotime($userData['time_of_incident'])); ?></p>
                </div>
                <div class="col-md-12 mb-3">
                    <p class="card-text"><strong>Subject:</strong> <?php echo $userData['subject_person']; ?></p>
                </div>
                <div class="col-md-12 mb-3">
                    <p class="card-text mb-0"><strong>Complaint:</strong></p> 
                    <p class="mt-0 mb-0"><?php echo $userData['note']; ?></p>
                </div>
                <div class="col-md-10"></div>
                <?php echo $userData['status'] === 'approved' ? 
                    '' : 
                    '<div class="col-md-1 mb-3">
                        <form method="post" action="">
                            <input type="hidden" name="report_id" value="' . $userData['id'] . '">
                            <button name="approve_report" type="submit" class="btn btn-primary" style="padding: 8px; margin-right: 16px">
                                Approve
                            </button>
                        </form>
                    </div>
                    <div class="col-md-1 mb-3">
                    <form method="post" action="">
                        <input type="hidden" name="report_id" value="' . $userData['id'] . '">
                        <button name="delete_report" type="submit" class="btn btn-danger" style="padding: 8px;">
                            Reject
                        </button>
                    </form>
                </div>';
                ?>
            </form>
          </div>
        </div>
    </div>
</div>


    <?php
    } else {
        // Handle the case when the user with the provided userId is not found
        echo "Report not found!";
    }
} else {
    // Handle the case when userId is not provided
    echo "Report not provided!";
}
?>
    <!--Additional div for sidebar-->
    </div>
    </div>
</div>