<!-- Sidebar Start -->
<div class="sidebar pb-3">
    <nav class="navbar bg-light navbar-light">
        <a href="/" class="navbar-brand mx-4 mb-3">
            <img src="{{ asset('img/NBM-Logo.png') }}" alt="PT. NBM Logo" width="128" height="128">
        </a>
        <div class="navbar-nav w-100">
            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle {{ $currentPage == 'dashboard' ? 'primary' : ''}}" data-bs-toggle="dropdown"><i class="fa fa-laptop me-2"></i>Dashboard</a>
                <div class="dropdown-menu bg-transparent border-0">
                    <a href="/salesman" class="dropdown-item {{ $currentPage == 'salesman' ? 'active' : ''}}">Salesman</a>
                    <a href="/storage" class="dropdown-item {{ $currentPage == 'storage' ? 'active' : ''}}">Storage</a>
                    <a href="/driver" class="dropdown-item {{ $currentPage == 'driver' ? 'active' : ''}}">Driver</a>
                </div>
            </div>
        </div>
    </nav>
</div>
<!-- Sidebar End -->
