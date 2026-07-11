<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password - VitaGuard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>body { background-color: #f4f6f9; height: 100vh; display: flex; align-items: center; justify-content: center; }</style>
</head>
<body>
<div class="card p-4 shadow-sm" style="max-width: 400px; width:100%; border-radius: 12px;">
    <h5 class="text-center mb-4">Buat Kata Sandi Baru</h5>
    @if($errors->any()) <div class="alert alert-danger px-3">{{ $errors->first() }}</div> @endif

    <form action="{{ route('password.update') }}" method="POST">
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">
        <div class="mb-3">
            <input type="email" name="email" class="form-control" value="{{ old('email', $email) }}" required readonly>
        </div>
        <div class="mb-3">
            <input type="password" name="password" class="form-control" placeholder="Password Baru" required>
        </div>
        <div class="mb-4">
            <input type="password" name="password_confirmation" class="form-control" placeholder="Konfirmasi Password" required>
        </div>
        <button type="submit" class="btn btn-primary w-100">Simpan Password Baru</button>
    </form>
</div>
</body>
</html>