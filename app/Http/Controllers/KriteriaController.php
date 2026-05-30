<?php
namespace App\Http\Controllers;

use App\Models\Kriteria;
use Illuminate\Http\Request;

class KriteriaController extends Controller
{
    public function index(Request $request)
    {
        $query = Kriteria::orderBy('kode');

        if ($search = $request->get('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('kode', 'like', "%{$search}%")
                  ->orWhere('nama_kriteria', 'like', "%{$search}%");
            });
        }

        $kriteria = $query->get();
        return view('admin.kriteria.index', compact('kriteria'));
    }

    public function create()
    {
        return view('admin.kriteria.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode' => 'required|unique:kriteria',
            'nama_kriteria' => 'required',
            'tipe' => 'required|in:benefit,cost',
            'bobot' => 'required|numeric|min:0|max:1',
        ]);

        Kriteria::create($request->only('kode', 'nama_kriteria', 'tipe', 'bobot'));

        return redirect()->route('admin.kriteria.index')
            ->with('success', 'Kriteria berhasil ditambahkan');
    }

    public function edit(Kriteria $kriteria)
    {
        return view('admin.kriteria.edit', compact('kriteria'));
    }

    public function update(Request $request, Kriteria $kriteria)
    {
        $request->validate([
            'kode' => 'required|unique:kriteria,kode,' . $kriteria->id,
            'nama_kriteria' => 'required',
            'tipe' => 'required|in:benefit,cost',
            'bobot' => 'required|numeric|min:0|max:1',
        ]);

        $kriteria->update($request->only('kode', 'nama_kriteria', 'tipe', 'bobot'));

        return redirect()->route('admin.kriteria.index')
            ->with('success', 'Kriteria berhasil diupdate');
    }

    public function destroy(Kriteria $kriteria)
    {
        $kriteria->delete();
        return redirect()->route('admin.kriteria.index')
            ->with('success', 'Kriteria berhasil dihapus');
    }
}