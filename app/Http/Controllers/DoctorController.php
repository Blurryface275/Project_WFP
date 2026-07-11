<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Storage;

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
            'experience_years' => 'required|string|min:0',
            'phone_number' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'password' => 'required|string|min:6',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => 'doctor',
            'photo' => '',
        ]);

        if ($request->hasFile('photo')) {
            $folder = 'doctor';
            $extension = $request->file('photo')->getClientOriginalExtension();
            $filename = "{$user->id}.{$extension}";
            $photoPath = "{$folder}/{$filename}";

            $request->file('photo')->storeAs($folder, $filename, 'public');
            $user->update(['photo' => $photoPath]);
        }
        $data = new Doctor();
        $data->user_id = $user->id;
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
        $request->validate([
            'name' => 'required|string|max:255',
            'specialization' => 'required|string|max:255',
            'experience_years' => 'required|string|min:0',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|max:255',
        ]);

        $doctor->name = $request->name;
        $doctor->specialization = $request->specialization;
        $doctor->experience_years = $request->experience_years;
        $doctor->phone_number = $request->phone;
        $doctor->email = $request->email;
        $doctor->save();

        return redirect()->route('doctor.list')->with('success', 'Successfully updated doctor data');
        // //
        // $doctor->name = $request->name;
        // $doctor->specialization = $request->specialization;
        // $doctor->phone_number = $request->phone;
        // $doctor->email = $request->email;
        // $doctor->save();

        // return redirect()->route('doctors.index')->with('success', 'Successfully updated doctor data');
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
        $data = Doctor::find($id);

        if ($data) {
            if ($data->user_id) {
                $user = User::find($data->user_id);
                if ($user) {
                    // JIKA ada foto user, dihapus
                    if ($user->photo && Storage::disk('public')->exists($user->photo)) {
                        Storage::disk('public')->delete($user->photo);
                    }
                    $user->delete(); // Soft delete user
                }
            }
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

    public function editFromUser(string $userId)
    {
        $user = User::findOrFail($userId);

        //pengecekan apakah data dokter untuk user id tsb sudah ada atau belum
        $doctor = Doctor::withTrashed()->where('user_id', $userId)->first();

        return view('admin.doctors.editFromUser', compact('user', 'doctor'));
    }

    public function updateFromUser(Request $request, string $userId)
    {
        $user = User::findOrFail($userId);

        $request->validate([
            'specialization' => 'required|string|max:255',
            'experience_years' => 'required|string|max:50',
            'phone_number' => 'required|string|max:20',
            'email' => 'required|email|max:255',
        ]);

        $existing = Doctor::withTrashed()->where('user_id', $userId)->first();

        $data = [
            'name' => $user->name,
            'user_id' => $userId,
            'specialization' => $request->specialization,
            'experience_years' => $request->experience_years,
            'phone_number' => $request->phone_number,
            'email' => $request->email,
        ];

        if ($existing) {
            if ($existing->trashed()) {
                $existing->restore();
            }
            $existing->update($data);
        } else {
            Doctor::create($data);
        }

        return redirect()
            ->route('admin.kelolaUser')
            ->with('success', 'Data dokter berhasil disimpan!');
    }
}
