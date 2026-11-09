@extends('layouts.app')

@section('title', 'Galeri Dokumentasi Kegiatan Siswa & Guru - RA Al-Musyafallahi')

@section('content')

{{-- ================= HEADER ================= --}}
@include('layouts.navbar')

{{-- ================= CONTENT ================= --}}
<section class="bg-slate-50 min-h-screen py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto space-y-10">

        {{-- Page Heading --}}
        <div class="text-center space-y-3">
            <span class="inline-flex items-center gap-1.5 text-xs font-black text-green-800 uppercase tracking-widest bg-green-100 px-4 py-1.5 rounded-full border border-green-200 shadow-sm">
                <i class="fa-solid fa-camera-retro"></i> Dokumentasi & Portofolio Digital
            </span>
            <h1 class="text-3xl sm:text-5xl font-black text-slate-900 tracking-tight">
                GALERI AKTIVITAS SEKOLAH
            </h1>
            <p class="text-xs sm:text-base text-slate-600 max-w-2xl mx-auto font-medium leading-relaxed">
                Koleksi foto digital kegiatan siswa dan guru RA Al-Musyafallahi. Momen keceriaan, belajar kreatif, dan pembinaan karakter Islami yang dapat dilihat serta dicetak resmi.
            </p>
            <div class="w-20 h-1.5 bg-gradient-to-r from-green-600 to-emerald-500 mx-auto rounded-full mt-2"></div>
        </div>

        {{-- ================= FILTER TABS & PRINT ACTION ================= --}}
        <div class="bg-white p-4 sm:p-5 rounded-3xl border border-slate-100 shadow-sm flex flex-col md:flex-row items-center justify-between gap-4">
            
            {{-- Category Filter Tabs --}}
            <div class="flex flex-wrap items-center gap-2 w-full md:w-auto">
                {{-- Tab: Semua --}}
                <a href="{{ route('galeri') }}"
                   class="inline-flex items-center gap-2 px-4 py-2.5 rounded-2xl text-xs sm:text-sm font-black transition duration-200 {{ !$kategori ? 'bg-green-700 text-white shadow-md shadow-green-700/20' : 'bg-slate-100 text-slate-600 hover:bg-slate-200' }}">
                    <i class="fa-solid fa-border-all"></i>
                    <span>Semua Foto</span>
                    <span class="px-2 py-0.5 rounded-full text-[11px] {{ !$kategori ? 'bg-white/20 text-white' : 'bg-slate-200 text-slate-700' }}">
                        {{ $countTotal }}
                    </span>
                </a>

                {{-- Tab: Kegiatan Siswa --}}
                <a href="{{ route('galeri', ['kategori' => 'kegiatan_siswa']) }}"
                   class="inline-flex items-center gap-2 px-4 py-2.5 rounded-2xl text-xs sm:text-sm font-black transition duration-200 {{ $kategori === 'kegiatan_siswa' ? 'bg-emerald-600 text-white shadow-md shadow-emerald-600/20' : 'bg-slate-100 text-slate-600 hover:bg-emerald-50 hover:text-emerald-700' }}">
                    <i class="fa-solid fa-shapes"></i>
                    <span>Kegiatan Siswa</span>
                    <span class="px-2 py-0.5 rounded-full text-[11px] {{ $kategori === 'kegiatan_siswa' ? 'bg-white/20 text-white' : 'bg-slate-200 text-slate-700' }}">
                        {{ $countSiswa }}
                    </span>
                </a>

                {{-- Tab: Kegiatan Guru --}}
                <a href="{{ route('galeri', ['kategori' => 'kegiatan_guru']) }}"
                   class="inline-flex items-center gap-2 px-4 py-2.5 rounded-2xl text-xs sm:text-sm font-black transition duration-200 {{ $kategori === 'kegiatan_guru' ? 'bg-purple-700 text-white shadow-md shadow-purple-700/20' : 'bg-slate-100 text-slate-600 hover:bg-purple-50 hover:text-purple-700' }}">
                    <i class="fa-solid fa-chalkboard-user"></i>
                    <span>Kegiatan Guru</span>
                    <span class="px-2 py-0.5 rounded-full text-[11px] {{ $kategori === 'kegiatan_guru' ? 'bg-white/20 text-white' : 'bg-slate-200 text-slate-700' }}">
                        {{ $countGuru }}
                    </span>
                </a>
            </div>

            {{-- Action Print Button --}}
            <div class="flex items-center gap-2 w-full md:w-auto justify-end">
                <a href="{{ route('galeri.cetak', ['kategori' => $kategori]) }}" 
                   target="_blank"
                   class="w-full md:w-auto inline-flex items-center justify-center gap-2 px-5 py-2.5 bg-gradient-to-r from-slate-900 to-slate-800 hover:from-slate-800 hover:to-slate-700 text-white rounded-2xl text-xs sm:text-sm font-black shadow-md hover:shadow-lg transition duration-200">
                    <i class="fa-solid fa-print text-green-400"></i>
                    <span>Cetak Lembar Dokumen (Print Out)</span>
                </a>
            </div>

        </div>

        {{-- ================= GRID GALERI ================= --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-7">
            @forelse($galeris as $index => $item)
            <div class="bg-white rounded-3xl p-4 shadow-sm border border-slate-100 hover:shadow-xl hover:-translate-y-1 transition duration-300 flex flex-col justify-between group">
                
                {{-- Foto Digital Container --}}
                <div class="overflow-hidden rounded-2xl h-64 relative bg-slate-100 cursor-pointer"
                     onclick="openGalleryModal({{ $index }})">
                    <img src="{{ $item->gambar_url }}"
                         alt="{{ $item->judul }}"
                         class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                    
                    {{-- Badges on top of Image --}}
                    <div class="absolute top-3 left-3 right-3 flex items-center justify-between gap-2 pointer-events-none">
                        <span class="px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-wider backdrop-blur-md shadow-sm {{ $item->kategori === 'kegiatan_guru' ? 'bg-purple-900/90 text-purple-100 border border-purple-400/30' : 'bg-emerald-900/90 text-emerald-100 border border-emerald-400/30' }}">
                            {{ $item->kategori_label }}
                        </span>

                        @if($item->tanggal_kegiatan)
                        <span class="px-2.5 py-1 rounded-full text-[10px] font-bold bg-black/60 text-white backdrop-blur-md shadow-sm">
                            <i class="fa-regular fa-calendar text-[9px] mr-1"></i>
                            {{ $item->tanggal_kegiatan->format('d/m/Y') }}
                        </span>
                        @endif
                    </div>

                    {{-- Hover Overlay --}}
                    <div class="absolute inset-0 bg-slate-950/40 opacity-0 group-hover:opacity-100 transition duration-300 flex items-center justify-center p-4">
                        <span class="px-4 py-2 bg-white/95 text-slate-900 text-xs font-black rounded-xl shadow-lg flex items-center gap-1.5 transform translate-y-2 group-hover:translate-y-0 transition duration-300">
                            <i class="fa-solid fa-magnifying-glass-plus text-green-600"></i>
                            <span>Buka Foto Digital</span>
                        </span>
                    </div>
                </div>

                {{-- Keterangan Judul & Deskripsi --}}
                <div class="pt-4 pb-2 space-y-2 flex-1 flex flex-col justify-between">
                    <div>
                        <h3 class="font-extrabold text-slate-800 text-sm sm:text-base leading-snug group-hover:text-green-700 transition">
                            {{ $item->judul }}
                        </h3>
                        @if($item->deskripsi)
                        <p class="text-xs text-slate-500 line-clamp-2 mt-1 leading-relaxed">
                            {{ $item->deskripsi }}
                        </p>
                        @endif
                    </div>

                    {{-- Card Footer Actions --}}
                    <div class="pt-3 border-t border-slate-100 flex items-center justify-between gap-2 text-xs">
                        <a href="{{ route('galeri.cetak.single', $item->id) }}" 
                           target="_blank"
                           title="Cetak Lembar Dokumen Resmi Foto Ini"
                           class="inline-flex items-center gap-1.5 text-slate-600 hover:text-green-700 font-bold py-1 px-2.5 rounded-lg hover:bg-green-50 transition">
                            <i class="fa-solid fa-print text-green-600"></i>
                            <span>Print Dokumen</span>
                        </a>

                        <a href="{{ $item->gambar_url }}" 
                           download="{{ \Illuminate\Support\Str::slug($item->judul) }}.jpg"
                           title="Unduh Berkas Foto Digital"
                           class="inline-flex items-center gap-1.5 text-slate-600 hover:text-blue-600 font-bold py-1 px-2.5 rounded-lg hover:bg-blue-50 transition">
                            <i class="fa-solid fa-arrow-down-to-bracket text-blue-600"></i>
                            <span>Unduh Foto</span>
                        </a>
                    </div>
                </div>

            </div>
            @empty
            <div class="col-span-full py-16 bg-white rounded-3xl border border-dashed border-slate-200 text-center space-y-3">
                <div class="w-16 h-16 rounded-2xl bg-slate-100 text-slate-400 flex items-center justify-center mx-auto text-3xl">
                    <i class="fa-solid fa-camera"></i>
                </div>
                <h3 class="text-base font-bold text-slate-800">Belum ada foto kegiatan di kategori ini</h3>
                <p class="text-xs text-slate-500 max-w-md mx-auto">
                    Foto dokumentasi akan segera diperbarui oleh pihak sekolah.
                </p>
                <a href="{{ route('galeri') }}" class="inline-block mt-2 px-5 py-2 bg-slate-100 hover:bg-slate-200 text-slate-700 rounded-xl text-xs font-bold transition">
                    Lihat Semua Foto
                </a>
            </div>
            @endforelse
        </div>

    </div>
</section>

{{-- ================= MODAL DIGITAL PHOTO VIEWER (INTERACTIVE LIGHTBOX) ================= --}}
<div id="galleryModal"
     class="hidden fixed inset-0 bg-slate-950/90 backdrop-blur-md flex flex-col justify-between z-50 p-4 sm:p-6 transition-all duration-300"
     onclick="closeGalleryModal()">

    {{-- Top Bar Controls --}}
    <div class="flex items-center justify-between text-white max-w-6xl mx-auto w-full pb-3 border-b border-white/10"
         onclick="event.stopPropagation()">
        <div class="space-y-0.5">
            <span id="modalKategori" class="px-2.5 py-0.5 rounded-full text-[10px] font-black uppercase tracking-wider bg-green-500 text-white"></span>
            <h3 id="modalTitle" class="text-sm sm:text-lg font-bold text-white truncate max-w-md sm:max-w-xl"></h3>
            <span id="modalDate" class="text-xs text-white/70 block"></span>
        </div>

        <div class="flex items-center gap-2">
            {{-- Print Button --}}
            <a id="modalPrintBtn" 
               href="#" 
               target="_blank" 
               class="px-3.5 py-2 rounded-xl bg-white/10 hover:bg-white/20 text-white text-xs font-bold transition flex items-center gap-1.5">
                <i class="fa-solid fa-print text-green-400"></i>
                <span class="hidden sm:inline">Print Dokumen</span>
            </a>

            {{-- Download Button --}}
            <a id="modalDownloadBtn" 
               href="#" 
               download 
               class="px-3.5 py-2 rounded-xl bg-white/10 hover:bg-white/20 text-white text-xs font-bold transition flex items-center gap-1.5">
                <i class="fa-solid fa-download text-blue-400"></i>
                <span class="hidden sm:inline">Unduh Digital</span>
            </a>

            {{-- Close Button --}}
            <button onclick="closeGalleryModal()"
                    class="w-10 h-10 rounded-xl bg-white/10 hover:bg-red-500 text-white text-lg font-bold transition flex items-center justify-center">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>
    </div>

    {{-- Center Image Area with Navigation Buttons --}}
    <div class="flex items-center justify-center relative flex-1 my-3 overflow-hidden"
         onclick="event.stopPropagation()">
        
        {{-- Prev Button --}}
        <button onclick="navigateGallery(-1)" 
                class="absolute left-2 sm:left-4 z-20 w-12 h-12 rounded-full bg-white/10 hover:bg-white/30 text-white text-xl flex items-center justify-center transition backdrop-blur-md">
            <i class="fa-solid fa-chevron-left"></i>
        </button>

        {{-- The Image --}}
        <img id="modalImage" 
             src="" 
             alt=""
             class="max-w-full max-h-[75vh] object-contain rounded-2xl shadow-2xl border-2 border-white/10 transition-all duration-300">

        {{-- Next Button --}}
        <button onclick="navigateGallery(1)" 
                class="absolute right-2 sm:right-4 z-20 w-12 h-12 rounded-full bg-white/10 hover:bg-white/30 text-white text-xl flex items-center justify-center transition backdrop-blur-md">
            <i class="fa-solid fa-chevron-right"></i>
        </button>
    </div>

    {{-- Bottom Caption Area --}}
    <div class="max-w-4xl mx-auto w-full text-center text-xs text-white/80 pb-2"
         onclick="event.stopPropagation()">
        <p id="modalDesc" class="leading-relaxed font-normal"></p>
        <span class="text-[11px] text-white/40 mt-1 block">Gunakan tombol panah kiri / kanan untuk berganti foto atau Esc untuk menutup</span>
    </div>

</div>

@php
    $galleryData = $galeris->map(function($g) {
        return [
            'id'        => $g->id,
            'judul'     => $g->judul,
            'kategori'  => $g->kategori_label,
            'raw_kat'   => $g->kategori,
            'deskripsi' => $g->deskripsi ?? '',
            'tanggal'   => $g->tanggal_kegiatan ? $g->tanggal_kegiatan->translatedFormat('d F Y') : ($g->created_at ? $g->created_at->format('d/m/Y') : '-'),
            'src'       => $g->gambar_url,
            'print_url' => route('galeri.cetak.single', $g->id),
        ];
    });
@endphp

{{-- Gallery Data Array for JavaScript Lightbox --}}
<script>
    const galleryItems = {!! json_encode($galleryData) !!};

    let currentIdx = 0;

    function openGalleryModal(index) {
        if (!galleryItems || galleryItems.length === 0) return;
        currentIdx = index;
        updateModalContent();
        document.getElementById('galleryModal').classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    function closeGalleryModal() {
        document.getElementById('galleryModal').classList.add('hidden');
        document.body.style.overflow = '';
    }

    function navigateGallery(direction) {
        if (!galleryItems || galleryItems.length === 0) return;
        currentIdx += direction;
        if (currentIdx < 0) currentIdx = galleryItems.length - 1;
        if (currentIdx >= galleryItems.length) currentIdx = 0;
        updateModalContent();
    }

    function updateModalContent() {
        const item = galleryItems[currentIdx];
        if (!item) return;

        document.getElementById('modalImage').src = item.src;
        document.getElementById('modalImage').alt = item.judul;
        document.getElementById('modalTitle').textContent = item.judul;
        document.getElementById('modalKategori').textContent = item.kategori;
        document.getElementById('modalDate').textContent = 'Tanggal: ' + item.tanggal;
        document.getElementById('modalDesc').textContent = item.deskripsi || item.judul;
        
        const printBtn = document.getElementById('modalPrintBtn');
        printBtn.href = item.print_url;

        const downloadBtn = document.getElementById('modalDownloadBtn');
        downloadBtn.href = item.src;
        downloadBtn.setAttribute('download', item.judul + '.jpg');

        // Style badge
        const katBadge = document.getElementById('modalKategori');
        if (item.raw_kat === 'kegiatan_guru') {
            katBadge.className = 'px-2.5 py-0.5 rounded-full text-[10px] font-black uppercase tracking-wider bg-purple-600 text-white';
        } else {
            katBadge.className = 'px-2.5 py-0.5 rounded-full text-[10px] font-black uppercase tracking-wider bg-emerald-600 text-white';
        }
    }

    // Keyboard navigation
    document.addEventListener('keydown', function(e) {
        const modal = document.getElementById('galleryModal');
        if (modal && !modal.classList.contains('hidden')) {
            if (e.key === 'Escape') closeGalleryModal();
            if (e.key === 'ArrowLeft') navigateGallery(-1);
            if (e.key === 'ArrowRight') navigateGallery(1);
        }
    });
</script>

{{-- ================= FOOTER ================= --}}
@include('layouts.footer')

@endsection
