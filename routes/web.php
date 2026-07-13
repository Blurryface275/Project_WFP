<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ConsultationController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Route::get('/', function () {
//     return view('index');
// });

// Menampilkan halaman welcome (Root)
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);


// --- PROTECTED ROUTES (Login Required) ---
Route::middleware(['auth'])->group(function () {
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

    // Rute untuk melihat halaman profile diri sendiri
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');

    // ===== BOOKING KONSULTASI (Member) =====
    Route::get('bookings', [BookingController::class, 'index'])->name('bookings.index');
    Route::get('bookings/create/{doctor}', [BookingController::class, 'create'])->name('bookings.create');
    Route::post('bookings', [BookingController::class, 'store'])->name('bookings.store');
    Route::get('bookings/{id}', [BookingController::class, 'show'])->name('bookings.show');
    Route::delete('bookings/{id}', [BookingController::class, 'destroy'])->name('bookings.destroy');
    // ========================================
    // Doctor Directory

    Route::post('/ajax/doctor/saveDataUpdate', [DoctorController::class, 'saveDataUpdate']);
    Route::post('doctors/get-edit-form', [DoctorController::class, 'getEditFormB'])->name('admin.doctors.getEditForm'); //edit form
    Route::post('/ajax/doctor/deleteData', [DoctorController::class, 'deleteData'])->name('doctors.deleteData');
    Route::resource('doctors', DoctorController::class);

    // Placeholder Menu Pages
    Route::get('menu/konsultasi', function () {
        return view('konsultasi');
    })->name('menu.konsultasi');
    Route::get('menu/riwayat', function () {
        return view('riwayat');
    })->name('menu.riwayat');

    // Admin Section
    // tujuanya biar nanti pathnya ada prefix admin di depan. misal : /admin/dashboard
    Route::prefix('admin')->middleware('role:admin')->group(function () {
        // Unified dashboard pointing to user management
        // Route::get('/dashboard', function () {
        //     return view('admin.dashboard');
        // })->name('admin.dashboard');
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

        Route::get('/insertuser', function () {
            return view('admin.users.insert-user');
        })->name('admin.insertUserView');
        Route::get('/edituser/{user}', [UserController::class, 'edit'])->name('admin.editUserView');


        // Kelola User CRUD
        Route::get('/kelolauser', [UserController::class, 'index'])->name('admin.kelolaUser');
        Route::post('/kelolauser', [UserController::class, 'store'])->name('admin.kelolaUser.store');
        Route::put('/kelolauser/{user}', [UserController::class, 'update'])->name('admin.kelolaUser.update');
        Route::delete('/kelolauser/{user}', [UserController::class, 'destroy'])->name('admin.kelolaUser.destroy');

        // update doctors dari user
        Route::get('/doctors/{user}/edit', [DoctorController::class, 'editFromUser'])->name('admin.doctors.editFromUser');
        Route::put('/doctors/{user}', [DoctorController::class, 'updateFromUser'])->name('admin.doctors.updateFromUser');

        Route::get('/doctors', [DoctorController::class, 'index'])->name('doctor.list');
        Route::get('/detaildoctor/{id}', [DoctorController::class, 'show'])->name('doctor.show');
        Route::get('/doctors/create', [DoctorController::class, 'create'])->name('admin.doctors.insertDoctors');

        // Routing Article
        Route::get('/articles', [ArticleController::class, 'adminIndex'])->name('admin.articles.index');
        Route::get('/articles/{id}/show', [ArticleController::class, 'adminShow'])->name('admin.articles.show');
        Route::resource('articles', ArticleController::class)
            ->except(['index', 'show']) // karena ini memang public dan bisa dikunjungi tanpa login
            ->names('admin.articles');

        // Routing Category
        Route::resource('categories', App\Http\Controllers\AdminCategoryController::class)
            ->names('admin.categories');

        Route::resource('services', App\Http\Controllers\AdminServiceController::class)->names('admin.services');

        // Kelola Booking Konsultasi
        Route::get('/bookings', [BookingController::class, 'adminIndex'])->name('admin.bookings.index');
        Route::delete('/bookings/{id}', [BookingController::class, 'adminDestroy'])->name('admin.bookings.destroy');
    });
    // KONSULTASI ONLINE dan CHAT
    Route::get('consultations/history', [ConsultationController::class, 'history'])->name('consultations.history');
    Route::get('consultations', [ConsultationController::class, 'index'])->name('consultations.index');
    Route::post('consultations', [ConsultationController::class, 'store'])->name('consultations.store');
    Route::get('consultations/{id}', [ConsultationController::class, 'show'])->name('consultations.show');
    Route::post('consultations/{id}/message', [ConsultationController::class, 'sendMessage'])->name('consultations.sendMessage');
    Route::get('consultations/{id}/messages', [ConsultationController::class, 'getMessages'])->name('consultations.getMessages');
    Route::post('consultations/{id}/end', [ConsultationController::class, 'endConsultation'])->name('consultations.end');
    
    // Route ini akan ditrigger ketika user belum verifikasi email
    Route::get('/email/verify', function () {
        return view('auth.verify-email');
    })->name('verification.notice');

    // Route sg ini bakalan ditrigger semisal user mengklik link verifikasi email yang dikirim ke emailnya
    Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
        $request->fulfill(); // fullfill artinya menyelesaikan verifikasi email
        return redirect('/dashboard')->with('success', 'Email berhasil diverifikasi!'); // klo berhasil verifikasi email maka akan diarahkan ke dashboard
    })->name('verification.verify');

    // Route ini akan ditrigger ketika user menekan tombol "Kirim Ulang Email Verifikasi"
    Route::post('/email/verification-notification', function (Request $request) {
        $request->user()->sendEmailVerificationNotification(); // mengirim email verifikasi
        return back()->with('success', 'Link verifikasi baru telah dikirim!'); // klo berhasil verifikasi email maka akan diarahkan ke dashboard
    })->middleware(['throttle:3,1'])->name('verification.send');
}); // Tutup Middleware Admin

// Buat liat jadwal dokter
Route::get('jadwalDoctor', [DoctorController::class, 'schedule'])->name('doctors.schedule');

// Doctor Section
// bisa dibuka oleh doctor dan admin
Route::prefix('doctor')->name('doctor.')->middleware('role:doctor,admin')->group(function () {
    Route::get('/dashboard', [DoctorController::class, 'dashboard'])->name('dashboard');
    Route::get('/profile', [DoctorController::class, 'profile'])->name('profile');
    Route::post('/profile', [DoctorController::class, 'updateProfile'])->name('profile.update');

    // Konsultasi: daftar aktif & selesai (data nyata dari DB)
    Route::get('/consultations', [ConsultationController::class, 'doctorIndex'])->name('consultations');

    // Dokter masuk ke halaman chat (reuse show yang sama dengan member)
    Route::get('/consultations/{id}', [ConsultationController::class, 'show'])->name('consultations.show');
}); // Tutup Doctor Prefix

Route::middleware('guest')->group(function () {
});

// ROUTING PUBLIK (Bisa diakses tanpa harus login ataupun saat sudah login)
// Routing Article
Route::resource('articles', ArticleController::class)->only(['index', 'show']);

// Routing Service
Route::resource('services', ServiceController::class)->only(['index', 'show']);

// Routing Category
Route::resource('categories', CategoryController::class)->only(['index', 'show']);
