<?php

namespace App\Http\Controllers;

use App\Models\Aspirasi;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminAspirasiController extends Controller
{
    // READ - Menampilkan daftar pengaduan
    public function index()
    {
        $aspirasis = Aspirasi::with(['siswa', 'kategori'])
            ->latest()
            ->paginate(10);

        $kategoris = Kategori::all();

        return view('admin.aspirasi.index', compact('aspirasis', 'kategoris'));
    }

    // READ - Filter pengaduan
    public function filter(Request $request)
    {
        $query = Aspirasi::with(['siswa', 'kategori']);

        if ($request->filled('tanggal')) {
            $query->whereDate('created_at', $request->tanggal);
        }

        if ($request->filled('bulan')) {
            $bulan = \Carbon\Carbon::createFromFormat('Y-m', $request->bulan);
            $query->whereYear('created_at', $bulan->year)
                  ->whereMonth('created_at', $bulan->month);
        }

        if ($request->filled('nis')) {
            $query->where('nis', $request->nis);
        }

        if ($request->filled('kategori')) {
            $query->where('id_kategori', $request->kategori);
        }

        $aspirasis = $query->latest()->paginate(10);
        $kategoris = Kategori::all();

        return view('admin.aspirasi.index', compact('aspirasis', 'kategoris'));
    }

    // UPDATE - Update status dan feedback pengaduan
    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:Menunggu,Proses,Selesai',
            'feedback' => 'nullable|string|max:255',
        ]);

        $aspirasi = Aspirasi::findOrFail($id);
        $aspirasi->update([
            'status' => $request->status,
            'feedback' => $request->feedback,
        ]);

        return redirect()->route('admin.aspirasi.index')->with('success', 'Status pengaduan berhasil diperbarui.');
    }

    // DELETE - Hapus pengaduan (opsional)
    public function destroy($id)
    {
        $aspirasi = Aspirasi::findOrFail($id);
        $aspirasi->delete();

        return redirect()->route('admin.aspirasi.index')->with('success', 'Pengaduan berhasil dihapus.');
    }

    // READ - Riwayat pengaduan
    public function riwayat()
    {
        $aspirasis = Aspirasi::with(['siswa', 'kategori'])->latest()->paginate(15);
        return view('admin.aspirasi.riwayat', compact('aspirasis'));
    }

    // READ - Ringkasan statistik
    public function ringkasan()
    {
        $stats = Aspirasi::select(
            DB::raw('COUNT(*) as total'),
            DB::raw('SUM(CASE WHEN status = "Menunggu" THEN 1 ELSE 0 END) as menunggu'),
            DB::raw('SUM(CASE WHEN status = "Proses" THEN 1 ELSE 0 END) as proses'),
            DB::raw('SUM(CASE WHEN status = "Selesai" THEN 1 ELSE 0 END) as selesai')
        )->first();

        $totalPengaduan = $stats->total ?? 0;
        $menunggu = $stats->menunggu ?? 0;
        $proses = $stats->proses ?? 0;
        $selesai = $stats->selesai ?? 0;

        $perBulan = Aspirasi::select(
            DB::raw('MONTH(created_at) as bulan'),
            DB::raw('YEAR(created_at) as tahun'),
            DB::raw('count(*) as total')
        )
        ->groupBy('bulan', 'tahun')
        ->orderBy('tahun', 'desc')
        ->orderBy('bulan', 'desc')
        ->take(6)
        ->get()
        ->map(function($item) {
            $bulanIndo = [
                1 => 'Jan', 2 => 'Feb', 3 => 'Mar', 4 => 'Apr', 5 => 'Mei', 6 => 'Jun',
                7 => 'Jul', 8 => 'Agt', 9 => 'Sep', 10 => 'Okt', 11 => 'Nov', 12 => 'Des'
            ];
            $item->label = $bulanIndo[$item->bulan] . ' ' . $item->tahun;
            return $item;
        });

        $pengaduanTerbaru = Aspirasi::with(['siswa', 'kategori'])
            ->latest()
            ->take(5)
            ->get();

        return view('admin.aspirasi.ringkasan', compact(
            'totalPengaduan',
            'menunggu',
            'proses',
            'selesai',
            'perBulan',
            'pengaduanTerbaru'
        ));
    }
}
