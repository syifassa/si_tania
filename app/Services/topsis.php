<?php
namespace App\Services;

use App\Models\AlternatifTanaman;
use App\Models\Kriteria;

class TOPSIS
{
    public function hitungSkor(float $input, array $detail): float
    {
        $min     = (float) $detail['nilai_min'];
        $max     = (float) $detail['nilai_max'];
        $optimal = (float) ($detail['nilai_optimal'] ?? ($min + $max) / 2);
        $range   = $max - $min;

        if ($range <= 0) {
            return abs($input - $optimal) < 0.001 ? 9.0 : 1.0;
        }

        $jarakOptimal = abs($input - $optimal);

        if ($input >= $min && $input <= $max) {
            $proporsi = $jarakOptimal / ($range / 2);
            return max(5.0, 9.0 - (4.0 * $proporsi));
        }

        $jarakLuar = $input < $min ? $min - $input : $input - $max;
        $toleransi = max($range * 0.3, 1.0);
        return max(1.0, 5.0 - (4.0 * ($jarakLuar / $toleransi)));
    }

    public function ranking(
        array $kriteria,
        array $tanaman,
        array $input,
        array $bobot
    ): array {
        $n = count($kriteria);

        if (empty($tanaman)) {
            return [];
        }

        // 1. Matriks keputusan
        $matrix = [];
        foreach ($tanaman as $t) {
            $scores = [];
            foreach ($kriteria as $j => $k) {
                $detail = collect($t->detail)
                    ->firstWhere('kriteria_id', $k->id);
                $scores[] = $detail
                    ? $this->hitungSkor(
                        (float) ($input[$k->kode] ?? 0),
                        $detail->toArray()
                    )
                    : 1.0;
            }
            $matrix[] = ['tanaman' => $t, 'scores' => $scores];
        }

        // 2. Akar jumlah kuadrat
        $sqrtSumSq = array_fill(0, $n, 0.0);
        foreach ($matrix as $row) {
            foreach ($row['scores'] as $j => $s) {
                $sqrtSumSq[$j] += $s ** 2;
            }
        }
        $sqrtSumSq = array_map('sqrt', $sqrtSumSq);

        // 3. Normalisasi & pembobotan
        $weighted = [];
        foreach ($matrix as $i => $row) {
            $w = [];
            foreach ($row['scores'] as $j => $s) {
                $w[] = ($sqrtSumSq[$j] > 0)
                    ? ($s / $sqrtSumSq[$j]) * ($bobot[$j] ?? 0)
                    : 0.0;
            }
            $weighted[$i] = $w;
        }

        // 4. Solusi ideal A+ dan A-
        // hitungSkor sudah mengonversi semua input ke skor kelayakan (1-9).
        // Semakin tinggi skor = semakin layak → semua benefit.
        $aPlus = array_fill(0, $n, 0.0);
        $aMinus = array_fill(0, $n, PHP_FLOAT_MAX);
        for ($j = 0; $j < $n; $j++) {
            $col = array_column($weighted, $j);
            $aPlus[$j] = max($col);
            $aMinus[$j] = min($col);
        }

        // 5. Hitung D+ D- dan Vi
        $hasil = [];
        foreach ($weighted as $i => $w) {
            $dPlus = $dMinus = 0.0;
            for ($j = 0; $j < $n; $j++) {
                $dPlus += ($w[$j] - $aPlus[$j]) ** 2;
                $dMinus += ($w[$j] - $aMinus[$j]) ** 2;
            }
            $dPlus = sqrt($dPlus);
            $dMinus = sqrt($dMinus);
            $vi = ($dPlus + $dMinus) > 0
                ? $dMinus / ($dPlus + $dMinus)
                : 0.0;

            $hasil[] = [
                'tanaman' => $matrix[$i]['tanaman'],
                'd_plus' => round($dPlus, 6),
                'd_minus' => round($dMinus, 6),
                'vi' => round($vi, 6),
                'metode_budidaya' => $matrix[$i]['tanaman']->metode_budidaya,
            ];
        }

        // 6. Sort ranking
        usort($hasil, fn($a, $b) => $b['vi'] <=> $a['vi']);
        foreach ($hasil as $i => &$h) {
            $h['ranking'] = $i + 1;
        }

        return $hasil;
    }
}