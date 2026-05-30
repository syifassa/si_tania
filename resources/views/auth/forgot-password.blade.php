@extends('layouts.app')
@section('title', 'Lupa Password')

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
                    <i class="fas fa-key text-white text-xl"></i>
                </div>
                <h1 class="text-2xl font-bold text-green-700">Reset Password</h1>
                <p class="text-gray-400 text-sm mt-0.5">Masukkan email Anda untuk reset password</p>
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

            @if(session('status'))
                <div class="mb-5 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl text-sm">
                    {!! session('status') !!}
                </div>
            @endif

            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-600 mb-1.5">Email</label>
                    <div class="relative">
                        <span class="absolute left-3.5 top-1/2 -translate-y-1/2 text-gray-400 text-sm"><i class="fas fa-envelope"></i></span>
                        <input type="email" name="email" value="{{ old('email') }}" placeholder="Masukkan email Anda" class="w-full border border-gray-200 rounded-xl pl-10 pr-4 py-2.5 text-sm bg-gray-50 focus:bg-white focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none transition @error('email') border-red-300 bg-red-50 @enderror" required autofocus>
                    </div>
                </div>

                <button type="submit" class="w-full bg-gradient-to-r from-green-600 to-emerald-600 hover:from-green-700 hover:to-emerald-700 text-white font-semibold py-2.5 rounded-xl transition shadow-md shadow-green-200 text-sm flex items-center justify-center gap-2">
                    <i class="fas fa-paper-plane"></i>
                    Kirim Tautan Reset
                </button>
            </form>

            <div class="mt-5 text-center text-sm text-gray-400">
                Ingat password Anda?
                <a href="{{ route('login') }}" class="text-green-600 font-semibold hover:underline">Kembali ke login</a>
            </div>
        </div>
    </div>
@endsection
