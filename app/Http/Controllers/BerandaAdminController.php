<?php
namespace App\Http\Controllers;

use App\Models\AlternatifTanaman;
use App\Models\HasilRekomendasi;
use App\Models\Kriteria;
use App\Models\RiwayatInput;
use App\Models\User;

class BerandaAdminController extends Controller
{
    public function index()
    {
        $totalTanaman = AlternatifTanaman::count();
        $totalKriteria = Kriteria::count();
        $totalWarga = User::where('role', 'user')->count();
        $totalInput = RiwayatInput::count();
        $inputTerbaru = RiwayatInput::with('user')
            ->latest()->take(5)->get();

        $tanamanPopuler = HasilRekomendasi::selectRaw('tanaman_id, COUNT(*) as total')
            ->where('ranking', 1)
            ->with('tanaman:id,nama_tanaman')
            ->groupBy('tanaman_id')
            ->orderByDesc('total')
            ->take(5)
            ->get();

        return view('admin.beranda', compact(
            'totalTanaman',
            'totalKriteria',
            'totalWarga',
            'totalInput',
            'inputTerbaru',
            'tanamanPopuler'
        ));
    }
}