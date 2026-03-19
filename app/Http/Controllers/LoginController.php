<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        if (Auth::guard('admin')->check()) {
            return redirect()->route('admin.dashboard');
        }

        if (Auth::guard('siswa')->check()) {
            return redirect()->route('siswa.dashboard');
        }

        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
            'role' => 'required|in:admin,siswa',
        ]);

        if ($request->role === 'admin' && Auth::guard('siswa')->check()) {
            Auth::guard('siswa')->logout();
        } elseif ($request->role === 'siswa' && Auth::guard('admin')->check()) {
            Auth::guard('admin')->logout();
        }

        $credentials = [
            $request->role === 'admin' ? 'username' : 'nis' => $request->username,
            'password' => $request->password,
        ];

        if (Auth::guard($request->role)->attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();
            return redirect()->intended(route($request->role . '.dashboard'));
        }

        return back()->withErrors([
            'username' => 'Username/NIS atau password salah.',
        ])->withInput($request->only('username', 'remember'));
    }

    public function logoutAdmin(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login')->with('success', 'Anda berhasil logout.');
    }

    public function logoutSiswa(Request $request)
    {
        Auth::guard('siswa')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login')->with('success', 'Anda berhasil logout.');
    }
}
