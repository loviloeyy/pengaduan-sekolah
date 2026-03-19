<?php

namespace App\Http\Controllers;

use App\Models\Aspirasi;

class SiswaDashboardController extends Controller
{
    public function index()
    {
        $siswa = auth()->guard('siswa')->user();
        $total = Aspirasi::where('nis', $siswa->nis)->count();
        $menunggu = Aspirasi::where('nis', $siswa->nis)->where('status', 'Menunggu')->count();
        $proses = Aspirasi::where('nis', $siswa->nis)->where('status', 'Proses')->count();
        $selesai = Aspirasi::where('nis', $siswa->nis)->where('status', 'Selesai')->count();

        return view('siswa.dashboard', compact('total', 'menunggu', 'proses', 'selesai'));
    }
}
