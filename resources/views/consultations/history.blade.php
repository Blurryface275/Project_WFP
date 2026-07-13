@extends(in_array(Auth::user()->role, ['admin', 'doctor']) ? 'layouts.admincoreui-app' : 'layouts.member-app')
@section('title', 'Riwayat Konsultasi')
@section('page-title', 'Riwayat Konsultasi Pasien')

@section(in_array(Auth::user()->role, ['admin', 'doctor']) ? 'content-admin' : 'content')
@if(!in_array(Auth::user()->role, ['admin', 'doctor']))
<section class="page-title bg-1">
  <div class="overlay"></div>
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="block text-center">
          <span class="text-white">Riwayat</span>
          <h1 class="text-capitalize mb-5 text-lg">Riwayat Konsultasi</h1>
        </div>
      </div>
    </div>
  </div>
</section>
@endif

<section class="section service-2">
    <div class="container">

        {{-- Back button --}}
        <div class="mb-4">
            @if(Auth::user()->role === 'doctor')
                <a href="{{ route('doctor.consultations') }}" class="btn btn-outline-secondary btn-sm">
                    <i class="icofont-arrow-left"></i> Kembali ke Konsultasi Aktif
                </a>
            @elseif(Auth::user()->role === 'admin')
                <a href="{{ route('admin.bookings.index') }}" class="btn btn-outline-secondary btn-sm">
                    <i class="icofont-arrow-left"></i> Kembali ke Daftar Booking
                </a>
            @else
                <a href="{{ route('consultations.index') }}" class="btn btn-outline-secondary btn-sm">
                    <i class="icofont-arrow-left"></i> Kembali ke Konsultasi Aktif
                </a>
            @endif
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card shadow-sm">
                    <div class="card-header bg-white d-flex align-items-center">
                        <h4 class="mb-0 text-dark">
                            <i class="icofont-history mr-2"></i>
                            @if(Auth::user()->role === 'doctor')
                                Riwayat Konsultasi Pasien Saya
                            @else
                                Riwayat Konsultasi Saya
                            @endif
                            
                            @if($consultations->count() > 0)
                                <span class="badge bg-secondary ms-2" style="font-size: 0.9rem;">{{ $consultations->count() }}</span>
                            @endif
                        </h4>
                    </div>
                    <div class="card-body p-0">
                        @if($consultations->isEmpty())
                            <div class="text-center text-muted py-5">
                                <i class="icofont-history" style="font-size: 3rem; color: #dee2e6;"></i>
                                <p class="mt-3 mb-0">Belum ada riwayat konsultasi.</p>
                            </div>
                        @else
                            <div class="table-responsive">
                                <table class="table table-hover align-middle mb-0">
                                    <thead class="bg-light">
                                        <tr>
                                            <th>#</th>
                                            <th>{{ Auth::user()->role === 'doctor' ? 'Nama Pasien' : 'Nama Dokter' }}</th>
                                            <th>Tanggal Konsultasi</th>
                                            <th>Status</th>
                                            <th>Jumlah Pesan</th>
                                            <th>Ringkasan</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($consultations as $index => $consultation)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>
                                                    @if(Auth::user()->role === 'doctor')
                                                        <strong>{{ $consultation->user->name ?? 'Pasien' }}</strong>
                                                    @else
                                                        <strong>{{ $consultation->doctor->name ?? 'Dokter' }}</strong>
                                                    @endif
                                                </td>
                                                <td>
                                                    <span>{{ $consultation->created_at->format('d M Y') }}</span><br>
                                                    <!-- format jam adalah H untuk jam dan i untuk menit -->
                                                    <small class="text-muted">{{ $consultation->created_at->format('H:i') }} WIB</small> 
                                                </td>
                                                <td>
                                                    @if($consultation->status === 'active')
                                                        <span class="badge" style="background-color: #28a745; color: white; padding: 5px 10px; border-radius: 12px;">
                                                            <i class="icofont-live-support"></i> Aktif
                                                        </span>
                                                    @else
                                                        <span class="badge" style="background-color: #6c757d; color: white; padding: 5px 10px; border-radius: 12px;">
                                                            <i class="icofont-check-circled"></i> Selesai
                                                        </span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <span class="text-muted">
                                                        {{ $consultation->messages->where('is_system_message', false)->count() }} pesan
                                                    </span>
                                                </td>
                                                <td>
                                                    {{-- Ringkasan: tampilkan pesan terakhir (bukan system message) --}}
                                                    @php
                                                        $lastMsg = $consultation->messages
                                                            ->where('is_system_message', false)
                                                            ->last();
                                                    @endphp
                                                    @if($lastMsg)
                                                        <small class="text-muted" style="max-width: 200px; display: inline-block; overflow: hidden; white-space: nowrap; text-overflow: ellipsis;">
                                                            "{{ Str::limit($lastMsg->message, 60) }}"
                                                        </small>
                                                    @else
                                                        <small class="text-muted">—</small>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="{{ route('consultations.show', $consultation->id) }}"
                                                        class="btn btn-sm btn-main-2">
                                                        <i class="icofont-eye-alt"></i> Lihat Percakapan
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

                {{-- Catatan: Riwayat tidak dapat dihapus --}}
                <div class="alert alert-info mt-3" role="alert">
                    <i class="icofont-info-circle mr-2"></i>
                    <strong>Catatan:</strong> Riwayat konsultasi bersifat permanen dan tidak dapat dihapus oleh member maupun dokter.
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
