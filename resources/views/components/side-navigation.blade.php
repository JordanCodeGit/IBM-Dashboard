<!-- Sidebar Start -->
<div class="sidebar pb-3">
    <nav class="navbar bg-light navbar-light">
        <a href="/" class="navbar-brand mx-4 mb-3">
            <img src="{{ asset('img/NBM-Logo.png') }}" alt="PT. NBM Logo" width="128" height="128">
        </a>
        <div class="navbar-nav w-100">
            <a href="/" class="nav-item nav-link {{ $currentPage == 'dashboard' ? 'active' : ''}}"><i class="bi bi-speedometer2 me-2"></i>Dashboard</a>
            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle {{ $currentPage == 'salesman' || $currentPage == 'warehouse' || $currentPage == 'driver' ? 'active' : ''}}" data-bs-toggle="dropdown"><i class="bi bi-bar-chart-line-fill me-2"></i>Statistics</a>
                <div class="dropdown-menu bg-transparent border-0">
                    <a href="/salesman" class="dropdown-item {{ $currentPage == 'salesman' ? 'active' : ''}}">Salesman</a>
                    <a href="/warehouse" class="dropdown-item {{ $currentPage == 'warehouse' ? 'active' : ''}}">Warehouse</a>
                    <a href="/driver" class="dropdown-item {{ $currentPage == 'driver' ? 'active' : ''}}">Driver</a>
                </div>
            </div>
            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle {{ $currentPage == 'salesman-kpi' ? 'active' : ''}}" data-bs-toggle="dropdown"><i class="bi bi-card-text me-2"></i>Forms</a>
                <div class="dropdown-menu bg-transparent border-0">
                    <a href="/form/salesman-kpi" class="dropdown-item {{ $currentPage == 'salesman-kpi' ? 'active' : ''}}">Salesman KPI</a>
                </div>
            </div>
            <a href="/settings" class="nav-item nav-link {{ $currentPage == 'settings' ? 'active' : ''}}"><i class="bi bi-gear-fill me-2"></i>Settings</a>
            <a href="/help" class="nav-item nav-link {{ $currentPage == 'help' ? 'active' : ''}}"><i class="bi bi-book-half me-2"></i>Help & Guides</a>
        </div>
    </nav>
</div>
<!-- Sidebar End -->
