@extends('layouts.app')

@section('title', 'Progres Pengaduan')

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

    .timeline-item {
        position: relative;
        padding-left: 30px;
    }

    .timeline-item::before {
        content: '';
        position: absolute;
        left: 15px;
        top: 0;
        bottom: 0;
        width: 2px;
        background: var(--accent);
    }

    .timeline-icon {
        background: var(--primary) !important;
        color: white !important;
        width: 60px;
        height: 60px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50% !important;
        margin: 0 auto;
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

    .alert-info {
        background-color: #f5f1eb;
        border: 1px solid #8d6e63;
        color: #5d4037;
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
        max-width: 100%;
        max-height: 200px;
        border-radius: 8px;
        margin: 10px 0;
        border: 1px solid rgba(93, 64, 55, 0.1);
    }
</style>

<div class="row">
    <div class="col-md-12">
        <div class="earth-card">
            <div class="earth-card-header">
                <span><i class="fas fa-chart-line me-2"></i>Ringkasan Progres Pengaduan</span>
            </div>
            <div class="card-body p-4">
                @if($aspirasis->count() > 0)
                    <div class="timeline">
                        @foreach($aspirasis as $aspirasi)
                        <div class="timeline-item mb-4 pb-4" style="border-bottom: 1px solid rgba(93, 64, 55, 0.1);">
                            <div class="row">
                                <div class="col-md-2 text-center">
                                    <div class="timeline-icon">
                                        <i class="fas fa-clipboard-list fa-2x"></i>
                                    </div>
                                    <small class="d-block mt-2 text-muted">
                                        {{ \Carbon\Carbon::parse($aspirasi->created_at)->setTimezone('Asia/Jakarta')->locale('id')->isoFormat('D MMMM Y') }}
                                    </small>
                                </div>
                                <div class="col-md-10">
                                    <div class="earth-card">
                                        <div class="card-body p-3">
                                            <div class="d-flex justify-content-between align-items-start mb-3">
                                                <div>
                                                    <strong>Kategori:</strong> <span class="kategori-badge">{{ $aspirasi->kategori->ket_kategori }}</span>
                                                </div>
                                                <span class="status-badge
                                                    @if($aspirasi->status == 'Menunggu') status-menunggu
                                                    @elseif($aspirasi->status == 'Proses') status-proses
                                                    @else status-selesai @endif">
                                                    {{ $aspirasi->status }}
                                                </span>
                                            </div>
                                            <div class="mb-2">
                                                <strong>Lokasi:</strong> {{ $aspirasi->lokasi }}
                                            </div>
                                            <div class="mb-3">
                                                <strong>Keterangan Pengaduan:</strong> {{ $aspirasi->ket }}
                                            </div>
                                            @if($aspirasi->foto)
                                            <div class="mb-3">
                                                <strong>Foto:</strong>
                                                <img src="{{ $aspirasi->foto_url }}" alt="Foto Pengaduan" class="foto-pengaduan">
                                            </div>
                                            @endif
                                            @if($aspirasi->feedback)
                                            <div class="alert alert-info mb-0">
                                                <strong>Feedback:</strong> {{ $aspirasi->feedback }}
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                @else
                    <div class="empty-state">
                        <div class="empty-icon">
                            <i class="fas fa-inbox"></i>
                        </div>
                        <h5 class="text-muted mb-2">Belum ada pengaduan</h5>
                        <p class="text-muted mb-3">Anda belum pernah mengajukan pengaduan sarana sekolah</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
