@extends('layouts.app')

@section('content')
<!-- Bootstrap & Font Awesome -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

<style>
    body {
        background: linear-gradient(120deg, #6a11cb 0%, #2575fc 100%);
        min-height: 100vh;
        font-family: 'Poppins', sans-serif;
    }

    .navbar-custom {
        background: linear-gradient(90deg, #2575fc 0%, #6a11cb 100%);
        box-shadow: 0 8px 32px rgba(32, 56, 112, 0.16);
        padding: 0.8rem 2rem;
        animation: slideDown 0.6s;
    }

    @keyframes slideDown {
        0% {
            transform: translateY(-100%);
            opacity: 0;
        }

        100% {
            transform: translateY(0);
            opacity: 1;
        }
    }

    .navbar-custom .nav-link {
        color: rgba(255, 255, 255, 0.93) !important;
        font-weight: 500;
        padding: 0.8rem 1.5rem;
        margin: 0 0.5rem;
        border-radius: 12px;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
    }

    .navbar-custom .nav-link:hover,
    .navbar-custom .nav-link.active {
        background: rgba(218, 237, 8, 0.93);
        transform: translateY(-2px) scale(1.05);
        box-shadow: 0 4px 16px rgba(196, 17, 23, 0.96);
        color: black !important;
        font-weight: 600;
    }

    .navbar-custom .navbar-brand {
        color: #fff !important;
        font-weight: 700;
        font-size: 1.5rem;
        letter-spacing: 1px;
        text-shadow: 0 2px 8px rgb(31, 213, 101);
    }

    .hero-section {
        background: linear-gradient(120deg, #fff 60%, #e0e7ff 100%);
        border-radius: 28px;
        box-shadow: 0 8px 32px rgba(32, 56, 112, 0.13), 0 1.5px 4px rgba(80, 80, 120, 0.08);
        margin: 100px auto 40px auto;
        padding: 3.5rem 2.5rem 2.5rem 2.5rem;
        max-width: 1100px;
        animation: fadeInUp 0.8s;
        text-align: center;
        position: relative;
        overflow: hidden;
    }

    .hero-section h1 {
        font-size: 2.6rem;
        font-weight: 800;
        color: #2575fc;
        margin-bottom: 1rem;
        letter-spacing: 1.5px;
        text-shadow: 0 2px 8px rgba(100, 150, 255, 0.09);
    }

    .hero-section p {
        font-size: 1.25rem;
        color: #444;
        margin-bottom: 1.5rem;
    }

    .hero-section .welcome-user {
        font-size: 1.1rem;
        color: #6a11cb;
        font-weight: 600;
    }

    .hero-section .btn-primary {
        background: linear-gradient(90deg, #2575fc 0%, #6a11cb 100%);
        border: none;
        font-weight: 600;
        letter-spacing: 1px;
        box-shadow: 0 4px 16px rgba(37, 117, 252, 0.13);
        transition: background 0.2s, box-shadow 0.2s, transform 0.2s;
    }

    .hero-section .btn-primary:hover {
        background: linear-gradient(90deg, #6a11cb 0%, #2575fc 100%);
        box-shadow: 0 8px 24px rgba(37, 117, 252, 0.23);
        transform: translateY(-2px) scale(1.06);
    }

    @keyframes fadeInUp {
        0% {
            opacity: 0;
            transform: translateY(40px);
        }

        100% {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .image-grid-section {
        max-width: 1100px;
        margin: 0 auto 40px auto;
        padding: 2rem 1rem;
        background: rgba(255, 255, 255, 0.98);
        border-radius: 22px;
        box-shadow: 0 8px 32px rgba(32, 56, 112, 0.09), 0 1.5px 4px rgba(80, 80, 120, 0.08);
        animation: fadeInMain 0.9s;
    }

    .image-grid-title {
        font-size: 1.7rem;
        font-weight: 700;
        color: #2575fc;
        margin-bottom: 1.5rem;
        text-align: center;
        letter-spacing: 1px;
    }

    .image-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 2rem;
    }

    @media (max-width: 900px) {
        .image-grid {
            grid-template-columns: 1fr 1fr;
        }
    }

    @media (max-width: 600px) {
        .image-grid {
            grid-template-columns: 1fr;
        }
    }

    .image-card {
        border-radius: 18px;
        overflow: hidden;
        background: linear-gradient(120deg, #e0e7ff 0%, #f7faff 100%);
        box-shadow: 0 2px 10px rgba(37, 117, 252, 0.13);
        transition: transform 0.18s, box-shadow 0.18s, filter 0.18s;
        cursor: pointer;
        filter: grayscale(12%) brightness(0.98);
        position: relative;
        animation: popIn 0.7s;
    }

    .image-card:hover {
        transform: scale(1.05) rotate(-1deg);
        box-shadow: 0 8px 32px rgba(255, 88, 88, 0.13), 0 6px 20px rgba(37, 117, 252, 0.18);
        filter: none;
        border: 3px solid #ffb34744;
        z-index: 2;
    }

    .image-card img {
        width: 100%;
        height: 200px;
        object-fit: cover;
        display: block;
    }

    @keyframes popIn {
        0% {
            opacity: 0;
            transform: scale(0.95);
        }

        100% {
            opacity: 1;
            transform: scale(1);
        }
    }

    @keyframes fadeInMain {
        0% {
            opacity: 0;
            transform: translateY(30px);
        }

        100% {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .dashboard-section {
        max-width: 1100px;
        margin: 0 auto 40px auto;
        padding: 2rem 1rem;
        background: linear-gradient(120deg, #f7faff 80%, #e0e7ff 100%);
        border-radius: 22px;
        box-shadow: 0 8px 32px rgba(32, 56, 112, 0.09), 0 1.5px 4px rgba(80, 80, 120, 0.08);
    }

    .dashboard-cards {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
        gap: 1.5rem;
        margin-top: 1.2rem;
    }

    .dashboard-card {
        background: linear-gradient(135deg, #e0e7ff 0%, #f7faff 100%);
        border-radius: 16px;
        box-shadow: 0 2px 10px rgba(37, 117, 252, 0.06), 0 8px 30px 0 #ffb34722;
        padding: 1.3rem 1.1rem;
        display: flex;
        align-items: center;
        gap: 1rem;
        transition: transform 0.22s, box-shadow 0.22s;
        cursor: pointer;
        min-width: 210px;
        margin-bottom: 1rem;
        animation: popIn 0.7s;
        text-decoration: none;
        color: inherit;
        position: relative;
        overflow: hidden;
    }

    .dashboard-card::after {
        content: '';
        position: absolute;
        top: -40px;
        left: -40px;
        width: 80px;
        height: 80px;
        background: radial-gradient(circle, #ffb34755 0%, #fff0 100%);
        border-radius: 50%;
        z-index: 0;
        transition: opacity 0.4s;
        opacity: 0;
    }

    .dashboard-card:hover::after {
        opacity: 1;
        animation: float1 1.5s infinite alternate;
    }

    .dashboard-card:hover {
        transform: translateY(-4px) scale(1.04);
        box-shadow: 0 6px 20px rgba(37, 117, 252, 0.13), 0 10px 40px 0 #ffb34733;
        z-index: 2;
    }

    .dashboard-card i {
        font-size: 2rem;
        color: #6a11cb;
        opacity: 0.82;
        z-index: 1;
    }

    .dashboard-card .card-title {
        font-size: 1.13rem;
        font-weight: 600;
        color: #2575fc;
        margin-bottom: 0.2rem;
        z-index: 1;
    }

    .dashboard-card .card-desc {
        font-size: 0.98rem;
        color: #555;
        z-index: 1;
    }

    @keyframes float1 {
        0% {
            transform: translateY(0);
        }

        100% {
            transform: translateY(12px);
        }
    }

    .notification-badge {
        position: absolute;
        top: 8px;
        right: 18px;
        background: #ff5858;
        color: #fff;
        font-size: 0.85em;
        font-weight: bold;
        border-radius: 50%;
        padding: 4px 8px;
        box-shadow: 0 2px 8px #ff585855;
        z-index: 2;
        animation: popBadge 0.5s;
    }

    @keyframes popBadge {
        0% {
            transform: scale(0.2);
            opacity: 0;
        }

        80% {
            transform: scale(1.1);
            opacity: 1;
        }

        100% {
            transform: scale(1);
        }
    }

    .footer-custom {
        background: linear-gradient(90deg, #6a11cb 0%, #2575fc 100%);
        color: #fff;
        padding: 2.5rem 0 1.2rem 0;
        margin-top: 2rem;
        box-shadow: 0 -4px 16px rgba(37, 117, 252, 0.10);
        border-top-left-radius: 22px;
        border-top-right-radius: 22px;
        animation: fadeInUp 0.7s;
    }

    .footer-custom h5 {
        color: #ffe484;
        font-weight: 700;
        margin-bottom: 1rem;
    }

    .footer-custom a {
        color: #fff;
        text-decoration: none;
        transition: color 0.2s;
    }

    .footer-custom a:hover {
        color: #ffe484;
        text-decoration: underline;
    }

    .footer-custom .fa {
        margin-right: 8px;
    }

    .footer-custom .faq-question {
        cursor: pointer;
        font-weight: 500;
        color: #ffe484;
        margin-bottom: 0.5rem;
        display: flex;
        align-items: center;
        transition: color 0.2s;
    }

    .footer-custom .faq-question.active {
        color: #ffb347;
    }

    .footer-custom .faq-answer {
        display: none;
        color: #fff;
        font-size: 0.97rem;
        margin-bottom: 1rem;
        animation: fadeInMain 0.5s;
    }

    .footer-custom .faq-question.active+.faq-answer {
        display: block;
    }

    @media (max-width: 768px) {

        .hero-section,
        .image-grid-section,
        .dashboard-section {
            padding: 1.2rem 0.5rem;
        }

        .footer-custom .row>div {
            margin-bottom: 2rem;
        }
    }
</style>

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
                <!-- Browse Drugs (public) -->
                <li class="nav-item position-relative">
                    <a class="nav-link" href="{{ route('user.drugs.public_index') }}">
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
                <!-- Pharmacies (restricted) -->
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
                <li class="nav-item ms-2">
                    <a class="btn btn-outline-light" href="{{ route('login') }}">
                        <i class="fas fa-sign-in-alt me-1"></i>Login
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Hero Section -->
<div class="top">
    <div class="hero-section">
        <marquee behavior="scroll" direction="left" style="
        background: linear-gradient(90deg, #2575fc, #6a11cb);
        color: #fff;
        font-family: 'Poppins', sans-serif;
        font-size: 1.2rem;
        font-weight: 600;
        padding: 10px 20px;
        border-radius: 12px;
        box-shadow: 0 4px 16px rgba(37, 117, 252, 0.3), 0 2px 8px rgba(106, 17, 203, 0.2);
        text-shadow: 0 2px 8px rgba(255, 255, 255, 0.8);
        animation: glow 1.5s infinite alternate;
    ">
            Welcome to DrugFinder! Discover the best medicines and pharmacies near you. Your health, our priority!
        </marquee>
        <style>
            @keyframes glow {
                0% {
                    box-shadow: 0 4px 16px rgba(37, 117, 252, 0.3), 0 2px 8px rgba(106, 17, 203, 0.2);
                }

                100% {
                    box-shadow: 0 6px 20px rgba(37, 117, 252, 0.5), 0 4px 12px rgba(106, 17, 203, 0.4);
                }
            }
        </style>
        <h1>Welcome to DrugFinder!</h1>
        <p style="animation: fadeInText 1.5s ease-in-out; color: #2d6a4f; font-size: 1.3rem; font-weight: 500;">
            Discover, search, and manage your medicines easily.<br>
            Your health, our priority.
        </p>
        <p style="animation: fadeInText 2s ease-in-out; color: #40916c; font-size: 1.2rem; font-weight: 500;">
            Stay informed, stay healthy. We're here to support your journey to wellness.
        </p>
        <p style="animation: fadeInText 2.5s ease-in-out; color: #52b788; font-size: 1.2rem; font-weight: 500;">
            Explore our platform for trusted drug information and nearby pharmacies.
        </p>
        <div class="welcome-user mb-3">
            Hello, <strong>Guest</strong> 👋
        </div>
        <a href="{{ route('user.drugs.public_index') }}" class="btn btn-primary btn-lg shadow">
            <i class="fas fa-search"></i> Start Searching
        </a>
    </div>
</div>

<!-- Three-Column Image Grid -->
<div class="image-grid-section">
    <div class="image-grid-title">Explore Medicines & Categories</div>
    <div class="image-grid">
        <div class="image-card">
            <img src="/images/mic.jpg" alt="Medicine 1">
        </div>
        <div class="image-card">
            <img src="https://images.unsplash.com/photo-1505751172876-fa1923c5c528?auto=format&fit=crop&w=600&q=80" alt="Medicine 2">
        </div>
        <div class="image-card">
            <img src="/images/pharmacy.jpg" alt="Medicine 3">
        </div>
        <div class="image-card">
            <img src="https://images.unsplash.com/photo-1516574187841-cb9cc2ca948b?auto=format&fit=crop&w=600&q=80" alt="Medicine 4">
        </div>
        <div class="image-card">
            <img src="/images/hospital.jpg" alt="Medicine 5">
        </div>
        <div class="image-card">
            <img src="/images/drugs.jpg" alt="Medicine 6">
        </div>
    </div>
</div>

<!-- Dashboard Cards with Animations -->
<div class="dashboard-section">
    <div class="dashboard-cards">
        <!-- Orders (restricted) -->
        <a href="javascript:void(0)" class="dashboard-card" onclick="showLoginModal()">
            <i class="fas fa-clipboard-list"></i>
            <div>
                <div class="card-title">Orders</div>
                <div class="card-desc">View your past and current orders</div>
            </div>
        </a>
        <!-- Wishlist (restricted) -->
        <a href="javascript:void(0)" class="dashboard-card" onclick="showLoginModal()">
            <i class="fas fa-heart"></i>
            <div>
                <div class="card-title">Wishlist</div>
                <div class="card-desc">See your saved medicines</div>
            </div>
        </a>
        <!-- Notifications (restricted) -->
        <a href="javascript:void(0)" class="dashboard-card" onclick="showLoginModal()">
            <i class="fas fa-bell"></i>
            <div>
                <div class="card-title">Notifications</div>
                <div class="card-desc">Stay updated with alerts</div>
            </div>
        </a>
        <!-- Pharmacies (restricted) -->
        <a href="javascript:void(0)" class="dashboard-card" onclick="showLoginModal()">
            <i class="fas fa-map-marker-alt"></i>
            <div>
                <div class="card-title">Pharmacies</div>
                <div class="card-desc">Find pharmacies near you</div>
            </div>
        </a>
        <!-- Browse Drugs (public) -->
        <a href="{{ route('user.drugs.public_index') }}" class="dashboard-card">
            <i class="fas fa-search"></i>
            <div>
                <div class="card-title">Browse Drugs</div>
                <div class="card-desc">Search for medicines easily</div>
            </div>
        </a>
    </div>
</div>

<!-- Footer -->
<footer class="footer-custom mt-5">
    <div class="container">
        <div class="row">
            <div class="col-md-4 mb-4 mb-md-0">
                <h5><i class="fas fa-capsules"></i> DrugFinder</h5>
                <p>
                    DrugFinder helps you discover, search, and manage your medicines and pharmacies easily. Your health, our priority.
                </p>
                <div>
                    <a href="#"><i class="fab fa-facebook fa-lg"></i></a>
                    <a href="#"><i class="fab fa-twitter fa-lg"></i></a>
                    <a href="#"><i class="fab fa-instagram fa-lg"></i></a>
                    <a href="#"><i class="fab fa-linkedin fa-lg"></i></a>
                </div>
            </div>
            <div class="col-md-4 mb-4 mb-md-0">
                <h5>Quick Links</h5>
                <ul class="list-unstyled">
                    <li><a href="{{ route('user.drugs.public_index') }}">Browse Drugs</a></li>
                    <li><a href="javascript:void(0)" onclick="showLoginModal()">Orders</a></li>
                    <li><a href="javascript:void(0)" onclick="showLoginModal()">Wishlist</a></li>
                    <li><a href="javascript:void(0)" onclick="showLoginModal()">Pharmacies</a></li>
                    <li><a href="javascript:void(0)" onclick="showLoginModal()">Notifications</a></li>
                </ul>
            </div>
            <div class="col-md-4">
                <h5>FAQ</h5>
                <div class="faq-question" onclick="this.classList.toggle('active');">
                    <i class="fas fa-question-circle"></i> How do I search for a drug?
                </div>
                <div class="faq-answer">
                    Go to 'Browse Drugs' and use the search bar to find medicines by name.
                </div>
                <div class="faq-question" onclick="this.classList.toggle('active');">
                    <i class="fas fa-question-circle"></i> How do I save medicines to my wishlist?
                </div>
                <div class="faq-answer">
                    Click the heart icon next to a medicine to add it to your wishlist. (Login required)
                </div>
                <div class="faq-question" onclick="this.classList.toggle('active');">
                    <i class="fas fa-question-circle"></i> Where can I find pharmacies near me?
                </div>
                <div class="faq-answer">
                    Click on 'Pharmacies' in the dashboard or footer. (Login required)
                </div>
            </div>
        </div>
        <div class="text-center mt-4">
            &copy; {{ date('Y') }} DrugFinder. All rights reserved.
        </div>
    </div>
</footer>

<!-- Login Required Modal -->
<div class="modal fade" id="loginRequiredModal" tabindex="-1" aria-labelledby="loginRequiredModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-4 shadow">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title" id="loginRequiredModalLabel">
                    <i class="fas fa-lock text-primary me-2"></i> Access Restricted
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center py-4">
                <div class="mb-3">
                    <i class="fas fa-exclamation-triangle fa-3x text-warning"></i>
                </div>
                <div class="fw-bold fs-5 mb-2">Oops, please login, unless you can access</div>
                <p class="text-muted mb-0">You must be logged in to use this feature.</p>
            </div>
            <div class="modal-footer border-0 justify-content-center">
                <a href="{{ route('login') }}" class="btn btn-primary px-4">
                    <i class="fas fa-sign-in-alt me-1"></i> Login
                </a>
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS (required for modal) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    function showLoginModal() {
        var modal = new bootstrap.Modal(document.getElementById('loginRequiredModal'));
        modal.show();
    }
</script>
@endsection