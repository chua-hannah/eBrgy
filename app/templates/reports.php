<!-- <div class="text-center" style="margin: 16px;">
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
        </div> -->

<section class="contact-section section-padding" id="section_6">
<div class="col-lg-5 col-12 mx-auto">
    <form class="custom-form contact-form" action="#" method="post" role="form">
        <h2>Report form</h2>
        <p class="mb-4">Enter your report details</p>
        <div class="row">
            <div class="col-lg-12 col-md-6 col-12">
                <label class="labels">Person to Report</label>
                <input type="text" name="first-name" id="first-name" class="form-control"
                    placeholder="Full name" required>
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

        <button type="submit" class="form-control">Send Report</button>
    </form>
</div>
</section>