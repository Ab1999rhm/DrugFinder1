<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'DrugFinder') }}</title>

    <!-- Google Fonts: Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <!-- Bootstrap 5 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">

    <style>
        body {
            background-image: url("{{ asset('images/hospital4.jpg') }}");
            background-size: cover;
            /* Cover entire viewport */
            background-position: center;
            /* Center the image */
            background-repeat: no-repeat;
            /* Do not repeat */
            min-height: 100vh;
            margin: 0;
            animation: bgFadeIn 2s ease forwards;
            position: relative;
        }

        .navbar-custom {
            background: linear-gradient(90deg, #2575fc 0%, #6a11cb 100%) !important;
            box-shadow: 0 2px 8px rgba(37, 117, 252, 0.08);
            height: 100px;
        }

        .navbar-custom .navbar-brand,
        .navbar-custom .nav-link {
            color: #fff !important;
            font-weight: 600;
            font-size: 1.08rem;
            letter-spacing: 0.5px;
            gap: 100px;
        }

        .navbar-custom .nav-link.active,
        .navbar-custom .nav-link:hover {
            color: #ffe066 !important;
        }

        .notification-badge {
            position: absolute;
            top: 0.3rem;
            right: 0.5rem;
            background: #e63946;
            color: #fff;
            border-radius: 50%;
            padding: 0.22em 0.55em;
            font-size: 0.8em;
            font-weight: bold;
        }

        .footer-custom {
            background: linear-gradient(90deg, #2575fc 0%, #6a11cb 100%);
            color: #fff;
            padding: 2.5rem 0 1.2rem 0;
            margin-top: 2rem;
            border-radius: 16px 16px 0 0;
        }

        .footer-custom h5 {
            color: #ffe066;
            font-weight: 700;
            margin-bottom: 1rem;
        }

        .footer-custom a {
            color: #ffe066;
            text-decoration: underline;
        }

        .faq-question {
            cursor: pointer;
            font-weight: 600;
            margin: 0.7rem 0 0.3rem 0;
            color: #fff;
            transition: color 0.2s;
        }

        .faq-question.active,
        .faq-question:hover {
            color: #ffe066;
        }

        .faq-answer {
            display: none;
            color: #fff;
            background: rgba(37, 117, 252, 0.09);
            border-radius: 10px;
            padding: 0.5rem 0.8rem;
            margin-bottom: 0.6rem;
            font-size: 0.97rem;
        }

        @media (max-width: 991px) {
            .footer-custom {
                padding: 1.3rem 0 0.7rem 0;
            }
        }
    </style>
    @stack('styles')
</head>

<body>
    <!-- Top Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-custom fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#">
                <i class="fas fa-capsules me-2"></i>DrugFinder
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item position-relative">
                        <a class="nav-link {{ request()->routeIs('user.drugs.public_index') ? 'active' : '' }}"
                            href="{{ route('user.drugs.public_index') }}">
                            <i class="fas fa-search me-2"></i>Browse Drugs
                        </a>
                    </li>
                    <!-- Orders (restricted) -->
                    <li class="nav-item">
                        <a class="nav-link" href="javascript:void(0)" onclick="showLoginModal()">
                            <i class="fas fa-clipboard-list me-2"></i>Orders
                        </a>
                    </li>
                    <!-- Wishlist (restricted) -->
                    <li class="nav-item">
                        <a class="nav-link" href="javascript:void(0)" onclick="showLoginModal()">
                            <i class="fas fa-heart me-2"></i>Wishlist
                        </a>
                    </li>
                    <!-- <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('user.pharmacies') ? 'active' : '' }}"
                            href="{{ route('user.pharmacies') }}">
                            <i class="fas fa-map-marker-alt me-2"></i>Pharmacies
                        </a>
                    </li> -->
                    <li class="nav-item position-relative">
                        <a class="nav-link" href="javascript:void(0)" onclick="showLoginModal()">
                            <i class="fas fa-map-marker-alt me-2"></i>Pharmacies
                        </a>
                    </li>
                    <!-- Notifications (restricted) -->
                    <li class="nav-item position-relative">
                        <a class="nav-link" href="javascript:void(0)" onclick="showLoginModal()">
                            <i class="fas fa-bell me-2"></i>Notifications
                        </a>
                    </li>
                    <!-- Login Button -->
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">
                            <i class="fas fa-sign-in-alt me-2"></i>Login
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Page Content -->
    <div style="padding-top: 80px; min-height: 70vh;">
        @yield('content')
    </div>

    <!-- Footer Section -->
    <footer class="footer-custom">
        <div class="container">
            <div class="row text-center text-md-start">
                <div class="col-md-4 mb-4">
                    <h5><i class="fas fa-info-circle"></i> About Us</h5>
                    <h7>
                        DrugFinder helps you discover, search, and order medicines with ease. Our mission is to empower users with reliable drug information and seamless pharmacy access.
                    </h7>
                </div>
                <div class="col-md-4 mb-4">
                    <h5><i class="fas fa-envelope"></i> Contact Us</h5>
                    <h7>
                        <i class="fas fa-phone"></i> +251929570426<br>
                        <i class="fas fa-envelope"></i> <a href="mailto:fikaduabraham093@gmail.com">fikaduabraham093@gmail.com</a><br>
                        <i class="fas fa-map-marker-alt"></i> Sabian, Ethiopia<br>
                        <i class="fas fa-clock"></i> Mon-Fri: 9am - 6pm<br>
                        <i class="fas fa-clock"></i> Sat: 10am - 4pm<br>
                        <i class="fas fa-clock"></i> Sun: Closed<br>
                    </h7>
                </div>
                <div class="col-md-4 mb-4">
                    <h5><i class="fas fa-question-circle"></i> FAQ</h5>
                    <div>
                        <div class="faq-question"><i class="fas fa-plus-circle"></i> How do I search for a drug?</div>
                        <div class="faq-answer">Use the "Browse/Search Drugs" menu or the search bar to find medicines by name or category.</div>
                        <div class="faq-question"><i class="fas fa-plus-circle"></i> Can I order medicines online?</div>
                        <div class="faq-answer">Yes, you can order medicines and track your order history directly from your dashboard.</div>
                        <div class="faq-question"><i class="fas fa-plus-circle"></i> How do I contact support?</div>
                        <div class="faq-answer">You can email us at <a href="mailto:fikaduabraham093@gmail.com">fikaduabraham093@gmail.com</a> or call our hotline.</div>
                        <div class="faq-question"><i class="fas fa-plus-circle"></i> How do I manage my wishlist?</div>
                        <div class="faq-answer">You can add drugs to your wishlist from the drug details page and view them in your dashboard.</div>
                        <div class="faq-question"><i class="fas fa-plus-circle"></i> How do I find nearby pharmacies?</div>
                        <div class="faq-answer">Use the "Nearby Pharmacies" section in your dashboard to find pharmacies based on your location.</div>
                    </div>
                </div>
            </div>
            <div class="text-center mt-3" style="font-size:0.97rem;">
                &copy; {{ date('Y') }} DrugFinder. All rights reserved.
            </div>
        </div>
    </footer>

    <!-- Login Modal (for restricted nav links) -->
    <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="loginModalLabel"><i class="fas fa-lock"></i> Login Required</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    You need to <strong>login</strong> to access this feature.
                </div>
                <div class="modal-footer">
                    <a href="{{ route('login') }}" class="btn btn-primary">
                        <i class="fas fa-sign-in-alt"></i> Login
                    </a>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- FAQ Toggle Script and Bootstrap JS -->
    <script>
        document.querySelectorAll('.faq-question').forEach(function(q) {
            q.addEventListener('click', function() {
                this.classList.toggle('active');
                let answer = this.nextElementSibling;
                if (answer.style.display === "block") {
                    answer.style.display = "none";
                } else {
                    answer.style.display = "block";
                }
            });
        });

        function showLoginModal() {
            var myModal = new bootstrap.Modal(document.getElementById('loginModal'));
            myModal.show();
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>

</html>