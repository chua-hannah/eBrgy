<div class="card">
  <div class="card-body">
    <h5 class="card-title">Home Page Setting</h5>
    <form action="" method="post" enctype="multipart/form-data">
      <div class="form-group">
        <label for="announcement">Announcement Text:</label>
        <textarea class="form-control" id="announcement" name="announcement" rows="4" cols="50"><?php echo isset($homeSettings[0]['announcement_text']) ? $homeSettings[0]['announcement_text'] : ''; ?></textarea>
      </div>
            <div class="form-group">
                <label for="mission">Mission:</label>
                <textarea class="form-control" id="mission" name="mission" rows="4" cols="50"><?php echo isset($homeSettings[0]['mission_text']) ? $homeSettings[0]['mission_text'] : ''; ?></textarea>
            </div>

            <!-- Vision Text Area -->
            <div class="form-group">
                <label for="vision">Vision:</label>
                <textarea class="form-control" id="vision" name="vision" rows="4" cols="50"><?php echo isset($homeSettings[0]['vision_text']) ? $homeSettings[0]['vision_text'] : ''; ?></textarea>
            </div>

      <div class="custom-file">
        <img src="uploads/homepage/<?php echo $homeSettings[0]['slide1']; ?>" style="width: 200px; height: auto; max-height: 200px;"
            class="img-fluid" alt="Image 1 Preview">
        <input type="file" class="custom-file-input" id="slide1" name="slide1" accept="image/*" required>
        <label class="custom-file-label" for="slide1">For Slides</label>
      </div>

      <div class="custom-file">
        <img src="uploads/homepage/<?php echo $homeSettings[0]['slide2']; ?>" style="width: 200px; height: auto; max-height: 200px;"
            class="img-fluid" alt="Image 2 Preview">
        <input type="file" class="custom-file-input" id="slide2" name="slide2" accept="image/*" required>
        <label class="custom-file-label" for="slide2">For Slides</label>
      </div>

      <div class="custom-file">
        <img src="uploads/homepage/<?php echo $homeSettings[0]['slide3']; ?>" style="width: 200px; height: auto; max-height: 200px;"
            class="img-fluid" alt="Image 3 Preview">
        <input type="file" class="custom-file-input" id="slide3" name="slide3" accept="image/*" required>
        <label class="custom-file-label" for="slide3">For Slides</label>
      </div>

      <div class="custom-file">
        <img src="uploads/homepage/<?php echo $homeSettings[0]['slide4']; ?>" style="width: 200px; height: auto; max-height: 200px;"
            class="img-fluid" alt="Image 4 Preview">
        <input type="file" class="custom-file-input" id="slide4" name="slide4" accept="image/*" required>
        <label class="custom-file-label" for="slide4">For Our Story Image</label>
      </div>

      <?php if (!empty($homeSettings)): ?>
        <!-- Display "Edit" button if $homeSettings is empty -->
        <button type="submit" name="edit_home_page_setting" class="btn btn-secondary">Edit</button>
      <?php else: ?>
        <!-- Display "Save" button if $homeSettings is not empty -->
        <button type="submit" name="home_page_setting" class="btn btn-primary">Save</button>
      <?php endif; ?>
    </form>
  </div>
</div>





    <!--Additional div for sidebar-->
    </div>
    </div>
</div>