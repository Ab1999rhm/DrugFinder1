<!-- Top Navigation Bar -->
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
