@extends('layouts.app')

@section('title', 'Riwayat Pengaduan')

@section('content')
<style>
    /* Palet warna Earth Tone - Sama persis dengan Laporan */
    :root {
        --primary: #5D4037;
        --secondary: #795548;
        --accent: #8D6E63;
        --light: #F5F1EB;
        --dark: #3E2723;
        --card-gradient: linear-gradient(135deg, #ffffff, #f8f4f0);
        --header-gradient: linear-gradient(135deg, #5D4037, #795548);
    }

    /* Card Styling - Menggunakan earth-card */
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
        font-size: 1.2rem;
    }

    .card-body-custom {
        padding: 24px;
    }

    /* Table Responsive */
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
    }

    .table td {
        padding: 12px 10px;
        border-top: 1px solid rgba(93, 64, 55, 0.08);
        font-size: 0.9rem;
        vertical-align: middle;
        white-space: nowrap;
        color: var(--dark);
    }

    /* Kolom Keterangan */
    .table td.col-keterangan {
        white-space: normal;
        max-width: 150px;
        line-height: 1.4;
        cursor: pointer;
        color: var(--primary);
        text-decoration: underline dotted;
    }

    .table td.col-keterangan:hover {
        color: var(--secondary);
        text-decoration: underline;
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
    .kategori-badge {
        padding: 6px 12px;
        border-radius: 50px;
        font-weight: 600;
        font-size: 0.8rem;
        display: inline-block;
        border: 1px solid #8d6e63;
        background-color: #f5f1eb;
        color: #5d4037;
        white-space: nowrap;
        cursor: pointer;
        transition: all 0.2s;
    }

    .kategori-badge:hover {
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
    .empty-state i {
        font-size: 3rem;
        margin-bottom: 15px;
        opacity: 0.6;
    }
    .empty-state h5 {
        color: var(--primary);
        font-weight: 600;
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

    @keyframes fadeIn { from {opacity: 0;} to {opacity: 1;} }
    @keyframes slideDown { from {transform: translateY(-50px); opacity: 0;} to {transform: translateY(0); opacity: 1;} }

    @media (max-width: 768px) {
        .modal-content-custom { margin: 10% auto; width: 95%; padding: 20px; }
        .modal-title-custom { font-size: 1.1rem; }
    }
</style>

<div class="container-fluid py-4">
    <div class="row">
        <div class="col-md-12">
            <!-- Menggunakan earth-card sesuai referensi -->
            <div class="earth-card">
                <div class="earth-card-header">
                    <span><i class="fas fa-history me-2"></i>Riwayat Pengaduan Sarana Sekolah</span>
                </div>
                <div class="card-body-custom">
                    @if($aspirasis->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead>
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
                                    @foreach($aspirasis as $aspirasi)
                                    <tr>
                                        <td class="text-center">
                                            @if($aspirasi->foto)
                                                <img src="{{ $aspirasi->foto_url }}" alt="Foto" class="foto-pengaduan">
                                            @else
                                                <div class="foto-placeholder">
                                                    <i class="fas fa-image"></i>
                                                </div>
                                            @endif
                                        </td>
                                        <td><strong>{{ $aspirasi->nis }}</strong></td>
                                        <td>{{ $aspirasi->siswa->name ?? '-' }}</td>
                                        <td>{{ $aspirasi->siswa->kelas ?? '-' }}</td>

                                        <!-- Kategori Badge -->
                                        <td>
                                            <span class="kategori-badge"
                                                  onclick="showModal('Detail Kategori', '{{ $aspirasi->kategori->ket_kategori }}')">
                                                {{ $aspirasi->kategori->ket_kategori }}
                                            </span>
                                        </td>

                                        <td>{{ $aspirasi->lokasi }}</td>

                                        <!-- Keterangan -->
                                        <td class="col-keterangan"
                                            onclick="showModal('Detail Keterangan', '{{ str_replace("'", "\\'", $aspirasi->ket) }}')">
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
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        <div class="d-flex justify-content-center mt-4">
                            {{ $aspirasis->links() }}
                        </div>
                    @else
                        <div class="empty-state">
                            <i class="fas fa-inbox"></i>
                            <h5>Tidak ada riwayat pengaduan</h5>
                            <p>Anda belum pernah mengajukan pengaduan sarana sekolah.</p>
                        </div>
                    @endif
                </div>
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
