@extends('layouts.app')

@section('title', 'Detail Siswa')

@section('content')
<div class="container">
    <div class="card shadow-sm border-0 rounded-4">
        <div class="card-header bg-info text-white">
            <h5 class="mb-0">Detail Siswa</h5>
        </div>

        <div class="card-body">

            <table class="table table-bordered">
                <tr>
                    <th width="200">NIS</th>
                    <td>{{ $siswa->nis }}</td>
                </tr>
                <tr>
                    <th>Nama</th>
                    <td>{{ $siswa->name }}</td>
                </tr>
                <tr>
                    <th>Kelas</th>
                    <td>{{ $siswa->kelas }}</td>
                </tr>
                <tr>
                    <th>Dibuat</th>
                    <td>{{ $siswa->created_at->format('d M Y H:i') }}</td>
                </tr>
                <tr>
                    <th>Diupdate</th>
                    <td>{{ $siswa->updated_at->format('d M Y H:i') }}</td>
                </tr>
            </table>

            <div class="d-flex gap-2">
                <a href="{{ route('admin.siswa.edit', $siswa->nis) }}" class="btn btn-primary">Edit</a>
                <a href="{{ route('admin.siswa.index') }}" class="btn btn-secondary">Kembali</a>
            </div>

        </div>
    </div>
</div>
@endsection
