<?php
namespace App\Services;

class AHP
{
    private array $ri = [
        1 => 0.00,
        2 => 0.00,
        3 => 0.58,
        4 => 0.90,
        5 => 1.12,
        6 => 1.24,
        7 => 1.32,
        8 => 1.41,
        9 => 1.45
    ];

    public function hitungBobot(array $pairwise): array
    {
        $n = count($pairwise);
        $colSum = array_fill(0, $n, 0.0);

        foreach ($pairwise as $row) {
            foreach ($row as $j => $val) {
                $colSum[$j] += (float) $val;
            }
        }

        $normalized = [];
        foreach ($pairwise as $i => $row) {
            foreach ($row as $j => $val) {
                $normalized[$i][$j] = $colSum[$j] > 0
                    ? (float) $val / $colSum[$j]
                    : 0.0;
            }
        }

        $bobot = [];
        foreach ($normalized as $row) {
            $bobot[] = array_sum($row) / $n;
        }

        return $bobot;
    }

    public function hitungCR(array $pairwise, array $bobot): array
    {
        $n = count($pairwise);
        $colSum = array_fill(0, $n, 0.0);

        foreach ($pairwise as $row) {
            foreach ($row as $j => $val) {
                $colSum[$j] += (float) $val;
            }
        }

        $lambdaMax = 0.0;
        foreach ($colSum as $j => $sum) {
            $lambdaMax += $sum * $bobot[$j];
        }

        $ci = ($lambdaMax - $n) / ($n - 1);
        $ri = $this->ri[$n] ?? 1.49;
        $cr = $ri > 0 ? $ci / $ri : 0.0;

        return [
            'lambda_max' => round($lambdaMax, 6),
            'ci' => round($ci, 6),
            'cr' => round($cr, 6),
            'is_consistent' => $cr <= 0.1,
        ];
    }
}