@extends('layouts.warga')
@section('title', 'Profil Saya')
@section('main')
    <div class="max-w-2xl mx-auto">
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="bg-gradient-to-r from-green-600 to-green-700 px-4 sm:px-6 py-5 sm:py-6">
                <div class="flex items-center gap-4">
                    <div class="w-14 h-14 sm:w-16 sm:h-16 bg-white/20 rounded-full flex items-center justify-center text-white text-2xl sm:text-3xl font-bold shrink-0">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>
                    <div class="text-white">
                        <h2 class="text-lg sm:text-xl font-bold">{{ auth()->user()->name }}</h2>
                        <p class="text-green-200 text-sm">{{ auth()->user()->email }}</p>
                    </div>
                </div>
            </div>

            <form method="POST" action="{{ route('warga.profil.update') }}" class="p-4 sm:p-6 space-y-5">
                @csrf

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">
                        <i class="fas fa-user mr-1.5 text-green-600"></i>Nama Lengkap
                    </label>
                    <input type="text" name="name" value="{{ old('name', auth()->user()->name) }}"
                        class="w-full rounded-lg border border-gray-300 px-3 py-2.5 text-sm focus:ring-2 focus:ring-green-500 focus:border-green-500 @error('name') border-red-400 @enderror">
                    @error('name')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">
                        <i class="fas fa-envelope mr-1.5 text-green-600"></i>Email
                    </label>
                    <input type="email" name="email" value="{{ old('email', auth()->user()->email) }}"
                        class="w-full rounded-lg border border-gray-300 px-3 py-2.5 text-sm focus:ring-2 focus:ring-green-500 focus:border-green-500 @error('email') border-red-400 @enderror">
                    @error('email')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <hr class="border-gray-200">

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">
                        <i class="fas fa-lock mr-1.5 text-green-600"></i>Password Baru
                    </label>
                    <p class="text-xs text-gray-400 mb-2">Kosongkan jika tidak ingin mengubah password.</p>
                    <input type="password" name="password" placeholder="Password baru"
                        class="w-full rounded-lg border border-gray-300 px-3 py-2.5 text-sm focus:ring-2 focus:ring-green-500 focus:border-green-500 @error('password') border-red-400 @enderror">
                    @error('password')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <input type="password" name="password_confirmation" placeholder="Konfirmasi password baru"
                        class="w-full rounded-lg border border-gray-300 px-3 py-2.5 text-sm focus:ring-2 focus:ring-green-500 focus:border-green-500">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">
                        <i class="fas fa-shield-alt mr-1.5 text-green-600"></i>Password Saat Ini
                    </label>
                    <p class="text-xs text-gray-400 mb-2">Diperlukan untuk mengubah password.</p>
                    <input type="password" name="current_password" placeholder="Password saat ini"
                        class="w-full rounded-lg border border-gray-300 px-3 py-2.5 text-sm focus:ring-2 focus:ring-green-500 focus:border-green-500 @error('current_password') border-red-400 @enderror">
                    @error('current_password')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="pt-2">
                    <button type="submit"
                        class="w-full sm:w-auto bg-green-600 hover:bg-green-700 text-white font-semibold px-6 py-2.5 rounded-lg text-sm transition flex items-center justify-center gap-2">
                        <i class="fas fa-save"></i>Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
