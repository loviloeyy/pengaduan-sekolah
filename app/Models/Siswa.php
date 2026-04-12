<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Aspirasi;

class Siswa extends Authenticatable
{
    use Notifiable;

    protected $table = 'siswas';
    protected $primaryKey = 'nis';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = ['nis', 'kelas', 'name', 'password', 'email'];

    protected $hidden = ['password', 'remember_token'];

    protected $casts = [
    ];

    public function aspirasis()
    {
        return $this->hasMany(Aspirasi::class, 'nis', 'nis');
    }
}
