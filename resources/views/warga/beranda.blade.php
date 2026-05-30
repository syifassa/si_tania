@extends('layouts.warga')
@section('title', 'Beranda')

@section('main')
    {{-- HERO --}}
    <div class="relative overflow-hidden bg-gradient-to-br from-green-600 via-emerald-600 to-green-700 rounded-3xl shadow-lg mb-8 px-6 sm:px-10 py-8 sm:py-10">
        {{-- Decorative blobs --}}
        <div class="absolute -top-16 -right-16 w-64 h-64 bg-green-400/20 rounded-full blur-3xl"></div>
        <div class="absolute -bottom-20 -left-20 w-72 h-72 bg-emerald-300/20 rounded-full blur-3xl"></div>
        <div class="absolute top-1/2 right-8 w-2 h-2 bg-white/30 rounded-full"></div>
        <div class="absolute bottom-12 left-1/4 w-3 h-3 bg-white/20 rounded-full"></div>

        {{-- SVG illustration -- urban farming scene --}}
        <div class="absolute bottom-0 right-0 opacity-10 sm:opacity-20 select-none pointer-events-none">
            <svg width="280" height="200" viewBox="0 0 280 200" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect x="40" y="100" width="20" height="80" rx="4" fill="white"/>
                <rect x="70" y="80" width="20" height="100" rx="4" fill="white"/>
                <rect x="100" y="110" width="20" height="70" rx="4" fill="white"/>
                <rect x="130" y="60" width="20" height="120" rx="4" fill="white"/>
                <rect x="160" y="90" width="20" height="90" rx="4" fill="white"/>
                <rect x="190" y="70" width="20" height="110" rx="4" fill="white"/>
                <rect x="220" y="100" width="20" height="80" rx="4" fill="white"/>
                <path d="M50 100l50-30 50 20 50-40 50 25 30-15" stroke="white" stroke-width="2" stroke-linecap="round" fill="none" opacity="0.6"/>
                <circle cx="50" cy="95" r="8" fill="white" opacity="0.4"/>
                <circle cx="100" cy="65" r="10" fill="white" opacity="0.3"/>
                <circle cx="150" cy="130" r="12" fill="white" opacity="0.4"/>
                <circle cx="200" cy="75" r="9" fill="white" opacity="0.3"/>
                <circle cx="250" cy="80" r="11" fill="white" opacity="0.4"/>
                <path d="M80 110c10-20 50-25 70-5" stroke="white" stroke-width="1.5" stroke-linecap="round" fill="none" opacity="0.5"/>
                <path d="M180 90c10-15 40-20 50-5" stroke="white" stroke-width="1.5" stroke-linecap="round" fill="none" opacity="0.5"/>
                <path d="M30 105c0-8 5-12 12-8" stroke="white" stroke-width="1.5" stroke-linecap="round" fill="none" opacity="0.7"/>
                <path d="M230 85c0-8 5-12 12-8" stroke="white" stroke-width="1.5" stroke-linecap="round" fill="none" opacity="0.7"/>
            </svg>
        </div>

        <div class="relative z-10">
            <div class="flex flex-col sm:flex-row items-start gap-6">
                <div class="w-20 h-20 sm:w-24 sm:h-24 bg-white/10 backdrop-blur rounded-full flex items-center justify-center flex-shrink-0">
                    <i class="fas fa-circle-check text-3xl sm:text-4xl text-white/70"></i>
                </div>
                <div class="flex-1">
                    <span class="inline-block bg-white/20 backdrop-blur text-white text-[10px] font-bold px-3 py-1 rounded-full uppercase tracking-wider mb-2">Urban Farming</span>
                    <h2 class="text-2xl sm:text-3xl font-bold text-white leading-tight">
                        Selamat datang, <span class="text-yellow-300">{{ auth()->user()->name }}</span>
                    </h2>
                    <p class="text-green-100 mt-2 text-sm sm:text-base max-w-xl leading-relaxed">
                        Temukan tanaman urban farming yang paling cocok untuk lahannya. Cukup masukkan kondisi lahan, biarkan sistem yang merekomendasikan.
                    </p>
                </div>
            </div>

            {{-- Stats --}}
            <div class="mt-6 flex flex-wrap gap-3">
                <div class="bg-white/15 backdrop-blur rounded-xl px-4 py-2.5 text-center min-w-[90px]">
                    <p class="text-xl sm:text-2xl font-bold text-white">{{ $totalRiwayat }}</p>
                    <p class="text-[10px] text-green-200 uppercase tracking-wider">Riwayat</p>
                </div>
                <div class="bg-white/15 backdrop-blur rounded-xl px-4 py-2.5 text-center min-w-[90px]">
                    <p class="text-xl sm:text-2xl font-bold text-white">7</p>
                    <p class="text-[10px] text-green-200 uppercase tracking-wider">Kriteria</p>
                </div>
                <div class="bg-white/15 backdrop-blur rounded-xl px-4 py-2.5 text-center min-w-[90px]">
                    <p class="text-sm sm:text-base font-bold text-white">AHP-TOPSIS</p>
                    <p class="text-[10px] text-green-200 uppercase tracking-wider">Metode</p>
                </div>
            </div>
        </div>
    </div>

    {{-- HOW IT WORKS --}}
    <div class="mb-8">
        <div class="text-center mb-6">
            <h3 class="text-lg font-bold text-gray-800">Bagaimana Cara Kerjanya?</h3>
            <p class="text-gray-400 text-sm mt-1">Tiga langkah mudah mendapatkan rekomendasi tanaman</p>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
            <div class="bg-white rounded-2xl p-5 shadow-sm border border-gray-100 text-center relative group hover:shadow-md transition">
                <div class="w-12 h-12 mx-auto mb-3 bg-green-100 rounded-xl flex items-center justify-center text-green-600 group-hover:bg-green-600 group-hover:text-white transition">
                    <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/><polyline points="3.27 6.96 12 12.01 20.73 6.96"/><line x1="12" y1="22.08" x2="12" y2="12"/></svg>
                </div>
                <span class="absolute -top-2 -right-2 w-6 h-6 bg-green-600 text-white text-xs rounded-full flex items-center justify-center font-bold">1</span>
                <h4 class="font-semibold text-gray-800 text-sm">Input Kondisi Lahan</h4>
                <p class="text-gray-400 text-xs mt-1">Masukkan data tanah, pH, suhu, kelembapan, dan lainnya</p>
            </div>
            <div class="bg-white rounded-2xl p-5 shadow-sm border border-gray-100 text-center relative group hover:shadow-md transition">
                <div class="w-12 h-12 mx-auto mb-3 bg-emerald-100 rounded-xl flex items-center justify-center text-emerald-600 group-hover:bg-emerald-600 group-hover:text-white transition">
                    <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 12h-4l-3 9L9 3l-3 9H2"/></svg>
                </div>
                <span class="absolute -top-2 -right-2 w-6 h-6 bg-emerald-600 text-white text-xs rounded-full flex items-center justify-center font-bold">2</span>
                <h4 class="font-semibold text-gray-800 text-sm">Sistem Menghitung</h4>
                <p class="text-gray-400 text-xs mt-1">Algoritma AHP-TOPSIS memproses data dan mencocokkan dengan tanaman</p>
            </div>
            <div class="bg-white rounded-2xl p-5 shadow-sm border border-gray-100 text-center relative group hover:shadow-md transition">
                <div class="w-12 h-12 mx-auto mb-3 bg-green-100 rounded-xl flex items-center justify-center text-green-600 group-hover:bg-green-600 group-hover:text-white transition">
                    <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <span class="absolute -top-2 -right-2 w-6 h-6 bg-green-600 text-white text-xs rounded-full flex items-center justify-center font-bold">3</span>
                <h4 class="font-semibold text-gray-800 text-sm">Dapatkan Rekomendasi</h4>
                <p class="text-gray-400 text-xs mt-1">Lihat tanaman terbaik yang cocok untuk lahan Anda lengkap dengan metode budidaya</p>
            </div>
        </div>
    </div>

    {{-- MAIN MENU CARDS --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 sm:gap-5 mb-8">
        <a href="{{ route('warga.input.form') }}" class="group relative bg-white rounded-2xl shadow-sm border border-gray-100 hover:shadow-xl transition-all duration-300 overflow-hidden">
            <div class="absolute inset-0 bg-gradient-to-br from-green-500/5 to-emerald-500/5 opacity-0 group-hover:opacity-100 transition"></div>
            <div class="absolute -top-8 -right-8 w-32 h-32 bg-green-100 rounded-full opacity-0 group-hover:opacity-60 group-hover:scale-150 transition-all duration-500"></div>
            <div class="relative p-5 sm:p-6 flex items-start gap-5">
                <div class="w-16 h-16 sm:w-20 sm:h-20 bg-gradient-to-br from-green-500 to-emerald-600 rounded-2xl flex items-center justify-center text-white shadow-lg group-hover:scale-110 group-hover:rotate-3 transition duration-300 flex-shrink-0">
                    <i class="fas fa-seedling text-2xl sm:text-3xl"></i>
                </div>
                <div class="flex-1 min-w-0">
                    <h3 class="font-bold text-gray-800 text-base sm:text-lg group-hover:text-green-700 transition-colors">Input Kondisi Lahan</h3>
                    <p class="text-xs sm:text-sm text-gray-400 mt-1 leading-relaxed">
                        Masukkan data lahan Anda dan dapatkan rekomendasi tanaman paling cocok untuk urban farming
                    </p>
                    <span class="inline-block mt-3 text-green-600 text-xs font-semibold group-hover:translate-x-1 transition-transform flex items-center gap-1">
                        Mulai sekarang <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                    </span>
                </div>
            </div>
        </a>

        <a href="{{ route('warga.riwayat') }}" class="group relative bg-white rounded-2xl shadow-sm border border-gray-100 hover:shadow-xl transition-all duration-300 overflow-hidden">
            <div class="absolute inset-0 bg-gradient-to-br from-blue-500/5 to-indigo-500/5 opacity-0 group-hover:opacity-100 transition"></div>
            <div class="absolute -top-8 -left-8 w-32 h-32 bg-blue-100 rounded-full opacity-0 group-hover:opacity-60 group-hover:scale-150 transition-all duration-500"></div>
            <div class="relative p-5 sm:p-6 flex items-start gap-5">
                <div class="w-16 h-16 sm:w-20 sm:h-20 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-2xl flex items-center justify-center text-white shadow-lg group-hover:scale-110 group-hover:-rotate-3 transition duration-300 flex-shrink-0">
                    <i class="fas fa-history text-2xl sm:text-3xl"></i>
                </div>
                <div class="flex-1 min-w-0">
                    <h3 class="font-bold text-gray-800 text-base sm:text-lg group-hover:text-blue-700 transition-colors">Riwayat Rekomendasi</h3>
                    <p class="text-xs sm:text-sm text-gray-400 mt-1 leading-relaxed">
                        Lihat dan bandingkan hasil rekomendasi dari input lahan sebelumnya, lengkap dengan skor TOPSIS
                    </p>
                    <span class="inline-block mt-3 text-blue-600 text-xs font-semibold group-hover:translate-x-1 transition-transform flex items-center gap-1">
                        Lihat riwayat <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                    </span>
                </div>
            </div>
        </a>
    </div>

    {{-- RECENT HISTORY --}}
    @if($riwayatTerbaru && $riwayatTerbaru->count() > 0)
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5 sm:p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="font-bold text-gray-800 flex items-center gap-2">
                    <svg class="w-5 h-5 text-green-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                    Riwayat Terbaru
                </h3>
                <a href="{{ route('warga.riwayat') }}" class="text-xs text-green-600 hover:text-green-700 font-semibold flex items-center gap-1">
                    Lihat semua <svg class="w-3 h-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                </a>
            </div>
            <div class="space-y-2">
                @foreach($riwayatTerbaru as $r)
                    <a href="{{ route('warga.riwayat.detail', $r->id) }}" class="flex items-center justify-between p-3 sm:p-4 bg-gray-50 hover:bg-green-50 rounded-xl transition group">
                        <div class="flex items-center gap-3 min-w-0">
                            <div class="w-10 h-10 rounded-xl bg-green-100 flex items-center justify-center text-green-600 flex-shrink-0 group-hover:bg-green-600 group-hover:text-white transition">
                                <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2"/><line x1="3" y1="9" x2="21" y2="9"/><line x1="9" y1="21" x2="9" y2="9"/></svg>
                            </div>
                            <div class="min-w-0">
                                <span class="text-sm font-semibold text-gray-700 group-hover:text-green-700 transition">Input #{{ $r->urutan }}</span>
                                <span class="text-xs text-gray-400 block mt-0.5">
                                    <svg class="w-3 h-3 inline mr-1" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                                    {{ $r->created_at->format('d M Y, H:i') }}
                                </span>
                            </div>
                        </div>
                        <svg class="w-4 h-4 text-gray-300 group-hover:text-green-500 group-hover:translate-x-0.5 transition flex-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 18l6-6-6-6"/></svg>
                    </a>
                @endforeach
            </div>
        </div>
    @else
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8 text-center">
            <div class="w-16 h-16 mx-auto mb-3 bg-gray-100 rounded-2xl flex items-center justify-center text-gray-400">
                <svg class="w-8 h-8" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
            </div>
            <h4 class="font-semibold text-gray-700">Belum Ada Riwayat</h4>
            <p class="text-xs text-gray-400 mt-1 max-w-xs mx-auto">Anda belum melakukan input lahan. Mulai sekarang untuk mendapatkan rekomendasi tanaman!</p>
            <a href="{{ route('warga.input.form') }}" class="inline-block mt-4 bg-green-600 hover:bg-green-700 text-white text-sm font-semibold px-5 py-2 rounded-xl transition shadow">
                Input Lahan Sekarang
            </a>
        </div>
    @endif

    {{-- TIPS SECTION --}}
    <div class="mt-8 bg-gradient-to-br from-amber-50 to-yellow-50 rounded-2xl border border-amber-200/60 p-5 sm:p-6">
        <div class="flex items-start gap-4">
            <div class="w-12 h-12 bg-amber-100 rounded-xl flex items-center justify-center text-amber-600 flex-shrink-0">
                <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
            </div>
            <div>
                <h4 class="font-bold text-gray-800 text-sm sm:text-base">Tips Urban Farming</h4>
                <p class="text-xs sm:text-sm text-gray-500 mt-1 leading-relaxed">
                    Pastikan Anda mengukur pH air, suhu, dan kelembapan lahan secara akurat sebelum melakukan input. 
                    Semakin akurat data, semakin tepat rekomendasi tanaman yang diberikan sistem.
                </p>
            </div>
        </div>
    </div>
@endsection
