@extends('layouts.app')

@section('title', 'Pengaduan Saya')

@section('content')
<style>
    :root {
        --primary: #2C3E50;
        --secondary: #3498DB;
        --accent: #95A5A6;
        --light: #ECF0F1;
        --dark: #2C3E50;
        --muted: #7F8C8D;
        --card-gradient: linear-gradient(135deg, #ffffff, #f8f9fa);
        --header-gradient: linear-gradient(135deg, #2C3E50, #34495E);
    }

    body { background-color: var(--light); font-family: 'Poppins', sans-serif; }

    .earth-card {
        background: var(--card-gradient);
        border: none;
        border-radius: 16px;
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
        background: var(--secondary);
        border: none;
        border-radius: 8px;
        padding: 8px 16px;
        font-weight: 600;
        transition: all 0.3s ease;
        color: white;
        font-size: 0.85rem;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        white-space: nowrap;
    }
    .btn-earth:hover { background: #1d74ae; transform: translateY(-2px); color: white; text-decoration: none; }

    .table-responsive {
        border-radius: 12px;
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
        border: 1px solid rgba(44, 62, 80, 0.05);
    }

    .table {
        width: 100%;
        table-layout: auto;
    }

    .table thead {
        background: #F8F9FA;
        border-bottom: 2px solid #E9ECEF;
    }

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
        text-align: center; /
        white-space: nowrap;
    }

    .col-kategori {
        min-width: 140px;
        padding-left: 10px !important;
        padding-right: 10px !important;
    }

    .kategori-badge {
        padding: 6px 14px;
        border-radius: 50px;
        font-weight: 600;
        font-size: 0.75rem;
        display: inline-flex;
        justify-content: center;
        align-items: center;
        background-color: #EBF5FB;
        color: var(--primary);
        border: 1px solid #D6EAF8;
        white-space: nowrap;
        line-height: 1.4;
        box-shadow: none;
    }

    .col-lokasi { min-width: 120px; padding-left: 10px !important; }
    .col-keterangan {
        max-width: 250px;
        overflow: hidden;
        text-overflow: ellipsis;
        padding-left: 10px !important;
    }
    .col-foto { min-width: 100px; text-align: center !important; }
    .col-status { min-width: 100px; text-align: center !important; }
    .col-tanggal { font-weight: 500; color: var(--muted); white-space: nowrap; min-width: 110px; text-align: center !important; }
    .col-aksi { min-width: 80px; text-align: center !important; padding-right: 20px !important; }

    .table-hover tbody tr:hover { background: #F4F6F7; }

    .status-badge {
        padding: 6px 14px;
        border-radius: 20px;
        font-weight: 600;
        font-size: 0.75rem;
        display: inline-flex;
        justify-content: center;
        align-items: center;
        border: 1px solid transparent;
        white-space: nowrap;
        line-height: 1.4;
    }

    .status-menunggu { background-color: #FFF3CD; color: #856404; }
    .status-proses { background-color: #B3E5FC; color: #0277BD; }
    .status-selesai { background-color: #C8E6C9; color: #2E7D32; }

    .foto-pengaduan {
        width: 50px;
        height: 50px;
        object-fit: cover;
        border-radius: 8px;
        display: block;
        margin: 0 auto;
        box-shadow: 0 2px 5px rgba(0,0,0,0.05);
        transition: transform 0.2s;
    }
    .foto-pengaduan:hover { transform: scale(1.1); }

    .action-group { display: flex; gap: 6px; justify-content: center; align-items: center; }
    .btn-action {
        width: 32px; height: 32px;
        border-radius: 8px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        transition: all 0.2s;
        cursor: pointer;
        border: none;
        font-size: 0.95rem;
        text-decoration: none;
        background: #f8f9fa;
        color: var(--dark);
        border: 1px solid #ddd;
    }
    .btn-action:hover { background: var(--dark); color: white; transform: translateY(-2px); }

    .empty-state { text-align: center; padding: 40px 20px; }
    .empty-icon { font-size: 3.5rem; color: var(--accent); margin-bottom: 15px; }

    .pagination .page-link {
        color: var(--secondary);
        border: 1px solid rgba(52, 152, 219, 0.2);
        border-radius: 6px;
        padding: 8px 12px;
        margin: 0 4px;
        text-decoration: none;
    }
    .pagination .page-item.active .page-link {
        background-color: var(--secondary);
        border-color: var(--secondary);
        color: white;
    }

    @media (max-width: 768px) {
        .earth-card-header {
            flex-direction: row;
            align-items: center;
            justify-content: space-between;
            text-align: left;
            padding: 15px 20px;
            gap: 15px;
        }

        .btn-earth {
            justify-content: center;
            width: auto;
            margin-top: 0;
            padding: 6px 12px;
            font-size: 0.75rem;
        }

        .table thead { display: none; }
        .table, .table tbody, .table tr, .table td { display: block; width: 100%; }

        .table tr {
            margin-bottom: 15px;
            background: white;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
            border: 1px solid #eee;
            padding: 15px;
        }

        .table td {
            padding: 10px 0;
            border: none;
            text-align: left !important;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px dashed #f0f0f0;
            white-space: normal;
            overflow: visible;
            gap: 10px;
        }
        .table td:last-child { border-bottom: none; }


        .td-foto-mobile {
            justify-content: space-between !important;
            margin: 12px 0 !important;
            border-bottom: 1px solid #eee !important;
            padding-bottom: 12px !important;
            flex-direction: row !important;
            align-items: center !important;
            gap: 10px;
        }

        .td-foto-mobile .mobile-label {
            display: block !important;
            margin-bottom: 0;
            width: auto;
            text-align: left;
            min-width: 60px;
        }

        .foto-pengaduan {
            width: 50px;
            height: 50px;
            object-fit: cover;
            border: 1px solid #E0E0E0;
            border-radius: 8px;
            display: block;
            margin: 0;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
        }

          .kategori-badge, .status-badge {
        padding: 4px 10px;
        font-size: 0.7rem;
        border-radius: 12px;
        display: inline-block; /* Agar mengikuti teks */
    }

    /* Text di mobile */
    .col-keterangan {
        max-width: 100%;
        font-size: 0.85rem;
        line-height: 1.4;
    }


        .td-aksi-mobile {
            justify-content: flex-end !important;
            margin-top: 10px;
            padding-top: 10px;
        }
        .action-group { gap: 15px; }
        .btn-action { width: 40px; height: 40px; font-size: 1.2rem; }

        .desktop-only { display: none; }
    }
</style>

<div class="row">
    <div class="col-md-12">
        <div class="earth-card">
            <div class="earth-card-header">
                <span><i class="fas fa-clipboard-list me-2"></i>Pengaduan Saya</span>
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
                                <!-- 1. KATEGORI -->
                                <td class="col-kategori">
                                    <span class="mobile-label d-md-none">Kategori</span>
                                    <span class="kategori-badge">{{ $aspirasi->kategori->ket_kategori ?? '-' }}</span>
                                </td>

                                <!-- 2. LOKASI -->
                                <td class="col-lokasi" title="{{ $aspirasi->lokasi }}">
                                    <span class="mobile-label d-md-none">Lokasi</span>
                                    {{ $aspirasi->lokasi }}
                                </td>

                                <!-- 3. KETERANGAN -->
                                <td class="col-keterangan" title="{{ $aspirasi->ket }}">
                                    <span class="mobile-label d-md-none">Keterangan</span>
                                    <span>{{ Str::limit($aspirasi->ket, 30) }}</span>
                                </td>

                                <!-- 4. FOTO -->
                                <td class="col-foto td-foto-mobile">
                                    <span class="mobile-label d-md-none">Foto</span>
                                    @if ($aspirasi->foto)
                                        <img src="{{ $aspirasi->foto_url }}" alt="Foto" class="foto-pengaduan">
                                    @else
                                        <span class="text-muted d-block mt-2" style="font-size: 1.2rem;">-</span>
                                    @endif
                                </td>

                                <!-- 5. STATUS -->
                                <td class="col-status">
                                    <span class="mobile-label d-md-none">Status</span>
                                    <span class="status-badge
                                        @if ($aspirasi->status == 'Menunggu') status-menunggu
                                        @elseif($aspirasi->status == 'Proses') status-proses
                                        @else status-selesai @endif">
                                        {{ $aspirasi->status }}
                                    </span>
                                </td>

                                <!-- 6. TANGGAL -->
                                <td class="col-tanggal">
                                    <span class="mobile-label d-md-none">Tanggal</span>
                                    <span class="desktop-only">{{ $aspirasi->created_at->format('d M Y') }}</span>
                                    <span class="d-md-none small">{{ $aspirasi->created_at->format('d/m/y') }}</span>
                                </td>

                                <!-- 7. AKSI -->
                                <td class="col-aksi td-aksi-mobile">
                                    <span class="mobile-label d-md-none w-100 mb-2">Aksi</span>
                                    <div class="action-group">
                                        <a href="{{ route('siswa.aspirasi.show', $aspirasi->id_aspirasi) }}" class="btn-action btn-view" title="Lihat Detail">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="text-center py-5">
                                    <div class="empty-state">
                                        <div class="empty-icon"><i class="fas fa-inbox"></i></div>
                                        <h5 class="text-dark mb-2" style="color: var(--primary); font-weight: 600;">Belum ada pengaduan</h5>
                                        <p class="text-muted mb-3">Anda belum pernah mengajukan pengaduan.</p>
                                        <a href="{{ route('siswa.aspirasi.create') }}" class="btn-earth">
                                            <i class="fas fa-plus me-2"></i>Ajukan Pengaduan Pertama
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
</div>
@endsection
