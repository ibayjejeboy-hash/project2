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
            <li><a href="{{ route('galeri') }}" class="text-white">GALERI</a></li>
            <li><a href="{{ route('pendaftaran') }}" class="hover:text-white">PENDAFTARAN</a></li>
            <li><a href="{{ route('erapor') }}" class="hover:text-white">E - RAPOR</a></li>
        </ul>

    </div>
</section>


{{-- ================= CONTENT ================= --}}
<section class="bg-gray-200 min-h-screen px-16 py-7">

    <div class="text-center mb-8">
        <h1 class="text-5xl font-extrabold">GALERI</h1>
        <h2 class="text-4xl font-bold">RA AL-MUSYAFFALLAH</h2>
    </div>

    {{-- GRID GALERI --}}
    <div class="grid md:grid-cols-3 gap-16">

    @foreach($galeris as $item)
    <div class="bg-white p-6 shadow-xl rounded-xl hover:scale-105 transition duration-300">

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
     class="hidden fixed inset-0 bg-black bg-opacity-80 flex items-center justify-center z-50">

    <span onclick="closeModal()" 
          class="absolute top-6 right-10 text-white text-4xl cursor-pointer">&times;</span>

    <img id="modalImage" class="max-w-4xl max-h-[80vh] rounded-xl shadow-2xl">

</div>


<script>
function openModal(src) {
    document.getElementById('modalImage').src = src;
    document.getElementById('imageModal').classList.remove('hidden');
}

function closeModal() {
    document.getElementById('imageModal').classList.add('hidden');
}
</script>

@endsection