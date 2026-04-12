<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Aplikasi Pengaduan Sekolah')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

        :root {
            --primary: #2C3E50;
            --secondary: #3498DB;
            --accent: #95A5A6;
            --light: #ECF0F1;
            --dark: #2C3E50;
            --muted: #7F8C8D;
            --sidebar-gradient: linear-gradient(180deg, #2C3E50, #34495E);
            --header-gradient: linear-gradient(135deg, #2C3E50, #34495E);
            --card-shadow: 0 4px 20px rgba(44, 62, 80, 0.08);
            --top-nav-height: 70px;
        }

        body {
            background-color: var(--light);
            font-family: 'Poppins', sans-serif;
            color: var(--dark);
            overflow-x: hidden;
        }

        body.admin-layout { padding-top: 0; }

        .admin-sidebar {
            background: var(--sidebar-gradient);
            min-height: 100vh;
            position: fixed;
            top: 0; left: 0;
            width: 260px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            z-index: 1000;
            box-shadow: 0 0 25px rgba(0, 0, 0, 0.15);
            overflow-y: auto;
            display: flex;
            flex-direction: column;
        }

        .sidebar-header {
            padding: 25px 20px;
            text-align: center;
            border-bottom: 1px solid rgba(255,255,255,0.15);
            flex-shrink: 0;
        }

        .school-icon-container {
            width: 80px; height: 80px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.15);
            display: flex; align-items: center; justify-content: center;
            margin: 0 auto 15px;
            font-size: 2.5rem; color: white;
        }

        .sidebar-header h4 { color: white; margin-bottom: 8px; font-weight: 600; font-size: 1.3rem; }
        .sidebar-header small { color: rgba(255,255,255,0.8); font-size: 0.9rem; }

        .admin-nav-link {
            color: rgba(255,255,255,0.9);
            padding: 14px 20px;
            border-radius: 10px;
            margin: 6px 10px;
            transition: all 0.3s;
            font-weight: 500;
            display: flex; align-items: center;
            font-size: 0.95rem;
            text-decoration: none;
            border: none; background: transparent;
            width: 100%; text-align: left;
            cursor: pointer; font-family: 'Poppins', sans-serif;
        }

        .admin-nav-link:hover, .admin-nav-link.active {
            background: rgba(255,255,255,0.2);
            color: white;
            transform: translateX(5px);
        }

        .admin-nav-link i { width: 28px; text-align: center; margin-right: 12px; font-size: 18px; }

        .admin-main-content {
            padding: 20px;
            padding-left: 280px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            min-height: 100vh;
            width: 100%;
        }

        .sidebar-toggle-btn {
            display: none;
            position: fixed; top: 15px; left: 15px; z-index: 1001;
            background: var(--primary); color: white; border: none;
            width: 40px; height: 40px; border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.2);
            align-items: center; justify-content: center; cursor: pointer;
        }

        .sidebar-overlay {
            display: none; position: fixed;
            top: 0; left: 0; right: 0; bottom: 0;
            background: rgba(0,0,0,0.5); z-index: 999;
            backdrop-filter: blur(2px);
        }
        .sidebar-overlay.active { display: block; }

        .admin-top-navbar {
            background: #ffffff;
            border-radius: 12px;
            padding: 10px 20px;
            box-shadow: 0 2px 10px rgba(44, 62, 80, 0.05);
            border: 1px solid rgba(44, 62, 80, 0.02);
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
            max-width: 100%;
        }

        .admin-profile-btn {
            background: #fff;
            border: 1px solid #e9ecef;
            padding: 6px 12px 6px 6px;
            border-radius: 50px;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s ease;
            cursor: pointer;
            box-shadow: 0 1px 3px rgba(0,0,0,0.02);
        }

        .admin-profile-btn:hover {
            background: #f8f9fa;
            border-color: var(--secondary);
            transform: translateY(-1px);
        }

        .admin-avatar {
            width: 32px;
            height: 32px;
            background: linear-gradient(135deg, var(--secondary), #2980B9);
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 0.9rem;
            flex-shrink: 0;
        }

        .admin-info {
            display: flex;
            flex-direction: column;
            text-align: left;
            line-height: 1.1;
        }

        .admin-name {
            font-size: 0.85rem;
            font-weight: 600;
            color: var(--dark);
        }

        .admin-role {
            font-size: 0.65rem;
            color: var(--muted);
            font-weight: 500;
        }

        @keyframes slideDown {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        body.siswa-layout { padding-top: var(--top-nav-height); }

        .top-navbar {
            background: white; height: var(--top-nav-height);
            position: fixed; top: 0; left: 0; right: 0; z-index: 1000;
            box-shadow: 0 2px 15px rgba(0,0,0,0.05);
            display: flex; align-items: center; justify-content: space-between;
            padding: 0 30px;
        }

        .navbar-brand {
            font-weight: 700; font-size: 1.2rem; color: var(--primary);
            display: flex; align-items: center; gap: 10px; text-decoration: none;
        }

        .navbar-menu { display: flex; align-items: center; gap: 20px; }

        .nav-link-custom {
            color: var(--muted); text-decoration: none;
            font-weight: 500; font-size: 0.9rem;
            padding: 8px 16px; border-radius: 8px; transition: all 0.3s;
        }

        .nav-link-custom:hover, .nav-link-custom.active {
            color: var(--primary); background: #f0f4f8;
        }

        .user-dropdown .btn {
            border: 1px solid #eee;
            background: white;
            color: var(--primary);
            font-weight: 600;
            padding: 8px 16px;
            border-radius: 50px;
            display: flex;
            align-items: center;
            gap: 10px;
            transition: all 0.3s;
            height: 45px;
        }

        .user-dropdown .btn:hover {
            background: var(--primary);
            color: white;
            border-color: var(--primary);
        }

        .siswa-info-group {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            line-height: 1.2;
        }

        .siswa-btn-name {
            font-size: 0.95rem;
            font-weight: 700;
            color: inherit;
            margin: 0;
            padding: 0;
        }

        .siswa-btn-nis {
            font-size: 0.75rem;
            font-weight: 500;
            color: var(--muted);
            margin: 0;
            padding: 0;
            opacity: 0.8;
        }

        .user-dropdown .btn:hover .siswa-btn-nis {
            color: rgba(255,255,255, 0.8);
        }

        .dropdown-menu-siswa {
            min-width: 150px;
            padding: 8px;
        }

        .siswa-main-content {
           padding: 30px; width: 100%; max-width: 1500px; margin: 0 auto;
        }

        .card {
            border-radius: 18px; box-shadow: var(--card-shadow);
            margin-bottom: 24px; border: none;
            transition: transform 0.3s, box-shadow 0.3s;
            overflow: hidden; border: 1px solid rgba(44, 62, 80, 0.05);
        }
        .card:hover { transform: translateY(-6px); box-shadow: 0 6px 25px rgba(44, 62, 80, 0.12); }

        .card-header {
            background: var(--header-gradient); color: white;
        border-radius: 18px 18px 0 0 !important;
            padding: 18px 24px; font-weight: 600;
            display: flex; align-items: center; gap: 12px; font-size: 1.1rem;
        }

        @media (max-width: 992px) {
            .admin-sidebar { width: 230px; }
            .admin-main-content { padding-left: 250px; }
        }

        @media (max-width: 768px) {
            .admin-sidebar { transform: translateX(-100%); width: 260px; box-shadow: none; }
            .admin-sidebar.active { transform: translateX(0); box-shadow: 5px 0 25px rgba(0,0,0,0.3); }
            .admin-main-content { padding: 60px 20px 20px; padding-left: 20px; width: 100%; }
            .sidebar-toggle-btn { display: flex; }

            .admin-top-navbar { padding: 10px 15px; flex-direction: column; gap: 10px; text-align: center; }
            .admin-info { display: none; }
            .admin-profile-btn { padding: 4px 8px; }

            /* MOBILE SISWA */
            .top-navbar { padding: 0 15px; height: 60px; }
            .navbar-brand span { display: none; }
            .nav-link-custom span { display: none; }
            .nav-link-custom i { font-size: 1.2rem; margin: 0; }

            .siswa-main-content { padding: 20px 15px; }

            .user-dropdown .btn {
                padding: 6px 12px;
                height: auto;
                gap: 8px;
            }

            .siswa-btn-name { font-size: 0.85rem; }
            .siswa-btn-nis { font-size: 0.7rem; }

        }
    </style>
</head>
<body class="{{ auth()->guard('admin')->check() ? 'admin-layout' : 'siswa-layout' }}">

    @if(auth()->guard('admin')->check())
        <button class="sidebar-toggle-btn" onclick="toggleSidebar()">
            <i class="fas fa-bars"></i>
        </button>
        <div class="sidebar-overlay" onclick="toggleSidebar()"></div>

        <div class="admin-sidebar" id="mainSidebar">
            <div class="sidebar-header">
                <div class="school-icon-container">
                    <i class="fas fa-school"></i>
                </div>
                <h4>ADMIN</h4>
                <small>Pengaduan Sekolah</small>
            </div>

            <ul class="nav flex-column mt-4 px-3 flex-grow-1">
                <li class="nav-item">
                    <a href="{{ route('admin.dashboard') }}" class="admin-nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <i class="fas fa-home"></i>
                        <span class="nav-text">Dashboard</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.aspirasi.index') }}" class="admin-nav-link {{ request()->routeIs('admin.aspirasi.*') ? 'active' : '' }}">
                        <i class="fas fa-clipboard-list"></i>
                        <span class="nav-text">Daftar Pengaduan</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.siswa.index') }}" class="admin-nav-link {{ request()->routeIs('admin.siswa.*') ? 'active' : '' }}">
                      <i class="fas fa-user-graduate"></i>
                        <span class="nav-text">Daftar Siswa</span>
                    </a>
                </li>

                <li class="nav-item mt-auto mb-3">
                    <form method="POST" action="{{ route('admin.logout') }}" class="d-inline w-100">
                        @csrf
                       <button class="admin-nav-link logout-btn">
                            <i class="fa-solid fa-right-from-bracket"></i>
                            <span>Logout</span>
                        </button>
                    </form>
                </li>
            </ul>
        </div>

        <div class="admin-main-content">
            <nav class="admin-top-navbar">
                <div class="d-flex align-items-center">
                    <h4 class="mb-0 fw-bold text-dark m-0" style="font-size: 1.1rem;">
                        @yield('title', 'Dashboard Admin')
                    </h4>
                </div>

                <div class="d-flex align-items-center">
                    <div class="dropdown">
                        <button class="admin-profile-btn" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <div class="admin-avatar">
                                {{ substr(auth()->guard('admin')->user()->username, 0, 1) }}
                            </div>
                            <div class="admin-info">
                                <span class="admin-name">{{ auth()->guard('admin')->user()->username }}</span>
                                <span class="admin-role">Administrator</span>
                            </div>
                            <i class="fas fa-chevron-down ms-2 text-muted" style="font-size: 0.7rem;"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end shadow-lg border-0 mt-2 animate-dropdown">
                            <li>
                                <form method="POST" action="{{ route('admin.logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item py-2 text-danger">
                                        <i class="fas fa-sign-out-alt me-2"></i> Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>

            <div class="container-fluid">
                @yield('content')
            </div>
        </div>

    @elseif(auth()->guard('siswa')->check())
        <nav class="top-navbar">
            <a href="{{ route('siswa.dashboard') }}" class="navbar-brand">
                <i class="fas fa-school fa-lg"></i>
                <span>Pengaduan Sekolah</span>
            </a>

            <div class="navbar-menu">
                <a href="{{ route('siswa.dashboard') }}" class="nav-link-custom {{ request()->routeIs('siswa.dashboard') ? 'active' : '' }}">
                    <i class="fas fa-home me-1"></i> <span>Dashboard</span>
                </a>

                <div class="user-dropdown dropdown">
                    <button class="btn btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown">
                        <i class="fas fa-user-graduate"></i>
                        <div class="siswa-info-group">
                            <span class="siswa-btn-name">{{ auth()->guard('siswa')->user()->name }}</span>
                            <span class="siswa-btn-nis">{{ auth()->guard('siswa')->user()->nis }}</span>
                        </div>
                    </button>

                    <ul class="dropdown-menu dropdown-menu-end shadow border-0 dropdown-menu-siswa">
                        <li>
                            <form method="POST" action="{{ route('siswa.logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item text-danger d-flex align-items-center">
                                    <i class="fas fa-sign-out-alt me-2"></i> Logout
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="siswa-main-content">
            @yield('content')
        </div>
    @endif

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    @if(auth()->guard('admin')->check())
    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('mainSidebar');
            const overlay = document.querySelector('.sidebar-overlay');
            if (sidebar && overlay) {
                sidebar.classList.toggle('active');
                overlay.classList.toggle('active');
                if (window.innerWidth <= 768) {
                    document.body.style.overflow = sidebar.classList.contains('active') ? 'hidden' : 'auto';
                }
            }
        }
    </script>
    @endif
</body>
</html>
