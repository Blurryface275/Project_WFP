<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Password - VitaGuard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>body { background-color: #f4f6f9; height: 100vh; display: flex; align-items: center; justify-content: center; }</style>
</head>
<body>
<div class="card p-4 shadow-sm" style="max-width: 400px; width:100%; border-radius: 12px;">
    <h5 class="text-center mb-3">Lupa Kata Sandi</h5>
    <p class="text-muted text-center" style="font-size: 0.9rem;">Masukkan email Anda, kami akan mengirimkan link reset password.</p>
    
    @if(session('status')) <div class="alert alert-success">{{ session('status') }}</div> @endif
    @if($errors->any()) <div class="alert alert-danger px-3">{{ $errors->first() }}</div> @endif

    <form action="{{ route('password.email') }}" method="POST">
        @csrf
        <div class="mb-3">
            <input type="email" name="email" class="form-control" placeholder="Email Anda" required>
        </div>
        <button type="submit" class="btn btn-primary w-100 mb-2">Kirim Link Reset</button>
        <div class="text-center"><a href="{{ route('login') }}" class="text-decoration-none">Kembali ke Login</a></div>
    </form>
</div>
</body>
</html>