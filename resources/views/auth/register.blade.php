@extends('layouts.app')
@section('title', 'Daftar Akun')

@section('content')
    <div class="min-h-screen bg-gradient-to-br from-green-50 via-emerald-50 to-green-100
                flex items-center justify-center px-4 py-8 relative overflow-hidden">

        <div class="absolute -top-24 -right-24 w-96 h-96 bg-green-200 rounded-full opacity-30 blur-3xl"></div>
        <div class="absolute -bottom-32 -left-32 w-[30rem] h-[30rem] bg-emerald-200 rounded-full opacity-25 blur-3xl"></div>

        <div class="bg-white/90 backdrop-blur-sm rounded-3xl shadow-xl w-full max-w-md p-8 relative border border-white/50">

            <a href="{{ route('landing') }}" class="absolute top-6 left-6 w-9 h-9 flex items-center justify-center rounded-full text-gray-400 hover:text-green-700 hover:bg-green-50 transition">
                <i class="fas fa-arrow-left text-sm"></i>
            </a>

            <div class="text-center mb-7 mt-2">
                <div class="w-16 h-16 mx-auto mb-3 bg-gradient-to-br from-green-500 to-emerald-600 rounded-2xl flex items-center justify-center shadow-lg shadow-green-200">
                    <i class="fas fa-user-plus text-white text-xl"></i>
                </div>
                <h1 class="text-2xl font-bold text-green-700">Daftar Akun</h1>
                <p class="text-gray-400 text-sm mt-0.5">Si Tania</p>
            </div>

            @if($errors->any())
                <div class="mb-5 bg-red-50 border border-red-200 text-red-600 px-4 py-3 rounded-xl text-sm flex items-center gap-2">
                    <i class="fas fa-circle-exclamation text-red-400"></i>
                    <ul class="list-disc list-inside">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-600 mb-1.5">Nama Lengkap</label>
                    <div class="relative">
                        <span class="absolute left-3.5 top-1/2 -translate-y-1/2 text-gray-400 text-sm"><i class="fas fa-user"></i></span>
                        <input type="text" name="name" value="{{ old('name') }}" placeholder="Nama lengkap Anda" class="w-full border border-gray-200 rounded-xl pl-10 pr-4 py-2.5 text-sm bg-gray-50 focus:bg-white focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none transition" required>
                    </div>
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-600 mb-1.5">Email</label>
                    <div class="relative">
                        <span class="absolute left-3.5 top-1/2 -translate-y-1/2 text-gray-400 text-sm"><i class="fas fa-envelope"></i></span>
                        <input type="email" name="email" value="{{ old('email') }}" placeholder="Masukkan email Anda" class="w-full border border-gray-200 rounded-xl pl-10 pr-4 py-2.5 text-sm bg-gray-50 focus:bg-white focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none transition" required>
                    </div>
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-600 mb-1.5">Password</label>
                    <div class="relative">
                        <span class="absolute left-3.5 top-1/2 -translate-y-1/2 text-gray-400 text-sm"><i class="fas fa-lock"></i></span>
                        <input type="password" name="password" id="password" placeholder="Minimal 8 karakter" class="w-full border border-gray-200 rounded-xl pl-10 pr-12 py-2.5 text-sm bg-gray-50 focus:bg-white focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none transition" required>
                        <button type="button" onclick="togglePassword('password', 'eyeIcon')" class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600 focus:outline-none">
                            <i id="eyeIcon" class="fas fa-eye"></i>
                        </button>
                    </div>
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-600 mb-1.5">Konfirmasi Password</label>
                    <div class="relative">
                        <span class="absolute left-3.5 top-1/2 -translate-y-1/2 text-gray-400 text-sm"><i class="fas fa-lock"></i></span>
                        <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Ulangi password" class="w-full border border-gray-200 rounded-xl pl-10 pr-12 py-2.5 text-sm bg-gray-50 focus:bg-white focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none transition" required>
                        <button type="button" onclick="togglePassword('password_confirmation', 'eyeIcon2')" class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600 focus:outline-none">
                            <i id="eyeIcon2" class="fas fa-eye"></i>
                        </button>
                    </div>
                </div>

                <button type="submit" class="w-full bg-gradient-to-r from-green-600 to-emerald-600 hover:from-green-700 hover:to-emerald-700 text-white font-semibold py-2.5 rounded-xl transition shadow-md shadow-green-200 text-sm flex items-center justify-center gap-2">
                    <i class="fas fa-user-plus"></i>
                    Daftar Sekarang
                </button>
            </form>

            <div class="mt-5 text-center text-sm text-gray-400">
                Sudah punya akun?
                <a href="{{ route('login') }}" class="text-green-600 font-semibold hover:underline">Login di sini</a>
            </div>
        </div>
    </div>
@endsection
