@extends('layouts.member-app')
@section('title', 'Booking Saya - VitaGuard')

@push('styles')
<style>
    :root {
        --vg-blue: #007bff;
        --vg-dark: #0056b3;
        --vg-soft: #e7f1ff;
    }

    .booking-header {
        background: linear-gradient(135deg, var(--vg-blue), var(--vg-dark));
        color: white;
        padding: 40px 0;
        margin-bottom: 30px;
        border-radius: 0 0 30px 30px;
    }

    .booking-card {
        background: white;
        border: none;
        border-radius: 14px;
        transition: transform 0.15s ease;
        overflow: hidden;
    }

    .booking-card:hover {
        transform: translateY(-3px);
    }

    .booking-card .doctor-photo {
        width: 56px;
        height: 56px;
        border-radius: 50%;
        object-fit: cover;
        border: 2px solid var(--vg-soft);
    }

    .badge-pending {
        background: #fff3cd;
        color: #856404;
        font-weight: 600;
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 0.8rem;
    }

    .badge-completed {
        background: #d4edda;
        color: #155724;
        font-weight: 600;
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 0.8rem;
    }

    .badge-cancelled {
        background: #f8d7da;
        color: #721c24;
        font-weight: 600;
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 0.8rem;
    }

    .schedule-info {
        font-size: 0.85rem;
        color: #666;
    }

    .empty-state {
        padding: 60px 20px;
        text-align: center;
    }

    .empty-state i {
        font-size: 3rem;
        color: #dee2e6;
    }
</style>
@endpush

@section('content')
<div class="booking-header shadow">
    <div class="container text-center">
        <h2 class="fw-bold">Booking Saya</h2>
        <p class="opacity-75">Kelola jadwal konsultasi Anda dengan dokter</p>
    </div>
</div>

<div class="container mb-5">

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
    @endif

    <div class="row justify-content-center">
        <div class="col-lg-10">

            @if($bookings->isEmpty())
                <div class="card booking-card shadow-sm">
                    <div class="card-body empty-state">
                        <i class="icofont-calendar"></i>
                        <h5 class="mt-3 text-muted">Belum Ada Booking</h5>
                        <p class="text-muted">Anda belum memiliki jadwal konsultasi. Mulai dengan memilih dokter.</p>
                        <a href="{{ route('doctors.index') }}" class="btn btn-primary mt-2" style="border-radius: 10px; padding: 10px 30px;">
                            <i class="icofont-user-alt-4 mr-1"></i> Cari Dokter
                        </a>
                    </div>
                </div>
            @else
                @foreach($bookings as $booking)
                <div class="card booking-card shadow-sm mb-3">
                    <div class="card-body p-4">
                        <div class="row align-items-center">
                            {{-- Foto + Info Dokter --}}
                            <div class="col-md-5 d-flex align-items-center mb-3 mb-md-0">
                                @if($booking->doctor && $booking->doctor->user && $booking->doctor->user->photo)
                                    <img src="{{ asset('storage/' . $booking->doctor->user->photo) }}" class="doctor-photo mr-3" alt="{{ $booking->doctor->name }}">
                                @else
                                    <img src="https://ui-avatars.com/api/?name={{ urlencode($booking->doctor->name ?? 'D') }}&size=112&background=e7f1ff&color=0d6efd" class="doctor-photo mr-3">
                                @endif
                                <div>
                                    <h6 class="fw-bold mb-1">{{ $booking->doctor->name ?? 'Dokter' }}</h6>
                                    <span class="text-primary small">{{ $booking->doctor->specialization ?? '-' }}</span>
                                </div>
                            </div>

                            {{-- Jadwal --}}
                            <div class="col-md-3 mb-3 mb-md-0">
                                <div class="schedule-info">
                                    <div><i class="icofont-calendar mr-1"></i>
                                        {{ $booking->schedule_date ? \Carbon\Carbon::parse($booking->schedule_date)->translatedFormat('d M Y') : $booking->date }}
                                    </div>
                                    <div class="mt-1"><i class="icofont-clock-time mr-1"></i> {{ $booking->schedule_time ?? '-' }}</div>
                                </div>
                            </div>

                            {{-- Status --}}
                            <div class="col-md-2 mb-3 mb-md-0 text-center">
                                @if($booking->status === 'pending')
                                    <span class="badge-pending">Menunggu</span>
                                @elseif($booking->status === 'completed')
                                    <span class="badge-completed">Selesai</span>
                                @elseif($booking->status === 'cancelled')
                                    <span class="badge-cancelled">Dibatalkan</span>
                                @endif
                            </div>

                            {{-- Aksi --}}
                            <div class="col-md-2 text-right">
                                <a href="{{ route('bookings.show', $booking->id) }}" class="btn btn-sm btn-outline-primary mb-1" style="border-radius: 8px;">
                                    Detail
                                </a>
                                @if($booking->status === 'pending')
                                    <form action="{{ route('consultations.store') }}" method="POST" class="d-inline">
                                        @csrf
                                        <input type="hidden" name="doctor_id" value="{{ $booking->doctor_id }}">
                                        <button type="submit" class="btn btn-sm btn-primary mb-1" style="border-radius: 8px;">
                                            <i class="icofont-chat"></i> Chat
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            @endif

        </div>
    </div>
</div>
@endsection
