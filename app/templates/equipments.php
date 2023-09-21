<!-- <div class="text-center" style="margin: 16px;">
            <div><h4>EQUIPMENTS FORM</h4></div>
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
        </div> -->

        <section class="contact-section section-padding" id="section_6">
<div class="col-lg-5 col-12 mx-auto">
    <form class="custom-form contact-form" action="#" method="post" role="form">
        <h2>Request Equipments</h2>
        <p class="mb-4">Borrow an equipment</p>
        <div class="row">
            <div class="col-lg-12 col-md-6 col-12">
                <label class="labels">Type of Equipment</label>
                <select class="form-select" style="background-color: var(--white-color);" name="equipment" required>
                    <option value="" hidden>Equipment</option>
                    <option value="male">Chair</option>
                    <option value="male">Table</option>
                  </select>
            </div>  

            <div class="col-lg-6 col-md-6 col-12">
                <label class="labels">Place of Incident</label>
                <input type="text" name="last-name" id="last-name" class="form-control"
                    placeholder="Location" required>
            </div>

            <div class="col-lg-6 col-md-6 col-12">
                <label class="labels">Time of Incident</label>
                <input type="time" name="last-name" id="last-name" class="form-control"
                    placeholder="Time" required>
            </div>

            <div class="col-lg-12 col-md-6 col-12">
                <label class="labels">Details of the Incident</label>
                <input type="text" name="last-name" id="last-name" class="form-control"
                    placeholder="Subject" required>
            </div>
        </div>

        <textarea name="message" rows="5" class="form-control" id="message"
            placeholder="Complaint"></textarea>

        <button type="submit" class="form-control">Send Request</button>
    </form>
</div>
</section>