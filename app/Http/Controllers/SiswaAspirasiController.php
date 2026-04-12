<?php

namespace App\Http\Controllers;

use App\Models\Aspirasi;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SiswaAspirasiController extends Controller
{
    public function index()
    {
        return redirect()->route('siswa.dashboard');
    }


    public function create()
    {
        $kategoris = Kategori::all();
        return view('siswa.aspirasi.create', compact('kategoris'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'id_kategori' => 'required|integer|exists:kategoris,id_kategori',
            'lokasi'      => 'required|string|max:100',
            'ket'         => 'required|string',
            'foto'        => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $siswa = auth()->guard('siswa')->user();

        $aspirasi = new Aspirasi();
        $aspirasi->id_aspirasi = Aspirasi::max('id_aspirasi') + 1;
        $aspirasi->nis         = $siswa->nis;
        $aspirasi->id_kategori = $request->id_kategori;
        $aspirasi->lokasi      = $request->lokasi;
        $aspirasi->ket         = $request->ket;
        $aspirasi->status      = 'Menunggu';
        $aspirasi->feedback    = null;

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = 'pengaduan_' . time() . '_' . $aspirasi->id_aspirasi . '.' . $file->getClientOriginalExtension();
            Storage::putFileAs('public/pengaduan', $file, $filename);
            $aspirasi->foto = $filename;
        }

        $aspirasi->save();

        return redirect()->route('siswa.dashboard')->with('success', 'Pengaduan berhasil diajukan!');
    }

    public function show($id)
    {
        $siswa = Auth::guard('siswa')->user();

        $aspirasi = Aspirasi::where('id_aspirasi', $id)
            ->where('nis', $siswa->nis)
            ->with(['kategori', 'histories'])
            ->firstOrFail();

        return view('siswa.aspirasi.show', compact('aspirasi'));
    }

    /*
    public function edit(Aspirasi $aspirasi)
    {
        // Cek kepemilikan
        if ($aspirasi->nis !== auth()->guard('siswa')->user()->nis) {
            abort(403);
        }

        // Opsional: Hanya boleh edit jika status masih 'Menunggu'
        if ($aspirasi->status != 'Menunggu') {
            return redirect()->route('siswa.dashboard')->with('error', 'Tidak dapat mengedit pengaduan yang sudah diproses.');
        }

        $kategoris = Kategori::all();
        return view('siswa.aspirasi.edit', compact('kategoris', 'aspirasi'));
    }

    public function update(Request $request, Aspirasi $aspirasi)
    {
        // Validasi & Logika update sama seperti sebelumnya...
        // ...
        // return redirect()->route('siswa.dashboard')->with('success', 'Pengaduan diperbarui!');
    }

    public function destroy($id)
    {
        // Logika hapus...
        // return redirect()->route('siswa.dashboard')->with('success', 'Pengaduan dihapus.');
    }
    */

    // Method lama (riwayat/ringkasan) juga bisa dihapus atau di-redirect ke dashboard jika tidak dipakai
    public function riwayat()
    {
        return redirect()->route('siswa.dashboard');
    }

    public function ringkasan()
    {
        return redirect()->route('siswa.dashboard');
    }
}
