<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VitaGuard - Booking Konsultasi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap"
        rel="stylesheet">
    <style>
        :root {
            --vg-primary: #0d6efd;
            --vg-bg: #f8fafc;
            --vg-card-bg: #ffffff;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--vg-bg);
            color: #1e293b;
        }

        .container {
            max-width: 900px;
        }

        .glass-card {
            background: var(--vg-card-bg);
            border: 1px solid rgba(255, 255, 255, 0.4);
            border-radius: 20px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
            overflow: hidden;
        }

        .doctor-preview {
            background: linear-gradient(135deg, #0d6efd 0%, #004bb5 100%);
            color: white;
            padding: 40px;
            text-align: center;
        }

        .doctor-img {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            border: 4px solid rgba(255, 255, 255, 0.3);
            object-fit: cover;
            margin-bottom: 20px;
        }

        .form-section {
            padding: 40px;
        }

        .form-label {
            font-weight: 600;
            color: #475569;
            margin-bottom: 8px;
        }

        .form-control,
        .form-select {
            border-radius: 10px;
            padding: 12px 16px;
            border: 1px solid #e2e8f0;
            background-color: #f1f5f9;
        }

        .form-control:focus,
        .form-select:focus {
            box-shadow: 0 0 0 4px rgba(13, 110, 253, 0.1);
            border-color: var(--vg-primary);
        }

        .btn-confirm {
            background: var(--vg-primary);
            color: white;
            border-radius: 12px;
            padding: 14px;
            font-weight: 700;
            width: 100%;
            border: none;
            transition: all 0.3s ease;
            margin-top: 20px;
        }

        .btn-confirm:hover {
            background: #0056b3;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(13, 110, 253, 0.3);
        }

        .price-badge {
            background: #eef2ff;
            color: #4338ca;
            padding: 4px 12px;
            border-radius: 20px;
            font-weight: 600;
            font-size: 0.85rem;
        }
    </style>
</head>

<body>

    <div class="container py-5">
        <div class="mb-4">
            <a href="{{ route('doctors.show', $doctor->id) }}" class="text-decoration-none text-muted">
                &larr; Kembali ke Profil Dokter
            </a>
        </div>

        <div class="glass-card">
            <div class="row g-0">
                <div class="col-md-4 doctor-preview">
                    @if($doctor->photo)
                        <img src="{{ asset('storage/' . $doctor->photo) }}" class="doctor-img shadow-sm">
                    @else
                        <img src="https://ui-avatars.com/api/?name={{ urlencode($doctor->name) }}&size=200&background=fff&color=0d6efd"
                            class="doctor-img shadow-sm">
                    @endif
                    <h4 class="fw-bold mb-1">{{ $doctor->name }}</h4>
                    <p class="opacity-75 mb-0">{{ $doctor->specialization }}</p>
                    <div class="mt-3">
                        <span class="badge bg-light text-primary">{{ $doctor->experience_years }} Pengalaman</span>
                    </div>
                </div>

                <div class="col-md-8">
                    <div class="form-section">
                        <h3 class="fw-bold mb-4">Pesan Jadwal Konsultasi</h3>

                        <form action="{{ route('booking.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="doctor_id" value="{{ $doctor->id }}">

                            <div class="mb-3">
                                <label class="form-label">Jenis Layanan</label>
                                <select name="service_id" class="form-select @error('service_id') is-invalid @enderror"
                                    required>
                                    <option value="" disabled selected>Pilih layanan...</option>
                                    @foreach($services as $service)
                                        <option value="{{ $service->id }}" {{ old('service_id') == $service->id ? 'selected' : '' }}>
                                            {{ $service->service_name }} - Rp
                                            {{ number_format($service->price, 0, ',', '.') }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('service_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Tanggal Konsultasi</label>
                                <input type="date" name="date" class="form-control @error('date') is-invalid @enderror"
                                    value="{{ old('date') }}" required min="{{ date('Y-m-d') }}">
                                @error('date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Metode Pembayaran</label>
                                <select name="payment_method"
                                    class="form-select @error('payment_method') is-invalid @enderror" required>
                                    <option value="Transfer Bank" selected>Transfer Bank</option>
                                    <option value="E-Wallet">E-Wallet (OVO, Dana, GoPay)</option>
                                    <option value="Kredit">Kartu Kredit/Debit</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Catatan Tambahan (Optional)</label>
                                <textarea name="notes" class="form-control" rows="3"
                                    placeholder="Ceritakan sedikit keluhan Anda..."></textarea>
                            </div>

                            <button type="submit" class="btn-confirm">Konfirmasi & Pesan Sekarang</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="text-center mt-4 text-muted small">
            <p>&copy; 2026 VitaGuard Health Service. Semua data Anda terlindungi dalam enkripsi medis.</p>
        </div>
    </div>

</body>

</html>