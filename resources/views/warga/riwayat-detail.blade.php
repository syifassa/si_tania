@extends('layouts.warga')
@section('title', 'Hasil Rekomendasi')

@section('main')
    <div class="max-w-4xl mx-auto px-4 sm:px-0">

        {{-- Header with illustration --}}
        <div class="relative overflow-hidden bg-gradient-to-br from-green-600 via-green-700 to-emerald-800 rounded-2xl shadow-lg mb-6 p-5 sm:p-6">
            <div class="absolute -top-8 -right-8 w-32 h-32 bg-green-400/20 rounded-full blur-2xl"></div>
            <div class="absolute -bottom-6 -left-6 w-24 h-24 bg-emerald-400/20 rounded-full blur-xl"></div>
            <svg class="absolute bottom-2 right-4 opacity-10 w-20 h-20 text-white" viewBox="0 0 24 24" fill="currentColor">
            </svg>
            <div class="relative z-10 flex items-center gap-3">
                <a href="{{ route('warga.riwayat') }}" class="bg-white/20 backdrop-blur rounded-full p-2 hover:bg-white/30 transition">
                    <svg class="w-4 h-4 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                        <path d="M19 12H5m7-7l-7 7 7 7"/>
                    </svg>
                </a>
                <div>
                    <h2 class="text-lg sm:text-xl font-bold text-white">
                        Hasil Rekomendasi #{{ $riwayat->urutan }}
                    </h2>
                    <p class="text-green-200 text-xs mt-0.5">
                        {{ $riwayat->created_at->format('d M Y, H:i') }}
                    </p>
                </div>
            </div>
        </div>

        {{-- Info input --}}
        <div class="bg-white rounded-xl shadow p-5 mb-6">
            <h3 class="font-semibold text-gray-700 mb-3">
                <i class="fas fa-map-location-dot mr-2 text-green-600"></i>Data Kondisi Lahan
            </h3>
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3 text-sm">
                <div class="bg-gray-50 rounded p-3">
                    <p class="text-gray-400 text-xs">Jenis Tanah</p>
                    <p class="font-medium capitalize">{{ $riwayat->jenis_tanah }}</p>
                </div>
                <div class="bg-gray-50 rounded p-3">
                    <p class="text-gray-400 text-xs">pH Air</p>
                    <p class="font-medium">{{ $riwayat->ph_air }}</p>
                </div>
                <div class="bg-gray-50 rounded p-3">
                    <p class="text-gray-400 text-xs">Suhu</p>
                    <p class="font-medium">{{ $riwayat->suhu }} °C</p>
                </div>
                <div class="bg-gray-50 rounded p-3">
                    <p class="text-gray-400 text-xs">Kelembapan</p>
                    <p class="font-medium">{{ $riwayat->kelembapan }} %</p>
                </div>
                <div class="bg-gray-50 rounded p-3">
                    <p class="text-gray-400 text-xs">Cahaya</p>
                    <p class="font-medium">{{ $riwayat->cahaya }} jam/hari</p>
                </div>
                <div class="bg-gray-50 rounded p-3">
                    <p class="text-gray-400 text-xs">Curah Hujan</p>
                    <p class="font-medium">{{ $riwayat->curah_hujan }} mm</p>
                </div>
                <div class="bg-gray-50 rounded p-3">
                    <p class="text-gray-400 text-xs">Luas Lahan</p>
                    <p class="font-medium">{{ $riwayat->luas_lahan }} m²</p>
                </div>
            </div>
        </div>

        {{-- Champion card --}}
        @php $juara = $hasil->firstWhere('ranking', 1); @endphp
        @if($juara)
            <div class="bg-gradient-to-br from-yellow-400 via-yellow-500 to-orange-500 rounded-xl shadow-lg mb-6 p-5 sm:p-6 text-white text-center relative overflow-hidden">
                <div class="absolute -top-6 -right-6 w-32 h-32 bg-white/10 rounded-full blur-2xl"></div>
                <div class="absolute -bottom-4 -left-4 w-24 h-24 bg-white/10 rounded-full blur-xl"></div>
                <div class="relative z-10">
                    <i class="fas fa-crown text-3xl sm:text-4xl mb-2 block"></i>
                    <p class="text-white/80 text-xs sm:text-sm uppercase tracking-widest mb-1">Rekomendasi Terbaik</p>
                    <h3 class="text-xl sm:text-2xl font-bold mb-1">{{ $juara->tanaman->nama_tanaman }}</h3>
                    <div class="flex items-center justify-center gap-2 mb-3">
                        <span class="bg-white/20 rounded-full px-3 py-0.5 text-xs">{{ $juara->metode_budidaya }}</span>
                    </div>
                    <div class="flex items-center justify-center gap-3">
                        <span class="text-4xl sm:text-5xl font-extrabold tracking-tight">
                            {{ number_format($juara->nilai_vi * 100, 2) }}%
                        </span>
                    </div>
                    <div class="mt-3 w-full bg-white/20 rounded-full h-2.5 max-w-xs mx-auto">
                        <div class="bg-white h-2.5 rounded-full" style="width: {{ min($juara->nilai_vi * 100, 100) }}%"></div>
                    </div>
                </div>
            </div>
        @endif

        {{-- Grafik kecil --}}
        @if($hasil->count() > 1)
            <div class="bg-white rounded-xl shadow p-5 mb-6">
                <h3 class="font-semibold text-gray-700 mb-4 text-sm">
                    <i class="fas fa-chart-bar mr-2 text-green-600"></i>Skor Semua Tanaman
                </h3>
                <div class="space-y-3">
                    @foreach($hasil as $h)
                        @php
                            $maxVi = $hasil->max('nilai_vi');
                            $barWidth = $maxVi > 0 ? ($h->nilai_vi / $maxVi) * 100 : 0;
                            $isFirst = $h->ranking == 1;
                        @endphp
                        <div class="flex items-center gap-3">
                            <span class="w-6 text-xs font-bold text-gray-500 text-right shrink-0">#{{ $h->ranking }}</span>
                            <span class="w-28 sm:w-36 text-xs text-gray-700 truncate shrink-0 {{ $isFirst ? 'font-bold text-green-700' : '' }}">
                                {{ $h->tanaman->nama_tanaman }}
                            </span>
                            <div class="flex-1 bg-gray-100 rounded-full h-4 overflow-hidden">
                                <div class="h-4 rounded-full {{ $isFirst ? 'bg-gradient-to-r from-green-400 to-green-600' : 'bg-gray-300' }}" style="width: {{ $barWidth }}%"></div>
                            </div>
                            <span class="w-16 text-xs font-semibold text-right shrink-0 {{ $isFirst ? 'text-green-700' : 'text-gray-500' }}">
                                {{ number_format($h->nilai_vi * 100, 2) }}%
                            </span>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        {{-- Tabel ranking (Responsive) --}}
        <div class="bg-white rounded-xl shadow overflow-hidden">
            <div class="px-5 py-4 border-b">
                <h3 class="font-semibold text-gray-700">
                    <i class="fas fa-ranking-star mr-2 text-green-600"></i>Detail Ranking
                </h3>
            </div>
            
            {{-- Desktop view --}}
            <div class="hidden md:block overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-gray-50 text-gray-500 text-xs uppercase">
                        <tr>
                            <th class="px-4 py-3 text-left">Ranking</th>
                            <th class="px-4 py-3 text-left">Tanaman</th>
                            <th class="px-4 py-3 text-left">Skor (%)</th>
                            <th class="px-4 py-3 text-left">Metode Budidaya</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach($hasil as $h)
                            <tr class="{{ $h->ranking == 1 ? 'bg-green-50' : 'hover:bg-gray-50' }}">
                                <td class="px-4 py-3 font-semibold">
                                    @if($h->ranking == 1) 
                                        <span class="text-yellow-500"><i class="fas fa-medal"></i> 1</span>
                                    @elseif($h->ranking == 2)
                                        <span class="text-gray-400"><i class="fas fa-medal"></i> 2</span>
                                    @elseif($h->ranking == 3)
                                        <span class="text-orange-600"><i class="fas fa-medal"></i> 3</span>
                                    @else 
                                        {{ $h->ranking }}
                                    @endif
                                </td>
                                <td class="px-4 py-3 font-medium text-gray-800">
                                    {{ $h->tanaman->nama_tanaman }}
                                </td>
                                <td class="px-4 py-3">
                                    <div class="flex items-center gap-2">
                                        <div class="w-20 bg-gray-200 rounded-full h-1.5">
                                            <div class="bg-green-500 h-1.5 rounded-full" style="width: {{ min($h->nilai_vi * 100, 100) }}%">
                                            </div>
                                        </div>
                                        <span class="font-medium">{{ number_format($h->nilai_vi * 100, 2) }}%</span>
                                    </div>
                                </td>
                                <td class="px-4 py-3 text-gray-600">
                                    <span class="bg-green-100 text-green-800 text-xs px-2 py-1 rounded-full">
                                        {{ $h->metode_budidaya }}
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- Mobile view (Cards) --}}
            <div class="md:hidden divide-y divide-gray-100">
                @foreach($hasil as $h)
                    <div class="px-4 py-4 {{ $h->ranking == 1 ? 'bg-green-50' : 'hover:bg-gray-50' }}">
                        <div class="flex items-start justify-between mb-3">
                            <div>
                                <p class="font-semibold text-gray-800">
                                    @if($h->ranking == 1)
                                        <i class="fas fa-medal text-yellow-500"></i>
                                    @elseif($h->ranking == 2)
                                        <i class="fas fa-medal text-gray-400"></i>
                                    @elseif($h->ranking == 3)
                                        <i class="fas fa-medal text-orange-600"></i>
                                    @endif
                                    Ranking {{ $h->ranking }}
                                </p>
                                <p class="text-gray-600 text-sm">{{ $h->tanaman->nama_tanaman }}</p>
                            </div>
                            <span class="text-xs font-semibold {{ $h->ranking == 1 ? 'text-green-700 bg-green-100 px-2 py-1 rounded-full' : 'text-gray-500' }}">
                                {{ number_format($h->nilai_vi * 100, 2) }}%
                            </span>
                        </div>
                        
                        <div class="mb-3">
                            <p class="text-xs text-gray-500 mb-1">Skor (%)</p>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="bg-green-500 h-2 rounded-full" style="width: {{ min($h->nilai_vi * 100, 100) }}%">
                                </div>
                            </div>
                        </div>

                        <div class="bg-blue-50 border border-blue-200 rounded p-2">
                            <p class="text-xs text-gray-500 mb-1">
                                <i class="fas fa-leaf text-green-600 mr-1"></i>Metode Budidaya
                            </p>
                            <p class="text-sm font-medium text-gray-800">{{ $h->metode_budidaya }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- Input baru --}}
        <div class="mt-6 text-center mb-4">
            <a href="{{ route('warga.input.form') }}" class="inline-block bg-green-600 hover:bg-green-700 text-white font-semibold px-6 py-2.5 rounded-lg text-sm transition">
                <i class="fas fa-plus mr-2"></i>Input Lahan Baru
            </a>
        </div>
    </div>
@endsection