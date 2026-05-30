<?php

namespace Database\Seeders;

use App\Models\Kriteria;
use Illuminate\Database\Seeder;

class KriteriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['kode' => 'K1', 'nama_kriteria' => 'Jenis Tanah', 'tipe' => 'benefit', 'bobot' => 0.30],
            ['kode' => 'K2', 'nama_kriteria' => 'pH Air', 'tipe' => 'benefit', 'bobot' => 0.21],
            ['kode' => 'K3', 'nama_kriteria' => 'Suhu', 'tipe' => 'cost', 'bobot' => 0.17],
            ['kode' => 'K4', 'nama_kriteria' => 'Kelembaban', 'tipe' => 'cost', 'bobot' => 0.11],
            ['kode' => 'K5', 'nama_kriteria' => 'Intensitas Cahaya', 'tipe' => 'benefit', 'bobot' => 0.10],
            ['kode' => 'K6', 'nama_kriteria' => 'Curah Hujan Tahunan', 'tipe' => 'cost', 'bobot' => 0.08],
            ['kode' => 'K7', 'nama_kriteria' => 'Luas Lahan', 'tipe' => 'benefit', 'bobot' => 0.03],
        ];

        foreach ($data as $item) {
            Kriteria::updateOrCreate(
                ['kode' => $item['kode']],
                $item
            );
        }
    }
}
