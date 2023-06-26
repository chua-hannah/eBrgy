<!-- Add this code in your attendance.php template or wherever appropriate -->

<!-- Attendance Check-in Form -->
<form method="POST" action="">
    <?php if ($isCheckIn): ?>
        <button type="submit" name="check_out" class="btn btn-danger">Check-out</button>
    <?php else: ?>
        <button type="submit" name="check_in" class="btn btn-primary">Check-in</button>
    <?php endif; ?>
</form>


    <!--Additional div for sidebar-->
    </div>
    </div>
</div>