<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - PUSTASDA</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', system-ui, sans-serif;
        }

        :root {
            --red: #e31e25;
            --red-dark: #b71c1c;
            --yellow: #f5a623;
            --white: #ffffff;
            --dark: #2d2d2d;
            --glass: rgba(255, 255, 255, 0.7);
        }

        body {
            background: linear-gradient(135deg, #f5f7fa 0%, #e4e8eb 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            /* Efek background blur */
            background-image: radial-gradient(circle at 10% 20%, rgba(227, 30, 37, 0.1) 0%, transparent 40%),
                radial-gradient(circle at 90% 80%, rgba(245, 166, 35, 0.1) 0%, transparent 40%);
        }

        .login-wrapper {
            display: flex;
            width: 900px;
            min-height: 540px;
            background: var(--white);
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.08);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        /* PANEL KIRI */
        .login-left {
            flex: 1;
            background: linear-gradient(135deg, var(--red) 0%, var(--red-dark) 100%);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 40px;
            color: var(--white);
            position: relative;
        }

        .login-left::after {
            content: '';
            position: absolute;
            width: 100%;
            height: 100%;
            background: url('https://www.transparenttextures.com/patterns/cubes.png');
            opacity: 0.1;
        }

        .login-logo {
            width: 220px;
            margin-bottom: 20px;
            filter: drop-shadow(0 5px 15px rgba(0, 0, 0, 0.2));
        }

        /* PANEL KANAN */
        .login-right {
            flex: 1;
            padding: 60px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        h2 {
            font-size: 1.8rem;
            color: var(--dark);
            margin-bottom: 8px;
        }

        .subtitle {
            color: #888;
            margin-bottom: 30px;
            font-size: 0.9rem;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            font-size: 0.8rem;
            font-weight: 600;
            color: #555;
            margin-bottom: 8px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .input-wrap {
            position: relative;
        }

        .input-wrap i {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: #ccc;
            transition: 0.3s;
        }

        .input-wrap input {
            width: 100%;
            padding: 14px 16px 14px 45px;
            border: 2px solid #f0f0f0;
            border-radius: 12px;
            outline: none;
            transition: 0.3s;
        }

        .input-wrap input:focus {
            border-color: var(--red);
            box-shadow: 0 0 0 4px rgba(227, 30, 37, 0.05);
        }

        .input-wrap input:focus+i {
            color: var(--red);
        }

        .btn-login {
            width: 100%;
            padding: 14px;
            background: var(--dark);
            color: var(--white);
            border: none;
            border-radius: 12px;
            font-weight: 600;
            cursor: pointer;
            transition: 0.3s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .btn-login:hover {
            background: var(--red);
        }

        /* Aksen Kuning */
        .accent-bar {
            width: 40px;
            height: 4px;
            background: var(--yellow);
            margin-bottom: 20px;
            border-radius: 2px;
        }

        .alert-error {
            background: #fff5f5;
            color: var(--red);
            padding: 12px;
            border-radius: 10px;
            font-size: 0.85rem;
            margin-bottom: 20px;
            border-left: 4px solid var(--red);
        }

        @media (max-width: 768px) {
            .login-wrapper {
                flex-direction: column;
            }
        }
    </style>
</head>

<body>

    <div class="login-wrapper">
        <div class="login-left">
            <img src="{{ asset('images/LogoPustasdaPutihI.png') }}" class="login-logo" alt="Logo">
            <div style="font-weight: 600; opacity: 0.9;">Pusat Prestasi SMK Telkom Sidoarjo</div>
        </div>

        <div class="login-right">
            <div class="accent-bar"></div>
            <h2>Selamat Datang</h2>
            <p class="subtitle">Silakan masuk menggunakan kredensial Anda</p>

            @if ($errors->any())
                <div class="alert-error"><i class="fa-solid fa-triangle-exclamation"></i> {{ $errors->first() }}</div>
            @endif

            <form method="POST" action="{{ route('login.post') }}">
                @csrf
                <div class="form-group">
                    <label>Email</label>
                    <div class="input-wrap">
                        <i class="fa-solid fa-at"></i>
                        <input type="email" name="email" placeholder="nama@pustasda.id" required>
                    </div>
                </div>

                <div class="form-group">
                    <label>Password</label>
                    <div class="input-wrap">
                        <i class="fa-solid fa-lock"></i>
                        <input type="password" id="password" name="password" placeholder="••••••••" required>
                    </div>
                </div>

                <button type="submit" class="btn-login">
                    <span>Masuk Sekarang</span> <i class="fa-solid fa-arrow-right"></i>
                </button>
            </form>
        </div>
    </div>

</body>

</html>

```