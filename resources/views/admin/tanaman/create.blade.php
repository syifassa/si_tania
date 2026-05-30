@extends('layouts.admin')
@section('title', 'Tambah Tanaman')
@section('page-title', 'Tambah Data Tanaman')

@section('main')
    <div class="max-w-2xl mx-auto">
        <a href="{{ route('admin.tanaman.index') }}" class="text-xs sm:text-sm text-green-600 hover:underline mb-4 inline-flex items-center gap-1">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>

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

        <form method="POST" action="{{ route('admin.tanaman.store') }}" class="bg-white rounded-xl shadow p-4 sm:p-6 space-y-6">
            @csrf

            {{-- Info Umum --}}
            <div>
                <h3 class="text-sm sm:text-base font-bold text-gray-800 mb-3 pb-2 border-b-2 border-green-200 flex items-center gap-2">
                    <i class="fas fa-leaf text-green-600"></i>Informasi Umum Tanaman
                </h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs sm:text-sm font-semibold text-gray-700 mb-2 flex items-center gap-2">
                            <i class="fas fa-clover text-green-600"></i>Nama Tanaman
                        </label>
                        <input type="text" name="nama_tanaman" value="{{ old('nama_tanaman') }}" placeholder="Contoh: Kangkung" class="w-full border border-gray-300 rounded-lg px-3 sm:px-4 py-2 sm:py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-green-500" required>
                    </div>
                    <div>
                        <label class="block text-xs sm:text-sm font-semibold text-gray-700 mb-2 flex items-center gap-2">
                            <i class="fas fa-sprout text-blue-600"></i>Metode Budidaya
                        </label>
                        <select name="metode_budidaya" class="w-full border border-gray-300 rounded-lg px-3 sm:px-4 py-2 sm:py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-green-500" required>
                            <option value="">-- Pilih Metode --</option>
                            <option value="Tanah" {{ old('metode_budidaya') == 'Tanah' ? 'selected' : '' }}>Tanah</option>
                            <option value="Hidroponik" {{ old('metode_budidaya') == 'Hidroponik' ? 'selected' : '' }}>Hidroponik</option>
                            <option value="Tanah / Hidroponik" {{ old('metode_budidaya') == 'Tanah / Hidroponik' ? 'selected' : '' }}>Tanah / Hidroponik</option>
                        </select>
                    </div>
                    <div class="sm:col-span-2">
                        <label class="block text-xs sm:text-sm font-semibold text-gray-700 mb-2 flex items-center gap-2">
                            <i class="fas fa-file-alt text-purple-600"></i>Deskripsi <span class="text-gray-400 font-normal text-xs">(opsional)</span>
                        </label>
                        <textarea name="deskripsi" rows="3" placeholder="Deskripsi singkat tentang tanaman..." class="w-full border border-gray-300 rounded-lg px-3 sm:px-4 py-2 sm:py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-green-500 resize-none">{{ old('deskripsi') }}</textarea>
                    </div>
                    <div>
                        <label class="block text-xs sm:text-sm font-semibold text-gray-700 mb-2 flex items-center gap-2">
                            <i class="fas fa-toggle-on text-orange-600"></i>Status
                        </label>
                        <select name="status" class="w-full border border-gray-300 rounded-lg px-3 sm:px-4 py-2 sm:py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-green-500">
                            <option value="aktif">Aktif</option>
                            <option value="nonaktif">Nonaktif</option>
                        </select>
                    </div>
                </div>
            </div>

            {{-- Range Optimal per Kriteria --}}
            <div>
                <h3 class="text-sm sm:text-base font-bold text-gray-800 mb-2 pb-2 border-b-2 border-green-200 flex items-center gap-2">
                    <i class="fas fa-sliders-h text-blue-600"></i>Range Optimal per Kriteria
                </h3>
                <p class="text-xs text-gray-500 mb-4">
                    <i class="fas fa-info-circle mr-1"></i>Isi nilai minimum, maksimum, dan optimal untuk setiap kriteria lahan.
                </p>

                <div class="space-y-4">
                    @foreach($kriteria as $k)
                        <div class="border border-gray-200 rounded-lg p-3 sm:p-4 hover:border-green-300 hover:bg-green-50 transition">
                            <div class="flex items-center gap-2 mb-3 flex-wrap">
                                <span class="bg-green-100 text-green-700 px-2 py-0.5 rounded text-xs font-bold">
                                    {{ $k->kode }}
                                </span>
                                <span class="text-xs sm:text-sm font-semibold text-gray-700">
                                    {{ $k->nama_kriteria }}
                                </span>
                            </div>
                            <input type="hidden" name="detail[{{ $loop->index }}][kriteria_id]" value="{{ $k->id }}">
                            <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                                <div>
                                    <label class="text-xs text-gray-600 font-semibold mb-1 block">Nilai Minimum</label>
                                    <input type="number" step="0.01" name="detail[{{ $loop->index }}][nilai_min]" value="{{ old('detail.' . $loop->index . '.nilai_min') }}" placeholder="0" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-green-500" required>
                                </div>
                                <div>
                                    <label class="text-xs text-gray-600 font-semibold mb-1 block">Nilai Maksimum</label>
                                    <input type="number" step="0.01" name="detail[{{ $loop->index }}][nilai_max]" value="{{ old('detail.' . $loop->index . '.nilai_max') }}" placeholder="0" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-green-500" required>
                                </div>
                                <div>
                                    <label class="text-xs text-gray-600 font-semibold mb-1 block">Nilai Optimal</label>
                                    <input type="number" step="0.01" name="detail[{{ $loop->index }}][nilai_optimal]" value="{{ old('detail.' . $loop->index . '.nilai_optimal') }}" placeholder="0" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-green-500" required>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- Submit --}}
            <div class="flex flex-col sm:flex-row gap-3 pt-2">
                <button type="submit" class="flex-1 bg-green-600 hover:bg-green-700 text-white font-semibold py-2 sm:py-3 rounded-lg transition text-xs sm:text-sm flex items-center justify-center gap-2">
                    <i class="fas fa-save"></i>Simpan Tanaman
                </button>
                <a href="{{ route('admin.tanaman.index') }}" class="flex-1 text-center bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold py-2 sm:py-3 rounded-lg transition text-xs sm:text-sm flex items-center justify-center gap-2">
                    <i class="fas fa-times-circle"></i>Batal
                </a>
            </div>
        </form>
    </div>
@endsection