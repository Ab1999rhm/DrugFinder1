<footer class="footer-custom">
    <div class="container">
        <div class="row text-center text-md-start">
            <div class="col-md-4 mb-4">
                <h5><i class="fas fa-info-circle"></i> About Us</h5>
                <p>
                    DrugFinder empowers sellers to efficiently manage inventory, track orders, and deliver quality healthcare products.
                </p>
                <p>
                    DrugFinder Seller Dashboard helps you manage your drug inventory, track orders, and grow your business with ease.
                </p>
            </div>
            <div class="col-md-4 mb-4">
                <h5><i class="fas fa-envelope"></i> Contact Us</h5>
                <p>
                    <i class="fas fa-phone"></i> +251929570426<br>
                    <i class="fas fa-envelope"></i> <a href="mailto:support@drugfinder.com">fikaduabraham093@gmail.com</a><br>
                    <i class="fas fa-map-marker-alt"></i> Dire Dawa, Ethiopia
                </p>
            </div>
            <div class="col-md-4 mb-4">
                <h5><i class="fas fa-question-circle"></i> FAQ</h5>
                <div>
                    <div class="faq-question"><i class="fas fa-plus-circle"></i> How do I add a new drug?</div>
                    <div class="faq-answer">Click the "Add New Drug" button in your dashboard or the navigation bar.</div>
                    <div class="faq-question"><i class="fas fa-plus-circle"></i> How do I track orders?</div>
                    <div class="faq-answer">Go to the Orders section to view and manage all customer orders.</div>
                    <div class="faq-question"><i class="fas fa-plus-circle"></i> How do I contact support?</div>
                    <div class="faq-question"><i class="fas fa-plus-circle"></i> How do I reset my password?</div>
                    <div class="faq-answer">Go to login page,Click on forgot password,follow instruction</div>
                    <div class="faq-question"><i class="fas fa-plus-circle"></i> Can I export my inventory data?</div>
                    <div class="faq-answer">Currently, exporting inventory data is not available. Stay tuned for updates!</div>
                    <div class="faq-question"><i class="fas fa-plus-circle"></i> How do I update my profile information?</div>
                    <div class="faq-answer">Navigate to the Profile section and edit your details. Don't forget to save changes!</div>
                    <div class="faq-answer">Email us at <a href="mailto:support@drugfinder.com">fikaduabraham093</a> or call our hotline.</div>
                </div>
            </div>
        </div>
        <div class="text-center mt-3" style="font-size:0.97rem;">
            &copy; {{ date('Y') }} DrugFinder. All rights reserved.
        </div>
    </div>
    <script>
        // FAQ Toggle
        document.querySelectorAll('.faq-question').forEach(function(q){
            q.addEventListener('click', function(){
                this.classList.toggle('active');
                let answer = this.nextElementSibling;
                if(answer.style.display === "block"){
                    answer.style.display = "none";
                } else {
                    answer.style.display = "block";
                }
            });
        });
    </script>
</footer>
