<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Seller Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Bootstrap & FontAwesome --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />

    {{-- Consistent Seller Dashboard CSS --}}
    <style>
        body {
            background-image: url("{{ asset('images/hospital6.jpg') }}");
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

        /* Top Navigation Bar */
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
            position: relative;
            transition: background 0.4s, color 0.3s, box-shadow 0.3s, transform 0.2s;
        }

        .navbar-custom .nav-link:hover,
        .navbar-custom .nav-link.active {
            background: linear-gradient(90deg, #ffb347 0%, #ff5858 100%);
            color: #fff !important;
            box-shadow: 0 4px 20px 0 rgba(255, 184, 71, 0.12), 0 2px 8px 0 rgba(255, 88, 88, 0.08);
            transform: translateY(-2px) scale(1.07);
        }

        .navbar-custom .navbar-brand {
            color: #fff !important;
            font-weight: 700;
            font-size: 1.5rem;
            letter-spacing: 1px;
            text-shadow: 0 2px 8px rgba(0, 0, 0, 0.10);
        }

        /* Hero Section */
        .hero-section {
            background: linear-gradient(120deg, #fff 60%, #e0e7ff 100%);
            border-radius: 28px;
            box-shadow: 0 8px 32px rgba(32, 56, 112, 0.13), 0 1.5px 4px rgba(80, 80, 120, 0.08);
            margin: 110px auto 40px auto;
            padding: 3rem 2.5rem 2.5rem 2.5rem;
            max-width: 1100px;
            animation: fadeInUp 0.8s;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .hero-section h1 {
            font-size: 2.4rem;
            font-weight: 800;
            color: #2575fc;
            margin-bottom: 1rem;
            letter-spacing: 1.5px;
            text-shadow: 0 2px 8px rgba(100, 150, 255, 0.09);
        }

        .hero-section p {
            font-size: 1.15rem;
            color: #444;
            margin-bottom: 1.5rem;
        }

        .hero-section .welcome-user {
            font-size: 1.15rem;
            color: #6a11cb;
            font-weight: 600;
            margin-bottom: 1.5rem;
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

        @keyframes fadeInWelcome {
            0% {
                opacity: 0;
                transform: translateY(-20px);
            }

            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes slideInMessage {
            0% {
                opacity: 0;
                transform: translateX(-30px);
            }

            100% {
                opacity: 1;
                transform: translateX(0);
            }
        }

        /* Image Grid */
        .image-grid-section {
            max-width: 1100px;
            margin: 0 auto 40px auto;
            padding: 2rem 1rem;
            /* background: rgba(255, 255, 255, 0.98); */
            border-radius: 22px;
            box-shadow: 0 8px 32px rgba(32, 56, 112, 0.09), 0 1.5px 4px rgba(80, 80, 120, 0.08);
            animation: fadeInMain 0.9s;
        }

        .image-grid-title {
            font-size: 1.4rem;
            font-weight: 700;
            color: #2575fc;
            margin-bottom: 1.2rem;
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

        /* Dashboard Table and Stats */
        .dashboard-container {
            background: rgba(255, 255, 255, 0.97);
            border-radius: 22px;
            box-shadow: 0 8px 32px rgba(32, 56, 112, 0.16), 0 1.5px 4px rgba(80, 80, 120, 0.08);
            padding: 2.2rem 2.5rem 2.5rem 2.5rem;
            margin: 40px auto;
            max-width: 1100px;
            animation: fadeInUp 0.8s;
            position: relative;
        }

        .dashboard-animated-border {
            position: absolute;
            top: -6px;
            left: -6px;
            right: -6px;
            bottom: -6px;
            border-radius: 28px;
            z-index: 0;
            pointer-events: none;
            background-size: 1200% 1200%;
            animation: borderMove 14s ease infinite;
            filter: blur(5px);
        }

        @keyframes borderMove {
            0% {
                background-position: 0% 50%
            }

            50% {
                background-position: 100% 50%
            }

            100% {
                background-position: 0% 50%
            }
        }

        .seller-name-card {
            text-align: center;
            margin-bottom: 2.5rem;
            z-index: 1;
            position: relative;
        }

        .seller-name-card h2 {
            font-weight: 800;
            color: #2575fc;
            letter-spacing: 1px;
        }

        .seller-name {
            color: #ff5858;
        }

        .seller-desc {
            color: #555;
            font-size: 1.1rem;
            margin-top: 0.5rem;
        }

        .stats-row {
            display: flex;
            gap: 2rem;
            margin-bottom: 1.5rem;
            justify-content: center;
        }

        .stat-box {
            /* background: linear-gradient(120deg, #e0e7ff 0%, #f7faff 100%); */
            box-shadow: 0 2px 10px rgba(37, 117, 252, 0.09);
            border-radius: 14px;
            padding: 1.2rem 2.2rem;
            text-align: center;
            font-weight: 600;
            color: #2575fc;
            font-size: 1.15rem;
            transition: box-shadow 0.1s, transform 0.1s;
        }

        .stat-box:hover {
            box-shadow: 0 8px 32px rgba(255, 184, 71, 0.13), 0 6px 20px rgba(37, 117, 252, 0.18);
            transform: scale(1.04);
        }

        .success-message {
            color: #fff;
            border-radius: 12px;
            padding: 1rem;
            margin-bottom: 1.2rem;
            font-weight: 500;
            box-shadow: 0 2px 10px rgba(67, 206, 162, 0.13);
        }

        .add-drug-quick-form {
            margin-bottom: 1.5rem;
            text-align: right;
        }

        .btn-add-animated {
            background: linear-gradient(90deg, #ffb347 0%, #ff5858 100%);
            color: #fff;
            font-weight: 600;
            border: none;
            border-radius: 8px;
            padding: 0.7rem 1.5rem;
            box-shadow: 0 4px 16px rgba(255, 184, 71, 0.13);
            transition: background 0.2s, box-shadow 0.2s, transform 0.2s;
            margin-top: 20px;
        }

        .btn-add-animated:hover {
            background: linear-gradient(90deg, #ff5858 0%, #ffb347 100%);
            box-shadow: 0 8px 24px rgba(255, 88, 88, 0.23);
            transform: translateY(-2px) scale(1.06);
        }

        .table-title {
            margin: 2rem 0 1rem 0;
            color: #2575fc;
            font-weight: 700;
            font-size: 1.3rem;
        }

        .dashboard-table {
            width: 100%;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(37, 117, 252, 0.05);
            overflow: hidden;
            margin-bottom: 2rem;
        }

        .dashboard-table th,
        .dashboard-table td {
            padding: 0.7rem 0.75rem;
            text-align: left;
            border-bottom: 1px solid #e0e7ff;
            font-size: 1rem;
        }

        .dashboard-table th {
            background: linear-gradient(90deg, #2575fc 0%, #6a11cb 100%);
            color: #fff;
            font-weight: 600;
        }

        .dashboard-table tr:last-child td {
            border-bottom: none;
        }

        .quantity-badge.low {
            background: #ff5858;
            color: #fff;
            padding: 0.2rem 0.7rem;
            border-radius: 12px;
            font-weight: 600;
        }

        .expiry.expired {
            background: #ff5858;
            color: #fff;
            padding: 0.2rem 0.7rem;
            border-radius: 12px;
            font-weight: 600;
        }

        .actions .btn {
            margin-right: 0.3rem;
            border-radius: 8px;
            font-size: 1rem;
            padding: 0.3rem 0.7rem;
            transition: background 0.2s, color 0.2s, box-shadow 0.2s;
        }

        .btn-view {
            background: #43cea2;
            color: #fff;
        }

        .btn-edit {
            background: #ffd700;
            color: #222;
        }

        .btn-delete {
            background: #ff5858;
            color: #fff;
        }

        .actions .btn:hover {
            filter: brightness(1.1);
            box-shadow: 0 2px 10px rgba(255, 88, 88, 0.13);
        }

        .coming-soon {
            background: #ffd700;
            color: #333;
            font-weight: 600;
            font-size: 0.85em;
            border-radius: 8px;
            padding: 0.1rem 0.5rem;
            margin-left: 0.5rem;
        }

        @media (max-width: 900px) {

            .dashboard-container,
            .hero-section,
            .image-grid-section {
                padding: 1.2rem 0.5rem;
            }

            .stats-row {
                flex-direction: column;
                gap: 1rem;
            }
        }

        @media (max-width: 600px) {

            .dashboard-container,
            .hero-section,
            .image-grid-section {
                padding: 0.5rem 0.2rem;
            }
        }

        /* Footer */
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
    </style>
</head>

<body>
    {{-- HEADER / NAVIGATION --}}
    <nav class="navbar navbar-expand-lg navbar-custom fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#">
                <i class="fas fa-capsules me-2"></i>Seller Dashboard
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('seller.dashboard') ? 'active' : '' }}" href="{{ route('seller.dashboard') }}">
                            <i class="fa fa-home me-2"></i>Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('seller.drugs.index') ? 'active' : '' }}" href="{{ route('seller.drugs.index') }}">
                            <i class="fa fa-capsules me-2"></i>Manage Drugs
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('seller.drugs.create') ? 'active' : '' }}" href="{{ route('seller.drugs.create') }}">
                            <i class="fa fa-plus-circle me-2"></i>Add New Drug
                        </a>
                    </li>
                    <li class="nav-item position-relative">
                        <a class="nav-link {{ request()->routeIs('seller.orders.index') ? 'active' : '' }}" href="{{ route('seller.orders.index') }}">
                            <i class="fa fa-shopping-basket me-2"></i>Orders
                            @if(isset($pendingOrdersCount) && $pendingOrdersCount > 0)
                            <span class="badge bg-danger ms-2">{{ $pendingOrdersCount }}</span>
                            @endif
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('seller.profile.edit') ? 'active' : '' }}" href="{{ route('seller.profile.edit') }}">
                            <i class="fa fa-user me-2"></i>Profile
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link disabled" href="#">
                            <i class="fa fa-chart-bar me-2"></i>Analytics <span class="coming-soon">Coming soon</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <form method="POST" action="{{ route('seller.logout') }}">
                            @csrf
                            <button type="submit" class="nav-link btn btn-link p-0" style="color:#fff;">
                                <i class="fa fa-sign-out-alt me-2"></i>Logout
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    {{-- PAGE CONTENT --}}
    <main style="margin-top: 90px;">
        @yield('content')
    </main>

    {{-- FOOTER --}}
    <footer class="footer-custom mt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-3">
                    <h5><i class="fa fa-capsules"></i> Seller Dashboard</h5>
                    <p>Manage your drugs, orders, and profile with ease. Grow your business effortlessly!</p>
                </div>
                <div class="col-md-4 mb-3">
                    <h5>Quick Links</h5>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('seller.dashboard') }}">Dashboard</a></li>
                        <li><a href="{{ route('seller.drugs.index') }}">Manage Drugs</a></li>
                        <li><a href="{{ route('seller.orders.index') }}">Orders</a></li>
                        <li><a href="{{ route('seller.profile.edit') }}">Profile</a></li>
                    </ul>
                </div>
                <div class="col-md-4 mb-3">
                    <h5>Contact & FAQ</h5>
                    <div class="faq-question"><i class="fa fa-question-circle"></i> How to add a new drug?</div>
                    <div class="faq-answer">Go to 'Add New Drug' in the navigation and fill the form.</div>
                    <div class="faq-question"><i class="fa fa-question-circle"></i> How to view orders?</div>
                    <div class="faq-answer">Click on 'Orders' in the navigation to see all your orders.</div>
                    <div class="faq-question"><i class="fa fa-question-circle"></i> Need more help?</div>
                    <div class="faq-answer">Contact support at <a href="mailto:support@example.com">fikaduabraham093@gmail.com</a></div>
                    <div class="faq-question"><i class="fa fa-question-circle"></i> Telephone?</div>
                    <div class="faq-answer">+251929570426.</div>

                </div>
            </div>
            <div class="text-center mt-3">
                &copy; {{ date('Y') }} Seller Dashboard. All rights reserved.
            </div>
        </div>
    </footer>

    {{-- JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // FAQ toggle
        document.querySelectorAll('.faq-question').forEach(function(q) {
            q.addEventListener('click', function() {
                this.classList.toggle('active');
                var answer = this.nextElementSibling;
                if (answer.style.display === "block") {
                    answer.style.display = "none";
                } else {
                    answer.style.display = "block";
                }
            });
        });
    </script>
</body>

</html>