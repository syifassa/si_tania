@extends('layouts.warga')
@section('title', 'Input Kondisi Lahan')

@section('main')
    <div class="max-w-3xl mx-auto px-4 sm:px-0">
        {{-- Header with illustration --}}
        <div class="relative overflow-hidden bg-gradient-to-br from-green-600 via-green-700 to-emerald-800 rounded-2xl shadow-lg mb-6 p-5 sm:p-6">
            <div class="absolute -top-8 -right-8 w-32 h-32 bg-green-400/20 rounded-full blur-2xl"></div>
            <div class="absolute -bottom-6 -left-6 w-24 h-24 bg-emerald-400/20 rounded-full blur-xl"></div>
            <svg class="absolute bottom-2 right-4 opacity-10 w-20 h-20 text-white" viewBox="0 0 24 24" fill="currentColor">
                
            </svg>
            <div class="relative z-10 flex items-center gap-4">
                <div class="flex-shrink-0 w-14 h-14 bg-white/20 backdrop-blur rounded-2xl flex items-center justify-center">
                    <svg class="w-7 h-7 text-white" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M19.78 2.2L24 6.42L8.44 22L0 13.55L4.22 9.33L8.44 13.55L19.78 2.2Z"/>
                    </svg>
                </div>
                <div>
                    <h2 class="text-lg sm:text-xl font-bold text-white">Input Kondisi Lahan</h2>
                    <p class="text-green-200 text-xs sm:text-sm mt-0.5">
                        Isi parameter kondisi lahan Anda untuk mendapatkan rekomendasi tanaman paling sesuai
                    </p>
                </div>
            </div>
        </div>

        @if($errors->any())
            <div class="mb-4 bg-red-50 border border-red-300 text-red-700 px-3 sm:px-4 py-3 rounded text-xs sm:text-sm">
                <i class="fas fa-exclamation-circle mr-2"></i>
                <ul class="list-disc list-inside space-y-1">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('warga.input.simpan') }}" class="bg-white rounded-xl shadow p-4 sm:p-6 space-y-4 sm:space-y-5">
            @csrf

            {{-- Row 1: Jenis Tanah & pH Air --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 sm:gap-5">
                {{-- K1: Jenis Tanah --}}
                <div>
                    <label class="block text-xs sm:text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-layer-group text-green-600 mr-1.5"></i>K1 — Jenis Tanah
                    </label>
                    <select name="jenis_tanah"
                        class="w-full border border-gray-300 rounded-lg px-3 sm:px-4 py-2 sm:py-2.5 text-xs sm:text-sm focus:outline-none focus:ring-2 focus:ring-green-500"
                        required>
                        <option value="">-- Pilih Jenis Tanah --</option>
                        <option value="6.75" {{ old('jenis_tanah') == '6.75' ? 'selected' : '' }}>
                            Istimewa (Andosol, pH 6.5–7.0)
                        </option>
                        <option value="6.25" {{ old('jenis_tanah') == '6.25' ? 'selected' : '' }}>
                            Sangat Baik (Aluvial/Latosol, pH 6.0–6.5)
                        </option>
                        <option value="5.85" {{ old('jenis_tanah') == '5.85' ? 'selected' : '' }}>
                            Baik (Latosol, pH 5.8–5.9)
                        </option>
                        <option value="5.6" {{ old('jenis_tanah') == '5.6' ? 'selected' : '' }}>
                            Cukup (pH 5.5–5.7)
                        </option>
                        <option value="5.0" {{ old('jenis_tanah') == '5.0' ? 'selected' : '' }}>
                            Kurang (pH &lt; 5.5)
                        </option>
                    </select>
                </div>

                {{-- K2: pH Air --}}
                <div>
                    <label class="block text-xs sm:text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-flask-vial text-blue-600 mr-1.5"></i>K2 — pH Air
                    </label>
                    <select name="ph_air"
                        class="w-full border border-gray-300 rounded-lg px-3 sm:px-4 py-2 sm:py-2.5 text-xs sm:text-sm focus:outline-none focus:ring-2 focus:ring-green-500"
                        required>
                        <option value="">-- Pilih pH Air --</option>
                        <option value="7.0" {{ old('ph_air') == '7.0' ? 'selected' : '' }}>
                            Sangat Baik (pH 6.5–7.5)
                        </option>
                        <option value="6.2" {{ old('ph_air') == '6.2' ? 'selected' : '' }}>
                            Baik (pH 6.0–6.4)
                        </option>
                        <option value="5.7" {{ old('ph_air') == '5.7' ? 'selected' : '' }}>
                            Cukup (pH 5.5–5.9)
                        </option>
                        <option value="5.0" {{ old('ph_air') == '5.0' ? 'selected' : '' }}>
                            Kurang (pH &lt; 5.5 atau &gt; 8.5)
                        </option>
                    </select>
                </div>
            </div>

            {{-- Row 2: Suhu & Kelembapan --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 sm:gap-5">
                {{-- K3: Suhu --}}
                <div>
                    <label class="block text-xs sm:text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-thermometer-full text-red-600 mr-1.5"></i>K3 — Suhu
                    </label>
                    <select name="suhu"
                        class="w-full border border-gray-300 rounded-lg px-3 sm:px-4 py-2 sm:py-2.5 text-xs sm:text-sm focus:outline-none focus:ring-2 focus:ring-green-500"
                        required>
                        <option value="">-- Pilih Suhu --</option>
                        <option value="27.5" {{ old('suhu') == '27.5' ? 'selected' : '' }}>
                            Sangat Baik (25–30°C)
                        </option>
                        <option value="24.5" {{ old('suhu') == '24.5' ? 'selected' : '' }}>
                            Baik (24–25°C)
                        </option>
                        <option value="32.5" {{ old('suhu') == '32.5' ? 'selected' : '' }}>
                            Cukup (32–33°C)
                        </option>
                        <option value="22" {{ old('suhu') == '22' ? 'selected' : '' }}>
                            Kurang (&lt; 24°C atau &gt; 33°C)
                        </option>
                    </select>
                </div>

                {{-- K4: Kelembapan Udara --}}
                <div>
                    <label class="block text-xs sm:text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-droplet-slash text-cyan-600 mr-1.5"></i>K4 — Kelembapan Udara
                    </label>
                    <select name="kelembapan"
                        class="w-full border border-gray-300 rounded-lg px-3 sm:px-4 py-2 sm:py-2.5 text-xs sm:text-sm focus:outline-none focus:ring-2 focus:ring-green-500"
                        required>
                        <option value="">-- Pilih Kelembapan --</option>
                        <option value="72.5" {{ old('kelembapan') == '72.5' ? 'selected' : '' }}>
                            Sangat Baik (65–80%)
                        </option>
                        <option value="85.5" {{ old('kelembapan') == '85.5' ? 'selected' : '' }}>
                            Baik (81–90%)
                        </option>
                        <option value="93" {{ old('kelembapan') == '93' ? 'selected' : '' }}>
                            Cukup (91–95%)
                        </option>
                        <option value="97" {{ old('kelembapan') == '97' ? 'selected' : '' }}>
                            Kurang (&gt; 95%)
                        </option>
                    </select>
                </div>
            </div>

            {{-- Row 3: Cahaya & Curah Hujan --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 sm:gap-5">
                {{-- K5: Intensitas Cahaya --}}
                <div>
                    <label class="block text-xs sm:text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-sun text-yellow-600 mr-1.5"></i>K5 — Intensitas Cahaya (jam/hari)
                    </label>
                    <select name="cahaya"
                        class="w-full border border-gray-300 rounded-lg px-3 sm:px-4 py-2 sm:py-2.5 text-xs sm:text-sm focus:outline-none focus:ring-2 focus:ring-green-500"
                        required>
                        <option value="">-- Pilih Intensitas Cahaya --</option>
                        <option value="9" {{ old('cahaya') == '9' ? 'selected' : '' }}>
                            Sangat Cerah (8–10 jam/hari)
                        </option>
                        <option value="6.5" {{ old('cahaya') == '6.5' ? 'selected' : '' }}>
                            Cerah (6–7 jam/hari)
                        </option>
                        <option value="4.5" {{ old('cahaya') == '4.5' ? 'selected' : '' }}>
                            Sedang (4–5 jam/hari)
                        </option>
                        <option value="2" {{ old('cahaya') == '2' ? 'selected' : '' }}>
                            Redup (&lt; 4 jam/hari)
                        </option>
                    </select>
                </div>

                {{-- K6: Curah Hujan Tahunan --}}
                <div>
                    <label class="block text-xs sm:text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-cloud-rain text-indigo-600 mr-1.5"></i>K6 — Curah Hujan Tahunan
                    </label>
                    <select name="curah_hujan"
                        class="w-full border border-gray-300 rounded-lg px-3 sm:px-4 py-2 sm:py-2.5 text-xs sm:text-sm focus:outline-none focus:ring-2 focus:ring-green-500"
                        required>
                        <option value="">-- Pilih Curah Hujan --</option>
                        <option value="1800" {{ old('curah_hujan') == '1800' ? 'selected' : '' }}>
                            Sangat Baik (1.600–2.000 mm/th)
                        </option>
                        <option value="1450" {{ old('curah_hujan') == '1450' ? 'selected' : '' }}>
                            Baik (1.300–1.599 mm/th)
                        </option>
                        <option value="1150" {{ old('curah_hujan') == '1150' ? 'selected' : '' }}>
                            Cukup (1.000–1.299 mm/th)
                        </option>
                        <option value="800" {{ old('curah_hujan') == '800' ? 'selected' : '' }}>
                            Kurang (&lt; 1.000 atau &gt; 2.600 mm/th)
                        </option>
                    </select>
                </div>
            </div>

            {{-- K7: Luas Lahan --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 sm:gap-5">
                <div>
                    <label class="block text-xs sm:text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-ruler text-purple-600 mr-1.5"></i>K7 — Luas Lahan (m²)
                    </label>
                    <input type="number" name="luas_lahan" step="0.1" min="0" value="{{ old('luas_lahan') }}"
                        class="w-full border border-gray-300 rounded-lg px-3 sm:px-4 py-2 sm:py-2.5 text-xs sm:text-sm focus:outline-none focus:ring-2 focus:ring-green-500"
                        placeholder="contoh: 120" required>
                </div>
            </div>

            {{-- Button --}}
            <button type="submit"
                class="w-full md:max-w-sm mx-auto block bg-green-600 hover:bg-green-700 text-white font-semibold py-2.5 sm:py-3 rounded-lg transition text-xs sm:text-sm">
                <i class="fas fa-calculator mr-2"></i>Hitung Rekomendasi
            </button>
        </form>
    </div>
@endsection