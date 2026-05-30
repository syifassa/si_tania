@extends('layouts.admin')
@section('title', 'Edit Kriteria')
@section('page-title', 'Edit Kriteria')

@section('main')
    <div class="max-w-lg mx-auto">

        {{-- Header --}}
        <a href="{{ route('admin.kriteria.index') }}" class="text-xs sm:text-sm text-green-600 hover:underline mb-4 inline-flex items-center gap-1">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>

        <div class="bg-gradient-to-r from-yellow-500 to-yellow-600 rounded-xl p-4 sm:p-5 mb-5 shadow-sm">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-white/20 backdrop-blur rounded-xl flex items-center justify-center">
                    <i class="fas fa-sliders-h text-white"></i>
                </div>
                <div>
                    <h2 class="text-white font-bold text-sm sm:text-base">Edit Kriteria</h2>
                    <p class="text-yellow-100 text-xs mt-0.5">Ubah data kriteria {{ $kriteria->kode }} — {{ $kriteria->nama_kriteria }}</p>
                </div>
            </div>
        </div>

        {{-- Errors --}}
        @if($errors->any())
            <div class="mb-4 bg-red-50 border-l-4 border-red-500 text-red-700 px-3 sm:px-4 py-3 rounded-lg text-xs sm:text-sm">
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

        {{-- Form --}}
        <form method="POST" action="{{ route('admin.kriteria.update', $kriteria) }}" class="bg-white rounded-xl shadow-sm border border-gray-100 p-4 sm:p-6 space-y-5">
            @csrf @method('PUT')

            <div>
                <label class="block text-xs sm:text-sm font-semibold text-gray-700 mb-2 flex items-center gap-2">
                    <i class="fas fa-code text-green-600"></i>Kode Kriteria
                </label>
                <input type="text" name="kode" value="{{ old('kode', $kriteria->kode) }}"
                    class="w-full border border-gray-300 rounded-lg px-3 sm:px-4 py-2 sm:py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-green-500 @error('kode') border-red-400 @enderror"
                    placeholder="Contoh: K1" required>
                @error('kode')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-xs sm:text-sm font-semibold text-gray-700 mb-2 flex items-center gap-2">
                    <i class="fas fa-filter text-blue-600"></i>Nama Kriteria
                </label>
                <input type="text" name="nama_kriteria" value="{{ old('nama_kriteria', $kriteria->nama_kriteria) }}"
                    class="w-full border border-gray-300 rounded-lg px-3 sm:px-4 py-2 sm:py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-green-500 @error('nama_kriteria') border-red-400 @enderror"
                    placeholder="Contoh: Jenis Tanah" required>
                @error('nama_kriteria')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-xs sm:text-sm font-semibold text-gray-700 mb-2 flex items-center gap-2">
                    <i class="fas fa-arrows-alt-v text-purple-600"></i>Tipe
                </label>
                <select name="tipe" class="w-full border border-gray-300 rounded-lg px-3 sm:px-4 py-2 sm:py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-green-500 @error('tipe') border-red-400 @enderror" required>
                    <option value="">-- Pilih Tipe --</option>
                    <option value="benefit" {{ old('tipe', $kriteria->tipe) == 'benefit' ? 'selected' : '' }}>
                        Benefit (nilai tinggi = lebih baik)
                    </option>
                    <option value="cost" {{ old('tipe', $kriteria->tipe) == 'cost' ? 'selected' : '' }}>
                        Cost (nilai rendah = lebih baik)
                    </option>
                </select>
                @error('tipe')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label class="block text-xs sm:text-sm font-semibold text-gray-700 mb-2 flex items-center gap-2">
                    <i class="fas fa-percentage text-orange-600"></i>Bobot <span class="text-gray-400 font-normal text-xs">(0.000 – 1.000)</span>
                </label>
                <input type="number" name="bobot" value="{{ old('bobot', $kriteria->bobot) }}" step="0.001" min="0" max="1"
                    class="w-full border border-gray-300 rounded-lg px-3 sm:px-4 py-2 sm:py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-green-500 @error('bobot') border-red-400 @enderror"
                    placeholder="Contoh: 0.300" required>
                @error('bobot')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex flex-col sm:flex-row gap-3 pt-2">
                <button type="submit" class="flex-1 bg-green-600 hover:bg-green-700 text-white font-semibold py-2 sm:py-2.5 rounded-lg transition text-xs sm:text-sm flex items-center justify-center gap-2">
                    <i class="fas fa-save"></i>Simpan Perubahan
                </button>
                <a href="{{ route('admin.kriteria.index') }}" class="flex-1 text-center bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold py-2 sm:py-2.5 rounded-lg transition text-xs sm:text-sm flex items-center justify-center gap-2">
                    <i class="fas fa-times-circle"></i>Batal
                </a>
            </div>
        </form>
    </div>
@endsection