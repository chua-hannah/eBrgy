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
    <div>
        <table class="table table-bordered table-striped custom-table" id="userTable">
            <thead>
                <tr>
                    <th>Username</th>
                    <th>Email</th>
                    <th>First Name</th>
                    <th>Middle Name</th>
                    <th>Last Name</th>
                    <th>Age</th>
                    <th>Sex</th>
                    <th>Address</th>
                    <th>Role</th>
                    <th>Account Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?= $user['username']; ?></td>
                        <td><?= $user['email']; ?></td>
                        <td><?= $user['firstname']; ?></td>
                        <td><?= $user['middlename']; ?></td>
                        <td><?= $user['lastname']; ?></td>
                        <td><?= $user['age']; ?></td>
                        <td><?= $user['sex']; ?></td>
                        <td><?= $user['address']; ?></td>
                        <td><?= $user['role']; ?></td>
                        <td class="<?= $user['status'] === 'activated' ? 'text-success' : 'text-danger'; ?>">
                            <?= strToUpper($user['status']); ?>
                        </td>
                        <td>
                            <div class="btn-group" style="display: flex; gap: 8px; justify-content: space-around;">
                                <form action="user-management-edit-user" method="post">
                                    <input type="hidden" name="userId" value="<?= $user['user_id']; ?>">
                                    <button type="submit" class="btn btn-primary" style="padding: 8px;">Edit</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<script>
    $(document).ready(function () {
        var userTable = $('#userTable').DataTable({
            paging: true, // Enable pagination
            pageLength: 10, // Number of rows per page
            lengthMenu: [10, 25, 50, 100], // Dropdown for rows per page
            responsive: true, // Enable responsive behavior
            order: [] // Define the initial column order
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
   <!--Additional div for sidebar-->
   </div>
    </div>
</div>