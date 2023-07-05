<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penilaian extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'id_user',
        'id_alternatif',
        'id_kriteria',
        'id_subkriteria',
        'nilai',
    ];

    public function alternatif()
    {
        return $this->belongsTo(Alternatif::class);
    }
}
