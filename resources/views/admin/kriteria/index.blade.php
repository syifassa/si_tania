@extends('layouts.admin')
@section('title', 'Kelola Kriteria')
@section('page-title', 'Kriteria & Bobot')

@section('main')
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-2 mb-4">
        <a href="{{ route('admin.beranda') }}" class="text-xs sm:text-sm text-green-600 hover:underline inline-flex items-center gap-1">
            <i class="fas fa-arrow-left"></i> Kembali ke Dashboard
        </a>
        <div class="flex items-center gap-2 flex-wrap">
            <p class="text-xs sm:text-sm text-gray-500">
                <i class="fas fa-sliders-h text-yellow-600 mr-2"></i>Kelola kriteria dan bobot penilaian AHP-TOPSIS
            </p>
            <a href="{{ route('admin.kriteria.create') }}" class="bg-green-600 hover:bg-green-700 text-white text-xs sm:text-sm font-semibold px-3 sm:px-4 py-2 rounded-lg flex items-center gap-1 flex-shrink-0">
                <i class="fas fa-plus"></i>Tambah Kriteria
            </a>
        </div>
    </div>

    {{-- Search --}}
    <form method="GET" class="bg-white rounded-xl shadow-sm border border-gray-100 p-3 sm:p-4 mb-4">
        <div class="flex flex-wrap items-end gap-2">
            <div class="flex-1 min-w-[180px]">
                <label class="text-[10px] uppercase tracking-wider text-gray-400 font-semibold mb-1 block">Search</label>
                <div class="relative">
                    <i class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-gray-300 text-xs"></i>
                    <input type="text" name="search" value="{{ request('search') }}"
                        placeholder="Cari kode atau nama kriteria..."
                        class="w-full pl-8 pr-3 py-2 border border-gray-200 rounded-lg text-xs focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500">
                </div>
            </div>
            <div class="flex items-center gap-1">
                <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg text-xs font-medium transition">
                    <i class="fas fa-search mr-1"></i>Cari
                </button>
                @if(request('search'))
                    <a href="{{ route('admin.kriteria.index') }}" class="bg-gray-100 hover:bg-gray-200 text-gray-600 px-4 py-2 rounded-lg text-xs font-medium transition">
                        <i class="fas fa-times mr-1"></i>Reset
                    </a>
                @endif
            </div>
        </div>
    </form>

    <div class="bg-white rounded-xl shadow overflow-hidden">
        {{-- Desktop view --}}
        <div class="hidden md:block overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-gray-50 text-gray-500 text-xs uppercase">
                    <tr>
                        <th class="px-4 py-3 text-left"><i class="fas fa-code mr-2"></i>Kode</th>
                        <th class="px-4 py-3 text-left"><i class="fas fa-filter mr-2"></i>Nama Kriteria</th>
                        <th class="px-4 py-3 text-left"><i class="fas fa-percentage mr-2"></i>Bobot</th>
                        <th class="px-4 py-3 text-left"><i class="fas fa-arrows-alt-v mr-2"></i>Tipe</th>
                        <th class="px-4 py-3 text-left">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($kriteria as $k)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-4 py-3">
                                <span class="bg-green-100 text-green-700 px-2 py-0.5 rounded text-xs font-semibold">
                                    {{ $k->kode }}
                                </span>
                            </td>
                            <td class="px-4 py-3 font-medium text-gray-800">
                                {{ $k->nama_kriteria }}
                            </td>
                            <td class="px-4 py-3">
                                <div class="flex items-center gap-2">
                                    <div class="w-20 bg-gray-200 rounded-full h-1.5">
                                        <div class="bg-green-500 h-1.5 rounded-full" style="width: {{ $k->bobot * 100 }}%"></div>
                                    </div>
                                    <span class="text-sm font-semibold">{{ number_format($k->bobot * 100, 1) }}%</span>
                                </div>
                            </td>
                            <td class="px-4 py-3">
                                @if($k->tipe == 'benefit')
                                    <span class="bg-blue-100 text-blue-700 px-2 py-0.5 rounded text-xs font-semibold">
                                        <i class="fas fa-arrow-up mr-0.5"></i>Benefit
                                    </span>
                                @else
                                    <span class="bg-red-100 text-red-700 px-2 py-0.5 rounded text-xs font-semibold">
                                        <i class="fas fa-arrow-down mr-0.5"></i>Cost
                                    </span>
                                @endif
                            </td>
                            <td class="px-4 py-3">
                                <div class="flex gap-2">
                                    <a href="{{ route('admin.kriteria.edit', ['kriteria' => $k->id]) }}"
                                        class="bg-blue-100 text-blue-600 hover:bg-blue-200 px-2 py-1 rounded text-xs font-medium transition">
                                        <i class="fas fa-edit mr-1"></i>Edit
                                    </a>
                                    <form method="POST" action="{{ route('admin.kriteria.destroy', ['kriteria' => $k->id]) }}" class="inline" id="delete-form-{{ $k->id }}">
                                        @csrf @method('DELETE')
                                        <button type="button" onclick="showConfirmModal(document.getElementById('delete-form-{{ $k->id }}'))"
                                            class="bg-red-100 text-red-600 hover:bg-red-200 px-2 py-1 rounded text-xs font-medium transition">
                                            <i class="fas fa-trash mr-1"></i>Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-4 py-6 text-center text-gray-400">
                                <i class="fas fa-inbox mr-2"></i>Belum ada data kriteria
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Mobile view --}}
        <div class="md:hidden divide-y divide-gray-100">
            @forelse($kriteria as $k)
                <div class="p-4 hover:bg-gray-50 transition">
                    <div class="flex items-start justify-between mb-3">
                        <div>
                            <span class="bg-green-100 text-green-700 px-2 py-1 rounded text-xs font-bold">
                                {{ $k->kode }}
                            </span>
                            <p class="text-sm font-semibold text-gray-800 mt-1">
                                {{ $k->nama_kriteria }}
                            </p>
                            <span class="text-xs mt-1 inline-block">
                                @if($k->tipe == 'benefit')
                                    <span class="bg-blue-100 text-blue-700 px-2 py-0.5 rounded font-semibold">
                                        <i class="fas fa-arrow-up mr-0.5"></i>Benefit
                                    </span>
                                @else
                                    <span class="bg-red-100 text-red-700 px-2 py-0.5 rounded font-semibold">
                                        <i class="fas fa-arrow-down mr-0.5"></i>Cost
                                    </span>
                                @endif
                            </span>
                        </div>
                        <span class="text-lg font-bold text-green-600 flex-shrink-0">
                            {{ number_format($k->bobot * 100, 1) }}%
                        </span>
                    </div>
                    <div class="bg-gray-100 rounded-full h-2 mb-3">
                        <div class="bg-green-500 h-2 rounded-full" style="width: {{ $k->bobot * 100 }}%"></div>
                    </div>
                    <div class="flex gap-2 flex-wrap">
                        <a href="{{ route('admin.kriteria.edit', ['kriteria' => $k->id]) }}"
                            class="flex-1 bg-blue-100 text-blue-600 hover:bg-blue-200 px-2 py-1.5 rounded text-xs font-medium transition text-center">
                            <i class="fas fa-edit mr-1"></i>Edit
                        </a>
                        <form method="POST" action="{{ route('admin.kriteria.destroy', ['kriteria' => $k->id]) }}" class="flex-1" id="delete-form-m-{{ $k->id }}">
                            @csrf @method('DELETE')
                            <button type="button" onclick="showConfirmModal(document.getElementById('delete-form-m-{{ $k->id }}'))"
                                class="w-full bg-red-100 text-red-600 hover:bg-red-200 px-2 py-1.5 rounded text-xs font-medium transition">
                                <i class="fas fa-trash mr-1"></i>Hapus
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="p-6 text-center text-gray-400">
                    <i class="fas fa-inbox text-3xl mb-2 block"></i>
                    <p class="text-sm">Belum ada data kriteria</p>
                </div>
            @endforelse
        </div>
    </div>

    {{-- Total bobot --}}
    <div class="mt-4 bg-yellow-50 border border-yellow-200 rounded-lg px-3 sm:px-4 py-2 sm:py-3 text-xs sm:text-sm text-yellow-800">
        <i class="fas fa-info-circle mr-2"></i>Total bobot saat ini:
        <strong>{{ number_format($kriteria->sum('bobot') * 100, 1) }}%</strong>
        @if(round($kriteria->sum('bobot'), 2) != 1.00)
            — <i class="fas fa-exclamation-triangle text-orange-500 mr-1"></i>Total bobot harus = 100%
        @else
            — <i class="fas fa-check-circle text-green-600 mr-1"></i>Valid
        @endif
    </div>
@endsection