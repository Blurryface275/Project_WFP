@extends('layouts.admincoreui-app')
@section('title', 'Konsultasi Dokter')
@section('page-title', 'Manajemen Konsultasi')

@section('content-admin')

{{-- Flash Messages --}}
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="fas fa-check-circle mr-2"></i>{{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="fas fa-exclamation-circle mr-2"></i>{{ session('error') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

{{-- ===== KONSULTASI AKTIF ===== --}}
<div id="aktif" class="card card-primary card-outline mb-4">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fas fa-comments mr-2"></i>
            Konsultasi Aktif
            @if($activeConsultations->count() > 0)
                <span class="badge badge-primary ml-2">{{ $activeConsultations->count() }}</span>
            @endif
        </h3>
    </div>
    <div class="card-body p-0">
        @if($activeConsultations->isEmpty())
            <div class="text-center text-muted py-5">
                <i class="fas fa-inbox fa-3x mb-3 d-block" style="color: #dee2e6;"></i>
                <p class="mb-0">Tidak ada konsultasi aktif saat ini.</p>
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-hover table-striped mb-0">
                    <thead class="thead-light">
                        <tr>
                            <th style="width: 40px;">#</th>
                            <th>Nama Pasien</th>
                            <th>Waktu Mulai</th>
                            <th>Terakhir Aktif</th>
                            <th>Pesan</th>
                            <th style="width: 220px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($activeConsultations as $index => $consultation)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-circle mr-2">
                                            <img src="https://ui-avatars.com/api/?name={{ urlencode($consultation->user->name ?? 'P') }}&size=32&background=e7f1ff&color=0d6efd"
                                                class="rounded-circle" width="32" height="32" alt="Avatar">
                                        </div>
                                        <div>
                                            <strong>{{ $consultation->user->name ?? 'Pasien' }}</strong><br>
                                            <small class="text-muted">{{ $consultation->user->email ?? '' }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td>{{ $consultation->created_at->format('d M Y, H:i') }}</td>
                                <td>{{ $consultation->updated_at->diffForHumans() }}</td>
                                <td>
                                    <span class="badge badge-info">
                                        {{ $consultation->messages->count() }} pesan
                                    </span>
                                </td>
                                <td>
                                    {{-- Tombol Buka Chat --}}
                                    <a href="{{ route('doctor.consultations.show', $consultation->id) }}"
                                        class="btn btn-sm btn-primary">
                                        <i class="fas fa-comments"></i> Buka Chat
                                    </a>
                                    {{-- Tombol Tutup Konsultasi --}}
                                    <form action="{{ route('consultations.end', $consultation->id) }}"
                                        method="POST" class="d-inline"
                                        onsubmit="return confirm('Yakin ingin menutup konsultasi dengan {{ $consultation->user->name ?? 'pasien' }} ini?');">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-success">
                                            <i class="fas fa-check"></i> Tutup
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</div>



@endsection
