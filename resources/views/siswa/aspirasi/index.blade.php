@extends('layouts.app')

@section('title', 'Pengaduan Saya')

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
            --btn-shadow: 0 4px 12px rgba(93, 64, 55, 0.25);
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

        .btn-earth {
            background: var(--primary);
            border: none;
            border-radius: 8px;
            padding: 8px 16px;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: var(--btn-shadow);
            color: white;
            font-size: 0.9rem;
            font-family: 'Poppins', sans-serif;
        }

        .btn-earth:hover {
            background: #4E342E;
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(93, 64, 55, 0.3);
        }

        .table-responsive {
            border-radius: 12px;
            overflow: hidden;
            border: 1px solid rgba(93, 64, 55, 0.05);
        }

        .table thead {
            background: var(--primary);
            color: white;
        }

        .table th {
            font-weight: 600;
            padding: 12px 15px;
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-family: 'Poppins', sans-serif;
            vertical-align: middle;
            text-align: center;
        }

        .table td {
            padding: 15px 15px;
            border-top: 1px solid rgba(93, 64, 55, 0.08);
            font-size: 0.9rem;
            font-family: 'Poppins', sans-serif;
            vertical-align: middle;
            text-align: center;
        }

        .table td.text-start {
            text-align: start;
        }

        .table-hover tbody tr:hover {
            background: rgba(93, 64, 55, 0.02);
        }

        .status-badge {
            padding: 6px 18px;
            border-radius: 20px;
            font-weight: 600;
            font-size: 0.85rem;
            display: inline-block;
            border: 1px solid rgba(0, 0, 0, 0.1);
            min-width: 80px;
            justify-content: center;
            display: flex;
            align-items: center;
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

        /* Warna kategori mengikuti warna status */
        .kategori-menunggu {
            background-color: #f5f1eb;
            color: #5d4037;
            border: 1px solid #8d6e63;
        }

        .kategori-proses {
            background-color: #f5f1eb;
            color: #795548;
            border: 1px solid #8d6e63;
        }

        .kategori-selesai {
            background-color: #f5f1eb;
            color: #5d4037;
            border: 1px solid #8d6e63;
        }

        .foto-pengaduan {
            max-width: 100px;
            max-height: 80px;
            object-fit: cover;
            border: 1px solid rgba(93, 64, 55, 0.1);
            border-radius: 8px;
            display: block;
            margin: 0 auto;
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

        /* Tombol hapus */
        .btn-delete {
            background: none;
            border: none;
            color: #dc3545;
            font-size: 1.1rem;
            padding: 5px;
            border-radius: 4px;
            transition: all 0.2s ease;
            cursor: pointer;
        }

        .btn-delete:hover {
            background: rgba(220, 53, 69, 0.1);
            transform: scale(1.1);
        }

        .delete-form {
            display: inline-block;
            margin: 0;
            padding: 0;
        }

        /* Perbaikan alignment kolom */
        .kategori-col {
            width: 15%;
            text-align: start !important;
        }

        .lokasi-col {
            width: 15%;
            text-align: start !important;
        }

        .keterangan-col {
            width: 20%;
            text-align: start !important;
        }

        .foto-col {
            width: 10%;
        }

        .tanggal-col {
            width: 12%;
        }

        .status-col {
            width: 12%;
        }

        .aksi-col {
            width: 16%;
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
                <div class="card-body p-4">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th class="kategori-col">Kategori</th>
                                    <th class="lokasi-col">Lokasi</th>
                                    <th class="keterangan-col">Keterangan</th>
                                    <th class="foto-col">Foto</th>
                                    <th class="tanggal-col">Tanggal</th>
                                    <th class="status-col">Status</th>
                                    <th class="aksi-col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($aspirasis as $aspirasi)
                                    <tr>
                                        <td class="text-start">
                                            <span
                                                class="status-badge
                                        @if ($aspirasi->status == 'Menunggu') kategori-menunggu
                                        @elseif($aspirasi->status == 'Proses') kategori-proses
                                        @else kategori-selesai @endif">
                                                {{ $aspirasi->kategori->ket_kategori }}
                                            </span>
                                        </td>
                                        <td class="text-start">{{ $aspirasi->lokasi }}</td>
                                        <td class="text-start">{{ Str::limit($aspirasi->ket, 30) }}</td>
                                        <td>
                                            @if ($aspirasi->foto)
                                                <img src="{{ $aspirasi->foto_url }}" alt="Foto Pengaduan"
                                                    class="foto-pengaduan">
                                            @else
                                                <span class="text-muted">-</span>
                                            @endif
                                        </td>
                                        <td>{{ $aspirasi->created_at->format('d M Y') }}</td>
                                        <td>
                                            <span
                                                class="status-badge
                                        @if ($aspirasi->status == 'Menunggu') status-menunggu
                                        @elseif($aspirasi->status == 'Proses') status-proses
                                        @else status-selesai @endif">
                                                {{ $aspirasi->status }}
                                            </span>
                                        </td>
                                        <td>
                                            <a href="{{ route('siswa.aspirasi.show', $aspirasi->id_aspirasi) }}" class="btn" title="Lihat Detail">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <form method="POST"
                                                action="{{ route('siswa.aspirasi.destroy', $aspirasi->id_aspirasi) }}"
                                                class="delete-form"
                                                onsubmit="return confirm('Apakah Anda yakin ingin menghapus pengaduan ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn-delete" title="Hapus Pengaduan">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center py-5">
                                            <div class="empty-state">
                                                <div class="empty-icon">
                                                    <i class="fas fa-inbox"></i>
                                                </div>
                                                <h5 class="text-muted mb-2">Belum ada pengaduan</h5>
                                                <p class="text-muted mb-3">Anda belum pernah mengajukan pengaduan</p>
                                                <div class="mt-3">
                                                    <a href="{{ route('siswa.aspirasi.create') }}" class="btn-earth">
                                                        <i class="fas fa-plus me-2"></i>Ajukan Pengaduan Pertama Anda
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    @if ($aspirasis->hasPages())
                        <div class="d-flex justify-content-center mt-4">
                            {{ $aspirasis->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
