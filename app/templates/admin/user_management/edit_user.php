<?php
$userId = isset($_POST['userId']) ? $_POST['userId'] : null;

// Ensure that userId is available as a variable
if ($userId) {
    // Fetch user data based on the userId from the users table (already retrieved in your controller)
    // $userData should contain the user information

    if ($userData) {
        // Now, you can display the user data in a Bootstrap card format
        ?>
    <div>
        User Management
    </div>

<div class="container mt-5">
    <h1>Edit User</h1>

    <div class="card">
    <div class="card-header">
        User Information
    </div>
    <div class="card-body">
        <h5 class="card-title">Username: <?php echo $userData['username']; ?></h5>
        <p class="card-text">Email: <?php echo $userData['email']; ?></p>
        <p class="card-text">Full Name: <?php echo $userData['firstname'] . ' ' . $userData['middlename'] . ' ' . $userData['lastname']; ?></p>
        <p class="card-text">Age: <?php echo $userData['age']; ?></p>
        <p class="card-text">Mobile: <?php echo $userData['mobile']; ?></p>
        <p class="card-text">Status: <?php echo $userData['status']; ?></p>

        <div class="row">
            <!-- Display the ID Selfie image -->
            <div class="col-md-6">
                <?php
                $idSelfiePath = 'uploads/id_selfie/' . $userData['id_selfie'];
                if (!empty($userData['id_selfie']) && file_exists($idSelfiePath)) {
                    ?>
                    <div class="text-center">
                        <img src="<?php echo './' . $idSelfiePath; ?>" alt="ID Selfie" class="img-thumbnail" style="width: 200px;">
                        <p>Selfie</p>
                    </div>
                <?php } else { ?>
                    <p>ID Selfie not available</p>
                <?php } ?>
            </div>

            <!-- Display the Valid ID image -->
            <div class="col-md-6">
                <?php
                $validIdPath = 'uploads/valid_id/' . $userData['valid_id'];
                if (!empty($userData['valid_id']) && file_exists($validIdPath)) {
                    ?>
                    <div class="text-center">
                        <img src="<?php echo './' . $validIdPath; ?>" alt="Valid ID" class="img-thumbnail" style="width: 200px;">
                        <p>Valid ID</p>
                    </div>
                <?php } else { ?>
                    <p>Valid ID not available</p>
                <?php } ?>
            </div>
        </div>
        <div>         
        <!-- Activation/Deactivation form -->
        <?php echo $userData['status'] === 'activated' ? 
            '<div><form method="post" action="">
                <input type="hidden" name="user_id" value="' . $userData['user_id'] . '">
                <button name="deactivate_user" type="submit" class="btn btn-danger" style="padding: 8px;">
                   Deactivate
                </button>
            </form>' : 
            '<form method="post" action="">
                <input type="hidden" name="user_id" value="' . $userData['user_id'] . '">
                <button name="activate_user" type="submit" class="btn btn-success" style="padding: 8px;">
                   Activate
                </button>
            </form>
            </div>';
        ?>
       <div>
        
            <form method="post" action="">
                <input type="hidden" name="user_id" value="<?php echo $userData['user_id'] ?>">
                <button name="delete_user" type="submit" class="btn btn-danger" style="padding: 8px;">
                Delete
                </button>
            </form>
        </div>
        </div>
       
</div>
    
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