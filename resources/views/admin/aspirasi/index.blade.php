@extends('layouts.app')

@section('title', 'Daftar Pengaduan')

@section('content')
<style>
    /* Palet warna Earth Tone */
    :root {
        --primary: #5D4037;
        --secondary: #795548;
        --accent: #8D6E63;
        --light: #F5F1EB;
        --dark: #3E2723;
        --white: #ffffff;
        --card-gradient: linear-gradient(135deg, #ffffff, #f8f4f0);
        --header-gradient: linear-gradient(135deg, #5D4037, #795548);
    }

    body { background-color: #faf9f7; }

    /* Card Styling */
    .earth-card {
        background: var(--card-gradient);
        border: none;
        border-radius: 16px;
        box-shadow: 0 4px 20px rgba(93, 64, 55, 0.1);
        overflow: hidden;
        border: 1px solid rgba(93, 64, 55, 0.05);
        margin-bottom: 24px;
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
        flex-wrap: wrap;
        gap: 15px;
        font-size: 1.2rem;
    }

    .btn-riwayat {
        background-color: var(--white);
        color: var(--primary);
        border: none;
        border-radius: 50px;
        padding: 10px 20px;
        font-weight: 800;
        font-size: 0.75rem;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        box-shadow: 0 4px 15px rgba(0,0,0,0.2);
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        z-index: 10;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .btn-riwayat:hover {
        background-color: var(--light);
        color: var(--dark);
        transform: translateY(-3px) scale(1.05);
        box-shadow: 0 8px 25px rgba(0,0,0,0.3);
    }

    .btn-riwayat i {
        margin-right: 8px;
        font-size: 1.1rem;
    }

    /* Filter Panel */
    .filter-panel {
        background: var(--light);
        border-radius: 12px;
        padding: 20px;
        margin-bottom: 24px;
        border: 1px solid rgba(93, 64, 55, 0.1);
    }
    .form-label { font-weight: 600; color: var(--dark); margin-bottom: 8px; font-size: 0.9rem; }
    .form-control, .form-select {
        border-radius: 8px;
        border: 1px solid rgba(93, 64, 55, 0.2);
        padding: 8px 12px;
        background-color: var(--white);
        color: var(--dark);
    }
    .form-control:focus, .form-select:focus {
        border-color: var(--primary);
        box-shadow: 0 0 0 0.2rem rgba(93, 64, 55, 0.15);
    }
    .btn-primary {
        background: linear-gradient(135deg, var(--primary), var(--secondary));
        border: none;
        border-radius: 8px;
        padding: 8px 16px;
        font-weight: 600;
        color: white;
        transition: all 0.3s ease;
    }
    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(93, 64, 55, 0.3);
        color: white;
    }
    .btn-outline-secondary {
        border: 1px solid var(--primary);
        color: var(--primary);
        border-radius: 8px;
        padding: 8px 16px;
        font-weight: 600;
        background: transparent;
        transition: all 0.3s ease;
    }
    .btn-outline-secondary:hover { background: var(--primary); color: white; }

    /* Table Styling */
    .table-responsive {
        border-radius: 12px;
        overflow-x: auto;
        border: 1px solid rgba(93, 64, 55, 0.05);
        -webkit-overflow-scrolling: touch;
    }

    .table {
        min-width: 1000px;
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
    }

    .table td {
        padding: 12px 10px;
        border-top: 1px solid rgba(93, 64, 55, 0.08);
        font-size: 0.9rem;
        vertical-align: middle;
        white-space: nowrap;
        color: var(--dark);
    }

    /* Kolom Keterangan - BISA DIKLIK */
    .table td.col-keterangan {
        white-space: normal;
        max-width: 180px;
        line-height: 1.4;
        color: var(--primary);
        text-decoration: underline dotted;
        text-underline-offset: 3px;
        cursor: pointer;
        transition: all 0.2s;
    }

    .table td.col-keterangan:hover {
        color: var(--secondary);
        text-decoration: underline;
        font-weight: 600;
    }

    /* Kolom Tanggal */
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

    /* Badge Kategori */
    .badge-pill {
        padding: 6px 12px;
        border-radius: 50px;
        font-weight: 600;
        font-size: 0.8rem;
        display: inline-block;
        white-space: nowrap;
        transition: all 0.2s;
    }

    .badge-kategori {
        background-color: #f5f1eb;
        color: #5d4037;
        border: 1px solid #8d6e63;
        cursor: pointer;
    }
    .badge-kategori:hover {
        background-color: var(--primary);
        color: white;
        border-color: var(--primary);
        transform: scale(1.05);
    }

    /* Badge Status */
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

    /* Modern Action Buttons */
    .action-cell {
        text-align: center;
        white-space: nowrap;
    }

    .btn-action-modern {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background-color: var(--light);
        color: var(--primary);
        border: 1px solid transparent;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        cursor: pointer;
        padding: 0;
        margin: 0 2px;
        font-size: 0.8rem;
    }

    .btn-action-modern:hover {
        background-color: var(--primary);
        color: white;
        transform: rotate(90deg) scale(1.1);
        box-shadow: 0 4px 10px rgba(93, 64, 55, 0.3);
    }

    .btn-delete-modern {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background-color: #ffebee;
        color: #c62828;
        border: 1px solid transparent;
        transition: all 0.3s ease;
        cursor: pointer;
        padding: 0;
        margin: 0 2px;
        font-size: 0.8rem;
    }

    .btn-delete-modern:hover {
        background-color: #c62828;
        color: white;
        transform: scale(1.1);
        box-shadow: 0 4px 10px rgba(198, 40, 40, 0.3);
    }

    /* Foto */
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

    /* Pagination */
    .pagination .page-link {
        color: var(--primary);
        border: 1px solid rgba(93, 64, 55, 0.2);
        border-radius: 6px;
        padding: 8px 12px;
        margin: 0 4px;
    }
    .pagination .page-item.active .page-link {
        background-color: var(--primary);
        border-color: var(--primary);
        color: white;
    }
    .pagination .page-link:hover {
        background-color: rgba(93, 64, 55, 0.1);
    }

    /* Empty State */
    .empty-state {
        text-align: center;
        padding: 40px 20px;
        color: var(--accent);
    }
    .empty-state i { font-size: 3rem; margin-bottom: 15px; opacity: 0.6; }
    .empty-state h5 { color: var(--primary); font-weight: 600; }

    /* ========================================
       MODAL STYLES (PERBEDAAN UTAMA DI SINI)
       ======================================== */

    /* 1. Modal Detail (Kategori/Keterangan) - TANPA BLUR */
    .modal-custom-simple {
        display: none;
        position: fixed;
        z-index: 9999;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(62, 39, 35, 0.4); /* Gelap tapi TIDAK BLUR */
        animation: fadeIn 0.3s;
    }

    /* 2. Modal Edit (Aksi) - DENGAN BLUR */
    .modal-custom-blur {
        display: none;
        position: fixed;
        z-index: 9999;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(62, 39, 35, 0.6);
        backdrop-filter: blur(5px); /* EFEK BLUR HANYA DI SINI */
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
        background: var(--header-gradient);
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
    }

    /* Form Elements in Modal */
    .form-group-modern { margin-bottom: 20px; }
    .form-group-modern label {
        display: block;
        font-weight: 600;
        color: var(--dark);
        margin-bottom: 8px;
        font-size: 0.9rem;
    }
    .form-control-modern {
        width: 100%;
        padding: 12px 15px;
        border: 2px solid #e9ecef;
        border-radius: 10px;
        font-size: 0.95rem;
        transition: all 0.3s;
        background: #faf9f7;
        color: var(--dark);
    }
    .form-control-modern:focus {
        outline: none;
        border-color: var(--primary);
        background: white;
        box-shadow: 0 0 0 4px rgba(93, 64, 55, 0.1);
    }
    .btn-submit-modern {
        width: 100%;
        padding: 12px;
        background: var(--primary);
        color: white;
        border: none;
        border-radius: 10px;
        font-weight: 700;
        font-size: 1rem;
        cursor: pointer;
        transition: all 0.3s;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
    }
    .btn-submit-modern:hover {
        background: var(--secondary);
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(93, 64, 55, 0.3);
    }

    @keyframes fadeIn { from {opacity: 0;} to {opacity: 1;} }
    @keyframes slideUp { from {transform: translateY(50px); opacity: 0;} to {transform: translateY(0); opacity: 1;} }

    @media (max-width: 768px) {
        .modal-content-custom { margin: 10% auto; width: 95%; }
        .modal-title-custom { font-size: 1.1rem; }
        .earth-card-header { flex-direction: column; align-items: stretch; text-align: center; }
        .btn-riwayat { justify-content: center; width: 100%; margin-top: 10px; }
    }
</style>

<div class="container-fluid py-4">
    <div class="row">
        <div class="col-md-12">
            <div class="earth-card">
                <div class="earth-card-header">
                    <span><i class="fas fa-clipboard-list me-2"></i>Daftar Pengaduan Sarana Sekolah</span>

                    <!-- Tombol Riwayat yang Sangat Menonjol -->
                    <a href="{{ route('admin.aspirasi.riwayat') }}" class="btn-riwayat">
                        <i class="fas fa-history"></i> Lihat Riwayat Lengkap
                    </a>
                </div>

                <div class="card-body-custom">
                    <!-- Filter Panel -->
                    <div class="filter-panel">
                        <form method="GET" action="{{ route('admin.aspirasi.filter') }}" class="row g-3">
                            <div class="col-md-3">
                                <label class="form-label">Tanggal</label>
                                <input type="date" name="tanggal" class="form-control form-control-sm" value="{{ request('tanggal') }}">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Bulan</label>
                                <input type="month" name="bulan" class="form-control form-control-sm" value="{{ request('bulan') }}">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">NIS Siswa</label>
                                <input type="text" name="nis" class="form-control form-control-sm" placeholder="Cari NIS..." value="{{ request('nis') }}">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Kategori</label>
                                <select name="kategori" class="form-select form-select-sm">
                                    <option value="">Semua Kategori</option>
                                    @foreach($kategoris as $kategori)
                                        <option value="{{ $kategori->id_kategori }}" {{ request('kategori') == $kategori->id_kategori ? 'selected' : '' }}>
                                            {{ $kategori->ket_kategori }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-12 mt-3">
                                <button type="submit" class="btn btn-primary btn-sm me-2">
                                    <i class="fas fa-filter me-1"></i> Filter Data
                                </button>
                                @if(request()->anyFilled(['tanggal', 'bulan', 'nis', 'kategori']))
                                    <a href="{{ route('admin.aspirasi.index') }}" class="btn btn-outline-secondary btn-sm">
                                        <i class="fas fa-times me-1"></i> Reset
                                    </a>
                                @endif
                            </div>
                        </form>
                    </div>

                    <!-- Table Data -->
                    @if($aspirasis->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead>
                                    <tr>
                                        <th width="6%" class="text-center">Foto</th>
                                        <th width="7%">NIS</th>
                                        <th width="12%">Nama Siswa</th>
                                        <th width="7%">Kelas</th>
                                        <th width="12%">Kategori</th>
                                        <th width="12%">Lokasi</th>
                                        <th width="16%">Keterangan</th>
                                        <th width="8%">Status</th>
                                        <th width="10%">Feedback</th>
                                        <th width="8%">Tanggal</th>
                                        <th width="4%" class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($aspirasis as $aspirasi)
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

                                        <!-- KOLOM KELAS: Teks Biasa -->
                                        <td style="font-weight: 500; color: var(--dark);">
                                            {{ $aspirasi->siswa->kelas ?? '-' }}
                                        </td>

                                        <!-- Badge Kategori -->
                                        <td>
                                            <span class="badge-pill badge-kategori" onclick="showSimpleModal('Detail Kategori', '{{ $aspirasi->kategori->ket_kategori }}')">
                                                {{ $aspirasi->kategori->ket_kategori }}
                                            </span>
                                        </td>

                                        <td>{{ $aspirasi->lokasi }}</td>

                                        <!-- KOLOM KETERANGAN: BISA DIKLIK -->
                                        <td class="col-keterangan"
                                            onclick="showSimpleModal('Detail Keterangan', '{{ str_replace("'", "\\'", $aspirasi->ket) }}')">
                                            {{ Str::limit($aspirasi->ket, 25) }}
                                        </td>

                                        <!-- Status -->
                                        <td>
                                            <span class="status-badge
                                                @if($aspirasi->status == 'Menunggu') status-menunggu
                                                @elseif($aspirasi->status == 'Proses') status-proses
                                                @else status-selesai @endif">
                                                {{ $aspirasi->status }}
                                            </span>
                                        </td>

                                        <td>{{ $aspirasi->feedback ?? '-' }}</td>

                                        <!-- Tanggal -->
                                        <td class="col-tanggal">
                                            {{ $aspirasi->created_at->format('d M') }}<br>
                                            {{ $aspirasi->created_at->format('Y') }}
                                        </td>

                                        <!-- Modern Action Buttons -->
                                        <td class="action-cell">
                                            <button class="btn-action-modern" title="Edit Status"
                                                    onclick="openEditModal({{ $aspirasi->id_aspirasi }}, '{{ $aspirasi->status }}', '{{ addslashes($aspirasi->feedback ?? '') }}')">
                                                <i class="fas fa-pen"></i>
                                            </button>

                                            <form action="{{ route('admin.aspirasi.destroy', $aspirasi->id_aspirasi) }}" method="POST" style="display:inline;" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn-delete-modern" title="Hapus">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="d-flex justify-content-center mt-4">
                            {{ $aspirasis->links() }}
                        </div>
                    @else
                        <div class="empty-state">
                            <i class="fas fa-inbox"></i>
                            <h5>Tidak ada pengaduan yang ditemukan</h5>
                            <p>@if(request()->anyFilled(['tanggal', 'bulan', 'nis', 'kategori'])) Coba reset filter @else Belum ada data masuk @endif</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- 1. MODAL EDIT STATUS (Dengan Blur) -->
<div id="editModalBackdrop" class="modal-custom-blur" onclick="closeEditModal(event)">
    <div class="modal-content-custom">
        <div class="modal-header-custom">
            <h5 class="modal-title-custom"><i class="fas fa-edit me-2"></i>Update Status & Feedback</h5>
            <button class="close-btn" onclick="closeEditModalDirect()">&times;</button>
        </div>
        <div class="modal-body-custom">
            <form id="editForm" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group-modern">
                    <label for="modalStatus">Status Pengaduan</label>
                    <select name="status" id="modalStatus" class="form-control-modern">
                        <option value="Menunggu">Menunggu</option>
                        <option value="Proses">Sedang Diproses</option>
                        <option value="Selesai">Selesai</option>
                    </select>
                </div>

                <div class="form-group-modern">
                    <label for="modalFeedback">Berikan Feedback</label>
                    <textarea name="feedback" id="modalFeedback" class="form-control-modern" rows="4" placeholder="Tulis tanggapan atau solusi di sini..."></textarea>
                </div>

                <button type="submit" class="btn-submit-modern">
                    <i class="fas fa-save"></i> Simpan Perubahan
                </button>
            </form>
        </div>
    </div>
</div>

<!-- 2. MODAL DETAIL (Tanpa Blur) -->
<div id="detailModalSimple" class="modal-custom-simple" onclick="closeSimpleModal(event)">
    <div class="modal-content-custom">
        <div class="modal-header-custom">
            <h4 class="modal-title-custom" id="modalTitleSimple">Detail</h4>
            <button class="close-btn" onclick="closeSimpleModalDirect()">&times;</button>
        </div>
        <div class="modal-body-custom" id="modalBodySimple">
            <!-- Konten diisi JS -->
        </div>
    </div>
</div>

<script>
    // --- Fungsi untuk Modal Edit (Dengan Blur) ---
    function openEditModal(id, currentStatus, currentFeedback) {
        document.getElementById('editForm').action = '/admin/aspirasi/' + id;
        document.getElementById('modalStatus').value = currentStatus;
        document.getElementById('modalFeedback').value = currentFeedback;
        document.getElementById('editModalBackdrop').style.display = 'block';
        document.body.style.overflow = 'hidden';
    }

    function closeEditModal(event) {
        if (event.target.id === 'editModalBackdrop') closeEditModalDirect();
    }

    function closeEditModalDirect() {
        document.getElementById('editModalBackdrop').style.display = 'none';
        document.body.style.overflow = 'auto';
    }

    // --- Fungsi untuk Modal Detail (Tanpa Blur) ---
    function showSimpleModal(title, content) {
        document.getElementById('modalTitleSimple').innerText = title;
        document.getElementById('modalBodySimple').innerText = content;
        document.getElementById('detailModalSimple').style.display = 'block';
        // Tidak perlu lock scroll body jika tidak mau, tapi biasanya bagus untuk fokus
        // document.body.style.overflow = 'hidden';
    }

    function closeSimpleModal(event) {
        if (event.target.id === 'detailModalSimple') closeSimpleModalDirect();
    }

    function closeSimpleModalDirect() {
        document.getElementById('detailModalSimple').style.display = 'none';
        // document.body.style.overflow = 'auto';
    }

    // Close with ESC key
    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
            closeEditModalDirect();
            closeSimpleModalDirect();
        }
    });
</script>
@endsection
