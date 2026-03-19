<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Aplikasi Pengaduan Sarana Sekolah')</title>
    <!-- Perbaikan: Hapus spasi di akhir URL -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* Font Poppins */
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

        /* Palet warna Coklat Eksklusif */
        :root {
            --primary: #5D4037;      /* Coklat tua (kayu jati) */
            --secondary: #795548;     /* Coklat sedang */
            --accent: #8D6E63;        /* Coklat muda */
            --light: #F5F1EB;         /* Beige terang */
            --dark: #3E2723;          /* Dark brown */
            --muted: #BCAAA4;         /* Coklat abu-abu */

            /* Gradient coklat */
            --sidebar-gradient: linear-gradient(180deg, #5D4037, #5D4037);
            --header-gradient: linear-gradient(135deg, #3E2723, #3E2723);
            --card-shadow: 0 4px 20px rgba(93, 64, 55, 0.08);
        }

        body {
            background-color: var(--light);
            font-family: 'Poppins', sans-serif;
            color: var(--dark);
            font-weight: 400;
            overflow-x: hidden;
            margin: 0;
            padding: 0;
        }

        .sidebar {
            background: var(--sidebar-gradient);
            min-height: 100vh;
            position: fixed;
            width: 260px;
            transition: all 0.3s;
            z-index: 1000;
            box-shadow: 0 0 25px rgba(0, 0, 0, 0.15);
        }

        /* Perubahan Utama: Header Sidebar dengan Icon Sekolah Modern */
        .sidebar-header {
            padding: 25px 20px;
            text-align: center;
            border-bottom: 1px solid rgba(255,255,255,0.15);
            position: relative;
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

        .school-icon-container i {
            font-size: 2.5rem;
        }

        .sidebar-header h4 {
            color: white;
            margin-bottom: 8px;
            font-weight: 600;
            letter-spacing: 0.5px;
            font-size: 1.3rem;
            position: relative;
        }

        .sidebar-header small {
            color: rgba(255,255,255,0.8);
            font-size: 0.9rem;
        }

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

        .nav-link i {
            width: 28px;
            text-align: center;
            margin-right: 12px;
            font-size: 18px;
        }

        .main-content {
            margin-left: 260px;
            padding: 20px;
            transition: all 0.3s;
            min-height: 100vh;
        }

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
            border: 1px solid rgba(93, 64, 55, 0.05);
        }

        .card:hover {
            transform: translateY(-6px);
            box-shadow: 0 6px 25px rgba(93, 64, 55, 0.25);
        }

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

        .stat-card {
            background: white;
            border-left: 4px solid var(--primary);
            transition: all 0.3s;
            border-radius: 14px;
            overflow: hidden;
            border: 1px solid rgba(93, 64, 55, 0.05);
        }

        .stat-card:hover {
            transform: scale(1.02);
            box-shadow: 0 8px 25px rgba(93, 64, 55, 0.2);
        }

        .stat-icon {
            font-size: 2.8rem;
            opacity: 0.7;
        }

        .status-badge {
            padding: 6px 18px;
            border-radius: 50px;
            font-weight: 600;
            font-size: 0.85rem;
            display: inline-block;
            border: 1px solid rgba(0,0,0,0.1);
            font-family: 'Poppins', sans-serif;
        }

        .status-menunggu {
            background-color: #f5f1eb;
            color: #5d4037;
            border-color: #8d6e63;
        }

        .status-proses {
            background-color: #f5f1eb;
            color: #795548;
            border-color: #8d6e63;
        }

        .status-selesai {
            background-color: #f5f1eb;
            color: #5d4037;
            border-color: #8d6e63;
        }

        /* Modern Icons */
        .modern-icon {
            font-size: 1.6rem;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 12px;
            background: rgba(255, 255, 255, 0.1);
            transition: all 0.3s ease;
        }

        .nav-link:hover .modern-icon {
            background: rgba(255, 255, 255, 0.2);
            transform: scale(1.1);
        }

        .btn-modern {
            background: var(--primary);
            border: none;
            border-radius: 8px;
            padding: 8px 16px;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(93, 64, 55, 0.25);
            color: white;
            font-size: 0.9rem;
            font-family: 'Poppins', sans-serif;
            letter-spacing: 0.5px;
        }

        .btn-modern:hover {
            background: #4E342E;
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(93, 64, 55, 0.3);
        }

        /* Responsif */
        @media (max-width: 992px) {
            .sidebar {
                width: 230px;
            }
            .main-content {
                margin-left: 230px;
            }
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 70px;
            }
            .sidebar .nav-text, .sidebar-header h4, .sidebar-header small {
                display: none;
            }
            .main-content {
                margin-left: 70px;
            }

            .card-header {
                padding: 15px 20px;
                font-size: 1rem;
            }
        }

        @media (max-width: 576px) {
            .sidebar {
                width: 0;
                opacity: 0;
            }
            .main-content {
                margin-left: 0;
            }
        }



    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="sidebar-header">
            <!-- Perubahan: Ganti teks dengan icon sekolah modern di tengah -->
            <div class="school-icon-container">
                <i class="fas fa-school"></i>
            </div>

            @if(auth()->guard('admin')->check())
                <h4>ADMIN PANEL</h4>
                <small>Pengaduan Sekolah</small>
            @elseif(auth()->guard('siswa')->check())
                <h4>PENGADUAN SEKOLAH</h4>
            @else
                <h4>APLIKASI</h4>
                <small>Pengaduan Sekolah</small>
            @endif
        </div>

        <ul class="nav flex-column mt-4 px-3">
            <!-- Menu Admin - HANYA untuk admin -->
            @if(auth()->guard('admin')->check())
                <li class="nav-item">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <i class="fas fa-home"></i>
                        <span class="nav-text">Dashboard</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.aspirasi.index') }}" class="nav-link {{ request()->routeIs('admin.aspirasi.index') || request()->routeIs('admin.aspirasi.filter') ? 'active' : '' }}">
                        <i class="fas fa-clipboard-list"></i>
                        <span class="nav-text">Daftar Pengaduan</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.aspirasi.riwayat') }}" class="nav-link {{ request()->routeIs('admin.aspirasi.riwayat') ? 'active' : '' }}">
                        <i class="fas fa-history"></i>
                        <span class="nav-text">Riwayat Pengaduan</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.aspirasi.ringkasan') }}" class="nav-link {{ request()->routeIs('admin.aspirasi.ringkasan') ? 'active' : '' }}">
                        <i class="fas fa-chart-bar"></i>
                        <span class="nav-text">Laporan</span>
                    </a>
                </li>
                <li class="nav-item mt-auto mb-3">
                    <form method="POST" action="{{ route('admin.logout') }}" class="d-inline">
                        @csrf
                        <button type="submit" class="nav-link text-danger bg-transparent border-0 p-0">
                            <i class="fas fa-sign-out-alt"></i>
                            <span class="nav-text">Logout</span>
                        </button>
                    </form>
                </li>
            @endif

            <!-- Menu Siswa - HANYA untuk siswa -->
            @if(auth()->guard('siswa')->check())
                <li class="nav-item">
                    <a href="{{ route('siswa.dashboard') }}" class="nav-link {{ request()->routeIs('siswa.dashboard') ? 'active' : '' }}">
                        <i class="fas fa-home"></i>
                        <span class="nav-text">Dashboard</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('siswa.aspirasi.index') }}" class="nav-link {{ request()->routeIs('siswa.aspirasi.index') ? 'active' : '' }}">
                        <i class="fas fa-clipboard-list"></i>
                        <span class="nav-text">Pengaduan Saya</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('siswa.aspirasi.riwayat') }}" class="nav-link {{ request()->routeIs('siswa.aspirasi.riwayat') ? 'active' : '' }}">
                        <i class="fas fa-history"></i>
                        <span class="nav-text">Riwayat Pengaduan</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('siswa.aspirasi.ringkasan') }}" class="nav-link {{ request()->routeIs('siswa.aspirasi.ringkasan') ? 'active' : '' }}">
                        <i class="fas fa-chart-line"></i>
                        <span class="nav-text">Progres Pengaduan</span>
                    </a>
                </li>
                <li class="nav-item mt-auto mb-3">
                    <form method="POST" action="{{ route('siswa.logout') }}" class="d-inline">
                        @csrf
                        <button type="submit" class="nav-link text-danger bg-transparent border-0 p-0">
                            <i class="fas fa-sign-out-alt"></i>
                            <span class="nav-text">Logout</span>
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
                    <div class="me-3">
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
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @yield('content')
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Update waktu real-time
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
            document.getElementById('currentTime').textContent = now.toLocaleDateString('id-ID', options);
        }
        setInterval(updateTime, 1000);
        updateTime();
    </script>
    @yield('scripts')
</body>
</html>
