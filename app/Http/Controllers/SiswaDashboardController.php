<?php

namespace App\Http\Controllers;

use App\Models\Aspirasi;

class SiswaDashboardController extends Controller
{
    public function index()
    {
        $siswa = auth()->guard('siswa')->user();
        $nis = $siswa->nis;

        $total = Aspirasi::where('nis', $nis)->count();
        $menunggu = Aspirasi::where('nis', $nis)->where('status', 'Menunggu')->count();
        $proses = Aspirasi::where('nis', $nis)->where('status', 'Proses')->count();
        $selesai = Aspirasi::where('nis', $nis)->where('status', 'Selesai')->count();

        $aspirasis = Aspirasi::where('nis', $nis)
            ->with('kategori')
            ->latest()
            ->paginate(10); 

        return view('siswa.dashboard', compact('total', 'menunggu', 'proses', 'selesai', 'aspirasis'));
    }
}
