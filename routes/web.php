<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminAspirasiController;
use App\Http\Controllers\SiswaDashboardController;
use App\Http\Controllers\SiswaAspirasiController;
use App\Http\Controllers\SiswaController;

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');

Route::get('/register-siswa', [SiswaController::class, 'showRegisterForm'])->name('siswa.register.form');
Route::post('/register-siswa', [SiswaController::class, 'register'])->name('siswa.register');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::middleware(['admin'])->group(function () {

        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

        // Manajemen Pengaduan (Aspirasi) - Admin
        Route::get('/aspirasi', [AdminAspirasiController::class, 'index'])->name('aspirasi.index');
        Route::get('/aspirasi/filter', [AdminAspirasiController::class, 'filter'])->name('aspirasi.filter');
        Route::put('/aspirasi/{id}', [AdminAspirasiController::class, 'update'])->name('aspirasi.update');
        Route::delete('/aspirasi/{id}', [AdminAspirasiController::class, 'destroy'])->name('aspirasi.destroy');
        Route::get('/aspirasi/riwayat', [AdminAspirasiController::class, 'riwayat'])->name('aspirasi.riwayat');
        Route::get('/aspirasi/ringkasan', [AdminAspirasiController::class, 'ringkasan'])->name('aspirasi.ringkasan');

        Route::resource('/siswa', SiswaController::class);

        Route::post('/logout', [LoginController::class, 'logoutAdmin'])->name('logout');
    });
});

Route::prefix('siswa')->name('siswa.')->group(function () {
    Route::middleware(['siswa'])->group(function () {

        Route::get('/dashboard', [SiswaDashboardController::class, 'index'])->name('dashboard');

        Route::get('/aspirasi', function() {
            return redirect()->route('siswa.dashboard');
        });

        Route::get('/aspirasi/create', [SiswaAspirasiController::class, 'create'])->name('aspirasi.create');
        Route::post('/aspirasi', [SiswaAspirasiController::class, 'store'])->name('aspirasi.store');

        Route::get('/aspirasi/{id}', [SiswaAspirasiController::class, 'show'])->name('aspirasi.show');

        // Route::get('/aspirasi/{aspirasi}/edit', ...)->name('aspirasi.edit');
        // Route::put('/aspirasi/{aspirasi}', ...)->name('aspirasi.update');
        // Route::delete('/aspirasi/{id}', ...)->name('aspirasi.destroy');

        Route::post('/logout', [LoginController::class, 'logoutSiswa'])->name('logout');
    });
});

Route::get('/', function () {
    if (auth()->guard('admin')->check()) {
        return redirect()->route('admin.dashboard');
    } elseif (auth()->guard('siswa')->check()) {
        return redirect()->route('siswa.dashboard');
    }
    return redirect()->route('login');
});
