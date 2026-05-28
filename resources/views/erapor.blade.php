@extends('layouts.app')

@section('content')

{{-- ================= HEADER ================= --}}
<section class="bg-gradient-to-r from-lime-300 to-green-500">

    <div class="flex justify-between items-center px-16 py-6">

        {{-- Nama Sekolah --}}
        <h1 class="text-3xl font-extrabold">
            RA Al - Musyaffallah
        </h1>

        {{-- Menu --}}
        <ul class="flex gap-12 font-extrabold text-lg tracking-wide">
            <li><a href="{{ route('home') }}" class="hover:text-white">HOME</a></li>
            <li><a href="{{ route('galeri') }}" class="hover:text-white">GALERI</a></li>
            <li><a href="{{ route('pendaftaran') }}" class="hover:text-white">PENDAFTARAN</a></li>
            <li><a href="{{ route('erapor') }}" class="hover:text-white">E - RAPOR</a></li>
        </ul>

    </div>

</section>


{{-- ================= CONTENT ================= --}}
<section class="bg-gray-200 min-h-screen px-16 py-16">

    {{-- Judul Tengah --}}
    <div class="text-center">

        <h1 class="text-3xl md:text-4xl font-extrabold mb-10">
            E - Rapor Tahun Pelajaran 2025-2026
        </h1>

        {{-- Logo --}}
        <div class="flex justify-center">
           <a href="{{ route('admin.login') }}">
    <img src="{{ asset('assets/images/1001230752.jpg - Edited.png') }}"
    class="w-[200px] drop-shadow-2xl hover:scale-105 transition duration-300">
</a>
        </div>

    </div>

</section>

@endsection