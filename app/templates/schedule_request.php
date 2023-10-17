<div class="text-center mt-4">
    <form action="" method="post">
        <label for="date">Select a Date:</label>
        <input type="date" id="schedule_date" name="schedule_date" required>
        <br><br>
        
        <label for="time">Available Time Slots for this date:</label>
        <select id="time" name="time_in" required>
            <option value="1:00 PM">1:00 PM</option>
            <option value="2:00 PM">2:00 PM</option>
            <option value="3:00 PM">3:00 PM</option>
            <option value="4:00 PM">4:00 PM</option>
            <option value="5:00 PM">5:00 PM</option>
            <option value="6:00 PM">6:00 PM</option>
            <option value="7:00 PM">7:00 PM</option>
            <option value="8:00 PM">8:00 PM</option>
            <option value="9:00 PM">9:00 PM</option>
            <option value="10:00 PM">10:00 PM</option>
            <option value="11:00 PM">11:00 PM</option>
        </select>

        <select id="time" name="time_out" required>           
            <option value="2:00 PM">2:00 PM</option>
            <option value="3:00 PM">3:00 PM</option>
            <option value="4:00 PM">4:00 PM</option>
            <option value="5:00 PM">5:00 PM</option>
            <option value="6:00 PM">6:00 PM</option>
            <option value="7:00 PM">7:00 PM</option>
            <option value="8:00 PM">8:00 PM</option>
            <option value="9:00 PM">9:00 PM</option>
            <option value="10:00 PM">10:00 PM</option>
            <option value="11:00 PM">11:00 PM</option>
            <option value="12:00 AM">12:00 AM</option>
        </select>
        <br><br>
        <button type="submit" name="request_schedule">Request Schedule</button>
       
    </form> 
</div>
<script>
    function showRegistrationSuccessModal() {
        $('#registrationSuccessModal').modal('show');
    }

    function disablePastDates() {
            var today = new Date().toISOString().split('T')[0];
            document.getElementById("schedule_date").setAttribute("min", today);
        }
        window.onload = disablePastDates;
    </script>