<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailTanaman extends Model
{
    // use HasFactory;
    protected $table = 'detail_tanaman';
    protected $fillable = [
        'alternatif_id',
        'kriteria_id',
        'nilai_min',
        'nilai_max',
        'nilai_optimal',
        'skor'
    ];

    public function tanaman()
    {
        return $this->belongsTo(AlternatifTanaman::class, 'alternatif_id');
    }

    public function kriteria()
    {
        return $this->belongsTo(Kriteria::class, 'kriteria_id');
    }
}
