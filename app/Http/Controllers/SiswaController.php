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

    public function create()
    {
        return view("admin.siswa.create");
    }

    public function store(Request $request)
    {
        $request->validate([
            'nis'     => 'required|string|max:20|unique:siswas,nis',
            'name'    => 'required|string|max:255',
            'kelas'   => 'required|string|max:10',
            'email'   => 'required|string|email|max:255|unique:siswas,email',
            'password'=> 'required|string|min:6',
        ]);

        Siswa::create([
            'nis'      => $request->nis,
            'name'     => $request->name,
            'kelas'    => $request->kelas,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('admin.siswa.index')
            ->with('success', 'Data siswa berhasil ditambahkan!');
    }

    public function show(Siswa $siswa)
    {
        return view("admin.siswa.show", compact("siswa"));
    }

    public function edit(Siswa $siswa)
    {
        return view("admin.siswa.edit", compact("siswa"));
    }

    public function update(Request $request, Siswa $siswa)
    {
        $request->validate([
            'nis'     => 'required|string|max:20|unique:siswas,nis,' . $siswa->nis . ',nis',
            'name'    => 'required|string|max:255',
            'kelas'   => 'required|string|max:10',
            'email'   => 'required|string|email|max:255|unique:siswas,email,' . $siswa->nis . ',nis',
            'password'=> 'nullable|string|min:6',
        ]);

        $data = [
            'nis'     => $request->nis,
            'name'    => $request->name,
            'kelas'   => $request->kelas,
            'email'   => $request->email,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $siswa->update($data);

        return redirect()->route('admin.siswa.index')
            ->with('success', 'Data siswa berhasil diperbarui!');
    }

    public function destroy(Siswa $siswa)
    {
        $siswa->delete();
        return redirect()->route('admin.siswa.index')
            ->with('success', 'Data siswa berhasil dihapus!');
    }

    public function showRegisterForm()
    {
        if (Auth::guard('siswa')->check()) {
            return redirect()->route('siswa.dashboard');
        }
        return view('auth.register-siswa');
    }

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
            ->with('success', 'Register berhasil, silakan login.');
    }
}
