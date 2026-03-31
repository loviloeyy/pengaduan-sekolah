<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Pengaduan Sarana Sekolah</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>

        :root {
            --primary: #2C3E50;
            --secondary: #3498DB;
            --accent: #95A5A6;
            --light: #ECF0F1;
            --dark: #2C3E50;
        }

        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap');

        body {
            background: linear-gradient(135deg, var(--light), #dfe6e9);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Poppins', sans-serif;
        }

        .login-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 10px 40px rgba(44, 62, 80, 0.15);
            overflow: hidden;
            max-width: 450px;
            width: 100%;
            border: 1px solid rgba(44, 62, 80, 0.05);
        }

        .login-header {
            background: linear-gradient(135deg, var(--primary), #34495E);
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
            border-color: var(--secondary);
            box-shadow: 0 0 0 0.2rem rgba(52, 152, 219, 0.25);
        }

        .btn-login {
            background: linear-gradient(135deg, var(--secondary), #2980B9);
            border: none;
            border-radius: 10px;
            padding: 12px;
            font-weight: 600;
            transition: all 0.3s;
            color: white;
            font-family: 'Poppins', sans-serif;
            box-shadow: 0 4px 15px rgba(52, 152, 219, 0.3);
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(52, 152, 219, 0.4);
            background: linear-gradient(135deg, #2980B9, var(--secondary));
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
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .role-btn:hover {
            background: #EBF5FB;
            border-color: var(--secondary);
            color: var(--secondary);
        }

        .role-btn.active {
            background: var(--primary);
            color: white;
            border-color: var(--primary);
            box-shadow: 0 4px 10px rgba(44, 62, 80, 0.2);
        }

        .alert-success {
            background-color: #d4edda;
            border-color: #c3e6cb;
            color: #155724;
        }
        .alert-danger {
            background-color: #f8d7da;
            border-color: #f5c6cb;
            color: #721c24;
        }
    </style>
</head>
<body>
    <div class="login-card">
        <div class="login-header">
            <h2><i class="fas fa-school me-2"></i>Pengaduan Sekolah</h2>
            <p class="mb-0">Silahkan login untuk melanjutkan</p>
        </div>

        <div class="login-body">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
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
