@extends('layouts.app')
@section('title', 'Login Admin')

@section('content')
    <div class="min-h-screen bg-gradient-to-br from-gray-900 via-slate-800 to-gray-900
                flex items-center justify-center px-4 py-8 relative overflow-hidden">

        {{-- Decorative --}}
        <div class="absolute -top-28 -right-28 w-80 h-80 bg-slate-600 rounded-full opacity-20 blur-3xl"></div>
        <div class="absolute -bottom-36 -left-36 w-[28rem] h-[28rem] bg-gray-700 rounded-full opacity-15 blur-3xl"></div>

        <div class="bg-white/95 backdrop-blur-sm rounded-3xl shadow-2xl w-full max-w-md p-8 relative border border-white/30">

            <a href="{{ route('landing') }}" class="absolute top-6 left-6 w-9 h-9 flex items-center justify-center rounded-full text-gray-400 hover:text-gray-700 hover:bg-gray-100 transition">
                <i class="fas fa-arrow-left text-sm"></i>
            </a>

            {{-- Logo --}}
            <div class="text-center mb-7 mt-2">
                <div class="w-16 h-16 mx-auto mb-3 bg-gradient-to-br from-gray-700 to-gray-900 rounded-2xl flex items-center justify-center shadow-lg shadow-gray-300">
                    <i class="fas fa-shield-halved text-white text-2xl"></i>
                </div>
                <h1 class="text-2xl font-bold text-gray-800">Admin Panel</h1>
                <p class="text-gray-400 text-sm mt-0.5">Si Tania</p>
            </div>

            {{-- Errors --}}
            @if($errors->any())
                <div class="mb-5 bg-red-50 border border-red-200 text-red-600 px-4 py-3 rounded-xl text-sm flex items-center gap-2">
                    <i class="fas fa-circle-exclamation text-red-400"></i>
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('login.admin') }}">
                @csrf

                {{-- Email --}}
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-600 mb-1.5">Email Admin</label>
                    <div class="relative">
                        <span class="absolute left-3.5 top-1/2 -translate-y-1/2 text-gray-400 text-sm"><i class="fas fa-envelope"></i></span>
                        <input type="email" name="email" value="{{ old('email') }}" placeholder="Masukkan email Anda" class="w-full border border-gray-200 rounded-xl pl-10 pr-4 py-2.5 text-sm bg-gray-50 focus:bg-white focus:ring-2 focus:ring-gray-500 focus:border-gray-500 outline-none transition" required>
                    </div>
                </div>

                {{-- Password --}}
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-600 mb-1.5">Password</label>
                    <div class="relative">
                        <span class="absolute left-3.5 top-1/2 -translate-y-1/2 text-gray-400 text-sm"><i class="fas fa-lock"></i></span>
                        <input type="password" name="password" id="password" placeholder="Masukkan password Anda" class="w-full border border-gray-200 rounded-xl pl-10 pr-12 py-2.5 text-sm bg-gray-50 focus:bg-white focus:ring-2 focus:ring-gray-500 focus:border-gray-500 outline-none transition" required>
                        <button type="button" onclick="togglePassword('password', 'eyeIcon')" class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600 focus:outline-none">
                            <i id="eyeIcon" class="fas fa-eye"></i>
                        </button>
                    </div>
                </div>

                {{-- Submit --}}
                <button type="submit" class="w-full bg-gradient-to-r from-gray-700 to-gray-900 hover:from-gray-800 hover:to-black text-white font-semibold py-2.5 rounded-xl transition shadow-md shadow-gray-300 text-sm flex items-center justify-center gap-2">
                    <i class="fas fa-right-to-bracket"></i>
                    Masuk sebagai Admin
                </button>
            </form>

            {{-- Back --}}
            <div class="mt-5 text-center">
                <a href="{{ route('login') }}" class="text-xs text-gray-400 hover:text-gray-600 transition">
                    <i class="fas fa-arrow-left text-[10px]"></i> Kembali ke login warga
                </a>
            </div>
        </div>
    </div>
@endsection
