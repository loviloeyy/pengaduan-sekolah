<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Pengaduan Sekolah</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --navy-dark: #1A252F;
            --navy-main: #2C3E50;
            --grey-bg: #ECF0F1;
            --white: #FFFFFF;
            --input-icon-color: #95A5A6;
        }
        body {
            background-color: var(--grey-bg);
            font-family: 'Poppins', sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            color: var(--navy-main);
            overflow-x: hidden;
        }
        .login-card {
            background: var(--white);
            padding: 40px;
            border-radius: 16px;
            width: 100%;
            max-width: 420px;
            box-shadow: 0 10px 30px rgba(44, 62, 80, 0.15);
            text-align: center;
            position: relative;
        }

        .logo-container {
            width: 80px;
            height: 80px;
            background: var(--grey-bg);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px auto;
            color: var(--navy-main);
            font-size: 2.5rem;
            border: 2px solid var(--navy-main);
        }

        h2 { font-weight: 700; color: var(--navy-dark); margin-bottom: 5px; }
        .subtitle { color: #7F8C8D; font-size: 0.9rem; margin-bottom: 25px; }

        .input-group {
            margin-bottom: 15px;
            background-color: #F8F9FA;
            border: 1px solid #BDC3C7;
            border-radius: 8px;
            transition: all 0.3s;
            overflow: hidden;
        }
        .input-group:focus-within {
            border-color: var(--navy-main);
            background-color: var(--white);
            box-shadow: 0 0 0 3px rgba(44, 62, 80, 0.1);
        }
        .input-group-text {
            background: transparent;
            border: none;
            color: var(--navy-dark);
            padding-left: 15px;
            padding-right: 5px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .form-control {
            border: none;
            background: transparent;
            padding: 12px 10px;
            font-family: 'Poppins', sans-serif;
            color: var(--navy-dark);
        }
        .form-control:focus {
            box-shadow: none;
            background: transparent;
            outline: none;
        }
        .form-control::placeholder {
            color: #1A252F;
        }

        .btn-login {
            background-color: var(--navy-main);
            color: white;
            border: none;
            padding: 12px;
            width: 100%;
            border-radius: 8px;
            font-weight: 600;
            font-family: 'Poppins', sans-serif;
            transition: all 0.3s;
            box-shadow: 0 4px 6px rgba(44, 62, 80, 0.2);
            margin-top: 10px;
        }
        .btn-login:hover {
            background-color: var(--navy-dark);
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(44, 62, 80, 0.3);
            color: white;
        }

        .register-link {
            display: block;
            margin-top: 20px;
            color: var(--navy-main);
            text-decoration: none;
            font-weight: 500;
            font-size: 0.9rem;
        }
        .register-link:hover { color: var(--navy-dark); text-decoration: underline; }

        /* Copyright Style */
        .copyright-text {
            margin-top: 25px;
            font-size: 0.75rem;
            color: #95A5A6;
            font-weight: 400;
        }

        .alert {
            border-radius: 8px;
            font-size: 0.85rem;
            text-align: center;
            border: none;
            padding: 10px 15px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            animation: fadeIn 0.5s;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .alert-success { background-color: #D4EDDA; color: #155724; border: 1px solid #C3E6CB; }
        .alert-danger { background-color: #F8D7DA; color: #721C24; border: 1px solid #F5C6CB; }
    </style>
</head>
<body>
    <div class="login-card">
        <div class="logo-container">
            <i class="fas fa-school"></i>
        </div>
        <h2>Login</h2>
        <p class="subtitle">Silakan login untuk melanjutkan</p>

        @if(session('success'))
            <div class="alert alert-success" role="alert">
                <i class="fas fa-check-circle"></i>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        @if($errors->has('email'))
            <div class="alert alert-danger" role="alert">
                <i class="fas fa-exclamation-circle"></i>
                <span>{{ $errors->first('email') }}</span>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger" role="alert">
                <i class="fas fa-exclamation-circle"></i>
                <span>{{ session('error') }}</span>
            </div>
        @endif

        <form method="POST" action="{{ route('login.submit') }}">
            @csrf

            <div class="input-group">
                <span class="input-group-text">
                    <i class="fas fa-envelope"></i>
                </span>
                <input type="email" name="email" class="form-control" placeholder="Email" value="{{ old('email') }}" required autofocus>
            </div>

            <div class="input-group">
                <span class="input-group-text">
                    <i class="fas fa-lock"></i>
                </span>
                <input type="password" name="password" class="form-control" placeholder="Password" required>
            </div>

            <button type="submit" class="btn btn-login">Login</button>
        </form>

        <a href="{{ route('siswa.register.form') }}" class="register-link">
            Belum punya akun? <strong>Register Siswa</strong>
        </a>

        <div class="copyright-text">
            &copy; 2026 Sistem Pengaduan Sekolah
        </div>
    </div>
</body>
</html>
