

<!-- templates/services.php -->
<div >
    <h1>Schedules</h1>
    <form action="process.php" method="post">
        <label for="date">Select a Date:</label>
        <input type="date" id="date" name="date" required>
        <br><br>
        
        <label for="time">Available Time Slots for this date:</label>
        <select id="time" name="time" required>
            <option value="null">Select Time in schedule</option>
            <option value="9:00 AM">9:00 AM</option>
            <option value="10:00 AM">10:00 AM</option>
            <option value="11:00 AM">11:00 AM</option>
            <!-- Add more options for available time slots as needed -->
        </select>

        <select id="time" name="time" required>
            <option value="null">Select Time out schedule</option>
            <option value="9:00 AM">9:00 AM</option>
            <option value="10:00 AM">10:00 AM</option>
            <option value="11:00 AM">11:00 AM</option>
            <!-- Add more options for available time slots as needed -->
        </select>
        <br><br>
        
        <input type="submit" value="Schedule">
    </form>
  
</div>

    <!--Additional div for sidebar-->
    </div>
    </div>
</div>
