@extends('layouts.app')

@section('content')

{{-- ================= HEADER ================= --}}
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
            <li><a href="{{ route('galeri') }}" class="text-green-600 hover:text-green-800 transition">GALERI</a></li>
            <li><a href="{{ route('pendaftaran') }}" class="hover:text-green-600 transition">PENDAFTARAN</a></li>
            <li>
                <a href="{{ route('erapor') }}" class="inline-flex items-center gap-1.5 px-4 py-2 bg-green-600 hover:bg-green-700 text-white font-bold rounded-xl shadow-sm hover:shadow-md transition">
                    E-RAPOR
                </a>
            </li>
        </ul>

        {{-- Hamburger (Mobile) --}}
        <button class="md:hidden text-gray-700 hover:text-green-600 focus:outline-none p-1.5 hover:bg-gray-100 rounded-lg transition" onclick="toggleGaleriMenu()">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
            </svg>
        </button>

    </div>

    {{-- Mobile Menu --}}
    <div id="galeri-mobile-menu" class="hidden md:hidden bg-white/95 backdrop-blur-md px-6 py-4 space-y-3 font-extrabold text-sm border-t border-green-50 shadow-lg">
        <a href="{{ route('home') }}" class="block py-2 text-gray-700 hover:text-green-600 border-b border-gray-100">HOME</a>
        <a href="{{ route('galeri') }}" class="block py-2 text-green-600 hover:text-green-800 border-b border-gray-100">GALERI</a>
        <a href="{{ route('pendaftaran') }}" class="block py-2 text-gray-700 hover:text-green-600 border-b border-gray-100">PENDAFTARAN</a>
        <a href="{{ route('erapor') }}" class="block py-2.5 text-center bg-green-600 text-white rounded-xl shadow-sm">E-RAPOR</a>
    </div>
</header>


{{-- ================= CONTENT ================= --}}
<section class="bg-gray-50 min-h-screen px-6 py-12 md:px-16">

    <div class="text-center mb-12">
        <span class="text-xs font-extrabold text-green-600 uppercase tracking-widest">Klip Aktivitas</span>
        <h1 class="text-3xl md:text-5xl font-black text-gray-900 mt-2">GALERI KEGIATAN</h1>
        <div class="w-12 h-1 bg-green-600 mx-auto rounded-full mt-4"></div>
    </div>

    {{-- GRID GALERI --}}
    <div class="max-w-7xl mx-auto grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">

        @foreach($galeris as $item)
        <div class="bg-white p-4 shadow-sm border border-gray-100 rounded-2xl hover:shadow-md hover:scale-102 transition duration-300 group">

            <div class="overflow-hidden rounded-xl h-56 relative">
                <img src="{{ asset('storage/'.$item->gambar) }}"
                     onclick="openModal(this.src)"
                     class="cursor-zoom-in w-full h-full object-cover group-hover:scale-105 transition duration-500">
                <div class="absolute inset-0 bg-black/10 opacity-0 group-hover:opacity-100 pointer-events-none transition duration-300"></div>
            </div>

            <p class="text-center mt-4 font-bold text-gray-800 group-hover:text-green-700 transition">
                {{ $item->judul }}
            </p>

        </div>
        @endforeach

    </div>

</section>


{{-- ================= MODAL IMAGE ================= --}}
<div id="imageModal"
     class="hidden fixed inset-0 bg-black/95 backdrop-blur-sm flex items-center justify-center z-50 p-4 transition duration-300">

    <button onclick="closeModal()"
          class="absolute top-6 right-6 text-white hover:text-green-400 text-4xl font-bold cursor-pointer transition p-2 bg-white/10 hover:bg-white/20 rounded-full w-12 h-12 flex items-center justify-center">&times;</button>

    <img id="modalImage" class="max-w-full md:max-w-5xl max-h-[85vh] rounded-2xl shadow-2xl border-4 border-white/10">

</div>


<script>
function openModal(src) {
    document.getElementById('modalImage').src = src;
    document.getElementById('imageModal').classList.remove('hidden');
    document.body.style.overflow = 'hidden';
}

function closeModal() {
    document.getElementById('imageModal').classList.add('hidden');
    document.body.style.overflow = '';
}

function toggleGaleriMenu() {
    const menu = document.getElementById('galeri-mobile-menu');
    menu.classList.toggle('hidden');
}
</script>

@endsection