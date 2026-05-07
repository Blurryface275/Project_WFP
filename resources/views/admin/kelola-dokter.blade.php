@extends('layout.app')
@section('title', 'VitaGuard - Kelola Dokter')
@section('content')

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

    <style>
        body {
            background-color: #f4f6f9;
        }

        .page-title.bg-1 {
            background: linear-gradient(135deg, #0056b3, #007bff);
            padding: 60px 0;
            color: white;
        }

        .table-card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.06);
            overflow: hidden;
        }

        .table thead th {
            background: #343a40;
            color: #fff;
            font-size: 0.85rem;
            font-weight: 600;
            border: none;
            padding: 14px 16px;
        }

        .table tbody td {
            vertical-align: middle;
            padding: 14px 16px;
            font-size: 0.9rem;
        }

        .table-hover tbody tr:hover {
            background-color: #e7f1ff;
        }

        /* Style Spesifik Dokter */
        .doctor-name {
            font-weight: 600;
            color: #2c3e50;
            display: block;
        }

        .specialist-badge {
            display: inline-block;
            background: #e7f1ff;
            color: #0056b3;
            font-weight: 600;
            font-size: 0.75rem;
            padding: 2px 10px;
            border-radius: 15px;
        }

        .img-thumb {
            width: 45px;
            height: 45px;
            object-fit: cover;
            border-radius: 50%;
            border: 2px solid #dee2e6;
        }

        .schedule-tag {
            display: inline-block;
            background: #f8f9fa;
            border: 1px solid #dee2e6;
            font-size: 0.75rem;
            padding: 2px 8px;
            border-radius: 4px;
            margin: 2px;
        }

        .btn-action {
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.8rem;
        }
    </style>

    <section class="page-title bg-1">
        <div class="overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="block text-center">
                        <h1 class="text-white">Daftar Praktik Dokter</h1>
                        <p class="text-white-50">Manajemen informasi dokter VitaGuard</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="container mb-5 mt-5">
        <div class="table-card">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th class="text-center" style="width: 80px;">Foto</th>
                        <th>Informasi Dokter</th>
                        <th>Spesialisasi</th>
                        <th>Jadwal Aktif</th>
                        <th class="text-center">Edit</th>
                        <th class="text-center">Delete</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($doctors as $doctor)
                        <tr>
                            <td class="text-center">
                                <img src="{{ asset('storage/' . $doctor->user->photo) }}" class="img-thumb"
                                    onerror="this.src='{{ asset('images/no-image.png') }}'">
                            </td>
                            <td>
                                <span class="doctor-name">{{ $doctor->name }}</span>
                                <small class="text-muted"><i class="bi bi-briefcase me-1"></i> {{ $doctor->experience_years }}
                                    Pengalaman</small>
                            </td>
                            <td>
                                <span class="specialist-badge">{{ $doctor->specialization }}</span>
                            </td>
                            <td>
                                @forelse($doctor->schedules->where('is_available', true) as $sch)
                                    <span class="schedule-tag">
                                        {{ substr($sch->day, 0, 3) }}: {{ date('H:i', strtotime($sch->start_time)) }}
                                    </span>
                                @empty
                                    <span class="text-muted small italic">Tidak ada jadwal</span>
                                @endforelse
                            </td>
                            <td>
                                <button class="btn btn-warning btn-sm" onclick="alert('Feature Coming Soon')">
                                    <span class="glyphicon glyphicon-pencil"></span> Edit
                                </button>
                            </td>
                            <td>
                                <button class="btn btn-danger btn-sm" onclick="alert('Feature Coming Soon')">
                                    <span class="glyphicon glyphicon-trash"></span> Delete
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-between align-items-center mt-4">
            <div>
                <small class="text-muted">Total: {{ $doctors->total() }} Dokter Terdaftar</small>
            </div>
            <div>
                {{ $doctors->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>

@endsection