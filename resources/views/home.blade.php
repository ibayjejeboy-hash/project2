@extends('layouts.app')

@section('content')

<div class="min-h-screen bg-gray-200 relative overflow-hidden">

    {{-- Navbar --}}
    <div class="bg-gradient-to-r from-lime-300 to-green-500">

        <div class="flex justify-between items-center px-4 md:px-16 py-4 md:py-6">

            {{-- Logo --}}
            <div>
                <img src="{{ asset('assets/images/1001230752.jpg - Edited.png') }}" class="w-12 md:w-16">
            </div>

            {{-- Desktop Menu --}}
            <ul class="hidden md:flex gap-8 lg:gap-12 font-extrabold text-lg tracking-wide">
                <li><a href="{{ route('home') }}" class="hover:text-white">HOME</a></li>
                <li><a href="{{ route('galeri') }}" class="hover:text-white">GALERI</a></li>
                <li><a href="{{ route('pendaftaran') }}" class="hover:text-white">PENDAFTARAN</a></li>
                <li><a href="{{ url('/erapor') }}" class="hover:text-white">E - RAPOR</a></li>
            </ul>

            {{-- Hamburger (Mobile) --}}
            <button id="home-menu-btn" class="md:hidden text-gray-800 focus:outline-none" onclick="toggleHomeMenu()">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>

        </div>

        {{-- Mobile Menu --}}
        <div id="home-mobile-menu" class="hidden md:hidden bg-green-500 px-4 pb-4 space-y-2 font-extrabold text-base">
            <a href="{{ route('home') }}" class="block py-2 text-white border-b border-green-400">HOME</a>
            <a href="{{ route('galeri') }}" class="block py-2 text-white border-b border-green-400">GALERI</a>
            <a href="{{ route('pendaftaran') }}" class="block py-2 text-white border-b border-green-400">PENDAFTARAN</a>
            <a href="{{ url('/erapor') }}" class="block py-2 text-white">E - RAPOR</a>
        </div>

    </div>

    {{-- Content Tengah --}}
    <div class="flex flex-col items-center justify-center text-center mt-12 md:mt-20 px-4">

        <p class="text-lg md:text-2xl font-bold mb-4 md:mb-6">
            Selamat Datang Di wibsite Resmi
        </p>

        <h1 class="text-3xl md:text-6xl font-extrabold mb-3 md:mb-4 tracking-wide">
            RA AL MUSYAFFALLAH
        </h1>

        <p class="text-xl md:text-3xl font-bold mb-8 md:mb-10">
            Gabuswetan - Indramayu
        </p>

        {{-- Social Media --}}
        <div class="flex gap-4 md:gap-8 mb-12">

            <div class="bg-white p-2 md:p-3 rounded-lg shadow-lg hover:scale-110 transition">
                <img src="https://cdn-icons-png.flaticon.com/512/2111/2111463.png" class="w-7 md:w-8">
            </div>

            <div class="bg-white p-2 md:p-3 rounded-lg shadow-lg hover:scale-110 transition">
                <img src="https://cdn-icons-png.flaticon.com/512/733/733547.png" class="w-7 md:w-8">
            </div>

            <div class="bg-white p-2 md:p-3 rounded-lg shadow-lg hover:scale-110 transition">
                <img src="https://cdn-icons-png.flaticon.com/512/1384/1384060.png" class="w-7 md:w-8">
            </div>

            <div class="bg-white p-2 md:p-3 rounded-lg shadow-lg hover:scale-110 transition">
                <img src="https://cdn-icons-png.flaticon.com/512/3046/3046126.png" class="w-7 md:w-8">
            </div>

        </div>

    </div>

    {{-- Shape Background Bawah --}}
    <div class="absolute bottom-0 w-full">
        <svg viewBox="0 0 1440 320">
            <path fill="#22c55e" fill-opacity="1"
            d="M0,288L144,256L288,224L432,256L576,288L720,304L864,256L1008,224L1152,256L1296,288L1440,256L1440,320L0,320Z">
            </path>
        </svg>
    </div>

</div>

{{-- SECTION VISI MISI --}}
<section class="bg-gray-100 py-12 md:py-20 px-4 md:px-16">

    <div class="grid md:grid-cols-2 gap-8 md:gap-12 items-center">

        {{-- Gambar Guru --}}
        <div class="w-full h-64 md:h-[500px] overflow-hidden rounded-xl">
            <img src="{{ asset('assets/images/Untitled Design - 1 - Edited.png') }}"
                 class="w-full h-full object-cover scale-125">
        </div>

        {{-- Text --}}
        <div>
            <h2 class="text-2xl md:text-3xl font-bold mb-3 md:mb-4">VISI dan MISI</h2>

            <h1 class="text-3xl md:text-5xl font-extrabold mb-4 md:mb-6">RA AL MUSYAFFALLAH</h1>

            <p class="text-lg md:text-xl font-semibold leading-relaxed">
                {{ $informasi->visi ?? 'Visi belum diisi' }}
            </p>

            <p class="text-base md:text-lg mt-4 leading-relaxed">
                {!! nl2br($informasi->misi ?? 'Misi belum diisi') !!}
            </p>
        </div>

    </div>

</section>

{{-- SECTION SELAYANG PANDANG --}}
<section class="relative text-white">

    {{-- Background Image --}}
    <div class="absolute inset-0">
        <img src="{{ asset('assets/images/612919327_800651653029679_8741154945121478353_n.jpg') }}" class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-black/60"></div>
    </div>

    {{-- Content --}}
    <div class="relative z-10 py-16 md:py-24 px-4 md:px-16 text-center">

        <h1 class="text-3xl md:text-6xl font-extrabold mb-6 md:mb-10">
            Selayang Pandang RA AL-MUSYAFFALLAH
        </h1>

        <p class="max-w-5xl mx-auto text-base md:text-lg leading-relaxed font-medium">
            Raudhatul Athfal (RA) Al Musyaffallah, didirikan oleh swadaya masyarakat sekitar pada Bulan
            Juli Tahun 2014. RA ini didirikan berdasarkan Akta Pendirian dengan nomor register k.k.10.12.15/BA.01/12/2014
            yang dikeluarkan oleh Notaris Suparto, S.H, M.Kn. Tapi seiringnya waktu berjalan dan aturan yang
            mengharuskan sebuah yayasan itu harus dikuatkan dengan payung hukum Kemenkumham, maka pada tanggal 7 Desember
            dibuatlah Akta Notaris No. 79 oleh Notaris Suparto, S.H, M.Kn.  dan SK Kemenkumham No. AHU-0045397.AH.01.04 Tahun 2016. Tanggal 7 Desember .
            Secara Geografis RA Al Musyaffallah terletak di Jalan PU. Rancahan Rt 10/02 Desa Gabuswetan Kecamatan
            Gabuswetan Kabupaten Indramayu Adapun batas-batas lokasi RA Al Musyaffallah  sebagai berikut :
            Sebelah utara berbatasan dengan rumah penduduk sebelah barat berbatasan dengan Musholla Al Musyaffallah,
            sebelah selatan berbatasan dengan Jalan Raya Pu Rancahan dan sebelah timur berbatasan dengan sawah penduduk. Dan sudah terakreditasi B Tahun 2022.
        </p>

    </div>

</section>

<script>
function toggleHomeMenu() {
    const menu = document.getElementById('home-mobile-menu');
    menu.classList.toggle('hidden');
}
</script>

@endsection