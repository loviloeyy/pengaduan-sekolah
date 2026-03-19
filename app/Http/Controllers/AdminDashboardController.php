<?php

namespace App\Http\Controllers;

use App\Models\Aspirasi;
use Illuminate\Support\Facades\DB;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // Statistik utama
        $total = Aspirasi::count();
        $menunggu = Aspirasi::where('status', 'Menunggu')->count();
        $proses = Aspirasi::where('status', 'Proses')->count();
        $selesai = Aspirasi::where('status', 'Selesai')->count();

        // Top kategori pengaduan (untuk fitur baru)
        $topKategori = Aspirasi::select('id_kategori', DB::raw('count(*) as total'))
            ->groupBy('id_kategori')
            ->with('kategori')
            ->orderBy('total', 'desc')
            ->take(5)
            ->get();

        // Data pengaduan terbaru untuk aktivitas (bukan tabel)
        $pengaduanTerbaru = Aspirasi::with(['siswa', 'kategori'])
            ->latest()
            ->take(10) // Ambil 10 untuk aktivitas terbaru
            ->get();

        return view('admin.dashboard', compact(
            'total',
            'menunggu',
            'proses',
            'selesai',
            'topKategori',        // DITAMBAHKAN
            'pengaduanTerbaru'
        ));
    }
}
