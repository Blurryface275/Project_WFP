<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VitaGuard - List Dokter</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #fcfcfc; }
        .sidebar-filter { background: white; border-radius: 8px; border: 1px solid #eee; padding: 20px; }
        .doctor-card { background: white; border-bottom: 1px solid #eee; padding: 20px 0; }
        .doctor-img { width: 100px; height: 100px; object-fit: cover; border-radius: 8px; }
        .btn-booking { background-color: #1e6fe9; color: white; font-weight: bold; border-radius: 5px; }
        .btn-booking:hover { background-color: #1856c2; color: white; }
    </style>
</head>
<body>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-3">
            <div class="sidebar-filter shadow-sm">
                <h6 class="fw-bold">Lokasi</h6>
                <div class="form-check">
                    <input class="form-check-input" type="radio" checked>
                    <label class="form-check-label">Semua Lokasi</label>
                </div>
                <hr>
                <h6 class="fw-bold">Provinsi</h6>
                <div class="small">
                    <div class="form-check"><input class="form-check-input" type="checkbox"><label>Jakarta</label></div>
                    <div class="form-check"><input class="form-check-input" type="checkbox"><label>Jawa Barat</label></div>
                </div>
            </div>
        </div>

        <div class="col-md-9">
            <h4 class="fw-bold">Hasil Pencarian Dokter</h4>
            <p class="text-muted">Menampilkan {{ $doctors->count() }} dokter tersedia</p>

            @foreach($doctors as $doctor)
            <div class="doctor-card">
                <div class="row align-items-center">
                    <div class="col-auto">
                        @if($doctor->photo)
                            <img src="{{ asset('storage/'.$doctor->photo) }}" class="doctor-img">
                        @else
                            <img src="https://ui-avatars.com/api/?name={{ urlencode($doctor->name) }}&background=e7f1ff&color=0d6efd" class="doctor-img">
                        @endif
                    </div>
                    <div class="col">
                        <h5 class="fw-bold mb-0">{{ $doctor->name }}</h5>
                        <p class="text-primary mb-1">{{ $doctor->specialization }}</p>
                        <p class="text-muted small mb-0">RS VitaGuard - {{ $doctor->experience_years }} Tahun Pengalaman</p>
                    </div>
                    <div class="col-auto">
                        <a href="{{ route('doctors.show', $doctor->id) }}" class="btn btn-booking">
                            Buat janji
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

</body>
</html>