<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VitaGuard - Selamat Datang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap"
        rel="stylesheet">
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .hero-card {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(10px);
            border-radius: 30px;
            padding: 60px;
            text-align: center;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.05);
            max-width: 600px;
            border: 1px solid white;
        }

        .app-logo {
            font-size: 3rem;
            font-weight: 800;
            color: #0d6efd;
            margin-bottom: 10px;
        }

        .btn-auth {
            padding: 14px 40px;
            border-radius: 15px;
            font-weight: 700;
            transition: all 0.3s ease;
            width: 100%;
        }

        .btn-login {
            background-color: #0d6efd;
            color: white;
            border: none;
        }

        .btn-login:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(13, 110, 253, 0.2);
        }

        .btn-register {
            background-color: white;
            color: #0d6efd;
            border: 2px solid #0d6efd;
        }

        .btn-register:hover {
            background-color: #f1f5f9;
            transform: translateY(-3px);
        }
    </style>
</head>

<body>

    <div class="hero-card">
        <div class="app-logo">VitaGuard</div>
        <p class="text-muted fs-5 mb-5">Platform Layanan Kesehatan Digital untuk Anda & Keluarga.</p>

        <div class="d-grid gap-3 col-md-8 mx-auto">
            <a href="{{ route('login') }}" class="btn btn-auth btn-login">Login Sekarang</a>
            <a href="{{ route('register') }}" class="btn btn-auth btn-register">Daftar Member</a>
        </div>

        <div class="mt-5 text-muted small">
            &copy; Created by Kelompok BBM 20 Hari.
        </div>
    </div>

</body>

</html>