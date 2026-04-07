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

        --card-gradient: linear-gradient(135deg, #ffffff, #f8f9fa);
        --header-gradient: linear-gradient(135deg, #2C3E50, #34495E);
    }

    .earth-card {
        background: var(--card-gradient);
        border: none;
        border-radius: 16px;
        box-shadow: 0 4px 20px rgba(44, 62, 80, 0.08);
        overflow: hidden;
        border: 1px solid rgba(44, 62, 80, 0.05);
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
        background: var(--secondary);
        border: none;
        border-radius: 8px;
        padding: 8px 16px;
        font-weight: 600;
        transition: all 0.3s ease;
        color: white;
        font-size: 0.9rem;
        font-family: 'Poppins', sans-serif;
    }

    .btn-earth:hover {
        background: #1d74ae;
        transform: translateY(-2px);
        color: white;
    }

    .table-responsive {
        border-radius: 12px;
        overflow: hidden;
        border: 1px solid rgba(44, 62, 80, 0.05);
    }

    .table thead {
        background: #F8F9FA;
        color: var(--muted);
        border-bottom: 2px solid #E9ECEF;
    }

    .table th {
        font-weight: 700;
        padding: 12px 15px;
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        font-family: 'Poppins', sans-serif;
        vertical-align: middle;
        text-align: center;
        color: var(--dark);
        border: none;
    }

    .table td {
        padding: 15px 15px;
        border-top: 1px solid #F0F0F0;
        font-size: 0.9rem;
        font-family: 'Poppins', sans-serif;
        vertical-align: middle;
        text-align: center;
        color: var(--dark);
    }

    .table td.text-start {
        text-align: start;
    }

    .table-hover tbody tr:hover {
        background: #F4F6F7;
    }

    .status-badge {
        padding: 6px 18px;
        border-radius: 20px;
        font-weight: 600;
        font-size: 0.85rem;
        display: inline-block;
        border: 1px solid transparent;
        min-width: 80px;
        justify-content: center;
        display: flex;
        align-items: center;
        box-shadow: 0 2px 4px rgba(0,0,0,0.05);
    }

    .status-menunggu {
        background-color: #FFF3CD;
        color: #856404;
        border-color: #FFE69C;
    }

    .status-proses {
        background-color: #B3E5FC;
        color: #0277BD;
        border-color: #81D4FA;
    }

    .status-selesai {
        background-color: #C8E6C9;
        color: #2E7D32;
        border-color: #A5D6A7;
    }

    .kategori-menunggu, .kategori-proses, .kategori-selesai {
        background-color: #EBF5FB;
        color: var(--primary);
        border: 1px solid #D6EAF8;
    }

    .foto-pengaduan {
        max-width: 100px;
        max-height: 80px;
        object-fit: cover;
        border: 1px solid #E0E0E0;
        border-radius: 8px;
        display: block;
        margin: 0 auto;
        box-shadow: 0 2px 5px rgba(0,0,0,0.05);
    }

    .empty-state {
        text-align: center;
        padding: 40px 20px;
    }

    .empty-icon {
        font-size: 3.5rem;
        color: var(--accent);
        margin-bottom: 15px;
    }

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

    .pagination .page-link:hover {
        background-color: rgba(52, 152, 219, 0.1);
    }

    .btn-delete {
        background: none;
        border: none;
        color: #E74C3C;
        font-size: 1.1rem;
        padding: 5px;
        border-radius: 4px;
        transition: all 0.2s ease;
        cursor: pointer;
    }

    .btn-delete:hover {
        background: rgba(231, 76, 60, 0.1);
        transform: scale(1.1);
        color: #C0392B;
    }

    .delete-form {
        display: inline-block;
        margin: 0;
        padding: 0;
    }

    .btn-action-view {
        color: var(--dark);
        background: none;
        border: none;
        font-size: 1.1rem;
        padding: 5px;
        transition: all 0.2s;
    }
    .btn-action-view:hover {
        color: #2d2e2e;
        transform: scale(1.1);
    }

    .btn-action-edit {
        background: none;
        border: none;
        font-size: 1.1rem;
        padding: 5px;
        transition: all 0.2s;
        color: #85c7fc;
    }
    .btn-action-edit:hover {
        color: #0154ec;
        transform: scale(1.1);
    }

    .kategori-col { width: 15%; text-align: start !important; }
    .lokasi-col { width: 15%; text-align: start !important; }
    .keterangan-col { width: 20%; text-align: start !important; }
    .foto-col { width: 10%; }
    .tanggal-col { width: 12%; }
    .status-col { width: 12%; }
    .aksi-col { width: 16%; }
</style>

            <div class="row">
                <div class="col-md-12">
                    <div class="earth-card">
                        <div class="earth-card-header">
                            <span>Pengaduan Saya</span>
                            <a href="{{ route('siswa.aspirasi.create') }}" class="btn-earth" style="text-decoration: none;">
                                <i class="fas fa-plus me-2"></i>Ajukan Pengaduan
                            </a>
                        </div>
                    </div>
                </div>
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
                                    <span class="status-badge
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
                                        <img src="{{ $aspirasi->foto_url }}" alt="Foto Pengaduan" class="foto-pengaduan">
                                    @else
                                        <span class="text-dark">-</span>
                                    @endif
                                </td>
                                <td>{{ $aspirasi->created_at->format('d M Y') }}</td>
                                <td>
                                    <span class="status-badge
                                        @if ($aspirasi->status == 'Menunggu') status-menunggu
                                        @elseif($aspirasi->status == 'Proses') status-proses
                                        @else status-selesai @endif">
                                        {{ $aspirasi->status }}
                                    </span>
                                </td>
                                <td>
                                    <div class="d-flex gap-2 justify-content-center">
                                        <a href="{{ route('siswa.aspirasi.show', $aspirasi->id_aspirasi) }}" class="btn-action-view" title="Lihat Detail">
                                            <i class="fas fa-eye"></i>
                                        </a>

                                        <a href="{{ route('siswa.aspirasi.edit', $aspirasi->id_aspirasi) }}" class="btn-action-edit" title="Edit Pengaduan">
                                            <i class="fas fa-edit"></i>
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
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="text-center py-5">
                                    <div class="empty-state">
                                        <div class="empty-icon">
                                            <i class="fas fa-inbox"></i>
                                        </div>
                                        <h5 class="text-darj mb-2" style="color: var(--primary); font-weight: 600;">Belum ada pengaduan</h5>
                                        <p class="text-dark mb-3" style="color: var(--dark);">Anda belum pernah mengajukan pengaduan</p>
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
