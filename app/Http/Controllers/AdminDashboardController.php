<?php

namespace App\Http\Controllers;

use App\Models\Aspirasi;
use Illuminate\Support\Facades\DB;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $total = Aspirasi::count();
        $menunggu = Aspirasi::where('status', 'Menunggu')->count();
        $proses = Aspirasi::where('status', 'Proses')->count();
        $selesai = Aspirasi::where('status', 'Selesai')->count();

        $topKategori = Aspirasi::select('id_kategori', DB::raw('count(*) as total'))
            ->groupBy('id_kategori')
            ->with('kategori')
            ->orderBy('total', 'desc')
            ->take(5)
            ->get();

        $pengaduanTerbaru = Aspirasi::with(['siswa', 'kategori'])
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'total',
            'menunggu',
            'proses',
            'selesai',
            'topKategori',
            'pengaduanTerbaru'
        ));
    }
}
