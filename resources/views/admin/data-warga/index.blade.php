@extends('layouts.admin')
@section('title', 'Data Input Warga')
@section('page-title', 'Data Input Warga')

@section('main')
    {{-- Back --}}
    <div class="mb-4">
        <a href="{{ route('admin.beranda') }}" class="text-xs sm:text-sm text-green-600 hover:underline inline-flex items-center gap-1">
            <i class="fas fa-arrow-left"></i> Kembali ke Dashboard
        </a>
    </div>

    {{-- Filters --}}
    <form method="GET" class="bg-white rounded-xl shadow-sm border border-gray-100 p-3 sm:p-4 mb-4">
        <div class="flex flex-wrap items-end gap-2">
            <div class="flex-1 min-w-[140px]">
                <label class="text-[10px] uppercase tracking-wider text-gray-400 font-semibold mb-1 block">Search</label>
                <div class="relative">
                    <i class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-gray-300 text-xs"></i>
                    <input type="text" name="search" value="{{ request('search') }}"
                        placeholder="Search data..."
                        class="w-full pl-8 pr-3 py-2 border border-gray-200 rounded-lg text-xs focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500">
                </div>
            </div>
            <div class="min-w-[130px]">
                <label class="text-[10px] uppercase tracking-wider text-gray-400 font-semibold mb-1 block">Jenis Tanah</label>
                <select name="jenis_tanah" onchange="this.form.submit()"
                    class="w-full px-3 py-2 border border-gray-200 rounded-lg text-xs focus:outline-none focus:ring-2 focus:ring-green-500 bg-white">
                    <option value="">Semua Tanah</option>
                    @foreach($jenisTanahList as $j)
                        <option value="{{ $j }}" {{ request('jenis_tanah') == $j ? 'selected' : '' }}>{{ ucfirst($j) }}</option>
                    @endforeach
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
            <div class="min-w-[130px]">
                <label class="text-[10px] uppercase tracking-wider text-gray-400 font-semibold mb-1 block">Tanggal</label>
                <select name="tanggal" onchange="this.form.submit()"
                    class="w-full px-3 py-2 border border-gray-200 rounded-lg text-xs focus:outline-none focus:ring-2 focus:ring-green-500 bg-white">
                    <option value="">Semua Waktu</option>
                    <option value="hari_ini" {{ request('tanggal') == 'hari_ini' ? 'selected' : '' }}>Hari Ini</option>
                    <option value="7_hari" {{ request('tanggal') == '7_hari' ? 'selected' : '' }}>7 Hari Terakhir</option>
                    <option value="30_hari" {{ request('tanggal') == '30_hari' ? 'selected' : '' }}>30 Hari Terakhir</option>
                </select>
            </div>
            <div class="flex items-center gap-1 min-w-[100px]">
                <div class="flex items-center gap-1 bg-gray-100 rounded-lg p-0.5 text-xs mt-5">
                    <a href="{{ route('admin.data-warga', array_merge(request()->except(['sort', 'page']), ['sort' => 'terbaru'])) }}"
                        class="px-2.5 py-1.5 rounded-md font-medium transition {{ request('sort', 'terbaru') == 'terbaru' ? 'bg-white shadow text-green-700' : 'text-gray-500 hover:text-gray-700' }}">
                        <i class="fas fa-clock"></i>
                    </a>
                    <a href="{{ route('admin.data-warga', array_merge(request()->except(['sort', 'page']), ['sort' => 'terlama'])) }}"
                        class="px-2.5 py-1.5 rounded-md font-medium transition {{ request('sort') == 'terlama' ? 'bg-white shadow text-green-700' : 'text-gray-500 hover:text-gray-700' }}">
                        <i class="fas fa-history"></i>
                    </a>
                </div>
                @if(request()->except(['page']))
                    <a href="{{ route('admin.data-warga') }}" class="text-gray-400 hover:text-red-500 transition mt-5 px-2" title="Reset filter">
                        <i class="fas fa-times"></i>
                    </a>
                @endif
            </div>
        </div>
    </form>

    <div class="bg-white rounded-xl shadow overflow-hidden">
        {{-- Desktop view --}}
        <div class="hidden md:block overflow-x-auto">
            <table class="w-full text-sm whitespace-nowrap">
                <thead class="bg-gray-50 text-gray-500 text-xs uppercase">
                    <tr>
                        <th class="px-4 py-3 text-left"><i class="fas fa-user-circle mr-2"></i>Warga</th>
                        <th class="px-4 py-3 text-left"><i class="fas fa-calendar-alt mr-2"></i>Tanggal</th>
                        <th class="px-4 py-3 text-left"><i class="fas fa-layer-group mr-2"></i>Jenis Tanah</th>
                        <th class="px-4 py-3 text-left"><i class="fas fa-droplet mr-2"></i>pH Air</th>
                        <th class="px-4 py-3 text-left"><i class="fas fa-thermometer mr-2"></i>Suhu</th>
                        <th class="px-4 py-3 text-left"><i class="fas fa-water mr-2"></i>Kelembapan</th>
                        <th class="px-4 py-3 text-left"><i class="fas fa-sun mr-2"></i>Cahaya</th>
                        <th class="px-4 py-3 text-left"><i class="fas fa-cloud-rain mr-2"></i>Curah Hujan</th>
                        <th class="px-4 py-3 text-left"><i class="fas fa-ruler mr-2"></i>Luas Lahan</th>
                        <th class="px-4 py-3 text-left">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($data as $d)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-4 py-3 font-medium text-gray-800">
                                {{ $d->user->name }}
                            </td>
                            <td class="px-4 py-3 text-gray-500 text-xs">
                                {{ $d->created_at->format('d M Y, H:i') }}
                            </td>
                            <td class="px-4 py-3 capitalize text-gray-700">
                                {{ $d->jenis_tanah }}
                            </td>
                            <td class="px-4 py-3">{{ $d->ph_air }}</td>
                            <td class="px-4 py-3">{{ $d->suhu }} °C</td>
                            <td class="px-4 py-3">{{ $d->kelembapan }} %</td>
                            <td class="px-4 py-3">{{ $d->cahaya }} jam/hari</td>
                            <td class="px-4 py-3">{{ $d->curah_hujan }} mm</td>
                            <td class="px-4 py-3">{{ $d->luas_lahan }} m²</td>
                            <td class="px-4 py-3">
                                <a href="{{ route('admin.data-warga.detail', $d->id) }}"
                                    class="bg-blue-100 text-blue-600 hover:bg-blue-200 px-2 py-1 rounded text-xs font-medium transition">
                                    <i class="fas fa-eye mr-1"></i>Detail
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="10" class="px-4 py-6 text-center text-gray-400">
                                <i class="fas fa-inbox mr-2"></i>Belum ada data input dari warga
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Mobile view --}}
        <div class="md:hidden divide-y divide-gray-100">
            @forelse($data as $d)
                <div class="p-4 hover:bg-gray-50 transition">
                    <div class="flex items-start justify-between mb-3">
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-semibold text-gray-800 truncate">
                                <i class="fas fa-user-circle text-blue-600 mr-1"></i>{{ $d->user->name }}
                            </p>
                            <p class="text-xs text-gray-500 mt-0.5">
                                <i class="fas fa-calendar-alt mr-1"></i>{{ $d->created_at->format('d M Y, H:i') }}
                            </p>
                        </div>
                        <a href="{{ route('admin.data-warga.detail', $d->id) }}"
                            class="bg-blue-100 text-blue-600 hover:bg-blue-200 px-2 py-1 rounded text-xs font-medium transition ml-2 flex-shrink-0">
                            <i class="fas fa-eye"></i>
                        </a>
                    </div>
                    <div class="grid grid-cols-2 gap-2 text-xs">
                        <div class="bg-gray-50 rounded p-2">
                            <p class="text-gray-500 mb-0.5"><i class="fas fa-layer-group mr-1"></i>Tanah</p>
                            <p class="font-semibold text-gray-800 truncate capitalize">{{ $d->jenis_tanah }}</p>
                        </div>
                        <div class="bg-gray-50 rounded p-2">
                            <p class="text-gray-500 mb-0.5"><i class="fas fa-droplet mr-1"></i>pH</p>
                            <p class="font-semibold text-gray-800">{{ $d->ph_air }}</p>
                        </div>
                        <div class="bg-gray-50 rounded p-2">
                            <p class="text-gray-500 mb-0.5"><i class="fas fa-thermometer mr-1"></i>Suhu</p>
                            <p class="font-semibold text-gray-800">{{ $d->suhu }}°C</p>
                        </div>
                        <div class="bg-gray-50 rounded p-2">
                            <p class="text-gray-500 mb-0.5"><i class="fas fa-water mr-1"></i>Kelembapan</p>
                            <p class="font-semibold text-gray-800">{{ $d->kelembapan }}%</p>
                        </div>
                        <div class="bg-gray-50 rounded p-2">
                            <p class="text-gray-500 mb-0.5"><i class="fas fa-sun mr-1"></i>Cahaya</p>
                            <p class="font-semibold text-gray-800">{{ $d->cahaya }} jam/hari</p>
                        </div>
                        <div class="bg-gray-50 rounded p-2">
                            <p class="text-gray-500 mb-0.5"><i class="fas fa-cloud-rain mr-1"></i>Curah Hujan</p>
                            <p class="font-semibold text-gray-800">{{ $d->curah_hujan }} mm</p>
                        </div>
                        <div class="col-span-2 bg-gray-50 rounded p-2">
                            <p class="text-gray-500 mb-0.5"><i class="fas fa-ruler mr-1"></i>Luas Lahan</p>
                            <p class="font-semibold text-gray-800">{{ $d->luas_lahan }} m²</p>
                        </div>
                    </div>
                </div>
            @empty
                <div class="p-6 text-center text-gray-400">
                    <i class="fas fa-inbox text-3xl mb-2 block"></i>
                    <p class="text-sm">Belum ada data input dari warga</p>
                </div>
            @endforelse
        </div>

        {{-- Pagination --}}
        <div class="px-4 py-3 border-t bg-gray-50">
            {{ $data->appends(request()->query())->links() }}
        </div>
    </div>
@endsection