@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('content')
<style>
    /* Font Poppins */
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

    /* Palet warna Coklat Eksklusif */
    :root {
        --primary: #5D4037;
        --secondary: #795548;
        --accent: #8D6E63;
        --light: #F5F1EB;
        --dark: #3E2723;
        --muted: #BCAAA4;

        --card-gradient: linear-gradient(135deg, #ffffff, #f9f5f0);
        --stat-gradient-1: linear-gradient(135deg, #5D4037, #3E2723);
        --stat-gradient-2: linear-gradient(135deg, #8D6E63, #795548);
        --stat-gradient-3: linear-gradient(135deg, #5D4037, #5D4037);
        --stat-gradient-4: linear-gradient(135deg, #BCAAA4, #A1887F);

        --card-shadow: 0 4px 20px rgba(93, 64, 55, 0.08);
        --btn-shadow: 0 4px 12px rgba(93, 64, 55, 0.2);
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
        border: 1px solid rgba(93, 64, 55, 0.05);
        margin-bottom: 24px;
        height: 100%;
        transition: all 0.3s ease;
    }

    .earth-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 6px 25px rgba(93, 64, 55, 0.12);
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
        border: 1px solid rgba(93, 64, 55, 0.05);
        height: 100%;
    }

    .modern-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 6px 25px rgba(93, 64, 55, 0.12);
    }

    .stat-card-1 { background: var(--stat-gradient-1); color: white; }
    .stat-card-2 { background: var(--stat-gradient-2); color: white; }
    .stat-card-3 { background: var(--stat-gradient-3); color: white; }
    .stat-card-4 { background: var(--stat-gradient-4); color: var(--dark); }

    .stat-icon {
        font-size: 2.2rem;
        opacity: 0.9;
        margin-bottom: 12px;
        display: block;
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
        border: 1px solid rgba(93, 64, 55, 0.05);
        -webkit-overflow-scrolling: touch;
    }

    .table {
        min-width: 900px;
        margin-bottom: 0;
    }

    .table thead {
        background: var(--primary);
        color: white;
    }

    .table th {
        font-weight: 600;
        padding: 12px 10px;
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 1px;
        white-space: nowrap;
        border: none;
        font-family: 'Poppins', sans-serif;
    }

    .table td {
        padding: 12px 10px;
        border-top: 1px solid rgba(93, 64, 55, 0.08);
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
        color: var(--primary);
        text-decoration: underline dotted;
        text-underline-offset: 3px;
    }

    .table td.col-keterangan:hover {
        color: var(--secondary);
        text-decoration: underline;
    }

    .table td.col-tanggal {
        font-weight: 500;
        color: var(--dark);
        font-size: 0.9rem;
        text-align: left;
        background-color: #ffffff;
        border-left: 1px solid rgba(93, 64, 55, 0.08);
        line-height: 1.5;
    }

    .table-hover tbody tr:hover {
        background: rgba(93, 64, 55, 0.02);
    }
    .table-hover tbody tr:hover td.col-tanggal {
        background-color: #fafafa;
    }

    .badge-pill {
        padding: 6px 12px;
        border-radius: 50px;
        font-weight: 600;
        font-size: 0.8rem;
        display: inline-block;
        white-space: nowrap;
        font-family: 'Poppins', sans-serif;
    }
    .badge-kategori {
        background-color: #f5f1eb;
        color: #5d4037;
        border: 1px solid #8d6e63;
    }

    /* Status Badge - Warna Cerah */
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
        border: 1px solid rgba(93, 64, 55, 0.1);
        display: block;
    }
    .foto-placeholder {
        width: 60px;
        height: 60px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: var(--light);
        border-radius: 8px;
        border: 1px solid rgba(93, 64, 55, 0.1);
        color: var(--accent);
        margin: 0 auto;
    }

    .panduan-list { list-style: none; padding: 0; margin: 0; }
    .panduan-item {
        display: flex;
        align-items: flex-start;
        padding: 15px 0;
        border-bottom: 1px solid rgba(93, 64, 55, 0.1);
    }
    .panduan-item:last-child { border-bottom: none; }
    .panduan-icon {
        width: 40px;
        height: 40px;
        background: var(--light);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--primary);
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
        color: var(--dark);
        font-size: 0.9rem;
        margin: 0;
        line-height: 1.5;
        opacity: 0.9;
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
        background-color: rgba(62, 39, 35, 0.4);
        animation: fadeIn 0.3s;
    }
    .modal-content-custom {
        background-color: white;
        margin: 10% auto;
        padding: 0;
        border-radius: 20px;
        width: 90%;
        max-width: 500px;
        box-shadow: 0 20px 60px rgba(0,0,0,0.3);
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
        <!-- Kolom Kiri: Laporan Pengaduan Terbaru -->
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
                                        <th width="12%">Nama Siswa</th>
                                        <th width="7%">Kelas</th>
                                        <th width="12%">Kategori</th>
                                        <th width="16%">Keterangan</th>
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

                                        <!-- KOLOM KELAS: Teks Biasa (Tanpa Button/Badge) -->
                                        <td>
                                            <span style="font-size: 0.9rem; font-weight: 500; color: var(--dark);">
                                                {{ $aspirasi->siswa->kelas ?? '-' }}
                                            </span>
                                        </td>

                                        <td><span class="badge-pill badge-kategori">{{ $aspirasi->kategori->ket_kategori }}</span></td>
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
                            <a href="{{ route('admin.aspirasi.index') }}" class="btn btn-sm" style="background: var(--primary); color: white; border-radius: 8px; padding: 8px 20px; font-weight: 600; font-family: 'Poppins', sans-serif;">
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

        <!-- Kolom Kanan: Panduan Penggunaan -->
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
                            <div class="panduan-icon"><i class="fas fa-chart-line"></i></div>
                            <div class="panduan-content">
                                <h6>Pantau Statistik</h6>
                                <p>Perhatikan dashboard untuk melihat tren pengaduan dan evaluasi kinerja penanganan sarana sekolah.</p>
                            </div>
                        </li>
                    </ul>

                    <div class="mt-4 p-3" style="background: var(--light); border-radius: 12px; border: 1px dashed var(--accent);">
                        <h6 style="color: var(--primary); font-weight: 700; margin-bottom: 8px; font-family: 'Poppins', sans-serif;"><i class="fas fa-lightbulb me-2"></i>Tips Cepat</h6>
                        <p style="font-size: 0.85rem; color: var(--dark); margin: 0; font-family: 'Poppins', sans-serif;">
                            Prioritaskan pengaduan dengan status <strong>"Menunggu"</strong> untuk segera ditindaklanjuti agar tidak menumpuk.
                        </p>
                    </div>
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
