@extends('layouts.app')

@section('title', 'Riwayat Pengaduan')

@section('content')
<style>
    /* Palet warna Earth Tone */
    :root {
        --primary: #5D4037;      /* Coklat tua (kayu jati) */
        --secondary: #795548;     /* Coklat sedang */
        --accent: #8D6E63;        /* Coklat muda */
        --light: #F5F1EB;         /* Beige terang */
        --dark: #3E2723;          /* Dark brown */

        /* Gradient earth tone */
        --card-gradient: linear-gradient(135deg, #ffffff, #ffffff);
        --header-gradient: linear-gradient(135deg, #3E2723, #3E2723);
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

    .pengaduan-card {
        border: 1px solid rgba(93, 64, 55, 0.1);
        border-radius: 12px;
        margin-bottom: 15px;
        transition: all 0.3s ease;
        background: rgba(255, 255, 255, 0.8);
    }

    .pengaduan-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(93, 64, 55, 0.15);
    }

    .foto-pengaduan {
        max-width: 100%;
        max-height: 200px;
        border-radius: 8px;
        margin: 10px 0;
        border: 1px solid rgba(93, 64, 55, 0.1);
    }

    .status-badge {
        padding: 5px 15px;
        border-radius: 20px;
        font-weight: 600;
        font-size: 0.85rem;
        display: inline-block;
        border: 1px solid rgba(0,0,0,0.1);
    }

    .status-menunggu {
        background-color: #f5f1eb;
        color: #5d4037;
        border-color: #8d6e63;
    }

    .status-proses {
        background-color: #f5f1eb;
        color: #795548;
        border-color: #8d6e63;
    }

    .status-selesai {
        background-color: #f5f1eb;
        color: #5d4037;
        border-color: #8d6e63;
    }

    /* Warna kategori earth tone */
    .kategori-badge {
        padding: 5px 15px;
        border-radius: 20px;
        font-weight: 600;
        font-size: 0.85rem;
        display: inline-block;
        border: 1px solid rgba(0,0,0,0.1);
        background-color: #f5f1eb;
        color: #5d4037;
        border-color: #8d6e63;
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
    }

    .pagination .page-link:hover {
        background-color: rgba(93, 64, 55, 0.1);
    }
</style>

<div class="row">
    <div class="col-md-12">
        <div class="earth-card">
            <div class="earth-card-header">
                <span><i class="fas fa-history me-2"></i>Riwayat Pengaduan Saya</span>
            </div>
            <div class="card-body p-4">
                @forelse($aspirasis as $aspirasi)
                <div class="pengaduan-card p-3">
                    <div class="row">
                        <div class="col-md-8">
                            <h6 class="mb-2">
                                <strong>Kategori:</strong> <span class="kategori-badge">{{ $aspirasi->kategori->ket_kategori }}</span>
                                {{ $aspirasi->id_aspirasi }}
                            </h6>
                            <p class="mb-1"><strong>Lokasi:</strong> {{ $aspirasi->lokasi }}</p>
                            <p class="mb-1"><strong>Keterangan Pengaduan:</strong></p>
                            <p class="mb-2">{{ $aspirasi->ket }}</p>
                            @if($aspirasi->foto)
                                <img src="{{ $aspirasi->foto_url }}" alt="Foto Pengaduan" class="foto-pengaduan">
                            @endif
                        </div>
                        <div class="col-md-4 text-end">
                            <div class="mb-2">
                                <small class="text-muted" style="font-weight: bold; color: var(--primary);">Tanggal:</small><br>
                                <small>
                                    {{
                                        \Carbon\Carbon::parse($aspirasi->created_at)
                                            ->setTimezone('Asia/Jakarta')
                                            ->locale('id')
                                            ->isoFormat('dddd, D MMMM Y [pukul] HH.mm')
                                    }}
                                </small>
                            </div>
                            <div class="mb-2">
                                <small class="text-muted" style="font-weight: bold; color: var(--primary);">Status:</small><br>
                                <span class="status-badge
                                    @if($aspirasi->status == 'Menunggu') status-menunggu
                                    @elseif($aspirasi->status == 'Proses') status-proses
                                    @else status-selesai @endif">
                                    {{ $aspirasi->status }}
                                </span>
                            </div>
                            @if($aspirasi->feedback)
                            <div class="mb-2">
                                <small class="text-muted">Feedback:</small><br>
                                <small>{{ $aspirasi->feedback }}</small>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
                @empty
                <div class="empty-state">
                    <div class="empty-icon">
                        <i class="fas fa-inbox"></i>
                    </div>
                    <h5 class="text-muted mb-2">Belum ada riwayat pengaduan</h5>
                    <p class="text-muted mb-3">Anda belum pernah mengajukan pengaduan</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>
</div>

<!-- Pagination -->
@if($aspirasis->hasPages())
<div class="d-flex justify-content-center mt-4">
    {{ $aspirasis->links() }}
</div>
@endif
@endsection
