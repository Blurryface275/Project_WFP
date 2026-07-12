<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Str;

class PasswordResetController extends Controller
{
    //
    // Nampilin form halaman "Lupa Password" pas user mengeluh lupa ingatan di halaman login
    public function showRequestForm()
    {
        return view('auth.forgot-password');
    }
    
    // Fungsi ini jalan pas user masukin email buat minta link reset
    public function sendResetLinkEmail(Request $request)
    {
        // Pastiin dulu inputannya beneran ketikan email dan emang ada nyangkut di database kita
        $request->validate([
            'email' => 'required|email']);
        
        // Suruh laravel bikinin token unik sama kirimin email link-nya sekalian
        $status = Password::sendResetLink(
            $request->only('email'));

        // misale email sukses kekirim, kita balikin ke halaman tadi + munculin pesan sukses
        // ato misale bermasalah, kita komplain ke user ngasih tau emailnya error
        return $status == Password::RESET_LINK_SENT // RESET_LINK_SENT ini adalah status yang dikembalikan oleh laravel
            ? back()->with('status', __('Link reset password berhasil dikirim'))
            : back()->withErrors(['email' => __('Email tidak ditemukan')]);
    }

    // Nampilin form buat masukin sandi baru sesudah user mengklik link di dalem emailnya
    // $token harus null dulu karena nanti pas user klik link di email, tokennya bakal diisi
    public function showResetForm(Request $request, $token = null)
    {
        // Kita tangkep token sakti dari url link emailnya trus lempar ke view biar gampang disubmit bareng form
        // Jangan lupa ambil parameter email dari URL request juga biar ke-isi otomatis di formnya!
        return view('auth.reset-password', [
            'token' => $token, 
            'email' => $request->email
        ]); 
    }

    // Nah ini eksekusi pamungkas ngganti datanya pas user mencet tombol "Simpan Password Baru"
    public function reset(Request $request)
    {
        // Validasi dulu, pastiin tokennya ada, email sesuai format, sama password minimal 8 huruf & cocok sama password barunya
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:8',
        ]);

        // Minta laravel nyocokkin form sama token di database biar dikroscek bener/enggaknya
        // Trus kalo pas, otomatis baris kode di dalem function ini bakal update password lamanya digusur sama password baru
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'), // email, password, password_confirmation, token diambil dari form
            function ($user, $password) { // $user adalah user yang login, $password adalah password baru
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));
                
                $user->save();
                event(new PasswordReset($user));
            }
        );

        // Kalo berhasil kabeh, giring user suruh login ulang dari awal pake sandi barunya
        // Atau kalo tokennya udah basi karena kelamaan, ya balikin suruh ngulang minta link haha
        return $status == Password::PASSWORD_RESET
            ? redirect()->route('login')->with('status', __('Password berhasil direset'))
            : back()->withErrors(['email' => __('Token tidak valid atau kadaluarsa')]);
    }

}
