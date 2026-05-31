@extends('layouts.app')

@section('content')

<div class="min-h-screen bg-gradient-to-br from-green-50 via-lime-50/30 to-green-100/50 relative overflow-hidden flex flex-col justify-between">

    {{-- Navbar --}}
    <header class="w-full bg-white/70 backdrop-blur-md border-b border-green-100 sticky top-0 z-50 transition duration-300">
        <div class="max-w-7xl mx-auto flex justify-between items-center px-6 py-4">

            {{-- Logo --}}
            <a href="{{ route('home') }}" class="flex items-center gap-3 group">
                <img src="{{ asset('assets/images/1001230752.jpg - Edited.png') }}" class="w-12 h-12 object-contain group-hover:scale-105 transition duration-300">
                <div>
                    <span class="block font-black text-green-800 text-lg tracking-wider">AL MUSYAFFALLAH</span>
                    <span class="block text-xxs font-semibold text-green-600 uppercase tracking-widest -mt-1">Raudhatul Athfal</span>
                </div>
            </a>

            {{-- Desktop Menu --}}
            <nav class="hidden md:block">
                <ul class="flex items-center gap-8 font-extrabold text-sm tracking-wide text-gray-700">
                    <li><a href="{{ route('home') }}" class="text-green-600 hover:text-green-800 transition">HOME</a></li>
                    <li><a href="{{ route('galeri') }}" class="hover:text-green-600 transition">GALERI</a></li>
                    <li><a href="{{ route('pendaftaran') }}" class="hover:text-green-600 transition">PENDAFTARAN</a></li>
                    <li>
                        <a href="{{ url('/erapor') }}" class="inline-flex items-center gap-1.5 px-4 py-2 bg-green-600 hover:bg-green-700 text-white font-bold rounded-xl shadow-sm hover:shadow-md transition">
                            E-RAPOR
                        </a>
                    </li>
                </ul>
            </nav>

            {{-- Hamburger (Mobile) --}}
            <button id="home-menu-btn" class="md:hidden text-gray-700 hover:text-green-600 focus:outline-none p-1.5 hover:bg-gray-100 rounded-lg transition" onclick="toggleHomeMenu()">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>

        </div>

        {{-- Mobile Menu --}}
        <div id="home-mobile-menu" class="hidden md:hidden bg-white/95 backdrop-blur-md px-6 py-4 space-y-3 font-extrabold text-sm border-t border-green-50 shadow-lg">
            <a href="{{ route('home') }}" class="block py-2 text-green-600 hover:text-green-800 border-b border-gray-100">HOME</a>
            <a href="{{ route('galeri') }}" class="block py-2 text-gray-700 hover:text-green-600 border-b border-gray-100">GALERI</a>
            <a href="{{ route('pendaftaran') }}" class="block py-2 text-gray-700 hover:text-green-600 border-b border-gray-100">PENDAFTARAN</a>
            <a href="{{ url('/erapor') }}" class="block py-2.5 text-center bg-green-600 text-white rounded-xl shadow-sm">E-RAPOR</a>
        </div>
    </header>

    {{-- Content Tengah --}}
    <main class="flex-1 flex flex-col items-center justify-center text-center px-6 py-16 max-w-5xl mx-auto z-10">

        <span class="inline-flex items-center px-3.5 py-1.5 rounded-full text-xs font-bold bg-green-100 text-green-800 border border-green-200 mb-6 uppercase tracking-widest shadow-sm">
            Website Resmi Sekolah
        </span>

        <h1 class="text-4xl md:text-7xl font-black text-gray-900 mb-4 tracking-tight leading-tight">
            RA AL MUSYAFFALLAH
        </h1>

        <p class="text-lg md:text-2xl font-semibold text-gray-600 mb-8 max-w-2xl leading-relaxed">
            Membentuk generasi cerdas, berkarakter Islami, dan berakhlak mulia di Gabuswetan, Indramayu.
        </p>

        {{-- Action Buttons --}}
        <div class="flex flex-col sm:flex-row gap-4 mb-12">
            <a href="{{ route('pendaftaran') }}" class="px-8 py-3.5 bg-green-600 hover:bg-green-700 text-white font-bold rounded-xl shadow-md hover:shadow-lg transition duration-200 text-sm">
                Penerimaan Siswa Baru
            </a>
            <a href="{{ route('galeri') }}" class="px-8 py-3.5 bg-white hover:bg-gray-50 text-gray-700 font-bold rounded-xl border border-gray-200 shadow-sm transition duration-200 text-sm">
                Lihat Galeri
            </a>
        </div>

        {{-- Social Media --}}
        <div class="flex gap-4 items-center">
            <span class="text-xs font-bold text-gray-400 uppercase tracking-widest mr-2">Ikuti Kami:</span>
            
            <a href="#" class="bg-white p-3 rounded-xl shadow-sm border border-gray-100 hover:shadow-md hover:scale-105 transition text-gray-500 hover:text-green-600">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
            </a>

            <a href="#" class="bg-white p-3 rounded-xl shadow-sm border border-gray-100 hover:shadow-md hover:scale-105 transition text-gray-500 hover:text-pink-600">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.051.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>
            </a>

            <a href="#" class="bg-white p-3 rounded-xl shadow-sm border border-gray-100 hover:shadow-md hover:scale-105 transition text-gray-500 hover:text-red-600">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M23.498 6.163a3.003 3.003 0 00-2.11-2.11C19.518 3.545 12 3.545 12 3.545s-7.518 0-9.388.507a3.003 3.003 0 00-2.11 2.11C0 8.033 0 12 0 12s0 3.967.502 5.837a3.003 3.003 0 002.11 2.11c1.87.508 9.388.508 9.388.508s7.518 0 9.388-.508a3.002 3.002 0 002.11-2.11C24 15.967 24 12 24 12s0-3.967-.502-5.837zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
            </a>
        </div>

    </main>

    {{-- Shape Background Bawah --}}
    <div class="w-full pointer-events-none mt-auto">
        <svg class="w-full h-auto" viewBox="0 0 1440 180" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M0,96L80,112C160,128,320,160,480,160C640,160,800,128,960,112C1120,96,1280,96,1360,96L1440,96L1440,180L1360,180C1280,180,1120,180,960,180C800,180,640,180,480,180C320,180,160,180,80,180L0,180Z" fill="#22c55e"/>
        </svg>
    </div>

