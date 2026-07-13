<?php

namespace App\Http\Controllers;

use App\Models\Consultation;
use App\Models\Doctor;
use App\Models\Message;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ConsultationController extends Controller
{
    // Make sure user is authenticated
    public function __construct()
    {
        $this->middleware('auth');
    }

    // =========================================================
    // MEMBER: Daftar konsultasi member (aktif & selesai)
    // =========================================================
    public function index()
    {
        $user = Auth::user();

        $consultations = Consultation::with(['doctor'])
            ->where('user_id', $user->id)
            ->orderBy('updated_at', 'desc')
            ->get();

        return view('consultations.index', compact('consultations'));
    }

    // =========================================================
    // MEMBER: Mulai konsultasi (validasi booking aktif)
    // =========================================================
    public function store(Request $request)
    {
        $request->validate([
            'doctor_id' => 'required|exists:doctors,id'
        ]);

        $user = Auth::user();

        // 1. Cek apakah sudah ada konsultasi aktif dengan dokter ini
        $consultation = Consultation::where('user_id', $user->id)
            ->where('doctor_id', $request->doctor_id)
            ->where('status', 'active')
            ->first();

        if ($consultation) {
            return redirect()->route('consultations.show', $consultation->id);
        }

        // 2. Jika tidak ada, validasi: pastikan member punya booking aktif (pending) dengan dokter ini
        $hasValidBooking = Transaction::where('user_id', $user->id)
            ->where('doctor_id', $request->doctor_id)
            ->where('transaction_type', 'consultation')
            ->where('status', 'pending')
            ->exists();

        if (!$hasValidBooking) {
            return redirect()->back()->with('error',
                'Anda belum memiliki booking konsultasi yang valid dengan dokter ini. Silakan lakukan booking terlebih dahulu.'
            );
        }

        // Buat sesi konsultasi baru
        $consultation = Consultation::create([
            'user_id'   => $user->id,
            'doctor_id' => $request->doctor_id,
            'status'    => 'active'
        ]);

        // Pesan sistem pembuka sesi
        Message::create([
            'consultation_id' => $consultation->id,
            'sender_id'       => null,
            'message'         => '--- Sesi Konsultasi Dimulai ---',
            'is_system_message' => true
        ]);

        return redirect()->route('consultations.show', $consultation->id);
    }

    // =========================================================
    // SHARED: Tampilkan halaman chat (member & dokter)
    // =========================================================
    public function show($id)
    {
        $consultation = Consultation::with(['user', 'doctor.user', 'messages.sender'])->findOrFail($id);
        $user = Auth::user();

        // Otorisasi member: hanya bisa lihat konsultasi miliknya
        if ($user->role === 'member' && $consultation->user_id !== $user->id) {
            abort(403, 'Unauthorized');
        }

        // Otorisasi dokter: hanya bisa lihat konsultasi yang ditujukan kepadanya
        if ($user->role === 'doctor') {
            $doctor = Doctor::where('user_id', $user->id)->first();
            if (!$doctor || $consultation->doctor_id !== $doctor->id) {
                abort(403, 'Unauthorized');
            }
        }

        return view('consultations.show', compact('consultation'));
    }

    // =========================================================
    // SHARED: Kirim pesan (member & dokter)
    // =========================================================
    public function sendMessage(Request $request, $id)
    {
        $request->validate([
            'message' => 'required|string|max:5000'
        ]);

        $consultation = Consultation::findOrFail($id);
        $user = Auth::user();

        // Otorisasi
        if ($user->role === 'member' && $consultation->user_id !== $user->id) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
        if ($user->role === 'doctor') {
            $doctor = Doctor::where('user_id', $user->id)->first();
            if (!$doctor || $consultation->doctor_id !== $doctor->id) {
                return response()->json(['error' => 'Unauthorized'], 403);
            }
        }

        if ($consultation->status !== 'active') {
            return response()->json(['error' => 'Sesi konsultasi sudah berakhir.'], 400);
        }

        $message = Message::create([
            'consultation_id'  => $consultation->id,
            'sender_id'        => $user->id,
            'message'          => $request->message,
            'is_system_message' => false
        ]);

        // Perbarui updated_at konsultasi
        $consultation->touch();

        return response()->json([
            'success' => true,
            'message' => $message->load('sender')
        ]);
    }

    // =========================================================
    // SHARED: Polling pesan baru (AJAX)
    // =========================================================
    public function getMessages($id, Request $request)
    {
        $consultation = Consultation::findOrFail($id);

        $lastMessageId = $request->query('last_id', 0);

        $messages = Message::with('sender')
            ->where('consultation_id', $consultation->id)
            ->where('id', '>', $lastMessageId)
            ->orderBy('created_at', 'asc')
            ->get();

        return response()->json([
            'messages' => $messages,
            'status'   => $consultation->status
        ]);
    }

    // =========================================================
    // SHARED: Akhiri konsultasi (member atau dokter)
    // =========================================================
    public function endConsultation($id)
    {
        $consultation = Consultation::findOrFail($id);
        $user = Auth::user();

        // Otorisasi: hanya dokter yang boleh menutup chat
        if ($user->role === 'member') {
            abort(403, 'Akses Ditolak: Hanya Dokter yang diizinkan untuk mengakhiri sesi konsultasi.');
        }
        if ($user->role === 'doctor') {
            $doctor = Doctor::where('user_id', $user->id)->first();
            if (!$doctor || $consultation->doctor_id !== $doctor->id) {
                abort(403, 'Unauthorized');
            }
        }

        if ($consultation->status === 'active') {
            $consultation->update(['status' => 'completed']);

            // Update status transaksi booking yang berkaitan menjadi completed
            Transaction::where('user_id', $consultation->user_id)
                ->where('doctor_id', $consultation->doctor_id)
                ->where('transaction_type', 'consultation')
                ->where('status', 'pending')
                ->update(['status' => 'completed']);

            Message::create([
                'consultation_id'  => $consultation->id,
                'sender_id'        => null,
                'message'          => '--- Sesi Konsultasi Diakhiri oleh ' . ucfirst($user->role) . ' ---',
                'is_system_message' => true
            ]);
        }

        // Redirect berbeda berdasarkan role
        if ($user->role === 'doctor') {
            return redirect()->route('doctor.consultations')
                ->with('success', 'Sesi konsultasi telah ditutup.');
        }

        return redirect()->route('consultations.index')
            ->with('success', 'Konsultasi telah diakhiri.');
    }

    // =========================================================
    // DOCTOR: Daftar konsultasi aktif & selesai untuk dokter
    // =========================================================
    public function doctorIndex()
    {
        $user   = Auth::user();
        $doctor = Doctor::where('user_id', $user->id)->first();

        if (!$doctor) {
            return redirect()->route('doctor.dashboard')
                ->with('error', 'Data dokter tidak ditemukan. Silakan hubungi administrator.');
        }

        $activeConsultations = Consultation::with(['user'])
            ->where('doctor_id', $doctor->id)
            ->where('status', 'active')
            ->orderBy('updated_at', 'desc')
            ->get();

        $completedConsultations = Consultation::with(['user'])
            ->where('doctor_id', $doctor->id)
            ->where('status', 'completed')
            ->orderBy('updated_at', 'desc')
            ->get();

        return view('doctor.consultations', compact('activeConsultations', 'completedConsultations', 'doctor'));
    }

    // =========================================================
    // MEMBER: Riwayat konsultasi lengkap
    // =========================================================
    public function history()
    {
        $user = Auth::user();

        if ($user->role === 'doctor') {
            $doctor = Doctor::where('user_id', $user->id)->first();
            $consultations = $doctor
                ? Consultation::with(['user', 'messages'])
                    ->where('doctor_id', $doctor->id)
                    ->orderBy('updated_at', 'desc')
                    ->get()
                : collect();

            return view('consultations.history', compact('consultations'));
        }

        // Member
        $consultations = Consultation::with(['doctor', 'messages'])
            ->where('user_id', $user->id)
            ->orderBy('updated_at', 'desc')
            ->get();

        return view('consultations.history', compact('consultations'));
    }
}
