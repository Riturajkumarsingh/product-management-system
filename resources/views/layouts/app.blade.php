<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="Product Management System – Manage your products efficiently">
    <title>@yield('title', 'Dashboard') | Product Management</title>

    {{-- Bootstrap 5 CSS --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    {{-- Bootstrap Icons --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    {{-- Google Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        :root {
            --sidebar-width: 270px;
            --sidebar-bg: #0f172a;
            --sidebar-border: #1e293b;
            --sidebar-text: #94a3b8;
            --sidebar-active: #6366f1;
            --sidebar-active-bg: rgba(99,102,241,0.15);
            --topbar-bg: #ffffff;
            --body-bg: #f1f5f9;
            --card-bg: #ffffff;
            --accent: #6366f1;
            --accent-dark: #4f46e5;
            --success: #10b981;
            --danger: #ef4444;
            --warning: #f59e0b;
            --info: #3b82f6;
            --text-primary: #0f172a;
            --text-muted: #64748b;
            --border: #e2e8f0;
            --shadow: 0 1px 3px rgba(0,0,0,.08), 0 4px 16px rgba(0,0,0,.04);
            --shadow-lg: 0 10px 40px rgba(0,0,0,.12);
            --radius: 12px;
            --radius-sm: 8px;
            --transition: all .2s ease;
        }

        * { box-sizing: border-box; }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--body-bg);
            color: var(--text-primary);
            margin: 0;
            overflow-x: hidden;
        }

        /* ── Sidebar ─────────────────────────────────────── */
        #sidebar {
            position: fixed;
            top: 0; left: 0; bottom: 0;
            width: var(--sidebar-width);
            background: var(--sidebar-bg);
            z-index: 1050;
            display: flex;
            flex-direction: column;
            transition: transform .3s ease;
            overflow-y: auto;
            overflow-x: hidden;
        }

        .sidebar-brand {
            padding: 24px 20px 20px;
            border-bottom: 1px solid var(--sidebar-border);
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
        }

        .brand-icon {
            width: 40px; height: 40px;
            background: linear-gradient(135deg, var(--accent), #8b5cf6);
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.2rem; color: #fff;
            flex-shrink: 0;
        }

        .brand-text {
            font-size: .85rem;
            font-weight: 700;
            color: #fff;
            line-height: 1.2;
        }

        .brand-sub {
            font-size: .7rem;
            color: var(--sidebar-text);
            font-weight: 400;
        }

        .sidebar-section {
            padding: 20px 12px 8px;
        }

        .sidebar-section-label {
            font-size: .65rem;
            font-weight: 600;
            letter-spacing: .1em;
            color: #475569;
            text-transform: uppercase;
            padding: 0 8px;
            margin-bottom: 6px;
        }

        .sidebar-nav {
            list-style: none;
            padding: 0; margin: 0;
        }

        .sidebar-nav li a {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 10px 12px;
            border-radius: var(--radius-sm);
            color: var(--sidebar-text);
            text-decoration: none;
            font-size: .875rem;
            font-weight: 500;
            transition: var(--transition);
            margin-bottom: 2px;
        }

        .sidebar-nav li a i {
            font-size: 1.1rem;
            width: 20px;
            text-align: center;
            flex-shrink: 0;
        }

        .sidebar-nav li a:hover,
        .sidebar-nav li a.active {
            background: var(--sidebar-active-bg);
            color: #c7d2fe;
        }

        .sidebar-nav li a.active {
            color: #a5b4fc;
            border-left: 3px solid var(--sidebar-active);
            padding-left: 9px;
        }

        .sidebar-footer {
            margin-top: auto;
            padding: 16px 12px;
            border-top: 1px solid var(--sidebar-border);
        }

        .user-card {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px;
            border-radius: var(--radius-sm);
            background: rgba(255,255,255,.04);
        }

        .user-avatar {
            width: 36px; height: 36px;
            background: linear-gradient(135deg, var(--accent), #8b5cf6);
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            font-size: .875rem; font-weight: 700; color: #fff;
            flex-shrink: 0;
        }

        .user-name {
            font-size: .8rem;
            font-weight: 600;
            color: #e2e8f0;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .user-email {
            font-size: .7rem;
            color: var(--sidebar-text);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        /* ── Main Content ────────────────────────────────── */
        #main-content {
            margin-left: var(--sidebar-width);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            transition: margin-left .3s ease;
        }

        /* ── Top Navbar ──────────────────────────────────── */
        #topbar {
            background: var(--topbar-bg);
            border-bottom: 1px solid var(--border);
            padding: 0 24px;
            height: 64px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 100;
            box-shadow: 0 1px 3px rgba(0,0,0,.06);
        }

        .topbar-left {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .btn-sidebar-toggle {
            border: none;
            background: transparent;
            font-size: 1.25rem;
            color: var(--text-muted);
            cursor: pointer;
            padding: 6px;
            border-radius: 6px;
            transition: var(--transition);
        }

        .btn-sidebar-toggle:hover {
            background: var(--body-bg);
            color: var(--text-primary);
        }

        .page-title {
            font-size: 1rem;
            font-weight: 600;
            color: var(--text-primary);
        }

        .topbar-right {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        /* ── Page Content ────────────────────────────────── */
        .page-content {
            flex: 1;
            padding: 28px 24px;
        }

        /* ── Cards ───────────────────────────────────────── */
        .card {
            background: var(--card-bg);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            box-shadow: var(--shadow);
        }

        .card-header {
            background: transparent;
            border-bottom: 1px solid var(--border);
            padding: 18px 20px;
            font-weight: 600;
            font-size: .9rem;
        }

        .card-body { padding: 20px; }

        /* ── Stat Cards ──────────────────────────────────── */
        .stat-card {
            background: var(--card-bg);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 20px;
            display: flex;
            align-items: center;
            gap: 16px;
            box-shadow: var(--shadow);
            transition: transform .2s ease, box-shadow .2s ease;
        }

        .stat-card:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-lg);
        }

        .stat-icon {
            width: 52px; height: 52px;
            border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.4rem;
            flex-shrink: 0;
        }

        .stat-icon.purple { background: rgba(99,102,241,.12); color: var(--accent); }
        .stat-icon.green  { background: rgba(16,185,129,.12); color: var(--success); }
        .stat-icon.blue   { background: rgba(59,130,246,.12); color: var(--info); }
        .stat-icon.orange { background: rgba(245,158,11,.12); color: var(--warning); }

        .stat-value {
            font-size: 1.6rem;
            font-weight: 800;
            color: var(--text-primary);
            line-height: 1;
        }

        .stat-label {
            font-size: .8rem;
            color: var(--text-muted);
            font-weight: 500;
            margin-top: 4px;
        }

        /* ── Buttons ─────────────────────────────────────── */
        .btn {
            border-radius: var(--radius-sm);
            font-weight: 500;
            font-size: .875rem;
            transition: var(--transition);
        }

        .btn-primary {
            background: var(--accent);
            border-color: var(--accent);
        }

        .btn-primary:hover {
            background: var(--accent-dark);
            border-color: var(--accent-dark);
            transform: translateY(-1px);
        }

        .btn-sm { font-size: .8rem; padding: 4px 10px; }

        /* ── Table ───────────────────────────────────────── */
        .table th {
            font-size: .75rem;
            font-weight: 600;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: .05em;
            border-bottom: 2px solid var(--border);
            background: #f8fafc;
        }

        .table td {
            vertical-align: middle;
            font-size: .875rem;
            border-color: var(--border);
        }

        .table tbody tr:hover { background: #f8fafc; }

        /* ── Product Image ───────────────────────────────── */
        .product-img {
            width: 48px; height: 48px;
            object-fit: cover;
            border-radius: var(--radius-sm);
            border: 1px solid var(--border);
        }

        .no-img {
            width: 48px; height: 48px;
            background: #f1f5f9;
            border-radius: var(--radius-sm);
            display: flex; align-items: center; justify-content: center;
            color: #cbd5e1;
            font-size: 1.25rem;
            border: 1px solid var(--border);
        }

        /* ── Badges ──────────────────────────────────────── */
        .badge {
            font-size: .7rem;
            font-weight: 600;
            padding: 4px 10px;
            border-radius: 20px;
        }

        /* ── Forms ───────────────────────────────────────── */
        .form-control, .form-select {
            border-radius: var(--radius-sm);
            border: 1px solid var(--border);
            font-size: .875rem;
            padding: 8px 12px;
            transition: var(--transition);
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--accent);
            box-shadow: 0 0 0 3px rgba(99,102,241,.15);
        }

        .form-label {
            font-size: .8rem;
            font-weight: 600;
            color: var(--text-muted);
            margin-bottom: 6px;
        }

        /* ── Image Preview ───────────────────────────────── */
        .image-preview-container {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 10px;
        }

        .image-preview-item {
            position: relative;
            width: 90px; height: 90px;
        }

        .image-preview-item img {
            width: 100%; height: 100%;
            object-fit: cover;
            border-radius: var(--radius-sm);
            border: 2px solid var(--border);
        }

        .image-preview-remove {
            position: absolute;
            top: -6px; right: -6px;
            width: 22px; height: 22px;
            background: var(--danger);
            color: #fff;
            border: none;
            border-radius: 50%;
            font-size: .7rem;
            cursor: pointer;
            display: flex; align-items: center; justify-content: center;
            transition: var(--transition);
        }

        .image-preview-remove:hover { transform: scale(1.1); }

        /* ── Gallery ─────────────────────────────────────── */
        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(160px, 1fr));
            gap: 12px;
        }

        .gallery-item img {
            width: 100%;
            aspect-ratio: 1;
            object-fit: cover;
            border-radius: var(--radius-sm);
            border: 1px solid var(--border);
            cursor: pointer;
            transition: transform .2s ease, box-shadow .2s ease;
        }

        .gallery-item img:hover {
            transform: scale(1.03);
            box-shadow: var(--shadow-lg);
        }

        /* ── Alerts ──────────────────────────────────────── */
        .alert {
            border: none;
            border-radius: var(--radius-sm);
            font-size: .875rem;
            font-weight: 500;
            border-left: 4px solid transparent;
        }

        .alert-success { border-left-color: var(--success); background: rgba(16,185,129,.08); color: #065f46; }
        .alert-danger  { border-left-color: var(--danger);  background: rgba(239,68,68,.08);  color: #991b1b; }
        .alert-warning { border-left-color: var(--warning); background: rgba(245,158,11,.08); color: #78350f; }
        .alert-info    { border-left-color: var(--info);    background: rgba(59,130,246,.08);  color: #1e3a5f; }

        /* ── Sidebar Overlay (mobile) ────────────────────── */
        #sidebar-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,.5);
            z-index: 1040;
        }

        /* ── Pagination ──────────────────────────────────── */
        .pagination .page-link {
            border-radius: 6px !important;
            margin: 0 2px;
            font-size: .8rem;
            color: var(--accent);
            border-color: var(--border);
        }

        .pagination .page-item.active .page-link {
            background: var(--accent);
            border-color: var(--accent);
        }

        /* ── Spinner ─────────────────────────────────────── */
        .spinner-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(255,255,255,.6);
            z-index: 9999;
            align-items: center;
            justify-content: center;
        }

        /* ── Sort icons ──────────────────────────────────── */
        .sort-link {
            color: inherit;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 4px;
        }
        .sort-link:hover { color: var(--accent); }

        /* ── Responsive ──────────────────────────────────── */
        @media (max-width: 768px) {
            #sidebar { transform: translateX(-100%); }
            #sidebar.open { transform: translateX(0); }
            #sidebar-overlay.open { display: block; }
            #main-content { margin-left: 0; }
            .page-content { padding: 16px; }
            .stat-value { font-size: 1.3rem; }
        }

        /* ── Loading animation ───────────────────────────── */
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(16px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        .fade-in-up { animation: fadeInUp .4s ease forwards; }
    </style>

    @stack('styles')
</head>
<body>

{{-- Sidebar Overlay (mobile) --}}
<div id="sidebar-overlay" onclick="closeSidebar()"></div>

{{-- Loading Spinner --}}
<div class="spinner-overlay" id="spinner-overlay">
    <div class="spinner-border text-primary" role="status" style="width:3rem;height:3rem;">
        <span class="visually-hidden">Loading...</span>
    </div>
</div>

{{-- ── Sidebar ───────────────────────────────── --}}
<nav id="sidebar">
    {{-- Brand --}}
    <a href="{{ route('dashboard') }}" class="sidebar-brand">
        <div class="brand-icon"><i class="bi bi-box-seam-fill"></i></div>
        <div>
            <div class="brand-text">Product Manager</div>
            <div class="brand-sub">Management System</div>
        </div>
    </a>

    {{-- Main Nav --}}
    <div class="sidebar-section">
        <div class="sidebar-section-label">Main Menu</div>
        <ul class="sidebar-nav">
            <li>
                <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <i class="bi bi-grid-fill"></i> Dashboard
                </a>
            </li>
            <li>
                <a href="{{ route('products.index') }}" class="{{ request()->routeIs('products.*') ? 'active' : '' }}">
                    <i class="bi bi-box-seam"></i> Products
                </a>
            </li>
            <li>
                <a href="{{ route('products.create') }}">
                    <i class="bi bi-plus-circle-fill"></i> Add Product
                </a>
            </li>
        </ul>
    </div>

    {{-- Account Nav --}}
    <div class="sidebar-section">
        <div class="sidebar-section-label">Account</div>
        <ul class="sidebar-nav">
            <li>
                <a href="#" onclick="document.getElementById('logout-form').submit(); return false;">
                    <i class="bi bi-box-arrow-right"></i> Logout
                </a>
            </li>
        </ul>
    </div>

    {{-- User Info --}}
    <div class="sidebar-footer">
        <div class="user-card">
            <div class="user-avatar">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</div>
            <div style="min-width:0">
                <div class="user-name">{{ auth()->user()->name }}</div>
                <div class="user-email">{{ auth()->user()->email }}</div>
            </div>
        </div>
    </div>
</nav>

{{-- Logout Form --}}
<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
    @csrf
</form>

{{-- ── Main Content ──────────────────────────── --}}
<div id="main-content">

    {{-- Top Navbar --}}
    <header id="topbar">
        <div class="topbar-left">
            <button class="btn-sidebar-toggle" id="sidebar-toggle" onclick="toggleSidebar()" title="Toggle Sidebar">
                <i class="bi bi-list"></i>
            </button>
            <span class="page-title">@yield('page-title', 'Dashboard')</span>
        </div>
        <div class="topbar-right">
            <div class="dropdown">
                <button class="btn btn-light btn-sm dropdown-toggle d-flex align-items-center gap-2" data-bs-toggle="dropdown" id="userDropdown">
                    <div class="user-avatar" style="width:28px;height:28px;font-size:.75rem;">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>
                    <span class="d-none d-md-inline" style="font-size:.8rem;font-weight:600;">{{ auth()->user()->name }}</span>
                </button>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><h6 class="dropdown-header">{{ auth()->user()->email }}</h6></li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <a class="dropdown-item text-danger" href="#"
                           onclick="document.getElementById('logout-form').submit(); return false;">
                            <i class="bi bi-box-arrow-right me-2"></i>Logout
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </header>

    {{-- Page Content --}}
    <main class="page-content">

        {{-- Flash Alerts --}}
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show mb-3" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show mb-3" role="alert">
                <i class="bi bi-exclamation-circle-fill me-2"></i>{{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @yield('content')
    </main>

</div>{{-- /main-content --}}

{{-- Bootstrap 5 JS --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
    // ── Sidebar toggle ──────────────────────────────
    function toggleSidebar() {
        const sidebar  = document.getElementById('sidebar');
        const overlay  = document.getElementById('sidebar-overlay');
        const isMobile = window.innerWidth <= 768;

        if (isMobile) {
            sidebar.classList.toggle('open');
            overlay.classList.toggle('open');
        } else {
            const main    = document.getElementById('main-content');
            const isHidden = sidebar.style.transform === 'translateX(-100%)';
            if (isHidden) {
                sidebar.style.transform = '';
                main.style.marginLeft   = 'var(--sidebar-width)';
            } else {
                sidebar.style.transform = 'translateX(-100%)';
                main.style.marginLeft   = '0';
            }
        }
    }

    function closeSidebar() {
        document.getElementById('sidebar').classList.remove('open');
        document.getElementById('sidebar-overlay').classList.remove('open');
    }

    // ── Spinner on form submit ──────────────────────
    function showSpinner() {
        const s = document.getElementById('spinner-overlay');
        s.style.display = 'flex';
    }

    // ── Auto-dismiss alerts ─────────────────────────
    setTimeout(() => {
        document.querySelectorAll('.alert').forEach(a => {
            const bsAlert = new bootstrap.Alert(a);
            bsAlert.close();
        });
    }, 5000);
</script>

@stack('scripts')
</body>
</html>
