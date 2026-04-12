@extends('layouts.app')

@section('title', 'Daftar Pengaduan')

@section('content')
<style>
    :root {
        --primary: #2C3E50;
        --secondary: #3498DB;
        --dark: #95A5A6;
        --light: #ECF0F1;
        --dark: #2C3E50;
        --muted: #7F8C8D;

        --card-gradient: linear-gradient(135deg, #ffffff, #f8f9fa);
        --header-gradient: linear-gradient(135deg, #2C3E50, #34495E);

        --card-shadow: 0 4px 20px rgba(44, 62, 80, 0.08);
        --btn-shadow: 0 4px 12px rgba(52, 152, 219, 0.3);
    }

    body { background-color: var(--light); }

    .earth-card {
        background: var(--card-gradient);
        border: none;
        border-radius: 16px;
        box-shadow: var(--card-shadow);
        overflow: hidden;
        border: 1px solid rgba(44, 62, 80, 0.05);
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
        background-color: var(--secondary);
        color: white;
        border: none;
        border-radius: 50px;
        padding: 10px 20px;
        font-weight: 800;
        font-size: 0.75rem;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        box-shadow: 0 4px 15px rgba(52, 152, 219, 0.4);
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        z-index: 10;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .btn-riwayat:hover {
        background-color: #2980B9;
        color: white;
        transform: translateY(-3px) scale(1.05);
        box-shadow: 0 8px 25px rgba(52, 152, 219, 0.5);
    }

    .btn-riwayat i {
        margin-right: 8px;
        font-size: 1.1rem;
    }

    .filter-panel {
        background: #F4F6F7;
        border-radius: 12px;
        padding: 20px;
        margin-bottom: 24px;
        border: 1px solid rgba(44, 62, 80, 0.05);
    }
    .form-label { font-weight: 600; color: var(--dark); margin-bottom: 8px; font-size: 0.9rem; }
    .form-control, .form-select {
        border-radius: 8px;
        border: 1px solid rgba(44, 62, 80, 0.2);
        padding: 8px 12px;
        background-color: var(--white);
        color: var(--dark);
    }
    .form-control:focus, .form-select:focus {
        border-color: var(--secondary);
        box-shadow: 0 0 0 0.2rem rgba(52, 152, 219, 0.25);
    }
    .btn-primary {
        background: linear-gradient(135deg, var(--secondary), #3498DB);
        border: none;
        border-radius: 8px;
        padding: 8px 16px;
        font-weight: 600;
        color: white;
        transition: all 0.3s ease;
    }
    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(52, 152, 219, 0.4);
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
        padding: 14px 12px;
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        white-space: nowrap;
        border: none;
        color: var(--dark);
    }

    .table td {
        padding: 14px 12px;
        border-top: 1px solid #F0F0F0;
        font-size: 0.9rem;
        vertical-align: middle;
        white-space: nowrap;
        color: var(--dark);
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
        transition: all 0.2s;
        background: #EBF5FB;
        color: var(--primary);
        border: 1px solid #D6EAF8;
    }

    .badge-kategori {
        cursor: default;
    }

    .status-badge {
        padding: 5px 15px;
        border-radius: 20px;
        font-weight: 600;
        font-size: 0.85rem;
        display: inline-block;
        border: 1px solid transparent;
        white-space: nowrap;
        box-shadow: 0 2px 4px rgba(0,0,0,0.05);
    }
    .status-menunggu { background-color: #FFF3CD; color: #856404; border-color: #FFE69C; }
    .status-proses { background-color: #B3E5FC; color: #0277BD; border-color: #81D4FA; }
    .status-selesai { background-color: #C8E6C9; color: #2E7D32; border-color: #A5D6A7; }

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
        background-color: #EBF5FB;
        color: var(--secondary);
        border: 1px solid transparent;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        cursor: pointer;
        padding: 0;
        margin: 0 2px;
        font-size: 0.8rem;
    }

    .btn-action-modern:hover {
        background-color: var(--secondary);
        color: white;
        transform: rotate(90deg) scale(1.1);
        box-shadow: 0 4px 10px rgba(52, 152, 219, 0.3);
    }

    .btn-history-modern {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background-color: #E8F5E9;
        color: #2e7d32;
        border: 1px solid transparent;
        transition: all 0.3s ease;
        cursor: pointer;
        padding: 0;
        margin: 0 2px;
        font-size: 0.8rem;
    }

    .btn-history-modern:hover {
        background-color: #2e7d32;
        color: white;
        transform: scale(1.1);
        box-shadow: 0 4px 10px rgba(46, 125, 50, 0.3);
    }

    .btn-delete-modern {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background-color: #FFEBEE;
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

    .history-timeline {
        position: relative;
        padding: 10px 0;
    }

    .history-timeline::before {
        content: '';
        position: absolute;
        left: 18px;
        top: 0;
        bottom: 0;
        width: 3px;
        background: linear-gradient(to bottom, var(--secondary), var(--dark));
        border-radius: 3px;
    }

    .history-item {
        position: relative;
        padding: 12px 15px 12px 50px;
        margin-bottom: 8px;
        background: #F4F6F7;
        border-radius: 10px;
        border: 1px solid rgba(44, 62, 80, 0.08);
        transition: all 0.2s ease;
    }

    .history-item:hover {
        transform: translateX(4px);
        box-shadow: 0 2px 8px rgba(44, 62, 80, 0.1);
    }

    .history-item::before {
        content: '';
        position: absolute;
        left: 12px;
        top: 18px;
        width: 14px;
        height: 14px;
        border-radius: 50%;
        background: var(--secondary);
        border: 3px solid white;
        box-shadow: 0 0 0 2px var(--secondary);
        z-index: 1;
    }

    .history-status {
        font-weight: 700;
        font-size: 0.9rem;
        margin-bottom: 4px;
    }

    .history-feedback {
        font-size: 0.85rem;
        color: #555;
        margin-bottom: 4px;
    }

    .history-meta {
        font-size: 0.75rem;
        color: var(--dark);
    }

    .no-history {
        text-align: center;
        padding: 20px;
        color: var(--dark);
        font-style: italic;
    }

    .foto-pengaduan {
        width: 60px;
        height: 60px;
        object-fit: cover;
        border-radius: 8px;
        margin: 0 auto;
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
        color: var(--dark);
        margin: 0 auto;
    }

    .pagination .page-link {
        color: var(--secondary);
        border: 1px solid rgba(52, 152, 219, 0.2);
        border-radius: 6px;
        padding: 8px 12px;
        margin: 0 4px;
    }
    .pagination .page-item.active .page-link {
        background-color: var(--secondary);
        border-color: var(--secondary);
        color: white;
    }
    .pagination .page-link:hover {
        background-color: rgba(52, 152, 219, 0.1);
    }

    .empty-state {
        text-align: center;
        padding: 40px 20px;
        color: var(--dark);
    }
    .empty-state i { font-size: 3rem; margin-bottom: 15px; opacity: 0.6; }
    .empty-state h5 { color: var(--primary); font-weight: 600; }

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

    .modal-custom-blur {
        display: none;
        position: fixed;
        z-index: 9999;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(44, 62, 80, 0.6);
        backdrop-filter: blur(5px);
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
        resize: none;
    }
    .form-control-modern:focus {
        outline: none;
        border-color: var(--secondary);
        background: white;
        box-shadow: 0 0 0 4px rgba(52, 152, 219, 0.1);
    }
    .btn-submit-modern {
        width: 100%;
        padding: 12px;
        background: var(--secondary);
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
        background: #2980B9;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(52, 152, 219, 0.3);
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

<div class="container-fluid py-4 px-0">

    @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show shadow-sm border-0 rounded-3 mb-4" role="alert" style="font-family: 'Poppins', sans-serif; border-left: 5px solid #27AE60;">
                    <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

    <div class="row">
        <div class="col-md-12">
            <div class="earth-card">
                <div class="earth-card-header">
                    <span>Daftar Pengaduan Sekolah</span>
                </div>

                <div class="card-body-custom">
                    <!-- Filter Panel -->
                    <div class="filter-panel">
                        <form method="GET" action="{{ route('admin.aspirasi.filter') }}" class="row g-3">
                            <div class="col-md-3">
                                <label class="form-label">Tanggal</label>
                                <input type="date" name="tanggal" class="form-control form-control-sm" value="{{ request('tanggal') }}">                            </div>
                            <div class="col-md-3">
                                <label class="form-label">NIS Siswa</label>
                                <input type="text" name="nis" class="form-control form-control-sm" placeholder="Cari NIS" value="{{ request('nis') }}">
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
                                   <i class="fas fa-search me-2"></i>Filter Data
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
                                        <th width="8%">NIS</th>
                                        <th width="13%">Nama Siswa</th>
                                        <th width="8%">Kelas</th>
                                        <th width="13%">Kategori</th>
                                        <th width="13%">Lokasi</th>
                                        <th width="17%">Keterangan</th>
                                        <th width="6%" class="text-center">Foto</th>
                                        <th width="8%">Status</th>
                                        <th width="8%">Tanggal</th>
                                        <th width="6%" class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($aspirasis as $aspirasi)
                                    <tr>
                                        <td><strong>{{ $aspirasi->nis }}</strong></td>

                                        <td>{{ $aspirasi->siswa->name ?? '-' }}</td>

                                        <td style="font-weight: 500; color: var(--dark);">
                                            {{ $aspirasi->siswa->kelas ?? '-' }}
                                        </td>

                                        <td>
                                            <span class="badge-pill badge-kategori">
                                                {{ $aspirasi->kategori->ket_kategori }}
                                            </span>
                                        </td>

                                        <td>{{ $aspirasi->lokasi }}</td>

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

                                        <td class="action-cell">
                                            <button class="btn-action-modern" title="Edit Status"
                                                    onclick="openEditModal({{ $aspirasi->id_aspirasi }}, '{{ $aspirasi->status }}', '{{ addslashes($aspirasi->feedback ?? '') }}')">
                                                <i class="fas fa-pen"></i>
                                            </button>

                                            <button class="btn-history-modern" title="Riwayat Status"
                                                    onclick="openHistoryModal({{ $aspirasi->id_aspirasi }})">
                                                <i class="fas fa-clock-rotate-left"></i>
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
                        <option value="Proses">Diproses</option>
                        <option value="Selesai">Selesai</option>
                    </select>
                </div>

                <div class="form-group-modern">
                    <label for="modalFeedback">Berikan Feedback</label>
                    <textarea name="feedback" id="modalFeedback" class="form-control-modern" rows="4" placeholder="Tulis tanggapan di sini"></textarea>
                </div>

                <button type="submit" class="btn-submit-modern">
                    <i class="fas fa-save"></i> Simpan Perubahan
                </button>
            </form>
        </div>
    </div>
</div>

<div id="historyModalBackdrop" class="modal-custom-blur" onclick="closeHistoryModal(event)">
    <div class="modal-content-custom">
        <div class="modal-header-custom">
            <h5 class="modal-title-custom"><i class="fas fa-file-alt me-2"></i>Detail Pengaduan</h5>
            <button class="close-btn" onclick="closeHistoryModalDirect()">&times;</button>
        </div>
        <div class="modal-body-custom" id="historyModalBody">
        </div>
    </div>
</div>

<script type="application/json" id="historiesData">
@php
    $dataMap = [];
    foreach($aspirasis as $aspirasi) {
        $dataMap[$aspirasi->id_aspirasi] = [
            'nis' => $aspirasi->nis,
            'nama' => $aspirasi->siswa->name ?? '-',
            'kelas' => $aspirasi->siswa->kelas ?? '-',
            'kategori' => $aspirasi->kategori->ket_kategori,
            'lokasi' => $aspirasi->lokasi,
            'ket' => $aspirasi->ket,
            'status' => $aspirasi->status,
            'feedback' => $aspirasi->feedback,
            'foto_url' => $aspirasi->foto ? asset('storage/pengaduan/' . $aspirasi->foto) : null,
            'tanggal' => \Carbon\Carbon::parse($aspirasi->created_at)
                ->setTimezone('Asia/Jakarta')
                ->format('d M Y H:i'),
            'histories' => $aspirasi->histories->map(function($h) {
                return [
                    'status' => $h->status,
                    'feedback' => $h->feedback,
                    'changed_by' => $h->changed_by,
                      'created_at' => \Carbon\Carbon::parse($h->created_at)
                        ->setTimezone('Asia/Jakarta')
                        ->format('d M Y H:i'),
                ];
            })->toArray(),
        ];
    }
    echo json_encode($dataMap);
@endphp
</script>

<script>
    const historiesData = JSON.parse(document.getElementById('historiesData').textContent);

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

    function openHistoryModal(id) {
        const data = historiesData[id];
        if (!data) return;

        const histories = data.histories || [];
        const body = document.getElementById('historyModalBody');
        let html = '';

        // Detail Pengaduan
        html += '<div style="margin-bottom:18px;">';
        if (data.foto_url) {
            html += '<div style="text-align:center;margin-bottom:12px;"><img src="' + data.foto_url + '" style="max-width:100%;max-height:180px;border-radius:10px;border:1px solid rgba(44,62,80,0.1);" alt="Foto"></div>';
        }
        html += '<table style="width:100%;font-size:0.9rem;">';
        html += '<tr><td style="padding:4px 8px;font-weight:600;color:var(--dark);width:100px;">NIS</td><td style="padding:4px 8px;">' + data.nis + '</td></tr>';
        html += '<tr><td style="padding:4px 8px;font-weight:600;color:var(--dark);">Nama</td><td style="padding:4px 8px;">' + data.nama + '</td></tr>';
        html += '<tr><td style="padding:4px 8px;font-weight:600;color:var(--dark);">Kelas</td><td style="padding:4px 8px;">' + data.kelas + '</td></tr>';
        html += '<tr><td style="padding:4px 8px;font-weight:600;color:var(--dark);">Kategori</td><td style="padding:4px 8px;">' + data.kategori + '</td></tr>';
        html += '<tr><td style="padding:4px 8px;font-weight:600;color:var(--dark);">Lokasi</td><td style="padding:4px 8px;">' + data.lokasi + '</td></tr>';
        html += '<tr><td style="padding:4px 8px;font-weight:600;color:var(--dark);">Tanggal</td><td style="padding:4px 8px;">' + data.tanggal + '</td></tr>';
        html += '</table>';
        html += '<div style="margin-top:10px;padding:10px 12px;background:var(--light);border-radius:8px;font-size:0.9rem;line-height:1.5;">';
        html += '<strong style="color:var(--dark);">Keterangan:</strong><br>' + data.ket;
        html += '</div>';
        if (data.feedback) {
            html += '<div style="margin-top:8px;padding:10px 12px;background:#e8f5e9;border-radius:8px;font-size:0.9rem;line-height:1.5;">';
            html += '<strong style="color:#2e7d32;"><i class="fas fa-comment-dots me-1"></i>Feedback:</strong><br>' + data.feedback;
            html += '</div>';
        }
        html += '</div>';

        html += '<hr style="border-color:rgba(44,62,80,0.1);margin:15px 0;">';
        html += '<h6 style="font-weight:700;color:var(--dark);margin-bottom:12px;"><i class="fas fa-clock-rotate-left me-1"></i>Riwayat Perubahan</h6>';

        if (histories.length === 0) {
            html += '<div class="no-history"><i class="fas fa-inbox" style="font-size:1.5rem;display:block;margin-bottom:8px;"></i>Belum ada riwayat perubahan status</div>';
        } else {
            html += '<div class="history-timeline">';
            histories.forEach(function(h) {
                let statusClass = 'status-menunggu';
                if (h.status === 'Proses') statusClass = 'status-proses';
                else if (h.status === 'Selesai') statusClass = 'status-selesai';

                html += '<div class="history-item">';
                html += '<div class="history-status"><span class="status-badge ' + statusClass + '" style="padding:3px 10px;font-size:0.8rem;">' + h.status + '</span></div>';
                if (h.feedback) {
                    html += '<div class="history-feedback"><i class="fas fa-comment-dots me-1"></i>' + h.feedback + '</div>';
                }
                html += '<div class="history-meta"><i class="fas fa-user me-1"></i>' + h.changed_by + ' &bull; <i class="fas fa-clock me-1"></i>' + h.created_at + '</div>';
                html += '</div>';
            });
            html += '</div>';
        }

        body.innerHTML = html;
        document.getElementById('historyModalBackdrop').style.display = 'block';
        document.body.style.overflow = 'hidden';
    }

    function closeHistoryModal(event) {
        if (event.target.id === 'historyModalBackdrop') closeHistoryModalDirect();
    }

    function closeHistoryModalDirect() {
        document.getElementById('historyModalBackdrop').style.display = 'none';
        document.body.style.overflow = 'auto';
    }

    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
            closeEditModalDirect();
            closeHistoryModalDirect();
        }
    });
</script>
@endsection
