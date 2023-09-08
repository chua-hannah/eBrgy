<div class="text-center" style="margin: 16px;">
            <div><h4>REPORT FORM</h4></div>
            <form action="process_form.php" method="post">
        <label for="equipment_name">Person to Report(Name):</label>
        <input type="text" id="equipment_name" name="equipment_name" required><br><br>

        <label for="fullname">Subject:</label>
        <input type="text" id="fullname" name="fullname" required><br><br>

        <label for="email">Place of the incident:</label>
        <input type="email" id="email" name="email" required><br><br>

        <label for="mobile">Time of the incident:</label>
        <input type="tel" id="mobile" name="mobile" required><br><br>

        <label for="equipment_count">Note:</label>
        <input type="number" id="equipment_count" name="equipment_count" required><br><br>

        <input type="submit" value="Submit">
    </form>
        </div>