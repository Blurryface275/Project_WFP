<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\DoctorSchedule;
use App\Models\Service;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Member: daftar booking milik member yang login.
     */
    public function index()
    {
        $bookings = Transaction::with(['doctor.user', 'service'])
            ->where('user_id', Auth::id())
            ->where('transaction_type', 'consultation')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('bookings.index', compact('bookings'));
    }

    /**
     * Member: form booking konsultasi dengan dokter tertentu.
     */
    public function create($doctorId)
    {
        $doctor = Doctor::with(['user', 'schedules' => function ($q) {
            $q->where('is_available', true);
        }])->findOrFail($doctorId);

        // Ambil service konsultasi online sebagai default
        $service = Service::where('service_name', 'like', '%Konsultasi%Online%')->first()
            ?? Service::first();

        return view('bookings.create', compact('doctor', 'service'));
    }

    /**
     * Member: simpan booking baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'doctor_id'     => 'required|exists:doctors,id',
            'schedule_id'   => 'required|exists:doctor_schedules,id',
            'schedule_date' => 'required|date|after_or_equal:today',
            'notes'         => 'nullable|string|max:1000',
        ]);

        $user = Auth::user();
        $schedule = DoctorSchedule::findOrFail($request->schedule_id);

        // Validasi: jadwal milik dokter yang dipilih
        if ($schedule->doctor_id != $request->doctor_id) {
            return back()->with('error', 'Jadwal tidak sesuai dengan dokter yang dipilih.')->withInput();
        }

        // Validasi: jadwal available
        if (!$schedule->is_available) {
            return back()->with('error', 'Jadwal ini sedang tidak tersedia.')->withInput();
        }

        // Validasi: tanggal yang dipilih jatuh pada hari yang benar
        $selectedDate = Carbon::parse($request->schedule_date);
        $dayName = strtolower($selectedDate->format('l')); // monday, tuesday, etc.

        if ($dayName !== $schedule->day) {
            return back()->with('error', 'Tanggal yang dipilih tidak sesuai dengan hari jadwal dokter.')->withInput();
        }

        // Validasi: cegah booking duplikat (same user, same doctor, same date, same schedule, status pending)
        $duplicate = Transaction::where('user_id', $user->id)
            ->where('doctor_id', $request->doctor_id)
            ->where('schedule_date', $request->schedule_date)
            ->where('schedule_time', $schedule->start_time . ' - ' . $schedule->end_time)
            ->where('status', 'pending')
            ->exists();

        if ($duplicate) {
            return back()->with('error', 'Anda sudah memiliki booking pada jadwal ini. Silakan pilih jadwal lain.')->withInput();
        }

        // Ambil service default untuk harga
        $service = Service::where('service_name', 'like', '%Konsultasi%Online%')->first()
            ?? Service::first();

        Transaction::create([
            'user_id'          => $user->id,
            'doctor_id'        => $request->doctor_id,
            'service_id'       => $service->id,
            'transaction_type' => 'consultation',
            'payment_method'   => 'online',
            'status'           => 'pending',
            'total_price'      => $service->price ?? 0,
            'notes'            => $request->notes,
            'date'             => $request->schedule_date,
            'schedule_date'    => $request->schedule_date,
            'schedule_time'    => $schedule->start_time . ' - ' . $schedule->end_time,
        ]);

        return redirect()->route('bookings.index')->with('success', 'Booking konsultasi berhasil dibuat! Silakan tunggu konfirmasi.');
    }

    /**
     * Member: detail booking.
     */
    public function show($id)
    {
        $booking = Transaction::with(['doctor.user', 'service'])
            ->where('user_id', Auth::id())
            ->where('transaction_type', 'consultation')
            ->findOrFail($id);

        return view('bookings.show', compact('booking'));
    }

    /**
     * Member: batalkan booking.
     */
    public function destroy($id)
    {
        $booking = Transaction::where('user_id', Auth::id())
            ->where('transaction_type', 'consultation')
            ->findOrFail($id);

        if ($booking->status !== 'pending') {
            return back()->with('error', 'Hanya booking dengan status menunggu yang bisa dibatalkan.');
        }

        $booking->update(['status' => 'cancelled']);

        return redirect()->route('bookings.index')->with('success', 'Booking berhasil dibatalkan.');
    }

    /**
     * Admin: daftar semua booking.
     */
    public function adminIndex()
    {
        $bookings = Transaction::with(['user', 'doctor.user', 'service'])
            ->where('transaction_type', 'consultation')
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('admin.bookings.index', compact('bookings'));
    }

    /**
     * Admin: batalkan booking.
     */
    public function adminDestroy($id)
    {
        $booking = Transaction::where('transaction_type', 'consultation')->findOrFail($id);

        if ($booking->status !== 'pending') {
            return back()->with('error', 'Hanya booking dengan status menunggu yang bisa dibatalkan.');
        }

        $booking->update(['status' => 'cancelled']);

        return redirect()->route('admin.bookings.index')->with('success', 'Booking berhasil dibatalkan.');
    }
}
