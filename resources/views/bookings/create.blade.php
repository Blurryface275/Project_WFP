@extends('layouts.member-app')
@section('title', 'Booking Konsultasi - VitaGuard')

@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<style>
    :root {
        --vg-blue: #007bff;
        --vg-dark: #0056b3;
        --vg-soft: #e7f1ff;
    }

    .booking-header {
        background: linear-gradient(135deg, var(--vg-blue), var(--vg-dark));
        color: white;
        padding: 40px 0;
        margin-bottom: 30px;
        border-radius: 0 0 30px 30px;
    }

    .doctor-info-card {
        background: white;
        border-radius: 16px;
        border: none;
        overflow: hidden;
    }

    .doctor-info-card .img-circle {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        object-fit: cover;
        border: 3px solid var(--vg-soft);
    }

    .schedule-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
        gap: 12px;
    }

    .schedule-slot {
        background: #f8f9fa;
        border: 2px solid #e9ecef;
        border-radius: 12px;
        padding: 14px;
        cursor: pointer;
        transition: all 0.2s ease;
        text-align: center;
    }

    .schedule-slot:hover {
        border-color: var(--vg-blue);
        background: var(--vg-soft);
        transform: translateY(-2px);
    }

    .schedule-slot.selected {
        border-color: var(--vg-blue);
        background: var(--vg-soft);
        box-shadow: 0 0 0 3px rgba(0, 123, 255, 0.15);
    }

    .schedule-slot .day-name {
        font-weight: 700;
        text-transform: capitalize;
        color: var(--vg-dark);
        font-size: 0.95rem;
    }

    .schedule-slot .time-range {
        color: #666;
        font-size: 0.85rem;
        margin-top: 4px;
    }

    .form-section {
        background: white;
        border-radius: 16px;
        border: none;
    }

    .section-title {
        font-weight: 700;
        color: #1a1a2e;
        font-size: 1.1rem;
        margin-bottom: 16px;
        padding-bottom: 8px;
        border-bottom: 2px solid var(--vg-soft);
    }

    .btn-booking {
        background: linear-gradient(135deg, var(--vg-blue), var(--vg-dark));
        border: none;
        color: white;
        padding: 12px 40px;
        border-radius: 12px;
        font-weight: 600;
        font-size: 1rem;
        transition: all 0.2s ease;
    }

    .btn-booking:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 86, 179, 0.3);
        color: white;
    }

    .price-tag {
        background: var(--vg-soft);
        color: var(--vg-dark);
        padding: 8px 16px;
        border-radius: 10px;
        font-weight: 700;
        font-size: 1.1rem;
        display: inline-block;
    }
</style>
@endpush

@section('content')
<div class="booking-header shadow">
    <div class="container text-center">
        <h2 class="fw-bold">Booking Konsultasi</h2>
        <p class="opacity-75">Pilih jadwal yang tersedia untuk konsultasi dengan dokter</p>
    </div>
</div>

<div class="container mb-5">
    <a href="{{ route('doctors.show', $doctor->id) }}" class="text-decoration-none d-inline-block mb-3" style="color: var(--vg-blue); font-weight: 500;">
        &larr; Kembali ke Detail Dokter
    </a>



    <form action="{{ route('bookings.store') }}" method="POST" id="bookingForm">
        @csrf
        <input type="hidden" name="doctor_id" value="{{ $doctor->id }}">
        <input type="hidden" name="schedule_id" id="schedule_id" value="{{ old('schedule_id') }}">

        <div class="row">
            {{-- Kolom kiri: Info Dokter + Jadwal --}}
            <div class="col-lg-8">

                {{-- Info Dokter --}}
                <div class="card doctor-info-card shadow-sm mb-4">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            @if($doctor->user && $doctor->user->photo)
                                <img src="{{ asset('storage/' . $doctor->user->photo) }}" class="img-circle mr-3" alt="{{ $doctor->name }}">
                            @else
                                <img src="https://ui-avatars.com/api/?name={{ urlencode($doctor->name) }}&size=160&background=e7f1ff&color=0d6efd" class="img-circle mr-3" alt="{{ $doctor->name }}">
                            @endif
                            <div>
                                <h4 class="fw-bold mb-1">{{ $doctor->name }}</h4>
                                <span class="text-primary fw-semibold">{{ $doctor->specialization }}</span>
                                <p class="text-muted small mb-0 mt-1">{{ $doctor->experience_years }} tahun pengalaman</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Pilih Jadwal --}}
                <div class="card form-section shadow-sm mb-4">
                    <div class="card-body">
                        <h5 class="section-title"><i class="icofont-calendar mr-2"></i>Pilih Jadwal Praktik</h5>

                        @if($doctor->schedules->isEmpty())
                            <p class="text-muted text-center py-4">Dokter ini belum memiliki jadwal yang tersedia.</p>
                        @else
                            <div class="schedule-grid">
                                @foreach($doctor->schedules as $schedule)
                                    <div class="schedule-slot {{ old('schedule_id') == $schedule->id ? 'selected' : '' }}"
                                         data-id="{{ $schedule->id }}"
                                         data-day="{{ $schedule->day }}"
                                         onclick="selectSchedule(this)">
                                        <div class="day-name">{{ $schedule->day }}</div>
                                        <div class="time-range">
                                            {{ date('H:i', strtotime($schedule->start_time)) }} - {{ date('H:i', strtotime($schedule->end_time)) }}
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                        @error('schedule_id')
                            <small class="text-danger mt-2 d-block">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                {{-- Pilih Tanggal --}}
                <div class="card form-section shadow-sm mb-4">
                    <div class="card-body">
                        <h5 class="section-title"><i class="icofont-ui-calendar mr-2"></i>Pilih Tanggal Konsultasi</h5>
                        <p class="text-muted small mb-3" id="date-hint">Pilih jadwal di atas terlebih dahulu untuk melihat tanggal yang tersedia.</p>
                        <input type="text"
                               name="schedule_date"
                               id="schedule_date"
                               class="form-control bg-white"
                               placeholder="Pilih tanggal..."
                               required
                               disabled>
                        @error('schedule_date')
                            <small class="text-danger mt-1 d-block">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
            </div>

            {{-- Kolom kanan: Summary + Notes --}}
            <div class="col-lg-4">
                <div class="card form-section shadow-sm mb-4">
                    <div class="card-body">
                        <h5 class="section-title"><i class="icofont-edit mr-2"></i>Catatan Keluhan</h5>
                        <textarea name="notes"
                                  class="form-control"
                                  rows="4"
                                  placeholder="Jelaskan keluhan atau alasan konsultasi Anda (opsional)..."
                                  style="border-radius: 10px;">{{ old('notes') }}</textarea>
                    </div>
                </div>

                <div class="card form-section shadow-sm mb-4">
                    <div class="card-body">
                        <h5 class="section-title"><i class="icofont-info-circle mr-2"></i>Ringkasan</h5>
                        <table class="table table-borderless table-sm mb-3">
                            <tr>
                                <td class="text-muted">Dokter</td>
                                <td class="fw-semibold text-right">{{ $doctor->name }}</td>
                            </tr>
                            <tr>
                                <td class="text-muted">Layanan</td>
                                <td class="fw-semibold text-right">{{ $service->service_name ?? 'Konsultasi' }}</td>
                            </tr>
                            <tr>
                                <td class="text-muted">Jadwal</td>
                                <td class="fw-semibold text-right" id="summary-schedule">-</td>
                            </tr>
                            <tr>
                                <td class="text-muted">Tanggal</td>
                                <td class="fw-semibold text-right" id="summary-date">-</td>
                            </tr>
                        </table>
                        <hr>
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <span class="text-muted">Biaya Konsultasi</span>
                            <span class="price-tag">Rp {{ number_format($service->price ?? 0, 0, ',', '.') }}</span>
                        </div>
                        <button type="submit" class="btn btn-booking btn-block" id="btn-submit" disabled>
                            Konfirmasi Booking
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
    const dayMap = {
        0: 'sunday', 1: 'monday', 2: 'tuesday', 3: 'wednesday',
        4: 'thursday', 5: 'friday', 6: 'saturday'
    };

    const dayMapIndex = {
        'sunday': 0, 'monday': 1, 'tuesday': 2, 'wednesday': 3,
        'thursday': 4, 'friday': 5, 'saturday': 6
    };

    let selectedDay = null;
    let fpInstance = null;

    document.addEventListener('DOMContentLoaded', function() {
        fpInstance = flatpickr("#schedule_date", {
            minDate: "today",
            dateFormat: "Y-m-d",
            disable: [
                function(date) {
                    return true; // Disable all initially
                }
            ],
            onChange: function(selectedDates, dateStr, instance) {
                if (selectedDates.length > 0) {
                    const selected = selectedDates[0];
                    const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
                    document.getElementById('summary-date').textContent = selected.toLocaleDateString('id-ID', options);
                    document.getElementById('btn-submit').disabled = false;
                } else {
                    document.getElementById('summary-date').textContent = '-';
                    document.getElementById('btn-submit').disabled = true;
                }
            }
        });
    });

    function selectSchedule(el) {
        // Hapus selection sebelumnya
        document.querySelectorAll('.schedule-slot').forEach(s => s.classList.remove('selected'));
        el.classList.add('selected');

        const scheduleId = el.dataset.id;
        selectedDay = el.dataset.day;

        document.getElementById('schedule_id').value = scheduleId;

        // Update summary
        const dayText = el.querySelector('.day-name').textContent;
        const timeText = el.querySelector('.time-range').textContent;
        document.getElementById('summary-schedule').textContent = dayText + ' ' + timeText;

        // Reset date
        document.getElementById('summary-date').textContent = '-';
        document.getElementById('btn-submit').disabled = true;

        document.getElementById('date-hint').textContent =
            'Pilih tanggal yang jatuh pada hari ' + dayText.charAt(0).toUpperCase() + dayText.slice(1) + '.';

        // Enable date input and update Flatpickr rules
        const dateInput = document.getElementById('schedule_date');
        dateInput.disabled = false;

        if (fpInstance) {
            const targetDayIndex = dayMapIndex[selectedDay];
            fpInstance.set('disable', [
                function(date) {
                    return date.getDay() !== targetDayIndex;
                }
            ]);
            fpInstance.clear();
            fpInstance.open();
        }
    }

    // Konfirmasi sebelum submit
    document.getElementById('bookingForm').addEventListener('submit', function(e) {
        e.preventDefault();
        const form = this;

        if (!document.getElementById('schedule_id').value) {
            Swal.fire({
                icon: 'error',
                title: 'Formulir Belum Lengkap',
                text: 'Silakan pilih jadwal terlebih dahulu.',
                confirmButtonColor: '#007bff'
            });
            return;
        }
        if (!document.getElementById('schedule_date').value) {
            Swal.fire({
                icon: 'error',
                title: 'Formulir Belum Lengkap',
                text: 'Silakan pilih tanggal konsultasi.',
                confirmButtonColor: '#007bff'
            });
            return;
        }

        Swal.fire({
            title: 'Konfirmasi Booking',
            text: 'Apakah Anda yakin ingin melakukan booking konsultasi ini?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#007bff',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Ya, Booking Sekarang',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    });
</script>
@endpush
