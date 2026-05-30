<?php
namespace App\Http\Controllers;

use App\Models\HasilRekomendasi;
use App\Models\RiwayatInput;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RiwayatController extends Controller
{
    public function tampilkanRiwayat(Request $request)
    {
        $query = RiwayatInput::where('user_id', Auth::id())
            ->with(['hasil.tanaman'])
            ->latest();

        // Filter
        if ($request->filter == 'hari_ini') {
            $query->whereDate('created_at', today());
        } elseif ($request->filter == 'minggu_ini') {
            $query->whereBetween('created_at', [
                now()->startOfWeek(),
                now()->endOfWeek()
            ]);
        } elseif ($request->filter == 'bulan_ini') {
            $query->whereMonth('created_at', now()->month)
                ->whereYear('created_at', now()->year);
        }
        $riwayat = $query->paginate(10)->withQueryString();
        return view('warga.riwayat', compact('riwayat'));
    }

    public function tampilkanDetail($id)
    {
        $riwayat = RiwayatInput::where('user_id', Auth::id())
            ->findOrFail($id);

        $hasil = HasilRekomendasi::where('riwayat_id', $id)
            ->with('tanaman')
            ->orderBy('ranking')
            ->get();

        return view('warga.riwayat-detail', compact('riwayat', 'hasil'));
    }
}