<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiwayatInput extends Model
{
    // use HasFactory;

    protected $table = 'riwayat_input';
    protected $fillable = [
        'user_id',
        'urutan',
        'jenis_tanah',
        'ph_air',
        'suhu',
        'kelembapan',
        'cahaya',
        'curah_hujan',
        'luas_lahan'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function hasil()
    {
        return $this->hasMany(HasilRekomendasi::class, 'riwayat_id')->orderBy('ranking');
    }
}
