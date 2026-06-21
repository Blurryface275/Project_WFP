<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - VitaGuard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
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
        img{
            width: 75%;
            height: auto;
            display: block;
            margin: 0;
            margin-left: 12.5%;
            margin-right: 12.5%;
        }
    </style>
</head>
<body>

<div class="register-card">
    <img src="{{ asset('images/logo-vitaguard-transparent.png') }}" alt="logo-vitaguard-transparent">
    <h5 class="text-center mb-4">Buat Akun Member</h5>
    
    <form action="{{ url('/register') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label class="form-label">Nama Lengkap</label>
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" 
                    placeholder="Nama Anda" required value="{{ old('name') }}">
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" 
                    placeholder="user@vitaguard.com" required value="{{ old('email') }}">
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Password</label>
            <div class="input-group">
            <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror" 
                    placeholder="Minimal 8 Karakter" required>
                      <span class="input-group-text password-toggle" onclick="togglePassword('password', 'icon-pass')">
                          <i class="bi bi-eye-slash" id="icon-pass"></i>
                      </span>
                         @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            </div>
         
        </div>
        <div class="mb-4">
            <label class="form-label">Konfirmasi Password</label>
            <div class="input-group">
            <input type="password" id="password_confirmation" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" 
                    placeholder="Minimal 8 Karakter" required>
                      <span class="input-group-text password-toggle" onclick="togglePassword('password_confirmation', 'icon-pass-confirm')">
                          <i class="bi bi-eye-slash" id="icon-pass-confirm"></i>
                      </span>
                      @error('password_confirmation')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            </div>
            
        </div>
        <button type="submit" class="btn btn-primary w-100 mb-3">Daftar</button>
        <div class="text-center">
            <small>Sudah punya akun? <a href="{{ route('login') }}">Login di sini</a></small>
        </div>
    </form>
</div>

<!-- Script Logika Toggle Ikon Mata -->
<script>
    function togglePassword(inputId, iconId) {
        let input = document.getElementById(inputId);
        let icon = document.getElementById(iconId);
        
        if (input.type === "password") {
            input.type = "text";
            icon.classList.remove("bi-eye-slash");
            icon.classList.add("bi-eye");
        } else {
            input.type = "password";
            icon.classList.remove("bi-eye");
            icon.classList.add("bi-eye-slash");
        }
    }
</script>


</body>
</html>
