<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle($request, Closure $next)
    {
        if (!Auth::guard('admin')->check()) {
            return redirect()->route('admin.login')->with('error', 'Anda harus login sebagai admin terlebih dahulu.');
        }

        if (Auth::guard('siswa')->check()) {
            Auth::guard('siswa')->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return redirect()->route('admin.login')->with('error', 'Anda sedang login sebagai siswa. Silakan login kembali sebagai admin.');
        }

        return $next($request);
    }
}
