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

    .stat-card-1 { background: var(--stat-gradient-1); color: white; }
    .stat-card-2 { background: var(--stat-gradient-2); color: white; }
    .stat-card-3 { background: var(--stat-gradient-3); color: white; }
    .stat-card-4 { background: var(--stat-gradient-4); color: white; }

   .stat-icon {
    font-size: 1.8rem;
    color: white !important;
    opacity: 1;
    margin-bottom: 10px;
    }

    .stat-number {
        font-size: 2rem;
        font-weight: 700;
        line-height: 1.2;
        font-family: 'Poppins', sans-serif;
        margin-top: 5px;
    }

    .stat-label {
        font-size: 0.85rem;
        opacity: 0.9;
        margin-bottom: 0;
        font-family: 'Poppins', sans-serif;
        font-weight: 500;
        text-transform: capitalize;
    }

    .table-responsive {
        border-radius: 12px;
        overflow-x: auto;
        border: 1px solid rgba(44, 62, 80, 0.05);
        -webkit-overflow-scrolling: touch;
    }

    .table {
        min-width: 900px;
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
        max-width: 180px;
        line-height: 1.4;
        cursor: pointer;
        color: var(--secondary);
        text-decoration: underline dotted;
        text-underline-offset: 3px;
    }

    .table td.col-keterangan:hover {
        color: var(--primary);
        text-decoration: underline;
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

    .modal-custom-simple {
        display: none;
        position: fixed;
        z-index: 9999;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(44, 62, 80, 0.5);
        animation: fadeIn 0.3s;
    }
    .modal-content-custom {
        background-color: white;
        margin: 10% auto;
        padding: 0;
        border-radius: 20px;
        width: 90%;
        max-width: 500px;
        box-shadow: 0 20px 60px rgba(0,0,0,0.2);
        animation: slideUp 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        position: relative;
        overflow: hidden;
    }
    .modal-header-custom {
        background: var(--stat-gradient-1);
        color: white;
        padding: 20px 25px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .modal-title-custom {
        color: white;
        font-weight: 700;
        font-size: 1.3rem;
        margin: 0;
        font-family: 'Poppins', sans-serif;
    }
    .close-btn {
        background: rgba(255,255,255,0.2);
        border: none;
        color: white;
        width: 30px;
        height: 30px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: 0.3s;
        font-size: 1.2rem;
        line-height: 1;
    }
    .close-btn:hover {
        background: rgba(255,255,255,0.4);
        transform: rotate(90deg);
    }
    .modal-body-custom {
        padding: 25px;
        color: var(--dark);
        font-size: 1rem;
        line-height: 1.6;
        max-height: 60vh;
        overflow-y: auto;
        font-family: 'Poppins', sans-serif;
    }

    @keyframes fadeIn { from {opacity: 0;} to {opacity: 1;} }
    @keyframes slideUp { from {transform: translateY(50px); opacity: 0;} to {transform: translateY(0); opacity: 1;} }

    @media (max-width: 768px) {
        .modal-content-custom { margin: 10% auto; width: 95%; }
        .stat-number { font-size: 1.8rem; }
        .earth-card-header { font-size: 1rem; padding: 16px 20px; }
    }
</style>

<div class="container-fluid py-4">

    <!-- Statistik Cards -->
    <div class="row g-4 mb-4">
        <div class="col-md-3 col-sm-6">
            <div class="modern-card stat-card-1 text-center p-3">
                <i class="fas fa-clipboard-list stat-icon"></i>
                <div class="stat-label">Total Pengaduan</div>
                <div class="stat-number">{{ $total }}</div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6">
            <div class="modern-card stat-card-2 text-center p-3">
                <i class="fas fa-clock stat-icon"></i>
                <div class="stat-label">Menunggu</div>
                <div class="stat-number">{{ $menunggu }}</div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6">
            <div class="modern-card stat-card-3 text-center p-3">
                <i class="fas fa-cog stat-icon"></i>
                <div class="stat-label">Diproses</div>
                <div class="stat-number">{{ $proses }}</div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6">
            <div class="modern-card stat-card-4 text-center p-3">
                <i class="fas fa-check-circle stat-icon"></i>
                <div class="stat-label">Selesai</div>
                <div class="stat-number">{{ $selesai }}</div>
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
                                <th width="6%" class="text-center">Foto</th>
                                <th width="7%">NIS</th>
                                <th width="10%">Nama Siswa</th>
                                <th width="6%">Kelas</th>
                                <th width="10%">Kategori</th>
                                <th width="12%">Lokasi</th>
                                <th width="14%">Keterangan</th>
                                <th width="8%">Status</th>
                                <th width="8%">Tanggal</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($pengaduanTerbaru as $aspirasi)
                                <tr>
                                    <td class="text-center">
                                        @if($aspirasi->foto)
                                            <img src="{{ $aspirasi->foto_url }}" alt="Foto" class="foto-pengaduan">
                                        @else
                                            <div class="foto-placeholder"><i class="fas fa-image"></i></div>
                                        @endif
                                    </td>
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

                                    <td class="col-keterangan" onclick="showModal('Detail Keterangan', '{{ str_replace("'", "\\'", $aspirasi->ket) }}')">
                                        {{ Str::limit($aspirasi->ket, 25) }}
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
                            <a href="{{ route('admin.aspirasi.index') }}" class="btn btn-sm" style="background: var(--secondary); color: white; border-radius: 8px; padding: 8px 20px; font-weight: 600; font-family: 'Poppins', sans-serif;">
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
                                <p>Fitur daftar siswa digunakan untuk memasukkan data siswa baru seperti nama, NIS, dan kelas.</p>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- MODAL DETAIL -->
<div id="detailModalSimple" class="modal-custom-simple" onclick="closeModal(event)">
    <div class="modal-content-custom">
        <div class="modal-header-custom">
            <h4 class="modal-title-custom" id="modalTitleSimple">Detail</h4>
            <button class="close-btn" onclick="closeModalDirect()">&times;</button>
        </div>
        <div class="modal-body-custom" id="modalBodySimple">
            <!-- Konten diisi JS -->
        </div>
    </div>
</div>

<script>
    function showModal(title, content) {
        document.getElementById('modalTitleSimple').innerText = title;
        document.getElementById('modalBodySimple').innerText = content;
        document.getElementById('detailModalSimple').style.display = 'block';
    }

    function closeModal(event) {
        if (event.target.id === 'detailModalSimple') closeModalDirect();
    }

    function closeModalDirect() {
        document.getElementById('detailModalSimple').style.display = 'none';
    }

    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
            closeModalDirect();
        }
    });
</script>
@endsection
