<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Admin Panel | @yield('title', 'Dashboard')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!-- Bootstrap CSS CDN -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        rel="stylesheet"
    />
    <style>
        /* Body and Background */
        body {
            background: linear-gradient(135deg, #1e3c72, #2a5298);
            /* subtle blue gradient */
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
            color: #f0f0f5;
            min-height: 100vh;
            margin: 0;
            overflow-x: hidden;
            transition: background 0.5s ease;
        }

        /* Navbar */
        .navbar {
            background: linear-gradient(90deg, #0f2027, #203a43, #2c5364);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.5);
            border-bottom: 3px solid #00bfff;
            transition: background 0.3s ease;
        }
        .navbar-brand {
            font-weight: 700;
            font-size: 1.5rem;
            color: #00bfff !important;
            text-shadow: 0 0 5px #00bfff;
            letter-spacing: 1px;
            transition: color 0.3s ease;
        }
        .navbar-brand:hover {
            color: #66d9ff !important;
            text-shadow: 0 0 10px #66d9ff;
        }

        /* Logout Button */
        .btn-outline-light {
            border: 2px solid #00bfff;
            color: #00bfff;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 0 8px #00bfff;
        }
        .btn-outline-light:hover {
            background-color: #00bfff;
            color: #1e3c72;
            box-shadow: 0 0 15px #00e5ff;
            border-color: #00e5ff;
        }

        /* Sidebar */
        .sidebar {
            background: #121c2a;
            color: #a0aec0;
            min-height: 100vh;
            padding-top: 1.5rem;
            box-shadow: 2px 0 15px rgba(0, 0, 0, 0.7);
            border-right: 1px solid #00bfff;
            position: fixed;
            width: 220px;
            transition: background 0.3s ease;
        }
        .sidebar h5 {
            color: #00bfff;
            text-shadow: 0 0 5px #00bfff;
            margin-bottom: 1.5rem;
            font-weight: 700;
            letter-spacing: 1.2px;
        }

        /* Sidebar links */
        .sidebar a {
            color: #a0aec0;
            display: block;
            padding: 0.75rem 1.5rem;
            font-weight: 600;
            border-radius: 8px;
            margin: 0.3rem 1rem;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            box-shadow: inset 0 0 0 0 #00bfff;
        }
        .sidebar a::before {
            content: "";
            position: absolute;
            left: 0;
            top: 0;
            height: 100%;
            width: 4px;
            background: #00bfff;
            border-radius: 8px 0 0 8px;
            transform: scaleY(0);
            transition: transform 0.3s ease;
            transform-origin: top;
        }
        .sidebar a:hover,
        .sidebar a.active {
            color: #00e5ff;
            background: rgba(0, 191, 255, 0.15);
            box-shadow: 0 0 15px #00e5ff;
        }
        .sidebar a:hover::before,
        .sidebar a.active::before {
            transform: scaleY(1);
        }

        /* Main content */
        main.col-md-10 {
            margin-left: 220px;
            padding: 2rem 3rem;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 15px;
            box-shadow: 0 0 30px rgba(0, 191, 255, 0.2);
            min-height: calc(100vh - 70px);
            transition: background 0.3s ease;
        }

        /* Headings inside main */
        main h1,
        main h2,
        main h3 {
            color: #00bfff;
            text-shadow: 0 0 8px #00bfff;
            margin-bottom: 1.5rem;
        }

        /* Smooth link transitions */
        a {
            text-decoration: none;
            transition: color 0.3s ease;
        }
        a:hover {
            color: #00e5ff;
            text-shadow: 0 0 8px #00e5ff;
        }

        /* Add subtle animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        main {
            animation: fadeInUp 0.8s ease forwards;
        }

        /* Scrollbar styling for sidebar */
        .sidebar::-webkit-scrollbar {
            width: 8px;
        }
        .sidebar::-webkit-scrollbar-track {
            background: #121c2a;
        }
        .sidebar::-webkit-scrollbar-thumb {
            background: #00bfff;
            border-radius: 10px;
            box-shadow: 0 0 5px #00bfff;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .sidebar {
                position: relative;
                width: 100%;
                min-height: auto;
                box-shadow: none;
                border-right: none;
            }
            main.col-md-10 {
                margin-left: 0;
                padding: 1rem 1.5rem;
                min-height: auto;
            }
        }

        /* Button glowing effect on focus */
        button:focus,
        .btn:focus {
            outline: none;
            box-shadow: 0 0 10px 3px #00bfff;
            transition: box-shadow 0.3s ease;
        }

        /* ===========================
           Enhanced Table Styles
        =========================== */
        table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0 12px;
            background: rgba(255, 255, 255, 0.15);
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0, 191, 255, 0.15);
            overflow: hidden;
            color: #e0e7ff;
            font-weight: 600;
            transition: box-shadow 0.3s ease;
        }

        thead tr {
            background: linear-gradient(90deg, #00bfff, #66d9ff);
            color: #fff;
            text-transform: uppercase;
            font-size: 0.9rem;
            letter-spacing: 0.1em;
        }

        thead th {
            padding: 12px 20px;
            border: none;
            box-shadow: inset 0 -2px 5px rgba(255, 255, 255, 0.2);
        }

        tbody tr {
            background: rgba(255, 255, 255, 0.07);
            box-shadow: 0 2px 10px rgba(0, 191, 255, 0.1);
            border-radius: 10px;
            transition: background-color 0.3s ease, box-shadow 0.3s ease;
            cursor: default;
        }

        tbody tr:hover {
            background: rgba(0, 191, 255, 0.15);
            box-shadow: 0 4px 20px rgba(0, 191, 255, 0.4);
            color: #ffffff;
        }

        tbody td {
            padding: 15px 20px;
            border: none;
            vertical-align: middle;
        }

        /* Add glowing border on row focus (for accessibility) */
        tbody tr:focus-within {
            outline: none;
            box-shadow: 0 0 15px 3px #00e5ff;
            background: rgba(0, 229, 255, 0.2);
            color: #ffffff;
        }

        /* Responsive table */
        @media (max-width: 992px) {
            table {
                font-size: 0.9rem;
            }
            thead tr {
                font-size: 0.8rem;
            }
        }

        @media (max-width: 576px) {
            main.col-md-10 {
                padding: 1rem 1rem;
            }
            table {
                font-size: 0.85rem;
            }
            thead tr {
                font-size: 0.75rem;
            }
        }
    </style>
    @yield('head')
</head>
<body>
    <nav class="navbar navbar-expand-md navbar-dark bg-dark">
        <a class="navbar-brand" href="{{ route('admin.dashboard') }}">Admin Panel</a>
        <div class="ml-auto">
            <form action="{{ route('admin.logout') }}" method="POST" style="display:inline;">
                @csrf
                <button type="submit" class="btn btn-outline-light btn-sm">Logout</button>
            </form>
        </div>
    </nav>
    <div class="container-fluid">
        <div class="row">
            <nav class="col-md-2 sidebar">
                <h5 class="text-center mt-2">Menu</h5>
                <a
                    href="{{ route('admin.dashboard') }}"
                    class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"
                    >Dashboard</a
                >
                <a
                    href="{{ route('admin.sellers') }}"
                    class="nav-link {{ request()->routeIs('admin.sellers') ? 'active' : '' }}"
                    >Sellers</a
                >
                <a
                    href="{{ route('admin.users') }}"
                    class="nav-link {{ request()->routeIs('admin.users') ? 'active' : '' }}"
                    >Users</a
                >
                <!-- <a
                    href="{{ route('admin.pharmacies') }}"
                    class="nav-link {{ request()->routeIs('admin.pharmacies') ? 'active' : '' }}"
                    >Pharmacies</a
                > -->
                <a
                    href="{{ route('admin.drugs') }}"
                    class="nav-link {{ request()->routeIs('admin.drugs') ? 'active' : '' }}"
                    >Drugs</a
                >
                <a
                    href="{{ route('admin.orders') }}"
                    class="nav-link {{ request()->routeIs('admin.orders') ? 'active' : '' }}"
                    >Orders</a
                >
            </nav>
            <main class="col-md-10 py-4">
                @yield('content')
                <!-- Example table for demonstration -->
              
            </main>
        </div>
    </div>
    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')
</body>
</html>
