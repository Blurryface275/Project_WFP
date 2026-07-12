@extends('layouts.member-app')

@push('styles')
<style>
:root {
            --primary-blue: #007bff;
            --dark-blue: #0056b3;
            --soft-blue: #e7f1ff;
            --text-gray: #6c757d;
        }

        body { background-color: #f8f9fa; font-family: 'Inter', sans-serif; }

        .header-section {
            background: linear-gradient(135deg, var(--primary-blue), var(--dark-blue));
            color: white;
            padding: 40px 0;
            margin-bottom: 30px;
            border-radius: 0 0 30px 30px;
        }

        .doctor-card {
            background: white;
            border: none;
            border-radius: 15px;
            transition: transform 0.2s;
            overflow: hidden;
        }

        .doctor-card:hover { transform: translateY(-5px); }

        .img-container {
            width: 120px;
            height: 120px;
            overflow: hidden;
            border-radius: 50%;
            border: 4px solid var(--soft-blue);
        }

        .doctor-img { width: 100%; height: 100%; object-fit: cover; }

        .badge-specialist {
            background-color: var(--soft-blue);
            color: var(--primary-blue);
            font-weight: 600;
            font-size: 0.85rem;
            padding: 5px 12px;
            border-radius: 20px;
        }

        .schedule-box {
            background-color: #fcfcfc;
            border: 1px dashed #dee2e6;
            border-radius: 10px;
            padding: 10px;
        }

        .day-label {
            text-transform: capitalize;
            font-weight: bold;
            color: var(--dark-blue);
            font-size: 0.9rem;
        }

        .time-label { font-size: 0.85rem; color: var(--text-gray); }

        .btn-book {
            background-color: var(--primary-blue);
            color: white;
            border-radius: 10px;
            font-weight: 600;
            padding: 10px 25px;
            border: none;
        }

        .btn-book:hover { background-color: var(--dark-blue); color: white; }

        .status-tag { font-size: 0.75rem; padding: 2px 8px; border-radius: 5px; }
</style>
@endpush

@section('content')
<div class="header-section shadow">
    <div class="container text-center">
        <h2 class="fw-bold">Jadwal Praktik Dokter</h2>
        <p class="opacity-75">Temukan jadwal spesialis terbaik untuk kesehatan Anda</p>
    </div>
</div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-10">

            @foreach($doctors as $doctor)
            <div class="card doctor-card shadow-sm mb-4">
                <div class="card-body p-4">
                    <div class="row align-items-center">
                        <div class="col-md-2 text-center mb-3 mb-md-0">
                            <div class="img-container mx-auto">
                               <img src="{{ asset('storage/' . $doctor->user->photo) }}"
                                    class="doctor-img"
                                    alt="{{ $doctor->name }}"
                                    onerror="this.onerror=null; this.src='{{ asset('images/no-image.png') }}'">
                            </div>
                        </div>

                        <div class="col-md-5">
                            <span class="badge-specialist mb-2 d-inline-block">{{ $doctor->specialization }}</span>
                            <h4 class="fw-bold mb-1">{{ $doctor->name }}</h4>
                            <p class="text-muted small">
                                <i class="bi bi-handbag-fill me-1"></i> {{ $doctor->experience_years }} Pengalaman
                            </p>
                            <div class="d-flex align-items-center mt-2">
                                <i class="bi bi-geo-alt-fill text-danger me-2"></i>
                                <span class="small fw-semibold">RS VitaGuard Utama</span>
                            </div>
                        </div>

                        <div class="col-md-5">
                            <h6 class="fw-bold mb-3"><i class="bi bi-calendar3 me-2 text-primary"></i>Jadwal Tersedia:</h6>
                            <div class="row g-2">
                                @forelse($doctor->schedules->where('is_available', true) as $sch)
                                    <div class="col-6">
                                        <div class="schedule-box text-center">
                                            <div class="day-label">{{ $sch->day }}</div>
                                            <div class="time-label">{{ date('H:i', strtotime($sch->start_time)) }} - {{ date('H:i', strtotime($sch->end_time)) }}</div>
                                        </div>
                                    </div>
                                @empty
                                    <div class="col-12 text-muted small">Tidak ada jadwal aktif minggu ini.</div>
                                @endforelse
                            </div>

                            <div class="mt-4 d-grid">
                                @auth
                                    @if(Auth::user()->role === 'member')
                                    <a href="{{ route('bookings.create', $doctor->id) }}" class="btn btn-book">
                                        Buat Janji Konsultasi
                                    </a>
                                    @else
                                    <a href="{{ route('doctors.show', $doctor->id) }}" class="btn btn-book">
                                        Lihat Detail
                                    </a>
                                    @endif
                                @else
                                    <a href="{{ route('login') }}" class="btn btn-book">
                                        Login untuk Booking
                                    </a>
                                @endauth
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach

        </div>
    </div>
</div>
@endsection
