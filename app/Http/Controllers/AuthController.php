<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login'); // Pastikan view ini nanti dibuat
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (auth()->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/admin/dashboard');
        }

        return back()->with('error', 'Email atau Password salah.');
    }

    public function showRegister()
    {
        return view('auth.register'); // Pastikan view ini nanti dibuat
    }

    public function register(Request $request)
    {
        // Placeholder untuk logika register
        return redirect('/login')->with('success', 'Registrasi berhasil, silakan login!');
    }

    public function logout(Request $request)
    {
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
