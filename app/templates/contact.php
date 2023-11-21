<section class="contact-section section-padding" id="section_6">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-12 ms-auto mb-5 mb-lg-0">
                <div class="contact-info-wrap">
                    <h2>Get in touch</h2>

                    <div class="contact-image-wrap d-flex flex-wrap">
                        <?php
                        $idSelfiePath = 'uploads/id_selfie/' . $secretary['id_selfie'];
                        if (!empty($secretary['id_selfie']) && file_exists($idSelfiePath)):
                        ?>
                            <img src="<?php echo $idSelfiePath; ?>" alt="ID Selfie" class="img-fluid avatar-image">
                        <?php else: ?>
                            <p>ID Selfie not available</p>
                        <?php endif; ?>

                        <div class="d-flex flex-column justify-content-center ms-3">
                            <p class="mb-0">
                                <?php
                                echo !empty($secretary)
                                    ? strtoupper($secretary['firstname'] . ' ' . $secretary['middlename'] . ' ' . $secretary['lastname'])
                                    : 'Barangay Secretary is Unavailable';
                                ?>
                            </p>
                            <p class="mb-0"><strong>Barangay Secretary</strong></p>
                        </div>
                    </div>

                    <div class="contact-info">
                        <h5 class="mb-3">Contact Infomation</h5>

                        <p class="d-flex mb-2">
                            <i class="bi-geo-alt me-2"></i>
                            Barangay 95, Zone 8, District 1, Manila, Philippines
                        </p>

                        <p class="d-flex mb-2">
                            <i class="bi-telephone me-2"></i>

                            <a href="tel: 8-294-47-66">
                                8-294-47-66
                            </a>
                        </p>

                        <a href="https://maps.app.goo.gl/JMK2TDxUKZVWfsHa6" target="_blank" class="custom-btn btn mt-3">Get Direction</a>
                    </div>
                </div>
            </div>

            <div class="col-lg-5 col-12 mx-auto">
                <form class="custom-form contact-form" action="" method="post" role="form">
                    <h2>Contact form</h2>

                    <p class="mb-4">Or, you can just send SMS to:
                        <a href="sms:<?php echo $secretary['mobile']; ?>"><?php echo $secretary['mobile']; ?></a>
                    </p>
                    <div class="row">
                    <div class="col-lg-6 col-md-6 col-12">
                        <input type="text" name="firstname" id="firstname" class="form-control" placeholder="First Name" required
                            <?php if(isset($_SESSION['firstname'])) echo 'hidden readonly value="' . $_SESSION['firstname'] . '"'; ?>>
                    </div>

                    <div class="col-lg-6 col-md-6 col-12">
                        <input type="text" name="lastname" id="lastname" class="form-control" placeholder="Last Name" required
                            <?php if(isset($_SESSION['lastname'])) echo 'hidden readonly value="' . $_SESSION['lastname'] . '"'; ?>>
                    </div>

                    <div class="col-lg-6 col-md-6 col-12" <?php if(isset($_SESSION['email'])) echo 'style="display: none;"'; ?>>
                        <input type="email" name="email" id="email" pattern="[^ @]*@[^ @]*" class="form-control" placeholder="Email address (Optional)"
                            <?php if(isset($_SESSION['email'])) echo 'hidden readonly value="' . $_SESSION['email'] . '"'; ?>>
                    </div>

                    <div class="col-lg-6 col-md-6 col-12" <?php if(isset($_SESSION['mobile'])) echo 'style="display: none;"'; ?>>
                        <input type="text" name="mobile" id="mobileNumber" class="form-control" placeholder="Mobile Number (Optional)" oninput="validateNumericInput(this)" maxlength="11"
                            <?php if(isset($_SESSION['mobile'])) echo 'hidden readonly value="' . $_SESSION['mobile'] . '"'; ?>>
                    </div>




                    </div>
                    <textarea name="contact_message" rows="5" class="form-control mb-4" id="contact_message"
                        placeholder="What can we help you?" required></textarea>
                    <button type="submit" name="submit_message" class="form-control">Send Message</button>
                </form>
            </div>
        </div>
    </div>
</section>