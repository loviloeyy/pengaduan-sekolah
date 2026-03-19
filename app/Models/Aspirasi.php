<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Siswa;
use App\Models\Kategori;

class Aspirasi extends Model
{
    protected $primaryKey = 'id_aspirasi';
    public $incrementing = false;
    protected $keyType = 'integer';

    protected $fillable = [
        'id_aspirasi', 'nis', 'id_kategori', 'lokasi',
        'ket', 'status', 'feedback', 'foto'
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'nis', 'nis');
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'id_kategori', 'id_kategori');
    }

    // Helper untuk mendapatkan URL foto
    public function getFotoUrlAttribute()
    {
        if ($this->foto) {
            return asset('storage/pengaduan/' . $this->foto);
        }
        return null;
    }
}
