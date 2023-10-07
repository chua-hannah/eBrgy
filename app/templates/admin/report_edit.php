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
    <h1>Manage Report</h1>

    <div class="card">
    <div class="card-header text-center">
        Report Information
    </div>
    <div class="card-body">
       
        <p class="card-text">Informant: <?php echo $userData['firstname'] . ' ' . $userData['middlename'] . ' ' . $userData['lastname']; ?></p>
        <p class="card-text">Informant mobile: <?php echo $userData['mobile']; ?></p>
        <p class="card-text">Informant Address: <?php echo $userData['address']; ?></p>
        <p class="card-text">Reported Person: <?php echo $userData['reported_person']; ?></p>
        <p class="card-text">Issue: <?php echo $userData['subject_person']; ?></p>
        <p class="card-text">Place of Incident: <?php echo $userData['place_of_incident']; ?></p>
        <p class="card-text">Time of Incident: <?php echo $userData['time_of_incident']; ?></p>
        <p class="card-text">Reported at: <?php echo $userData['created_at']; ?></p>
        <p class="card-text">Process at: <?php echo $userData['process_at']; ?></p>
        <p class="card-text">Process by: <?php echo $userData['process_by']; ?></p>

        <p class="card-text">Note: "<?php echo $userData['note']; ?>"</p>
        <p class="card-text" style="color: #ffae00;"> <?php echo $userData['status']; ?></p>

    

        <!-- Activation/Deactivation form -->
        <?php echo $userData['status'] === 'activated' ? 
            '<form method="post" action="">
                <input type="hidden" name="username" value="' . $userData['username'] . '">
                <button name="deactivate_user" type="submit" class="btn btn-danger" style="padding: 8px;">
                   Deactivate
                </button>
            </form>' : 
            '<form method="post" action="">
                <input type="hidden" name="username" value="' . $userData['username'] . '">
                <button name="activate_user" type="submit" class="btn btn-success" style="padding: 8px;">
                   Activate
                </button>
            </form>';
        ?>
    </div
</div>


    <?php
    } else {
        // Handle the case when the user with the provided userId is not found
        echo "User not found!";
    }
} else {
    // Handle the case when userId is not provided
    echo "User ID not provided!";
}
?>
    <!--Additional div for sidebar-->
    </div>
    </div>
</div>