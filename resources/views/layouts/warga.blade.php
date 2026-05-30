@extends('layouts.app')

@section('content')
    <div class="min-h-screen flex flex-col">

        {{-- NAVBAR --}}
        <nav class="bg-green-700 text-white shadow sticky top-0 z-50">
            <div class="max-w-6xl mx-auto px-4">
                <div class="flex justify-between items-center h-16">

                    {{-- Logo --}}
                    <a href="{{ route('warga.beranda') }}" class="flex items-center gap-2 font-bold text-lg">
                        <i class="fas fa-leaf text-2xl text-green-200"></i>
                        {{-- Di desktop tampil teks, di mobile disembunyikan --}}
                        <span class="hidden sm:inline">Sistem Rekomendasi Tanaman</span>
                        <span class="bg-yellow-400 text-green-900 text-[10px] font-extrabold px-1.5 py-0.5 rounded tracking-widest">SITANIA</span>
                    </a>

                    {{-- Menu Desktop --}}
                    <div class="hidden md:flex items-center gap-6 text-sm">
                        <a href="{{ route('warga.beranda') }}" class="flex items-center gap-2 hover:text-green-200 transition {{ request()->routeIs('warga.beranda') ? 'text-white font-semibold border-b-2 border-white pb-0.5' : '' }}">
                            <i class="fas fa-home"></i>Beranda
                        </a>
                        <a href="{{ route('warga.input.form') }}" class="flex items-center gap-2 hover:text-green-200 transition {{ request()->routeIs('warga.input*') ? 'text-white font-semibold border-b-2 border-white pb-0.5' : '' }}">
                            <i class="fas fa-seedling"></i>Input Lahan
                        </a>
                        <a href="{{ route('warga.riwayat') }}" class="flex items-center gap-2 hover:text-green-200 transition {{ request()->routeIs('warga.riwayat*') ? 'text-white font-semibold border-b-2 border-white pb-0.5' : '' }}">
                            <i class="fas fa-history"></i>Riwayat
                        </a>
                        <div class="flex items-center gap-2 ml-2 border-l border-green-500 pl-4">
                            <a href="{{ route('warga.profil') }}" class="text-green-200 text-xs hover:text-white transition flex items-center gap-1">
                                <i class="fas fa-user-circle mr-1"></i>{{ auth()->user()->name }}
                            </a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button class="bg-white text-green-700 px-3 py-1 rounded-full text-xs font-semibold hover:bg-green-100 transition">
                                    <i class="fas fa-sign-out-alt mr-1"></i>Logout
                                </button>
                            </form>
                        </div>
                    </div>

                    {{-- Burger Menu Mobile --}}
                    <button onclick="toggleMobileMenu()" class="md:hidden p-2 rounded-lg hover:bg-green-600 transition" id="burgerBtn">
                        <div class="w-5 h-0.5 bg-white mb-1 transition-all" id="bar1"></div>
                        <div class="w-5 h-0.5 bg-white mb-1 transition-all" id="bar2"></div>
                        <div class="w-5 h-0.5 bg-white transition-all" id="bar3"></div>
                    </button>
                </div>
            </div>

            {{-- Mobile Menu Dropdown --}}
            <div id="mobileMenu" class="md:hidden hidden bg-green-800 px-4 pb-4">
                <div class="pt-2 space-y-1 text-sm">
                    <a href="{{ route('warga.beranda') }}" class="flex items-center gap-2 px-3 py-2.5 rounded-lg hover:bg-green-700 transition {{ request()->routeIs('warga.beranda') ? 'bg-green-700 font-semibold' : '' }}">
                        <i class="fas fa-home"></i>Beranda
                    </a>
                    <a href="{{ route('warga.input.form') }}" class="flex items-center gap-2 px-3 py-2.5 rounded-lg hover:bg-green-700 transition {{ request()->routeIs('warga.input*') ? 'bg-green-700 font-semibold' : '' }}">
                        <i class="fas fa-seedling"></i>Input Lahan
                    </a>
                    <a href="{{ route('warga.riwayat') }}" class="flex items-center gap-2 px-3 py-2.5 rounded-lg hover:bg-green-700 transition {{ request()->routeIs('warga.riwayat*') ? 'bg-green-700 font-semibold' : '' }}">
                            <i class="fas fa-history"></i>Riwayat
                        </a>
                        <a href="{{ route('warga.profil') }}" class="flex items-center gap-2 px-3 py-2.5 rounded-lg hover:bg-green-700 transition {{ request()->routeIs('warga.profil') ? 'bg-green-700 font-semibold' : '' }}">
                            <i class="fas fa-user-cog"></i>Profil
                        </a>
                        <div class="border-t border-green-600 mt-2 pt-2">
                            <p class="text-green-300 text-xs px-3 mb-2">
                            <i class="fas fa-user-circle mr-1"></i>{{ auth()->user()->name }}
                        </p>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button class="w-full text-left flex items-center gap-2 px-3 py-2.5 rounded-lg hover:bg-red-600 transition text-sm">
                                <i class="fas fa-door-open text-red-300"></i>Logout
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </nav>

        {{-- Konten --}}
        <main class="flex-1 max-w-6xl mx-auto px-4 py-6 w-full">
            @if(session('success'))
                <div class="mb-4 bg-gradient-to-r from-green-50 to-emerald-50 border border-green-300 text-green-800 px-4 py-3 rounded-xl text-sm shadow-sm flex items-center gap-2">
                    <svg class="w-5 h-5 text-green-600 flex-shrink-0" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                    </svg>
                    <span>{{ session('success') }}</span>
                </div>
            @endif
            @if(session('error'))
                <div class="mb-4 bg-gradient-to-r from-red-50 to-rose-50 border border-red-300 text-red-800 px-4 py-3 rounded-xl text-sm shadow-sm flex items-center gap-2">
                    <svg class="w-5 h-5 text-red-600 flex-shrink-0" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                    </svg>
                    <span>{{ session('error') }}</span>
                </div>
            @endif
            @yield('main')
        </main>

        <footer class="bg-green-700 text-white text-center py-3 text-xs">
            © {{ date('Y') }} Si Tania — Sistem Rekomendasi Tanaman
        </footer>
    </div>

    <script>
        function toggleMobileMenu() {
            const menu = document.getElementById('mobileMenu');
            const bar1 = document.getElementById('bar1');
            const bar2 = document.getElementById('bar2');
            const bar3 = document.getElementById('bar3');

            menu.classList.toggle('hidden');

            // Animasi burger jadi X
            if (!menu.classList.contains('hidden')) {
                bar1.style.transform = 'translateY(6px) rotate(45deg)';
                bar2.style.opacity = '0';
                bar3.style.transform = 'translateY(-6px) rotate(-45deg)';
            } else {
                bar1.style.transform = '';
                bar2.style.opacity = '1';
                bar3.style.transform = '';
            }
        }

        // Tutup menu saat klik di luar
        document.addEventListener('click', function (e) {
            const menu = document.getElementById('mobileMenu');
            const burger = document.getElementById('burgerBtn');
            if (!menu.contains(e.target) && !burger.contains(e.target)) {
                menu.classList.add('hidden');
                document.getElementById('bar1').style.transform = '';
                document.getElementById('bar2').style.opacity = '1';
                document.getElementById('bar3').style.transform = '';
            }
        });
    </script>
@endsection