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
    <h1>Manage Equipment Request</h1>

    <div class="card">
    <div class="card-header text-center">
        Requestor Informations
    </div>
    <div class="card-body">
       
        <p class="card-text">Fullname: <?php echo $userData['firstname'] . ' ' . $userData['middlename'] . ' ' . $userData['lastname']; ?></p>
        <p class="card-text"> Address: <?php echo $userData['address']; ?></p>
        <p class="card-text">Request: <?php echo $userData['equipment_name']; ?></p>
        <p class="card-text">Status: <?php echo $userData['status']; ?></p>
        <p class="card-text">Quantity: <?php echo $userData['total_equipment_borrowed']; ?></p>
        <p class="card-text">Durations(days): <?php echo $userData['days']; ?></p>
        <p class="card-text">Requested at: <?php echo $userData['request_date']; ?></p>
        <form method="post" action="">
            <input type="hidden" name="equipment_id" value="<?php echo $userData['id']; ?>">
            <input type="hidden" name="username" value="<?php echo $userData['username']; ?>">
            <label for="remarks">Remarks:</label>
            <textarea name="remarks" rows="2" class="form-control mb-4" id="remarks" <?php echo ($userData['status'] === 'pending' || !empty($userData['remarks'])) ? 'disabled' : ''; ?> value="<?php echo $userData['remarks']; ?>" required><?php echo $userData['remarks']; ?></textarea>
            <label for="message">Message:</label>
            <textarea name="message" rows="2" class="form-control mb-4" id="message" <?php echo ($userData['status'] === 'approved') ? 'disabled' : ''; ?> value="<?php echo $userData['message']; ?>" required><?php echo $userData['message']; ?></textarea>

            <?php if ($userData['status'] === 'approved' && !empty($userData['remarks'])) { ?>
                <button name="returned_equipment" type="submit" class="btn btn-warning" style="padding: 8px;">Returned</button>
            <?php } elseif ($userData['status'] === 'approved') { ?>
                <button name="add_remarks" type="submit" class="btn btn-primary" style="padding: 8px;">Add Remarks</button>
                <button name="delete_equipment" type="submit" class="btn btn-danger" style="padding: 8px;">Delete</button>
            <?php } elseif ($userData['status'] === 'pending') { ?>
                <button name="approve_equipment" type="submit" class="btn btn-primary" style="padding: 8px;">Approve Equipment</button>
                <button name="delete_equipment" type="submit" class="btn btn-danger" style="padding: 8px;">Delete</button>
            <?php } ?>

            


           
        </form>


          <div>
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