
<main>
<?php
$announcementText = ''; // Initialize the announcement text variable

foreach ($homeSettings as $setting) {
    $announcementText = $setting['announcement_text'];
    // Assuming $setting['announcement_text'] contains the announcement text
    if (!empty($announcementText)) {
        break; // Stop the loop when a non-empty announcement text is found
    }
}
?>

<?php if (!empty($announcementText)): ?>
    <div class="announcement">
        <p class="mb-0"><strong><i class="bi bi-megaphone-fill"></i> <!-- Megaphone icon -->Announcement:</strong>
            <?php echo $announcementText; ?>
        </p>
    </div>
<?php endif; ?>
    <section class="hero-section hero-section-full-height">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-12 p-0">
                    <div id="hero-slide" class="carousel carousel-fade slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            <?php foreach ($homeSettings as $index => $setting): ?>
                                <div class="carousel-item <?php echo ($index === 0) ? 'active' : ''; ?>">
                                    <img src="uploads/homepage/<?php echo $setting['slide1']; ?>"
                                        class="carousel-image img-fluid" alt="...">
                                    <div class="carousel-caption d-flex flex-column justify-content-end">
                                        <h1>Carousel <?php echo $index + 1; ?></h1>
                                        <p><?php echo $setting['announcement_text']; ?></p>
                                    </div>
                                </div>
                                <div class="carousel-item">
                                    <img src="uploads/homepage/<?php echo $setting['slide2']; ?>"
                                        class="carousel-image img-fluid" alt="...">
                                    <div class="carousel-caption d-flex flex-column justify-content-end">
                                        <h1>Carousel <?php echo $index + 2; ?></h1>
                                        <p><?php echo $setting['announcement_text']; ?></p>
                                    </div>
                                </div>
                                <div class="carousel-item">
                                    <img src="uploads/homepage/<?php echo $setting['slide3']; ?>"
                                        class="carousel-image img-fluid" alt="...">
                                    <div class="carousel-caption d-flex flex-column justify-content-end">
                                        <h1>Carousel <?php echo $index + 3; ?></h1>
                                        <p><?php echo $setting['announcement_text']; ?></p>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#hero-slide" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#hero-slide" data-bs-slide="next">
                            <span class="carousel-control-next-icon" ariahidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>

        <section class="section-padding">
            <div class="container">
                <div class="row">

                    <div class="col-lg-10 col-12 text-center mx-auto">
                        <h2 class="mb-5">Welcome to Barangay 95</h2>
                    </div>

                    <div class="col-lg-3 col-md-6 col-12 mb-4 mb-lg-0">
                        <div class="featured-block d-flex justify-content-center align-items-center">
                            <a href="officials" class="d-block">
                                <img src="assets/images/icons/team.png" class="featured-block-image img-fluid" alt="">

                                <p class="featured-block-text">View <strong>Our Officials</strong></p>
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 col-12 mb-4 mb-lg-0 mb-md-4">
                        <div class="featured-block d-flex justify-content-center align-items-center">
                            <a href="services" class="d-block">
                                <img src="assets/images/icons/letter.png" class="featured-block-image img-fluid" alt="">

                                <p class="featured-block-text"><strong>Report</strong> Complaint</p>
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 col-12 mb-4 mb-lg-0 mb-md-4">
                        <div class="featured-block d-flex justify-content-center align-items-center">
                            <a href="register" class="d-block">
                                <img src="assets/images/icons/add-user.png" class="featured-block-image img-fluid" alt="">

                                <p class="featured-block-text">Create your<strong> Account</strong></p>
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 col-12 mb-4 mb-lg-0">
                        <div class="featured-block d-flex justify-content-center align-items-center">
                            <a href="contact" class="d-block">
                                <img src="assets/images/icons/contact.png" class="featured-block-image img-fluid" alt="">

                                <p class="featured-block-text"><strong>Contact</strong> Us</p>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="section-padding section-bg" id="section_2">
            <div class="container">
                <div class="row">

                    <div class="col-lg-6 col-12 mb-5 mb-lg-0">
                        <img src="uploads/homepage/<?php echo $setting['slide4']; ?>"
                            class="custom-text-box-image img-fluid" alt="">
                    </div>

                    <div class="col-lg-6 col-12">
    <div class="custom-text-box">
        <div class="col-lg-12 col-12">
            <h2 class="mb-2" style="margin-bottom: 10px;">Our Story</h2>

            <h5 class="mb-3" style="margin-bottom: 10px;">Barangay 95</h5>

            <p class="mb-0" style="text-align: justify;">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed maximus massa sed metus ultrices dictum. Ut interdum urna vitae eros condimentum, fringilla faucibus risus semper. Maecenas rhoncus facilisis augue, a tristique tortor lacinia vitae.
            </p>
            </div>
            <div class="col-lg-12 col-12 mt-3">
                <h5 class="mb-3" style="margin-bottom: 10px;">Our Mission</h5>

                <p class="mb-0" style="text-align: justify;">
                    <?php echo $setting['mission_text']?>
                </p>
            </div>
            <div class="col-lg-12 col-12 mt-3">
                <h5 class="mb-3" style="margin-bottom: 10px;">Our Vision</h5>

                <p class="mb-0" style="text-align: justify;">
                    <?php echo $setting['vision_text']?>
                </p>
            </div>
        </div>
    </div>

                </div>
            </div>
        </section>
</main>
