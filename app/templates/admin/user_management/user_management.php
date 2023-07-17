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
                            <div class="btn-group">
                                <button class="btn btn-primary" onclick="editUser(<?php echo $user['user_id']; ?>)">Edit</button>
                                <button class="btn btn-danger" onclick="deleteUser(<?php echo $user['user_id']; ?>)">Delete</button>
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