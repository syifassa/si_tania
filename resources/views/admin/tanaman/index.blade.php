@extends('layouts.admin')
@section('title', 'Kelola Tanaman')
@section('page-title', 'Data Alternatif Tanaman')

@section('main')
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-1 sm:gap-2 mb-4">
        <a href="{{ route('admin.beranda') }}" class="text-xs sm:text-sm text-green-600 hover:underline inline-flex items-center gap-1">
            <i class="fas fa-arrow-left"></i> Kembali ke Dashboard
        </a>
        <div class="flex items-center gap-2 flex-wrap">
            <p class="text-xs sm:text-sm text-gray-500">
                <i class="fas fa-clover text-green-600 mr-2"></i>Kelola data alternatif tanaman beserta range optimal
            </p>
            <a href="{{ route('admin.tanaman.create') }}" class="bg-green-600 hover:bg-green-700 text-white text-xs sm:text-sm font-semibold px-3 sm:px-4 py-2 rounded-lg flex items-center gap-1 flex-shrink-0">
                <i class="fas fa-plus"></i>Tambah Tanaman
            </a>
        </div>
    </div>

    {{-- Search & Filter --}}
    <form method="GET" class="bg-white rounded-xl shadow-sm border border-gray-100 p-3 sm:p-4 mb-4">
        <div class="flex flex-wrap items-end gap-2">
            <div class="flex-1 min-w-[160px]">
                <label class="text-[10px] uppercase tracking-wider text-gray-400 font-semibold mb-1 block">Search</label>
                <div class="relative">
                    <i class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-gray-300 text-xs"></i>
                    <input type="text" name="search" value="{{ request('search') }}"
                        placeholder="Cari nama tanaman..."
                        class="w-full pl-8 pr-3 py-2 border border-gray-200 rounded-lg text-xs focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500">
                </div>
            </div>
            <div class="min-w-[130px]">
                <label class="text-[10px] uppercase tracking-wider text-gray-400 font-semibold mb-1 block">Status</label>
                <select name="status" onchange="this.form.submit()"
                    class="w-full px-3 py-2 border border-gray-200 rounded-lg text-xs focus:outline-none focus:ring-2 focus:ring-green-500 bg-white">
                    <option value="">Semua Status</option>
                    <option value="aktif" {{ request('status') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                    <option value="nonaktif" {{ request('status') == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                </select>
            </div>
            <div class="min-w-[130px]">
                <label class="text-[10px] uppercase tracking-wider text-gray-400 font-semibold mb-1 block">Metode</label>
                <select name="metode" onchange="this.form.submit()"
                    class="w-full px-3 py-2 border border-gray-200 rounded-lg text-xs focus:outline-none focus:ring-2 focus:ring-green-500 bg-white">
                    <option value="">Semua Metode</option>
                    @foreach($metodeList as $m)
                        <option value="{{ $m }}" {{ request('metode') == $m ? 'selected' : '' }}>{{ $m }}</option>
                    @endforeach
                </select>
            </div>
            <div class="flex items-center gap-1">
                <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg text-xs font-medium transition">
                    <i class="fas fa-search mr-1"></i>
                </button>
                @if(request()->except(['page']))
                    <a href="{{ route('admin.tanaman.index') }}" class="bg-gray-100 hover:bg-gray-200 text-gray-600 px-4 py-2 rounded-lg text-xs font-medium transition">
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
                        <th class="px-4 py-3 text-left"><i class="fas fa-leaf mr-2"></i>Nama Tanaman</th>
                        <th class="px-4 py-3 text-left"><i class="fas fa-sprout mr-2"></i>Metode Budidaya</th>
                        <th class="px-4 py-3 text-left"><i class="fas fa-toggle-on mr-2"></i>Status</th>
                        <th class="px-4 py-3 text-left">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($tanaman as $t)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-4 py-3 font-medium text-gray-800">
                                {{ $t->nama_tanaman }}
                            </td>
                            <td class="px-4 py-3 text-gray-600">
                                {{ $t->metode_budidaya }}
                            </td>
                            <td class="px-4 py-3">
                                <span class="px-2 py-1 rounded-full text-xs font-semibold {{ $t->status == 'aktif' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-600' }}">
                                    <i class="fas {{ $t->status == 'aktif' ? 'fa-check-circle' : 'fa-times-circle' }} mr-1"></i>{{ ucfirst($t->status) }}
                                </span>
                            </td>
                            <td class="px-4 py-3">
                                <div class="flex gap-2">
                                    <a href="{{ route('admin.tanaman.edit', $t->id) }}"
                                        class="bg-blue-100 text-blue-600 hover:bg-blue-200 px-2 py-1 rounded text-xs font-medium transition">
                                        <i class="fas fa-edit mr-1"></i>Edit
                                    </a>
                                    <form method="POST" action="{{ route('admin.tanaman.destroy', $t->id) }}" class="inline" id="delete-form-{{ $t->id }}">
                                        @csrf @method('DELETE')
                                        <button type="button" onclick="showConfirmModal(document.getElementById('delete-form-{{ $t->id }}'))"
                                            class="bg-red-100 text-red-600 hover:bg-red-200 px-2 py-1 rounded text-xs font-medium transition">
                                            <i class="fas fa-trash mr-1"></i>Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-4 py-6 text-center text-gray-400">
                                <i class="fas fa-inbox mr-2"></i>Belum ada data tanaman
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Mobile view --}}
        <div class="md:hidden divide-y divide-gray-100">
            @forelse($tanaman as $t)
                <div class="p-4 hover:bg-gray-50 transition">
                    <div class="flex items-start justify-between mb-3">
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-semibold text-gray-800 truncate">
                                <i class="fas fa-leaf text-green-600 mr-1"></i>{{ $t->nama_tanaman }}
                            </p>
                            <p class="text-xs text-gray-500 mt-1 truncate">
                                <i class="fas fa-sprout mr-1"></i>{{ $t->metode_budidaya }}
                            </p>
                        </div>
                        <span class="text-xs font-semibold ml-2 flex-shrink-0 {{ $t->status == 'aktif' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-600' }} px-2 py-1 rounded">
                            {{ ucfirst($t->status) }}
                        </span>
                    </div>
                    <div class="flex gap-2">
                        <a href="{{ route('admin.tanaman.edit', $t->id) }}"
                            class="flex-1 bg-blue-100 text-blue-600 hover:bg-blue-200 px-2 py-1.5 rounded text-xs font-medium transition text-center">
                            <i class="fas fa-edit mr-1"></i>Edit
                        </a>
                        <form method="POST" action="{{ route('admin.tanaman.destroy', $t->id) }}" class="flex-1" id="delete-form-m-{{ $t->id }}">
                            @csrf @method('DELETE')
                            <button type="button" onclick="showConfirmModal(document.getElementById('delete-form-m-{{ $t->id }}'))"
                                class="w-full bg-red-100 text-red-600 hover:bg-red-200 px-2 py-1.5 rounded text-xs font-medium transition">
                                <i class="fas fa-trash mr-1"></i>Hapus
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="p-6 text-center text-gray-400">
                    <i class="fas fa-inbox text-3xl mb-2 block"></i>
                    <p class="text-sm">Belum ada data tanaman</p>
                </div>
            @endforelse
        </div>
    </div>
@endsection