<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Verifikasi Email - VitaGuard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>body { background-color: #f4f6f9; padding-top: 10vh; }</style>
</head>
<body>
<div class="container d-flex justify-content-center">
    <div class="card p-4 shadow-sm text-center" style="max-width: 500px; border-radius: 12px;">
        <h4 class="mb-3">Verifikasi Email Anda</h4>
        <p class="text-muted mb-4">Terima kasih telah mendaftar! Sebelum bisa mengakses fitur, mohon periksa email Anda dan klik link verifikasi yang telah dikirimkan.</p>
        
        @if (session('status') == 'verification-link-sent')
            <div class="alert alert-success">Link verifikasi baru telah dikirim ke alamat email Anda.</div>
        @endif

        <div class="d-flex justify-content-between align-items-center mt-3">
            <form method="POST" action="{{ route('verification.send') }}" class="m-0">
                @csrf <button type="submit" class="btn btn-primary">Kirim Ulang Link</button>
            </form>
            <form method="GET" action="{{ route('logout') }}" class="m-0">
                @csrf <button type="submit" class="btn btn-link text-muted">Logout</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>