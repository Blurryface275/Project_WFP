@extends('layout.app')

@section('title', 'VitaGuard - Detail Dokter')

@push('styles')
<style>
    .detail-card {
        background: white;
        border-radius: 15px;
        border: none;
        overflow: hidden;
    }

    .img-doctor {
        width: 100%;
        max-width: 320px;
        border-radius: 12px;
        object-fit: cover;
    }

    .btn-back {
        color: #007bff;
        text-decoration: none;
        font-weight: 500;
        display: inline-block;
        margin-bottom: 20px;
        transition: 0.3s;
    }

    .btn-back:hover {
        color: #0056b3;
        text-decoration: underline;
    }

    .label-info {
        color: #888;
        font-size: 0.85rem;
        margin-bottom: 2px;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .value-info {
        font-weight: 600;
        color: #333;
        margin-bottom: 20px;
        font-size: 1.1rem;
    }

    .doctor-header {
        border-bottom: 2px solid #f0f0f0;
        margin-bottom: 25px;
        padding-bottom: 15px;
    }

    .section-detail {
        padding: 80px 0;
        background: #f8f9fa;
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
                    <span class="text-white">Professional Staff</span>
                    <h1 class="text-capitalize mb-5 text-lg">Detail Dokter</h1>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="section-detail">
    <div class="container">
        <a href="{{ route('doctors.index') }}" class="btn-back">
            <i class="icofont-arrow-left"></i> Kembali ke Daftar Dokter
        </a>

        <div class="card detail-card shadow-sm p-5">
            <div class="row">
                <div class="col-md-4 text-center mb-4 mb-md-0">
                    @if($doctor->user && $doctor->user->photo)
                        <img src="{{ asset('storage/' . $doctor->user->photo) }}" class="img-doctor shadow"
                            alt="Foto {{ $doctor->name }}">
                    @else
                        <img src="https://ui-avatars.com/api/?name={{ urlencode($doctor->name) }}&size=320&background=e7f1ff&color=0d6efd"
                            class="img-doctor shadow">
                    @endif
                </div>

                <div class="col-md-8">
                    <div class="doctor-header">
                        <h2 class="fw-bold mb-1" style="font-weight: 700; color: #222;">{{ $doctor->name }}</h2>
                        <p class="text-primary fs-5 mb-0" style="font-size: 1.25rem; font-weight: 500;">
                            {{ $doctor->specialization }}
                        </p>
                    </div>

                    <div class="row mt-4">
                        <div class="col-sm-6">
                            <p class="label-info"><i class="icofont-badge mr-2"></i>Pengalaman Kerja</p>
                            <p class="value-info">{{ $doctor->experience_years }} Tahun</p>

                            <p class="label-info"><i class="icofont-phone mr-2"></i>Nomor Telepon</p>
                            <p class="value-info">{{ $doctor->phone_number }}</p>
                        </div>
                        <div class="col-sm-6">
                            <p class="label-info"><i class="icofont-email mr-2"></i>Email Resmi</p>
                            <p class="value-info">{{ $doctor->email ?? ($doctor->user->email ?? '-') }}</p>

                            <p class="label-info"><i class="icofont-hospital mr-2"></i>Lokasi Praktik</p>
                            <p class="value-info">RS VitaGuard Utama</p>
                        </div>
                    </div>

                    <hr class="my-4">

                    <div class="mt-4 d-flex flex-wrap gap-3">
                        <a href="{{ route('doctors.book', $doctor->id) }}" class="btn btn-main btn-round-full mr-3">Mulai Konsultasi <i class="icofont-simple-right ml-2"></i></a>
                        <a href="{{ route('doctors.schedule') }}" class="btn btn-outline-primary btn-round-full px-4" style="border-radius: 50px; font-weight: 600; padding: 12px 30px;">Lihat Jadwal Praktik</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection