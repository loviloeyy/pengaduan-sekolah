@extends('layouts.app')

@section('title', 'Edit Siswa')

@section('content')
<div class="container">
    <div class="card shadow-sm border-0 rounded-4">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Edit Siswa</h5>
        </div>

        <div class="card-body">

            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $e)
                            <li>{{ $e }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.siswa.update', $siswa->nis) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label>NIS</label>
                    <input type="text" class="form-control" value="{{ $siswa->nis }}" disabled>
                </div>

                <div class="mb-3">
                    <label>Nama</label>
                    <input type="text" name="name" class="form-control"
                        value="{{ old('name', $siswa->name) }}" required>
                </div>

                <div class="mb-3">
                    <label>Kelas</label>
                    <input type="text" name="kelas" class="form-control"
                        value="{{ old('kelas', $siswa->kelas) }}" required>
                </div>

                <div class="mb-3">
                    <label>Password (Opsional)</label>
                    <input type="password" name="password" class="form-control">
                    <small class="text-muted">Kosongkan jika tidak ingin mengubah password</small>
                </div>

                <div class="d-flex gap-2">
                    <button class="btn btn-primary">Update</button>
                    <a href="{{ route('admin.siswa.index') }}" class="btn btn-secondary">Kembali</a>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection
