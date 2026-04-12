<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle($request, Closure $next)
    {
        if (!Auth::guard('admin')->check()) {

            if (Auth::guard('siswa')->check()) {
                Auth::guard('siswa')->logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();
            }

            return redirect()->route('login')
                ->with('error', 'Anda harus login sebagai admin terlebih dahulu.');
        }

        if (Auth::guard('siswa')->check()) {
            Auth::guard('siswa')->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()->route('login')
                ->with('error', 'Akun siswa tidak memiliki akses ke halaman Admin. Silakan login dengan akun Admin.');
        }

        return $next($request);
    }
}
