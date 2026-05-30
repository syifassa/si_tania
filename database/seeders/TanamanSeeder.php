<?php

namespace Database\Seeders;

use App\Models\AlternatifTanaman;
use App\Models\DetailTanaman;
use App\Models\Kriteria;
use Illuminate\Database\Seeder;

class TanamanSeeder extends Seeder
{
    public function run(): void
    {
        $kriteria = Kriteria::orderBy('kode')->pluck('id', 'kode');

        $tanaman = [
            [
                'nama_tanaman' => 'Cabai',
                'metode_budidaya' => 'Media Tanah/Hidroponik',
                'deskripsi' => 'Tanaman cabai cocok di dataran rendah hingga tinggi dengan pH netral.',
                'detail' => [
                    'K1' => ['min' => 5.5, 'max' => 7.0, 'optimal' => 6.0],
                    'K2' => ['min' => 5.5, 'max' => 7.0, 'optimal' => 6.5],
                    'K3' => ['min' => 20, 'max' => 30, 'optimal' => 27],
                    'K4' => ['min' => 60, 'max' => 85, 'optimal' => 75],
                    'K5' => ['min' => 6, 'max' => 10, 'optimal' => 8],
                    'K6' => ['min' => 600, 'max' => 1500, 'optimal' => 1000],
                    'K7' => ['min' => 1, 'max' => 300, 'optimal' => 50],
                ],
            ],
            [
                'nama_tanaman' => 'Kangkung',
                'metode_budidaya' => 'Media Tanah/Hidroponik',
                'deskripsi' => 'Kangkung tumbuh cepat di lahan basah dengan sinar matahari cukup.',
                'detail' => [
                    'K1' => ['min' => 5.5, 'max' => 7.5, 'optimal' => 6.5],
                    'K2' => ['min' => 5.5, 'max' => 7.5, 'optimal' => 6.5],
                    'K3' => ['min' => 22, 'max' => 35, 'optimal' => 30],
                    'K4' => ['min' => 70, 'max' => 95, 'optimal' => 80],
                    'K5' => ['min' => 6, 'max' => 10, 'optimal' => 8],
                    'K6' => ['min' => 1500, 'max' => 2500, 'optimal' => 2000],
                    'K7' => ['min' => 1, 'max' => 100, 'optimal' => 30],
                ],
            ],
            [
                'nama_tanaman' => 'Tomat',
                'metode_budidaya' => 'Media Tanah/Hidroponik',
                'deskripsi' => 'Tomat tumbuh optimal di dataran tinggi dengan suhu sejuk.',
                'detail' => [
                    'K1' => ['min' => 6.0, 'max' => 7.0, 'optimal' => 6.5],
                    'K2' => ['min' => 6.0, 'max' => 7.0, 'optimal' => 6.5],
                    'K3' => ['min' => 18, 'max' => 28, 'optimal' => 22],
                    'K4' => ['min' => 65, 'max' => 85, 'optimal' => 75],
                    'K5' => ['min' => 8, 'max' => 10, 'optimal' => 9],
                    'K6' => ['min' => 800, 'max' => 1500, 'optimal' => 1100],
                    'K7' => ['min' => 1, 'max' => 300, 'optimal' => 30],
                ],
            ],
            [
                'nama_tanaman' => 'Pakcoy',
                'metode_budidaya' => 'Hidroponik',
                'deskripsi' => 'Pakcoy atau sawi sendok tumbuh baik di dataran tinggi dengan cuaca sejuk.',
                'detail' => [
                    'K1' => ['min' => 6.0, 'max' => 7.5, 'optimal' => 6.8, ],
                    'K2' => ['min' => 6.0, 'max' => 7.5, 'optimal' => 6.8],
                    'K3' => ['min' => 15, 'max' => 25, 'optimal' => 20],
                    'K4' => ['min' => 70, 'max' => 90, 'optimal' => 80],
                    'K5' => ['min' => 6, 'max' => 8, 'optimal' => 7],
                    'K6' => ['min' => 1000, 'max' => 2000, 'optimal' => 1500],
                    'K7' => ['min' => 1, 'max' => 100, 'optimal' => 20],
                ],
            ],
            [
                'nama_tanaman' => 'Pisang',
                'metode_budidaya' => 'Media Tanah',
                'deskripsi' => 'Pisang tumbuh optimal di dataran rendah dengan suhu hangat dan kelembaban tinggi.',
                'detail' => [
                    'K1' => ['min' => 5.5, 'max' => 7.5, 'optimal' => 6.0],
                    'K2' => ['min' => 5.5, 'max' => 7.5, 'optimal' => 6.5],
                    'K3' => ['min' => 22, 'max' => 33, 'optimal' => 28],
                    'K4' => ['min' => 65, 'max' => 90, 'optimal' => 80],
                    'K5' => ['min' => 8, 'max' => 10, 'optimal' => 9],
                    'K6' => ['min' => 1600, 'max' => 2500, 'optimal' => 2000],
                    'K7' => ['min' => 50, 'max' => 1000, 'optimal' => 200],
                ],
            ],
            [
                'nama_tanaman' => 'Pepaya',
                'metode_budidaya' => 'Media Tanah',
                'deskripsi' => 'Pepaya tumbuh cepat di dataran rendah dengan sinar matahari penuh.',
                'detail' => [
                    'K1' => ['min' => 6.0, 'max' => 7.0, 'optimal' => 6.5],
                    'K2' => ['min' => 6.0, 'max' => 7.0, 'optimal' => 6.5],
                    'K3' => ['min' => 22, 'max' => 32, 'optimal' => 28],
                    'K4' => ['min' => 60, 'max' => 85, 'optimal' => 70],
                    'K5' => ['min' => 8, 'max' => 10, 'optimal' => 9],
                    'K6' => ['min' => 1000, 'max' => 2000, 'optimal' => 1500],
                    'K7' => ['min' => 40, 'max' => 1000, 'optimal' => 150],
                ],
            ],
            [
                'nama_tanaman' => 'Selada',
                'metode_budidaya' => 'Hidroponik',
                'deskripsi' => 'Selada tumbuh optimal di suhu sejuk dengan kelembaban sedang.',
                'detail' => [
                    'K1' => ['min' => 6.0, 'max' => 7.0, 'optimal' => 6.5, ],
                    'K2' => ['min' => 6.0, 'max' => 7.0, 'optimal' => 6.5],
                    'K3' => ['min' => 15, 'max' => 25, 'optimal' => 18],
                    'K4' => ['min' => 60, 'max' => 80, 'optimal' => 70],
                    'K5' => ['min' => 6, 'max' => 8, 'optimal' => 7],
                    'K6' => ['min' => 800, 'max' => 1500, 'optimal' => 1100],
                    'K7' => ['min' => 1, 'max' => 100, 'optimal' => 20],
                ],
            ],
            [
                'nama_tanaman' => 'Bayam',
                'metode_budidaya' => 'Hidroponik',
                'deskripsi' => 'Bayam tumbuh cepat di hampir semua jenis tanah dengan sinar matahari cukup.',
                'detail' => [
                    'K1' => ['min' => 6.0, 'max' => 7.5, 'optimal' => 6.5, ],
                    'K2' => ['min' => 6.0, 'max' => 7.5, 'optimal' => 6.5],
                    'K3' => ['min' => 15, 'max' => 25, 'optimal' => 20],
                    'K4' => ['min' => 60, 'max' => 85, 'optimal' => 75],
                    'K5' => ['min' => 6, 'max' => 8, 'optimal' => 7],
                    'K6' => ['min' => 1000, 'max' => 2000, 'optimal' => 1300],
                    'K7' => ['min' => 1, 'max' => 100, 'optimal' => 20],
                ],
            ],
        ];

        foreach ($tanaman as $data) {
            $plant = AlternatifTanaman::updateOrCreate(
                ['nama_tanaman' => $data['nama_tanaman']],
                [
                    'metode_budidaya' => $data['metode_budidaya'],
                    'deskripsi' => $data['deskripsi'],
                    'status' => 'aktif',
                ]
            );

            foreach ($data['detail'] as $kode => $d) {
                DetailTanaman::updateOrCreate(
                    [
                        'alternatif_id' => $plant->id,
                        'kriteria_id' => $kriteria[$kode],
                    ],
                    [
                        'nilai_min' => $d['min'],
                        'nilai_max' => $d['max'],
                        'nilai_optimal' => $d['optimal'],
                    ]
                );
            }
        }
    }
}
