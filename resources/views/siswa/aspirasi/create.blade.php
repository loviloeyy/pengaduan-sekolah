@extends('layouts.app')

@section('title', 'Ajukan Pengaduan')

@section('content')
<style>
    :root {
        --primary: #2C3E50;
        --secondary: #3498DB;
        --accent: #95A5A6;
        --light: #ECF0F1;
        --dark: #2C3E50;
        --success: #27AE60;
        --warning: #F39C12;
        --danger: #E74C3C;

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
        gap: 12px;
    }

    .form-control {
        border: 1px solid rgba(44, 62, 80, 0.2);
        border-radius: 8px;
        padding: 12px 15px;
        font-family: 'Poppins', sans-serif;
        transition: all 0.3s ease;
        background-color: #fff;
    }

    .form-control:focus {
        border-color: var(--secondary);
        box-shadow: 0 0 0 0.2rem rgba(52, 152, 219, 0.25);
    }

    .form-label {
        font-weight: 600;
        color: var(--dark);
        margin-bottom: 8px;
        font-family: 'Poppins', sans-serif;
    }

    .form-select {
        border: 1px solid rgba(44, 62, 80, 0.2);
        border-radius: 8px;
        padding: 12px 15px;
        font-family: 'Poppins', sans-serif;
        transition: all 0.3s ease;
        background-color: #fff;
    }

    .form-select:focus {
        border-color: var(--secondary);
        box-shadow: 0 0 0 0.2rem rgba(52, 152, 219, 0.25);
    }

    .btn-earth {
        background: var(--secondary);
        border: none;
        border-radius: 8px;
        padding: 12px 24px;
        font-weight: 600;
        transition: all 0.3s ease;
        box-shadow: var(--btn-shadow);
        color: white;
        font-size: 1rem;
        font-family: 'Poppins', sans-serif;
        letter-spacing: 0.5px;
    }

    .btn-earth:hover {
        background: #2980B9;
        transform: translateY(-2px);
        box-shadow: 0 6px 15px rgba(52, 152, 219, 0.4);
        color: white;
    }

    .btn-outline-earth {
        background: transparent;
        border: 2px solid var(--primary);
        border-radius: 8px;
        padding: 12px 24px;
        font-weight: 600;
        transition: all 0.3s ease;
        color: var(--primary);
        font-size: 1rem;
        font-family: 'Poppins', sans-serif;
        letter-spacing: 0.5px;
    }

    .btn-outline-earth:hover {
        background: var(--primary);
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(44, 62, 80, 0.2);
    }

    .alert {
        border-radius: 12px;
        font-family: 'Poppins', sans-serif;
        border: none;
    }

    .alert-success {
        background-color: #d4edda;
        color: #155724;
        border-left: 4px solid var(--success);
    }

    .alert-danger {
        background-color: #f8d7da;
        color: #721c24;
        border-left: 4px solid var(--danger);
    }

    .invalid-feedback {
        color: var(--danger);
        font-weight: 500;
        font-family: 'Poppins', sans-serif;
    }

    .is-invalid {
        border-color: var(--danger) !important;
    }

    .upload-area {
        border: 2px dashed rgba(44, 62, 80, 0.3);
        border-radius: 12px;
        padding: 30px;
        text-align: center;
        cursor: pointer;
        transition: all 0.3s ease;
        background: rgba(240, 242, 245, 0.5);
    }

    .upload-area:hover {
        border-color: var(--secondary);
        background: rgba(52, 152, 219, 0.05);
    }

    .upload-icon {
        font-size: 3rem;
        color: var(--secondary);
        margin-bottom: 15px;
    }

    .upload-text {
        color: var(--dark);
        font-weight: 500;
        margin-bottom: 10px;
    }

    .upload-hint {
        color: var(--muted);
        font-size: 0.9rem;
    }

    .preview-image {
        max-width: 100%;
        max-height: 200px;
        border-radius: 8px;
        margin-top: 15px;
        display: none;
        box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        border: 1px solid rgba(44, 62, 80, 0.1);
    }

    @media (max-width: 768px) {
        .btn-earth, .btn-outline-earth {
            width: 100%;
            margin-bottom: 10px;
        }

        .earth-card-header {
            padding: 18px 20px;
            font-size: 1.1rem;
        }

        .upload-area {
            padding: 20px;
        }
    }
