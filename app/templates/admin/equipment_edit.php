<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="requests">Requests</a></li>
        <li class="breadcrumb-item"><a href="/eBrgy/app/requests-equipments">Equipments</a></li>
        <li class="breadcrumb-item active" aria-current="page"><?php echo $userData['username']; ?>'s Equipment Request</li>
    </ol>
</nav>
<?php

// Ensure that userId is available as a variable
if ($userData) {
    if ($userData) {
        // Now, you can display the user data in a Bootstrap card format
        ?>
  <div>
</div>

<div class="container-fluid edit-user">
    <div class="card">
        <div class="card-header">
            <h6 class="mb-0">Equipment Request Details</h6>
        </div>
        <div class="card-body">
        <div class="row justify-content-center">
            <div class="col-md-4 mb-3">
                <p class="card-text"><strong>Equipment: </strong><?php echo strtoupper($userData['equipment_name']); ?></p>
            </div>
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
                    case 'RETURNED':
                        $colorClass = 'text-primary';
                        break;        
                    default:
                        // Handle other statuses if needed
                        break;
                }
                ?>

                <span class="<?php echo $colorClass; ?>"><?php echo $status; ?></strong></span>
            </div>
            <div class="col-md-4 mb-3"></div>
            <div class="col-md-12 mb-3">
                <p class="card-text"><strong>Quantity:</strong> <?php echo $userData['total_equipment_borrowed']; ?></p>
            </div>
            <div class="col-md-12 mb-3">
                <p class="card-text"><strong>Return Date:</strong> <?php echo date('m/d/Y', strtotime($userData['return_date'])); ?></p>
            </div>
            <?php
            if ($status === "APPROVED" || $status === "REJECTED" || $status === "RETURNED") {
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
            <p class="card-text"><strong>Date and Time Requested:</strong> <?php echo date('m/d/Y h:i A', strtotime($userData['request_date'])); ?></p>
            </div>
            <div class="col-md-12 mb-3"></div>
            <div class="col-md-12 mb-3">
                <form method="post" action="">
                    <input type="hidden" name="id" value="<?php echo $userData['id']; ?>">
                    <input type="hidden" name="equipment_id" value="<?php echo $userData['equipment_id']; ?>">
                    <input type="hidden" name="username" value="<?php echo $userData['username']; ?>">
                        <?php if ($userData['status'] !== 'pending') { ?>
                        <p class="mb-3"><strong>Admin Remarks:</strong></p>
                        <textarea name="remarks" rows="2" class="form-control mb-3" id="remarks" <?php
                            echo ($userData['status'] === 'rejected' || $userData['status'] === 'returned' || !empty($userData['remarks'])) ? 'disabled' : '';
                        ?> required><?php echo $userData['remarks']; ?></textarea>
                    <?php } ?>

                    <p class="mb-3"><strong>Message to Requestor:</strong></p>
                    <textarea name="message" rows="2" class="form-control mb-3" id="message" <?php echo ($userData['status'] === 'pending') ? '' : 'disabled'; ?> required><?php echo $userData['message']; ?></textarea>

                    <?php if ($userData['status'] === 'approved' && !empty($userData['remarks'])) { ?>
                        <button name="returned_equipment" type="submit" class="btn btn-primary" style="padding: 8px;">Tag as Returned</button>
                    <?php } elseif ($userData['status'] === 'approved') { ?>
                        <button name="add_remarks" type="submit" class="btn btn-primary" style="padding: 8px; margin-right: 16px">Add Remarks</button>
                        <button name="cancel_equipment_request" type="submit" class="btn btn-warning" style="padding: 8px;">Cancel</button>
                    <?php } elseif ($userData['status'] === 'pending') { ?>
                        <button name="approve_equipment" type="submit" class="btn btn-primary" style="padding: 8px; margin-right: 16px">Approve</button>
                        <button name="delete_equipment" type="submit" class="btn btn-danger" style="padding: 8px;">Reject</button>
                    <?php } ?>
                </form>
            </div>
        </div>
    </div>

    </div>
</div>


    <?php
    } else {
        // Handle the case when the user with the provided userId is not found
        echo "Equipment not found!";
    }
} else {
    // Handle the case when userId is not provided
    echo "Equipment not provided!";
}
?>
    <!--Additional div for sidebar-->
    </div>
    </div>
</div>