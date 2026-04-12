<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VitaGuard - Menu Utama</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #f8fafc;
        }

        .navbar {
            background: white;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .welcome-section {
            background: linear-gradient(135deg, #0d6efd 0%, #004bb5 100%);
            color: white;
            border-radius: 20px;
            padding: 40px;
            margin-top: 30px;
        }

        .feature-card {
            border: none;
            border-radius: 20px;
            transition: all 0.3s ease;
            height: 100%;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.02);
        }

        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
        }

        .icon-box {
            width: 60px;
            height: 60px;
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            margin-bottom: 20px;
        }

        .bg-soft-primary {
            background: #e7f1ff;
            color: #0d6efd;
        }

        .bg-soft-success {
            background: #e6fcf5;
            color: #0ca678;
        }

        .bg-soft-warning {
            background: #fff9db;
            color: #f08c00;
        }

        .bg-soft-info {
            background: #e3fafc;
            color: #1098ad;
        }

        .logout-btn {
            color: #dc3545;
            font-weight: 600;
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg py-3">
        <div class="container">
            <a class="navbar-brand fw-bold text-primary fs-4" href="#">VitaGuard</a>
            <div class="d-flex align-items-center">
                <span class="me-3 d-none d-md-inline text-muted">Halo, <strong>{{ Auth::user()->name }}</strong></span>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-outline-danger btn-sm px-3 rounded-pill">Logout</button>
                </form>
            </div>
        </div>
    </nav>

    <div class="container">
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show rounded-4 border-0 mt-3" role="alert">
                <i class="bi bi-exclamation-octagon-fill me-2"></i> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show rounded-4 border-0 mt-3" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="welcome-section shadow-lg">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h1 class="fw-bold mb-2">Selamat Datang di VitaGuard!</h1>
                    <p class="opacity-75 fs-5">Layanan kesehatan digital dalam genggaman Anda. Pilih layanan yang Anda
                        butuhkan hari ini.</p>
                </div>
                <div class="col-md-4 text-center d-none d-md-block">
                    <i class="bi bi-heart-pulse-fill" style="font-size: 80px; opacity: 0.3;"></i>
                </div>
            </div>
        </div>

        <div class="row mt-5 g-4 py-3">
            <!-- Fitur 3: Direktori Dokter -->
            <div class="col-md-6 col-lg-3">
                <a href="{{ route('doctors.index') }}" class="text-decoration-none">
                    <div class="card feature-card p-4">
                        <div class="icon-box bg-soft-primary">
                            <i class="bi bi-person-badge"></i>
                        </div>
                        <h5 class="fw-bold text-dark">Direktori Dokter</h5>
                        <p class="text-muted small">Temukan dokter spesialis terbaik untuk konsultasi Anda.</p>
                    </div>
                </a>
            </div>

            <!-- Fitur 4: Konsultasi Online -->
            <div class="col-md-6 col-lg-3">
                <a href="#" class="text-decoration-none">
                    <div class="card feature-card p-4">
                        <div class="icon-box bg-soft-success">
                            <i class="bi bi-chat-dots"></i>
                        </div>
                        <h5 class="fw-bold text-dark">Konsultasi Online</h5>
                        <p class="text-muted small">Chat langsung dengan tenaga medis kapan saja dan di mana saja.</p>
                    </div>
                </a>
            </div>

            <!-- Fitur 2: Artikel Kesehatan -->
            <div class="col-md-6 col-lg-3">
                <a href="#" class="text-decoration-none">
                    <div class="card feature-card p-4">
                        <div class="icon-box bg-soft-warning">
                            <i class="bi bi-journal-text"></i>
                        </div>
                        <h5 class="fw-bold text-dark">Artikel Kesehatan</h5>
                        <p class="text-muted small">Baca tips dan informasi kesehatan terbaru dari sumber ahli.</p>
                    </div>
                </a>
            </div>

            <!-- Fitur 6: Riwayat Konsultasi -->
            <div class="col-md-6 col-lg-3">
                <a href="#" class="text-decoration-none">
                    <div class="card feature-card p-4">
                        <div class="icon-box bg-soft-info">
                            <i class="bi bi-clock-history"></i>
                        </div>
                        <h5 class="fw-bold text-dark">Riwayat</h5>
                        <p class="text-muted small">Lihat kembali catatan dan jadwal konsultasi yang pernah Anda buat.
                        </p>
                    </div>
                </a>
            </div>
        </div>
    </div>

    <footer class="text-center py-5 text-muted small">
        <p>&copy; Created by Kelompok BBM 20 Hari.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>