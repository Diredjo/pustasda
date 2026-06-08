<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - PUSTASDA</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        :root {
            --red:    #e31e25;
            --red-dark: #b71c1c;
            --yellow: #f5a623;
            --gray:   #6c757d;
            --light:  #f8f9fa;
            --dark:   #2d2d2d;
            --white:  #ffffff;
            --shadow: 0 4px 24px rgba(0,0,0,0.10);
        }

        body {
            font-family: 'Segoe UI', system-ui, sans-serif;
            background: var(--light);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-wrapper {
            display: flex;
            width: 900px;
            min-height: 520px;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: var(--shadow);
        }

        /* PANEL KIRI */
        .login-left {
            flex: 1;
            background: linear-gradient(135deg, var(--red) 0%, var(--red-dark) 100%);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 48px 40px;
            color: var(--white);
            position: relative;
            overflow: hidden;
        }

        .login-left::before {
            content: '';
            position: absolute;
            width: 300px; height: 300px;
            background: rgba(255,255,255,0.06);
            border-radius: 50%;
            top: -80px; right: -80px;
        }

        .login-left::after {
            content: '';
            position: absolute;
            width: 200px; height: 200px;
            background: rgba(255,255,255,0.06);
            border-radius: 50%;
            bottom: -60px; left: -60px;
        }

        .login-logo {
            width: 90px;
            margin-bottom: 24px;
            filter: drop-shadow(0 4px 12px rgba(0,0,0,0.2));
        }

        .login-left h1 {
            font-size: 2rem;
            font-weight: 800;
            letter-spacing: 2px;
            margin-bottom: 8px;
        }

        .login-left p {
            font-size: 0.85rem;
            opacity: 0.85;
            text-align: center;
            line-height: 1.6;
        }

        .login-left .tagline {
            margin-top: 32px;
            background: rgba(255,255,255,0.12);
            border-radius: 12px;
            padding: 16px 20px;
            font-size: 0.82rem;
            text-align: center;
            line-height: 1.7;
        }

        /* PANEL KANAN */
        .login-right {
            flex: 1;
            background: var(--white);
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 48px 44px;
        }

        .login-right h2 {
            font-size: 1.6rem;
            font-weight: 700;
            color: var(--dark);
            margin-bottom: 6px;
        }

        .login-right .subtitle {
            font-size: 0.88rem;
            color: var(--gray);
            margin-bottom: 32px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            font-size: 0.85rem;
            font-weight: 600;
            color: var(--dark);
            margin-bottom: 8px;
        }

        .input-wrap {
            position: relative;
        }

        .input-wrap i {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--gray);
            font-size: 0.9rem;
        }

        .input-wrap input {
            width: 100%;
            padding: 12px 14px 12px 40px;
            border: 1.5px solid #e0e0e0;
            border-radius: 10px;
            font-size: 0.92rem;
            color: var(--dark);
            transition: border-color 0.2s, box-shadow 0.2s;
            outline: none;
            background: var(--light);
        }

        .input-wrap input:focus {
            border-color: var(--red);
            box-shadow: 0 0 0 3px rgba(227,30,37,0.08);
            background: var(--white);
        }

        .input-wrap .toggle-password {
            position: absolute;
            right: 14px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: var(--gray);
            font-size: 0.9rem;
        }

        .form-options {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 24px;
            font-size: 0.84rem;
        }

        .form-options label {
            display: flex;
            align-items: center;
            gap: 6px;
            cursor: pointer;
            color: var(--gray);
        }

        .form-options input[type=checkbox] {
            accent-color: var(--red);
        }

        .btn-login {
            width: 100%;
            padding: 13px;
            background: linear-gradient(135deg, var(--red), var(--red-dark));
            color: var(--white);
            border: none;
            border-radius: 10px;
            font-size: 1rem;
            font-weight: 700;
            cursor: pointer;
            letter-spacing: 0.5px;
            transition: opacity 0.2s, transform 0.1s;
        }

        .btn-login:hover  { opacity: 0.92; transform: translateY(-1px); }
        .btn-login:active { transform: translateY(0); }

        .alert-error {
            background: #fff3f3;
            border: 1px solid #ffcdd2;
            border-radius: 8px;
            padding: 10px 14px;
            margin-bottom: 18px;
            font-size: 0.84rem;
            color: var(--red);
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .login-footer {
            margin-top: 28px;
            text-align: center;
            font-size: 0.78rem;
            color: #aaa;
        }

        @media (max-width: 700px) {
            .login-wrapper { flex-direction: column; width: 96vw; }
            .login-left    { padding: 32px 24px; }
            .login-right   { padding: 32px 24px; }
        }
    </style>
</head>
<body>

<div class="login-wrapper">
    <!-- KIRI -->
    <div class="login-left">
        <img src="{{ asset('images/logo-pustasda.png') }}"
             onerror="this.style.display='none'"
             class="login-logo" alt="PUSTASDA">
        <h1>PUSTASDA</h1>
        <p>Pusat Prestasi<br>SMK Telkom Sidoarjo</p>
        <div class="tagline">
            <i class="fa-solid fa-trophy" style="color:var(--yellow);margin-bottom:8px;font-size:1.4rem;display:block;"></i>
            Track Your Competitions.<br>
            Build Your Achievements.
        </div>
    </div>

    <!-- KANAN -->
    <div class="login-right">
        <h2>Selamat Datang</h2>
        <p class="subtitle">Masuk ke akun PUSTASDA Anda</p>

        @if ($errors->any())
        <div class="alert-error">
            <i class="fa-solid fa-circle-exclamation"></i>
            {{ $errors->first() }}
        </div>
        @endif

        <form method="POST" action="{{ route('login.post') }}">
            @csrf
            <div class="form-group">
                <label for="email">Email</label>
                <div class="input-wrap">
                    <i class="fa-solid fa-envelope"></i>
                    <input type="email" id="email" name="email"
                           value="{{ old('email') }}"
                           placeholder="email@pustasda.id" required autofocus>
                </div>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <div class="input-wrap">
                    <i class="fa-solid fa-lock"></i>
                    <input type="password" id="password" name="password"
                           placeholder="Masukkan password" required>
                    <i class="fa-solid fa-eye toggle-password" id="togglePwd"></i>
                </div>
            </div>

            <div class="form-options">
                <label>
                    <input type="checkbox" name="remember">
                    Ingat saya
                </label>
            </div>

            <button type="submit" class="btn-login">
                <i class="fa-solid fa-right-to-bracket"></i> Masuk
            </button>
        </form>

        <div class="login-footer">
            &copy; {{ date('Y') }} PUSTASDA - SMK Telkom Sidoarjo
        </div>
    </div>
</div>

<script>
    document.getElementById('togglePwd').addEventListener('click', function() {
        const input = document.getElementById('password');
        if (input.type === 'password') {
            input.type = 'text';
            this.className = 'fa-solid fa-eye-slash toggle-password';
        } else {
            input.type = 'password';
            this.className = 'fa-solid fa-eye toggle-password';
        }
    });
</script>
</body>
</html>