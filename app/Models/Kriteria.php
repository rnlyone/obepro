<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kriteria extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'nama',
        'tipe',
        'satuan',
        'target'
    ];

    public function subkriterias()
    {
        return $this->hasMany(Subkriteria::class, 'id_kriteria');
    }

    public function alterkrits()
    {
        return $this->hasMany('App\Models\Alterkrit', 'id_kriteria');
    }
}
