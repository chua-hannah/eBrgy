<div class="card">
  <div class="card-body">
    <h5>Home Page Setting</h5>
    <form action="" method="post" enctype="multipart/form-data">
      <div class="row">
        <h6>Text display</h6>
        <div class="col-md-12 mb-3">
          <div class="form-group">
            <label for="announcement">Set Announcement Text:</label>
            <textarea class="form-control" id="announcement" name="announcement" rows="4" cols="50"><?php echo isset($homeSettings[0]['announcement_text']) ? $homeSettings[0]['announcement_text'] : ''; ?></textarea>
          </div>
        </div>
        <div class="col-md-12 mb-3">
          <div class="form-group">
            <label for="mission">Set a Mission:</label>
            <textarea class="form-control" id="mission" name="mission" rows="4" cols="50"><?php echo isset($homeSettings[0]['mission_text']) ? $homeSettings[0]['mission_text'] : ''; ?></textarea>
          </div>
        </div>
        <div class="col-md-12 mb-3">
          <!-- Vision Text Area -->
          <div class="form-group">
            <label for="vision">Set a Vision:</label>
            <textarea class="form-control" id="vision" name="vision" rows="4" cols="50"><?php echo isset($homeSettings[0]['vision_text']) ? $homeSettings[0]['vision_text'] : ''; ?></textarea>
          </div>
        </div>
        <hr class="mt-2 mb-2">
        <h6 class="mt-2">Images</h6>
        <div class="col-md-6 mb-3">
            <img src="uploads/homepage/<?php echo $homeSettings[0]['slide1']; ?>" style="width: 200px; height: auto; max-height: 200px;" class="img-fluid" alt="Image 1 Preview">
            <label class="custom-file-label" for="slide1">For Carousel Image #1</label>
            <input type="file" class="form-control mt-3" style="width: 50%" id="slide1" name="slide1" accept="image/*">
        </div>
        <div class="col-md-6 mb-3">
            <img src="uploads/homepage/<?php echo $homeSettings[0]['slide2']; ?>" style="width: 200px; height: auto; max-height: 200px;" class="img-fluid" alt="Image 2 Preview">
            <label class="custom-file-label" for="slide2">For Carousel Image #2</label>
            <input type="file" class="form-control mt-3" style="width: 50%" id="slide2" name="slide2" accept="image/*">            
        </div>
        <div class="col-md-6 mb-3">
            <img src="uploads/homepage/<?php echo $homeSettings[0]['slide3']; ?>" style="width: 200px; height: auto; max-height: 200px;" class="img-fluid" alt="Image 3 Preview">
            <label class="custom-file-label" for="slide3">For Carousel Image #3</label>
            <input type="file" class="form-control mt-3" style="width: 50%" id="slide3" name="slide3" accept="image/*">            
        </div>
        <div class="col-md-6 mb-3">
            <img src="uploads/homepage/<?php echo $homeSettings[0]['slide4']; ?>" style="width: 200px; height: auto; max-height: 200px;" class="img-fluid" alt="Image 4 Preview">
            <label class="custom-file-label" for="slide4">For Our Story Image</label>
            <input type="file" class="form-control mt-3" style="width: 50%" id="slide4" name="slide4" accept="image/*">           
        </div>
        <hr class="mt-2 mb-2">
        <h6 class="mt-2">Footer</h6>
     
        <div class="row">
        <div style="display: flex; flex-direction: column;">
  <div class="col-md-6 mb-3">
    <div class="form-group">
      <label for="contact">Contact Number:</label>
      <input class="form-control" id="contact" name="contact" 
             value="<?php echo isset($homeSettings[0]['contact']) ? $homeSettings[0]['contact'] : ''; ?>">
    </div>
  </div>
  <div class="col-md-6 mb-3">
    <div class="form-group">
      <label for="facebook">Facebook:</label>
      <input class="form-control" id="facebook" name="facebook" 
             value="<?php echo isset($homeSettings[0]['facebook']) ? $homeSettings[0]['facebook'] : ''; ?>">
    </div>
  </div>
  <div class="col-md-6 mb-3">
    <div class="form-group">
      <label for="messenger">Messenger:</label>
      <input class="form-control" id="messenger" name="messenger" 
             value="<?php echo isset($homeSettings[0]['messenger']) ? $homeSettings[0]['messenger'] : ''; ?>">
    </div>
  </div>
</div>



        </div>

        <div class="col-md-10 mb-3"></div>
        <div class="col-md-2 text-end">
          <?php if (!empty($homeSettings)): ?>
            <!-- Display "Edit" button if $homeSettings is not empty -->
            <button type="submit" name="edit_home_page_setting" class="btn btn-primary">Save Changes</button>
          <?php else: ?>
            <!-- Display "Save" button if $homeSettings is not empty -->
            <button type="submit" name="home_page_setting" class="btn btn-primary">Save</button>
          <?php endif; ?>
        </div>
      </div>
    
    </form>
  </div>
</div>






    <!--Additional div for sidebar-->
    </div>
    </div>
</div>