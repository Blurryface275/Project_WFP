@extends('layouts.admin-app')

@section('title', 'Dashboard Dokter')
@section('page-title', 'Dashboard Dokter')

@section('content')
<div class="row">
    <div class="col-lg-3 col-6">
        <div class="small-box bg-info">
            <div class="inner">
                <h3>150</h3>
                <p>Total Pasien</p>
            </div>
            <div class="icon">
                <i class="fas fa-users"></i>
            </div>
            <a href="#" class="small-box-footer">Info lebih lanjut <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box bg-success">
            <div class="inner">
                <h3>5</h3>
                <p>Jadwal Hari Ini</p>
            </div>
            <div class="icon">
                <i class="fas fa-calendar-check"></i>
            </div>
            <a href="#" class="small-box-footer">Lihat Jadwal <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
</div>

<div class="alert alert-info mt-3">
    <h5><i class="icon fas fa-info"></i> Selamat Datang Dokter!</h5>
    Ini adalah halaman Dashboard. Anda dapat melihat ringkasan aktivitas konsultasi Anda di sini.
</div>
@endsection
