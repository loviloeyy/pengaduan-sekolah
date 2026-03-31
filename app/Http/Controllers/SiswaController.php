<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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
            'nis' => 'required|string|max:20|unique:siswas,nis',
            'kelas' => 'required|string|max:10',
            'name' => 'required|string|max:255',
            'password' => 'required|string|min:6',
        ]);

        Siswa::create([
            'nis' => $request->nis,
            'kelas' => $request->kelas,
            'name' => $request->name,
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
            'kelas' => 'required|string|max:10',
            'name' => 'required|string|max:255',
            'password' => 'nullable|string|min:6',
        ]);

        $data = [
            'kelas' => $request->kelas,
            'name' => $request->name,
        ];

        // Jika password diisi, update password
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
}
