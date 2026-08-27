@extends('layouts.app')

@section('title', 'Login E-Rapor & Sistem Akademik - RA Al Musyaffallah')

@section('content')

<section class="min-h-screen w-full flex flex-col lg:flex-row bg-slate-950 text-gray-800 relative overflow-hidden font-sans">

    {{-- ================= LEFT COLUMN: HERO & BRANDING SHOWCASE ================= --}}
    <div class="relative w-full lg:w-7/12 flex flex-col justify-between p-6 sm:p-10 lg:p-14 min-h-[380px] lg:min-h-screen text-white z-10 overflow-hidden">
        
        {{-- Background Image with Modern Dark Emerald Gradient Overlay --}}
        <div class="absolute inset-0 -z-10">
            <img src="{{ asset('assets/images/612919327_800651653029679_8741154945121478353_n.jpg') }}"
                 alt="Dokumentasi Siswa RA Al Musyaffallah"
                 class="w-full h-full object-cover scale-105 filter brightness-90">
            
            {{-- Multi-Stop Gradient Glass Overlay --}}
            <div class="absolute inset-0 bg-gradient-to-tr from-slate-950 via-slate-950/85 to-green-950/70 backdrop-blur-[2px]"></div>
            
            {{-- Glowing Accent orbs --}}
            <div class="absolute top-10 left-10 w-72 h-72 bg-green-500/20 rounded-full blur-3xl pointer-events-none"></div>
            <div class="absolute bottom-10 right-10 w-96 h-96 bg-emerald-500/15 rounded-full blur-3xl pointer-events-none"></div>
        </div>

        {{-- Top Bar: Logo & Back Button --}}
        <div class="flex items-center justify-between w-full">
            <a href="{{ route('home') }}" 
               class="inline-flex items-center gap-2 px-4 py-2 bg-white/10 hover:bg-white/20 text-gray-200 hover:text-white rounded-xl backdrop-blur-md border border-white/15 transition-all duration-200 text-xs sm:text-sm font-semibold group shadow-sm">
                <i class="fa-solid fa-arrow-left group-hover:-translate-x-1 transition-transform"></i>
                <span>Kembali ke Beranda</span>
            </a>

            <div class="flex items-center gap-2">
                <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-green-950/80 border border-green-700/60 text-green-300 text-xs font-bold rounded-lg shadow-sm">
                    <i class="fa-solid fa-award text-lime-400"></i> Akreditasi B
                </span>
            </div>
        </div>

        {{-- Center Content: Branding & Highlights --}}
        <div class="my-auto py-8 max-w-xl space-y-6">
            <div class="flex items-center gap-3.5">
                <div class="w-14 h-14 rounded-2xl bg-white/10 p-2 backdrop-blur-md border border-white/20 shadow-lg flex items-center justify-center">
                    <img src="{{ asset('assets/images/1001230752.jpg - Edited.png') }}" 
                         alt="Logo RA Al Musyaffallah" 
                         class="w-full h-full object-contain">
                </div>
                <div>
                    <span class="block font-black text-xl sm:text-2xl text-white tracking-wide">RA AL MUSYAFFALLAH</span>
                    <span class="block text-xs font-bold text-lime-400 uppercase tracking-widest">Gabuswetan • Indramayu</span>
                </div>
            </div>

            <div class="space-y-3">
                <h1 class="text-3xl sm:text-4xl lg:text-5xl font-black leading-tight tracking-tight text-white">
                    Sistem E-Rapor & <br class="hidden sm:block">
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-lime-400 via-emerald-300 to-green-200">
                        Akademik Digital
                    </span>
                </h1>
                <p class="text-sm sm:text-base text-gray-300 font-normal leading-relaxed max-w-lg">
                    Platform terpadu untuk penginputan capaian perkembangan anak usia dini, penilaian P5-PPRA, dan pemantauan hasil belajar siswa secara transparan.
                </p>
            </div>

            {{-- Feature Checkmarks --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 pt-2">
                <div class="flex items-center gap-2.5 text-xs sm:text-sm text-gray-200 bg-white/5 p-3 rounded-xl border border-white/10 backdrop-blur-sm">
                    <i class="fa-solid fa-circle-check text-lime-400 text-base"></i>
                    <span>Kurikulum Merdeka PAUD</span>
                </div>
                <div class="flex items-center gap-2.5 text-xs sm:text-sm text-gray-200 bg-white/5 p-3 rounded-xl border border-white/10 backdrop-blur-sm">
                    <i class="fa-solid fa-circle-check text-lime-400 text-base"></i>
                    <span>Cetak Rapor Digital PDF</span>
                </div>
                <div class="flex items-center gap-2.5 text-xs sm:text-sm text-gray-200 bg-white/5 p-3 rounded-xl border border-white/10 backdrop-blur-sm">
                    <i class="fa-solid fa-circle-check text-lime-400 text-base"></i>
                    <span>Multi-Role Administrator</span>
                </div>
                <div class="flex items-center gap-2.5 text-xs sm:text-sm text-gray-200 bg-white/5 p-3 rounded-xl border border-white/10 backdrop-blur-sm">
                    <i class="fa-solid fa-circle-check text-lime-400 text-base"></i>
                    <span>Akses Aman & Terenkripsi</span>
                </div>
            </div>
        </div>

        {{-- Bottom Footer Note on Left --}}
        <div class="text-xs text-gray-400 flex flex-wrap items-center justify-between gap-2 pt-4 border-t border-white/10">
            <span>&copy; {{ date('Y') }} RA Al Musyaffallah Gabuswetan.</span>
            <span class="text-gray-300 font-semibold">Tahun Pelajaran 2025/2026</span>
        </div>

    </div>


    {{-- ================= RIGHT COLUMN: LOGIN FORM GATEWAY ================= --}}
    <div class="w-full lg:w-5/12 bg-gray-50 flex items-center justify-center p-6 sm:p-10 lg:p-12 relative min-h-screen">
        
        {{-- Background Glow Accent --}}
        <div class="absolute top-0 right-0 w-64 h-64 bg-green-200/40 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute bottom-0 left-0 w-64 h-64 bg-emerald-200/40 rounded-full blur-3xl pointer-events-none"></div>

        <div class="w-full max-w-md bg-white rounded-3xl shadow-xl border border-gray-100 p-8 sm:p-10 relative z-10">

            {{-- Form Header --}}
            <div class="text-center mb-8">
                <div class="inline-flex items-center justify-center w-16 h-16 rounded-2xl bg-gradient-to-tr from-green-600 to-emerald-500 text-white shadow-lg shadow-green-500/20 mb-4">
                    <i class="fa-solid fa-right-to-bracket text-2xl"></i>
                </div>
                <h2 class="text-2xl sm:text-3xl font-black text-gray-900 tracking-tight">
                    Selamat Datang
                </h2>
                <p class="text-xs sm:text-sm text-gray-500 mt-1 font-medium">
                    Masukkan akun Anda untuk masuk ke sistem e-raport
                </p>
            </div>

            {{-- Flash Alert Messages --}}
            @if(session('error'))
                <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 rounded-xl flex items-start gap-3 text-red-800 text-xs sm:text-sm animate-pulse">
                    <i class="fa-solid fa-circle-exclamation text-red-500 text-base mt-0.5"></i>
                    <div>
                        <strong class="font-bold">Gagal Masuk:</strong>
                        <p class="mt-0.5">{{ session('error') }}</p>
                    </div>
                </div>
            @endif

            @if(session('success'))
                <div class="mb-6 p-4 bg-green-50 border-l-4 border-green-500 rounded-xl flex items-start gap-3 text-green-800 text-xs sm:text-sm">
                    <i class="fa-solid fa-circle-check text-green-600 text-base mt-0.5"></i>
                    <div>
                        <strong class="font-bold">Berhasil:</strong>
                        <p class="mt-0.5">{{ session('success') }}</p>
                    </div>
                </div>
            @endif

            @if ($errors->any())
                <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 rounded-xl text-red-800 text-xs sm:text-sm">
                    <div class="flex items-center gap-2 font-bold mb-1">
                        <i class="fa-solid fa-triangle-exclamation text-red-500"></i>
                        <span>Mohon periksa data berikut:</span>
                    </div>
                    <ul class="list-disc ml-5 space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- GOOGLE SINGLE SIGN-ON (SSO) --}}
            <a href="{{ url('/auth/google') }}"
               class="w-full flex items-center justify-center gap-3 bg-white hover:bg-gray-50 text-gray-700 font-bold py-3.5 px-4 rounded-2xl border border-gray-300 hover:border-gray-400 shadow-sm hover:shadow-md transition-all duration-200 text-sm group">
                
                {{-- Official Google 4-Color SVG Icon --}}
                <svg class="w-5 h-5 group-hover:scale-105 transition-transform" viewBox="0 0 24 24">
                    <path fill="#4285F4" d="M23.745 12.27c0-.7-.06-1.4-.19-2.07H12v4.51h6.6c-.29 1.52-1.14 2.82-2.4 3.68v3.05h3.88c2.27-2.09 3.665-5.17 3.665-9.17z"/>
                    <path fill="#34A853" d="M12 24c3.24 0 5.95-1.08 7.93-2.91l-3.88-3.05c-1.08.72-2.45 1.16-4.05 1.16-3.12 0-5.77-2.1-6.72-4.93H1.25v3.15C3.26 21.36 7.33 24 12 24z"/>
                    <path fill="#FBBC05" d="M5.28 14.27c-.25-.72-.38-1.49-.38-2.27s.13-1.55.38-2.27V6.58H1.25C.45 8.18 0 9.98 0 12s.45 3.82 1.25 5.42l4.03-3.15z"/>
                    <path fill="#EA4335" d="M12 4.75c1.77 0 3.35.61 4.6 1.8l3.42-3.42C17.95 1.19 15.24 0 12 0 7.33 0 3.26 2.64 1.25 6.58l4.03 3.15c.95-2.83 3.6-4.93 6.72-4.93z"/>
                </svg>

                <span>Masuk dengan Google</span>
            </a>

            {{-- Divider --}}
            <div class="relative my-6 flex items-center justify-center">
                <div class="border-t border-gray-200 w-full"></div>
                <span class="bg-white px-3 text-xs font-semibold text-gray-400 uppercase tracking-wider absolute">
                    atau email manual
                </span>
            </div>

            {{-- LOGIN FORM --}}
            <form method="POST" action="{{ route('admin.authenticate') }}" class="space-y-4">
                @csrf

                {{-- Input Email --}}
                <div>
                    <label for="email" class="block text-xs font-extrabold text-gray-700 uppercase tracking-wider mb-2">
                        Alamat Email <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-gray-400">
                            <i class="fa-solid fa-envelope text-sm"></i>
                        </div>
                        <input type="email" 
                               id="email" 
                               name="email" 
                               value="{{ old('email') }}"
                               placeholder="nama@email.com"
                               class="w-full pl-10 pr-4 py-3 rounded-xl border border-gray-300 focus:border-green-600 focus:ring-2 focus:ring-green-100 outline-none transition text-sm text-gray-800 placeholder-gray-400 font-medium"
                               required 
                               autocomplete="email"
                               autofocus>
                    </div>
                </div>

                {{-- Input Password --}}
                <div>
                    <div class="flex items-center justify-between mb-2">
                        <label for="password" class="block text-xs font-extrabold text-gray-700 uppercase tracking-wider">
                            Kata Sandi <span class="text-red-500">*</span>
                        </label>
                    </div>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-gray-400">
                            <i class="fa-solid fa-lock text-sm"></i>
                        </div>
                        <input type="password" 
                               id="password" 
                               name="password"
                               placeholder="••••••••"
                               class="w-full pl-10 pr-11 py-3 rounded-xl border border-gray-300 focus:border-green-600 focus:ring-2 focus:ring-green-100 outline-none transition text-sm text-gray-800 placeholder-gray-400 font-medium"
                               required 
                               autocomplete="current-password">
                        
                        {{-- Show/Hide Password Toggle --}}
                        <button type="button" 
                                onclick="togglePasswordVisibility()" 
                                aria-label="Toggle Password Visibility"
                                class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-gray-400 hover:text-green-600 transition">
                            <i id="password-toggle-icon" class="fa-solid fa-eye text-sm"></i>
                        </button>
                    </div>
                </div>

                {{-- Remember Me & Info --}}
                <div class="flex items-center justify-between pt-1">
                    <label class="inline-flex items-center gap-2 cursor-pointer select-none">
                        <input type="checkbox" 
                               name="remember" 
                               class="w-4 h-4 rounded border-gray-300 text-green-600 focus:ring-green-500 cursor-pointer">
                        <span class="text-xs font-semibold text-gray-600">Ingat Saya</span>
                    </label>

                    <a href="https://wa.me/62{{ ltrim($settings['kontak_wa'] ?? '85314006568', '0') }}?text=Halo%20Admin,%20saya%20lupa%20kata%20sandi%20akun%20E-Rapor." 
                       target="_blank" rel="noopener noreferrer"
                       class="text-xs font-bold text-green-700 hover:text-green-800 hover:underline">
                        Lupa Password?
                    </a>
                </div>

                {{-- Submit Button --}}
                <div class="pt-2">
                    <button type="submit"
                            class="w-full inline-flex items-center justify-center gap-2 bg-gradient-to-r from-green-600 via-green-700 to-emerald-700 hover:from-green-700 hover:via-green-800 hover:to-emerald-800 text-white font-extrabold py-3.5 px-6 rounded-xl shadow-lg shadow-green-600/30 hover:shadow-xl hover:-translate-y-0.5 active:translate-y-0 transition-all duration-200 text-sm tracking-wide uppercase">
                        <span>MASUK KE SISTEM</span>
                        <i class="fa-solid fa-arrow-right text-xs"></i>
                    </button>
                </div>

            </form>

            {{-- Role Information Hint Card --}}
            <div class="mt-6 pt-5 border-t border-gray-100">
                <div class="bg-green-50/70 rounded-xl p-3.5 border border-green-100 flex items-start gap-3">
                    <i class="fa-solid fa-shield-halved text-green-600 text-sm mt-0.5"></i>
                    <p class="text-[11px] text-green-900 leading-relaxed font-medium">
                        Portal ini digunakan bersama oleh <strong>Administrator</strong> dan <strong>Guru Kelas (Ustadzah)</strong>.
                    </p>
                </div>
            </div>

        </div>

    </div>

</section>

{{-- Script for Toggle Password --}}
<script>
function togglePasswordVisibility() {
    const passwordInput = document.getElementById('password');
    const icon = document.getElementById('password-toggle-icon');
    
    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
    } else {
        passwordInput.type = 'password';
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
    }
}
</script>

@endsection