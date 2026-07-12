@extends('layouts.member-app')
@section('title', 'Detail Booking - VitaGuard')

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

    .detail-card {
        background: white;
        border-radius: 16px;
        border: none;
    }

    .detail-card .img-circle {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        object-fit: cover;
        border: 4px solid var(--vg-soft);
    }

    .info-label {
        color: #888;
        font-size: 0.85rem;
        margin-bottom: 2px;
    }

    .info-value {
        font-weight: 600;
        color: #333;
        margin-bottom: 16px;
    }

    .status-badge {
        padding: 8px 20px;
        border-radius: 25px;
        font-weight: 700;
        font-size: 0.9rem;
    }

    .status-pending { background: #fff3cd; color: #856404; }
    .status-completed { background: #d4edda; color: #155724; }
    .status-cancelled { background: #f8d7da; color: #721c24; }

    .action-section {
        background: #f8f9fa;
        border-radius: 12px;
        padding: 20px;
    }
</style>
@endpush

@section('content')
<div class="booking-header shadow">
    <div class="container text-center">
        <h2 class="fw-bold">Detail Booking</h2>
        <p class="opacity-75">Informasi lengkap pemesanan konsultasi Anda</p>
    </div>
</div>

<div class="container mb-5">
    <a href="{{ route('bookings.index') }}" class="text-decoration-none d-inline-block mb-3" style="color: var(--vg-blue); font-weight: 500;">
        &larr; Kembali ke Booking Saya
    </a>



    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card detail-card shadow-sm">
                <div class="card-body p-4">

                    {{-- Status Badge --}}
                    <div class="text-center mb-4">
                        @if($booking->status === 'pending')
                            <span class="status-badge status-pending">Menunggu Konfirmasi</span>
                        @elseif($booking->status === 'completed')
                            <span class="status-badge status-completed">Selesai</span>
                        @elseif($booking->status === 'cancelled')
                            <span class="status-badge status-cancelled">Dibatalkan</span>
                        @endif
                    </div>

                    {{-- Doctor Info --}}
                    <div class="text-center mb-4">
                        @if($booking->doctor && $booking->doctor->user && $booking->doctor->user->photo)
                            <img src="{{ asset('storage/' . $booking->doctor->user->photo) }}" class="img-circle mb-3" alt="{{ $booking->doctor->name }}">
                        @else
                            <img src="https://ui-avatars.com/api/?name={{ urlencode($booking->doctor->name ?? 'D') }}&size=200&background=e7f1ff&color=0d6efd" class="img-circle mb-3">
                        @endif
                        <h4 class="fw-bold mb-1">{{ $booking->doctor->name ?? 'Dokter' }}</h4>
                        <span class="text-primary">{{ $booking->doctor->specialization ?? '-' }}</span>
                    </div>

                    <hr>

                    {{-- Detail Booking --}}
                    <div class="row mt-4">
                        <div class="col-sm-6">
                            <p class="info-label">Tanggal Konsultasi</p>
                            <p class="info-value">
                                <i class="icofont-calendar text-primary mr-1"></i>
                                {{ $booking->schedule_date ? \Carbon\Carbon::parse($booking->schedule_date)->translatedFormat('l, d F Y') : $booking->date }}
                            </p>

                            <p class="info-label">Jam Praktik</p>
                            <p class="info-value">
                                <i class="icofont-clock-time text-primary mr-1"></i>
                                {{ $booking->schedule_time ?? '-' }}
                            </p>
                        </div>
                        <div class="col-sm-6">
                            <p class="info-label">Layanan</p>
                            <p class="info-value">{{ $booking->service->service_name ?? 'Konsultasi Online' }}</p>

                            <p class="info-label">Biaya</p>
                            <p class="info-value" style="color: var(--vg-dark); font-size: 1.1rem;">
                                Rp {{ number_format($booking->total_price, 0, ',', '.') }}
                            </p>
                        </div>
                    </div>

                    @if($booking->notes)
                        <div class="mt-2">
                            <p class="info-label">Catatan / Keluhan</p>
                            <p class="info-value" style="white-space: pre-wrap;">{{ $booking->notes }}</p>
                        </div>
                    @endif

                    <div class="mt-2">
                        <p class="info-label">Tanggal Dibuat</p>
                        <p class="info-value">{{ $booking->created_at->translatedFormat('d F Y, H:i') }} WIB</p>
                    </div>

                    {{-- Actions --}}
                    @if($booking->status === 'pending')
                    <div class="action-section mt-4">
                        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
                            <form action="{{ route('consultations.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="doctor_id" value="{{ $booking->doctor_id }}">
                                <button type="submit" class="btn btn-primary px-4" style="border-radius: 10px;">
                                    <i class="icofont-chat mr-1"></i> Mulai Konsultasi
                                </button>
                            </form>
                            <form id="cancelBookingForm" action="{{ route('bookings.destroy', $booking->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-outline-danger px-4" style="border-radius: 10px;" onclick="confirmCancelBooking()">
                                    <i class="icofont-close mr-1"></i> Batalkan Booking
                                </button>
                            </form>
                        </div>
                    </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function confirmCancelBooking() {
        Swal.fire({
            title: 'Batalkan Booking?',
            text: 'Apakah Anda yakin ingin membatalkan booking konsultasi ini?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc3545',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Ya, Batalkan',
            cancelButtonText: 'Kembali'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('cancelBookingForm').submit();
            }
        });
    }
</script>
@endpush
