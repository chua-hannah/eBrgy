<div class="text-center" style="margin: 16px;">
            <div><h4>REPORT FORM</h4></div>
            <form action="process_form.php" method="post">
        <label for="equipment_name">Equipment Name:</label>
        <input type="text" id="equipment_name" name="equipment_name" required><br><br>

        <label for="fullname">Full Name:</label>
        <input type="text" id="fullname" name="fullname" required><br><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br><br>

        <label for="mobile">Mobile:</label>
        <input type="tel" id="mobile" name="mobile" required><br><br>

        <label for="status">Status:</label>
        <select id="status" name="status" required>
            <option value="Active">Active</option>
            <option value="Inactive">Inactive</option>
            <option value="Repair">Repair</option>
        </select><br><br>

        <label for="equipment_count">Equipment Count:</label>
        <input type="number" id="equipment_count" name="equipment_count" required><br><br>

        <input type="submit" value="Submit">
    </form>
        </div>