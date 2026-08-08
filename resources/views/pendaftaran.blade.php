@extends('layouts.app')

@section('title', 'Pendaftaran Peserta Didik Baru (PPDB) - RA Al Musyaffallah')

@section('content')

{{-- ================= HEADER ================= --}}
@include('layouts.navbar')

{{-- ================= CONTENT ================= --}}
<section class="bg-gray-50 min-h-screen py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto">

        {{-- Judul --}}
        <div class="text-center mb-14 space-y-3">
            <span class="text-xs font-extrabold text-green-700 uppercase tracking-widest bg-green-100 px-3.5 py-1.5 rounded-full border border-green-200">
                Penerimaan Peserta Didik Baru (PPDB)
            </span>
            <h1 class="text-3xl sm:text-5xl font-black text-gray-900 mt-2">
                PENDAFTARAN SISWA BARU
            </h1>
            <p class="mt-2 text-base text-gray-600 max-w-2xl mx-auto font-medium">
                Tahun Ajaran 2026/2027 • RA Al Musyaffallah Gabuswetan Indramayu
            </p>
            <div class="w-16 h-1 bg-green-600 mx-auto rounded-full mt-3"></div>
        </div>

        {{-- Banner Formulir Cepat --}}
        <div class="max-w-4xl mx-auto mb-16 bg-gradient-to-r from-green-700 to-emerald-800 rounded-3xl p-8 text-white shadow-xl flex flex-col md:flex-row items-center justify-between gap-6">
            <div class="space-y-2 text-center md:text-left">
                <span class="px-3 py-1 bg-lime-400 text-green-950 text-xs font-black rounded-lg uppercase">Registrasi Cepat</span>
                <h2 class="text-2xl font-black">Siap Mendaftarkan Putra-Putri Anda?</h2>
                <p class="text-xs sm:text-sm text-green-100 max-w-lg">
                    Isi formulir online resmi untuk mendapatkan nomor registrasi dan konfirmasi dari panitia PPDB.
                </p>
            </div>
            <a href="{{ route('pendaftaran.form') }}" 
               class="px-8 py-4 bg-lime-400 hover:bg-lime-300 text-green-950 font-black rounded-2xl shadow-lg hover:scale-105 transition flex-shrink-0 text-sm">
                <i class="fa-solid fa-pen-to-square mr-1.5"></i> Buka Formulir Online
            </a>
        </div>

        {{-- Card Section Menu PPDB --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">

            {{-- Card 1: Alur Pendaftaran --}}
            <div class="bg-white p-8 rounded-3xl border border-gray-100 shadow-sm hover:shadow-xl hover:-translate-y-1 transition duration-300 text-center flex flex-col justify-between">
                <div>
                    <div class="w-14 h-14 rounded-2xl bg-green-100 text-green-700 flex items-center justify-center mx-auto mb-5 text-2xl font-bold">
                        <i class="fa-solid fa-diagram-project"></i>
                    </div>
                    <h3 class="text-lg font-black text-gray-900 mb-2">ALUR PENDAFTARAN</h3>
                    <p class="text-xs sm:text-sm text-gray-600 leading-relaxed mb-6">
                        Pelajari tahapan langkah-langkah pendaftaran mulai dari registrasi online hingga verifikasi berkas.
                    </p>
                </div>
                <a href="{{ route('pendaftaran.alur') }}"
                   class="inline-flex items-center justify-center gap-2 bg-green-600 text-white px-6 py-3 rounded-xl font-bold hover:bg-green-700 transition text-sm">
                    <span>Lihat Alur PPDB</span>
                    <i class="fa-solid fa-arrow-right text-xs"></i>
                </a>
            </div>

            {{-- Card 2: Syarat Pendaftaran --}}
            <div class="bg-white p-8 rounded-3xl border border-gray-100 shadow-sm hover:shadow-xl hover:-translate-y-1 transition duration-300 text-center flex flex-col justify-between">
                <div>
                    <div class="w-14 h-14 rounded-2xl bg-emerald-100 text-emerald-700 flex items-center justify-center mx-auto mb-5 text-2xl font-bold">
                        <i class="fa-solid fa-clipboard-check"></i>
                    </div>
                    <h3 class="text-lg font-black text-gray-900 mb-2">SYARAT PENDAFTARAN</h3>
                    <p class="text-xs sm:text-sm text-gray-600 leading-relaxed mb-6">
                        Ketahui dokumen persyaratan dan kriteria usia yang harus dipenuhi oleh calon peserta didik RA.
                    </p>
                </div>
                <a href="{{ route('pendaftaran.syarat') }}"
                   class="inline-flex items-center justify-center gap-2 bg-green-600 text-white px-6 py-3 rounded-xl font-bold hover:bg-green-700 transition text-sm">
                    <span>Lihat Persyaratan</span>
                    <i class="fa-solid fa-arrow-right text-xs"></i>
                </a>
            </div>

            {{-- Card 3: Panduan Pendaftaran --}}
            <div class="bg-white p-8 rounded-3xl border border-gray-100 shadow-sm hover:shadow-xl hover:-translate-y-1 transition duration-300 text-center flex flex-col justify-between">
                <div>
                    <div class="w-14 h-14 rounded-2xl bg-lime-100 text-lime-700 flex items-center justify-center mx-auto mb-5 text-2xl font-bold">
                        <i class="fa-solid fa-book-open-reader"></i>
                    </div>
                    <h3 class="text-lg font-black text-gray-900 mb-2">PANDUAN PENDAFTARAN</h3>
                    <p class="text-xs sm:text-sm text-gray-600 leading-relaxed mb-6">
                        Panduan lengkap petunjuk teknis pengisian formulir dan tata cara pembayaran administrasi.
                    </p>
                </div>
                <a href="{{ route('pendaftaran.panduan') }}"
                   class="inline-flex items-center justify-center gap-2 bg-green-600 text-white px-6 py-3 rounded-xl font-bold hover:bg-green-700 transition text-sm">
                    <span>Lihat Panduan</span>
                    <i class="fa-solid fa-arrow-right text-xs"></i>
                </a>
            </div>

        </div>

    </div>
</section>

{{-- ================= FOOTER ================= --}}
@include('layouts.footer')

@endsection