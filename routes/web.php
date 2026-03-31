<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminAspirasiController;
use App\Http\Controllers\SiswaDashboardController;
use App\Http\Controllers\SiswaAspirasiController;
use App\Http\Controllers\SiswaController;

// Halaman Login
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');

// Routes Admin
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', function () {
        if (auth()->guard('admin')->check()) {
            return redirect()->route('admin.dashboard');
        }
        return app()->make(LoginController::class)->showLoginForm();
    })->name('login');

    Route::middleware(['admin'])->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

        // Pengaduan
        Route::get('/aspirasi', [AdminAspirasiController::class, 'index'])->name('aspirasi.index');
        Route::get('/aspirasi/filter', [AdminAspirasiController::class, 'filter'])->name('aspirasi.filter');
        Route::put('/aspirasi/{id}', [AdminAspirasiController::class, 'update'])->name('aspirasi.update');
        Route::delete('/aspirasi/{id}', [AdminAspirasiController::class, 'destroy'])->name('aspirasi.destroy'); // Opsional
        Route::get('/aspirasi/riwayat', [AdminAspirasiController::class, 'riwayat'])->name('aspirasi.riwayat');
        Route::get('/aspirasi/ringkasan', [AdminAspirasiController::class, 'ringkasan'])->name('aspirasi.ringkasan');

        Route::resource('/siswa', SiswaController::class);

        // Logout
        Route::post('/logout', [LoginController::class, 'logoutAdmin'])->name('logout');
    });
});

// Routes Siswa
Route::prefix('siswa')->name('siswa.')->group(function () {
    Route::get('/login', function () {
        if (auth()->guard('siswa')->check()) {
            return redirect()->route('siswa.dashboard');
        }
        return app()->make(LoginController::class)->showLoginForm();
    })->name('login');

    Route::middleware(['siswa'])->group(function () {
        Route::get('/dashboard', [SiswaDashboardController::class, 'index'])->name('dashboard');

        // Pengaduan
        Route::get('/aspirasi', [SiswaAspirasiController::class, 'index'])->name('aspirasi.index');
        Route::get('/aspirasi/create', [SiswaAspirasiController::class, 'create'])->name('aspirasi.create');
        Route::post('/aspirasi', [SiswaAspirasiController::class, 'store'])->name('aspirasi.store');
        Route::get('/aspirasi/{id}', [SiswaAspirasiController::class, 'show'])->name('aspirasi.show');
        Route::get('/aspirasi/{aspirasi}/edit', [SiswaAspirasiController::class, 'edit'])->name('aspirasi.edit');
        Route::put('/aspirasi/{aspirasi}', [SiswaAspirasiController::class, 'update'])->name('aspirasi.update');
        Route::delete('/aspirasi/{id}', [SiswaAspirasiController::class, 'destroy'])->name('aspirasi.destroy');
        // Route::get('/aspirasi/riwayat', [SiswaAspirasiController::class, 'riwayat'])->name('aspirasi.riwayat');
        // Route::get('/aspirasi/ringkasan', [SiswaAspirasiController::class, 'ringkasan'])->name('aspirasi.ringkasan');

        // Logout
        Route::post('/logout', [LoginController::class, 'logoutSiswa'])->name('logout');
    });
});

// Redirect root ke login
Route::get('/', function () {
    if (auth()->guard('admin')->check()) {
        return redirect()->route('admin.dashboard');
    } elseif (auth()->guard('siswa')->check()) {
        return redirect()->route('siswa.dashboard');
    }
    return redirect()->route('login');
});
