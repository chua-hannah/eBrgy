<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="requests">Manage Requests</a></li>
        <li class="breadcrumb-item"><a href="/eBrgy/app/requests-documents">Documents</a></li>
        <li class="breadcrumb-item active" aria-current="page"><?php echo $userData['username']; ?>'s Document Request</li>
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
    <h5>Manage Document Request</h5>
    <div class="card">
        <div class="card-header">
            <h6 class="mb-0">Document Request Details</h6>
        </div>
        <div class="card-body">
            <div class="row justify-content-center">
                <div class="col-md-4 mb-3">
                    <p class="card-text"><strong>Document Type: </strong><?php echo strtoupper($userData['request_name']); ?></p>
                </div>
                <div class="col-md-4 mb-3">
                    <p class="card-text"><strong>Status:
                        <?php
                        if (strtoupper($userData['status']) === 'PENDING') {
                            echo '<span class="text-warning">' . strtoupper($userData['status']) . '</span>';
                        }
                        else if (strtoupper($userData['status']) === 'REJECTED') {
                            echo '<span class="text-danger">' . strtoupper($userData['status']) . '</span>';
                        } else {
                            echo '<span class="text-success">' . strtoupper($userData['status']) . '</span>';
                        }
                        ?>
                        </strong>
                    </p>
                </div>
                <div class="col-md-4 mb-3"></div>
                <div class="col-md-12 mb-3">
                    <p class="card-text"><strong>Purpose / Remarks:</strong>
                    <?php
                    if (empty($userData['message'])) {
                        echo "-";
                    } else {
                        echo "{$userData['message']}</p>";
                    }
                    ?>
                </div>
                <div class="col-md-12 mb-3">
                    <p class="card-text"><strong>Additional Remarks:</strong>
                    <?php
                    if (empty($userData['purpose'])) {
                        echo "-";
                    } else {
                        echo "{$userData['purpose']}</p>";
                    }
                    ?>
                </div>
                <?php
                $status = strtoupper($userData['status']);
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
                }
                ?>
                <div class="col-md-12 mb-3"></div>
                <h6 class="mb-3">Requestor Details</h6>
                <div class="col-md-4 mb-3">
                    <p class="card-text"><strong>First Name:</strong> <?php echo $userData['firstname']; ?></p>
                </div>
                <div class="col-md-4 mb-3">
                    <p class="card-text"><strong>Middle Name:</strong>
                    <?php
                        if (empty($userData['middlename'])) {
                            echo "-";
                        } else {
                            echo $userData['middlename'];
                        }
                    ?>
                    </p>
                </div>
                <div class="col-md-4 mb-3">
                    <p class="card-text"><strong>Last Name:</strong> <?php echo $userData['lastname']; ?></p>
                </div>
                <div class="col-md-4 mb-3">
                    <p class="card-text"><strong>Address:</strong> <?php echo $userData['address']; ?></p>
                </div>
                <div class="col-md-4 mb-3">
                    <p class="card-text"><strong>Mobile:</strong> <?php echo $userData['mobile']; ?></p>
                </div>
                <div class="col-md-4 mb-3">
                    <p class="card-text"><strong>Email:</strong> <?php echo $userData['email']; ?></p>
                </div>
                <div class="col-md-12 mb-3">
                    <p class="card-text"><strong>Date and Time Requested:</strong> <?php echo date('m/d/Y h:i A', strtotime($userData['created_at'])); ?></p>
                </div>
                <div class="col-md-10"></div>
                <div class="col-md-1">
                    <?php
                    if ($userData['status'] === "pending") {
                        echo '<form method="post" action="">
                            <input type="hidden" name="doc_id" value="' . $userData['id'] . '">
                            <input type="hidden" name="username" value="' . $userData['username'] . '">
                            <button name="approve_doc" type="submit" class="btn btn-primary" style="padding: 8px; margin-right: 16px">
                                Approve
                            </button>
                        </form>';
                    }
                    ?>
                </div>            
                <div class="col-md-1">
                <?php if ($userData['status'] === 'pending') { ?>
                    <form method="post" action="">
                        <input type="hidden" name="doc_id" value="<?php echo $userData['id']; ?>">
                        <input type="hidden" name="username" value="<?php echo $userData['username']; ?>">
                        <button name="delete_doc" type="submit" class="btn btn-danger" style="padding: 8px;">
                            Reject
                        </button>
                    </form>
                <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>


    <?php
    } else {
        // Handle the case when the user with the provided userId is not found
        echo "Document not found!";
    }
} else {
    // Handle the case when userId is not provided
    echo "Document not provided!";
}
?>
    <!--Additional div for sidebar-->
    </div>
    </div>
</div>