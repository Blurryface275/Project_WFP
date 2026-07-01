@extends('layouts.admincoreui-app')
@section('title', 'Dashboard Admin - VitaGuard')
Dashboard Admin - VitaGuard
@section('content-admin')
    <div class="container-fluid">
        <h2 class="mb-4">Dashboard Admin</h2>

        {{-- ===== CARDS STATISTIK ===== --}}
        <div class="row">

            <div class="col-md-4 mb-3">
                <div class="card text-white bg-primary">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-title mb-1">Total Dokter</h6>
                            <h2 class="mb-0">{{ $stats['total_doctors'] }}</h2>
                        </div>
                        <span class="glyphicon glyphicon-user" style="font-size: 40px; opacity: 0.5;"></span>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-3">
                <div class="card text-white bg-success">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-title mb-1">Total Member</h6>
                            <h2 class="mb-0">{{ $stats['total_members'] }}</h2>
                        </div>
                        <span class="glyphicon glyphicon-user" style="font-size: 40px; opacity: 0.5;"></span>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-3">
                <div class="card text-white bg-info">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-title mb-1">Total Artikel Kesehatan</h6>
                            <h2 class="mb-0">{{ $stats['total_articles'] }}</h2>
                        </div>
                        <span class="glyphicon glyphicon-file" style="font-size: 40px; opacity: 0.5;"></span>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-3">
                <div class="card text-white bg-secondary">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-title mb-1">Total Booking</h6>
                            <h2 class="mb-0">{{ $stats['total_bookings'] }}</h2>
                        </div>
                        <span class="glyphicon glyphicon-calendar" style="font-size: 40px; opacity: 0.5;"></span>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-3">
                <div class="card text-white bg-warning">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-title mb-1">Konsultasi Berlangsung</h6>
                            <h2 class="mb-0">{{ $stats['ongoing_bookings'] }}</h2>
                        </div>
                        <span class="glyphicon glyphicon-time" style="font-size: 40px; opacity: 0.5;"></span>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-3">
                <div class="card text-white bg-danger">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-title mb-1">Konsultasi Selesai</h6>
                            <h2 class="mb-0">{{ $stats['finished_bookings'] }}</h2>
                        </div>
                        <span class="glyphicon glyphicon-ok" style="font-size: 40px; opacity: 0.5;"></span>
                    </div>
                </div>
            </div>

        </div>

        {{-- ===== GRAFIK ===== --}}
        <div class="row mt-4">

            {{-- Grafik Line: Booking per bulan --}}
            <div class="col-md-8 mb-4">
                <div class="card">
                    <div class="card-header">Aktivitas Booking (6 Bulan Terakhir)</div>
                    <div class="card-body">
                        <canvas id="bookingChart" height="120"></canvas>
                    </div>
                </div>
            </div>

            {{-- Grafik Donut: Komposisi status konsultasi --}}
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-header">Status Konsultasi</div>
                    <div class="card-body">
                        <canvas id="statusChart" height="120"></canvas>
                    </div>
                </div>
            </div>

        </div>
    </div>

    {{-- Chart.js via CDN --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const bookingLabels = @json($chartData['labels']);
        const bookingData = @json($chartData['data']);

        // Grafik Line — booking per bulan
        new Chart(document.getElementById('bookingChart'), {
            type: 'line',
            data: {
                labels: bookingLabels,
                datasets: [{
                    label: 'Jumlah Booking',
                    data: bookingData,
                    borderColor: '#4e73df',
                    backgroundColor: 'rgba(78,115,223,0.1)',
                    tension: 0.4,
                    fill: true,
                }]
            },
            options: {
                responsive: true,
                plugins: { legend: { display: false } },
                scales: { y: { beginAtZero: true, precision: 0 } }
            }
        });

        // Grafik Donut — komposisi status konsultasi
        new Chart(document.getElementById('statusChart'), {
            type: 'doughnut',
            data: {
                labels: ['Berlangsung', 'Selesai'],
                datasets: [{
                    data: [
                        {{ $stats['ongoing_bookings'] }},
                        {{ $stats['finished_bookings'] }}
                    ],
                    backgroundColor: ['#f6c23e', '#e74a3b'],
                }]
            },
            options: {
                responsive: true,
                plugins: { legend: { position: 'bottom' } }
            }
        });
    </script>
    <!-- <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="alert alert-info">
                    <h5><i class="icon fas fa-info"></i> Selamat Datang!</h5>
                    Anda login sebagai Administrator. Gunakan menu sidebar untuk mengelola data sistem.
                </div>
            </div>
        </div>
    </div> -->
@endsection