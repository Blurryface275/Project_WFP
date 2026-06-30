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
        return view('admin.doctors.insertDoctors');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        //Validasi input data dokter
        $request->validate([
            'name' => 'required|string|max:255',
            'specialization' => 'required|string|max:255',
            'experience_years' => 'required|integer|min:0',
            'phone_number' => 'required|string|max:20',
            'email' => 'required|email|max:255',
        ]);

        $data = new Doctor();
        $data->user_id = auth()->user()->id;
        $data->name = $request->input('name'); 
        $data->specialization = $request->input('specialization');
        $data->experience_years = $request->input('experience_years');
        $data->phone_number = $request->input('phone_number'); 
        $data->email = $request->input('email'); 
        $data->save();

        return redirect()->route('doctors.index')->with('success', 'Successfully created doctor data.');
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
        $doctor->name = $request->name;
        $doctor->specialization = $request->specialization;
        $doctor->phone_number = $request->phone;
        $doctor->email = $request->email;
        $doctor->save();

        return redirect()->route('doctors.index')->with('success', 'Successfully updated doctor data');
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
        $doctors = Doctor::with('user', 'schedules')->get();
        return view('member.jadwal-dokter', compact('doctors'));
    }

    public function getEditFormB(Request $request)
    {
        $id = $request->id;
        $data = Doctor::find($id);
        return response()->json(array(
            'status' => 'oke',
            'msg' => view('admin.doctors.getEditForm', compact('data'))->render()
        ), 200);
    }

    public function deleteData(Request $request)
    {
        $id = $request->id;
        $data = Doctor::find($id); // Pastikan nama model 'Doctor' diawali huruf kapital sesuai nama file model kamu
        
        if ($data) {
            $data->delete();
            return response()->json([
                'status' => 'oke',
                'msg' => 'Doctor data is removed !'
            ], 200);
        }
        
        return response()->json([
            'status' => 'error', 
            'msg' => 'Data tidak ditemukan'
        ], 404);
    }
}
