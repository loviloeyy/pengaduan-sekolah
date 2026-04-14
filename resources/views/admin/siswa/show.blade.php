@extends('layouts.app')

@section('title', 'Detail Siswa')

@section('content')
<div class="container py-4">
    <div class="card shadow-sm border-0 rounded-4">
        <div class="card-header bg-info text-white rounded-top-4">
            <h5 class="mb-0"><i class="fas fa-user-circle me-2"></i>Detail Siswa</h5>
        </div>

        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-borderless">
                        <tr>
                            <th width="150">NIS</th>
                            <td>: {{ $siswa->nis }}</td>
                        </tr>
                        <tr>
                            <th>Nama</th>
                            <td>: {{ $siswa->name }}</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>: {{ $siswa->email }}</td>
                        </tr>
                        <tr>
                            <th>Kelas</th>
                            <td>: {{ $siswa->kelas }}</td>
                        </tr>
                        <tr>
                            <th width="150">Dibuat</th>
                            <td>: {{ \Carbon\Carbon::parse($siswa->created_at)->setTimezone('Asia/Jakarta')->format('d M Y, H:i') }} WIB</td>
                        </tr>
                    </table>
                </div>
            </div>

            <hr class="my-4">

            <div class="d-flex gap-2">
                <a href="{{ route('admin.siswa.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left me-1"></i> Kembali ke Daftar
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
