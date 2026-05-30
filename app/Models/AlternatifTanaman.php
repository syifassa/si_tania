<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlternatifTanaman extends Model
{
    // use HasFactory;

    protected $table = 'alternatif_tanaman';
    protected $fillable = [
        'nama_tanaman',
        'metode_budidaya',
        'deskripsi',
        'status'
    ]; 

    public function detail()
    {
        return $this->hasMany(DetailTanaman::class, 'alternatif_id');
    }

    public function hasilRekomendasi()
    {
        return $this->hasMany(HasilRekomendasi::class, 'tanaman_id');
    }
}
