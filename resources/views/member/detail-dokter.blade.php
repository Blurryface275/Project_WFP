@extends('layouts.member-app')

@push('styles')
<style>
:root {
            --vg-blue: #0d6efd;
        }

        body {
            background-color: #f8f9fa;
        }

        .detail-card {
            background: white;
            border-radius: 15px;
            border: none;
            overflow: hidden;
        }

        .img-doctor {
            width: 100%;
            max-width: 320px;
            max-height: 320px;
            border-radius: 12px;
            object-fit: cover;
        }

        .btn-back {
            color: var(--vg-blue);
            text-decoration: none;
            font-weight: 500;
            display: inline-block;
            margin-bottom: 20px;
        }

        .label-info {
            color: #888;
            font-size: 0.85rem;
            margin-bottom: 2px;
        }

        .value-info {
            font-weight: 600;
            color: #333;
            margin-bottom: 15px;
        }
</style>
@endpush

@section('content')
<div class="container mt-5">
        <a href="{{ route('doctors.index') }}" class="btn-back">
            &larr; Kembali ke Daftar Dokter
        </a>

        <div class="card detail-card shadow-sm p-4">
            <div class="row g-4">
                <div class="col-md-4 text-center">
                    @if($doctor->user && $doctor->user->photo)
                        <img src="{{ asset('storage/' . $doctor->user->photo) }}" class="img-doctor shadow-sm"
                            alt="Foto {{ $doctor->user->name }}">
                    @else
                        <img src="https://ui-avatars.com/api/?name={{ urlencode($doctor->name) }}&size=300&background=e7f1ff&color=0d6efd"
                            class="img-doctor shadow-sm">
                    @endif
                </div>

                <div class="col-md-8">
                    <h2 class="fw-bold mb-1">{{ $doctor->name }}</h2>
                    <p class="text-primary fs-5 mb-4">{{ $doctor->specialization }}</p>

                    <hr>

                    <div class="row mt-4">
                        <div class="col-sm-6">
                            <p class="label-info">Pengalaman Kerja</p>
                            <p class="value-info">{{ $doctor->experience_years }} Tahun</p>

                            <p class="label-info">Nomor Telepon</p>
                            <p class="value-info">{{ $doctor->phone_number }}</p>
                        </div>
                        <div class="col-sm-6">
                            <p class="label-info">Email</p>
                            <p class="value-info">{{ $doctor->email }}</p>

                            <p class="label-info">Rumah Sakit</p>
                            <p class="value-info">RS VitaGuard Utama</p>
                        </div>
                    </div>

                    <div class="mt-4 d-grid d-md-flex gap-2">
                        @auth
                            @if(Auth::user()->role === 'member')
                                <a href="{{ route('bookings.create', $doctor->id) }}" class="btn btn-primary px-5 py-2">
                                    <i class="icofont-calendar"></i> Booking Konsultasi
                                </a>
                                <a href="{{ route('bookings.index') }}" class="btn btn-outline-secondary px-4 py-2">
                                    <i class="icofont-list"></i> Booking Saya
                                </a>
                            @else
                                <a href="{{ route('consultations.index') }}" class="btn btn-primary px-5 py-2">
                                    <i class="icofont-chat"></i> Lihat Konsultasi
                                </a>
                            @endif
                        @else
                            <a href="{{ route('login') }}" class="btn btn-primary px-5 py-2">Login untuk Booking</a>
                        @endauth
                        <a href="{{ route('doctors.schedule') }}" class="btn btn-outline-primary px-5 py-2">Jadwal Praktik</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
