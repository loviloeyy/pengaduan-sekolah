@extends('layouts.app')

@section('title', 'Laporan Pengaduan')

@section('content')
<style>
    /* Palet warna Earth Tone */
    :root {
        --primary: #5D4037;
        --secondary: #795548;
        --accent: #8D6E63;
        --light: #F5F1EB;
        --dark: #3E2723;
        --card-gradient: linear-gradient(135deg, #ffffff, #f8f4f0);
        --header-gradient: linear-gradient(135deg, #5D4037, #795548);
    }

    .earth-card {
        background: var(--card-gradient);
        border: none;
        border-radius: 16px;
        box-shadow: 0 4px 20px rgba(93, 64, 55, 0.1);
        overflow: hidden;
        border: 1px solid rgba(93, 64, 55, 0.05);
    }

    .earth-card-header {
        background: var(--header-gradient);
        color: white;
        border-radius: 16px 16px 0 0 !important;
        padding: 20px 24px;
        font-weight: 600;
        display: flex;
        align-items: center;
        justify-content: space-between;
        font-size: 1.2rem;
    }

    .stat-card {
        background: white;
        border-radius: 12px;
        padding: 20px;
        text-align: center;
        box-shadow: 0 2px 10px rgba(93, 64, 55, 0.05);
        transition: all 0.3s ease;
        border: 1px solid rgba(93, 64, 55, 0.05);
    }

    .stat-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 4px 15px rgba(93, 64, 55, 0.1);
    }

    .stat-number {
        font-size: 2rem;
        font-weight: 700;
        color: var(--primary);
        margin: 10px 0;
    }

    .stat-label {
        font-size: 0.9rem;
        color: var(--dark);
        opacity: 0.8;
    }

    .status-badge {
        padding: 5px 15px;
        border-radius: 20px;
        font-weight: 600;
        font-size: 0.85rem;
        display: inline-block;
        border: 1px solid rgba(0,0,0,0.1);
        white-space: nowrap;
    }

    .status-menunggu { background-color: #fff9db; color: #856404; }
    .status-proses { background-color: #d1ecf1; color: #0c5460; }
    .status-selesai { background-color: #d4edda; color: #155724; }

    /* Badge Kategori - Bisa Diklik */
    .kategori-badge {
        padding: 6px 12px;
        border-radius: 50px;
        font-weight: 600;
        font-size: 0.8rem;
        display: inline-block;
        border: 1px solid #8d6e63;
        background-color: #f5f1eb;
        color: #5d4037;
        max-width: 130px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        vertical-align: middle;
        text-align: center;
        cursor: pointer;
        transition: all 0.2s;
    }

    .kategori-badge:hover {
        background-color: var(--primary);
        color: white;
        border-color: var(--primary);
        transform: scale(1.05);
    }

    .empty-state {
        text-align: center;
        padding: 40px 20px;
    }

    .empty-icon {
        font-size: 3.5rem;
        color: #BCAAA4;
        margin-bottom: 15px;
    }

    .foto-pengaduan {
        width: 60px;
        height: 60px;
        object-fit: cover;
        border-radius: 8px;
        margin: 0 auto;
        border: 1px solid rgba(93, 64, 55, 0.1);
        display: block;
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
    }

    .table td {
        padding: 12px 10px;
        border-top: 1px solid rgba(93, 64, 55, 0.08);
        font-size: 0.9rem;
        vertical-align: middle;
        white-space: nowrap;
    }

    /* Kolom Keterangan */
    .table td:nth-child(7) {
        white-space: normal;
        max-width: 150px;
        line-height: 1.4;
        cursor: pointer;
        color: var(--primary);
        text-decoration: underline dotted;
    }

    .table td:nth-child(7):hover {
        color: var(--secondary);
        text-decoration: underline;
    }

    /* Kolom Tanggal - Background Putih Bersih */
    .table td.col-tanggal {
        font-weight: 500;
        color: var(--dark);
        font-size: 0.9rem;
        text-align: left;
        background-color: #ffffff; /* Background Putih */
        border-left: 1px solid rgba(93, 64, 55, 0.08); /* Garis pemisah tipis */
        line-height: 1.5;
    }

    .table-hover tbody tr:hover {
        background: rgba(93, 64, 55, 0.02);
    }

    /* Pastikan saat hover, kolom tanggal tetap putih atau sedikit abu sangat muda */
    .table-hover tbody tr:hover td.col-tanggal {
        background-color: #fafafa;
    }

    /* Modal Custom Style */
    .modal-custom {
        display: none;
        position: fixed;
        z-index: 9999;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0,0,0,0.5);
        animation: fadeIn 0.3s;
    }

    .modal-content-custom {
        background-color: white;
        margin: 15% auto;
        padding: 30px;
        border-radius: 16px;
        width: 90%;
        max-width: 500px;
        box-shadow: 0 10px 40px rgba(0,0,0,0.3);
        animation: slideDown 0.3s;
        position: relative;
    }

    .modal-header-custom {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
        padding-bottom: 15px;
        border-bottom: 2px solid var(--light);
    }

    .modal-title-custom {
        color: var(--primary);
        font-weight: 700;
        font-size: 1.3rem;
        margin: 0;
    }

    .close-btn {
        color: var(--accent);
        font-size: 28px;
        font-weight: bold;
        cursor: pointer;
        transition: 0.3s;
        line-height: 1;
    }

    .close-btn:hover {
        color: var(--dark);
        transform: rotate(90deg);
    }

    .modal-body-custom {
        color: var(--dark);
        font-size: 1rem;
        line-height: 1.6;
        max-height: 60vh;
        overflow-y: auto;
    }

    @keyframes fadeIn {
        from {opacity: 0;}
        to {opacity: 1;}
    }

    @keyframes slideDown {
        from {transform: translateY(-50px); opacity: 0;}
        to {transform: translateY(0); opacity: 1;}
    }

    /* Responsive Modal */
    @media (max-width: 768px) {
        .modal-content-custom {
            margin: 10% auto;
            width: 95%;
            padding: 20px;
        }
        .modal-title-custom {
            font-size: 1.1rem;
        }
    }
</style>

<div class="row">
    <div class="col-12 mb-4">
        <h2 class="section-title">Statistik Pengaduan</h2>
    </div>

    <!-- Statistik Cards -->
    <div class="col-md-3 col-sm-6 mb-4">
        <div class="stat-card">
            <i class="fas fa-clipboard-list fa-2x" style="color: var(--primary); opacity: 0.8;"></i>
            <div class="stat-label">Total Pengaduan</div>
            <div class="stat-number">{{ $totalPengaduan }}</div>
        </div>
    </div>

    <div class="col-md-3 col-sm-6 mb-4">
        <div class="stat-card">
            <i class="fas fa-clock fa-2x" style="color: var(--primary); opacity: 0.8;"></i>
            <div class="stat-label">Menunggu</div>
            <div class="stat-number">{{ $menunggu }}</div>
        </div>
    </div>

    <div class="col-md-3 col-sm-6 mb-4">
        <div class="stat-card">
            <i class="fas fa-cog fa-2x" style="color: var(--primary); opacity: 0.8;"></i>
            <div class="stat-label">Diproses</div>
            <div class="stat-number">{{ $proses }}</div>
        </div>
    </div>

    <div class="col-md-3 col-sm-6 mb-4">
        <div class="stat-card">
            <i class="fas fa-check-circle fa-2x" style="color: var(--primary); opacity: 0.8;"></i>
            <div class="stat-label">Selesai</div>
            <div class="stat-number">{{ $selesai }}</div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="earth-card">
            <div class="earth-card-header">
                <span><i class="fas fa-chart-bar me-2"></i>Laporan Pengaduan Siswa</span>
            </div>
            <div class="card-body p-4">
                @if($pengaduanTerbaru->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th width="6%" class="text-center">Foto</th>
                                    <th width="7%">NIS</th>
                                    <th width="12%">Nama Siswa</th>
                                    <th width="6%">Kelas</th>
                                    <th width="12%">Kategori</th>
                                    <th width="12%">Lokasi</th>
                                    <th width="18%">Keterangan</th>
                                    <th width="9%">Status</th>
                                    <th width="10%">Feedback</th>
                                    <th width="8%">Tanggal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($pengaduanTerbaru as $aspirasi)
                                <tr>
                                    <td class="text-center">
                                        @if($aspirasi->foto)
                                            <img src="{{ $aspirasi->foto_url }}" alt="Foto Pengaduan" class="foto-pengaduan">
                                        @else
                                            <div style="text-align: center; color: #BCAAA4;">
                                                <i class="fas fa-image fa-2x"></i>
                                            </div>
                                        @endif
                                    </td>
                                    <td>{{ $aspirasi->nis }}</td>
                                    <td>{{ $aspirasi->siswa->name ?? 'Tidak diketahui' }}</td>
                                    <td>{{ $aspirasi->siswa->kelas ?? '-' }}</td>

                                    <!-- KATEGORI BISA DIKLIK -->
                                    <td>
                                        <span class="kategori-badge"
                                              onclick="showModal('Detail Kategori', '{{ $aspirasi->kategori->ket_kategori }}')">
                                            {{ $aspirasi->kategori->ket_kategori }}
                                        </span>
                                    </td>

                                    <td>{{ $aspirasi->lokasi }}</td>

                                    <!-- KETERANGAN BISA DIKLIK -->
                                    <td onclick="showModal('Detail Keterangan', '{{ str_replace("'", "\\'", $aspirasi->ket) }}')">
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
                                    <td>{{ $aspirasi->feedback ?? '-' }}</td>

                                    <!-- KOLOM TANGGAL (Background Putih) -->
                                    <td class="col-tanggal">
                                        {{ $aspirasi->created_at->format('d M') }}<br>
                                        {{ $aspirasi->created_at->format('Y') }}
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="empty-state">
                        <div class="empty-icon">
                            <i class="fas fa-inbox"></i>
                        </div>
                        <h5 class="text-muted mb-2">Belum ada pengaduan</h5>
                        <p class="text-muted mb-3">Belum ada pengaduan sarana sekolah yang diajukan oleh siswa</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Per Bulan Chart -->
<div class="row mt-4">
    <div class="col-md-12">
        <div class="earth-card">
            <div class="earth-card-header">
                <span><i class="fas fa-calendar-alt me-2"></i>Pengaduan per Bulan</span>
            </div>
            <div class="card-body p-4">
                @if($perBulan->count() > 0)
                    <div class="row">
                        @foreach($perBulan as $bulan)
                        <div class="col-md-2 col-sm-4 mb-3">
                            <div class="text-center p-3 bg-light rounded" style="border: 1px solid rgba(93, 64, 55, 0.1);">
                                <div class="fw-bold" style="color: var(--dark);">{{ $bulan->label }}</div>
                                <div class="display-6 mt-2" style="color: var(--primary);">{{ $bulan->total }}</div>
                                <div class="text-muted small">pengaduan</div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-4">
                        <i class="fas fa-chart-bar fa-2x text-muted mb-2"></i>
                        <p class="text-muted">Tidak ada data pengaduan dalam 6 bulan terakhir</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- MODAL POPUP UNTUK DETAIL -->
<div id="detailModal" class="modal-custom" onclick="closeModal(event)">
    <div class="modal-content-custom">
        <div class="modal-header-custom">
            <h4 class="modal-title-custom" id="modalTitle">Detail</h4>
            <span class="close-btn" onclick="closeModalDirect()">&times;</span>
        </div>
        <div class="modal-body-custom" id="modalBody">
            <!-- Konten akan diisi oleh JavaScript -->
        </div>
    </div>
</div>

<script>
    function showModal(title, content) {
        document.getElementById('modalTitle').innerText = title;
        document.getElementById('modalBody').innerText = content;
        document.getElementById('detailModal').style.display = 'block';
        document.body.style.overflow = 'hidden';
    }

    function closeModal(event) {
        if (event.target.id === 'detailModal') {
            document.getElementById('detailModal').style.display = 'none';
            document.body.style.overflow = 'auto';
        }
    }

    function closeModalDirect() {
        document.getElementById('detailModal').style.display = 'none';
        document.body.style.overflow = 'auto';
    }

    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
            closeModalDirect();
        }
    });
</script>
@endsection
