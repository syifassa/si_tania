@extends('layouts.admin')
@section('title', 'Dashboard Admin')
@section('page-title', 'Dashboard')

@section('main')
    {{-- Stat cards — 2 per row di mobile, 4 di desktop --}}
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-4 lg:gap-6 mb-6 sm:mb-8">
        <div class="bg-white rounded-xl shadow p-4 sm:p-5 border-l-4 border-green-500 hover:shadow-md transition">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs sm:text-sm text-gray-500">Total Tanaman</p>
                    <p class="text-xl sm:text-3xl font-bold text-gray-800 mt-1">{{ $totalTanaman }}</p>
                </div>
                <div class="text-2xl sm:text-4xl text-green-500 opacity-20">
                    <i class="fas fa-clover"></i>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-xl shadow p-4 sm:p-5 border-l-4 border-blue-500 hover:shadow-md transition">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs sm:text-sm text-gray-500">Total Kriteria</p>
                    <p class="text-xl sm:text-3xl font-bold text-gray-800 mt-1">{{ $totalKriteria }}</p>
                </div>
                <div class="text-2xl sm:text-4xl text-blue-500 opacity-20">
                    <i class="fas fa-sliders-h"></i>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-xl shadow p-4 sm:p-5 border-l-4 border-yellow-500 hover:shadow-md transition">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs sm:text-sm text-gray-500">Total Warga</p>
                    <p class="text-xl sm:text-3xl font-bold text-gray-800 mt-1">{{ $totalWarga }}</p>
                </div>
                <div class="text-2xl sm:text-4xl text-yellow-500 opacity-20">
                    <i class="fas fa-users"></i>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-xl shadow p-4 sm:p-5 border-l-4 border-purple-500 hover:shadow-md transition">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs sm:text-sm text-gray-500">Total Input Lahan</p>
                    <p class="text-xl sm:text-3xl font-bold text-gray-800 mt-1">{{ $totalInput }}</p>
                </div>
                <div class="text-2xl sm:text-4xl text-purple-500 opacity-20">
                    <i class="fas fa-database"></i>
                </div>
            </div>
        </div>
    </div>

    {{-- Grafik Tanaman Terpopuler --}}
    <div class="bg-white rounded-xl shadow overflow-hidden mb-6 sm:mb-8">
        <div class="px-4 sm:px-5 py-3 sm:py-4 border-b">
            <h3 class="font-semibold text-gray-700 text-sm sm:text-base">
                <i class="fas fa-chart-pie text-green-600 mr-2"></i>Tanaman Terpopuler
            </h3>
        </div>
        <div class="p-4 sm:p-6">
            @if($tanamanPopuler->isNotEmpty())
                <div class="flex flex-col md:flex-row items-center gap-6">
                    <div class="w-full max-w-[220px] mx-auto md:mx-0">
                        <canvas id="chartTanamanPopuler"></canvas>
                    </div>
                    <div class="w-full md:flex-1 space-y-2">
                        @php
                            $warna = ['bg-green-500', 'bg-blue-500', 'bg-yellow-500', 'bg-purple-500', 'bg-pink-500'];
                            $totalKeseluruhan = $tanamanPopuler->sum('total');
                        @endphp
                        @foreach($tanamanPopuler as $i => $item)
                            <div class="flex items-center gap-2 text-xs sm:text-sm">
                                <span class="w-3 h-3 rounded-full {{ $warna[$i % 5] }} flex-shrink-0"></span>
                                <span class="text-gray-700 truncate flex-1">{{ $item->tanaman->nama_tanaman ?? '-' }}</span>
                                <span class="font-semibold text-gray-800">{{ $item->total }}x</span>
                                <span class="text-gray-400 w-10 text-right">
                                    {{ $totalKeseluruhan > 0 ? round(($item->total / $totalKeseluruhan) * 100) : 0 }}%
                                </span>
                            </div>
                        @endforeach
                    </div>
                </div>
            @else
                <p class="text-center text-gray-400 text-sm py-4">
                    <i class="fas fa-inbox mr-2"></i>Belum ada data rekomendasi
                </p>
            @endif
        </div>
    </div>

    {{-- Input terbaru --}}
    <div class="bg-white rounded-xl shadow overflow-hidden">
        <div class="px-4 sm:px-5 py-3 sm:py-4 border-b flex justify-between items-center gap-2 flex-wrap">
            <h3 class="font-semibold text-gray-700 text-sm sm:text-base">
                <i class="fas fa-clock text-blue-600 mr-2"></i>Input Lahan Terbaru
            </h3>
            <a href="{{ route('admin.data-warga') }}" class="text-xs sm:text-sm text-green-600 hover:underline whitespace-nowrap flex-shrink-0">
                <i class="fas fa-list mr-1"></i>Lihat semua
            </a>
        </div>
        
        {{-- Desktop view --}}
        <div class="hidden md:block overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-gray-50 text-gray-500 text-xs uppercase">
                    <tr>
                        <th class="px-4 py-3 text-left"><i class="fas fa-user-circle mr-2"></i>Warga</th>
                        <th class="px-4 py-3 text-left"><i class="fas fa-calendar-alt mr-2"></i>Tanggal</th>
                        <th class="px-4 py-3 text-left"><i class="fas fa-droplet mr-2"></i>pH Air</th>
                        <th class="px-4 py-3 text-left"><i class="fas fa-thermometer mr-2"></i>Suhu</th>
                        <th class="px-4 py-3 text-left">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($inputTerbaru as $input)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-4 py-3 font-medium text-gray-800">
                                {{ $input->user->name }}
                            </td>
                            <td class="px-4 py-3 text-gray-500">
                                {{ $input->created_at->format('d M Y') }}
                            </td>
                            <td class="px-4 py-3">{{ $input->ph_air }}</td>
                            <td class="px-4 py-3">{{ $input->suhu }} °C</td>
                            <td class="px-4 py-3">
                                <a href="{{ route('admin.data-warga.detail', $input->id) }}"
                                    class="bg-blue-100 text-blue-600 hover:bg-blue-200 px-2 py-1 rounded text-xs font-medium transition">
                                    <i class="fas fa-eye mr-1"></i>Detail
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-4 py-6 text-center text-gray-400 text-sm">
                                <i class="fas fa-inbox mr-2"></i>Belum ada data input
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        {{-- Mobile view (Cards) --}}
        <div class="md:hidden divide-y divide-gray-100">
            @forelse($inputTerbaru as $input)
                <div class="p-4 hover:bg-gray-50 transition">
                    <div class="flex justify-between items-start mb-3">
                        <div>
                            <p class="font-semibold text-gray-800 text-sm">
                                <i class="fas fa-user-circle mr-1 text-blue-600"></i>{{ $input->user->name }}
                            </p>
                            <p class="text-xs text-gray-400 mt-0.5">
                                <i class="fas fa-calendar-alt mr-1"></i>{{ $input->created_at->format('d M Y, H:i') }}
                            </p>
                        </div>
                        <a href="{{ route('admin.data-warga.detail', $input->id) }}"
                            class="bg-blue-100 text-blue-600 hover:bg-blue-200 px-2 py-1 rounded text-xs font-medium transition flex-shrink-0">
                            <i class="fas fa-eye"></i>
                        </a>
                    </div>
                    <div class="grid grid-cols-2 gap-2 text-xs">
                        <div class="bg-gray-50 rounded p-2">
                            <p class="text-gray-500"><i class="fas fa-droplet mr-1"></i>pH</p>
                            <p class="font-semibold text-gray-800">{{ $input->ph_air }}</p>
                        </div>
                        <div class="bg-gray-50 rounded p-2">
                            <p class="text-gray-500"><i class="fas fa-thermometer mr-1"></i>Suhu</p>
                            <p class="font-semibold text-gray-800">{{ $input->suhu }}°C</p>
                        </div>
                    </div>
                </div>
            @empty
                <div class="p-6 text-center text-gray-400">
                    <i class="fas fa-inbox text-3xl mb-2 block"></i>
                    <p class="text-sm">Belum ada data input</p>
                </div>
            @endforelse
        </div>
    </div>
@endsection

@push('scripts')
@if($tanamanPopuler->isNotEmpty())
<script>
document.addEventListener('DOMContentLoaded', function () {
    new Chart(document.getElementById('chartTanamanPopuler'), {
        type: 'doughnut',
        data: {
            labels: {!! json_encode($tanamanPopuler->pluck('tanaman.nama_tanaman')) !!},
            datasets: [{
                data: {!! json_encode($tanamanPopuler->pluck('total')) !!},
                backgroundColor: ['#22c55e', '#3b82f6', '#eab308', '#a855f7', '#ec4899'],
                borderWidth: 0
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            plugins: {
                legend: { display: false }
            },
            cutout: '70%'
        }
    });
});
</script>
@endif
@endpush
