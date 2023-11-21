<?php
require_once 'controllers/admin/UserManagementController.php';

$users = UserManagementController::user_management();
?>

<div class="container-fluid">
    <div style="float:right;">
        <a href="user-management-add-user" style="color: white; text-decoration: none;">
            <button class="form-control custom-button">
                <i class="bi bi-person-add"></i> Add User
            </button>
        </a>
    </div>
    <h3 class="mt-2 mb-2">User Management</h3>
    <div class="container-fluid">
        <div style="overflow-x: auto;">
        <table class="table table-bordered table-striped custom-table" id="userTable">
            <thead>
                <tr>
                    <th class="wrap-text">Username</th>
                    <th class="wrap-text">Email</th>
                    <th class="wrap-text">First Name</th>
                    <th class="wrap-text">Middle Name</th>
                    <th class="wrap-text">Last Name</th>
                    <th class="wrap-text">Age</th>
                    <th class="wrap-text">Sex</th>
                    <th class="wrap-text">Address</th>
                    <th class="wrap-text">Role</th>
                    <th class="wrap-text">Account Status</th>
                    <th class="wrap-text">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?= $user['username']; ?></td>
                        <td><?= $user['email']; ?></td>
                        <td><?= $user['firstname']; ?></td>
                        <td>
                            <?= empty($user['middlename']) ? "-" : $user['middlename']; ?>
                        </td>
                        <td><?= $user['lastname']; ?></td>
                        <td><?= $user['age']; ?></td>
                        <td> <?php
                        if ($user['sex']==="Male") {
                            echo 'M';
                        } elseif ($user['sex']==="Female") {
                            echo 'F';
                        }else {
                            echo 'O';
                        }
                        ?>
                        </td>
                        <td><?= $user['address']; ?></td>
                        <td>  
                        <?php
                        if ($user['role']==="residence") {
                            echo $user['role'];
                        } else {
                            echo $user['position'];
                        }
                        ?>
                        </td>
                        <td class="<?= $user['status'] === 'activated' ? 'text-success' : ($user['status'] === 'pending' ? 'text-warning' : 'text-danger'); ?>">
                            <?= strtoupper($user['status']); ?>
                        </td>
                        <td>
                        <?php if ($user['role'] !== 'captain') : ?>
                            <div class="btn-group" style="display: flex; gap: 8px; justify-content: space-around;">
                                <form action="user-management-edit-user" method="post">
                                    <input type="hidden" name="userId" value="<?= $user['user_id']; ?>">
                                    <button type="submit" class="btn btn-primary" style="padding: 8px; width: 60px;">Edit</button>
                                </form>
                            </div>
                        <?php else : ?>
                            <?= '' ?>  
                        <?php endif; ?>
                    </td>

                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    </div>
</div>
   <!--Additional div for sidebar-->
   </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        var userTable = $('#userTable').DataTable({
            paging: true, // Enable pagination
            pageLength: 10, // Number of rows per page
            lengthMenu: [10, 25, 50, 100], // Dropdown for rows per page
            responsive: true, // Enable responsive behavior
            order: [[9, 'desc']], // Sort the first column (index 0) in descending order
        });

        // Add a page change event listener to the DataTable
        userTable.on('page.dt', function () {
            // Smooth scroll to the top of the page
            $('html, body').animate({
                scrollTop: 0
            }, 0.5); // 500ms animation duration
        });
        
    });
</script>
