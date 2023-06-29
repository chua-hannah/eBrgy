<!DOCTYPE html>
<html>
<head>
    <title>Resident List</title>
</head>
<body>
    <h1>Resident List</h1>
    
    <!-- Display resident list -->
    <table>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Address</th>
            <th>Profile Picture</th>
            <th>Action</th>
        </tr>
        <?php foreach ($residents as $resident): ?>
        <tr>
            <td><?php echo $resident["name"]; ?></td>
            <td><?php echo $resident["email"]; ?></td>
            <td><?php echo $resident["phone"]; ?></td>
            <td><?php echo $resident["address"]; ?></td>
            <td><img src="uploads/<?php echo $resident["profile_picture"]; ?>" alt="Profile Picture" width="50"></td>
            <td>
                <a href="resident_list.php?delete=<?php echo $resident["id"]; ?>">Delete</a>
                <a href="resident_form.php?id=<?php echo $resident["id"]; ?>">Edit</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
    
    <!-- Create resident form -->
    <h2>Create Customer</h2>
    <form action="ResidentController.php" method="POST" enctype="multipart/form-data">
        <input type="text" name="name" placeholder="Name" required><br>
        <input type="email" name="email" placeholder="Email" required><br>
        <input type="tel" name="phone" placeholder="Phone" required><br>
        <input type="text" name="address" placeholder="Address" required><br>
        <input type="file" name="profile_picture" required><br>
        <button type="submit" name="create">Create</button>
    </form>
</body>
</html>
