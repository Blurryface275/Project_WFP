@extends('layouts.admin-app')

@section('title', 'Kelola Booking - VitaGuard')
@section('page-title', 'Kelola Booking Konsultasi')

@section('content')



    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead class="bg-light">
                <tr>
                    <th>#</th>
                    <th>Member</th>
                    <th>Dokter</th>
                    <th>Tanggal</th>
                    <th>Jam</th>
                    <th>Biaya</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($bookings as $i => $booking)
                <tr>
                    <td>{{ $bookings->firstItem() + $i }}</td>
                    <td>{{ $booking->user->name ?? '-' }}</td>
                    <td>{{ $booking->doctor->name ?? '-' }}</td>
                    <td>{{ $booking->schedule_date ? \Carbon\Carbon::parse($booking->schedule_date)->format('d M Y') : $booking->date }}</td>
                    <td>{{ $booking->schedule_time ?? '-' }}</td>
                    <td>Rp {{ number_format($booking->total_price, 0, ',', '.') }}</td>
                    <td>
                        @if($booking->status === 'pending')
                            <span class="badge badge-warning text-dark">Menunggu</span>
                        @elseif($booking->status === 'completed')
                            <span class="badge badge-success">Selesai</span>
                        @elseif($booking->status === 'cancelled')
                            <span class="badge badge-danger">Dibatalkan</span>
                        @endif
                    </td>
                    <td>
                        @if($booking->status === 'pending')
                            <form id="cancel-form-{{ $booking->id }}" action="{{ route('admin.bookings.destroy', $booking->id) }}" method="POST"
                                  class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-sm btn-outline-danger" onclick="confirmCancelBooking({{ $booking->id }})">
                                    <i class="fas fa-times"></i> Batalkan
                                </button>
                            </form>
                        @else
                            <span class="text-muted small">-</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="text-center text-muted py-4">Belum ada data booking.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="d-flex justify-content-center mt-3">
        {{ $bookings->links() }}
    </div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: "{{ session('success') }}",
                confirmButtonColor: '#3085d6'
            });
        @endif

        @if(session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Peringatan!',
                text: "{{ session('error') }}",
                confirmButtonColor: '#d33'
            });
        @endif
    });

    function confirmCancelBooking(bookingId) {
        Swal.fire({
            title: 'Batalkan Booking?',
            text: 'Apakah Anda yakin ingin membatalkan booking ini?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, Batalkan',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('cancel-form-' + bookingId).submit();
            }
        });
    }
</script>
@endpush
