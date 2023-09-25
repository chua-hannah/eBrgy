<h2 class="text-center mt-4 mb-4">Report Form</h2>
<div class="col-lg-6 col-12 mx-auto">
    <form class="custom-form contact-form" action="#" method="post" role="form">
        <div class="row d-flex justify-content-center">
        <h3 class="mb-4">File a report or a complaint</h3>
            <div class="col-lg-12 col-md-6 col-12">
                <label class="labels">Person to Report</label>
                <input type="text" name="reported_person_name" id="reported_person_name" class="form-control" placeholder="Full name" required>
            </div>  

            <div class="col-lg-12 col-md-6 col-12">
                <label class="labels">Place of Incident</label>
                <input type="text" name="place_of_incident" id="place" class="form-control" placeholder="Location" required>
            </div>

            <div class="col-lg-6 col-md-6 col-12">
                <label class="labels">Date of Incident</label>
                <input type="date" name="date_of_incident" id="date" class="form-control" placeholder="Time" required>
            </div>
            
            <div class="col-lg-6 col-md-6 col-12">
                <label class="labels">Time of Incident</label>
                <input type="time" name="time_of_incident" id="time" class="form-control" placeholder="Time" required>
            </div>

            <div class="col-lg-12 col-md-6 col-12">
                <label class="labels">Details of the Incident</label>
                <input type="text" name="subject_person" id="subject" class="form-control" placeholder="Subject" required>
                <textarea name="note" rows="5" class="form-control mb-4" id="note" placeholder="Complaint"></textarea>
            </div>
        </div>
        <div class="d-grid gap-2 col-12 mx-auto">
            <button type="submit" name="report_form" class="form-control">Submit Request</button>
        </div>
    </form>
</div>



