
<div class="container mt-5">
    <div class="container">
        <h1>Officials</h1>
        <div class="row">
            <?php foreach ($users as $user): ?>
                <div class="col-md-4">
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
            <?php endforeach; ?>
        </div>
    </div>
</div>
