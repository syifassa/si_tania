@extends('layouts.warga')
@section('title', 'Riwayat Rekomendasi')

@section('main')
    {{-- Header with illustration --}}
    <div class="relative overflow-hidden bg-gradient-to-br from-blue-600 via-blue-700 to-indigo-800 rounded-2xl shadow-lg mb-6 p-5 sm:p-6">
        <div class="absolute -top-8 -right-8 w-32 h-32 bg-blue-400/20 rounded-full blur-2xl"></div>
        <div class="absolute -bottom-6 -left-6 w-24 h-24 bg-indigo-400/20 rounded-full blur-xl"></div>
        <svg class="absolute bottom-2 right-4 opacity-10 w-20 h-20 text-white" viewBox="0 0 24 24" fill="currentColor">
            <path d="M13 3a9 9 0 0 0-9 9H1l3.89 3.89l.07.14L9 12H6c0-3.87 3.13-7 7-7s7 3.13 7 7-3.13 7-7 7c-1.93 0-3.68-.79-4.94-2.06l-1.42 1.42A8.954 8.954 0 0 0 13 21a9 9 0 0 0 0-18zm-1 5v5l4.28 2.54l.72-1.21l-3.5-2.08V8H12z"/>
        </svg>
        <div class="relative z-10 flex items-center gap-3">
            <a href="{{ route('warga.beranda') }}" class="bg-white/20 backdrop-blur rounded-full p-2 hover:bg-white/30 transition">
                <svg class="w-4 h-4 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                    <path d="M19 12H5m7-7l-7 7 7 7"/>
                </svg>
            </a>
            <div>
                <h2 class="text-lg sm:text-xl font-bold text-white">
                    <svg class="inline w-5 h-5 mr-1.5 -mt-0.5" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M13 3a9 9 0 0 0-9 9H1l3.89 3.89l.07.14L9 12H6c0-3.87 3.13-7 7-7s7 3.13 7 7-3.13 7-7 7c-1.93 0-3.68-.79-4.94-2.06l-1.42 1.42A8.954 8.954 0 0 0 13 21a9 9 0 0 0 0-18z"/>
                    </svg>
                    Riwayat Rekomendasi
                </h2>
                <p class="text-blue-200 text-xs mt-0.5">
                    Histori seluruh input lahan dan hasil rekomendasinya
                </p>
            </div>
        </div>
    </div>

    <div class="flex flex-col lg:flex-row gap-6">

        {{-- FILTER SIDEBAR --}}
        <aside class="w-full lg:w-64 shrink-0">
            {{-- Toggle button mobile --}}
            <button onclick="toggleFilter()" class="lg:hidden w-full flex items-center justify-between bg-white rounded-xl shadow px-4 py-3 mb-3 text-sm font-semibold text-gray-700 hover:bg-gray-50 transition">
                <span><i class="fas fa-filter mr-2"></i>Filter</span>
                <span id="filterArrow"><i class="fas fa-chevron-down"></i></span>
            </button>
            <div id="filterContent" class="bg-white rounded-xl shadow p-4 hidden lg:block">
                <h3 class="text-sm font-semibold text-gray-600 mb-3 uppercase tracking-wide hidden lg:block">
                    <i class="fas fa-filter mr-2"></i>Filter
                </h3>
                <ul class="space-y-1 text-sm">
                    <li>
                        <a href="{{ route('warga.riwayat') }}" class="flex items-center gap-2 px-3 py-2 rounded-lg hover:bg-green-50 text-gray-700 transition {{ !request('filter') ? 'bg-green-50 text-green-700 font-semibold' : '' }}">
                            <i class="fas fa-list"></i>Semua Riwayat
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('warga.riwayat', ['filter' => 'hari_ini']) }}" class="flex items-center gap-2 px-3 py-2 rounded-lg hover:bg-green-50 text-gray-700 transition {{ request('filter') == 'hari_ini' ? 'bg-green-50 text-green-700 font-semibold' : '' }}">
                            <i class="fas fa-calendar-day"></i>Hari Ini
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('warga.riwayat', ['filter' => 'minggu_ini']) }}" class="flex items-center gap-2 px-3 py-2 rounded-lg hover:bg-green-50 text-gray-700 transition {{ request('filter') == 'minggu_ini' ? 'bg-green-50 text-green-700 font-semibold' : '' }}">
                            <i class="fas fa-calendar-week"></i>Minggu Ini
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('warga.riwayat', ['filter' => 'bulan_ini']) }}" class="flex items-center gap-2 px-3 py-2 rounded-lg hover:bg-green-50 text-gray-700 transition {{ request('filter') == 'bulan_ini' ? 'bg-green-50 text-green-700 font-semibold' : '' }}">
                            <i class="fas fa-calendar"></i>Bulan Ini
                        </a>
                    </li>
                </ul>

                <div class="mt-4 pt-4 border-t">
                    <a href="{{ route('warga.input.form') }}"
                        class="w-full bg-green-600 hover:bg-green-700 text-white text-sm font-semibold px-4 py-2.5 rounded-lg transition flex items-center justify-center gap-2">
                        <i class="fas fa-plus"></i>Input Lahan Baru
                    </a>
                </div>
            </div>
        </aside>

        {{-- DAFTAR RIWAYAT --}}
        <div class="flex-1">
            @forelse($riwayat as $r)
                <a href="{{ route('warga.riwayat.detail', $r->id) }}"
                    class="block bg-white rounded-xl shadow hover:shadow-md transition mb-4 p-5">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="font-semibold text-gray-800">
                                Input #{{ $r->urutan }}
                            </p>
                            <p class="text-xs text-gray-400 mt-0.5">
                                <i class="fas fa-clock mr-1"></i>{{ $r->created_at->format('d M Y, H:i') }}
                            </p>
                        </div>
                        <span class="text-green-600 text-sm font-medium">
                            <i class="fas fa-chevron-right"></i>
                        </span>
                    </div>
                    <div class="mt-3 flex flex-wrap gap-2">
                        <span class="bg-gray-100 text-gray-600 text-xs px-2 py-1 rounded-full">
                            <i class="fas fa-leaf mr-1 text-green-600"></i>{{ ucfirst($r->jenis_tanah) }}
                        </span>
                        <span class="bg-gray-100 text-gray-600 text-xs px-2 py-1 rounded-full">
                            <i class="fas fa-droplet mr-1 text-blue-500"></i>pH {{ $r->ph_air }}
                        </span>
                        <span class="bg-gray-100 text-gray-600 text-xs px-2 py-1 rounded-full">
                            <i class="fas fa-thermometer mr-1 text-red-500"></i>{{ $r->suhu }}°C
                        </span>
                        <span class="bg-gray-100 text-gray-600 text-xs px-2 py-1 rounded-full">
                            <i class="fas fa-ruler mr-1 text-purple-600"></i>{{ $r->luas_lahan }} m²
                        </span>
                    </div>
                    @php
                        $ranking1 = optional($r->hasil)->firstWhere('ranking', 1);
                    @endphp
                    @if($ranking1)
                        <div class="mt-3 pt-3 border-t border-gray-100">
                            <div class="flex items-center justify-between bg-gradient-to-r from-yellow-50 to-orange-50 rounded-xl p-3 border border-yellow-200">
                                <div class="flex items-center gap-3 min-w-0">
                                    <div class="w-9 h-9 bg-yellow-400 rounded-full flex items-center justify-center text-white text-sm shrink-0">
                                        <i class="fas fa-crown"></i>
                                    </div>
                                    <div class="min-w-0">
                                        <p class="text-[11px] text-yellow-700 uppercase tracking-wider font-semibold">Peringkat 1</p>
                                        <p class="font-bold text-gray-800 text-sm truncate">{{ $ranking1->tanaman->nama_tanaman }}</p>
                                    </div>
                                </div>
                                <div class="text-right shrink-0 ml-3">
                                    <p class="text-lg font-extrabold text-green-700">{{ number_format($ranking1->nilai_vi * 100, 2) }}%</p>
                                    <p class="text-[10px] text-gray-500">skor</p>
                                </div>
                            </div>
                        </div>
                    @elseif(optional($r->hasil)->count() > 0)
                        <div class="mt-3 pt-3 border-t border-gray-100">
                            <p class="text-xs text-gray-500 mb-1">
                                <i class="fas fa-star mr-1 text-yellow-500"></i>Rekomendasi teratas:
                            </p>
                            <div class="flex flex-wrap gap-2">
                                @foreach($r->hasil->take(3) as $h)
                                    <span class="bg-green-50 text-green-700 text-xs px-2 py-1 rounded-full font-medium">
                                        @if($h->ranking == 1)
                                            <i class="fas fa-medal text-yellow-500"></i>
                                        @elseif($h->ranking == 2)
                                            <i class="fas fa-medal text-gray-400"></i>
                                        @else
                                            <i class="fas fa-medal text-orange-600"></i>
                                        @endif
                                        {{ $h->tanaman->nama_tanaman }}
                                    </span>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </a>
            @empty
                <div class="bg-white rounded-2xl shadow p-10 text-center">
                    <svg class="w-24 h-24 mx-auto text-gray-300 mb-4" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M13 3a9 9 0 0 0-9 9H1l3.89 3.89l.07.14L9 12H6c0-3.87 3.13-7 7-7s7 3.13 7 7-3.13 7-7 7c-1.93 0-3.68-.79-4.94-2.06l-1.42 1.42A8.954 8.954 0 0 0 13 21a9 9 0 0 0 0-18zm-1 5v5l4.28 2.54l.72-1.21l-3.5-2.08V8H12z"/>
                    </svg>
                    <p class="text-gray-500 text-sm font-medium">Belum ada riwayat rekomendasi</p>
                    <p class="text-gray-400 text-xs mt-1">Mulai dengan input kondisi lahan Anda</p>
                    <a href="{{ route('warga.input.form') }}"
                        class="mt-5 inline-flex items-center gap-2 bg-gradient-to-r from-green-600 to-emerald-600 hover:from-green-700 hover:to-emerald-700 text-white text-sm font-semibold px-6 py-2.5 rounded-xl transition shadow-lg">
                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z"/>
                        </svg>
                        Mulai Input Lahan
                    </a>
                </div>
            @endforelse

            {{-- Pagination --}}
            <div class="mt-4">
                {{ $riwayat->links() }}
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    function toggleFilter() {
        const content = document.getElementById('filterContent');
        const arrow = document.getElementById('filterArrow');
        content.classList.toggle('hidden');
        arrow.innerHTML = content.classList.contains('hidden')
            ? '<i class="fas fa-chevron-down"></i>'
            : '<i class="fas fa-chevron-up"></i>';
    }
</script>
@endpush