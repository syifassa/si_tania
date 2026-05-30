@extends('layouts.admin')
@section('title', 'Detail Input Warga')
@section('page-title', 'Detail Input Warga')

@section('main')
    <div class="max-w-5xl mx-auto">

        {{-- Header --}}
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 mb-5">
            <a href="{{ route('admin.data-warga') }}" class="text-xs sm:text-sm text-green-600 hover:underline inline-flex items-center gap-1">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
            <div class="bg-gradient-to-r from-blue-500 to-blue-600 text-white px-4 py-2 rounded-lg text-xs sm:text-sm font-semibold inline-flex items-center gap-2 shadow-sm">
                <i class="fas fa-info-circle"></i>
                Input #{{ $riwayat->urutan }} &mdash; {{ $riwayat->user->name }}
                <span class="bg-white/20 px-2 py-0.5 rounded text-white/90">{{ $riwayat->created_at->format('d M Y') }}</span>
            </div>
        </div>

        {{-- Identitas Warga --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5 mb-5">
            <h3 class="font-bold text-gray-800 mb-4 text-sm sm:text-base flex items-center gap-2">
                <i class="fas fa-user-circle text-blue-600"></i>Identitas Warga
            </h3>
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div class="bg-gray-50 rounded-lg p-4">
                    <p class="text-gray-400 text-xs uppercase tracking-wider mb-1"><i class="fas fa-user mr-1"></i>Nama</p>
                    <p class="font-semibold text-gray-800 text-sm">{{ $riwayat->user->name }}</p>
                </div>
                <div class="bg-gray-50 rounded-lg p-4">
                    <p class="text-gray-400 text-xs uppercase tracking-wider mb-1"><i class="fas fa-envelope mr-1"></i>Email</p>
                    <p class="font-semibold text-gray-800 text-sm truncate">{{ $riwayat->user->email }}</p>
                </div>
                <div class="bg-gray-50 rounded-lg p-4">
                    <p class="text-gray-400 text-xs uppercase tracking-wider mb-1"><i class="fas fa-calendar-alt mr-1"></i>Tanggal Input</p>
                    <p class="font-semibold text-gray-800 text-sm">{{ $riwayat->created_at->format('d M Y, H:i') }}</p>
                </div>
            </div>
        </div>

        {{-- Data Kondisi Lahan --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5 mb-5">
            <h3 class="font-bold text-gray-800 mb-4 text-sm sm:text-base flex items-center gap-2">
                <i class="fas fa-leaf text-green-600"></i>Data Kondisi Lahan
            </h3>
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3">
                <div class="bg-gradient-to-br from-green-50 to-green-100/50 rounded-xl p-4 border border-green-200">
                    <p class="text-green-600 text-xs font-semibold mb-1.5 flex items-center gap-1">
                        <i class="fas fa-layer-group"></i><span class="bg-green-200 text-green-800 px-1.5 py-0.5 rounded text-[10px] font-bold">K1</span> Jenis Tanah
                    </p>
                    <p class="text-lg font-bold text-gray-800 capitalize">{{ $riwayat->jenis_tanah }}</p>
                </div>
                <div class="bg-gradient-to-br from-blue-50 to-blue-100/50 rounded-xl p-4 border border-blue-200">
                    <p class="text-blue-600 text-xs font-semibold mb-1.5 flex items-center gap-1">
                        <i class="fas fa-droplet"></i><span class="bg-blue-200 text-blue-800 px-1.5 py-0.5 rounded text-[10px] font-bold">K2</span> pH Air
                    </p>
                    <p class="text-lg font-bold text-gray-800">{{ $riwayat->ph_air }}</p>
                </div>
                <div class="bg-gradient-to-br from-red-50 to-red-100/50 rounded-xl p-4 border border-red-200">
                    <p class="text-red-600 text-xs font-semibold mb-1.5 flex items-center gap-1">
                        <i class="fas fa-thermometer-full"></i><span class="bg-red-200 text-red-800 px-1.5 py-0.5 rounded text-[10px] font-bold">K3</span> Suhu
                    </p>
                    <p class="text-lg font-bold text-gray-800">{{ $riwayat->suhu }}<span class="text-sm font-medium text-gray-500">°C</span></p>
                </div>
                <div class="bg-gradient-to-br from-cyan-50 to-cyan-100/50 rounded-xl p-4 border border-cyan-200">
                    <p class="text-cyan-600 text-xs font-semibold mb-1.5 flex items-center gap-1">
                        <i class="fas fa-water"></i><span class="bg-cyan-200 text-cyan-800 px-1.5 py-0.5 rounded text-[10px] font-bold">K4</span> Kelembapan
                    </p>
                    <p class="text-lg font-bold text-gray-800">{{ $riwayat->kelembapan }}<span class="text-sm font-medium text-gray-500">%</span></p>
                </div>
                <div class="bg-gradient-to-br from-yellow-50 to-yellow-100/50 rounded-xl p-4 border border-yellow-200">
                    <p class="text-yellow-600 text-xs font-semibold mb-1.5 flex items-center gap-1">
                        <i class="fas fa-sun"></i><span class="bg-yellow-200 text-yellow-800 px-1.5 py-0.5 rounded text-[10px] font-bold">K5</span> Intensitas Cahaya
                    </p>
                    <p class="text-lg font-bold text-gray-800">{{ $riwayat->cahaya }}<span class="text-sm font-medium text-gray-500"> jam/hari</span></p>
                </div>
                <div class="bg-gradient-to-br from-indigo-50 to-indigo-100/50 rounded-xl p-4 border border-indigo-200">
                    <p class="text-indigo-600 text-xs font-semibold mb-1.5 flex items-center gap-1">
                        <i class="fas fa-cloud-rain"></i><span class="bg-indigo-200 text-indigo-800 px-1.5 py-0.5 rounded text-[10px] font-bold">K6</span> Curah Hujan
                    </p>
                    <p class="text-lg font-bold text-gray-800">{{ $riwayat->curah_hujan }}<span class="text-sm font-medium text-gray-500">mm/thn</span></p>
                </div>
                <div class="bg-gradient-to-br from-purple-50 to-purple-100/50 rounded-xl p-4 border border-purple-200">
                    <p class="text-purple-600 text-xs font-semibold mb-1.5 flex items-center gap-1">
                        <i class="fas fa-ruler"></i><span class="bg-purple-200 text-purple-800 px-1.5 py-0.5 rounded text-[10px] font-bold">K7</span> Luas Lahan
                    </p>
                    <p class="text-lg font-bold text-gray-800">{{ $riwayat->luas_lahan }}<span class="text-sm font-medium text-gray-500">m²</span></p>
                </div>
            </div>
        </div>

        {{-- Hasil Rekomendasi --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="px-5 py-4 border-b bg-gray-50 flex items-center justify-between">
                <h3 class="font-bold text-gray-800 text-sm sm:text-base flex items-center gap-2">
                    <i class="fas fa-seedling text-green-600"></i>Hasil Rekomendasi
                </h3>
                <span class="text-xs text-gray-400">{{ count($hasil) }} tanaman</span>
            </div>

            {{-- Desktop --}}
            <div class="hidden md:block overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-gray-50 text-gray-500 text-xs uppercase">
                        <tr>
                            <th class="px-5 py-3 text-left">Ranking</th>
                            <th class="px-5 py-3 text-left">Tanaman</th>
                            <th class="px-5 py-3 text-left">Skor (%)</th>
                            <th class="px-5 py-3 text-left">Metode Budidaya</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach($hasil as $h)
                            <tr class="hover:bg-gray-50 transition {{ $h->ranking == 1 ? 'bg-green-50/50' : '' }}">
                                <td class="px-5 py-4">
                                    @if($h->ranking == 1)
                                        <span class="inline-flex items-center gap-1 bg-yellow-100 text-yellow-700 px-2.5 py-1 rounded-full text-xs font-bold"><i class="fas fa-crown"></i> #1</span>
                                    @elseif($h->ranking == 2)
                                        <span class="inline-flex items-center gap-1 bg-gray-100 text-gray-600 px-2.5 py-1 rounded-full text-xs font-bold"><i class="fas fa-medal"></i> #2</span>
                                    @elseif($h->ranking == 3)
                                        <span class="inline-flex items-center gap-1 bg-orange-100 text-orange-700 px-2.5 py-1 rounded-full text-xs font-bold"><i class="fas fa-medal"></i> #3</span>
                                    @else
                                        <span class="bg-gray-100 text-gray-500 px-2.5 py-1 rounded-full text-xs font-semibold">#{{ $h->ranking }}</span>
                                    @endif
                                </td>
                                <td class="px-5 py-4 font-semibold text-gray-800">
                                    <i class="fas fa-leaf text-green-500 mr-1.5"></i>{{ $h->tanaman->nama_tanaman }}
                                </td>
                                <td class="px-5 py-4">
                                    <div class="flex items-center gap-2.5">
                                        <div class="w-24 bg-gray-200 rounded-full h-2">
                                            <div class="bg-green-500 h-2 rounded-full" style="width: {{ min($h->nilai_vi * 100, 100) }}%"></div>
                                        </div>
                                        <span class="font-bold text-green-600 text-sm">{{ number_format($h->nilai_vi * 100, 2) }}%</span>
                                    </div>
                                </td>
                                <td class="px-5 py-4">
                                    <span class="bg-blue-50 text-blue-700 text-xs px-2.5 py-1 rounded-full font-medium">
                                        <i class="fas fa-sprout mr-1"></i>{{ $h->metode_budidaya }}
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- Mobile --}}
            <div class="md:hidden divide-y divide-gray-100">
                @foreach($hasil as $h)
                    <div class="p-4 {{ $h->ranking == 1 ? 'bg-green-50/50' : '' }}">
                        <div class="flex items-center gap-3 mb-3">
                            @if($h->ranking == 1)
                                <span class="bg-yellow-100 text-yellow-700 px-2 py-1 rounded-full text-xs font-bold"><i class="fas fa-crown"></i> #1</span>
                            @elseif($h->ranking == 2)
                                <span class="bg-gray-100 text-gray-600 px-2 py-1 rounded-full text-xs font-bold"><i class="fas fa-medal"></i> #2</span>
                            @elseif($h->ranking == 3)
                                <span class="bg-orange-100 text-orange-700 px-2 py-1 rounded-full text-xs font-bold"><i class="fas fa-medal"></i> #3</span>
                            @else
                                <span class="bg-gray-100 text-gray-500 px-2 py-1 rounded-full text-xs font-semibold">#{{ $h->ranking }}</span>
                            @endif
                            <p class="text-sm font-bold text-gray-800"><i class="fas fa-leaf text-green-500 mr-1"></i>{{ $h->tanaman->nama_tanaman }}</p>
                        </div>
                        <div class="flex items-center justify-between gap-3">
                            <div class="flex-1">
                                    <div class="w-full bg-gray-200 rounded-full h-2">
                                        <div class="bg-green-500 h-2 rounded-full" style="width: {{ min($h->nilai_vi * 100, 100) }}%"></div>
                                    </div>
                                <p class="text-xs text-gray-500 mt-1"><i class="fas fa-chart-line mr-1"></i>Skor: <span class="font-bold text-green-600">{{ number_format($h->nilai_vi * 100, 2) }}%</span></p>
                            </div>
                            <span class="bg-blue-50 text-blue-700 text-xs px-2 py-1 rounded-full font-medium whitespace-nowrap">
                                <i class="fas fa-sprout mr-1"></i>{{ $h->metode_budidaya }}
                            </span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
