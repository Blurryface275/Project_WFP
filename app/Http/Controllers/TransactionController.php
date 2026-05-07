<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'doctor_id' => 'required|exists:doctors,id',
            'service_id' => 'required|exists:services,id',
            'date' => 'required|date|after_or_equal:today',
            'transaction_type' => 'required|in:consultation,appointment',
            'notes' => 'nullable|string',
        ]);

        // Simulasikan harga dari service
        $service = \App\Models\Service::find($request->service_id);

        $transaction = Transaction::create([
            'user_id' => Auth::id() ?? 1, // Fallback ke user ID 1 jika tidak login untuk testing
            'doctor_id' => $request->doctor_id,
            'service_id' => $request->service_id,
            'transaction_type' => $request->transaction_type,
            'payment_method' => 'Bank Transfer', // Default placeholder
            'status' => 'pending',
            'total_price' => $service->price,
            'notes' => $request->notes,
            'date' => $request->date,
        ]);

        return redirect()->route('doctors.index')->with('success', 'Booking berhasil dibuat! Status: ' . $transaction->status);
    }
}
