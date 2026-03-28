@extends('layouts.app')

@section('title', 'Detail Pengaduan')

@section('content')
    <style>
        /* Palet warna Earth Tone */
        :root {
            --primary: #5D4037;
            /* Coklat tua (kayu jati) */
            --secondary: #795548;
            /* Coklat sedang */
            --accent: #8D6E63;
            /* Coklat muda */
            --light: #F5F1EB;
            /* Beige terang */
            --dark: #3E2723;
            /* Dark brown */

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
            border: 1px solid rgba(0, 0, 0, 0.1);
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
            border: 1px solid rgba(0, 0, 0, 0.1);
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

        /* Timeline Styles */
        .history-timeline {
            position: relative;
            padding: 10px 0 10px 30px;
        }

        .history-timeline::before {
            content: '';
            position: absolute;
            left: 10px;
            top: 0;
            bottom: 0;
            width: 3px;
            background: linear-gradient(to bottom, var(--primary), var(--accent));
            border-radius: 3px;
        }

        .history-item {
            position: relative;
            padding: 12px 15px;
            margin-bottom: 10px;
            background: var(--light);
            border-radius: 10px;
            border: 1px solid rgba(93, 64, 55, 0.08);
            transition: all 0.2s ease;
        }

        .history-item:hover {
            transform: translateX(4px);
            box-shadow: 0 2px 8px rgba(93, 64, 55, 0.1);
        }

        .history-item::before {
            content: '';
            position: absolute;
            left: -26px;
            top: 16px;
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background: var(--primary);
            border: 3px solid white;
            box-shadow: 0 0 0 2px var(--primary);
            z-index: 1;
        }

        .history-status-badge {
            padding: 3px 12px;
            border-radius: 20px;
            font-weight: 600;
            font-size: 0.8rem;
            display: inline-block;
            border: 1px solid rgba(0, 0, 0, 0.1);
        }

        .history-feedback-text {
            font-size: 0.85rem;
            color: #555;
            margin-top: 5px;
        }

        .history-date {
            font-size: 0.75rem;
            color: var(--accent);
            margin-top: 4px;
        }

        .no-history {
            text-align: center;
            padding: 20px;
            color: var(--accent);
            font-style: italic;
        }
    </style>

    <div class="row">
        <div class="col-md-12">
            <div class="earth-card-header">
                <span>Detail Aspirasi</span>
                <a href="{{ route('siswa.aspirasi.index') }}" class="btn btn-sm btn-light">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
            </div>

            <div class="pengaduan-card p-4">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <h6 class="text-muted mb-2">ID Aspirasi</h6>
                        <p class="fw-bold">{{ $aspirasi->id_aspirasi }}</p>
                    </div>
                    <div class="col-md-6">
                        <h6 class="text-muted mb-2">Kategori</h6>
                        <span class="kategori-badge">{{ $aspirasi->kategori->ket_kategori }}</span>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <h6 class="text-muted mb-2">NIS</h6>
                        <p class="fw-bold">{{ $aspirasi->nis }}</p>
                    </div>
                    <div class="col-md-6">
                        <h6 class="text-muted mb-2">Status</h6>
                        <span class="status-badge status-{{ strtolower($aspirasi->status) }}">{{ $aspirasi->status }}</span>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <h6 class="text-muted mb-2">Lokasi</h6>
                        <p>{{ $aspirasi->lokasi ?? '-' }}</p>
                    </div>
                    <div class="col-md-6">
                        <h6 class="text-muted mb-2">Tanggal Dibuat</h6>
                        <p>{{ $aspirasi->created_at->format('d M Y H:i') }}</p>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-12">
                        <h6 class="text-muted mb-2">Deskripsi</h6>
                        <p>{{ $aspirasi->ket }}</p>
                    </div>
                </div>

                @if ($aspirasi->foto)
                    <div class="row mb-3">
                        <div class="col-12">
                            <h6 class="text-muted mb-2">Foto</h6>
                            <img src="{{ asset('storage/pengaduan/' . $aspirasi->foto) }}" alt="Foto Aspirasi" class="foto-pengaduan">
                        </div>
                    </div>
                @endif

                <div class="row mb-3">
                    <div class="col-12">
                        <h6 class="text-muted mb-2">Feedback</h6>
                        <p>{{ $aspirasi->feedback ?? 'Belum ada feedback' }}</p>
                    </div>
                </div>

                {{-- Riwayat Perubahan Status --}}
                <div class="row">
                    <div class="col-12">
                        <h6 class="text-muted mb-3"><i class="fas fa-clock-rotate-left me-1"></i>Riwayat Perubahan Status</h6>
                        @if($aspirasi->histories && $aspirasi->histories->count() > 0)
                            <div class="history-timeline">
                                @foreach($aspirasi->histories as $history)
                                    <div class="history-item">
                                        <div>
                                            <span class="history-status-badge
                                                @if($history->status == 'Menunggu') status-menunggu
                                                @elseif($history->status == 'Proses') status-proses
                                                @else status-selesai @endif">
                                                {{ $history->status }}
                                            </span>
                                        </div>
                                        @if($history->feedback)
                                            <div class="history-feedback-text">
                                                <i class="fas fa-comment-dots me-1"></i>{{ $history->feedback }}
                                            </div>
                                        @endif
                                        <div class="history-date">
                                            <i class="fas fa-clock me-1"></i>{{ $history->created_at->format('d M Y H:i') }}
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="no-history">
                                <i class="fas fa-inbox" style="font-size:1.5rem;display:block;margin-bottom:8px;"></i>
                                Belum ada riwayat perubahan status
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
