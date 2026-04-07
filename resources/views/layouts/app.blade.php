<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Aplikasi Pengaduan Sarana Sekolah')</title>

    <!-- CSS Bootstrap & FontAwesome -->
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
        }

        body {
            background-color: var(--light);
            font-family: 'Poppins', sans-serif;
            color: var(--dark);
            overflow-x: hidden;
        }

        /* PENTING: Tambahkan display flex column agar mt-auto bekerja */
        .sidebar {
            background: var(--sidebar-gradient);
            min-height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            width: 260px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            z-index: 1000;
            box-shadow: 0 0 25px rgba(0, 0, 0, 0.15);
            overflow-y: auto;
            display: flex;           /* Ditambahkan */
            flex-direction: column;  /* Ditambahkan */
        }

        .sidebar-header {
            padding: 25px 20px;
            text-align: center;
            border-bottom: 1px solid rgba(255,255,255,0.15);
            flex-shrink: 0; /* Mencegah header mengecil */
        }

        .school-icon-container {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.15);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 15px;
            font-size: 2.5rem;
            color: white;
        }

        .sidebar-header h4 { color: white; margin-bottom: 8px; font-weight: 600; font-size: 1.3rem; }
        .sidebar-header small { color: rgba(255,255,255,0.8); font-size: 0.9rem; }

        .nav-link {
            color: rgba(255,255,255,0.9);
            padding: 14px 20px;
            border-radius: 10px;
            margin: 6px 10px;
            transition: all 0.3s;
            font-weight: 500;
            display: flex;
            align-items: center;
            font-size: 0.95rem;
        }

        .nav-link:hover, .nav-link.active {
            background: rgba(255,255,255,0.2);
            color: white;
            transform: translateX(5px);
        }

        .nav-link i { width: 28px; text-align: center; margin-right: 12px; font-size: 18px; }

        .main-content {
            padding: 20px;
            padding-left: 280px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            min-height: 100vh;
            width: 100%;
        }

        .sidebar-toggle-btn {
            display: none;
            position: fixed;
            top: 15px;
            left: 15px;
            z-index: 1001;
            background: var(--primary);
            color: white;
            border: none;
            width: 40px;
            height: 40px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.2);
            align-items: center;
            justify-content: center;
            cursor: pointer;
        }

        .sidebar-overlay {
            display: none;
            position: fixed;
            top: 0; left: 0; right: 0; bottom: 0;
            background: rgba(0,0,0,0.5);
            z-index: 999;
            backdrop-filter: blur(2px);
        }
        .sidebar-overlay.active { display: block; }

        .navbar {
            background: white;
            box-shadow: var(--card-shadow);
            padding: 18px 30px;
            margin-bottom: 30px;
            border-radius: 16px;
        }

        .card {
            border-radius: 18px;
            box-shadow: var(--card-shadow);
            margin-bottom: 24px;
            border: none;
            transition: transform 0.3s, box-shadow 0.3s;
            overflow: hidden;
            border: 1px solid rgba(44, 62, 80, 0.05);
        }
        .card:hover { transform: translateY(-6px); box-shadow: 0 6px 25px rgba(44, 62, 80, 0.12); }

        .card-header {
            background: var(--header-gradient);
            color: white;
            border-radius: 18px 18px 0 0 !important;
            padding: 18px 24px;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 1.1rem;
        }

        @media (max-width: 992px) {
            .sidebar { width: 230px; }
            .main-content { padding-left: 250px; }
        }

        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
                width: 260px;
                box-shadow: none;
            }

            .sidebar.active {
                transform: translateX(0);
                box-shadow: 5px 0 25px rgba(0,0,0,0.3);
            }

            .main-content {
                padding: 60px 20px 20px;
                padding-left: 20px;
                width: 100%;
            }

            .sidebar-toggle-btn {
                display: flex;
            }

            .sidebar-header h4,
            .sidebar-header small,
            .nav-text {
                display: block;
            }
        }
    </style>
