@extends('layouts.app')

@section('content')

{{-- ================= HEADER ================= --}}
<section class="bg-gradient-to-r from-lime-300 to-green-500">
    <div class="flex justify-between items-center px-4 md:px-16 py-4 md:py-6">

        <div class="flex items-center gap-4">
            <img src="{{ asset('assets/images/1001230752.jpg - Edited.png') }}" class="w-12 md:w-16">
        </div>

        {{-- Desktop Menu --}}
        <ul class="hidden md:flex gap-8 lg:gap-12 font-extrabold text-lg tracking-wide">
            <li><a href="{{ route('home') }}" class="hover:text-white">HOME</a></li>
            <li><a href="{{ route('galeri') }}" class="hover:text-white">GALERI</a></li>
            <li><a href="{{ route('pendaftaran') }}" class="text-white">PENDAFTARAN</a></li>
            <li><a href="{{ route('erapor') }}" class="hover:text-white">E - RAPOR</a></li>
        </ul>

        {{-- Hamburger (Mobile) --}}
        <button class="md:hidden text-gray-800 focus:outline-none" onclick="togglePendaftaranMenu()">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
            </svg>
        </button>

    </div>

    {{-- Mobile Menu --}}
    <div id="pendaftaran-mobile-menu" class="hidden md:hidden bg-green-500 px-4 pb-4 space-y-2 font-extrabold text-base">
        <a href="{{ route('home') }}" class="block py-2 text-white border-b border-green-400">HOME</a>
        <a href="{{ route('galeri') }}" class="block py-2 text-white border-b border-green-400">GALERI</a>
        <a href="{{ route('pendaftaran') }}" class="block py-2 text-white border-b border-green-400">PENDAFTARAN</a>
        <a href="{{ route('erapor') }}" class="block py-2 text-white">E - RAPOR</a>
    </div>
</section>


{{-- ================= CONTENT ================= --}}
<section class="bg-gray-200 min-h-screen px-4 md:px-16 py-7">

    {{-- Judul --}}
    <div class="text-center mb-8 md:mb-10">
        <h1 class="text-3xl md:text-5xl font-extrabold mb-3 md:mb-4">PENDAFTARAN</h1>
        <h2 class="text-xl md:text-4xl font-bold">
            Peserta Didik Baru Tahun Ajaran 2026/2027
        </h2>
    </div>

    {{-- Deskripsi --}}
    <div class="max-w-5xl mx-auto text-center text-base md:text-xl font-semibold mb-10 md:mb-20">
        Kami mengumumkan pembukaan penerimaan siswa baru untuk tahun ajaran 2025/2026.
        Kami mengundang para calon siswa yang berminat untuk bergabung dan menempuh
        pendidikan di Sekolah kami. Jangan lewatkan kesempatan ini untuk bergabung
        dengan komunitas belajar yang berkualitas Sekolah kami. Jadilah bagian dari
        perjalanan pendidikan yang unggul dan bermakna!
    </div>

    {{-- Card Section --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 md:gap-10">

        {{-- Card 1 --}}
        <div class="bg-green-500 p-6 md:p-8 rounded-lg shadow-xl text-center hover:scale-105 transition duration-300">
            <h3 class="text-xl md:text-2xl font-extrabold mb-3 md:mb-4">ALUR PENDAFTARAN</h3>
            <p class="text-base md:text-lg mb-4 md:mb-6">
                Informasi mengenai alur pendaftaran sistem PPDB online
                silahkan pelajari terlebih dahulu.
            </p>
            <button class="bg-green-200 px-6 py-2 rounded-full font-bold hover:bg-white transition">
                SELENGKAPNYA
            </button>
        </div>

        {{-- Card 2 --}}
        <div class="bg-green-500 p-6 md:p-8 rounded-lg shadow-xl text-center hover:scale-105 transition duration-300">
            <h3 class="text-xl md:text-2xl font-extrabold mb-3 md:mb-4">SYARAT PENDAFTARAN</h3>
            <p class="text-base md:text-lg mb-6 md:mb-12">
                Berikut ini adalah syarat dan ketentuan yang harus dipenuhi
                oleh calon pendaftar.
            </p>
            <button class="bg-green-200 px-6 py-2 rounded-full font-bold hover:bg-white transition">
                SELENGKAPNYA
            </button>
        </div>

        {{-- Card 3 --}}
        <div class="bg-green-500 p-6 md:p-8 rounded-lg shadow-xl text-center hover:scale-105 transition duration-300">
            <h3 class="text-xl md:text-2xl font-extrabold mb-3 md:mb-4">PANDUAN PENDAFTARAN</h3>
            <p class="text-base md:text-lg mb-4 md:mb-6">
                Untuk mendapat informasi yang lebih lengkap panduan
                penggunaan PPDB Online.
            </p>
            <button class="bg-green-200 px-6 py-2 rounded-full font-bold hover:bg-white transition">
                SELENGKAPNYA
            </button>
        </div>

    </div>

</section>

<script>
function togglePendaftaranMenu() {
    const menu = document.getElementById('pendaftaran-mobile-menu');
    menu.classList.toggle('hidden');
}
</script>

@endsection