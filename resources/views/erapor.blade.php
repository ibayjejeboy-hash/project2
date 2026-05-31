@extends('layouts.app')

@section('content')

{{-- ================= HEADER (SAMA STYLE) ================= --}}
<header class="w-full bg-white/70 backdrop-blur-md border-b border-green-100 sticky top-0 z-50 transition duration-300">
    <div class="max-w-7xl mx-auto flex justify-between items-center px-6 py-4">

        {{-- Logo --}}
        <a href="{{ route('home') }}" class="flex items-center gap-3 group">
            <img src="{{ asset('assets/images/1001230752.jpg - Edited.png') }}" class="w-12 h-12 object-contain group-hover:scale-105 transition duration-300">
            <div>
                <span class="block font-black text-green-800 text-lg tracking-wider">AL MUSYAFFALLAH</span>
                <span class="block text-xs font-semibold text-green-600 uppercase tracking-widest -mt-1">Raudhatul Athfal</span>
            </div>
        </a>

        {{-- Desktop Menu --}}
        <ul class="hidden md:flex gap-8 lg:gap-12 font-extrabold text-sm tracking-wide text-gray-700 items-center">
            <li><a href="{{ route('home') }}" class="hover:text-green-600 transition">HOME</a></li>
            <li><a href="{{ route('galeri') }}" class="hover:text-green-600 transition">GALERI</a></li>
            <li><a href="{{ route('pendaftaran') }}" class="hover:text-green-600 transition">PENDAFTARAN</a></li>
            <li>
                <a href="{{ route('erapor') }}" class="text-green-600 font-bold">E-RAPOR</a>
            </li>
        </ul>

        {{-- Hamburger --}}
        <button class="md:hidden text-gray-700" onclick="toggleMenu()">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
            </svg>
        </button>

    </div>

    {{-- Mobile Menu --}}
    <div id="mobile-menu" class="hidden md:hidden bg-white px-6 py-4 space-y-3 text-sm font-bold border-t">
        <a href="{{ route('home') }}" class="block">HOME</a>
        <a href="{{ route('galeri') }}" class="block">GALERI</a>
        <a href="{{ route('pendaftaran') }}" class="block">PENDAFTARAN</a>
        <a href="{{ route('erapor') }}" class="block text-green-600">E-RAPOR</a>
    </div>
</header>


{{-- ================= CONTENT ================= --}}
<section class="bg-gray-50 min-h-screen px-6 py-12 md:px-16">

    {{-- Heading --}}
    <div class="text-center mb-12">
        <span class="text-xs font-extrabold text-green-600 uppercase tracking-widest">Sistem Akademik</span>
        <h1 class="text-3xl md:text-5xl font-black text-gray-900 mt-2">
            E - RAPOR
        </h1>
        <p class="mt-4 text-gray-600">
            Tahun Pelajaran 2025/2026
        </p>
        <div class="w-12 h-1 bg-green-600 mx-auto rounded-full mt-4"></div>
    </div>

    {{-- Card Tengah --}}
    <div class="flex justify-center">
        <div class="bg-white p-10 rounded-3xl shadow-md border border-gray-100 text-center hover:shadow-lg transition duration-300">

            {{-- Logo klik --}}
            <a href="{{ route('admin.login') }}">
                <img src="{{ asset('assets/images/1001230752.jpg - Edited.png') }}"
                     class="w-40 mx-auto drop-shadow-xl hover:scale-105 transition duration-300">
            </a>

            <h2 class="mt-6 text-xl font-bold text-gray-800">
                Masuk ke Sistem E-Rapor
            </h2>

            <p class="text-gray-500 mt-2 mb-6">
                Klik logo di atas untuk login sebagai admin / guru
            </p>

            {{-- Button alternatif --}}
            <a href="{{ route('admin.login') }}"
               class="inline-block bg-green-600 text-white px-6 py-2 rounded-xl font-bold hover:bg-green-700 transition">
                Login Sekarang
            </a>

        </div>
    </div>

</section>


<script>
function toggleMenu() {
    document.getElementById('mobile-menu').classList.toggle('hidden');
}
</script>

@endsection