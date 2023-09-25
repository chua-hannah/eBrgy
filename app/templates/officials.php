<main>
<section class="hero-section hero-section-full-height">
<div class="container mt-5">
    <div class="container text-center">
    <h2>Officials</h2>
        <div class="row d-flex justify-content-center">
        <?php foreach ($users as $user): ?>
            <?php if ($user['role'] === 'captain'): ?>
                <div class="col-md-4">
                    <div class="card my-5">
                        <div class="card-body text-center">
                        <div>
                            <?php
                            $idSelfiePath = 'uploads/id_selfie/' . $user['id_selfie'];
                            if (!empty($user['id_selfie']) && file_exists($idSelfiePath)) {
                                ?>
                                <div class="text-center">
                                    <img src="<?php echo $idSelfiePath; ?>" alt="ID Selfie" class="img-thumbnail" style="width: 200px;">
                                   
                                </div>
                            <?php } else { ?>
                                <p>ID Selfie not available</p>
                            <?php } ?>
                        </div>
                            <h5 class="card-title"><?php echo $user['firstname'] . ' ' . $user['middlename'] . ' ' . $user['lastname']; ?></h5>
                            <p class="card-text">
                                <strong>Age:</strong> <?php echo $user['age']; ?><br>
                                <strong></strong> <?php echo $user['role']; ?>
                            </p>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>
        </div>
        
    </div>
    <div class="container">
    <?php $count = 0; ?>
    <?php foreach ($users as $user): ?>
        <?php if ($user['role'] === 'kagawad'): ?>
            <?php if ($count % 7 === 0): ?>
                <div class="row">
            <?php endif; ?>

            <?php if ($count % 7 < 3): ?>
                <div class="col-md-4">
            <?php else: ?>
                <div class="col-md-3">
            <?php endif; ?>

                <div class="card mb-4">
                    <div class="card-body text-center">
                    
                        <!-- Display the ID Selfie image -->
                        <div>
                            <?php
                            $idSelfiePath = 'uploads/id_selfie/' . $user['id_selfie'];
                            if (!empty($user['id_selfie']) && file_exists($idSelfiePath)) {
                                ?>
                                <div class="text-center">
                                    <img src="<?php echo $idSelfiePath; ?>" alt="ID Selfie" class="img-thumbnail" style="width: 200px;">
                                   
                                </div>
                            <?php } else { ?>
                                <p>ID Selfie not available</p>
                            <?php } ?>
                        </div>

                      
                 
                    <h5 class="card-title"><?php echo $user['firstname'] . ' ' . $user['middlename'] . ' ' . $user['lastname']; ?></h5>
                        <p class="card-text">
                            <strong>Age:</strong> <?php echo $user['age']; ?><br>
                            <strong>Role:</strong> <?php echo $user['role']; ?>
                        </p>
                    </div>
                </div>
            </div>
            
            <?php $count++; ?>

            <?php if ($count % 7 === 0): ?>
                </div>
            <?php endif; ?>
        <?php endif; ?>
    <?php endforeach; ?>
</div>

</div>
</section>
</main>