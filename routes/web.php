<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminAspirasiController;
use App\Http\Controllers\SiswaDashboardController;
use App\Http\Controllers\SiswaAspirasiController;
use App\Http\Controllers\SiswaController;

// --- ROUTE PUBLIK ---
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');

// Register Siswa
Route::get('/register-siswa', [SiswaController::class, 'showRegisterForm'])->name('siswa.register.form');
Route::post('/register-siswa', [SiswaController::class, 'register'])->name('siswa.register');

// --- ROUTE ADMIN ---
Route::prefix('admin')->name('admin.')->middleware(['admin'])->group(function () {

    // Dashboard
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    // Manajemen Pengaduan
    Route::get('/aspirasi', [AdminAspirasiController::class, 'index'])->name('aspirasi.index');
    Route::get('/aspirasi/filter', [AdminAspirasiController::class, 'filter'])->name('aspirasi.filter');
    Route::put('/aspirasi/{id}', [AdminAspirasiController::class, 'update'])->name('aspirasi.update');
    Route::delete('/aspirasi/{id}', [AdminAspirasiController::class, 'destroy'])->name('aspirasi.destroy');
    Route::get('/aspirasi/riwayat', [AdminAspirasiController::class, 'riwayat'])->name('aspirasi.riwayat');

    // Manajemen Siswa (READ ONLY: List & Detail)
    Route::get('/siswa', [SiswaController::class, 'index'])->name('siswa.index');
    Route::get('/siswa/{siswa}', [SiswaController::class, 'show'])->name('siswa.show');

    // Logout
    Route::post('/logout', [LoginController::class, 'logoutAdmin'])->name('logout');
});

// --- ROUTE SISWA ---
Route::prefix('siswa')->name('siswa.')->middleware(['siswa'])->group(function () {

    // Dashboard
    Route::get('/dashboard', [SiswaDashboardController::class, 'index'])->name('dashboard');

    // Pengaduan Siswa
    Route::get('/aspirasi/create', [SiswaAspirasiController::class, 'create'])->name('aspirasi.create');
    Route::post('/aspirasi', [SiswaAspirasiController::class, 'store'])->name('aspirasi.store');
    Route::get('/aspirasi/{id}', [SiswaAspirasiController::class, 'show'])->name('aspirasi.show');

    // Logout
    Route::post('/logout', [LoginController::class, 'logoutSiswa'])->name('logout');
});

// --- ROUTE DEFAULT ---
Route::get('/', function () {
    if (auth()->guard('admin')->check()) {
        return redirect()->route('admin.dashboard');
    } elseif (auth()->guard('siswa')->check()) {
        return redirect()->route('siswa.dashboard');
    }
    return redirect()->route('login');
});
