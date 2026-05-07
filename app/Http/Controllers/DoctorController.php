<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Service;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $doctors = Doctor::with('user', 'schedules')->paginate(10);
        // Tampilan Admin
        if (request()->is('admin/*') || request()->is('admin')) {
            return view('admin.list-dokter', compact('doctors'));
        } else {
            // Tampilan User
            return view('member.list-dokter', compact('doctors'));
        }
    }
    public function kelola()
    {
        //
        $doctors = Doctor::with('user', 'schedules')->paginate(10);
        return view('admin.kelola-dokter', compact('doctors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
        $doctor = Doctor::with('user', 'schedules')->find($id);

        if (!$doctor) {
            abort(404);
        }

        return view('member.detail-dokter', compact('doctor'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Doctor $doctor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Doctor $doctor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Doctor $doctor)
    {
        //
    }

    // Member — halaman jadwal semua dokter
    public function schedule()
    {
        $doctors = Doctor::with('user', 'schedules')->paginate(10);
        return view('member.jadwal-dokter', compact('doctors'));
    }

    // Member — halaman form booking
    public function book($id)
    {
        $doctor = Doctor::with('user', 'schedules')->find($id);
        
        if (!$doctor) {
            abort(404);
        }

        // ambil layanan yang berkaitan dengan konsultasi
        $services = Service::where('service_name', 'like', '%Konsultasi%')->get();

        return view('member.booking', compact('doctor', 'services'));
    }
}
