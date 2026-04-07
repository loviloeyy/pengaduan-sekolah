@extends('layouts.app')

@section('title', 'Detail Pengaduan')

@section('content')
<style>
    :root {
        --primary: #2C3E50;
        --secondary: #3498DB;
        --accent: #95A5A6;
        --light: #ECF0F1;
        --dark: #2C3E50;
        --muted: #7F8C8D;
        --border-color: #E9ECEF;
    }

    .detail-card {
        background: #ffffff;
        border: none;
        border-radius: 16px;
        box-shadow: 0 4px 20px rgba(44, 62, 80, 0.08);
        overflow: hidden;
        border: 1px solid rgba(44, 62, 80, 0.05);
        margin-bottom: 20px;
    }

    .card-header-unified {
        background: linear-gradient(135deg, var(--primary), #34495E);
        color: white;
        padding: 20px 25px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .card-header-unified h4 {
        margin: 0;
        font-size: 1.2rem;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .btn-back {
        background: white;
        color: var(--primary);
        border: 1px solid var(--primary);
        padding: 8px 16px;
        border-radius: 8px;
        text-decoration: none;
        font-size: 0.9rem;
        font-weight: 600;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        box-shadow: 0 2px 5px rgba(0,0,0,0.05);
    }

    .btn-back:hover {
        background: var(--primary);
        color: white;
        transform: translateX(-3px);
    }

    .card-body-custom {
        padding: 30px;
    }

    .info-box {
        background: #F8F9FA;
        border-radius: 10px;
        padding: 15px;
        height: 100%;
        border: 1px solid var(--border-color);
        transition: all 0.2s;
    }

    .info-box:hover {
        background: #fff;
        border-color: var(--secondary);
        box-shadow: 0 4px 10px rgba(0,0,0,0.05);
    }

    .info-label {
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: var(--dark);
        font-weight: 600;
        margin-bottom: 5px;
    }

    .info-value {
        font-size: 0.95rem;
        color: var(--dark);
        font-weight: 600;
        margin: 0;
        line-height: 1.4;
    }

    .status-badge {
        padding: 6px 14px;
        border-radius: 50px;
        font-weight: 600;
        font-size: 0.8rem;
        display: inline-block;
        box-shadow: 0 2px 4px rgba(0,0,0,0.05);
    }
    .status-menunggu { background-color: #FFF3CD; color: #856404; }
    .status-proses { background-color: #B3E5FC; color: #0277BD; }
    .status-selesai { background-color: #C8E6C9; color: #2E7D32; }

    .kategori-badge {
        background-color: #EBF5FB;
        color: var(--primary);
        padding: 6px 14px;
        border-radius: 50px;
        font-weight: 600;
        font-size: 0.8rem;
        border: 1px solid #D6EAF8;
    }

    .section-title {
        font-size: 0.9rem;
        font-weight: 700;
        color: var(--primary);
        margin-bottom: 12px;
        display: flex;
        align-items: center;
        gap: 8px;
        border-bottom: 2px solid #F0F0F0;
        padding-bottom: 10px;
    }

    .content-text {
        color: var(--dark);
        line-height: 1.6;
        font-size: 0.95rem;
        white-space: pre-wrap;
    }

    .foto-container {
        text-align: left;
        background: transparent;
        padding: 0;
        border-radius: 12px;
        border: none;
        display: flex;
        justify-content: flex-start;
        align-items: flex-start;
    }

    .foto-pengaduan {
        max-width: 100%;
        width: auto;
        max-height: 300px;
        border-radius: 8px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        display: block;
    }

    .feedback-box {
        background: #EBF5FB;
        border-left: 4px solid var(--secondary);
        padding: 20px;
        border-radius: 8px;
        color: var(--dark);
        font-style: italic;
        position: relative;
    }

    .feedback-box::before {
        content: '\f075';
        font-family: "Font Awesome 6 Free";
        font-weight: 900;
        position: absolute;
        top: 10px;
        right: 15px;
        font-size: 2rem;
        color: rgba(52, 152, 219, 0.1);
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

    .history-item.selesai::before {
        background: var(--secondary);
        box-shadow: 0 0 0 2px var(--secondary);
        border-color: white;
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
        border-top: 1px solid #eee;
        padding-top: 8px;
        margin-top: 8px;
    }

    .history-meta {
        font-size: 0.75rem;
        color: var(--dark);
        margin-top: 5px;
        display: block;
    }

    .no-history {
        text-align: center;
        padding: 20px;
        color: var(--dark);
        font-style: italic;
    }

    .bottom-action-area {
        margin-top: 40px;
        padding-top: 20px;
        border-top: 1px solid var(--border-color);
        text-align: right;
    }
</style>

<div class="row">
    <div class="col-lg-10 offset-lg-1">
        <div class="detail-card">
            <div class="card-header-unified">
                <h4><i class="fas fa-file-alt"></i> Detail Pengaduan</h4>
            </div>

            <div class="card-body-custom">

                <div class="row g-3 mb-4">
                    <div class="col-md-3 col-sm-6">
                    <div class="info-box">
                        <div class="info-label">ID Pengaduan</div>
                        <div class="info-value">{{ $aspirasi->id_aspirasi }}</div>
                    </div>
                </div>
                    <div class="col-md-3 col-sm-6">
                        <div class="info-box">
                            <div class="info-label">Kategori</div>
                            <span class="kategori-badge">{{ $aspirasi->kategori->ket_kategori }}</span>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <div class="info-box">
                            <div class="info-label">Tanggal</div>
                            <div class="info-value" style="font-size: 0.85rem;">
                                {{ \Carbon\Carbon::parse($aspirasi->created_at)->setTimezone('Asia/Jakarta')->format('d M Y') }}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <div class="info-box">
                            <div class="info-label">Status Saat Ini</div>
                            <span class="status-badge status-{{ strtolower($aspirasi->status) }}">
                                {{ $aspirasi->status }}
                            </span>
                        </div>
                    </div>
                </div>

                <div class="row g-4 mb-5">
                    <div class="col-md-6">
                        <div class="info-label mb-2">Pelapor</div>
                        <div class="p-3 bg-white border rounded-3">
                            <div class="d-flex align-items-center gap-3">
                                <div style="width: 40px; height: 40px; background: #EBF5FB; color: var(--secondary); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: bold;">
                                    {{ substr($aspirasi->siswa->name ?? 'S', 0, 1) }}
                                </div>
                                <div>

                                    <div class="fw-bold" style="color: var(--dark);">{{ $aspirasi->siswa->name ?? '-' }}</div>
                                    <div class="text-muted" style="font-size: 0.8rem;">{{ $aspirasi->nis }} • {{ $aspirasi->siswa->kelas ?? '-' }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="info-label mb-2">Lokasi</div>
                        <div class="p-3 bg-white border rounded-3 d-flex align-items-center h-100">
                            <i class="fas fa-map-marker-alt text-danger me-3 fa-lg"></i>
                            <span class="fw-medium" style="color: var(--dark);">{{ $aspirasi->lokasi ?? '-' }}</span>
                        </div>
                    </div>
                </div>

                <!-- Deskripsi -->
                <div class="mb-4 mt-4">
                    <h6 class="fw-bold mb-2" style="color: var(--primary);">
                        Keterangan
                    </h6>
                    <div class="col-md-8">
                        <div style="background-color: #f8f9fa; border-radius: 0.5rem; padding: 1rem; border: 1px solid #e9ecef; text-align: left !important; margin: 0;">
                            {{ $aspirasi->ket }}
                        </div>
                    </div>
                </div>


                  @if ($aspirasi->foto)
                <div class="mb-4">
                    <h6 class="fw-bold mb-2" style="color: var(--primary); display: flex; align-items: center; gap: 8px;">
                    Foto
                    </h6>
                    <div class="foto-container">
                        <img src="{{ asset('storage/pengaduan/' . $aspirasi->foto) }}" alt="Foto Bukti" class="foto-pengaduan">
                    </div>
                </div>
                @endif

                <!-- Timeline Riwayat -->
                <div>
                    <div class="section-title"><i class="fas fa-history"></i> Riwayat Perubahan</div>

                    <div class="history-timeline">
                        @php
                            $hasHistories = $aspirasi->histories && $aspirasi->histories->count() > 0;
                        @endphp

                        @if(!$hasHistories)
                            <div class="no-history">
                                <i class="fas fa-inbox" style="font-size:1.5rem;display:block;margin-bottom:8px;"></i>
                                Belum ada riwayat perubahan status
                            </div>
                        @else
                            @foreach($aspirasi->histories as $history)
                                @php
                                    $itemClass = ($history->status == 'Selesai') ? 'history-item selesai' : 'history-item';
                                @endphp

                                <div class="{{ $itemClass }}">
                                    <div class="history-status">
                                        <span class="status-badge status-{{ strtolower($history->status) }}">
                                            {{ $history->status }}
                                        </span>
                                    </div>

                                    @if($history->feedback)
                                        <div class="history-feedback">
                                            <i class="fas fa-comment-dots me-1"></i>admin: {{ $history->feedback }}
                                        </div>
                                    @endif

                                    <div class="history-meta">
                                        <i class="fas fa-clock me-1"></i>{{ \Carbon\Carbon::parse($history->created_at)->setTimezone('Asia/Jakarta')->format('d M Y H:i') }}
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>

                    <div class="bottom-action-area">
                        <a href="{{ route('siswa.aspirasi.index') }}" class="btn-back">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>

                </div>

            </div>
        </div>
    </div>
</div>
@endsection
