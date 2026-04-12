<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class SiswaMiddleware
{
    public function handle($request, Closure $next)
    {
        if (!Auth::guard('siswa')->check()) {

            if (Auth::guard('admin')->check()) {
                Auth::guard('admin')->logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();
            }

            return redirect()->route('login')
                ->with('error', 'Anda harus login sebagai siswa terlebih dahulu.');
        }

        if (Auth::guard('admin')->check()) {
            Auth::guard('admin')->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()->route('login')
                ->with('error', 'Akun Admin tidak dapat mengakses halaman Siswa.');
        }

        return $next($request);
    }
}
