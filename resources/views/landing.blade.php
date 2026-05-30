<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Si Tania — Sistem Rekomendasi Tanaman</title>
    <link rel="icon" href="{{ asset('favicon.svg') }}" type="image/svg+xml">
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <style>
        html { scroll-behavior: smooth; }

        .pop-up {
            opacity: 0;
            transform: translateY(30px) scale(0.95);
            transition: opacity 0.6s ease, transform 0.6s ease;
        }
        .pop-up.visible {
            opacity: 1;
            transform: translateY(0) scale(1);
        }

        .pop-up-left {
            opacity: 0;
            transform: translateX(-40px);
            transition: opacity 0.5s ease, transform 0.5s ease;
        }
        .pop-up-left.visible {
            opacity: 1;
            transform: translateX(0);
        }

        .pop-up-right {
            opacity: 0;
            transform: translateX(40px);
            transition: opacity 0.5s ease, transform 0.5s ease;
        }
        .pop-up-right.visible {
            opacity: 1;
            transform: translateX(0);
        }

        .pop-up-scale {
            opacity: 0;
            transform: scale(0.7);
            transition: opacity 0.5s ease, transform 0.5s ease;
        }
        .pop-up-scale.visible {
            opacity: 1;
            transform: scale(1);
        }

        .hover-lift {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .hover-lift:hover {
            transform: translateY(-6px);
            box-shadow: 0 12px 30px -8px rgba(0,0,0,0.12);
        }

        .hover-glow:hover {
            box-shadow: 0 0 25px -5px rgba(34,197,94,0.4);
        }

        .hover-spin:hover i {
            transform: rotate(15deg) scale(1.1);
        }
        .hover-spin i {
            transition: transform 0.3s ease;
        }

        .hover-bounce:hover {
            animation: bounce 0.5s ease;
        }
        @keyframes bounce {
            0%, 100% { transform: translateY(0); }
            40% { transform: translateY(-8px); }
            60% { transform: translateY(-3px); }
        }
    </style>
</head>
<body class="bg-white text-gray-800 font-sans">

    {{-- NAVBAR --}}
    <nav class="fixed top-0 left-0 w-full z-50 bg-white/80 backdrop-blur-md border-b border-gray-100">
        <div class="max-w-6xl mx-auto px-4 sm:px-6">
            <div class="flex items-center justify-between h-16">
                <a href="/" class="flex items-center gap-2.5">
                    <div class="w-9 h-9 bg-gradient-to-br from-green-500 to-emerald-600 rounded-xl flex items-center justify-center shadow">
                        <i class="fas fa-leaf text-white text-sm"></i>
                    </div>
                    <span class="font-bold text-gray-800 text-lg">Si Tania</span>
                </a>
                <div class="flex items-center gap-3">
                    <a href="{{ route('login') }}" class="text-sm font-medium text-gray-600 hover:text-green-700 transition px-3 py-2 hover-spin"><i class="fas fa-right-to-bracket mr-1.5"></i>Masuk</a>
                    <a href="{{ route('register') }}" class="text-sm font-semibold bg-gradient-to-r from-green-600 to-emerald-600 hover:from-green-700 hover:to-emerald-700 text-white px-5 py-2 rounded-xl transition shadow-sm hover-lift hover-glow">Daftar</a>
                </div>
            </div>
        </div>
    </nav>

    {{-- HERO --}}
    <section class="relative min-h-screen flex items-center pt-16 overflow-hidden">
        {{-- Background --}}
        <div class="absolute inset-0 bg-gradient-to-br from-green-50 via-white to-emerald-50"></div>
        <div class="absolute -top-40 -right-40 w-[500px] h-[500px] bg-green-200/30 rounded-full blur-3xl"></div>
        <div class="absolute -bottom-40 -left-40 w-[600px] h-[600px] bg-emerald-200/20 rounded-full blur-3xl"></div>

                <div class="relative z-10 max-w-6xl mx-auto px-4 sm:px-6 py-16 sm:py-20">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                {{-- Left text --}}
                <div class="pop-up-left">
                    <span class="inline-block bg-green-100 text-green-700 text-xs font-bold px-3 py-1 rounded-full mb-4 tracking-wide">Urban Farming</span>
                    <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold text-gray-900 leading-tight">
                        Temukan Tanaman<br>
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-green-600 to-emerald-600">Terbaik</span> untuk Lahanmu
                    </h1>
                    <p class="text-gray-500 mt-4 sm:mt-5 text-base sm:text-lg max-w-lg leading-relaxed">
                        Sistem rekomendasi tanaman berbasis AHP & TOPSIS. Cukup masukkan kondisi lahan, dapatkan rekomendasi tanaman urban farming yang paling cocok.
                    </p>
                    <div class="flex flex-wrap gap-3 mt-6 sm:mt-8">
                        <a href="{{ route('register') }}" class="bg-gradient-to-r from-green-600 to-emerald-600 hover:from-green-700 hover:to-emerald-700 text-white font-semibold px-6 py-3 rounded-xl transition shadow-lg shadow-green-200 flex items-center gap-2 hover-lift hover-glow">
                            <i class="fas fa-user-plus"></i> Daftar Sekarang
                        </a>
                        <a href="{{ route('login') }}" class="border border-gray-200 hover:border-green-300 text-gray-700 hover:text-green-700 font-medium px-6 py-3 rounded-xl transition flex items-center gap-2 hover-lift">
                            <i class="fas fa-right-to-bracket"></i> Masuk
                        </a>
                        <a href="#tentang" class="border border-gray-200 hover:border-gray-300 text-gray-400 hover:text-gray-600 font-medium px-6 py-3 rounded-xl transition flex items-center gap-2 hover-lift">
                            <i class="fas fa-chevron-down text-xs"></i> Pelajari
                        </a>
                    </div>
                </div>

                {{-- Right illustration --}}
                <div class="relative flex justify-center lg:justify-end pop-up-right">
                    <div class="relative w-full max-w-md">
                        {{-- Main illustration card --}}
                        <div class="bg-white rounded-3xl shadow-2xl shadow-green-200/30 p-6 sm:p-8 border border-gray-100">
                            {{-- Plant graphic --}}
                            <div class="flex items-end justify-center gap-2 sm:gap-3 mb-6">
                                <div class="text-center">
                                    <div class="w-14 h-20 sm:w-16 sm:h-24 bg-gradient-to-t from-green-600 to-green-400 rounded-t-2xl rounded-b-sm shadow-inner"></div>
                                    <div class="w-14 sm:w-16 h-3 bg-green-800/20 rounded mt-1"></div>
                                </div>
                                <div class="text-center">
                                    <div class="w-10 h-16 sm:w-12 sm:h-20 bg-gradient-to-t from-emerald-600 to-emerald-400 rounded-t-2xl rounded-b-sm shadow-inner"></div>
                                    <div class="w-10 sm:w-12 h-3 bg-green-800/20 rounded mt-1"></div>
                                </div>
                                <div class="text-center">
                                    <div class="w-12 h-18 sm:w-14 sm:h-22 bg-gradient-to-t from-green-500 to-green-300 rounded-t-2xl rounded-b-sm shadow-inner"></div>
                                    <div class="w-12 sm:w-14 h-3 bg-green-800/20 rounded mt-1"></div>
                                </div>
                                <div class="text-center">
                                    <div class="w-8 h-12 sm:w-10 sm:h-16 bg-gradient-to-t from-emerald-500 to-emerald-300 rounded-t-2xl rounded-b-sm shadow-inner"></div>
                                    <div class="w-8 sm:w-10 h-3 bg-green-800/20 rounded mt-1"></div>
                                </div>
                            </div>
                            {{-- Score card --}}
                            <div class="bg-gradient-to-br from-green-50 to-emerald-50 rounded-2xl p-4 border border-green-100">
                                <div class="flex items-center justify-between mb-2">
                                    <span class="text-xs font-semibold text-gray-500 uppercase tracking-wide">Rekomendasi</span>
                                    <span class="bg-green-600 text-white text-[10px] font-bold px-2 py-0.5 rounded-full">Skor 98%</span>
                                </div>
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 bg-green-600 rounded-xl flex items-center justify-center">
                                        <i class="fas fa-leaf text-white text-sm"></i>
                                    </div>
                                    <div>
                                        <p class="font-bold text-gray-800 text-sm">Kangkung Hidroponik</p>
                                        <p class="text-[11px] text-gray-400">Metode: AHP-TOPSIS</p>
                                    </div>
                                </div>
                                <div class="mt-3 flex gap-1.5">
                                    <div class="h-1.5 flex-1 bg-green-200 rounded-full overflow-hidden"><div class="h-full w-full bg-green-600 rounded-full"></div></div>
                                    <div class="h-1.5 flex-1 bg-green-200 rounded-full overflow-hidden"><div class="h-full w-4/5 bg-green-500 rounded-full"></div></div>
                                    <div class="h-1.5 flex-1 bg-green-200 rounded-full overflow-hidden"><div class="h-full w-3/5 bg-green-400 rounded-full"></div></div>
                                    <div class="h-1.5 flex-1 bg-green-200 rounded-full overflow-hidden"><div class="h-full w-2/5 bg-green-300 rounded-full"></div></div>
                                    <div class="h-1.5 flex-1 bg-green-200 rounded-full overflow-hidden"><div class="h-full w-1/5 bg-green-200 rounded-full"></div></div>
                                </div>
                            </div>
                        </div>
                        {{-- Floating badge --}}
                        <div class="absolute -top-4 -right-4 sm:-top-6 sm:-right-6 bg-white rounded-2xl shadow-lg px-4 py-3 border border-gray-100 pop-up-scale">
                            <div class="flex items-center gap-2">
                                <i class="fas fa-database text-green-600 text-sm"></i>
                                <span class="text-xs font-bold text-gray-700">7 Kriteria</span>
                            </div>
                        </div>
                        <div class="absolute -bottom-3 -left-3 sm:-bottom-4 sm:-left-4 bg-white rounded-2xl shadow-lg px-4 py-3 border border-gray-100 pop-up-scale" style="transition-delay: 0.15s">
                            <div class="flex items-center gap-2">
                                <i class="fas fa-chart-line text-emerald-600 text-sm"></i>
                                <span class="text-xs font-bold text-gray-700">TOPSIS</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- TENTANG --}}
    <section id="tentang" class="py-16 sm:py-20 bg-white">
        <div class="max-w-6xl mx-auto px-4 sm:px-6">
            <div class="text-center mb-12">
                <span class="inline-block bg-green-100 text-green-700 text-xs font-bold px-3 py-1 rounded-full mb-3">Tentang</span>
                <h2 class="text-3xl sm:text-4xl font-bold text-gray-900">Apa itu Si Tania?</h2>
                <p class="text-gray-400 mt-3 max-w-2xl mx-auto text-sm sm:text-base">
                    Sistem rekomendasi tanaman cerdas yang membantu petani urban menemukan tanaman paling cocok berdasarkan kondisi lahan
                </p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 sm:gap-8 pop-up">
                <div class="bg-green-50 rounded-3xl p-6 sm:p-8 text-center group hover:bg-green-600 transition duration-300 hover-lift">
                    <div class="w-16 h-16 mx-auto mb-4 bg-white rounded-2xl flex items-center justify-center text-green-600 group-hover:bg-green-500 group-hover:text-white transition shadow-sm">
                        <i class="fas fa-seedling text-2xl"></i>
                    </div>
                    <h3 class="font-bold text-gray-800 group-hover:text-white transition text-lg">Input Lahan</h3>
                    <p class="text-gray-500 group-hover:text-green-100 transition text-sm mt-2 leading-relaxed">
                        Masukkan data lahan seperti jenis tanah, pH air, suhu, kelembapan, cahaya, dan curah hujan
                    </p>
                </div>
                <div class="bg-emerald-50 rounded-3xl p-6 sm:p-8 text-center group hover:bg-emerald-600 transition duration-300 hover-lift" style="transition-delay: 0.1s">
                    <div class="w-16 h-16 mx-auto mb-4 bg-white rounded-2xl flex items-center justify-center text-emerald-600 group-hover:bg-emerald-500 group-hover:text-white transition shadow-sm">
                        <i class="fas fa-calculator text-2xl"></i>
                    </div>
                    <h3 class="font-bold text-gray-800 group-hover:text-white transition text-lg">Analisis Cerdas</h3>
                    <p class="text-gray-500 group-hover:text-emerald-100 transition text-sm mt-2 leading-relaxed">
                        Sistem memproses data menggunakan metode AHP & TOPSIS untuk mencocokkan dengan tanaman optimal
                    </p>
                </div>
                <div class="bg-green-50 rounded-3xl p-6 sm:p-8 text-center group hover:bg-green-600 transition duration-300 hover-lift" style="transition-delay: 0.2s">
                    <div class="w-16 h-16 mx-auto mb-4 bg-white rounded-2xl flex items-center justify-center text-green-600 group-hover:bg-green-500 group-hover:text-white transition shadow-sm">
                        <i class="fas fa-circle-check text-2xl"></i>
                    </div>
                    <h3 class="font-bold text-gray-800 group-hover:text-white transition text-lg">Rekomendasi Akurat</h3>
                    <p class="text-gray-500 group-hover:text-green-100 transition text-sm mt-2 leading-relaxed">
                        Dapatkan daftar tanaman terbaik lengkap dengan skor kecocokan dan metode budidaya
                    </p>
                </div>
            </div>
        </div>
    </section>

    {{-- CARA KERJA --}}
    <section class="py-16 sm:py-20 bg-gradient-to-b from-white to-green-50">
        <div class="max-w-6xl mx-auto px-4 sm:px-6">
            <div class="text-center mb-12">
                <span class="inline-block bg-green-100 text-green-700 text-xs font-bold px-3 py-1 rounded-full mb-3">Cara Kerja</span>
                <h2 class="text-3xl sm:text-4xl font-bold text-gray-900">Tiga Langkah Mudah</h2>
                <p class="text-gray-400 mt-3 text-sm sm:text-base">Dapatkan rekomendasi tanaman hanya dalam 3 langkah</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 sm:gap-8 max-w-4xl mx-auto pop-up">
                <div class="text-center hover-bounce">
                    <div class="relative w-24 h-24 mx-auto mb-4 bg-gradient-to-br from-green-500 to-emerald-600 rounded-3xl flex items-center justify-center shadow-lg shadow-green-200 hover-glow transition-shadow">
                        <i class="fas fa-pen-to-square text-white text-2xl"></i>
                        <span class="absolute -top-2 -right-2 w-7 h-7 bg-white border-2 border-green-600 text-green-700 text-xs font-bold rounded-full flex items-center justify-center">1</span>
                    </div>
                    <h4 class="font-bold text-gray-800">Input Data Lahan</h4>
                    <p class="text-gray-400 text-sm mt-1">Isi formulir kondisi lahan Anda</p>
                </div>
                <div class="text-center hover-bounce" style="transition-delay: 0.1s">
                    <div class="relative w-24 h-24 mx-auto mb-4 bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-3xl flex items-center justify-center shadow-lg shadow-emerald-200 hover-glow transition-shadow">
                        <i class="fas fa-gears text-white text-2xl"></i>
                        <span class="absolute -top-2 -right-2 w-7 h-7 bg-white border-2 border-emerald-600 text-emerald-700 text-xs font-bold rounded-full flex items-center justify-center">2</span>
                    </div>
                    <h4 class="font-bold text-gray-800">Proses AHP-TOPSIS</h4>
                    <p class="text-gray-400 text-sm mt-1">Sistem menghitung skor kecocokan</p>
                </div>
                <div class="text-center hover-bounce" style="transition-delay: 0.2s">
                    <div class="relative w-24 h-24 mx-auto mb-4 bg-gradient-to-br from-green-500 to-emerald-600 rounded-3xl flex items-center justify-center shadow-lg shadow-green-200 hover-glow transition-shadow">
                        <i class="fas fa-list-check text-white text-2xl"></i>
                        <span class="absolute -top-2 -right-2 w-7 h-7 bg-white border-2 border-green-600 text-green-700 text-xs font-bold rounded-full flex items-center justify-center">3</span>
                    </div>
                    <h4 class="font-bold text-gray-800">Dapatkan Rekomendasi</h4>
                    <p class="text-gray-400 text-sm mt-1">Lihat tanaman terbaik untuk lahan Anda</p>
                </div>
            </div>
        </div>
    </section>

    {{-- CTA --}}
    <section class="py-16 sm:py-20 bg-white">
        <div class="max-w-6xl mx-auto px-4 sm:px-6">
            <div class="bg-gradient-to-br from-green-600 via-emerald-600 to-green-700 rounded-3xl p-8 sm:p-12 text-center relative overflow-hidden pop-up" style="transition-delay: 0.1s">
                <div class="absolute -top-20 -right-20 w-64 h-64 bg-green-400/20 rounded-full blur-3xl"></div>
                <div class="absolute -bottom-20 -left-20 w-64 h-64 bg-emerald-300/20 rounded-full blur-3xl"></div>
                <div class="relative z-10">
                    <h2 class="text-3xl sm:text-4xl font-bold text-white">Siap Memulai?</h2>
                    <p class="text-green-100 mt-3 max-w-lg mx-auto text-sm sm:text-base">
                        Daftar sekarang dan temukan tanaman urban farming terbaik untuk lahan Anda
                    </p>
                    <div class="flex flex-wrap justify-center gap-3 mt-6">
                        <a href="{{ route('register') }}" class="bg-white text-green-700 hover:bg-green-50 font-bold px-6 py-3 rounded-xl transition shadow-lg flex items-center gap-2 hover-lift">
                            <i class="fas fa-user-plus"></i> Daftar Gratis
                        </a>
                        <a href="{{ route('login') }}" class="bg-white/10 backdrop-blur text-white hover:bg-white/20 font-semibold px-6 py-3 rounded-xl transition border border-white/20 flex items-center gap-2 hover-lift">
                            <i class="fas fa-right-to-bracket"></i> Masuk
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- FOOTER --}}
    <footer class="border-t border-gray-100 py-8">
        <div class="max-w-6xl mx-auto px-4 sm:px-6">
            <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
                <div class="flex items-center gap-2 text-gray-400 text-sm">
                    <i class="fas fa-leaf text-green-600"></i>
                    <span>Si Tania — Sistem Rekomendasi Tanaman</span>
                </div>
                <p class="text-gray-400 text-xs">&copy; {{ date('Y') }} Si Tania</p>
            </div>
        </div>
    </footer>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                }
            });
        }, { threshold: 0.15 });

        document.querySelectorAll('.pop-up, .pop-up-left, .pop-up-right, .pop-up-scale')
            .forEach(el => observer.observe(el));
    });
</script>

</body>
</html>
