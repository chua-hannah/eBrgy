<?php
// Include the usersController class
require_once 'controllers/admin/UserManagementController.php';

// Retrieve user information from the database using usersController
$users = UserManagementController::user_management();
?>
<div class="container">
        <h2>User Management</h2>
        <button><a class="nav-link" href="user-management/add-user">+</a></button>
        <table class="table">
            <thead>
                <tr>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Fullname</th>
                    <th>Age</th>
                    <th>Sex</th>
                    <th>Role</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user) { ?>
                    <tr>
                        <td><?php echo $user['username']; ?></td>
                        <td><?php echo $user['email']; ?></td>
                        <td><?php echo $user['fullname']; ?></td>
                        <td><?php echo $user['age']; ?></td>
                        <td><?php echo $user['sex']; ?></td>
                        <td><?php echo $user['role']; ?></td>
                        <td>
                            <div class="btn-group" style="display: flex; gap: 8px; justify-conter: space-around;">
                                <button class="btn btn-primary" style="padding: 8px;" >Edit</button>
                                <button class="btn btn-danger" style="padding: 8px;" >Delete</button>
                               
                                <form method="post" action="">
                                    <input type="hidden" name="user_id" value="<?php echo $user['user_id']; ?>">
                                    <button name="activate_user" type="submit" class="btn <?php echo $user['status'] === 'activated' ? 'btn-outline-success' : 'btn-success'; ?>" <?php echo $user['status'] === 'activated' ? 'disabled' : ''; ?> style="padding: 8px;">
                                        <?php echo $user['status'] === 'activated' ? '<span style="color: green;">Active</span>' : 'Activate'; ?>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
   <!--Additional div for sidebar-->
   </div>
    </div>
</div>