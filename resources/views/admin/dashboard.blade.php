@extends('layouts.app')

@section('title', 'Dashboard Admin')

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

    .earth-card {
        background: var(--card-gradient);
        border: none;
        border-radius: 16px;
        box-shadow: var(--card-shadow);
        overflow: hidden;
        border: 1px solid rgba(44, 62, 80, 0.05);
        margin-bottom: 24px;
        height: 100%;
        transition: all 0.3s ease;
    }


    .earth-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 6px 25px rgba(44, 62, 80, 0.12);
    }

    .earth-card-header {
        background: var(--stat-gradient-1);
        color: white;
        border-radius: 16px 16px 0 0 !important;
        padding: 20px 24px;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 12px;
        font-size: 1.1rem;
        font-family: 'Poppins', sans-serif;
    }

    .card-body-custom {
        padding: 24px;
    }

    .modern-card {
        background: var(--card-gradient);
        border: none;
        border-radius: 16px;
        box-shadow: var(--card-shadow);
        transition: all 0.3s ease;
        overflow: hidden;
        border: 1px solid rgba(44, 62, 80, 0.05);
        height: 100%;
    }

    .modern-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 6px 25px rgba(44, 62, 80, 0.12);
    }

    .stat-card-1, .stat-card-2, .stat-card-3, .stat-card-4 {
        background: #ffffff;
        color: var(--dark);
        text-align: left;
        display: flex;
        align-items: center;
        gap: 20px;
        padding: 20px;
    }

    .stat-card-1 .stat-icon { color: #2C3E50; }
    .stat-card-2 .stat-icon { color: #2C3E50; }
    .stat-card-3 .stat-icon { color: #2C3E50; }
    .stat-card-4 .stat-icon { color: #2C3E50; }

    .stat-icon {
        font-size: 2.2rem;
        color: #2C3E50 !important;
        opacity: 1;
        margin-bottom: 0;
        width: 60px;
        height: 60px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: rgba(0,0,0,0.03);
        border-radius: 12px;
        flex-shrink: 0;
    }

    .stat-content-wrap {
        display: flex;
        flex-direction: column;
        justify-content: center;
        text-align: left;
    }

    .stat-number {
        font-size: 2.5rem;
        font-weight: 700;
        line-height: 1.1;
        font-family: 'Poppins', sans-serif;
        margin-top: 0;
        margin-bottom: 5px;
        color: #2C3E50;
    }

    .stat-label {
        font-size: 0.9rem;
        opacity: 1;
        margin-bottom: 0;
        font-family: 'Poppins', sans-serif;
        font-weight: 500;
        text-transform: capitalize;
        color: #2C3E50;
    }

    .table-responsive {
        border-radius: 12px;
        overflow-x: auto;
        border: 1px solid rgba(44, 62, 80, 0.05);
        -webkit-overflow-scrolling: touch;
    }

    .table {
        min-width: 1200px;
        margin-bottom: 0;
    }

    .table thead {
        background: #F8F9FA;
        color: var(--dark);
        border-bottom: 2px solid #E0E0E0;
    }

    .table th {
        font-weight: 700;
        padding: 12px 10px;
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        white-space: nowrap;
        border: none;
        color: var(--dark);
        font-family: 'Poppins', sans-serif;
    }

    .table td {
        padding: 12px 10px;
        border-top: 1px solid #F0F0F0;
        font-size: 0.9rem;
        vertical-align: middle;
        white-space: nowrap;
        color: var(--dark);
        font-family: 'Poppins', sans-serif;
    }

    .table td.col-keterangan {
        white-space: normal;
        max-width: 200px;
        line-height: 1.4;
        color: var(--dark);
        text-decoration: none;
        cursor: default;
    }

    .table td.col-tanggal {
        font-weight: 600;
        color: var(--dark);
        font-size: 0.9rem;
        text-align: left;
        background-color: transparent;
        line-height: 1.5;
    }

    .table-hover tbody tr:hover {
        background: #F4F6F7;
    }
    .table-hover tbody tr:hover td.col-tanggal {
        background-color: #F4F6F7;
    }

    .badge-pill {
        padding: 6px 12px;
        border-radius: 50px;
        font-weight: 600;
        font-size: 0.8rem;
        display: inline-block;
        white-space: nowrap;
        font-family: 'Poppins', sans-serif;
        background: #EBF5FB;
        color: var(--primary);
        border: 1px solid #D6EAF8;
    }

    .status-badge {
        padding: 6px 16px;
        border-radius: 50px;
        font-weight: 600;
        font-size: 0.75rem;
        display: inline-block;
        border: 1px solid transparent;
        white-space: nowrap;
        font-family: 'Poppins', sans-serif;
        box-shadow: 0 2px 4px rgba(0,0,0,0.05);
    }

    .status-menunggu { background-color: #FFF3CD; color: #856404; border-color: #FFE69C; }
    .status-proses { background-color: #B3E5FC; color: #0277BD; border-color: #81D4FA; }
    .status-selesai { background-color: #C8E6C9; color: #2E7D32; border-color: #A5D6A7; }

    .foto-pengaduan {
        width: 60px;
        height: 60px;
        object-fit: cover;
        border-radius: 8px;
        margin: 0 auto;
        border: 1px solid #E0E0E0;
        display: block;
    }
    .foto-placeholder {
        width: 60px;
        height: 60px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #F4F6F7;
        border-radius: 8px;
        border: 1px solid #E0E0E0;
        color: var(--accent);
        margin: 0 auto;
    }

    .panduan-list { list-style: none; padding: 0; margin: 0; }
    .panduan-item {
        display: flex;
        align-items: flex-start;
        padding: 15px 0;
        border-bottom: 1px solid #F0F0F0;
    }
    .panduan-item:last-child { border-bottom: none; }
    .panduan-icon {
        width: 40px;
        height: 40px;
        background: #EBF5FB;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--secondary);
        margin-right: 15px;
        flex-shrink: 0;
        font-size: 1.1rem;
    }
    .panduan-content h6 {
        color: var(--primary);
        font-weight: 700;
        margin-bottom: 5px;
        font-size: 1rem;
        font-family: 'Poppins', sans-serif;
    }
    .panduan-content p {
        color: var(--muted);
        font-size: 0.9rem;
        margin: 0;
        line-height: 1.5;
        opacity: 1;
        font-family: 'Poppins', sans-serif;
    }

    @media (max-width: 768px) {
        .stat-number { font-size: 1.8rem; }
        .earth-card-header { font-size: 1rem; padding: 16px 20px; }

        .stat-card-1, .stat-card-2, .stat-card-3, .stat-card-4 {
            flex-direction: column;
            text-align: center;
            gap: 10px;
            padding: 15px;
        }
        .stat-icon {
            width: 50px;
            height: 50px;
            font-size: 1.8rem;
            margin: 0 auto;
        }
        .stat-content-wrap {
            text-align: center;
        }
    }
</style>

<div class="container-fluid py-4 px-0">

    <div class="row g-4 mb-4">
        <div class="col-md-3 col-sm-6">
            <div class="modern-card stat-card-1">
                <i class="fas fa-clipboard-list stat-icon"></i>
                <div class="stat-content-wrap">
                    <div class="stat-label">Total Pengaduan</div>
                    <div class="stat-number">{{ $total }}</div>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6">
            <div class="modern-card stat-card-2">
                <i class="fas fa-clock stat-icon"></i>
                <div class="stat-content-wrap">
                    <div class="stat-label">Menunggu</div>
                    <div class="stat-number">{{ $menunggu }}</div>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6">
            <div class="modern-card stat-card-3">
                <i class="fas fa-cog stat-icon"></i>
                <div class="stat-content-wrap">
                    <div class="stat-label">Diproses</div>
                    <div class="stat-number">{{ $proses }}</div>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6">
            <div class="modern-card stat-card-4">
                <i class="fas fa-check-circle stat-icon"></i>
                <div class="stat-content-wrap">
                    <div class="stat-label">Selesai</div>
                    <div class="stat-number">{{ $selesai }}</div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-lg-8">
            <div class="earth-card">
                <div class="earth-card-header">
                    <i class="fas fa-chart-bar me-2"></i>Laporan Pengaduan Terbaru
                </div>
                <div class="card-body-custom">
                    @if($pengaduanTerbaru->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead>
                                    <tr>
                                        <th width="8%">NIS</th>
                                        <th width="13%">Nama Siswa</th>
                                        <th width="8%">Kelas</th>
                                        <th width="13%">Kategori</th>
                                        <th width="13%">Lokasi</th>
                                        <th width="17%">Keterangan</th>
                                        <th width="6%" class="text-center">Foto</th>
                                        <th width="8%">Status</th>
                                        <th width="8%">Tanggal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($pengaduanTerbaru as $aspirasi)
                                    <tr>
                                        <td><strong>{{ $aspirasi->nis }}</strong></td>

                                        <td>{{ $aspirasi->siswa->name ?? '-' }}</td>

                                        <td>
                                            <span style="font-size: 0.9rem; font-weight: 500; color: var(--dark);">
                                                {{ $aspirasi->siswa->kelas ?? '-' }}
                                            </span>
                                        </td>

                                        <td><span class="badge-pill badge-kategori">{{ $aspirasi->kategori->ket_kategori }}</span></td>

                                        <td style="font-size: 0.9rem; color: var(--dark);">
                                            {{ $aspirasi->lokasi }}
                                        </td>

                                        <td class="col-keterangan">
                                            {{ Str::limit($aspirasi->ket, 40) }}
                                        </td>

                                        <td class="text-center">
                                            @if($aspirasi->foto)
                                                <img src="{{ $aspirasi->foto_url }}" alt="Foto" class="foto-pengaduan">
                                            @else
                                                <div class="foto-placeholder"><i class="fas fa-image"></i></div>
                                            @endif
                                        </td>

                                        <td>
                                            <span class="status-badge
                                                @if($aspirasi->status == 'Menunggu') status-menunggu
                                                @elseif($aspirasi->status == 'Proses') status-proses
                                                @else status-selesai @endif">
                                                {{ $aspirasi->status }}
                                            </span>
                                        </td>

                                        <td class="col-tanggal">
                                            {{ $aspirasi->created_at->format('d M') }}<br>
                                            {{ $aspirasi->created_at->format('Y') }}
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="text-center mt-3">
                            <a href="{{ route('admin.aspirasi.index') }}" class="btn btn-sm" style="background: var(--dark); color: white; border-radius: 8px; padding: 8px 20px; font-weight: 600; font-family: 'Poppins', sans-serif;">
                                Lihat Semua Pengaduan <i class="fas fa-arrow-right ms-2"></i>
                            </a>
                        </div>
                    @else
                        <div class="text-center py-5">
                            <i class="fas fa-inbox fa-3x text-muted mb-3" style="opacity: 0.5; color: var(--muted);"></i>
                            <p class="text-muted mb-0">Belum ada pengaduan masuk.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="earth-card">
                <div class="earth-card-header">
                    <i class="fas fa-book-open me-2"></i>Panduan Penggunaan
                </div>
                <div class="card-body-custom">
                    <ul class="panduan-list">
                        <li class="panduan-item">
                            <div class="panduan-icon"><i class="fas fa-search"></i></div>
                            <div class="panduan-content">
                                <h6>Filter Data</h6>
                                <p>Gunakan menu filter di halaman daftar pengaduan untuk mencari berdasarkan tanggal, NIS, atau kategori.</p>
                            </div>
                        </li>
                        <li class="panduan-item">
                            <div class="panduan-icon"><i class="fas fa-edit"></i></div>
                            <div class="panduan-content">
                                <h6>Update Status</h6>
                                <p>Klik ikon pensil pada kolom aksi untuk mengubah status pengaduan dan memberikan feedback kepada siswa.</p>
                            </div>
                        </li>
                        <li class="panduan-item">
                            <div class="panduan-icon"><i class="fas fa-comment-dots"></i></div>
                            <div class="panduan-content">
                                <h6>Berikan Feedback</h6>
                                <p>Isi kolom feedback dengan informasi yang jelas agar siswa mengetahui tindak lanjut laporan mereka.</p>
                            </div>
                        </li>
                        <li class="panduan-item">
                            <div class="panduan-icon"><i class="fas fa-user-graduate"></i></div>
                            <div class="panduan-content">
                                <h6>Daftar Siswa</h6>
                                <p>Fitur daftar siswa digunakan untuk melihat data siswa yang meliputi nama, NIS, kelas, dan email</p>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
