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
            <li><a href="{{ route('galeri') }}" class="text-white">GALERI</a></li>
            <li><a href="{{ route('pendaftaran') }}" class="hover:text-white">PENDAFTARAN</a></li>
            <li><a href="{{ route('erapor') }}" class="hover:text-white">E - RAPOR</a></li>
        </ul>

        {{-- Hamburger (Mobile) --}}
        <button class="md:hidden text-gray-800 focus:outline-none" onclick="toggleGaleriMenu()">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
            </svg>
        </button>

    </div>

    {{-- Mobile Menu --}}
    <div id="galeri-mobile-menu" class="hidden md:hidden bg-green-500 px-4 pb-4 space-y-2 font-extrabold text-base">
        <a href="{{ route('home') }}" class="block py-2 text-white border-b border-green-400">HOME</a>
        <a href="{{ route('galeri') }}" class="block py-2 text-white border-b border-green-400">GALERI</a>
        <a href="{{ route('pendaftaran') }}" class="block py-2 text-white border-b border-green-400">PENDAFTARAN</a>
        <a href="{{ route('erapor') }}" class="block py-2 text-white">E - RAPOR</a>
    </div>
</section>


{{-- ================= CONTENT ================= --}}
<section class="bg-gray-200 min-h-screen px-4 md:px-16 py-7">

    <div class="text-center mb-8">
        <h1 class="text-3xl md:text-5xl font-extrabold">GALERI</h1>
        <h2 class="text-2xl md:text-4xl font-bold">RA AL-MUSYAFFALLAH</h2>
    </div>

    {{-- GRID GALERI --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 md:gap-16">

    @foreach($galeris as $item)
    <div class="bg-white p-4 md:p-6 shadow-xl rounded-xl hover:scale-105 transition duration-300">

        <img src="{{ asset('storage/'.$item->gambar) }}"
             onclick="openModal(this.src)"
             class="cursor-pointer w-full h-[200px] object-cover rounded-lg">

        <p class="text-center mt-3 font-bold">
            {{ $item->judul }}
        </p>

    </div>
    @endforeach

</div>

    </div>

</section>


{{-- ================= MODAL IMAGE ================= --}}
<div id="imageModal"
     class="hidden fixed inset-0 bg-black bg-opacity-80 flex items-center justify-center z-50 p-4">

    <span onclick="closeModal()"
          class="absolute top-6 right-10 text-white text-4xl cursor-pointer">&times;</span>

    <img id="modalImage" class="max-w-full md:max-w-4xl max-h-[80vh] rounded-xl shadow-2xl">

</div>


<script>
function openModal(src) {
    document.getElementById('modalImage').src = src;
    document.getElementById('imageModal').classList.remove('hidden');
}

function closeModal() {
    document.getElementById('imageModal').classList.add('hidden');
}

function toggleGaleriMenu() {
    const menu = document.getElementById('galeri-mobile-menu');
    menu.classList.toggle('hidden');
}
</script>

@endsection