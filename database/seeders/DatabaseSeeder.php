<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;
use App\Models\Siswa;
use App\Models\Kategori;
use App\Models\Aspirasi;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Admin default
        Admin::create([
            'username' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin123'),
        ]);

        // Kategori pengaduan
        $kategoris = [
            ['id_kategori' => 1, 'ket_kategori' => 'Fasilitas Belajar'],
            ['id_kategori' => 2, 'ket_kategori' => 'Prasarana'],
            ['id_kategori' => 3, 'ket_kategori' => 'Kebersihan'],
            ['id_kategori' => 4, 'ket_kategori' => 'Listrik & Air'],
            ['id_kategori' => 5, 'ket_kategori' => 'Keamanan'],
            ['id_kategori' => 6, 'ket_kategori' => 'Lainnya'],
        ];

        foreach ($kategoris as $kategori) {
            Kategori::create($kategori);
        }

        // Siswa contoh (NIS SEBAGAI STRING)
        $siswas = [
            ['nis' => '1234567890', 'email' => '1234567890@musaba.com', 'kelas' => 'X IPA 1', 'name' => 'Budi Santoso', 'password' => Hash::make('siswa123')],
            ['nis' => '1234567891', 'email' => '1234567891@musaba.com', 'kelas' => 'X IPA 2', 'name' => 'Ani Lestari', 'password' => Hash::make('siswa123')],
            ['nis' => '1234567892', 'email' => '1234567892@musaba.com', 'kelas' => 'XI IPS 1', 'name' => 'Rina Wijaya', 'password' => Hash::make('siswa123')],
            ['nis' => '1234567893', 'email' => '1234567893@musaba.com', 'kelas' => 'XI IPA 1', 'name' => 'Ahmad Fauzi', 'password' => Hash::make('siswa123')],
            ['nis' => '1234567894', 'email' => '1234567894@musaba.com', 'kelas' => 'XII IPS 2', 'name' => 'Siti Nurhaliza', 'password' => Hash::make('siswa123')],
        ];

        foreach ($siswas as $siswa) {
            Siswa::create($siswa);
        }

        // Pengaduan contoh
        $aspirasis = [
            [
                'id_aspirasi' => 1,
                'nis' => '1234567890',
                'id_kategori' => 1,
                'lokasi' => 'Ruang Kelas 10 IPA 1',
                'ket' => 'Papan tulis retak dan tidak bisa ditulis dengan baik',
                'status' => 'Menunggu',
                'feedback' => null,
            ],
            [
                'id_aspirasi' => 2,
                'nis' => '1234567891',
                'id_kategori' => 2,
                'lokasi' => 'Lapangan Olahraga',
                'ket' => 'Gawang sepak bola rusak bagian jaring',
                'status' => 'Proses',
                'feedback' => 'Sedang dipesan penggantinya, estimasi 1 minggu',
            ],
            [
                'id_aspirasi' => 3,
                'nis' => '1234567892',
                'id_kategori' => 3,
                'lokasi' => 'Toilet Lantai 2',
                'ket' => 'Wastafel bocor dan lantai licin',
                'status' => 'Selesai',
                'feedback' => 'Sudah diperbaiki oleh tukang plumbing',
            ],
            [
                'id_aspirasi' => 4,
                'nis' => '1234567893',
                'id_kategori' => 4,
                'lokasi' => 'Perpustakaan',
                'ket' => 'Lampu di pojok perpustakaan mati',
                'status' => 'Proses',
                'feedback' => 'Menunggu penggantian lampu dari bagian umum',
            ],
            [
                'id_aspirasi' => 5,
                'nis' => '1234567894',
                'id_kategori' => 5,
                'lokasi' => 'Gerbang Depan Sekolah',
                'ket' => 'Pagar gerbang berkarat dan susah ditutup',
                'status' => 'Menunggu',
                'feedback' => null,
            ],
        ];

        foreach ($aspirasis as $aspirasi) {
            Aspirasi::create($aspirasi);
        }
    }
}
