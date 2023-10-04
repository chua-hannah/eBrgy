<section class="contact-section section-padding" id="section_6">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-12 ms-auto mb-5 mb-lg-0">
                <div class="contact-info-wrap">
                    <h2>Get in touch</h2>

                    <div class="contact-image-wrap d-flex flex-wrap">
                        <img src="assets/images/dummy-avatar.png"
                            class="img-fluid avatar-image" alt="">

                        <div class="d-flex flex-column justify-content-center ms-3">
                            <p class="mb-0">Juan Dela Cruz</p>
                            <p class="mb-0"><strong>Barangay Secretary</strong></p>
                        </div>
                    </div>

                    <div class="contact-info">
                        <h5 class="mb-3">Contact Infomation</h5>

                        <p class="d-flex mb-2">
                            <i class="bi-geo-alt me-2"></i>
                            Barangay 95, Manila, Philippines
                        </p>

                        <p class="d-flex mb-2">
                            <i class="bi-telephone me-2"></i>

                            <a href="tel: 8123-4567">
                                8123-4567
                            </a>
                        </p>

                        <p class="d-flex">
                            <i class="bi-envelope me-2"></i>

                            <a href="mailto:info@yourgmail.com">
                                dummy@only.ph
                            </a>
                        </p>

                        <a href="https://maps.app.goo.gl/JMK2TDxUKZVWfsHa6" target="_blank" class="custom-btn btn mt-3">Get Direction</a>
                    </div>
                </div>
            </div>

            <div class="col-lg-5 col-12 mx-auto">
                <form class="custom-form contact-form" action="" method="post" role="form">
                    <h2>Contact form</h2>

                    <p class="mb-4">Or, you can just send an email:
                        <a href="mailto:someone@example.com">dummy@only.ph</a>
                    </p>
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-12">
                            <input type="text" name="firstname" id="firstname" class="form-control" placeholder="First Name" required>
                        </div>

                        <div class="col-lg-6 col-md-6 col-12">
                            <input type="text" name="lastname" id="lastname" class="form-control" placeholder="Last Name" required>
                        </div>

                        <div class="col-lg-6 col-md-6 col-12">
                            <input type="email" name="email" id="email" pattern="[^ @]*@[^ @]*" class="form-control" placeholder="Email address" required>
                        </div>

                        <div class="col-lg-6 col-md-6 col-12">
                            <input type="text" name="mobile" id="mobileNumber" class="form-control" placeholder="Mobile Number" oninput="validateNumericInput(this)" maxlength="11">
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