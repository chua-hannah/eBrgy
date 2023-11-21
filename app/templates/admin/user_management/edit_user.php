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
        <div class="row justify-content-center">
            <div class="col-md-4 mb-3">
                <p class="card-text"><strong>Registered username:</strong> <?php echo $userData['username']; ?></p>
            </div>
            <div class="col-md-4 mb-3">
                <p class="card-text"><strong>Account Status:
                <?php
                $status = strtoupper($userData['status']);
                $colorClass = '';

                switch ($status) {
                    case 'DEACTIVATED':
                        $colorClass = 'text-danger';
                        break;
                    case 'PENDING':
                        $colorClass = 'text-warning';
                        break;
                    case 'ACTIVATED':
                        $colorClass = 'text-success';
                        break;
                    default:
                        // Handle other statuses if needed
                        break;
                }
                ?>

                <span class="<?php echo $colorClass; ?>"><?php echo strtoupper($status); ?></strong></soan>
            </div>
            <div class="col-md-4 text-end">
                <div class="mb-3" style="display: flex;">
                    <!-- Activation/Deactivation form -->
                    <?php echo $userData['status'] === 'activated' ? 
                    '<div>
                       <button type="button" class="form-control custom-button" data-bs-toggle="modal" data-bs-target="#registrationModal" style="background: grey;">
                       Deactivate user
                       </button>
                    </div>' : 
                    '<div><button type="button" class="form-control custom-button" data-bs-toggle="modal" data-bs-target="#activateModal">
                        Activate user
                    </button></div>';
                    ?>
                    <form method="post" action="">
                    <input type="hidden" name="user_id" value="<?php echo $userData['user_id'] ?>">
                    <div style="display: flex;">
                        <div>
                        <button type="button" class="form-control custom-button" data-bs-toggle="modal" data-bs-target="#deleteModal" style="background: #DC3545;">
                            Delete user
                        </button>
                        </div>
                        <?php echo $userData['position'] != NULL ? 
                            '<div><button type="button" class="form-control custom-button" data-bs-toggle="modal" data-bs-target="#removeOfficial" style="background: black;">
                            Remove Official
                        </button></div>
                       ' : '';
                        ?>
                    </div>
                    </form>
                </div>
            </div>
            <div class="col-md-12 mb-3">
            <p class="card-text">
                <strong>Position:</strong>
                <?php
                if ($userData['role']==="residence") {
                    echo $userData['role'];
                } else {
                    echo $userData['position'];
                }
                ?>
            </p>
            </div>
            <hr>
            <div class="col-md-4">
                <div class="mb-3">
                    <p class="card-text"><strong>First Name:</strong> <?php echo $userData['firstname']; ?></p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="mb-3">
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
            <div class="col-md-12">
                <div class="mb-3">
                    <p class="card-text"><strong>Is 4P's member?</strong> <?php echo $userData['four_ps'] == 1 ? 'YES' : 'NO'; ?></p>
                </div>
                <div class="mb-3">
                    <p class="card-text"><strong>Is PWD?</strong> <?php echo $userData['pwd'] == 1 ? 'YES' : 'NO'; ?></p>
                </div>
                <div class="mb-3">
                    <p class="card-text"><strong>Is Solo Parent?</strong> <?php echo $userData['solo_parent'] == 1 ? 'YES' : 'NO'; ?></p>
                </div>
                <div class="mb-3">
                    <p class="card-text"><strong>Is Scholar?</strong> <?php echo $userData['scholar'] == 1 ? 'YES' : 'NO'; ?></p>
                </div>
            </div>
        </div>
        <div id="imageModal" class="modal-img">
            <span class="close" id="closeModal">&times;</span>
            <img class="modal-img-content" id="modalImage">
        </div>
        <div class="row mt-3">
            <!-- Display the ID Selfie image -->
            <div class="col-md-6">
                <?php
                $idSelfiePath = 'uploads/id_selfie/' . $userData['id_selfie'];
                if (!empty($userData['id_selfie']) && file_exists($idSelfiePath)) {
                ?>
                <div class="text-center">
                    <img
                    src="<?php echo './' . $idSelfiePath; ?>"
                    alt="ID Selfie"
                    class="img-thumbnail"
                    style="width: 240px; cursor: pointer;"
                    onclick="openModal('<?php echo './' . $idSelfiePath; ?>')"
                    >
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
                    <img
                    src="<?php echo './' . $validIdPath; ?>"
                    alt="Valid ID"
                    class="img-thumbnail"
                    style="width: 240px; cursor: pointer;"
                    onclick="openModal('<?php echo './' . $validIdPath; ?>')"
                    >
                    <p><strong>Valid ID</strong></p>
                </div>
                <?php } else { ?>
                <p>Valid ID not available</p>
                <?php } ?>
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

