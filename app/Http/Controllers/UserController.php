<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return view('admin.users.kelola-user', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.user-create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
            'role' => 'required|in:admin,doctor,member',
            'photo' => 'required|image|mimes:jpg,jpeg,png',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => $request->role,
            'photo' => "",
        ]);

        //proses utk menyimpan foto ke folder storage
        $folder = $user->role; //nama folder = nama role, dipisahkan dgn role
        $extension = $request->file('photo')->getClientOriginalExtension(); //get extension supaya direname tetap extension sama
        $filename = "{$user->id}.{$extension}"; //file name menggunakan user id+extension
        $photoPath = "{$folder}/{$filename}"; //photopath adalah path lengkap "nama_folder/nama_file.extension"

        $request->file('photo')->storeAs($folder, $filename, 'public'); //disimpan di folder public/storage

        $user->update(['photo' => $photoPath]); //photopath disimpan di database

        return redirect()->route('admin.kelolaUser')->with('success', 'Data user baru berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'role'  => 'required|in:admin,doctor,member',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png',
        ]);

        $user = User::findOrFail($id);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
        ]);

        if ($request->hasFile('photo')) { //JIKA edit data ada file foto
            if ($user->photo && Storage::disk('public')->exists($user->photo)) { //JIKA ada foto lama, delete
                Storage::disk('public')->delete($user->photo);
            }
            $folder = $request->role;
            $extension = $request->file('photo')->getClientOriginalExtension();
            $filename = "{$user->id}.{$extension}";
            $photoPath = "{$folder}/{$filename}";

            $request->file('photo')->storeAs($folder, $filename, 'public');

            $updateData['photo'] = $photoPath;
        }

        $user->update($updateData);

        if ($request->filled('password')) {
            $user->update([
                'password' => bcrypt($request->password)
            ]);
        }

        return redirect()->route('admin.kelolaUser')->with('success', 'Data user berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return response()->json(array(
            'status' => 'oke',
            'msg' => 'Data pengguna berhasil dihapus!'
        ), 200);
    }
}
