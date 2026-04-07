<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('index');
});

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
Route::get('admin/categories', function () {
    return view('categories');
});

Route::get('admin/order', function () {
    return view('order');
});

Route::get('admin/members', function () {
    return view('members');
});
