<main>
    <div class="container mt-5">
        <div class="container text-center">
            <div>
                <h2>Barangay 95 Officials</h2>
            </div>
            <div class="row d-flex justify-content-center">
                <?php foreach ($users as $user): ?>
                    <?php if ($user['role'] === 'captain'): ?>
                        <div class="col-md-4">
                            <div class="card md-3">
                                <div class="card-body text-center">
                                    <div>
                                        
                                        <?php
                                        $idSelfiePath = 'uploads/id_selfie/' . $user['id_selfie'];
                                        if (!empty($user['id_selfie']) && file_exists($idSelfiePath)):
                                        ?>
                                            <div class="text-center">
                                                <img src="<?php echo $idSelfiePath; ?>" alt="ID Selfie" class="img-thumbnail">
                                            </div>
                                        <?php else: ?>
                                            <p>ID Selfie not available</p>
                                        <?php endif; ?>
                                    </div>
                                    <h5><?php echo $user['role']; ?></h5>
                                    <h5 class="card-title">
                                        <?php echo $user['firstname'] . ' ' . $user['middlename'] . ' ' . $user['lastname']; ?>
                                    </h5>
                                    <p class="card-text">
                                        Age: <?php echo $user['age']; ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="container mt-3">
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
                                    if (!empty($user['id_selfie']) && file_exists($idSelfiePath)):
                                    ?>
                                        <div class="text-center">
                                            <img src="<?php echo $idSelfiePath; ?>" alt="ID Selfie" class="img-thumbnail">
                                        </div>
                                    <?php else: ?>
                                        <p>ID Selfie not available</p>
                                    <?php endif; ?>
                                </div>
                                <h5><?php echo $user['role']; ?></h5>
                                <h5 class="card-title">
                                    <?php echo $user['firstname'] . ' ' . $user['middlename'] . ' ' . $user['lastname']; ?>
                                </h5>
                                <p class="card-text">
                                    Age: <?php echo $user['age']; ?>
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
</main>