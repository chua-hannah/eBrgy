<?php
$username = isset($_POST['username']) ? $_POST['username'] : null;

// Ensure that userId is available as a variable
if ($username) {
    if ($username) {
        // Now, you can display the user data in a Bootstrap card format
        ?>
  <div>
</div>

<div class="container mt-5">
    <h1>Manage Document Request</h1>

    <div class="card">
    <div class="card-header text-center">
        Requestor Informations
    </div>
    <div class="card-body">
       
        <p class="card-text">Fullname: <?php echo $userData['firstname'] . ' ' . $userData['middlename'] . ' ' . $userData['lastname']; ?></p>
        <p class="card-text"> Mobile: <?php echo $userData['mobile']; ?></p>
        <p class="card-text"> Address: <?php echo $userData['address']; ?></p>
        <p class="card-text">Request: <?php echo $userData['request_name']; ?></p>
        <p class="card-text">Status: <?php echo $userData['status']; ?></p>
        <p class="card-text">Requested at: <?php echo $userData['created_at']; ?></p>
        <p class="card-text">Note: "<?php echo $userData['message']; ?>"</p>
        <?php echo $userData['status'] === 'approved' ? 
            '' : 
            '<form method="post" action="">
                <input type="hidden" name="doc_id" value="' . $userData['id'] . '">
                <input type="hidden" name="username" value="' . $userData['username'] . '">
                <button name="approve_doc" type="submit" class="btn btn-primary" style="padding: 8px;">
                   Approve
                </button>
            </form>';
        ?>
          <div>
        
        <form method="post" action="">
            <input type="hidden" name="doc_id" value="<?php echo $userData['id'] ?>">
            <input type="hidden" name="username" value="<?php echo $userData['username'] ?>">
            <button name="delete_doc" type="submit" class="btn btn-danger" style="padding: 8px;">
            Delete
            </button>
        </form>
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