</div>

{{-- SECTION VISI MISI --}}
<section class="bg-white py-20 px-6 md:px-16 border-b border-gray-100">
    <div class="max-w-7xl mx-auto grid md:grid-cols-2 gap-12 items-center">

        {{-- Gambar Guru --}}
        <div class="relative w-full h-80 md:h-[550px] overflow-hidden rounded-3xl shadow-lg border border-gray-100 group">
            <img src="{{ asset('assets/images/Untitled Design - 1 - Edited.png') }}"
                 class="w-full h-full object-cover group-hover:scale-102 transition duration-500">
            <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent"></div>
            <div class="absolute bottom-6 left-6 text-white">
                <span class="block text-xs font-bold uppercase tracking-wider opacity-75">RA Al Musyaffallah</span>
                <span class="block text-lg font-bold">Kualitas Pendidikan Terbaik</span>
            </div>
        </div>

        {{-- Text --}}
        <div class="space-y-6">
            <div>
                <span class="text-xs font-extrabold text-green-600 uppercase tracking-widest">Arah & Landasan</span>
                <h2 class="text-3xl md:text-5xl font-black text-gray-900 mt-2">VISI dan MISI</h2>
            </div>

            <div class="bg-green-50/50 p-6 rounded-2xl border border-green-100">
                <h3 class="text-xs font-bold uppercase tracking-widest text-green-700 mb-2">Visi Kami</h3>
                <p class="text-base md:text-lg font-medium text-gray-700 leading-relaxed italic">
                    "{{ $informasi->visi ?? 'Visi belum diisi' }}"
                </p>
            </div>

            <div class="space-y-3">
                <h3 class="text-xs font-bold uppercase tracking-widest text-green-700">Misi Kami</h3>
                <div class="text-sm md:text-base text-gray-600 leading-relaxed space-y-2">
                    {!! nl2br($informasi->misi ?? 'Misi belum diisi') !!}
                </div>
            </div>
        </div>

    </div>
</section>

{{-- SECTION SELAYANG PANDANG --}}
<section class="relative text-white min-h-[500px] flex items-center">

    {{-- Background Image --}}
    <div class="absolute inset-0">
        <img src="{{ asset('assets/images/612919327_800651653029679_8741154945121478353_n.jpg') }}" class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-gradient-to-r from-green-950/90 to-green-900/80"></div>
    </div>

    {{-- Content --}}
    <div class="relative z-10 py-20 px-6 md:px-16 w-full">
        <div class="max-w-4xl mx-auto text-center space-y-6">
            <span class="text-xs font-extrabold text-lime-400 uppercase tracking-widest">Sejarah Singkat</span>
            <h2 class="text-3xl md:text-5xl font-black tracking-tight leading-tight">
                Selayang Pandang
            </h2>
            <div class="w-16 h-1 bg-lime-400 mx-auto rounded-full"></div>
            <p class="text-sm md:text-base leading-relaxed text-green-50/90 font-medium whitespace-pre-line text-justify md:text-center">
                Raudhatul Athfal (RA) Al Musyaffallah didirikan atas swadaya masyarakat sekitar pada Bulan Juli Tahun 2014 berdasarkan Akta Pendirian dengan nomor register k.k.10.12.15/BA.01/12/2014 oleh Notaris Suparto, S.H, M.Kn. Seiring perkembangan regulasi untuk memperkuat payung hukum Kemenkumham, pada 7 Desember 2016 dibuatlah Akta Notaris No. 79 serta SK Kemenkumham No. AHU-0045397.AH.01.04.

                Secara geografis, RA Al Musyaffallah berlokasi di Jalan PU Rancahan Rt 10/02 Desa Gabuswetan, Kecamatan Gabuswetan, Kabupaten Indramayu. Di sebelah utara berbatasan dengan pemukiman penduduk, sebelah barat dengan Musholla Al Musyaffallah, sebelah selatan dengan Jalan Raya PU Rancahan, dan sebelah timur dengan area persawahan. Sekolah ini telah mendapatkan predikat Terakreditasi B sejak tahun 2022.
            </p>
        </div>
    </div>

</section>

<script>
function toggleHomeMenu() {
    const menu = document.getElementById('home-mobile-menu');
    menu.classList.toggle('hidden');
}
</script>

@endsection