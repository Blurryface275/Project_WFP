<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookingController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\CategoryController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Route::get('/', function () {
//     return view('index');
// });

//Root utama dashboard admin
Route::redirect('/', '/admin/dashboard');

// Menampilkan halaman welcome
Route::get('/welcome', function () {
    return view('welcome');
})->name('welcome');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// MENU
// Menampilkan halaman menu
Route::get('/menu', function () {
    return view('menu');
});
// Menampilkan halaman konsultasi online
Route::get('menu/konsultasi', function () {
    return view('konsultasi');
});
// Menampilkan halaman booking konsultasi
Route::get('menu/janji', function () {
    return view('janji');
});
// Menampilkan halaman riwayat konsultasi
Route::get('menu/riwayat', function () {
    return view('riwayat');
});

// --- PROTECTED ROUTES (Login Required) ---
Route::middleware(['auth'])->group(function () {

Route::get('/doctor', function () {
    return view('doctor.dashboard');
});

// ADMIN
// Menampilkan halaman dashboard admin (khusus hanya untuk admin)
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');
    Route::get('/manageuser', [UserController::class, 'index'])->name('users');
    Route::get('/listdoctor', [DoctorController::class, 'index'])->name('doctor.list');
    Route::get('/detaildoctor/{id}', [DoctorController::class, 'show'])->name('doctor.show');
    // DAFTAR BELUM DIIMPLEMENTASI
    // Route::get('/daftardokter', [DoctorController::class, 'daftarDokter'])->name('dokter.daftar');
});

    // Doctor Directory
    Route::resource('doctors', DoctorController::class);

    // Placeholder Menu Pages
    Route::get('menu/konsultasi', function () {
        return view('konsultasi');
    })->name('menu.konsultasi');
    Route::get('menu/riwayat', function () {
        return view('riwayat');
    })->name('menu.riwayat');
    Route::get('/artikel', function () {
        return view('/artikel');
    })->name('artikel');
    Route::get('/article/{id}', function ($id) {
        // nanti diganti controller
        return view('/artikel/{id}');
    })->name('artikel.show');

    // Admin Section
    Route::middleware(['admin'])->prefix('admin')->group(function () {
        // Unified dashboard pointing to user management
        Route::get('/dashboard', [UserController::class, 'index'])->name('admin.dashboard');

        // Kelola User CRUD
        Route::get('/kelolauser', [UserController::class, 'index'])->name('admin.kelolaUser');
        Route::post('/kelolauser', [UserController::class, 'store'])->name('admin.kelolaUser.store');
        Route::put('/kelolauser/{id}', [UserController::class, 'update'])->name('admin.kelolaUser.update');
        Route::delete('/kelolauser/{id}', [UserController::class, 'destroy'])->name('admin.kelolaUser.destroy');

// Buat liat jadwal dokter
Route::get('jadwalDoctor', [DoctorController::class, 'schedule'])->name('doctors.schedule');

// Routing Article
// Hanya membuka route index (tampilkan keseluruhan artikel) dan show (tampilkan detail artikel)
Route::resource('articles', ArticleController::class)->only(['index', 'show']);;

// Routing Service
// Hanya membuka route index dan show (tampilkan keseluruhan service dan detailnya)
Route::resource('services', ServiceController::class)->only(['index', 'show']);

// Routing Category
// Hanya membuka route index
Route::resource('categories', CategoryController::class)->only(['index']);


Route::prefix('doctor')->name('doctor.')->group(function () {
    Route::get('/dashboard', function () { return view('doctor.dashboard'); })->name('dashboard');
    Route::get('/profile', function () { return view('doctor.profile'); })->name('profile');
    Route::get('/consultations', function () { return view('doctor.consultations'); })->name('consultations');
});
        // Admin Placeholders
        Route::get('/categories', function () {
            return view('categories');
        })->name('admin.categories');
        Route::get('/order', function () {
            return view('order');
        })->name('admin.order');
        Route::get('/members', function () {
            return view('members');
        })->name('admin.members');
    });
});
