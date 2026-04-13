<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookingController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// --- PUBLIC ROUTES (No Login Required) ---
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


// --- PROTECTED ROUTES (Login Required) ---
Route::middleware(['auth'])->group(function () {

    // Member Dashboard
    Route::get('/menu', function () {
        return view('menu');
    })->name('menu');

    // Consultation Booking Feature (khusus member)
    Route::get('menu/janji/{doctor_id}', [BookingController::class, 'create'])->name('booking.create');
    Route::post('menu/janji', [BookingController::class, 'store'])->name('booking.store');

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