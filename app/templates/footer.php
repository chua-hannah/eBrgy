<div class="spacer"></div>
</main>
<footer class="site-footer">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3 col-12">              
                </div>
                <div class="col-lg-4 col-md-6 col-12">
                    <h5 class="text-white mb-3">Quick Links</h5>

                    <ul class="footer-menu">
                        <li class="footer-menu-item"><a href="home" class="footer-menu-link">Home</a></li>

                        <li class="footer-menu-item"><a href="officials" class="footer-menu-link">Officials</a></li>

                        <li class="footer-menu-item"><a href="contact" class="footer-menu-link">Contact</a></li>

                        <li class="footer-menu-item"><a href="login" class="footer-menu-link">Login</a></li>

                        <li class="footer-menu-item"><a href="register" class="footer-menu-link">Register</a></li>

                    </ul>
                </div>

                <div class="col-lg-4 col-md-6 col-12 mx-auto">
                    <h5 class="text-white mb-3">Contact Information</h5>

                    <p class="text-white d-flex mb-2">
                        <i class="bi-telephone me-2"></i>
                        <a href="tel:82944766" class="site-footer-link">8-294-47-66</a>
                    </p>

                    <p class="text-white d-flex mb-2">
                        <i class="bi-geo-alt me-2"></i>
                        <a class="site-footer-link" href="https://maps.app.goo.gl/JMK2TDxUKZVWfsHa6" target="_blank">
                            Barangay 95, Zone 8, District 1, City of Manila
                        </a>
                    </p>

                    <div class="text-white d-flex mb-2">
                        <div class="col-6">
                            <i class="bi bi-facebook me-2"></i>
                            <a href="https://www.facebook.com/Barangay95" target="_blank" class="site-footer-link">Visit our page</a>
                        </div>
                        <div class="col-6">
                            <i class="bi bi-messenger me-2"></i>
                            <a href="https://m.me/Barangay95" target="_blank" class="site-footer-link">Chat us</a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    
    <!-- JAVASCRIPT FILES -->
    <script>
    function showRegistrationSuccessModal() {
        $('#registrationSuccessModal').modal('show');
    }

        function disablePastDates(dateInput1Id, dateInput2Id) {
            var today = new Date().toISOString().split('T')[0];
            document.getElementById(dateInput1Id).setAttribute("min", today);
            document.getElementById(dateInput2Id).setAttribute("min", today);
        }

        disablePastDates("reserved_schedule", "schedule_date");
    </script>
     <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/jquery.sticky.js"></script>
    <script src="assets/js/main.js"></script>
    <script src="assets/js/counter.js"></script>
    <script src="assets/js/custom.js"></script>
    <script src="assets/js/validation.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    </footer>
</body>

</html>