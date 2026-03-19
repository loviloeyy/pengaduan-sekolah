<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Pengaduan Sarana Sekolah</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* Palet warna Earth Tone */
        :root {
            --primary: #5D4037;      /* Coklat tua (kayu jati) */
            --secondary: #795548;     /* Coklat sedang */
            --accent: #8D6E63;        /* Coklat muda */
            --light: #F5F1EB;         /* Beige terang */
            --dark: #3E2723;          /* Dark brown */
        }

        body {
            background: linear-gradient(135deg, var(--light), #f8f4f0);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Poppins', sans-serif;
        }

        .login-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 10px 40px rgba(93, 64, 55, 0.2);
            overflow: hidden;
            max-width: 450px;
            width: 100%;
        }

        .login-header {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            padding: 30px;
            text-align: center;
        }

        .login-body {
            padding: 40px;
        }

        .form-control {
            border-radius: 10px;
            padding: 12px 15px;
            border: 2px solid #e9ecef;
            transition: all 0.3s;
            font-family: 'Poppins', sans-serif;
        }

        .form-control:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 0.2rem rgba(93, 64, 55, 0.25);
        }

        .btn-login {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            border: none;
            border-radius: 10px;
            padding: 12px;
            font-weight: 600;
            transition: all 0.3s;
            color: white;
            font-family: 'Poppins', sans-serif;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 20px rgba(93, 64, 55, 0.4);
        }

        .role-btn {
            border: 2px solid var(--primary);
            border-radius: 10px;
            padding: 15px;
            margin: 10px 0;
            cursor: pointer;
            transition: all 0.3s;
            background: white;
            color: var(--primary);
            font-weight: 600;
            font-family: 'Poppins', sans-serif;
        }

        .role-btn:hover, .role-btn.active {
            background: var(--primary);
            color: white;
        }

        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap');
    </style>
</head>
<body>
    <div class="login-card">
        <div class="login-header">
            <h2><i class="fas fa-school me-2"></i>Pengaduan Sarana Sekolah</h2>
            <p class="mb-0">Silahkan login untuk melanjutkan</p>
        </div>

        <div class="login-body">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <form method="POST" action="{{ route('login.submit') }}">
                @csrf

                <div class="mb-4">
                    <label class="form-label fw-bold">Pilih Role</label>
                    <div class="role-container">
                        <div class="role-btn active" onclick="selectRole('admin', this)">
                            <i class="fas fa-user-shield me-2"></i>Admin
                        </div>
                        <div class="role-btn" onclick="selectRole('siswa', this)">
                            <i class="fas fa-user-graduate me-2"></i>Siswa
                        </div>
                    </div>
                    <input type="hidden" name="role" id="roleInput" value="admin">
                </div>

                <div class="mb-3">
                    <label for="username" class="form-label fw-bold">
                        <span id="labelText">Username</span>
                    </label>
                    <input type="text" class="form-control @error('username') is-invalid @enderror"
                           id="username" name="username" value="{{ old('username') }}" required autofocus>
                    @error('username')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="password" class="form-label fw-bold">Password</label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror"
                           id="password" name="password" required>
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-login w-100">
                    <i class="fas fa-sign-in-alt me-2"></i>Login Sekarang
                </button>
            </form>

            <div class="text-center mt-4">
                <small class="text-muted">
                    <i class="fas fa-info-circle me-1"></i>
                    <span id="infoText">Gunakan username dan password yang telah diberikan</span>
                </small>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function selectRole(role, element) {
            document.querySelectorAll('.role-btn').forEach(btn => btn.classList.remove('active'));
            element.classList.add('active');
            document.getElementById('roleInput').value = role;

            if(role === 'admin') {
                document.getElementById('labelText').textContent = 'Username';
                document.getElementById('infoText').textContent = 'Gunakan username dan password yang telah diberikan';
            } else {
                document.getElementById('labelText').textContent = 'NIS';
                document.getElementById('infoText').textContent = 'Gunakan NIS dan password Anda';
            }
        }
    </script>
</body>
</html>
