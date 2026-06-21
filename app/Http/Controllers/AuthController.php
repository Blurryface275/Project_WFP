<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login'); // send ke page view login
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // auth-> attempt -> credentials artinya mencoba login dengan credentials yang diberikan 
        // -> klo berhasil maka akan diarahkan ke intended, klo nggak maka akan diarahkan ke back
        if (auth()->attempt($credentials)) {
            // ini pokoe wajib soale biar nanti pas logout trus login lagi nggak error
            $request->session()->regenerate(); 
            
            // ambil data user yang login
            $user = auth()->user(); 

            // ambil url tujuan sebelum login, klo nggak ada maka akan diarahkan ke welcome
            $intendedUrl = redirect()->intended()->getTargetUrl();

            if ($intendedUrl === url('/') || $intendedUrl === route('login') || str_contains($intendedUrl, 'dashboard')){
                //kalo yg login adalah admin maka akan diarahkan ke admin/dashboard 
                //kalo yg login adalah doctor maka akan diarahkan ke doctor/dashboard
                //kalo yg login adalah member maka akan diarahkan ke member/dashboard   
                if ($user->role==="admin"){
                    return redirect('/admin/dashboard');
                }
                elseif ($user->role==="doctor"){
                    return redirect('/doctor/dashboard');
                }
                elseif (auth()->user()->role==="member"){
                    return redirect('/welcome');
                }
            }

            // jika user login tapi url tujuan bukan welcome, login, atau dashboard, 
            // maka akan diarahkan ke url asal sebelum login 
            // klo memang gaada url tujuan sebelum login, maka akan diarahkan ke welcome
            return redirect()->intended('/welcome'); 


        }

        return back()->with('error', 'Email atau Password salah.');
    }

    public function showRegister()
    {
        return view('auth.register'); // send ke page view register
    }

    public function register(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Buat user baru (set otomatis role as a member sampai nanti admin ubah manual ke doctor/ tetap member)
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => 'member', // set sebagai default role
        ]);

        // Auto login setelah register 
        auth()->login($user);
        $request->session()->regenerate(); // regenerate session untuk keamanan
    
        // Redirect ke welcome page karena default adalah member
        return redirect()->intended('/welcome'); // intended artinya jika user sebelumnya mau akses page tertentu sebelum login, maka setelah login akan diarahkan ke page tersebut, jika tidak ada maka ke dashboard
    }

    public function logout(Request $request)
    {
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