</style>

<div class="row">
    <div class="col-md-8 offset-md-2">
        <div class="earth-card">
            <div class="earth-card-header">
                <h4>Ajukan Pengaduan Sekolah</h4>
            </div>
            <div class="card-body p-4">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0" style="padding-left: 20px; line-height: 1.6;">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('siswa.aspirasi.store') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-4">
                        <label class="form-label">Kategori Pengaduan</label>
                        <select name="id_kategori" class="form-select @error('id_kategori') is-invalid @enderror" required>
                            <option value="">-- Pilih Kategori --</option>
                            @foreach($kategoris as $kategori)
                                <option value="{{ $kategori->id_kategori }}" {{ old('id_kategori') == $kategori->id_kategori ? 'selected' : '' }}>
                                    {{ $kategori->ket_kategori }}
                                </option>
                            @endforeach
                        </select>
                        @error('id_kategori')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Lokasi Pengaduan</label>
                        <input type="text" name="lokasi" class="form-control @error('lokasi') is-invalid @enderror"
                               value="{{ old('lokasi') }}" placeholder="Contoh: Ruang Kelas 12 RPL 1" required>
                        @error('lokasi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Keterangan Pengaduan</label>
                        <textarea name="ket" class="form-control @error('ket') is-invalid @enderror" rows="5"
                                  placeholder="Jelaskan masalah yang ingin dilaporkan secara detail" required>{{ old('ket') }}</textarea>
                        @error('ket')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Upload Foto</label>
                        <div class="upload-area" id="uploadArea">
                            <div class="upload-icon">
                                <i class="fas fa-cloud-upload-alt"></i>
                            </div>
                            <div class="upload-text">Klik atau drag file foto ke sini</div>
                            <div class="upload-hint">Format: JPG, PNG, GIF | Maks: 2MB</div>
                            <input type="file" name="foto" id="fotoInput" class="form-control @error('foto') is-invalid @enderror" accept="image/*" style="display: none;">
                            @error('foto')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                        <img id="previewImage" class="preview-image mt-2" alt="Preview Foto">
                    </div>

                    <div class="d-grid gap-3">
                        <button type="submit" class="btn-earth">
                            <i class="fas fa-paper-plane me-2"></i>Ajukan Pengaduan Sekarang
                        </button>
                        <a href="{{ route('siswa.aspirasi.index') }}" class="btn-outline-earth text-center">
                            <i class="fas fa-arrow-left me-2"></i>Kembali ke Daftar Pengaduan
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const uploadArea = document.getElementById('uploadArea');
    const fotoInput = document.getElementById('fotoInput');
    const previewImage = document.getElementById('previewImage');

    uploadArea.addEventListener('click', function() {
        fotoInput.click();
    });

    uploadArea.addEventListener('dragover', function(e) {
        e.preventDefault();
        this.style.borderColor = '#3498DB';
        this.style.backgroundColor = 'rgba(52, 152, 219, 0.1)';
    });

    uploadArea.addEventListener('dragleave', function(e) {
        e.preventDefault();
        this.style.borderColor = 'rgba(44, 62, 80, 0.3)';
        this.style.backgroundColor = 'rgba(240, 242, 245, 0.5)';
    });

    uploadArea.addEventListener('drop', function(e) {
        e.preventDefault();
        this.style.borderColor = 'rgba(44, 62, 80, 0.3)';
        this.style.backgroundColor = 'rgba(240, 242, 245, 0.5)';

        if (e.dataTransfer.files.length) {
            fotoInput.files = e.dataTransfer.files;
            handleFileSelect(e.dataTransfer.files[0]);
        }
    });

    fotoInput.addEventListener('change', function() {
        if (this.files && this.files[0]) {
            handleFileSelect(this.files[0]);
        }
    });

    function handleFileSelect(file) {
        if (file && file.type.match('image.*')) {
            const reader = new FileReader();
            reader.onload = function(e) {
                previewImage.src = e.target.result;
                previewImage.style.display = 'block';
            };
            reader.readAsDataURL(file);
        }
    }
});
</script>
@endsection
