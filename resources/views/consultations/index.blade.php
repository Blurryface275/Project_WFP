@extends('layouts.member-app')
@section('title', 'Riwayat Konsultasi')

@section('content')
<section class="page-title bg-1">
  <div class="overlay"></div>
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="block text-center">
          <span class="text-white">Riwayat</span>
          <h1 class="text-capitalize mb-5 text-lg">Konsultasi Online</h1>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="section service-2">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                <div class="card shadow-sm">
                    <div class="card-header bg-white">
                        <h4 class="mb-0">Daftar Konsultasi Anda</h4>
                    </div>
                    <div class="card-body">
                        @if($consultations->isEmpty())
                            <p class="text-center text-muted my-5">Belum ada riwayat konsultasi.</p>
                        @else
                            <div class="table-responsive">
                                <table class="table table-hover align-middle">
                                    <thead class="bg-light">
                                        <tr>
                                            <th>#</th>
                                            <th>{{ Auth::user()->role === 'doctor' ? 'Nama Pasien' : 'Nama Dokter' }}</th>
                                            <th>Status</th>
                                            <th>Terakhir Diperbarui</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($consultations as $index => $consultation)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>
                                                    @if(Auth::user()->role === 'doctor')
                                                        {{ $consultation->user->name ?? 'User' }}
                                                    @else
                                                        {{ $consultation->doctor->name ?? 'Dokter' }}
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($consultation->status === 'active')
                                                        <span class="badge badge-success" style="background-color: #28a745;">Aktif</span>
                                                    @else
                                                        <span class="badge badge-secondary" style="background-color: #6c757d;">Selesai</span>
                                                    @endif
                                                </td>
                                                <td>{{ $consultation->updated_at->diffForHumans() }}</td>
                                                <td>
                                                    <a href="{{ route('consultations.show', $consultation->id) }}" class="btn btn-sm btn-main-2">
                                                        <i class="icofont-chat"></i> Buka Chat
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