<!-- Bootstrap Modal -->
<div class="modal fade" id="registrationModal" tabindex="-1" aria-labelledby="registrationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="registrationModalLabel">Are you to deactivate this user <?php echo $userData['firstname'] . ' '. $userData['middlename'] . ' ' . $userData['lastname']; ?>?</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row d-flex justify-content-center align-items-center">
                        <div class="col-lg-12 col-12">
                                <div class="row g-2 mt-2">
                                    <div class="col-md-6 col-12">
                                        <button class="form-control cancel-button" data-bs-dismiss="modal">Cancel</button>
                                    </div>
                                    <div class="col-md-6 col-12">
                                    <form class="custom-form mb-4 align-items-center needs-validation" action="" method="post">
                                    <input type="hidden" name="user_id" value="<?php echo $userData['user_id']; ?>">
                                    <button name="deactivate_user" type="submit" class="form-control" style="background: grey;">
                                        Confirm
                                    </button>
                                    </form>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Bootstrap Modal -->
<div class="modal fade" id="activateModal" tabindex="-1" aria-labelledby="activateModal" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="activateModal">Are you sure to activate user <?php echo $userData['firstname'] . ' '. $userData['middlename'] . ' ' . $userData['lastname']; ?>?</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row d-flex justify-content-center align-items-center">
                        <div class="col-lg-12 col-12">
                                <div class="row g-2 mt-2">
                                    <div class="col-md-6 col-12">
                                        <button class="form-control cancel-button" data-bs-dismiss="modal">Cancel</button>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <form class="custom-form mb-4 align-items-center needs-validation" action="" method="post">
                                            <input type="hidden" name="user_id" value="<?php echo $userData['user_id']; ?>">
                                                <button name="activate_user" type="submit" class="form-control" style="background: #00796b;">
                                                    Activate
                                                </button>
                                        </form>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModal" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="activateModal">Are you sure to delete user <?php echo $userData['firstname'] . ' '. $userData['middlename'] . ' ' . $userData['lastname']; ?>?</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row d-flex justify-content-center align-items-center">
                        <div class="col-lg-12 col-12">
                                <div class="row g-2 mt-2">
                                    <div class="col-md-6 col-12">
                                        <button class="form-control cancel-button" data-bs-dismiss="modal">Cancel</button>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <form class="custom-form mb-4 align-items-center needs-validation" action="" method="post">
                                            <input type="hidden" name="user_id" value="<?php echo $userData['user_id']; ?>">
                                            <button name="delete_user" type="submit" class="form-control">
                                                Confirm
                                            </button>
                                        </form>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap Modal -->
<div class="modal fade" id="removeOfficial" tabindex="-1" aria-labelledby="removeOfficial" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="activateModal">Are you sure to remove <?php echo $userData['firstname'] . ' '. $userData['middlename'] . ' ' . $userData['lastname']; ?> as official?</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row d-flex justify-content-center align-items-center">
                        <div class="col-lg-12 col-12">
                                <div class="row g-2 mt-2">
                                    <div class="col-md-6 col-12">
                                    <button type="button" class="form-control cancel-button">Cancel</button>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <form class="custom-form mb-4 align-items-center needs-validation" action="" method="post">
                                            <input type="hidden" name="user_id" value="<?php echo $userData['user_id']; ?>">
                                            <button name="remove_official" type="submit"  class="form-control" style="background: black;">
                                                Remove as Official
                                            </button>
                                        </form>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    <!--Additional div for sidebar-->
    </div>
    </div>
</div>
<script>
  // Function to open the modal with the clicked image
  function openModal(imagePath) {
    var modal = document.getElementById('imageModal');
    var modalImage = document.getElementById('modalImage');
    modal.style.display = 'block';
    modalImage.src = imagePath;
  }

  // Function to close the modal
  function closeModal() {
    var modal = document.getElementById('imageModal');
    modal.style.display = 'none';
  }

  // Close the modal when clicking the close button
  var closeModalButton = document.getElementById('closeModal');
  closeModalButton.onclick = closeModal;

  // Close the modal when clicking outside the image
  window.onclick = function (event) {
    var modal = document.getElementById('imageModal');
    if (event.target == modal) {
      closeModal();
    }
  };
</script>e
