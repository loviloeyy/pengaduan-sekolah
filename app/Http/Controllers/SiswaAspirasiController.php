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
        $siswa = Auth::guard('siswa')->user();
        $aspirasis = Aspirasi::where('nis', $siswa->nis)
                            ->with('kategori')
                            ->latest()
                            ->paginate(10);
        return view('siswa.aspirasi.index', compact('aspirasis'));
    }

    public function create()
    {
        $kategoris = Kategori::all();
        return view('siswa.aspirasi.create', compact('kategoris'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_kategori' => 'required|integer',
            'lokasi' => 'required|string|max:50',
            'ket' => 'required|string|max:255',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $aspirasi = new Aspirasi();
        $aspirasi->id_aspirasi = Aspirasi::max('id_aspirasi') + 1;
        $aspirasi->nis = auth()->guard('siswa')->user()->nis;
        $aspirasi->id_kategori = $request->id_kategori;
        $aspirasi->lokasi = $request->lokasi;
        $aspirasi->ket = $request->ket;
        $aspirasi->status = 'Menunggu';

        // Handle file upload
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = 'pengaduan_' . time() . '_' . $aspirasi->id_aspirasi . '.' . $file->getClientOriginalExtension();
            Storage::putFileAs('public/pengaduan', $file, $filename);
            $aspirasi->foto = $filename;
        }

        $aspirasi->save();

        return redirect()->route('siswa.aspirasi.index')->with('success', 'Pengaduan berhasil diajukan!');
    }

    public function riwayat()
    {
        $siswa = Auth::guard('siswa')->user();
        $aspirasis = Aspirasi::where('nis', $siswa->nis)
                            ->with('kategori')
                            ->latest()
                            ->paginate(15);
        return view('siswa.aspirasi.riwayat', compact('aspirasis'));
    }

    public function ringkasan()
    {
        $siswa = Auth::guard('siswa')->user();
        $aspirasis = Aspirasi::where('nis', $siswa->nis)
                            ->with('kategori')
                            ->latest()
                            ->get();

        return view('siswa.aspirasi.ringkasan', compact('aspirasis'));
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

    // Method baru untuk menghapus pengaduan
    public function destroy($id)
    {
        // Pastikan pengaduan milik siswa yang sedang login
        $aspirasi = Aspirasi::where('id_aspirasi', $id)
                            ->where('nis', auth()->guard('siswa')->user()->nis)
                            ->firstOrFail();

        // Hapus file foto jika ada
        if ($aspirasi->foto) {
            Storage::delete('public/pengaduan/' . $aspirasi->foto);
        }

        $aspirasi->delete();

        return redirect()->route('siswa.aspirasi.index')->with('success', 'Pengaduan berhasil dihapus.');
    }
}
