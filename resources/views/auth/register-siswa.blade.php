<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Siswa</title>

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
            --border-color: #D1D9E6;
        }
        body {
            background-color: var(--grey-bg);
            font-family: 'Poppins', sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            color: var(--navy-main);
            padding: 20px;
        }
        .register-card {
            border: none;
            border-radius: 16px;
            width: 100%;
            max-width: 420px;
            padding: 40px;
            background: var(--white);
            box-shadow: 0 10px 30px rgba(44, 62, 80, 0.15);
            text-align: center;
            position: relative;
        }

        h3 {
            color: var(--navy-dark);
            font-weight: 700;
            margin-bottom: 10px;
            font-size: 1.8rem;
        }
        .subtitle {
            color: #7F8C8D;
            font-size: 0.9rem;
            margin-bottom: 25px;
        }

        .custom-input-wrapper {
            position: relative;
            margin-bottom: 15px;
            text-align: left;
        }

        .input-icon {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--navy-dark);
            font-size: 1.1rem;
            z-index: 2;
            transition: color 0.3s ease;
            pointer-events: none;
        }

        .custom-input {
            width: 100%;
            padding: 12px 15px 12px 45px;
            border: 1.5px solid var(--border-color);
            border-radius: 8px;
            background-color: #F8F9FA;
            font-family: 'Poppins', sans-serif;
            font-size: 0.9rem;
            color: var(--navy-dark);
            transition: all 0.3s ease;
            box-sizing: border-box;
        }

        .custom-input:focus {
            background-color: var(--white);
            border-color: var(--navy-main);
            box-shadow: 0 0 0 4px rgba(44, 62, 80, 0.1);
            outline: none;
        }

        .custom-input-wrapper:focus-within .input-icon {
            color: var(--navy-main);
        }

        .custom-input::placeholder {
            color: #1A252F;
        }

        .btn-reg {
            background: var(--navy-main);
            color: white;
            border: none;
            padding: 12px;
            width: 100%;
            border-radius: 8px;
            font-weight: 600;
            font-family: 'Poppins', sans-serif;
            margin-top: 10px;
            transition: all 0.3s;
            box-shadow: 0 4px 6px rgba(44, 62, 80, 0.2);
            cursor: pointer;
        }
        .btn-reg:hover {
            background: var(--navy-dark);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(44, 62, 80, 0.3);
        }

        .link-login {
            text-align: center;
            display: block;
            margin-top: 20px;
            color: var(--navy-main);
            text-decoration: none;
            font-size: 0.9rem;
            font-weight: 500;
        }
        .link-login:hover { text-decoration: underline; color: var(--navy-dark); }

        .alert-danger {
            font-size: 0.85rem;
            border-radius: 8px;
            padding: 10px;
            text-align: left;
            border: none;
            background-color: #F8D7DA;
            color: #721C24;
            margin-bottom: 20px;
            animation: fadeIn 0.5s;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body>
    <div class="register-card">
        <h3>Register Siswa</h3>
        <p class="subtitle">Isi data diri untuk membuat akun baru</p>

        <form method="POST" action="{{ route('siswa.register') }}">
            @csrf

            <div class="custom-input-wrapper">
                <i class="fas fa-user input-icon"></i>
                <input type="text" name="name" class="custom-input" placeholder="Nama Lengkap" value="{{ old('name') }}" required>
            </div>

            <div class="custom-input-wrapper">
                <i class="fas fa-id-card input-icon"></i>
                <input type="text" name="nis" class="custom-input" placeholder="NIS" value="{{ old('nis') }}" required>
            </div>

            <div class="custom-input-wrapper">
                <i class="fas fa-school input-icon"></i>
                <input type="text" name="kelas" class="custom-input" placeholder="Kelas" value="{{ old('kelas') }}" required>
            </div>

            <div class="custom-input-wrapper">
                <i class="fas fa-envelope input-icon"></i>
                <input type="email" name="email" class="custom-input" placeholder="Email" value="{{ old('email') }}" required>
            </div>

            <div class="custom-input-wrapper">
                <i class="fas fa-lock input-icon"></i>
                <input type="password" name="password" class="custom-input" placeholder="Password" required>
            </div>

            <div class="custom-input-wrapper">
                <i class="fas fa-lock input-icon"></i>
                <input type="password" name="password_confirmation" class="custom-input" placeholder="Konfirmasi Password" required>
            </div>

            @if($errors->any())
                <div class="alert-danger">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    <strong>Terjadi kesalahan:</strong>
                    <ul class="mb-0 mt-1 ps-3">
                        @foreach($errors->all() as $err)
                            <li>{{ $err }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <button type="submit" class="btn btn-reg">Daftar Akun</button>
        </form>

        <a href="{{ route('login') }}" class="link-login">
            Sudah punya akun? Login disini
        </a>
    </div>
</body>
</html>
