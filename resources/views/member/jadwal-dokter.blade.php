@extends('layout.app')

@section('title', 'VitaGuard - Jadwal Praktik Dokter')

@push('styles')
<style>
    body { background-color: #f4f6f9; }
    
    /* Konsistensi dengan Header Artikel/Kategori */
    .page-title.bg-1 {
        background: linear-gradient(135deg, #0056b3, #007bff);
        padding: 60px 0;
        color: white;
    }

    .doctor-card {
        background: white;
        border: none;
        border-radius: 15px;
        transition: transform 0.2s;
        overflow: hidden;
        box-shadow: 0 4px 12px rgba(0,0,0,0.05);
    }

    .doctor-card:hover { transform: translateY(-5px); }

    .img-container {
        width: 110px;
        height: 110px;
        overflow: hidden;
        border-radius: 50%;
        border: 4px solid #e7f1ff;
    }

    .doctor-img { width: 100%; height: 100%; object-fit: cover; }

    .badge-specialist {
        background-color: #e7f1ff;
        color: #007bff;
        font-weight: 600;
        font-size: 0.8rem;
        padding: 5px 12px;
        border-radius: 20px;
        display: inline-block;
    }

    .schedule-box {
        background-color: #fcfcfc;
        border: 1px dashed #dee2e6;
        border-radius: 10px;
        padding: 8px;
        margin-bottom: 5px;
    }

    .day-label {
        text-transform: capitalize;
        font-weight: bold;
        color: #0056b3;
        font-size: 0.85rem;
    }

    .time-label { font-size: 0.8rem; color: #6c757d; }

    /* Menggunakan class btn-main agar senada dengan Blog */
    .btn-book {
        background-color: #007bff;
        color: white;
        border-radius: 50px;
        font-weight: 600;
        padding: 10px 20px;
        border: none;
        text-align: center;
        transition: 0.3s;
        display: block;
        width: 100%;
    }

    .btn-book:hover { 
        background-color: #0056b3; 
        color: white;
        text-decoration: none;
    }

    .section-padding { padding: 60px 0; }
</style>
@endpush

@section('content')
<section class="page-title bg-1">
    <div class="overlay"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="block text-center">
                    <span class="text-white">Our Specialists</span>
                    <h1 class="text-capitalize mb-4 text-lg">Jadwal Praktik Dokter</h1>
                    <p class="text-white-50">Temukan waktu konsultasi yang sesuai dengan kebutuhan Anda</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="section-padding">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">

                @foreach($doctors as $doctor)
                <div class="card doctor-card mb-4">
                    <div class="card-body p-4">
                        <div class="row align-items-center">
                            <div class="col-md-3 col-lg-2 text-center mb-3 mb-md-0">
                                <div class="img-container mx-auto">
                                   <img src="{{ asset('storage/' . $doctor->user->photo) }}"
                                        class="doctor-img"
                                        alt="{{ $doctor->name }}"
                                        onerror="this.src='{{ asset('images/no-image.png') }}'">
                                </div>
                            </div>

                            <div class="col-md-4 col-lg-5">
                                <span class="badge-specialist mb-2">{{ $doctor->specialization }}</span>
                                <h4 class="fw-bold mb-1" style="font-weight: 700;">{{ $doctor->name }}</h4>
                                <p class="text-muted small mb-2">
                                    <i class="icofont-badge mr-1"></i> {{ $doctor->experience_years }} Tahun Pengalaman
                                </p>
                                <div class="d-flex align-items-center">
                                    <i class="icofont-location-pin text-danger mr-2"></i>
                                    <span class="small font-weight-bold">RS VitaGuard Utama</span>
                                </div>
                            </div>

                            <div class="col-md-5 col-lg-5">
                                <h6 class="font-weight-bold mb-3" style="font-size: 0.9rem;">
                                    <i class="icofont-calendar mr-2 text-primary"></i>Jadwal Tersedia:
                                </h6>
                                <div class="row no-gutters">
                                    @forelse($doctor->schedules->where('is_available', true) as $sch)
                                        <div class="col-6 px-1">
                                            <div class="schedule-box text-center">
                                                <div class="day-label">{{ $sch->day }}</div>
                                                <div class="time-label">{{ date('H:i', strtotime($sch->start_time)) }} - {{ date('H:i', strtotime($sch->end_time)) }}</div>
                                            </div>
                                        </div>
                                    @empty
                                        <div class="col-12 text-muted small italic">Tidak ada jadwal aktif.</div>
                                    @endforelse
                                </div>

                                <div class="mt-3">
                                    <a href="{{ route('doctors.show', $doctor->id) }}" class="btn-book">
                                        Buat Janji <i class="icofont-simple-right ml-2"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach

                <div class="mt-5 d-flex justify-content-center">
                    {{ $doctors->links('pagination::bootstrap-4') }}
                </div>

            </div>
        </div>
    </div>
</section>
@endsection