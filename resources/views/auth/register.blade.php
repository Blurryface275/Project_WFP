<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - VitaGuard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4f6f9;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .register-card {
            width: 100%;
            max-width: 450px;
            padding: 2rem;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            background: white;
        }
        .brand {
            font-size: 1.5rem;
            font-weight: 700;
            color: #0d6efd;
            text-align: center;
            margin-bottom: 2rem;
        }
    </style>
</head>
<body>

<div class="register-card">
    <div class="brand">VitaGuard</div>
    <h5 class="text-center mb-4">Buat Akun Member</h5>
    
    <form action="{{ url('/register') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label class="form-label">Nama Lengkap</label>
            <input type="text" name="name" class="form-control" placeholder="Nama Anda" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" placeholder="user@vitaguard.com" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Password</label>
            <input type="password" name="password" class="form-control" placeholder="Minimal 8 Karakter" required>
        </div>
        <button type="submit" class="btn btn-primary w-100 mb-3">Register</button>
        <div class="text-center">
            <small>Sudah punya akun? <a href="{{ route('login') }}">Login di sini</a></small>
        </div>
    </form>
</div>

</body>
</html>
