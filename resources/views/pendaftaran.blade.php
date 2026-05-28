@extends('layouts.app')

@section('content')

{{-- ================= HEADER ================= --}}
<section class="bg-gradient-to-r from-lime-300 to-green-500">
    <div class="flex justify-between items-center px-16 py-6">

        <div class="flex items-center gap-4">
            <img src="{{ asset('assets/images/1001230752.jpg - Edited.png') }}" class="w-16">
        </div>

        <ul class="flex gap-12 font-extrabold text-lg tracking-wide">
            <li><a href="{{ route('home') }}" class="hover:text-white">HOME</a></li>
            <li><a href="{{ route('galeri') }}" class="hover:text-white">GALERI</a></li>
            <li><a href="{{ route('pendaftaran') }}" class="text-white">PENDAFTARAN</a></li>
            <li><a href="{{ route('erapor') }}" class="hover:text-white">E - RAPOR</a></li>
        </ul>

    </div>
</section>


{{-- ================= CONTENT ================= --}}
<section class="bg-gray-200 min-h-screen px-16 py-7">

    {{-- Judul --}}
    <div class="text-center mb-10">
        <h1 class="text-5xl font-extrabold mb-4">PENDAFTARAN</h1>
        <h2 class="text-4xl font-bold">
            Peserta Didik Baru Tahun Ajaran 2026/2027
        </h2>
    </div>

    {{-- Deskripsi --}}
    <div class="max-w-5xl mx-auto text-center text-xl font-semibold mb-20">
        Kami mengumumkan pembukaan penerimaan siswa baru untuk tahun ajaran 2025/2026.
        Kami mengundang para calon siswa yang berminat untuk bergabung dan menempuh
        pendidikan di Sekolah kami. Jangan lewatkan kesempatan ini untuk bergabung
        dengan komunitas belajar yang berkualitas Sekolah kami. Jadilah bagian dari
        perjalanan pendidikan yang unggul dan bermakna!
    </div>

    {{-- Card Section --}}
    <div class="grid md:grid-cols-3 gap-10">

        {{-- Card 1 --}}
        <div class="bg-green-500 p-8 rounded-lg shadow-xl text-center hover:scale-105 transition duration-300">
            <h3 class="text-2xl font-extrabold mb-4">ALUR PENDAFTARAN</h3>
            <p class="text-lg mb-6">
                Informasi mengenai alur pendaftaran sistem PPDB online
                silahkan pelajari terlebih dahulu.
            </p>
            <button class="bg-green-200 px-6 py-2 rounded-full font-bold hover:bg-white transition">
                SELENGKAPNYA
            </button>
        </div>

        {{-- Card 2 --}}
        <div class="bg-green-500 p-8 rounded-lg shadow-xl text-center hover:scale-105 transition duration-300">
            <h3 class="text-2xl font-extrabold mb-4">SYARAT PENDAFTARAN</h3>
            <p class="text-lg mb-12">
                Berikut ini adalah syarat dan ketentuan yang harus dipenuhi
                oleh calon pendaftar.
            </p>
            <button class="bg-green-200 px-6 py-2 rounded-full font-bold hover:bg-white transition">
                SELENGKAPNYA
            </button>
        </div>

        {{-- Card 3 --}}
        <div class="bg-green-500 p-8 rounded-lg shadow-xl text-center hover:scale-105 transition duration-300">
            <h3 class="text-2xl font-extrabold mb-4">PANDUAN PENDAFTARAN</h3>
            <p class="text-lg mb-6">
                Untuk mendapat informasi yang lebih lengkap panduan
                penggunaan PPDB Online.
            </p>
            <button class="bg-green-200 px-6 py-2 rounded-full font-bold hover:bg-white transition">
                SELENGKAPNYA
            </button>
        </div>

    </div>

</section>

@endsection