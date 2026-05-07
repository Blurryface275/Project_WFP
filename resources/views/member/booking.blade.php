@extends('layout.app')

@section('title', 'VitaGuard - Booking Konsultasi')

@push('styles')
<style>
    .booking-form-card {
        background: #fff;
        border-radius: 20px;
        border: none;
        overflow: hidden;
    }

    .doctor-sidebar {
        background: #f8f9fa;
        border-radius: 15px;
        padding: 30px;
    }

    .img-doctor-sm {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        object-fit: cover;
        margin-bottom: 15px;
    }

    .form-label {
        font-weight: 600;
        color: #444;
        margin-bottom: 8px;
    }

    .form-control, .form-select {
        border-radius: 10px;
        padding: 12px 15px;
        border: 1px solid #e1e1e1;
    }

    .form-control:focus {
        box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.1);
        border-color: #0d6efd;
    }

    .btn-booking {
        padding: 15px 30px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
        border-radius: 50px;
    }

    .section-booking {
        padding: 100px 0;
        background: #eff2f7;
    }

    .schedule-badge {
        font-size: 0.75rem;
        padding: 5px 10px;
        border-radius: 5px;
        background: #e7f1ff;
        color: #0d6efd;
        display: inline-block;
        margin-right: 5px;
        margin-bottom: 5px;
    }
</style>
@endpush

@section('content')
<section class="page-title bg-1">
    <div class="overlay"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="block text-center">
                    <span class="text-white">Booking Appointment</span>
                    <h1 class="text-capitalize mb-5 text-lg">Buat Janji Konsultasi</h1>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="section-booking">
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <div class="doctor-sidebar shadow-sm text-center">
                    @if($doctor->user && $doctor->user->photo)
                        <img src="{{ asset('storage/' . $doctor->user->photo) }}" class="img-doctor-sm shadow-sm" alt="{{ $doctor->name }}">
                    @else
                        <img src="https://ui-avatars.com/api/?name={{ urlencode($doctor->name) }}&size=100&background=0d6efd&color=fff" class="img-doctor-sm shadow-sm">
                    @endif
                    
                    <h4 class="mb-1 font-weight-bold">{{ $doctor->name }}</h4>
                    <p class="text-primary mb-3">{{ $doctor->specialization }}</p>
                    
                    <div class="text-left mt-4">
                        <h6 class="font-weight-bold mb-2">Jadwal Praktik:</h6>
                        @forelse($doctor->schedules as $schedule)
                            <span class="schedule-badge">
                                {{ ucfirst($schedule->day) }}: {{ $schedule->start_time }} - {{ $schedule->end_time }}
                            </span>
                        @empty
                            <p class="text-muted small">Jadwal belum tersedia</p>
                        @endforelse
                    </div>
                </div>
            </div>

            <div class="col-lg-8">
                <div class="card booking-form-card shadow-sm p-4 p-md-5">
                    <form action="{{ route('bookings.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="doctor_id" value="{{ $doctor->id }}">
                        
                        <div class="row">
                            <div class="col-md-12 mb-4">
                                <label class="form-label">Pilih Layanan Konsultasi</label>
                                <select name="service_id" class="form-select w-100 @error('service_id') is-invalid @enderror" required>
                                    <option value="" selected disabled>Pilih Jenis Konsultasi</option>
                                    @foreach($services as $service)
                                        <option value="{{ $service->id }}">{{ $service->service_name }} - Rp {{ number_format($service->price, 0, ',', '.') }}</option>
                                    @endforeach
                                </select>
                                @error('service_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-4">
                                <label class="form-label">Pilih Tanggal</label>
                                <input type="date" name="date" class="form-control @error('date') is-invalid @enderror" 
                                    min="{{ date('Y-m-d') }}" required>
                                @error('date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-4">
                                <label class="form-label">Tipe Konsultasi</label>
                                <select name="transaction_type" class="form-select w-100">
                                    <option value="consultation">Konsultasi Chat</option>
                                    <option value="appointment">Janji Temu (Offline)</option>
                                </select>
                            </div>

                            <div class="col-md-12 mb-4">
                                <label class="form-label">Catatan Keluhan (Opsional)</label>
                                <textarea name="notes" class="form-control" rows="4" placeholder="Jelaskan keluhan Anda secara singkat..."></textarea>
                            </div>

                            <div class="col-md-12">
                                <button type="submit" class="btn btn-main btn-round-full btn-block btn-booking">
                                    Konfirmasi & Buat Janji <i class="icofont-simple-right ml-2"></i>
                                </button>
                                <p class="text-center mt-3 text-muted small">
                                    <i class="icofont-info-circle mr-1"></i> Pembayaran akan dilakukan setelah konfirmasi.
                                </p>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
