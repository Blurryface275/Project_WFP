<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
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
        $doctors = Doctor::with('user', 'schedules')->get();
        // Tampilan Admin
        if (auth()->user()->role === 'admin') {
            // Diarahkan ke folder views/user/doctor_list.blade.php (misalnya)
            return view('admin.doctors.index', compact('doctors'));
        } else {
            // Tampilan User
            return view('member.list-dokter', compact('doctors'));
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('doctor.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        // Validasi input data dokter
        $request->validate([
            'doctor_name' => 'required|string|max:255',
            'specialization' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|max:255',
        ]);

        $data = new Doctor();
        $data->doctor_name = $request->input('doctor_name'); 
        $data->specialization = $request->input('specialization'); 
        $data->phone = $request->input('phone'); 
        $data->email = $request->input('email'); 
        $data->save();

        return redirect()->route('doctor.index')->with('success', 'Successfully created doctor data.');
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
        return view('doctor.edit', compact('doctor'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Doctor $doctor)
    {
        //
        $doctor->doctor_name = $request->doctor_name;
        $doctor->specialization = $request->specialization;
        $doctor->phone = $request->phone;
        $doctor->email = $request->email;
        $doctor->save();

        return redirect()->route('doctor.index')->with('success', 'Successfully updated doctor data');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Doctor $doctor)
    {
        //
        $id = $request->id;
        $data = Doctor::find($id);
        if ($data) {
            $data->delete();
            return response()->json(array(
                'status' => 'oke',
                'msg' => 'Doctor data is removed !'
            ), 200);
        }
        return response()->json(array('status' => 'error', 'msg' => 'Data tidak ditemukan'), 404);
    }

    // Member — halaman jadwal semua dokter
    public function schedule()
    {
        $doctors = Doctor::with('user', 'schedules')->get();
        return view('member.jadwal-dokter', compact('doctors'));
    }

    public function getEditFormB(Request $request)
    {
        $id = $request->id;
        $data = Doctor::find($id);
        
        return response()->json(array(
            'status' => 'oke',
            'msg' => view('doctor.getEditFormB', compact('data'))->render()
        ), 200);
    }
    public function saveDataUpdate(Request $request)
    {
        $id = $request->id;
        $data = Doctor::find($id);
        if ($data) {
            $data->doctor_name = $request->doctor_name; 
            $data->specialization = $request->specialization; 
            $data->phone = $request->phone; 
            $data->email = $request->email; 
            $data->save();
            return response()->json(array('status' => 'oke', 'msg' => 'Doctor data is up-to-date !'), 200);
        }
        return response()->json(array('status' => 'error', 'msg' => 'Data tidak ditemukan'), 404);
    }
}
