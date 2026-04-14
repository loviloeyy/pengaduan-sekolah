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
    }

    .earth-card {
        background: var(--card-gradient);
        border: none;
        border-radius: 16px;
        overflow: hidden;
        border: 1px solid rgba(44, 62, 80, 0.05);
    }

    .earth-card-header {
        background: var(--header-gradient);
        color: white;
        padding: 15px 20px;
        font-weight: 600;
        display: flex;
        align-items: center;
        justify-content: space-between;
        font-size: 1rem;
        gap: 10px;
        flex-wrap: wrap;
    }

    .table-responsive {
        border-radius: 12px;
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
    }

    .table thead { background: #F8F9FA; color: var(--dark); border-bottom: 2px solid #E0E0E0; }
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
        white-space: nowrap;
    }

    .table td {
        padding: 20px;
        border-top: 1px solid #F0F0F0;
        font-size: 0.95rem;
        font-family: 'Poppins', sans-serif;
        vertical-align: middle;
        color: var(--dark);
        white-space: nowrap;
    }

    .td-name-cell {
        white-space: normal;
        min-width: 140px;
    }

    .table-hover tbody tr:hover { background: #F4F6F7; }

    .btn-action {
        background: none;
        border: none;
        font-size: 1.1rem;
        padding: 6px;
        border-radius: 6px;
        transition: all 0.2s ease;
        cursor: pointer;
        text-decoration: none;
        display: inline-flex;
        margin: 0 2px;
        width: 32px;
        height: 32px;
        align-items: center;
        justify-content: center;
    }

    .btn-action:hover {
        transform: scale(1.1);
    }

    .btn-view {
        color: #363936;
        background-color: #f1f3f5;
        border: 1px solid #dee2e6;
    }

    .btn-view:hover {
        color: #000000;
        background-color: #c6c7c7;
        border-color: #3c3d3c;
    }
    .empty-state { text-align: center; padding: 40px 20px; }
    .empty-icon { font-size: 3.5rem; color: var(--accent); margin-bottom: 15px; }

    @media (max-width: 768px) {
        .earth-card-header {
            padding: 12px 15px;
            font-size: 0.95rem;
            justify-content: center;
        }

        .table thead { display: none; }
        .table, .table tbody, .table tr, .table td { display: block; width: 100%; }

        .table tr {
            margin-bottom: 15px;
            background: white;
            border-radius: 12px;
            border: 1px solid #eee;
            padding: 15px;
        }

        .table td {
            padding: 8px 0;
            border: none;
            text-align: left !important;
            position: relative;
            padding-left: 0;
            white-space: normal;
            display: flex;
            flex-direction: column;
            gap: 4px;
        }

        .mobile-label {
            font-size: 0.7rem;
            color: var(--dark);
            text-transform: uppercase;
            font-weight: 700;
            letter-spacing: 0.5px;
            margin-bottom: 2px;
        }

        .data-content {
            font-size: 0.9rem;
            color: var(--dark);
            font-weight: 500;
        }

        .nis-mobile {
            font-size: 0.8rem;
            color: var(--dark);
            font-weight: 400;
        }

        .td-action-mobile {
            display: flex;
            justify-content: flex-start;
            gap: 10px;
            margin-top: 12px;
            padding-top: 12px;
            border-top: 1px dashed #eee;
        }

        .td-action-mobile .btn-action {
            width: 36px;
            height: 36px;
            font-size: 1rem;
            background: #f8f9fa;
            border: 1px solid #ddd;
        }

        .badge {
            font-size: 0.75rem !important;
            padding: 4px 8px !important;
            align-self: flex-start;
        }
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
                    <span>Daftar Siswa</span>
                </div>

                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead>
                                <tr>
                                    <th style="width: 30%;">NAMA & NIS</th>
                                    <th style="width: 30%; text-align: left;">EMAIL</th>
                                    <th style="width: 20%; text-align: center;">KELAS</th>
                                    <th style="width: 20%; text-align: center;">AKSI</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($Siswas as $siswa)
                                <tr>
                                    <td class="td-name-cell">
                                        <span class="mobile-label d-md-none">Nama & NIS</span>
                                        <div class="data-content">{{ $siswa->name }}</div>
                                        <div class="nis-mobile d-md-none">{{ $siswa->nis }}</div>
                                        <div class="d-none d-md-block nis-mobile" style="margin-top:4px; font-size: 0.85rem; color: var(--dark);">{{ $siswa->nis }}</div>
                                    </td>

                                    <td style="text-align: left;">
                                        <span class="mobile-label d-md-none">Email</span>
                                        <span class="badge bg-light text-dark border data-content" style="font-size: 0.85rem; padding: 6px 12px; display: inline-flex; align-items: center;">
                                            <i class="fas fa-envelope me-2 text-secondary" style="font-size: 0.8rem;"></i> {{ $siswa->email }}
                                        </span>
                                    </td>

                                    <td style="text-align: center;">
                                        <span class="mobile-label d-md-none text-start">Kelas</span>
                                        <span class="data-content">{{ $siswa->kelas }}</span>
                                    </td>

                                    <td style="text-align: center;">
                                        <span class="mobile-label d-md-none w-100">Aksi</span>
                                        <div style="display: inline-flex; gap: 5px; justify-content: center;">
                                            <a href="{{ route('admin.siswa.show', $siswa->nis) }}" class="btn-action btn-view" title="Lihat Detail">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="text-center py-5">
                                        <div class="empty-state">
                                            <div class="empty-icon"><i class="fas fa-inbox"></i></div>
                                            <h5 class="text-muted mb-2" style="font-weight: 600; color: var(--primary);">Belum ada data siswa</h5>
                                            <p class="text-muted mb-3">Daftar siswa masih kosong.</p>
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    @if ($Siswas->hasPages())
                    <div class="p-3 d-flex justify-content-center">
                        {{ $Siswas->links() }}
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