</head>
<body>
    <button class="sidebar-toggle-btn" onclick="toggleSidebar()">
        <i class="fas fa-bars"></i>
    </button>

    <div class="sidebar-overlay" onclick="toggleSidebar()"></div>

    <div class="sidebar" id="mainSidebar">
        <div class="sidebar-header">
            <div class="school-icon-container">
                <i class="fas fa-school"></i>
            </div>

            @if(auth()->guard('admin')->check())
                <h4>ADMIN PANEL</h4>
                <small>Pengaduan Sekolah</small>
            @elseif(auth()->guard('siswa')->check())
                <h4>SISWA</h4>
                <small>Pengaduan Sekolah</small>
            @else
                <h4>APLIKASI</h4>
                <small>Pengaduan Sekolah</small>
            @endif
        </div>

        <!-- PERUBAHAN 1: Tambahkan class 'flex-grow-1' di sini -->
        <ul class="nav flex-column mt-4 px-3 flex-grow-1">

            <!-- Menu Admin -->
            @if(auth()->guard('admin')->check())
                <li class="nav-item">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <i class="fas fa-home"></i>
                        <span class="nav-text">Dashboard</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.aspirasi.index') }}" class="nav-link {{ request()->routeIs('admin.aspirasi.*') ? 'active' : '' }}">
                        <i class="fas fa-clipboard-list"></i>
                        <span class="nav-text">Daftar Pengaduan</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.siswa.index') }}" class="nav-link {{ request()->routeIs('admin.siswa.*') ? 'active' : '' }}">
                      <i class="fas fa-user-graduate"></i>
                        <span class="nav-text">Daftar Siswa</span>
                    </a>
                </li>

                <!-- PERUBAHAN 2: Form dan Button diberi class w-100 agar lebar penuh -->
                <li class="nav-item mt-auto mb-3">
                    <form method="POST" action="{{ route('admin.logout') }}" class="d-inline w-100">
                        @csrf
                       <button class="nav-link logout-btn">
                            <i class="fa-solid fa-right-from-bracket"></i>
                            <span>Logout</span>
                        </button>
                    </form>
                </li>
            @endif

            <!-- Menu Siswa -->
            @if(auth()->guard('siswa')->check())
                <li class="nav-item">
                    <a href="{{ route('siswa.dashboard') }}" class="nav-link {{ request()->routeIs('siswa.dashboard') ? 'active' : '' }}">
                        <i class="fas fa-home"></i>
                        <span class="nav-text">Dashboard</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('siswa.aspirasi.index') }}" class="nav-link {{ request()->routeIs('siswa.aspirasi.*') ? 'active' : '' }}">
                        <i class="fas fa-clipboard-list"></i>
                        <span class="nav-text">Pengaduan Saya</span>
                    </a>
                </li>

                <!-- PERUBAHAN 2: Form dan Button diberi class w-100 agar lebar penuh -->
                <li class="nav-item mt-auto mb-3">
                    <form method="POST" action="{{ route('siswa.logout') }}" class="d-inline w-100">
                        @csrf
                        <button class="nav-link logout-btn">
                            <i class="fa-solid fa-right-from-bracket"></i>
                            <span>Logout</span>
                        </button>

                    </form>
                </li>
            @endif
        </ul>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <nav class="navbar">
            <div class="container-fluid">
                <h4 class="mb-0 fw-bold">@yield('title', 'Dashboard')</h4>
                <div class="d-flex align-items-center">
                    <div class="me-3 d-none d-md-block">
                        <i class="far fa-clock me-2"></i>
                        <span id="currentTime"></span>
                    </div>
                    <div class="dropdown">
                        @if(auth()->guard('admin')->check())
                            <button class="btn btn-sm btn-outline-primary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                <i class="fas fa-user-circle me-1"></i> {{ auth()->guard('admin')->user()->username }}
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <form method="POST" action="{{ route('admin.logout') }}">
                                        @csrf
                                        <button type="submit" class="dropdown-item">
                                            <i class="fas fa-sign-out-alt me-2"></i> Logout
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        @elseif(auth()->guard('siswa')->check())
                            <button class="btn btn-sm btn-outline-primary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                <i class="fas fa-user-graduate me-1"></i> {{ auth()->guard('siswa')->user()->name }}
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <form method="POST" action="{{ route('siswa.logout') }}">
                                        @csrf
                                        <button type="submit" class="dropdown-item">
                                            <i class="fas fa-sign-out-alt me-2"></i> Logout
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        @endif
                    </div>
                </div>
            </div>
        </nav>

        <div class="container-fluid">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show shadow-sm border-0 rounded-3" role="alert">
                    <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show shadow-sm border-0 rounded-3" role="alert">
                    <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @yield('content')
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
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

        function updateTime() {
            const now = new Date();
            const options = {
                weekday: 'long',
                year: 'numeric',
                month: 'long',
                day: 'numeric',
                hour: '2-digit',
                minute: '2-digit'
            };
            const timeElement = document.getElementById('currentTime');
            if(timeElement) {
                timeElement.textContent = now.toLocaleDateString('id-ID', options);
            }
        }
        setInterval(updateTime, 1000);
        updateTime();
    </script>
    @yield('scripts')
</body>
</html>
