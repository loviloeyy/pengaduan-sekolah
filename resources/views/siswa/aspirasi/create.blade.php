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
    }

    body { background-color: var(--light); font-family: 'Poppins', sans-serif; }

    .earth-card {
        background: var(--card-gradient);
        border: none;
        border-radius: 16px;
        box-shadow: 0 4px 20px rgba(44, 62, 80, 0.08);
        overflow: hidden;
        border: 1px solid rgba(44, 62, 80, 0.05);
        margin-bottom: 24px;
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
        font-family: 'Poppins', sans-serif;
    }

    .form-control, .form-select {
        border: 1px solid rgba(44, 62, 80, 0.2);
        border-radius: 8px;
        padding: 10px 12px;
        font-family: 'Poppins', sans-serif;
        transition: all 0.3s ease;
        background-color: #fff;
        font-size: 0.95rem;
    }

    .form-control:focus, .form-select:focus {
        border-color: var(--secondary);
        box-shadow: 0 0 0 0.2rem rgba(52, 152, 219, 0.25);
    }

    .form-label {
        font-weight: 600;
        color: var(--dark);
        margin-bottom: 8px;
        font-family: 'Poppins', sans-serif;
        font-size: 0.95rem;
    }

    .btn-earth {
        background: transparent;
        border: 2px solid var(--primary);
        border-radius: 8px;
        padding: 10px 20px;
        font-weight: 600;
        transition: all 0.3s ease;
        color: var(--primary);
        font-size: 0.95rem;
        font-family: 'Poppins', sans-serif;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
    }

    .btn-earth:hover { background: #2C3E50; transform: translateY(-2px); color: white; }

    .btn-outline-earth {
        background: transparent;
        border: 2px solid var(--primary);
        border-radius: 8px;
        padding: 10px 20px;
        font-weight: 600;
        transition: all 0.3s ease;
        color: var(--primary);
        font-size: 0.95rem;
        font-family: 'Poppins', sans-serif;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        text-decoration: none;
    }
    .btn-outline-earth:hover { background: var(--primary); color: white; transform: translateY(-2px); }

    .alert { border-radius: 12px; font-family: 'Poppins', sans-serif; border: none; font-size: 0.9rem; padding: 12px 15px; }
    .alert-success { background-color: #d4edda; color: #155724; border-left: 4px solid var(--success); }
    .alert-danger { background-color: #f8d7da; color: #721c24; border-left: 4px solid var(--danger); }
    .invalid-feedback { color: var(--danger); font-weight: 500; font-family: 'Poppins', sans-serif; font-size: 0.85rem; }
    .is-invalid { border-color: var(--danger) !important; }

    .upload-area {
        border: 2px dashed rgba(44, 62, 80, 0.3);
        border-radius: 12px;
        padding: 30px 20px;
        text-align: center;
        cursor: pointer;
        transition: all 0.3s ease;
        background: rgba(240, 242, 245, 0.5);
        position: relative;
        min-height: 160px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        overflow: hidden;
    }

    .upload-area:hover {
        border-color: var(--secondary);
        background: rgba(52, 152, 219, 0.05);
    }

    .upload-content {
        transition: opacity 0.3s ease;
        z-index: 1;
    }

    .upload-area.has-image .upload-content {
        display: none;
    }

    .upload-icon { font-size: 2.5rem; color: var(--dark); margin-bottom: 10px; }
    .upload-text { color: var(--dark); font-weight: 500; margin-bottom: 5px; font-size: 0.95rem; }
    .upload-hint { color: var(--muted); font-size: 0.85rem; }

    .preview-container {
        display: none;
        position: absolute;
        top: 0; left: 0; right: 0; bottom: 0;
        width: 100%; height: 100%;
        padding: 10px;
        box-sizing: border-box;
        justify-content: center;
        align-items: center;
        background: rgba(255, 255, 255, 0.9);
        z-index: 2;
    }

    .upload-area.has-image .preview-container {
        display: flex;
    }

    .preview-image {
        max-width: 100%;
        max-height: 100%;
        border-radius: 8px;
        box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        object-fit: contain;
    }

    @media (max-width: 768px) {
        .btn-earth, .btn-outline-earth { width: 100%; margin-bottom: 10px; }
        .earth-card-header { padding: 18px 20px; font-size: 1.1rem; }
    }
</style>

<div class="row justify-content-center">
    <div class="col-md-7 col-lg-5">
        <div class="earth-card">
            <div class="earth-card-header">
                <h5 class="mb-0"><i class="fas fa-plus-circle me-2"></i>Ajukan Pengaduan Sekolah</h5>
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

                    <div class="mb-3">
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

                    <div class="mb-3">
                        <label class="form-label">Lokasi</label>
                        <input type="text" name="lokasi" class="form-control @error('lokasi') is-invalid @enderror"
                               value="{{ old('lokasi') }}" required>
                        @error('lokasi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Keterangan</label>
                        <textarea name="ket" class="form-control @error('ket') is-invalid @enderror" rows="4"
                                  placeholder="Jelaskan masalah yang ingin dilaporkan" required>{{ old('ket') }}</textarea>
                        @error('ket')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Upload Foto</label>

                        <div class="upload-area" id="uploadArea">
                            <div class="upload-content">
                                <div class="upload-icon"><i class="fas fa-cloud-upload-alt"></i></div>
                                <div class="upload-text">Klik atau drag file foto ke sini</div>
                                <div class="upload-hint">Format: JPG, PNG, GIF | Maks: 2MB</div>
                            </div>

                            <div class="preview-container">
                                <img id="previewImage" class="preview-image" alt="Preview Foto">
                            </div>

                            <input type="file" name="foto" id="fotoInput" class="form-control @error('foto') is-invalid @enderror" accept="image/*" style="display: none;">

                            @error('foto')
                                <div class="invalid-feedback d-block mt-2" style="position:relative; z-index:20;">{{ $message }}</div>
                            @enderror
                        </div>

                    </div>

                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="{{ route('siswa.dashboard') }}" class="btn btn-outline-earth me-md-2">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                        <button type="submit" class="btn btn-earth">
                            <i class="fas fa-paper-plane"></i> Ajukan Sekarang
                        </button>
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

    if(uploadArea && fotoInput) {
        uploadArea.addEventListener('click', () => fotoInput.click());

        uploadArea.addEventListener('dragover', (e) => {
            e.preventDefault();
            uploadArea.style.borderColor = '#3498DB';
            uploadArea.style.backgroundColor = 'rgba(52, 152, 219, 0.1)';
        });

        uploadArea.addEventListener('dragleave', () => {
            uploadArea.style.borderColor = 'rgba(44, 62, 80, 0.3)';
            uploadArea.style.backgroundColor = 'rgba(240, 242, 245, 0.5)';
        });

        uploadArea.addEventListener('drop', (e) => {
            e.preventDefault();
            uploadArea.style.borderColor = 'rgba(44, 62, 80, 0.3)';
            uploadArea.style.backgroundColor = 'rgba(240, 242, 245, 0.5)';
            if (e.dataTransfer.files.length) {
                fotoInput.files = e.dataTransfer.files;
                handleFileSelect(e.dataTransfer.files[0]);
            }
        });

        fotoInput.addEventListener('change', function() {
            if (this.files && this.files[0]) handleFileSelect(this.files[0]);
        });
    }

    function handleFileSelect(file) {
        if (file && file.type.match('image.*')) {
            const reader = new FileReader();
            reader.onload = (e) => {
                previewImage.src = e.target.result;
                uploadArea.classList.add('has-image');
            };
            reader.readAsDataURL(file);
        }
    }
});
</script>
@endsection
