@extends('layouts.app')
@section('title', 'Login Warga')

@section('content')
    <div class="min-h-screen bg-gradient-to-br from-green-50 via-emerald-50 to-green-100
                flex items-center justify-center px-4 py-8 relative overflow-hidden">

        {{-- Decorative circles --}}
        <div class="absolute -top-24 -right-24 w-96 h-96 bg-green-200 rounded-full opacity-30 blur-3xl"></div>
        <div class="absolute -bottom-32 -left-32 w-[30rem] h-[30rem] bg-emerald-200 rounded-full opacity-25 blur-3xl"></div>
        <div class="absolute top-1/3 left-10 w-4 h-4 bg-green-300 rounded-full opacity-40"></div>
        <div class="absolute bottom-1/4 right-16 w-6 h-6 bg-emerald-300 rounded-full opacity-30"></div>

        <div class="bg-white/90 backdrop-blur-sm rounded-3xl shadow-xl w-full max-w-md p-8 relative border border-white/50">

            {{-- Back button --}}
            <a href="{{ route('landing') }}" class="absolute top-6 left-6 w-9 h-9 flex items-center justify-center rounded-full text-gray-400 hover:text-green-700 hover:bg-green-50 transition">
                <i class="fas fa-arrow-left text-sm"></i>
            </a>

            {{-- Logo --}}
            <div class="text-center mb-7 mt-2">
                <div class="w-16 h-16 mx-auto mb-3 bg-gradient-to-br from-green-500 to-emerald-600 rounded-2xl flex items-center justify-center shadow-lg shadow-green-200">
                    <i class="fas fa-leaf text-white text-2xl"></i>
                </div>
                <h1 class="text-2xl font-bold text-green-700">Si Tania</h1>
                <p class="text-gray-400 text-sm mt-0.5">Sistem Rekomendasi Tanaman</p>
            </div>

            {{-- Alerts --}}
            @if($errors->any())
                <div class="mb-5 bg-red-50 border border-red-200 text-red-600 px-4 py-3 rounded-xl text-sm flex items-center gap-2">
                    <i class="fas fa-circle-exclamation text-red-400"></i>
                    <ul class="list-disc list-inside">
                        @foreach($errors->all() as $e)
                            <li>{{ $e }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if(session('success'))
                <div class="mb-5 bg-green-50 border border-green-200 text-green-600 px-4 py-3 rounded-xl text-sm flex items-center gap-2">
                    <i class="fas fa-circle-check text-green-400"></i>
                    {{ session('success') }}
                </div>
            @endif

            @if(session('status'))
                <div class="mb-5 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl text-sm">
                    {!! session('status') !!}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                {{-- Email --}}
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-600 mb-1.5">Email</label>
                    <div class="relative">
                        <span class="absolute left-3.5 top-1/2 -translate-y-1/2 text-gray-400 text-sm"><i class="fas fa-envelope"></i></span>
                        <input type="email" name="email" value="{{ old('email') }}" placeholder="Masukkan email Anda" class="w-full border border-gray-200 rounded-xl pl-10 pr-4 py-2.5 text-sm bg-gray-50 focus:bg-white focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none transition @error('email') border-red-300 bg-red-50 @enderror" required>
                    </div>
                </div>

                {{-- Password --}}
                <div class="mb-1">
                    <label class="block text-sm font-medium text-gray-600 mb-1.5">Password</label>
                    <div class="relative">
                        <span class="absolute left-3.5 top-1/2 -translate-y-1/2 text-gray-400 text-sm"><i class="fas fa-lock"></i></span>
                        <input type="password" name="password" id="password" placeholder="Masukkan password Anda" class="w-full border border-gray-200 rounded-xl pl-10 pr-12 py-2.5 text-sm bg-gray-50 focus:bg-white focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none transition" required>
                        <button type="button" onclick="togglePassword('password', 'eyeIcon')" class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600 focus:outline-none">
                            <i id="eyeIcon" class="fas fa-eye"></i>
                        </button>
                    </div>
                </div>

                {{-- Forgot password --}}
                <div class="mb-6 text-right">
                    <a href="{{ route('password.request') }}" class="text-xs text-gray-400 hover:text-green-600 transition">
                        Lupa password?
                    </a>
                </div>

                {{-- Submit --}}
                <button type="submit" class="w-full bg-gradient-to-r from-green-600 to-emerald-600 hover:from-green-700 hover:to-emerald-700 text-white font-semibold py-2.5 rounded-xl transition shadow-md shadow-green-200 text-sm flex items-center justify-center gap-2">
                    <i class="fas fa-right-to-bracket"></i>
                    Masuk
                </button>
            </form>

            {{-- Register link --}}
            <div class="mt-5 text-center text-sm text-gray-400">
                Belum punya akun?
                <a href="{{ route('register') }}" class="text-green-600 font-semibold hover:underline">Daftar di sini</a>
            </div>

            {{-- Admin link --}}
            <div class="mt-2 text-center">
                <a href="{{ route('login.admin') }}" class="text-xs text-gray-400 hover:text-gray-600 transition">
                    Login sebagai Admin <i class="fas fa-arrow-right text-[10px]"></i>
                </a>
            </div>
        </div>
    </div>
@endsection
