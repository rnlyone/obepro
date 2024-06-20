<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alterkrit extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_alternatif',
        'id_kriteria',
        'faktor'
    ];

    public function alternatif()
    {
        return $this->belongsTo(Alternatif::class);
    }

    public function kriteria()
    {
        return $this->belongsTo(Kriteria::class);
    }
}
