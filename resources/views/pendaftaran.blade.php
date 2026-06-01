@extends('layouts.app')

@section('content')

{{-- ================= HEADER (SAMA KAYA GALERI) ================= --}}
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
            <li><a href="{{ route('pendaftaran') }}" class="text-green-600">PENDAFTARAN</a></li>
            <li>
                <a href="{{ route('erapor') }}" class="inline-flex items-center px-4 py-2 bg-green-600 hover:bg-green-700 text-white font-bold rounded-xl shadow-sm transition">
                    E-RAPOR
                </a>
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
        <a href="{{ route('pendaftaran') }}" class="block text-green-600">PENDAFTARAN</a>
        <a href="{{ route('erapor') }}" class="block bg-green-600 text-white text-center py-2 rounded-lg">E-RAPOR</a>
    </div>
</header>


{{-- ================= CONTENT ================= --}}
<section class="bg-gray-50 min-h-screen px-6 py-12 md:px-16">

    {{-- Judul --}}
    <div class="text-center mb-12">
        <span class="text-xs font-extrabold text-green-600 uppercase tracking-widest">PPDB</span>
        <h1 class="text-3xl md:text-5xl font-black text-gray-900 mt-2">
            PENDAFTARAN SISWA BARU
        </h1>
        <p class="mt-4 text-gray-600 max-w-2xl mx-auto">
            Tahun Ajaran 2026/2027
        </p>
        <div class="w-12 h-1 bg-green-600 mx-auto rounded-full mt-4"></div>
    </div>

    {{-- Deskripsi --}}
    <div class="max-w-4xl mx-auto text-center text-gray-700 font-medium mb-16 leading-relaxed">
        Kami membuka kesempatan bagi calon peserta didik untuk bergabung bersama kami.
        Jadilah bagian dari lingkungan belajar yang unggul, islami, dan menyenangkan.
    </div>

    {{-- Card Section --}}
    <div class="max-w-7xl mx-auto grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">

        {{-- Card --}}
        <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm hover:shadow-md hover:-translate-y-1 transition duration-300 text-center">
            <h3 class="text-xl font-bold text-gray-800 mb-3">ALUR PENDAFTARAN</h3>
            <p class="text-gray-600 mb-6">
                Pelajari langkah-langkah pendaftaran sebelum melakukan registrasi.
            </p>
            <a href="{{ route('pendaftaran.alur') }}"
   class="bg-green-600 text-white px-6 py-2 rounded-xl font-bold hover:bg-green-700 transition">
    Selengkapnya
</a>

        <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm hover:shadow-md hover:-translate-y-1 transition duration-300 text-center">
            <h3 class="text-xl font-bold text-gray-800 mb-3">SYARAT PENDAFTARAN</h3>
            <p class="text-gray-600 mb-6">
                Ketahui syarat dan ketentuan yang harus dipenuhi oleh calon siswa.
            </p>
            <button class="bg-green-600 text-white px-6 py-2 rounded-xl font-bold hover:bg-green-700 transition">
                Selengkapnya
            </button>
        </div>

        <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm hover:shadow-md hover:-translate-y-1 transition duration-300 text-center">
            <h3 class="text-xl font-bold text-gray-800 mb-3">PANDUAN PENDAFTARAN</h3>
            <p class="text-gray-600 mb-6">
                Panduan lengkap penggunaan sistem PPDB online.
            </p>
            <button class="bg-green-600 text-white px-6 py-2 rounded-xl font-bold hover:bg-green-700 transition">
                Selengkapnya
            </button>
        </div>

    </div>

</section>


<script>
function toggleMenu() {
    document.getElementById('mobile-menu').classList.toggle('hidden');
}
</script>

@endsection