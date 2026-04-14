<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class SiswaController extends Controller
{
    public function index()
    {
        $Siswas = Siswa::paginate(10);
        return view("admin.siswa.index", compact("Siswas"));
    }

    public function show(Siswa $siswa)
    {
        return view("admin.siswa.show", compact("siswa"));
    }

    /**
     * METHOD DI BAWAH INI DIHAPUS/TIDAK DIGUNAKAN OLEH ADMIN:
     * - create()
     * - store()
     * - edit()
     * - update()
     * - destroy()

    /**
     * Menampilkan form register untuk siswa baru
     */
    public function showRegisterForm()
    {
        // Jika sudah login sebagai siswa, redirect ke dashboard
        if (Auth::guard('siswa')->check()) {
            return redirect()->route('siswa.dashboard');
        }
        return view('auth.register-siswa');
    }

    /**
     * Memproses pendaftaran siswa baru
     */
    public function register(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'nis'      => 'required|string|max:20|unique:siswas,nis',
            'kelas'    => 'required|string|max:10',
            'email'    => 'required|string|email|max:255|unique:siswas,email',
            'password' => 'required|string|min:6|confirmed',
        ]);

        Siswa::create([
            'name'     => $request->name,
            'nis'      => $request->nis,
            'kelas'    => $request->kelas,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('login')
            ->with('success', 'Registrasi berhasil! Silakan login dengan akun Anda.');
    }
}
