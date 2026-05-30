<?php
namespace App\Http\Controllers;

use App\Models\AlternatifTanaman;
use App\Models\DetailTanaman;
use App\Models\Kriteria;
use Illuminate\Http\Request;

class AlternatifController extends Controller
{
    public function index(Request $request)
    {
        $query = AlternatifTanaman::latest();

        if ($search = $request->get('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('nama_tanaman', 'like', "%{$search}%")
                    ->orWhere('metode_budidaya', 'like', "%{$search}%");
            });
        }

        if ($status = $request->get('status')) {
            $query->where('status', $status);
        }

        if ($metode = $request->get('metode')) {
            $query->where('metode_budidaya', $metode);
        }

        $tanaman = $query->get();
        $metodeList = AlternatifTanaman::distinct()->pluck('metode_budidaya')->sort();

        return view('admin.tanaman.index', compact('tanaman', 'metodeList'));
    }

    public function create()
    {
        $kriteria = Kriteria::orderBy('kode')->get();
        return view('admin.tanaman.create', compact('kriteria'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_tanaman' => 'required',
            'metode_budidaya' => 'required',
            'detail' => 'required|array',
            'detail.*.nilai_min' => 'required|numeric',
            'detail.*.nilai_max' => 'required|numeric',
            'detail.*.nilai_optimal' => 'required|numeric',
        ]);

        $tanaman = AlternatifTanaman::create([
            'nama_tanaman' => $request->nama_tanaman,
            'metode_budidaya' => $request->metode_budidaya,
            'deskripsi' => $request->deskripsi,
            'status' => $request->status ?? 'aktif',
        ]);

        foreach ($request->detail as $d) {
            DetailTanaman::create([
                'alternatif_id' => $tanaman->id,
                'kriteria_id' => $d['kriteria_id'],
                'nilai_min' => $d['nilai_min'],
                'nilai_max' => $d['nilai_max'],
                'nilai_optimal' => $d['nilai_optimal'],
            ]);
        }

        return redirect()->route('admin.tanaman.index')
            ->with('success', 'Tanaman berhasil ditambahkan');
    }

    public function edit(AlternatifTanaman $tanaman)
    {
        $kriteria = Kriteria::orderBy('kode')->get();
        $tanaman->load('detail');
        return view('admin.tanaman.edit', compact('tanaman', 'kriteria'));
    }

    public function update(Request $request, AlternatifTanaman $tanaman)
    {
        $request->validate([
            'nama_tanaman' => 'required',
            'metode_budidaya' => 'required',
        ]);

        $tanaman->update([
            'nama_tanaman' => $request->nama_tanaman,
            'metode_budidaya' => $request->metode_budidaya,
            'deskripsi' => $request->deskripsi,
            'status' => $request->status,
        ]);

        if ($request->detail) {
            foreach ($request->detail as $d) {
                DetailTanaman::updateOrCreate(
                    [
                        'alternatif_id' => $tanaman->id,
                        'kriteria_id' => $d['kriteria_id'],
                    ],
                    [
                        'nilai_min' => $d['nilai_min'],
                        'nilai_max' => $d['nilai_max'],
                        'nilai_optimal' => $d['nilai_optimal'],
                    ]
                );
            }
        }

        return redirect()->route('admin.tanaman.index')
            ->with('success', 'Tanaman berhasil diupdate');
    }

    public function destroy(AlternatifTanaman $tanaman)
    {
        $tanaman->delete();
        return redirect()->route('admin.tanaman.index')
            ->with('success', 'Tanaman berhasil dihapus');
    }
}