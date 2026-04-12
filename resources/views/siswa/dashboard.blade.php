@extends('layouts.app')

@section('title', 'Dashboard Siswa')

@section('content')
<style>
    :root {
        --primary: #2C3E50;
        --secondary: #3498DB;
        --accent: #95A5A6;
        --light: #ECF0F1;
        --dark: #2C3E50;
        --muted: #7F8C8D;

        /* Variabel Gradient Tetap Ada (Tidak Diubah) */
        --card-gradient: linear-gradient(135deg, #ffffff, #f8f9fa);
        --stat-gradient-1: linear-gradient(135deg, #2C3E50, #34495E);
        --stat-gradient-2: linear-gradient(135deg, #3498DB, #2980B9);
        --stat-gradient-3: linear-gradient(135deg, #7F8C8D, #7F8C8D);
        --stat-gradient-4: linear-gradient(135deg, #16A085, #16A085);

        --header-gradient: linear-gradient(135deg, #2C3E50, #34495E);
        --welcome-bg: #ffffff;
        --welcome-text: #2C3E50;
    }

    body { background-color: var(--light); font-family: 'Poppins', sans-serif; }

    .welcome-banner {
        background-color: var(--welcome-bg);
        border-radius: 12px;
        padding: 20px 25px;
        margin-bottom: 25px;
        border-left: 5px solid var(--dark);
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .welcome-title {
        font-size: 1.4rem;
        font-weight: 700;
        color: var(--welcome-text);
        margin-bottom: 5px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .welcome-subtitle {
        font-size: 0.9rem;
        color: var(--dark);
        font-weight: 400;
    }

    .earth-card {
        background: var(--card-gradient);
        border: none;
        border-radius: 15px;
        box-shadow: 0 4px 20px rgba(44, 62, 80, 0.08);
        overflow: hidden;
        border: 1px solid rgba(44, 62, 80, 0.05);
        margin-bottom: 24px;
    }

    .earth-card-header {
        background: var(--header-gradient);
        color: white;
        padding: 20px 24px;
        font-weight: 600;
        display: flex;
        align-items: center;
        justify-content: space-between;
        font-size: 1.1rem;
        flex-wrap: wrap;
        gap: 10px;
    }

    .btn-earth {
        background: var(--light);
        border: none;
        border-radius: 8px;
        padding: 8px 16px;
        font-weight: 600;
        transition: all 0.3s ease;
        color: #2C3E50;
        font-size: 0.85rem;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        white-space: nowrap;
    }
    .btn-earth:hover { background: #4f6780; transform: translateY(-2px); color: white; text-decoration: none; }

    .stat-row {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 20px;
        margin-bottom: 24px;
    }

    .stat-card {
        background: #ffffff;
        border-radius: 12px;
        min-height: 100px;
        padding: 20px;
        display: flex;
        align-items: center;
        gap: 20px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        border: 1px solid rgba(0,0,0,0.03);
        transition: transform 0.3s, box-shadow 0.3s;
        position: relative;
        overflow: hidden;
        text-align: left;
    }

    .stat-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }

    .stat-card-1 .stat-icon { color: #2C3E50; }
    .stat-card-2 .stat-icon { color: #2C3E50; }
    .stat-card-3 .stat-icon { color: #2C3E50; }
    .stat-card-4 .stat-icon { color: #2C3E50; }

    .stat-icon {
        font-size: 2rem;
        opacity: 1;
        flex-shrink: 0;
        width: 50px;
        height: 50px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: rgba(0,0,0,0.03);
        border-radius: 10px;
    }

    .stat-content {
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .stat-value {
        font-size: 2rem;
        font-weight: 700;
        color: #2C3E50;
        line-height: 1;
        margin-bottom: 4px;
    }

    .stat-label {
        font-size: 0.85rem;
        color: #7F8C8D;
        font-weight: 500;
        text-transform: capitalize;
        white-space: nowrap;
    }

    .table-responsive { border-radius: 12px; overflow-x: auto; }
    .table { width: 100%; border-collapse: collapse; }
    .table thead { background: #F8F9FA; border-bottom: 2px solid #E9ECEF; }
     .table th {
        font-weight: 700;
        padding: 16px 12px;
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: var(--dark);
        border: none;
        text-align: center;
        vertical-align: middle;
        white-space: nowrap;
    }

    .table td {
        padding: 16px 12px;
        border-top: 1px solid #F0F0F0;
        font-size: 0.9rem;
        color: var(--dark);
        vertical-align: middle;
        text-align: center;
        white-space: nowrap;
    }

    .col-kategori {
        min-width: 140px;
        padding-left: 10px !important;
        padding-right: 10px !important;
    }

    .col-lokasi {
        text-align: start !important;
        min-width: 120px;
    }
    .col-keterangan {
        text-align: start !important;
        max-width: 250px; overflow: hidden;
        text-overflow: ellipsis;
    }
    .col-foto {
        min-width: 100px;
    }
    .col-status {
        min-width: 100px;
     }
    .col-tanggal {
        font-weight: 500;
        color: var(--muted);
        min-width: 110px;
    }
    .col-aksi {
        min-width: 80px;
    }

    .kategori-badge {
        padding: 6px 14px; border-radius: 50px; font-weight: 600; font-size: 0.75rem;
        background-color: #EBF5FB; color: var(--primary); border: 1px solid #D6EAF8;
        display: inline-block;
    }

    .status-badge {
        padding: 6px 14px; border-radius: 20px; font-weight: 600; font-size: 0.75rem;
        display: inline-block;
    }
    .status-menunggu { background-color: #FFF3CD; color: #856404; }
    .status-proses { background-color: #B3E5FC; color: #0277BD; }
    .status-selesai { background-color: #C8E6C9; color: #2E7D32; }

    .foto-pengaduan {
        width: 60px;
        height: 60px;
        object-fit: cover;
        border-radius: 8px;
        display: block;
        margin: 0 auto;
    }

    .btn-action {
        width: 32px; height: 32px; border-radius: 8px; display: inline-flex;
        align-items: center; justify-content: center; background: #f8f9fa;
        color: var(--dark); border: 1px solid #ddd; text-decoration: none;
        transition: all 0.2s;
    }
    .btn-action:hover { background: var(--dark); color: white; transform: translateY(-2px); }

    .empty-state { text-align: center; padding: 40px 20px; }
    .empty-icon { font-size: 3.5rem; color: var(--accent); margin-bottom: 15px; }

    .pagination .page-link {
        color: var(--secondary); border: 1px solid rgba(52, 152, 219, 0.2);
        border-radius: 6px; padding: 8px 12px; margin: 0 4px; text-decoration: none;
    }
    .pagination .page-item.active .page-link {
        background-color: var(--secondary); border-color: var(--secondary); color: white;
    }

    /* Mobile Responsive */
    @media (max-width: 768px) {
        .stat-row {
            grid-template-columns: repeat(2, 1fr);
            gap: 12px;
        }

        .stat-card {
            padding: 15px;
            min-height: 90px;
            gap: 12px;
        }

        .stat-icon {
            font-size: 1.6rem;
            width: 40px;
            height: 40px;
        }

        .stat-value {
            font-size: 1.6rem;
        }

        .stat-label {
            font-size: 0.75rem;
        }

        .earth-card-header { padding: 15px 20px; font-size: 1rem; }
        .btn-earth { padding: 6px 12px; font-size: 0.75rem; }

        .table thead { display: none; }
        .table, .table tbody, .table tr, .table td { display: block; width: 100%; }
        .table tr {
            margin-bottom: 15px; background: white; border-radius: 12px;
            border: 1px solid #eee; padding: 15px; box-shadow: 0 2px 5px rgba(0,0,0,0.05);
        }
        .table td {
            padding: 10px 0; border: none; text-align: left !important;
            display: flex; justify-content: space-between; align-items: center;
            border-bottom: 1px dashed #f0f0f0; gap: 10px;
        }
        .table td:last-child { border-bottom: none; }

        .mobile-label {
            font-size: 0.7rem; color: var(--muted); font-weight: 700;
            text-transform: uppercase; min-width: 80px;
        }

        .td-foto-mobile {
            justify-content: space-between !important; align-items: center !important;
            margin: 10px 0 !important; border-bottom: 1px solid #eee !important;
            padding-bottom: 10px !important;
        }
        .td-foto-mobile .mobile-label { display: block !important; min-width: 60px; }
        .foto-pengaduan { width: 60px; height: 60px; margin: 0; }

        .td-aksi-mobile { justify-content: flex-end !important; margin-top: 10px; padding-top: 10px; }
        .btn-action { width: 36px; height: 36px; }
        .desktop-only { display: none; }
    }
</style>

<div class="container-fluid">
 @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show shadow-sm border-0 rounded-3 mb-4" role="alert" style="font-family: 'Poppins', sans-serif; border-left: 5px solid #27AE60;">
                    <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

    <div class="welcome-banner">
        <div class="welcome-title">
            Selamat Datang, {{ auth()->guard('siswa')->user()->name }}! 👋
        </div>
        <div class="welcome-subtitle">
            Silakan isi formulir pengaduan sekolah di bawah ini
        </div>
    </div>

    <div class="stat-row">
        <div class="stat-card stat-card-1">
            <div class="stat-icon"><i class="fas fa-clipboard-list"></i></div>
            <div class="stat-content">
                <div class="stat-value">{{ $total }}</div>
                <div class="stat-label">Total Pengaduan</div>
            </div>
        </div>

        <div class="stat-card stat-card-2">
            <div class="stat-icon"><i class="fas fa-clock"></i></div>
            <div class="stat-content">
                <div class="stat-value">{{ $menunggu }}</div>
                <div class="stat-label">Menunggu</div>
            </div>
        </div>

        <div class="stat-card stat-card-3">
            <div class="stat-icon"><i class="fas fa-cog"></i></div>
            <div class="stat-content">
                <div class="stat-value">{{ $proses }}</div>
                <div class="stat-label">Diproses</div>
            </div>
        </div>

        <div class="stat-card stat-card-4">
            <div class="stat-icon"><i class="fas fa-check-circle"></i></div>
            <div class="stat-content">
                <div class="stat-value">{{ $selesai }}</div>
                <div class="stat-label">Selesai</div>
            </div>
        </div>
    </div>

    <div class="earth-card">
        <div class="earth-card-header">
            <span><i class="fas fa-list me-2"></i>Pengaduan Saya</span>
            <a href="{{ route('siswa.aspirasi.create') }}" class="btn-earth">
                <i class="fas fa-plus me-2"></i>Ajukan Pengaduan
            </a>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead>
                        <tr>
                            <th class="col-kategori">Kategori</th>
                            <th class="col-lokasi">Lokasi</th>
                            <th class="col-keterangan">Keterangan</th>
                            <th class="col-foto">Foto</th>
                            <th class="col-status">Status</th>
                            <th class="col-tanggal">Tanggal</th>
                            <th class="col-aksi">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($aspirasis as $aspirasi)
                        <tr>
                            <td class="col-kategori">
                                <span class="mobile-label d-md-none">Kategori</span>
                                <span class="kategori-badge">{{ $aspirasi->kategori->ket_kategori ?? '-' }}</span>
                            </td>
                            <td class="col-lokasi">
                                <span class="mobile-label d-md-none">Lokasi</span>
                                {{ $aspirasi->lokasi }}
                            </td>
                            <td class="col-keterangan">
                                <span class="mobile-label d-md-none">Keterangan</span>
                                <span title="{{ $aspirasi->ket }}">{{ Str::limit($aspirasi->ket, 30) }}</span>
                            </td>
                            <td class="col-foto td-foto-mobile">
                                <span class="mobile-label d-md-none">Foto</span>
                                @if ($aspirasi->foto)
                                    <img src="{{ $aspirasi->foto_url }}" alt="Foto" class="foto-pengaduan">
                                @else
                                    <span class="text-muted d-block" style="font-size: 1.2rem;">-</span>
                                @endif
                            </td>
                            <td class="col-status">
                                <span class="mobile-label d-md-none">Status</span>
                                <span class="status-badge
                                    @if ($aspirasi->status == 'Menunggu') status-menunggu
                                    @elseif($aspirasi->status == 'Proses') status-proses
                                    @else status-selesai @endif">
                                    {{ $aspirasi->status }}
                                </span>
                            </td>
                            <td class="col-tanggal">
                                <span class="mobile-label d-md-none">Tanggal</span>
                                <span class="desktop-only">{{ $aspirasi->created_at->format('d M Y') }}</span>
                                <span class="d-md-none small">{{ $aspirasi->created_at->format('d/m/y') }}</span>
                            </td>
                            <td class="col-aksi td-aksi-mobile">
                                <span class="mobile-label d-md-none">Aksi</span>
                                <a href="{{ route('siswa.aspirasi.show', $aspirasi->id_aspirasi) }}" class="btn-action" title="Lihat Detail">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center py-5">
                                <div class="empty-state">
                                    <div class="empty-icon"><i class="fas fa-inbox"></i></div>
                                    <h5 class="text-dark mb-2" style="color: var(--primary); font-weight: 600;">Belum ada pengaduan</h5>
                                    <p class="text-muted mb-3">Mulai dengan mengajukan pengaduan pertama Anda.</p>
                                    <a href="{{ route('siswa.aspirasi.create') }}" class="btn-earth">
                                        <i class="fas fa-plus me-2"></i>Ajukan Sekarang
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if ($aspirasis->hasPages())
            <div class="p-3 d-flex justify-content-center">
                {{ $aspirasis->links() }}
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
