@extends('layouts.app')

@section('title', 'Daftar Siswa')

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

        --btn-shadow: 0 4px 12px rgba(52, 152, 219, 0.3);
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
        background-color: var(--secondary); /* Biru */
        color: white;
        border: none;
        border-radius: 8px;
        padding: 8px 16px;
        font-weight: 600;
        transition: all 0.3s ease;
        text-decoration: none;
        font-size: 0.9rem;
        font-family: 'Poppins', sans-serif;
        display: inline-flex;
        align-items: center;
        box-shadow: var(--btn-shadow);
    }

    .btn-earth:hover {
        background-color: #2980B9; /* Biru lebih gelap */
        color: white;
        text-decoration: none;
        transform: translateY(-2px);
        box-shadow: 0 6px 15px rgba(52, 152, 219, 0.4);
    }

    .table-responsive {
        border-radius: 12px;
        overflow: hidden;
        border: 1px solid rgba(44, 62, 80, 0.05);
    }

    .table thead {
        background: #F8F9FA;
        color: var(--dark);
        border-bottom: 2px solid #E0E0E0;
    }

    .table th {
        font-weight: 700;
        padding: 15px 20px;
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        font-family: 'Poppins', sans-serif;
        vertical-align: middle;
        color: var(--dark);
        border: none;
    }

    .table td {
        padding: 20px;
        border-top: 1px solid #F0F0F0;
        font-size: 0.95rem;
        font-family: 'Poppins', sans-serif;
        vertical-align: middle;
        color: var(--dark);
    }

    .table td.text-start {
        text-align: start;
    }

    .table-hover tbody tr:hover {
        background: #F4F6F7;
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

    /* Pagination */
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

    .btn-action {
        background: none;
        border: none;
        font-size: 1.1rem;
        padding: 6px 8px;
        border-radius: 6px;
        transition: all 0.2s ease;
        cursor: pointer;
        text-decoration: none;
        display: inline-block;
        margin: 0 4px;
    }

    .btn-action:hover {
        transform: scale(1.1);
        background-color: rgba(0,0,0,0.05);
    }

    .btn-edit { color: var(--secondary); }
    .btn-edit:hover { color: #2980B9; background-color: #EBF5FB; }

    .btn-view { color: #363936; }
    .btn-view:hover { color: #000000; background-color: #E8F8F5; }

    .btn-delete { color: #E74C3C; }
    .btn-delete:hover { color: #C0392B; background-color: #FDedec; }

    .delete-form {
        display: inline-block;
        margin: 0;
        padding: 0;
    }
</style>

<div class="row">
    <div class="col-md-12">
        <div class="earth-card">
            <div class="earth-card-header">
                <span>Daftar Siswa</span>
                <a href="{{ route('admin.siswa.create') }}" class="btn-earth">
                    <i class="fas fa-plus me-2"></i>Tambah Siswa
                </a>
            </div>
            <div class="card-body p-4">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead>
                            <tr>
                                <th class="text-start" style="width: 40%;">NAMA & NIS</th>
                                <th style="width: 20%;" class="text-center">KELAS</th>
                                <th style="width: 40%;" class="text-center">AKSI</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($Siswas as $siswa)
                            <tr>

                                <td class="text-start">
                                    <div style="font-weight: 700; font-size: 1rem; color: var(--dark);">{{ $siswa->name }}</div>
                                    <div style="font-size: 0.85rem; color: var(--dark); margin-top: 4px;">{{ $siswa->nis }}</div>
                                </td>


                                <td class="text-center">
                                    <span class="badge-kelas">{{ $siswa->kelas }}</span>
                                </td>

                                <td class="text-center">
                                    <div class="d-flex justify-content-center align-items-center gap-2">

                                        <a href="{{ route('admin.siswa.edit', $siswa) }}" class="btn-action btn-edit" title="Edit Siswa">
                                            <i class="fas fa-pen-to-square"></i>
                                        </a>

                                        <a href="{{ route('admin.siswa.show', $siswa) }}" class="btn-action btn-view" title="Lihat Detail">
                                            <i class="fas fa-eye"></i>
                                        </a>

                                        <form method="POST" action="{{ route('admin.siswa.destroy', $siswa) }}" class="delete-form" onsubmit="return confirm('Apakah Anda yakin ingin menghapus siswa ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-action btn-delete" title="Hapus Siswa">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" class="text-center py-5">
                                    <div class="empty-state">
                                        <div class="empty-icon">
                                            <i class="fas fa-inbox"></i>
                                        </div>
                                        <h5 class="text-muted mb-2" style="font-weight: 600; color: var(--primary);">Belum ada data siswa</h5>
                                        <p class="text-muted mb-3" style="color: var(--muted);">Daftar siswa masih kosong.</p>
                                        <a href="{{ route('admin.siswa.create') }}" class="btn-earth">
                                            <i class="fas fa-plus me-2"></i>Tambah Siswa Pertama
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if ($Siswas->hasPages())
                <div class="d-flex justify-content-center mt-4">
                    {{ $Siswas->links() }}
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
