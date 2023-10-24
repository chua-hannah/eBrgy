<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="user-management">User Management</a></li>
        <li class="breadcrumb-item active" aria-current="page">Edit User</li>
    </ol>
</nav>
<?php
$userId = isset($_POST['userId']) ? $_POST['userId'] : null;

// Ensure that userId is available as a variable
if ($userId) {
    // Fetch user data based on the userId from the users table (already retrieved in your controller)
    // $userData should contain the user information

    if ($userData) {
        // Now, you can display the user data in a Bootstrap card format
        ?>

<div class="container-fluid edit-user">

    <div class="card">
    <div class="card-header text-center">
        <h6 class="mb-0">User Information</h6>
    </div>


    <div class="card-body">
        <div class="row">
            <div class="col-md-4">
                <div class="mb-3">
                    <p class="card-text"><strong>Registered username:</strong> <?php echo $userData['username']; ?></p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="mb-3">
                <strong>Account Status: 
                    <span class="card-text 
                        <?php 
                            if ($userData['status'] === 'activated') {
                                echo 'text-success';
                            } elseif ($userData['status'] === 'pending') {
                                echo 'text-warning';
                            } else {
                                echo 'text-danger';
                            }
                        ?>">
                        <?php echo strtoupper($userData['status']); ?>
                    </span>
                </strong>
                </div>
            </div>
            <div class="col-md-4 text-end">
                <div class="mb-3">
                    <!-- Activation/Deactivation form -->
                    <?php echo $userData['status'] === 'activated' ? '<div><form method="post" action="">
                        <input type="hidden" name="user_id" value="' . $userData['user_id'] . '">
                        <button name="deactivate_user" type="submit" class="btn btn-danger btn-md">
                            Deactivate
                        </button>
                    </form></div>' : '<form method="post" action="">
                        <input type="hidden" name="user_id" value="' . $userData['user_id'] . '">
                        <button name="activate_user" type="submit" class="btn btn-success btn-md">
                            Activate user
                        </button>
                    </form>';
                    ?>
                </div>
            </div>
            <div class="col-md-4">
                <div class="mb-3">
                    <p class="card-text"><strong>First Name:</strong> <?php echo $userData['firstname']; ?></p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="mb-3">
                    <p class="card-text"><strong>Middle Name:</strong> <?php echo $userData['middlename']; ?></p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="mb-3">
                    <p class="card-text"><strong>Last Name:</strong> <?php echo $userData['lastname']; ?></p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="mb-3">
                    <p class="card-text"><strong>Birthday:</strong> <?php echo $userData['birthdate']; ?></p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="mb-3">
                    <p class="card-text"><strong>Age:</strong> <?php echo $userData['age']; ?></p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="mb-3">
                    <p class="card-text"><strong>Gender:</strong> <?php echo strToUpper($userData['sex']); ?></p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="mb-3">
                    <p class="card-text"><strong>Mobile:</strong> <?php echo $userData['mobile']; ?></p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="mb-3">
                    <p class="card-text"><strong>Email:</strong> <?php echo $userData['email']; ?></p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="mb-3">
                    <p class="card-text"><strong>House No./Bldg./Street Name:</strong> <?php echo $userData['address']; ?></p>
                </div>
            </div>
        </div>
        
        <div class="row">
            <!-- Display the ID Selfie image -->
            <div class="col-md-6">
                <?php
                $idSelfiePath = 'uploads/id_selfie/' . $userData['id_selfie'];
                if (!empty($userData['id_selfie']) && file_exists($idSelfiePath)) {
                    ?>
                    <div class="text-center">
                        <img src="<?php echo './' . $idSelfiePath; ?>" alt="ID Selfie" class="img-thumbnail" style="width: 200px;">
                        <p><strong>Selfie w/ Valid ID</strong></p>
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
                        <p><strong>Valid ID</strong></p>
                    </div>
                <?php } else { ?>
                    <p>Valid ID not available</p>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
<div class="mb-4"></div>
<div class="row">
    <div class="col-md-10"></div>
    <div class="col-md-2 text-end">
        <div class="mb-3">
            <form method="post" action="">
                <input type="hidden" name="user_id" value="<?php echo $userData['user_id'] ?>">
                <button name="delete_user" type="submit" class="btn btn-danger btn-md">
                    Delete user
                </button>
            </form>
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