@extends('layouts.admin')
@section('title', 'Tambah Kriteria')
@section('page-title', 'Tambah Kriteria')

@section('main')
    <div class="max-w-lg mx-auto">
        <a href="{{ route('admin.kriteria.index') }}" class="text-xs sm:text-sm text-green-600 hover:underline mb-4 inline-flex items-center gap-1">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>

        @if($errors->any())
            <div class="mb-4 bg-red-50 border-l-4 border-red-500 text-red-700 px-3 sm:px-4 py-3 rounded text-xs sm:text-sm">
                <p class="font-semibold mb-2 flex items-center gap-2">
                    <i class="fas fa-exclamation-circle"></i>Terjadi Kesalahan
                </p>
                <ul class="list-disc list-inside space-y-1">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('admin.kriteria.store') }}" class="bg-white rounded-xl shadow p-4 sm:p-6 space-y-4">
            @csrf
            <div>
                <label class="block text-xs sm:text-sm font-semibold text-gray-700 mb-2 flex items-center gap-2">
                    <i class="fas fa-code text-green-600"></i>Kode Kriteria
                </label>
                <input type="text" name="kode" value="{{ old('kode') }}" class="w-full border border-gray-300 rounded-lg px-3 sm:px-4 py-2 sm:py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-green-500" placeholder="Contoh: K1" required>
            </div>
            <div>
                <label class="block text-xs sm:text-sm font-semibold text-gray-700 mb-2 flex items-center gap-2">
                    <i class="fas fa-filter text-blue-600"></i>Nama Kriteria
                </label>
                <input type="text" name="nama_kriteria" value="{{ old('nama_kriteria') }}" class="w-full border border-gray-300 rounded-lg px-3 sm:px-4 py-2 sm:py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-green-500" placeholder="Contoh: Jenis Tanah" required>
            </div>
            <div>
                <label class="block text-xs sm:text-sm font-semibold text-gray-700 mb-2 flex items-center gap-2">
                    <i class="fas fa-arrows-alt-v text-purple-600"></i>Tipe
                </label>
                <select name="tipe" class="w-full border border-gray-300 rounded-lg px-3 sm:px-4 py-2 sm:py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-green-500" required>
                    <option value="">-- Pilih Tipe --</option>
                    <option value="benefit" {{ old('tipe') == 'benefit' ? 'selected' : '' }}>
                        Benefit (nilai tinggi = lebih baik)
                    </option>
                    <option value="cost" {{ old('tipe') == 'cost' ? 'selected' : '' }}>
                        Cost (nilai rendah = lebih baik)
                    </option>
                </select>
            </div>
            <div>
                <label class="block text-xs sm:text-sm font-semibold text-gray-700 mb-2 flex items-center gap-2">
                    <i class="fas fa-percentage text-orange-600"></i>Bobot <span class="text-gray-400 font-normal text-xs">(0.000 – 1.000)</span>
                </label>
                <input type="number" name="bobot" value="{{ old('bobot') }}" step="0.001" min="0" max="1" class="w-full border border-gray-300 rounded-lg px-3 sm:px-4 py-2 sm:py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-green-500" placeholder="Contoh: 0.296" required>
            </div>
            <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white font-semibold py-2 sm:py-2.5 rounded-lg transition text-xs sm:text-sm flex items-center justify-center gap-2">
                <i class="fas fa-save"></i>Simpan Kriteria
            </button>
        </form>
    </div>
@endsection