@extends('layouts.app')

@section('title', 'Portal E-Rapor Digital - RA Al Musyaffallah')

@section('content')

{{-- ================= HEADER ================= --}}
@include('layouts.navbar')

{{-- ================= CONTENT ================= --}}
<section class="bg-gradient-to-b from-green-50/50 via-gray-50 to-white min-h-[75vh] py-16 px-4 sm:px-6 lg:px-8 flex items-center">
    <div class="max-w-4xl mx-auto w-full">

        {{-- Heading --}}
        <div class="text-center mb-12 space-y-3">
            <span class="text-xs font-extrabold text-green-700 uppercase tracking-widest bg-green-100 px-3.5 py-1.5 rounded-full border border-green-200">
                Sistem Penilaian Akademik
            </span>
            <h1 class="text-3xl sm:text-5xl font-black text-gray-900 mt-2">
                PORTAL E - RAPOR DIGITAL
            </h1>
            <p class="text-sm sm:text-base text-gray-600 font-medium">
                Tahun Ajaran 2025/2026 • Kurikulum Merdeka PAUD & Nilai P5-PPRA
            </p>
            <div class="w-16 h-1 bg-green-600 mx-auto rounded-full mt-3"></div>
        </div>

        {{-- Card Login Gateway --}}
        <div class="bg-white p-8 sm:p-12 rounded-3xl shadow-xl border border-gray-100 max-w-xl mx-auto text-center relative overflow-hidden group">
            <div class="absolute top-0 right-0 w-32 h-32 bg-green-500/10 rounded-full blur-2xl pointer-events-none"></div>

            {{-- Logo --}}
            <div class="relative mb-6">
                <img src="{{ asset('assets/images/1001230752.jpg - Edited.png') }}"
                     alt="Logo RA Al Musyaffallah"
                     class="w-32 h-32 mx-auto object-contain drop-shadow-lg group-hover:scale-105 transition-transform duration-300">
            </div>

            <h2 class="text-xl sm:text-2xl font-black text-gray-800 mb-2">
                Masuk ke Akun Anda
            </h2>
            <p class="text-xs sm:text-sm text-gray-500 mb-8 max-w-sm mx-auto">
                Silakan login menggunakan akun Administrator, Ustadzah (Guru Kelas), atau Akun Siswa.
            </p>

            @auth
                @if(auth()->user()->role === 'siswa')
                    @php $siswaAuth = \App\Models\Siswa::where('user_id', auth()->id())->first(); @endphp
                    <a href="{{ $siswaAuth ? route('erapor.hasil', $siswaAuth->uuid ?? $siswaAuth->id) : route('siswa.dashboard') }}"
                       class="w-full inline-flex items-center justify-center gap-2.5 bg-gradient-to-r from-green-600 to-emerald-700 hover:from-green-700 hover:to-emerald-800 text-white px-8 py-4 rounded-2xl font-bold shadow-lg hover:shadow-xl hover:-translate-y-0.5 transition duration-200 text-base">
                        <i class="fa-solid fa-graduation-cap"></i>
                        <span>Lihat Rapor Siswa Saya</span>
                    </a>
                @else
                    <a href="{{ route('erapor.dashboard') }}"
                       class="w-full inline-flex items-center justify-center gap-2.5 bg-gradient-to-r from-green-600 to-emerald-700 hover:from-green-700 hover:to-emerald-800 text-white px-8 py-4 rounded-2xl font-bold shadow-lg hover:shadow-xl hover:-translate-y-0.5 transition duration-200 text-base">
                        <i class="fa-solid fa-chart-pie"></i>
                        <span>Buka Dashboard E-Rapor ({{ auth()->user()->name }})</span>
                    </a>
                @endif
            @else
                <a href="{{ route('admin.login') }}"
                   class="w-full inline-flex items-center justify-center gap-2.5 bg-gradient-to-r from-green-600 to-emerald-700 hover:from-green-700 hover:to-emerald-800 text-white px-8 py-4 rounded-2xl font-bold shadow-lg hover:shadow-xl hover:-translate-y-0.5 transition duration-200 text-base">
                    <i class="fa-solid fa-right-to-bracket"></i>
                    <span>Masuk / Login Sekarang</span>
                </a>
            @endauth

            <div class="mt-6 pt-6 border-t border-gray-100 flex items-center justify-center gap-2 text-xs text-gray-400">
                <i class="fa-solid fa-shield-halved text-green-600"></i>
                <span>Sistem Terenkripsi & Terintegrasi</span>
            </div>
        </div>

    </div>
</section>

{{-- ================= FOOTER ================= --}}
@include('layouts.footer')

@endsection