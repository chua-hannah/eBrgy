<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="requests">Requests</a></li>
        <li class="breadcrumb-item active" aria-current="page">Manage Document Request</li>
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

    <div class="card">
    <div class="card-header text-center">
        <h6 class="mb-0">Document request details</h6>
    </div>
    <div class="card-body">
        <div class="row">
        <div class="col-md-4 mb-3">
            <p class="card-text"><strong>First Name:</strong> <?php echo $userData['firstname']; ?></p>
        </div>
        <div class="col-md-4 mb-3">
            <p class="card-text"><strong>Middle Name:</strong> <?php echo $userData['middlename']; ?></p>
        </div>
        <div class="col-md-4 mb-3">
            <p class="card-text"><strong>Last Name:</strong> <?php echo $userData['lastname']; ?></p>
        </div>
        <div class="col-md-4 mb-3">
            <p class="card-text"><strong>Mobile:</strong> <?php echo $userData['mobile']; ?></p>
        </div>
        <div class="col-md-4 mb-3">
            <p class="card-text"><strong>Address:</strong> <?php echo $userData['address']; ?></p>
        </div>
        <div class="col-md-4 mb-3">
            <p class="card-text"><strong>Request:</strong> <?php echo $userData['request_name']; ?></p>
        </div>
        <div class="col-md-4 mb-3">
            <p class="card-text"><strong>Status:</strong>
                <?php
                if (strtoupper($userData['status']) === 'PENDING') {
                    echo '<span class="text-warning">' . strtoupper($userData['status']) . '</span>';
                } else {
                    echo strtoupper($userData['status']);
                }
                ?>
            </p>
        </div>
        <div class="col-md-4 mb-3">
            <p class="card-text"><strong>Requested at:</strong> <?php echo date('m/d/Y h:i A', strtotime($userData['created_at'])); ?></p>
        </div>
        <div class="col-md-4 mb-3">
            <p class="card-text"><strong>Remarks:</strong> "<?php echo $userData['message']; ?>"</p>
        </div>
        <div class="col-md-10"></div>
        <div class="col-md-1">
            <?php
            if ($userData['status'] !== 'approved') {
                echo '<form method="post" action="">
                    <input type="hidden" name="doc_id" value="' . $userData['id'] . '">
                    <input type="hidden" name="username" value="' . $userData['username'] . '">
                    <button name="approve_doc" type="submit" class="btn btn-primary" style="padding: 8px;">
                        Approve
                    </button>
                </form>';
            }
            ?>
        </div>            
        <div class="col-md-1">
            <form method="post" action="">
                <input type="hidden" name="doc_id" value="<?php echo $userData['id']; ?>">
                <input type="hidden" name="username" value="<?php echo $userData['username']; ?>">
                <button name="delete_doc" type="submit" class="btn btn-danger" style="padding: 8px;">
                    Reject
                </button>
            </form>
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