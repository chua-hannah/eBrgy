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
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user) { ?>
                    <tr>
                        <td><?php echo $user['username']; ?></td>
                        <td><?php echo $user['email']; ?></td>
                        <td><?php echo $user['firstname'] . ' ' . $user['middlename'] . ' ' . $user['lastname']; ?></td>
                        <td><?php echo $user['age']; ?></td>
                        <td><?php echo $user['sex']; ?></td>
                      
                        <td><?php echo $user['role']; ?></td>
                        <td style="color: <?php echo $user['status'] === 'activated' ? 'green' : 'red'; ?>;"><?php echo $user['status']; ?></td>

                        <td>
                            <div class="btn-group" style="display: flex; gap: 8px; justify-conter: space-around;">
                            <form action="user-management/edit-user" method="post">
                                <input type="hidden" name="userId" value="<?php echo $user['user_id']; ?>">
                                <button type="submit" class="btn btn-primary" style="padding: 8px;">Edit</button>
                            </form>
                                <button class="btn btn-danger" style="padding: 8px;" >Delete</button>
                               
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