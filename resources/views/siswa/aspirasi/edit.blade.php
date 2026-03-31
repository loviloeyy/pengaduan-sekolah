@extends('layouts.app')

@section('title', 'Ajukan Pengaduan')

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
            --success: #66BB6A;
            /* Hijau segar */
            --warning: #FFA726;
            /* Kuning emas */
            --danger: #EF5350;
            /* Merah terang */

            /* Gradient earth tone */
            --card-gradient: linear-gradient(135deg, #ffffff, #f8f4f0);
            --header-gradient: linear-gradient(135deg, #5D4037, #795548);
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
            gap: 12px;
        }

        .form-control {
            border: 1px solid rgba(93, 64, 55, 0.2);
            border-radius: 8px;
            padding: 12px 15px;
            font-family: 'Poppins', sans-serif;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 0.2rem rgba(93, 64, 55, 0.25);
        }

        .form-label {
            font-weight: 600;
            color: var(--dark);
            margin-bottom: 8px;
            font-family: 'Poppins', sans-serif;
        }

        .form-select {
            border: 1px solid rgba(93, 64, 55, 0.2);
            border-radius: 8px;
            padding: 12px 15px;
            font-family: 'Poppins', sans-serif;
            transition: all 0.3s ease;
        }

        .form-select:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 0.2rem rgba(93, 64, 55, 0.25);
        }

        .btn-earth {
            background: var(--primary);
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
            background: #4E342E;
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(93, 64, 55, 0.3);
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
            box-shadow: 0 4px 12px rgba(93, 64, 55, 0.2);
        }

        .alert {
            border-radius: 12px;
            font-family: 'Poppins', sans-serif;
            border: none;
        }

        .alert-success {
            background-color: #e8f5e9;
            color: #2e7d32;
            border-left: 4px solid var(--success);
        }

        .alert-danger {
            background-color: #ffebee;
            color: #c62828;
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

        /* Upload area styling */
        .upload-area {
            border: 2px dashed rgba(93, 64, 55, 0.3);
            border-radius: 12px;
            padding: 30px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
            background: rgba(255, 255, 255, 0.5);
        }

        .upload-area:hover {
            border-color: var(--primary);
            background: rgba(93, 64, 55, 0.05);
        }

        .upload-icon {
            font-size: 3rem;
            color: var(--primary);
            margin-bottom: 15px;
        }

        .upload-text {
            color: var(--dark);
            font-weight: 500;
            margin-bottom: 10px;
        }

        .upload-hint {
            color: rgba(62, 39, 35, 0.6);
            font-size: 0.9rem;
        }

        .preview-image {
            max-width: 100%;
            max-height: 200px;
            border-radius: 8px;
            margin-top: 15px;
            display: none;
        }

        @media (max-width: 768px) {

            .btn-earth,
            .btn-outline-earth {
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
                    <h4>Ajukan Pengaduan Sarana Sekolah</h4>
                </div>
                <div class="card-body p-4">
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0" style="padding-left: 20px; line-height: 1.6;">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('siswa.aspirasi.update', $aspirasi->id_aspirasi) }}"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label class="form-label">Kategori Pengaduan</label>
                            <select name="id_kategori" class="form-select @error('id_kategori') is-invalid @enderror"
                                required>
                                <option value="">-- Pilih Kategori --</option>
                                @foreach ($kategoris as $kategori)
                                    <option value="{{ $kategori->id_kategori }}"
                                        {{ old('id_kategori', $aspirasi->id_kategori) == $kategori->id_kategori ? 'selected' : '' }}>
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
                                value="{{ old('lokasi', $aspirasi->lokasi) }}" required>
                            @error('lokasi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Keterangan Pengaduan</label>
                            <textarea name="ket" class="form-control @error('ket') is-invalid @enderror" rows="5" required>{{ old('ket', $aspirasi->ket) }}</textarea>
                            @error('ket')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Foto lama -->
                        @if ($aspirasi->foto)
                            <div class="mb-3">
                                <label class="form-label">Foto Saat Ini</label><br>
                                <img src="{{ asset('storage/pengaduan/' . $aspirasi->foto) }}" width="150"
                                    class="rounded">
                            </div>
                        @endif

                        <!-- Upload Foto -->
                        <div class="mb-4">
                            <label class="form-label">Ganti Foto (Opsional)</label>
                            <input type="file" name="foto" class="form-control @error('foto') is-invalid @enderror">
                            @error('foto')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-grid gap-3">
                            <button type="submit" class="btn-earth">
                                Update Pengaduan
                            </button>
                            <a href="{{ route('siswa.aspirasi.index') }}" class="btn-outline-earth text-center">
                                Kembali
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

            // Click upload area to trigger file input
            uploadArea.addEventListener('click', function() {
                fotoInput.click();
            });

            // Drag and drop functionality
            uploadArea.addEventListener('dragover', function(e) {
                e.preventDefault();
                this.style.borderColor = '#5D4037';
                this.style.backgroundColor = 'rgba(93, 64, 55, 0.1)';
            });

            uploadArea.addEventListener('dragleave', function(e) {
                e.preventDefault();
                this.style.borderColor = 'rgba(93, 64, 55, 0.3)';
                this.style.backgroundColor = 'rgba(255, 255, 255, 0.5)';
            });

            uploadArea.addEventListener('drop', function(e) {
                e.preventDefault();
                this.style.borderColor = 'rgba(93, 64, 55, 0.3)';
                this.style.backgroundColor = 'rgba(255, 255, 255, 0.5)';

                if (e.dataTransfer.files.length) {
                    fotoInput.files = e.dataTransfer.files;
                    handleFileSelect(e.dataTransfer.files[0]);
                }
            });

            // File selection handler
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
