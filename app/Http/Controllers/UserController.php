<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
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
        try {
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
            $folder = $user->role;
            $extension = $request->file('photo')->getClientOriginalExtension();
            $filename = "{$user->id}.{$extension}";
            $photoPath = "{$folder}/{$filename}";

            $request->file('photo')->storeAs($folder, $filename, 'public');

            $user->update(['photo' => $photoPath]);

            if ($request->role === 'doctor') {
                return redirect()
                    ->route('admin.doctors.editFromUser', $user->id)
                    ->with('info', 'Silakan lengkapi data dokter.');
            }

            return redirect()->route('admin.kelolaUser')->with('success', 'Data user baru berhasil ditambahkan!');

        } catch (\Exception $e) {
            return back()->with('error', 'Error: ' . $e->getMessage())->withInput();
        }
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
     *
     * Route Model Binding: Laravel otomatis meng-inject instance User
     * berdasarkan {user} pada URL, sesuai contoh "edit(Category $category)"
     * di slide 12 (Route Model Binding).
     */
    public function edit(User $user)
    {
        return view('admin.users.edit-user', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * Route Model Binding: parameter update() langsung berupa objek User,
     * bukan $id + findOrFail() manual, mengikuti pola "update(Request $request,
     * Category $category)" pada slide 12.
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'role' => 'required|in:admin,doctor,member',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png',
        ]);

        $updateData = [
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
        ];

        if ($request->hasFile('photo')) {
            if ($user->photo && Storage::disk('public')->exists($user->photo)) {
                Storage::disk('public')->delete($user->photo);
            }
            $folder = $request->role;

            $extension = $request->file('photo')->getClientOriginalExtension();
            $filename = "{$user->id}.{$extension}";
            $photoPath = "{$folder}/{$filename}";

            $request->file('photo')->storeAs($folder, $filename, 'public');
            $updateData['photo'] = $photoPath;
        } elseif ($user->role !== $request->role && $user->photo) {
            $newFolder = $request->role;

            if (Storage::disk('public')->exists($user->photo)) {
                $extension = pathinfo($user->photo, PATHINFO_EXTENSION);
                $newPhotoPath = "{$newFolder}/{$user->id}.{$extension}";
                Storage::disk('public')->move($user->photo, $newPhotoPath);
                $updateData['photo'] = $newPhotoPath;
            }
        }

        //pengecekan kalau role lama dokter diganti menjadi member atau admin, data di tabel dokter dihapus.
        if ($user->role === 'doctor' && $request->role !== 'doctor') {
            if ($user->doctor) {
                $user->doctor()->delete();
            }
        }

        $user->update($updateData);

        if ($request->filled('password')) {
            $user->update([
                'password' => bcrypt($request->password)
            ]);
        }

        if ($request->role === 'doctor') { //JIKA role diganti dokter, perlu mengisi/update data dokter
            return redirect()
                ->route('admin.doctors.editFromUser', $user->id)
                ->with('info', 'Silakan lengkapi data dokter.');
        }

        return redirect()->route('admin.kelolaUser')->with('success', 'Data user berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * Mengikuti pola slide 29 & 31: proses delete dibungkus try-catch agar
     * error (mis. foreign key constraint jika relasi belum bisa dihapus)
     * ditangani dengan handler sukses/gagal, bukan meledak jadi 500 error.
     * Parameter juga memakai Route Model Binding, sama seperti edit()/update().
     */
    public function destroy(User $user)
    {
        try {
            if ($user->photo && Storage::disk('public')->exists($user->photo)) { //JIKA ada foto THEN delete foto di local
                Storage::disk('public')->delete($user->photo);
            }

            if ($user->role === 'doctor') { //untuk menghapus data dokter jika user merupakan role dokter
                if ($user->doctor) {
                    $user->doctor()->delete();
                }
            }

            $user->delete(); //soft delete

            return redirect()->route('admin.kelolaUser')->with('success', 'User berhasil dihapus!');

        } catch (\Exception $e) {
            return redirect()->route('admin.kelolaUser')->with('error', 'Gagal menghapus user: ' . $e->getMessage());
        }
    }
}