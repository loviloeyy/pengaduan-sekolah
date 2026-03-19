<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Aspirasi;

class Kategori extends Model
{
    protected $primaryKey = 'id_kategori';
    public $incrementing = false;
    protected $keyType = 'integer';

    protected $fillable = ['id_kategori', 'ket_kategori'];

    public function aspirasis()
    {
        return $this->hasMany(Aspirasi::class, 'id_kategori', 'id_kategori');
    }
}
