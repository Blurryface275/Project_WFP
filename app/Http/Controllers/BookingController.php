<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Service;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function create($doctor_id)
    {
        $doctor = Doctor::findOrFail($doctor_id);
        $services = Service::all();
        return view('Member.booking', compact('doctor', 'services'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'doctor_id' => 'required|exists:doctors,id',
            'service_id' => 'required|exists:services,id',
            'date' => 'required|date',
            'payment_method' => 'required|string',
            'notes' => 'nullable|string',
        ]);

        $service = Service::find($request->service_id);

        Transaction::create([
            'user_id' => Auth::id(),
            'doctor_id' => $request->doctor_id,
            'service_id' => $request->service_id,
            'transaction_type' => 'appointment',
            'payment_method' => $request->payment_method,
            'status' => 'pending',
            'total_price' => $service->price,
            'notes' => $request->notes,
            'date' => $request->date,
        ]);

        return redirect()->route('doctors.index')->with('success', 'Booking berhasil dibuat!');
    }
}
