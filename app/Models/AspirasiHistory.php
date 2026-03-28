<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AspirasiHistory extends Model
{
    protected $table = 'aspirasi_histories';

    protected $fillable = [
        'id_aspirasi', 'status', 'feedback', 'changed_by',
    ];

    public function aspirasi()
    {
        return $this->belongsTo(Aspirasi::class, 'id_aspirasi', 'id_aspirasi');
    }
}
