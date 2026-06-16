@extends('layouts.admin-app')

@section('title', 'Daftar Konsultasi')
@section('page-title', 'Daftar Antrean & Konsultasi')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Jadwal Konsultasi Anda Hari Ini</h3>
    </div>
    
    <div class="card-body p-0">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th style="width: 10px">#</th>
                    <th>Nama Pasien</th>
                    <th>Waktu Booking</th>
                    <th>Status</th>
                    <th style="width: 200px">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1.</td>
                    <td>Budi Santoso</td>
                    <td>10:00 WIB</td>
                    <td><span class="badge bg-warning">Menunggu</span></td>
                    <td>
                        <button class="btn btn-sm btn-primary" onclick="alert('Buka Ruang Obrolan placeholder')"><i class="fas fa-comments"></i> Chat</button>
                        <button class="btn btn-sm btn-success" onclick="alert('Selesai placeholder')"><i class="fas fa-check"></i> Selesai</button>
                    </td>
                </tr>
                <tr>
                    <td>2.</td>
                    <td>Siti Aminah</td>
                    <td>10:30 WIB</td>
                    <td><span class="badge bg-success">Selesai</span></td>
                    <td>
                        <button class="btn btn-sm btn-secondary" disabled>Selesai</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="card-footer clearfix">
        <span class="text-muted">Total 2 Konsultasi</span>
    </div>
</div>
@endsection
