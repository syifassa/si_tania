@extends('layouts.app')

@section('content')
    <div class="min-h-screen flex flex-col">

        {{-- TOPBAR ADMIN (sticky, minimalis) --}}
        <header class="bg-gray-900 text-white sticky top-0 z-50 shadow-lg">
            <div class="flex items-center justify-between px-3 sm:px-4 h-14 sm:h-16">

                {{-- Burger + Brand --}}
                <div class="flex items-center gap-2 sm:gap-3 min-w-0">
                    <button onclick="toggleSidebar()" id="sidebarBurger" class="lg:hidden p-2 rounded-lg hover:bg-gray-700 transition flex-shrink-0">
                        <div class="w-5 h-0.5 bg-white mb-1 transition-all" id="sb1"></div>
                        <div class="w-5 h-0.5 bg-white mb-1 transition-all" id="sb2"></div>
                        <div class="w-5 h-0.5 bg-white transition-all" id="sb3"></div>
                    </button>
                    <a href="{{ route('admin.beranda') }}" class="flex items-center gap-2 font-bold text-sm sm:text-base min-w-0">
                        <i class="fas fa-leaf text-lg sm:text-xl text-green-400 flex-shrink-0"></i>
                        <span class="truncate tracking-wide">Si Tania</span>
                    </a>
                </div>

            </div>
        </header>

        <div class="flex flex-1 h-[calc(100vh-4rem)]">

            {{-- OVERLAY (mobile) --}}
            <div id="sidebarOverlay" onclick="toggleSidebar()" class="fixed inset-0 bg-black bg-opacity-50 z-40 
                        hidden lg:hidden">
            </div>

            {{-- SIDEBAR --}}
            <aside id="sidebar" class="fixed top-16 left-0 h-[calc(100vh-4rem)] w-64 bg-gray-800 text-white z-40 transform -translate-x-full lg:translate-x-0 transition-transform duration-300 ease-in-out flex flex-col overflow-y-hidden">

                <nav class="flex-1 px-3 py-4 space-y-1 text-sm">
                    <a href="{{ route('admin.beranda') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg hover:bg-gray-700 hover:border-l-4 hover:border-blue-400 hover:pl-2 transition-all {{ request()->routeIs('admin.beranda') ? 'bg-gray-700 font-semibold border-l-4 border-blue-400 pl-2' : 'border-l-4 border-transparent pl-3' }}">
                        <i class="fas fa-chart-line text-blue-400 w-5"></i>
                        <span class="truncate">Dashboard</span>
                    </a>
                    <a href="{{ route('admin.kriteria.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg hover:bg-gray-700 hover:border-l-4 hover:border-yellow-400 hover:pl-2 transition-all {{ request()->routeIs('admin.kriteria*') ? 'bg-gray-700 font-semibold border-l-4 border-yellow-400 pl-2' : 'border-l-4 border-transparent pl-3' }}">
                        <i class="fas fa-sliders-h text-yellow-400 w-5"></i>
                        <span class="truncate">Kriteria & Bobot</span>
                    </a>
                    <a href="{{ route('admin.tanaman.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg hover:bg-gray-700 hover:border-l-4 hover:border-green-400 hover:pl-2 transition-all {{ request()->routeIs('admin.tanaman*') ? 'bg-gray-700 font-semibold border-l-4 border-green-400 pl-2' : 'border-l-4 border-transparent pl-3' }}">
                        <i class="fas fa-clover text-green-400 w-5"></i>
                        <span class="truncate">Data Tanaman</span>
                    </a>
                    <a href="{{ route('admin.data-warga') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg hover:bg-gray-700 hover:border-l-4 hover:border-purple-400 hover:pl-2 transition-all {{ request()->routeIs('admin.data-warga*') ? 'bg-gray-700 font-semibold border-l-4 border-purple-400 pl-2' : 'border-l-4 border-transparent pl-3' }}">
                        <i class="fas fa-users text-purple-400 w-5"></i>
                        <span class="truncate">Data Input Warga</span>
                    </a>
                    <div class="border-t border-gray-700 my-3"></div>
                    <a href="{{ route('admin.profil') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg hover:bg-gray-700 hover:border-l-4 hover:border-indigo-400 hover:pl-2 transition-all {{ request()->routeIs('admin.profil') ? 'bg-gray-700 font-semibold border-l-4 border-indigo-400 pl-2' : 'border-l-4 border-transparent pl-3' }}">
                        <i class="fas fa-user-cog text-indigo-400 w-5"></i>
                        <span class="truncate">Profil</span>
                    </a>
                </nav>

                {{-- Logout + Copyright --}}
                <div class="px-3 py-3 border-t border-gray-700 space-y-2">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            class="w-full flex items-center gap-3 px-3 py-2.5 rounded-lg text-red-400 hover:bg-gray-700 hover:text-red-300 transition text-sm">
                            <i class="fas fa-sign-out-alt w-5"></i>
                            <span class="truncate">Logout</span>
                        </button>
                    </form>
                    <div class="text-xs text-gray-500 text-center">
                        Si Tania © {{ date('Y') }}
                    </div>
                </div>
            </aside>

            {{-- KONTEN UTAMA --}}
            <div class="flex-1 flex flex-col min-w-0 overflow-auto lg:ml-64">
                <div class="px-3 sm:px-4 py-3 bg-white border-b">
                    <h1 class="text-sm sm:text-base font-semibold text-gray-700">
                        @yield('page-title', 'Dashboard')
                    </h1>
                </div>
                <main class="flex-1 p-3 sm:p-6 bg-gray-50 overflow-auto">
                    @if(session('success'))
                        <div class="mb-4 bg-green-100 border border-green-400 text-green-800 px-4 py-3 rounded-lg text-xs sm:text-sm">
                            <i class="fas fa-check-circle mr-2"></i>{{ session('success') }}
                        </div>
                    @endif
                    @if(session('error'))
                        <div class="mb-4 bg-red-100 border border-red-400 text-red-800 px-4 py-3 rounded-lg text-xs sm:text-sm">
                            <i class="fas fa-exclamation-circle mr-2"></i>{{ session('error') }}
                        </div>
                    @endif
                    @yield('main')
                </main>
            </div>
        </div>
    </div>

    {{-- Confirm Modal --}}
    <div id="confirmModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black bg-opacity-50 px-4">
        <div class="bg-white rounded-xl shadow-xl max-w-sm w-full p-6">
            <div class="text-center">
                <div class="mx-auto w-12 h-12 bg-red-100 rounded-full flex items-center justify-center mb-4">
                    <i class="fas fa-exclamation-triangle text-red-600 text-xl"></i>
                </div>
                <h3 class="text-lg font-bold text-gray-800 mb-2" id="confirmTitle">Konfirmasi</h3>
                <p class="text-sm text-gray-600 mb-6" id="confirmMessage">Apakah Anda yakin?</p>
                <div class="flex gap-3">
                    <button onclick="closeConfirmModal()" class="flex-1 bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold py-2 rounded-lg text-sm transition">
                        <i class="fas fa-times mr-1"></i>Batal
                    </button>
                    <button id="confirmDeleteBtn" class="flex-1 bg-red-600 hover:bg-red-700 text-white font-semibold py-2 rounded-lg text-sm transition">
                        <i class="fas fa-trash mr-1"></i>Hapus
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebarOverlay');
            const sb1 = document.getElementById('sb1');
            const sb2 = document.getElementById('sb2');
            const sb3 = document.getElementById('sb3');
            const isOpen = !sidebar.classList.contains('-translate-x-full');

            if (isOpen) {
                sidebar.classList.add('-translate-x-full');
                overlay.classList.add('hidden');
                sb1.style.transform = '';
                sb2.style.opacity = '1';
                sb3.style.transform = '';
            } else {
                sidebar.classList.remove('-translate-x-full');
                overlay.classList.remove('hidden');
                sb1.style.transform = 'translateY(6px) rotate(45deg)';
                sb2.style.opacity = '0';
                sb3.style.transform = 'translateY(-6px) rotate(-45deg)';
            }
        }

        function showConfirmModal(form) {
            document.getElementById('confirmModal').classList.remove('hidden');
            document.getElementById('confirmModal').classList.add('flex');
            document.getElementById('confirmDeleteBtn').onclick = function () {
                form.submit();
            };
        }

        function closeConfirmModal() {
            document.getElementById('confirmModal').classList.add('hidden');
            document.getElementById('confirmModal').classList.remove('flex');
        }

        document.getElementById('confirmModal').addEventListener('click', function (e) {
            if (e.target === this) closeConfirmModal();
        });

        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape') closeConfirmModal();
        });
    </script>
@endsection