<?php

namespace App\Http\Controllers;

use App\Models\AlternatifTanaman;
use App\Models\Kriteria;
use App\Models\RiwayatInput;
use App\Models\HasilRekomendasi;
use App\Services\AHP;
// use App\Services\TOPSIS;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InputDataLahanController extends Controller
{
    public function tampilkanForm()
    {
        return view('warga.input-lahan');
    }

    public function simpanInput(Request $request)
    {
        $request->validate([
            'jenis_tanah' => 'required|in:6.75,6.25,5.85,5.6,5.0',
            'ph_air' => 'required|in:7.0,6.2,5.7,5.0',
            'suhu' => 'required|in:27.5,24.5,32.5,22',
            'kelembapan' => 'required|in:72.5,85.5,93,97',
            'cahaya' => 'required|in:9,6.5,4.5,2',
            'curah_hujan' => 'required|in:1800,1450,1150,800',
            'luas_lahan' => 'required|numeric|min:0',
        ]);

        // Hitung urutan per-user
        $urutanTerakhir = RiwayatInput::where('user_id', Auth::id())->max('urutan') ?? 0;

        // Simpan input ke riwayat
        $riwayat = RiwayatInput::create([
            'user_id' => Auth::id(),
            'urutan' => $urutanTerakhir + 1,
            'jenis_tanah' => $request->jenis_tanah,
            'ph_air' => $request->ph_air,
            'suhu' => $request->suhu,
            'kelembapan' => $request->kelembapan,
            'cahaya' => $request->cahaya,
            'curah_hujan' => $request->curah_hujan,
            'luas_lahan' => $request->luas_lahan,
        ]);

        // Ambil data untuk perhitungan
        $kriteria = Kriteria::orderBy('kode')->get();
        $tanaman = AlternatifTanaman::where('status', 'aktif')
            ->with(['detail.kriteria'])
            ->get();
        
        if ($tanaman->isEmpty()) {
            return back()->withErrors(['error' => 'Data tanaman (alternatif) masih kosong. Silakan hubungi admin untuk mengisi data tanaman terlebih dahulu.'])->withInput();
        }

        // Hitung bobot dari AHP
        $bobot = $kriteria->pluck('bobot')->toArray();

        // Input ke format array untuk TOPSIS
        $inputArray = [
            'K1' => $request->jenis_tanah,
            'K2' => (double) $request->ph_air,
            'K3' => (double) $request->suhu,
            'K4' => (double) $request->kelembapan,
            'K5' => (double) $request->cahaya,
            'K6' => (double) $request->curah_hujan,
            'K7' => (double) $request->luas_lahan,
        ];

        // Jalankan TOPSIS
        $topsis = new \App\Services\TOPSIS();
        $ranking = $topsis->ranking(
            $kriteria->all(),
            $tanaman->all(),
            $inputArray,
            $bobot
        );

        // Simpan hasil rekomendasi
        foreach ($ranking as $hasil) {
            HasilRekomendasi::create([
                'riwayat_id' => $riwayat->id,
                'tanaman_id' => $hasil['tanaman']->id,
                'nilai_vi' => $hasil['vi'],
                'ranking' => $hasil['ranking'],
                'metode_budidaya' => $hasil['metode_budidaya'],
            ]);
        }

        return redirect()
            ->route('warga.riwayat.detail', $riwayat->id)
            ->with('success', 'Data lahan berhasil disimpan dan rekomendasi telah dihitung!');
    }
}
