@extends('layouts.app')

@section('title', 'Galeri Kegiatan Siswa - RA Al Musyaffallah')

@section('content')

{{-- ================= HEADER ================= --}}
@include('layouts.navbar')

{{-- ================= CONTENT ================= --}}
<section class="bg-gray-50 min-h-screen py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto">

        {{-- Page Heading --}}
        <div class="text-center mb-14 space-y-3">
            <span class="text-xs font-extrabold text-green-700 uppercase tracking-widest bg-green-100 px-3.5 py-1.5 rounded-full border border-green-200">
                Dokumentasi & Portofolio
            </span>
            <h1 class="text-3xl sm:text-5xl font-black text-gray-900 mt-2">
                GALERI KEGIATAN SISWA
            </h1>
            <p class="text-sm sm:text-base text-gray-600 max-w-2xl mx-auto">
                Kumpulan momen keceriaan, kreativitas, dan pembelajaran karakter islami peserta didik RA Al Musyaffallah.
            </p>
            <div class="w-16 h-1 bg-green-600 mx-auto rounded-full mt-3"></div>
        </div>

        {{-- GRID GALERI --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
            @forelse($galeris as $item)
            <div class="bg-white p-4 shadow-sm border border-gray-100 rounded-3xl hover:shadow-xl hover:-translate-y-1 transition duration-300 group">
                <div class="overflow-hidden rounded-2xl h-60 relative bg-gray-100">
                    <img src="{{ asset('storage/'.$item->gambar) }}"
                         alt="{{ $item->judul }}"
                         onclick="openModal(this.src)"
                         class="cursor-zoom-in w-full h-full object-cover group-hover:scale-105 transition duration-500">
                    <div class="absolute inset-0 bg-black/25 opacity-0 group-hover:opacity-100 pointer-events-none transition duration-300 flex items-center justify-center">
                        <span class="px-4 py-2 bg-white/90 text-gray-900 text-xs font-bold rounded-xl shadow-lg">
                            <i class="fa-solid fa-magnifying-glass-plus mr-1 text-green-600"></i> Klik untuk Memperbesar
                        </span>
                    </div>
                </div>

                <div class="pt-4 pb-1 text-center">
                    <h3 class="font-bold text-gray-800 text-base group-hover:text-green-700 transition">
                        {{ $item->judul }}
                    </h3>
                </div>
            </div>
            @empty
            <div class="col-span-1 sm:col-span-2 md:col-span-3 text-center py-20 bg-white rounded-3xl border border-dashed border-gray-200">
                <div class="w-16 h-16 rounded-2xl bg-gray-100 text-gray-400 flex items-center justify-center mx-auto mb-4 text-2xl">
                    <i class="fa-solid fa-camera"></i>
                </div>
                <h3 class="text-base font-bold text-gray-700">Belum ada foto galeri</h3>
                <p class="text-xs text-gray-500 mt-1">Foto aktivitas sekolah akan segera diunggah oleh pihak admin.</p>
            </div>
            @endforelse
        </div>

    </div>
</section>

{{-- ================= MODAL IMAGE VIEWER ================= --}}
<div id="imageModal"
     class="hidden fixed inset-0 bg-black/95 backdrop-blur-md flex items-center justify-center z-50 p-4 transition-all duration-300"
     onclick="closeModal()">

    <button onclick="closeModal()"
            aria-label="Tutup Pratinjau"
            class="absolute top-6 right-6 text-white hover:text-green-400 text-3xl font-bold cursor-pointer transition p-2 bg-white/10 hover:bg-white/20 rounded-full w-12 h-12 flex items-center justify-center">
        <i class="fa-solid fa-xmark"></i>
    </button>

    <img id="modalImage" 
         class="max-w-full md:max-w-5xl max-h-[85vh] rounded-2xl shadow-2xl border-4 border-white/10"
         onclick="event.stopPropagation()">
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
</script>

{{-- ================= FOOTER ================= --}}
@include('layouts.footer')

@endsection