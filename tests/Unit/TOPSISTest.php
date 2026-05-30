<?php

namespace Tests\Unit;

use App\Models\AlternatifTanaman;
use App\Models\Kriteria;
use App\Services\TOPSIS;
use Tests\TestCase;

class TOPSISTest extends TestCase
{
    private TOPSIS $topsis;
    private $kriteria;
    private $tanaman;
    private array $bobot;
    private array $inputIdeal;

    protected function setUp(): void
    {
        parent::setUp();

        $this->topsis = new TOPSIS();
        $this->kriteria = Kriteria::orderBy('kode')->get();
        $this->tanaman = AlternatifTanaman::with('detail.kriteria')
            ->where('status', 'aktif')
            ->get();
        $this->bobot = $this->kriteria->pluck('bobot')->toArray();

        $this->inputIdeal = [
            'K1' => 6.25, 'K2' => 7.0, 'K3' => 27.5,
            'K4' => 72.5, 'K5' => 9, 'K6' => 1800, 'K7' => 150,
        ];
    }

    public function test_hitung_skor_sempurna_saat_input_sama_dengan_optimal(): void
    {
        $detail = ['nilai_min' => 5.0, 'nilai_max' => 7.5, 'nilai_optimal' => 6.2];

        $this->assertEquals(9.0, $this->topsis->hitungSkor(6.2, $detail));
    }

    public function test_hitung_skor_di_batas_range_mendekati_5(): void
    {
        $detail = ['nilai_min' => 5.0, 'nilai_max' => 7.5, 'nilai_optimal' => 6.2];
        // range=2.5, half-range=1.25, jarak ke min=1.2, proporsi=0.96, skor=9-4*0.96=5.16
        $skorMin = $this->topsis->hitungSkor(5.0, $detail);
        $skorMax = $this->topsis->hitungSkor(7.5, $detail);

        $this->assertGreaterThanOrEqual(5.0, $skorMin);
        $this->assertGreaterThanOrEqual(5.0, $skorMax);
        $this->assertLessThan(9.0, $skorMin);
        $this->assertLessThan(9.0, $skorMax);
    }

    public function test_hitung_skor_di_luar_range_dalam_toleransi_antara_1_dan_5(): void
    {
        $detail = ['nilai_min' => 5.0, 'nilai_max' => 7.5, 'nilai_optimal' => 6.2];
        // toleransi=max(0.75,1)=1. jarakLuar=0.5, skor=5-4*(0.5/1)=3
        $skor = $this->topsis->hitungSkor(4.5, $detail);

        $this->assertGreaterThanOrEqual(1.0, $skor);
        $this->assertLessThanOrEqual(5.0, $skor);
        $this->assertEqualsWithDelta(3.0, $skor, 0.01);
    }

    public function test_hitung_skor_jauh_di_luar_range(): void
    {
        $detail = ['nilai_min' => 5.0, 'nilai_max' => 7.5, 'nilai_optimal' => 6.2];

        $this->assertEquals(1.0, $this->topsis->hitungSkor(2.0, $detail));
    }

    public function test_hitung_skor_abaikan_kolom_skor_db(): void
    {
        // Kolom skor di DB (3) harus diabaikan, pakai 9.0 sebagai base
        $detail = ['nilai_min' => 5.0, 'nilai_max' => 7.5, 'nilai_optimal' => 6.2, 'skor' => 3];

        $this->assertEquals(9.0, $this->topsis->hitungSkor(6.2, $detail));
    }

    public function test_hitung_skor_zero_range(): void
    {
        $detail = ['nilai_min' => 5.0, 'nilai_max' => 5.0, 'nilai_optimal' => 5.0];

        $this->assertEquals(9.0, $this->topsis->hitungSkor(5.0, $detail));
        $this->assertEquals(1.0, $this->topsis->hitungSkor(5.5, $detail));
    }

    public function test_ranking_menghasilkan_8_hasil(): void
    {
        $hasil = $this->topsis->ranking(
            $this->kriteria->all(),
            $this->tanaman->all(),
            $this->inputIdeal,
            $this->bobot
        );

        $this->assertCount(8, $hasil);
    }

    public function test_ranking_vi_antara_0_dan_1(): void
    {
        $hasil = $this->topsis->ranking(
            $this->kriteria->all(),
            $this->tanaman->all(),
            $this->inputIdeal,
            $this->bobot
        );

        foreach ($hasil as $h) {
            $this->assertGreaterThanOrEqual(0, $h['vi']);
            $this->assertLessThanOrEqual(1, $h['vi']);
        }

        for ($i = 0; $i < count($hasil) - 1; $i++) {
            $this->assertGreaterThanOrEqual(
                $hasil[$i + 1]['vi'],
                $hasil[$i]['vi'],
                'Ranking harus urut menurun'
            );
        }
    }

    public function test_ranking_berbeda_untuk_input_berbeda(): void
    {
        $inputPanas = [
            'K1' => 6.25, 'K2' => 7.0, 'K3' => 32.5,
            'K4' => 72.5, 'K5' => 9, 'K6' => 1800, 'K7' => 150,
        ];

        $hasilIdeal = $this->topsis->ranking(
            $this->kriteria->all(),
            $this->tanaman->all(),
            $this->inputIdeal,
            $this->bobot
        );

        $hasilPanas = $this->topsis->ranking(
            $this->kriteria->all(),
            $this->tanaman->all(),
            $inputPanas,
            $this->bobot
        );

        $this->assertNotEquals(
            $hasilIdeal[0]['tanaman']->nama_tanaman,
            $hasilPanas[0]['tanaman']->nama_tanaman
        );
    }
}
