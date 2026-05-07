<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DoctorController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TransactionController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('index');
// });

//Root utama dashboard admin
Route::redirect('/', '/welcome');

// Menampilkan halaman welcome
Route::get('/welcome', function () {
    return view('welcome');
});

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

Route::get('/artikel', function () {
    return view('artikel');
});

Route::get('/dokter', function () {
    return view('dokter');
});

// ADMIN
// Menampilkan halaman dashboard admin (khusus hanya untuk admin)
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');
    Route::get('/manageusers', [UserController::class, 'index'])->name('users');
    Route::get('/managecategories', [CategoryController::class, 'kelola'])->name('categories');
    Route::get('/managearticles', [ArticleController::class, 'kelola'])->name('articles');
    Route::get('/managedoctors', [DoctorController::class, 'kelola'])->name('doctors');
    Route::get('/listdokter', [DoctorController::class, 'index'])->name('dokter.list');
    Route::get('/detaildokter/{id}', [DoctorController::class, 'show'])->name('dokter.show');
    // DAFTAR BELUM DIIMPLEMENTASI
    // Route::get('/daftardokter', [DoctorController::class, 'daftarDokter'])->name('dokter.daftar');
});

//NOTES : pindah ke group function
Route::get('admin/categories', function () {
    return view('categories');
});

Route::get('admin/order', function () {
    return view('order');
});

Route::get('admin/members', function () {
    return view('members');
});

//Buat list dokter di user
Route::resource('doctors', DoctorController::class);

// Buat liat jadwal dokter
Route::get('jadwalDokter', [DoctorController::class, 'schedule'])->name('doctors.schedule');

// Booking Konsultasi
Route::get('/doctors/{id}/book', [DoctorController::class, 'book'])->name('doctors.book');
Route::post('/bookings', [TransactionController::class, 'store'])->name('bookings.store');

// Routing Article
// Hanya membuka route index (tampilkan keseluruhan artikel) dan show (tampilkan detail artikel)
Route::resource('articles', ArticleController::class)->only(['index', 'show']);;

// Routing Service
// Hanya membuka route index dan show (tampilkan keseluruhan service dan detailnya)
Route::resource('services', ServiceController::class)->only(['index', 'show']);

// Routing Category
// Hanya membuka route index
Route::resource('categories', CategoryController::class)->only(['index']);
