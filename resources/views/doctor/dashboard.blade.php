@extends('layouts.admincoreui-app')

@section('title', 'Dashboard Dokter')
@section('page-title', 'Dashboard Dokter')

@section('content-admin')
<div class="row">
    <div class="col-lg-3 col-6">
        <div class="small-box bg-info text-white rounded p-4 mb-3" style="position: relative; overflow: hidden;">
            <div class="inner">
                <h3 style="font-size: 2.5rem; margin-bottom: 5px;">{{ $totalPasien ?? 0 }}</h3>
                <p style="font-size: 1.1rem; margin-bottom: 0;">Total Pasien</p>
            </div>
            <div class="icon" style="position: absolute; right: 15px; top: 15px; opacity: 0.3; font-size: 3rem;">
                <i class="fas fa-users"></i>
            </div>
            <a href="{{ route('consultations.history') }}" class="small-box-footer text-white text-decoration-none d-block mt-3 text-center rounded py-2" style="background-color: rgba(255,255,255,0.2); transition: background-color 0.2s;" onmouseover="this.style.backgroundColor='rgba(255,255,255,0.3)'" onmouseout="this.style.backgroundColor='rgba(255,255,255,0.2)'">
                Info lebih lanjut <i class="fas fa-arrow-circle-right ms-1"></i>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box bg-success text-white rounded p-4 mb-3" style="position: relative; overflow: hidden;">
            <div class="inner">
                <h3 style="font-size: 2.5rem; margin-bottom: 5px;">{{ $jadwalHariIni ?? 0 }}</h3>
                <p style="font-size: 1.1rem; margin-bottom: 0;">Jadwal Hari Ini</p>
            </div>
            <div class="icon" style="position: absolute; right: 15px; top: 15px; opacity: 0.3; font-size: 3rem;">
                <i class="fas fa-calendar-check"></i>
            </div>
            <a href="{{ route('doctor.consultations') }}" class="small-box-footer text-white text-decoration-none d-block mt-3 text-center rounded py-2" style="background-color: rgba(255,255,255,0.2); transition: background-color 0.2s;" onmouseover="this.style.backgroundColor='rgba(255,255,255,0.3)'" onmouseout="this.style.backgroundColor='rgba(255,255,255,0.2)'">
                Lihat Jadwal <i class="fas fa-arrow-circle-right ms-1"></i>
            </a>
        </div>
    </div>
</div>

<div class="alert alert-info mt-3">
    <h5><i class="icon fas fa-info"></i> Selamat Datang Dokter!</h5>
    Ini adalah halaman Dashboard. Anda dapat melihat ringkasan aktivitas konsultasi Anda di sini.
</div>
@endsection
