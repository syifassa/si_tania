<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HasilRekomendasi extends Model
{
    // use HasFactory;
    protected $table = 'hasil_rekomendasi';
    protected $fillable = [
        'riwayat_id',
        'tanaman_id',
        'nilai_vi',
        'ranking',
        'metode_budidaya'
    ];

    public function tanaman()
    {
        return $this->belongsTo(AlternatifTanaman::class, 'tanaman_id');
    }

    public function riwayat()
    {
        return $this->belongsTo(RiwayatInput::class, 'riwayat_id');
    }
}
