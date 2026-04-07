@extends('layouts.app')

@section('title', 'Dashboard Siswa')

@section('content')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

    :root {
        --primary: #2C3E50;
        --secondary: #3498DB;
        --accent: #95A5A6;
        --light: #ECF0F1;
        --dark: #2C3E50;
        --muted: #7F8C8D;

        --card-gradient: linear-gradient(135deg, #ffffff, #f8f9fa);
        --stat-gradient-1: linear-gradient(135deg, #2C3E50, #34495E);
        --stat-gradient-2: linear-gradient(135deg, #3498DB, #2980B9);
        --stat-gradient-3: linear-gradient(135deg, #7F8C8D, #7F8C8D);
        --stat-gradient-4: linear-gradient(135deg, #16A085, #16A085);

        --card-shadow: 0 4px 20px rgba(44, 62, 80, 0.08);
        --btn-shadow: 0 4px 12px rgba(52, 152, 219, 0.3);
    }

    body {
        background-color: var(--light);
        font-family: 'Poppins', sans-serif;
        color: var(--dark);
        font-weight: 400;
    }

    .modern-card {
        background: var(--card-gradient);
        border: none;
        border-radius: 16px;
        box-shadow: var(--card-shadow);
        transition: all 0.3s ease;
        overflow: hidden;
        border: 1px solid rgba(44, 62, 80, 0.05);
    }

    .modern-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 6px 25px rgba(44, 62, 80, 0.12);
    }

    .stat-card-1 { background: var(--stat-gradient-1); color: white; }
    .stat-card-2 { background: var(--stat-gradient-2); color: white; }
    .stat-card-3 { background: var(--stat-gradient-3); color: white; }
    .stat-card-4 { background: var(--stat-gradient-4); color: white; }

    .stat-icon {
        font-size: 2.2rem;
        opacity: 0.9;
        margin-bottom: 12px;
        color: white !important;
    }

    .info-section {
        background: var(--card-gradient);
        border: none;
        border-radius: 16px;
        padding: 0;
        overflow: hidden;
        border: 1px solid rgba(44, 62, 80, 0.05);
    }

    .info-section .card-header {
        background: var(--stat-gradient-1);
        color: white;
        border-radius: 16px 16px 0 0 !important;
        padding: 18px 24px;
        font-weight: 600;
    }

    .tip-card, .recent-card {
        background: var(--card-gradient);
        border-radius: 16px;
        border: none;
        overflow: hidden;
        border: 1px solid rgba(44, 62, 80, 0.05);
    }

    .tip-card .card-header, .recent-card .card-header {
        background: #2C3E50;
        color: var(--light);
        border-bottom: 1px solid #E9ECEF;
        font-weight: 700;
    }

    .status-badge {
        padding: 6px 16px;
        border-radius: 50px;
        font-weight: 600;
        font-size: 0.75rem;
        display: inline-block;
        border: 1px solid transparent;
        font-family: 'Poppins', sans-serif;
        text-transform: capitalize;
        letter-spacing: 0.5px;
        box-shadow: 0 2px 5px rgba(0,0,0,0.05);
    }

    .status-menunggu { background-color: #FFF3CD; color: #856404; border-color: #FFE69C; }
    .status-proses { background-color: #B3E5FC; color: #0277BD; border-color: #81D4FA; }
    .status-selesai { background-color: #C8E6C9; color: #2E7D32; border-color: #A5D6A7; }

    .user-info {
        background: #f6f7f8;
        border-radius: 12px;
        padding: 16px;
        margin-bottom: 12px;
        transition: all 0.3s ease;
        border: 1px solid #E9ECEF;
    }

    .user-info:hover {
        background: white;
        transform: scale(1.01);
        box-shadow: 0 4px 12px rgba(44, 62, 80, 0.08);
        border-color: var(--secondary);
    }

    .table-responsive {
        border-radius: 12px;
        overflow: hidden;
        border: 1px solid rgba(44, 62, 80, 0.05);
    }

    .table thead {
        background: #F8F9FA;
        color: var(--muted);
        border-bottom: 2px solid #E9ECEF;
    }

    .table th {
        font-weight: 700;
        padding: 12px 10px;
        font-size: 0.8rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        font-family: 'Poppins', sans-serif;
        border: none;
    }

    .table td {
        padding: 12px 10px;
        border-top: 1px solid #F0F0F0;
        font-size: 0.85rem;
        font-family: 'Poppins', sans-serif;
        color: var(--dark);
    }

    .table-hover tbody tr:hover {
        background: #F4F6F7;
    }

    .empty-state {
        text-align: center;
        padding: 30px 20px;
    }

    .empty-icon {
        font-size: 3.5rem;
        color: var(--accent);
        margin-bottom: 15px;
    }

    .section-title {
        font-weight: 700;
        color: var(--primary);
        margin-bottom: 20px;
        font-family: 'Poppins', sans-serif;
        letter-spacing: 0.5px;
    }

    .stat-number {
        font-size: 2rem;
        font-weight: 700;
        line-height: 1.2;
        font-family: 'Poppins', sans-serif;
    }

    .stat-label {
        font-size: 0.85rem;
        opacity: 0.9;
        margin-bottom: 8px;
        font-family: 'Poppins', sans-serif;
        font-weight: 500;
    }

    h1, h2, h3, h4, h5, h6 {
        font-family: 'Poppins', sans-serif;
        font-weight: 600;
    }

    p, small, ul, li {
        font-family: 'Poppins', sans-serif;
        font-weight: 400;
    }

    .alert {
        font-family: 'Poppins', sans-serif;
        border: none;
        border-left: 4px solid var(--secondary);
        background: #EBF5FB;
        color: var(--dark);
    }

    .alert-heading {
        color: var(--primary);
        font-weight: 700;
    }

    .alert-light {
        background: #EBF5FB;
        color: var(--dark);
    }

    @media (max-width: 768px) {
        .stat-card { margin-bottom: 16px; }
        .table th, .table td { padding: 10px 8px; font-size: 0.8rem; }
        .stat-number { font-size: 1.5rem; }
        .user-info { margin-bottom: 10px; }
    }

    @media (max-width: 576px) {
        .stat-card { margin-bottom: 12px; }
        .stat-number { font-size: 1.3rem; }
        .section-title { font-size: 1.2rem; }
    }
</style>

<div class="row">
    <div class="col-12 mb-4"></div>

    <div class="col-md-3 col-sm-6 mb-4">
        <div class="modern-card stat-card-1 text-center p-3">
            <i class="fas fa-clipboard-list stat-icon"></i>
            <div class="stat-label">Total Pengaduan</div>
            <div class="stat-number">{{ $total }}</div>
        </div>
    </div>

    <div class="col-md-3 col-sm-6 mb-4">
        <div class="modern-card stat-card-2 text-center p-3">
            <i class="fas fa-clock stat-icon"></i>
            <div class="stat-label">Menunggu</div>
            <div class="stat-number">{{ $menunggu }}</div>
        </div>
    </div>

    <div class="col-md-3 col-sm-6 mb-4">
        <div class="modern-card stat-card-3 text-center p-3">
            <i class="fas fa-cog stat-icon"></i>
            <div class="stat-label">Diproses</div>
            <div class="stat-number">{{ $proses }}</div>
        </div>
    </div>

    <div class="col-md-3 col-sm-6 mb-4">
        <div class="modern-card stat-card-4 text-center p-3">
            <i class="fas fa-check-circle stat-icon"></i>
            <div class="stat-label">Selesai</div>
            <div class="stat-number">{{ $selesai }}</div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12 mb-4"></div>

    <div class="col-md-12">
        <div class="modern-card info-section">
            <div class="card-header">
                <h5 class="mb-0"><i class="fas fa-user-graduate me-2"></i>Informasi Profil Siswa</h5>
            </div>
            <div class="card-body p-4">
                <div class="row g-3">
                    <div class="col-md-4">
                        <div class="user-info">
                            <small class="text-dark fw-bold">NIS</small>
                            <h6 class="mb-0 mt-1" style="color: var(--primary);">{{ auth()->guard('siswa')->user()->nis }}</h6>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="user-info">
                            <small class="text-dark fw-bold">Nama Lengkap</small>
                            <h6 class="mb-0 mt-1" style="color: var(--primary);">{{ auth()->guard('siswa')->user()->name }}</h6>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="user-info">
                            <small class="text-dark fw-bold">Kelas</small>
                            <h6 class="mb-0 mt-1" style="color: var(--primary);">{{ auth()->guard('siswa')->user()->kelas }}</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-md-6 mb-4">
        <div class="modern-card tip-card">
            <div class="card-header p-3">
                <h6 class="mb-0"><i class="fas fa-lightbulb me-2" style="color: var(--light);"></i>Panduan Penggunaan</h6>
            </div>
            <div class="card-body p-4">
                <div class="alert alert-light border-0 mb-0">
                   <h6 class="alert-heading mb-3">
                    <i class="fas fa-info-circle me-2"></i>Petunjuk untuk Siswa:
                </h6>
                <ul class="mb-0" style="line-height: 1.7; padding-left: 20px;">
                    <li>Ajukan pengaduan melalui menu <strong>"Pengaduan Saya"</strong>, lalu klik tombol <strong>"Ajukan Pengaduan"</strong>.</li>
                    <li>Klik <strong>ikon mata</strong> pada kolom aksi di menu <strong>"Pengaduan Saya"</strong> untuk melihat detail pengaduan dan status secara real-time.</li>
                    <li>Jika ingin memperbarui pengaduan, klik <strong>ikon pensil</strong> pada kolom aksi di menu <strong>"Pengaduan Saya"</strong>.</li>
                    <li>Klik <strong>ikon sampah</strong> pada kolom aksi di menu <strong>"Pengaduan Saya"</strong> untuk menghapus pengaduan.</li>
                </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6 mb-4">
        <div class="modern-card recent-card">
            <div class="card-header p-3">
                <h6 class="mb-0"><i class="fas fa-history me-2" style="color: var(--light);"></i>Pengaduan Terbaru</h6>
            </div>
            <div class="card-body p-4">
                @php
                    $latest = \App\Models\Aspirasi::where('nis', auth()->guard('siswa')->user()->nis)
                        ->with('kategori')
                        ->latest()
                        ->take(5)
                        ->get();
                @endphp

                @if($latest->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Kategori</th>
                                    <th>Tanggal</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($latest as $item)
                                <tr>
                                    <td style="font-weight: 600;">{{ $item->id_aspirasi }}</td>
                                    <td>{{ $item->kategori->ket_kategori ?? 'Tidak diketahui' }}</td>
                                    <td>{{ $item->created_at->format('d M Y') }}</td>
                                    <td>
                                        <span class="status-badge
                                            @if($item->status == 'Menunggu') status-menunggu
                                            @elseif($item->status == 'Proses') status-proses
                                            @else status-selesai @endif">
                                            {{ $item->status }}
                                        </span>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="empty-state">
                        <i class="fas fa-inbox empty-icon"></i>
                        <h5 class="text-muted mb-2" style="color: var(--primary); font-weight: 600;">Belum Ada Pengaduan</h5>
                        <p class="text-muted mb-3" style="color: var(--dark);">Anda belum pernah mengajukan pengaduan sarana sekolah</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
