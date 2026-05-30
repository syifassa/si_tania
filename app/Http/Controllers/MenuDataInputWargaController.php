<?php
namespace App\Http\Controllers;

use App\Models\AlternatifTanaman;
use App\Models\HasilRekomendasi;
use App\Models\RiwayatInput;
use Illuminate\Http\Request;

class MenuDataInputWargaController extends Controller
{
    public function index(Request $request)
    {
        $query = RiwayatInput::with('user');

        if ($search = $request->get('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('jenis_tanah', 'like', "%{$search}%")
                  ->orWhere('ph_air', 'like', "%{$search}%")
                  ->orWhere('suhu', 'like', "%{$search}%")
                  ->orWhereHas('user', function ($uq) use ($search) {
                      $uq->where('name', 'like', "%{$search}%");
                  });
            });
        }

        if ($jenisTanah = $request->get('jenis_tanah')) {
            $query->where('jenis_tanah', $jenisTanah);
        }

        if ($metode = $request->get('metode')) {
            $query->whereHas('hasil', function ($hq) use ($metode) {
                $hq->where('metode_budidaya', $metode);
            });
        }

        if ($tanggal = $request->get('tanggal')) {
            match ($tanggal) {
                'hari_ini' => $query->whereDate('created_at', today()),
                '7_hari'   => $query->whereDate('created_at', '>=', now()->subDays(7)),
                '30_hari'  => $query->whereDate('created_at', '>=', now()->subDays(30)),
                default    => null,
            };
        }

        $sort = $request->get('sort', 'terbaru');
        if ($sort === 'terlama') {
            $query->oldest();
        } else {
            $query->latest();
        }

        $data = $query->paginate(15);

        $jenisTanahList = RiwayatInput::distinct()->pluck('jenis_tanah')->sort();
        $metodeList = AlternatifTanaman::distinct()->pluck('metode_budidaya')->sort();

        return view('admin.data-warga.index', compact('data', 'jenisTanahList', 'metodeList'));
    }

    public function tampilkanDetail($id)
    {
        $riwayat = RiwayatInput::with('user')->findOrFail($id);
        $hasil = HasilRekomendasi::where('riwayat_id', $id)
            ->with('tanaman')
            ->orderBy('ranking')
            ->get();

        return view('admin.data-warga.detail', compact('riwayat', 'hasil'));
    }
}