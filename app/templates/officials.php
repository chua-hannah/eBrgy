
<div class="container mt-5">
    <div class="container text-center">
        <h1>Officials</h1>
        <div class="row d-flex justify-content-center">
        <?php foreach ($users as $user): ?>
            <?php if ($user['role'] === 'captain'): ?>
                <div class="col-md-4">
                    <div class="card my-5">
                        <div class="card-body text-center">
                            <h5 class="card-title"><?php echo $user['fullname']; ?></h5>
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
                        <h5 class="card-title"><?php echo $user['fullname']; ?></h5>
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
