@extends('layouts.app')

@section('title', 'Panduan Pendaftaran Siswa Baru - RA Al Musyaffallah')

@section('content')

{{-- ================= HEADER ================= --}}
@include('layouts.navbar')

{{-- ================= CONTENT ================= --}}
<section class="bg-gray-50 min-h-screen py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-4xl mx-auto">

        {{-- Judul --}}
        <div class="text-center mb-12 space-y-3">
            <span class="text-xs font-extrabold text-green-700 uppercase tracking-widest bg-green-100 px-3.5 py-1.5 rounded-full border border-green-200">
                Petunjuk Teknis PPDB
            </span>
            <h1 class="text-3xl sm:text-5xl font-black text-gray-900 mt-2">
                PANDUAN PENDAFTARAN
            </h1>
            <p class="text-sm sm:text-base text-gray-600">
                Langkah demi langkah cara mendaftarkan putra-putri Anda secara online.
            </p>
            <div class="w-16 h-1 bg-green-600 mx-auto rounded-full mt-3"></div>
        </div>

        {{-- List Panduan --}}
        <div class="space-y-4">
            @php
                $panduans = [
                    'Buka website resmi RA Al Musyaffallah kemudian pilih menu Formulir Pendaftaran.',
                    'Isi seluruh data identitas calon peserta didik secara lengkap dan teliti sesuai Akta Kelahiran dan Kartu Keluarga.',
                    'Lengkapi data orang tua atau wali serta pastikan nomor WhatsApp dan email dalam keadaan aktif.',
                    'Pilih pilihan jenjang kelompok kelas yang dituju (Kelompok A usia 4-5 tahun atau Kelompok B usia 5-6 tahun).',
                    'Periksa kembali ringkasan isian formulir sebelum menekan tombol submit / kirim.',
                    'Setelah formulir terkirim, sistem akan mencatat data pendaftaran dan status menjadi Menunggu Verifikasi.',
                    'Admin panitia PPDB akan memverifikasi berkas dan menghubungi wali murid melalui WhatsApp resmi.',
                    'Apabila dinyatakan diterima, orang tua/wali dapat menyelesaikan administrasi daftar ulang di sekolah.'
                ];
            @endphp

            @foreach($panduans as $i => $panduan)
            <div class="flex items-start gap-4 bg-white p-5 rounded-2xl shadow-sm border border-gray-100 hover:shadow-md hover:border-green-200 transition group">
                <div class="w-10 h-10 flex items-center justify-center bg-lime-100 text-lime-900 rounded-xl font-bold flex-shrink-0 group-hover:bg-green-600 group-hover:text-white transition">
                    {{ $i + 1 }}
                </div>
                <p class="text-xs sm:text-sm md:text-base text-gray-700 leading-relaxed font-medium pt-1.5">
                    {{ $panduan }}
                </p>
            </div>
            @endforeach
        </div>

        {{-- Callout Box Bantuan --}}
        <div class="mt-8 bg-amber-50 border-l-4 border-amber-500 rounded-2xl p-6 shadow-sm">
            <div class="flex items-start gap-3">
                <i class="fa-solid fa-circle-info text-amber-600 text-xl mt-0.5"></i>
                <div class="space-y-1">
                    <h3 class="font-bold text-amber-900 text-sm sm:text-base">Butuh Bantuan Selama Pendaftaran?</h3>
                    <p class="text-xs sm:text-sm text-amber-800 leading-relaxed">
                        Jika menemui kendala teknis dalam pengisian data atau memiliki pertanyaan khusus, silakan hubungi tim panitia PPDB kami via WhatsApp di 
                        <a href="https://wa.me/6289524810777" target="_blank" rel="noopener noreferrer" class="font-bold underline">0895-2481-0777</a>.
                    </p>
                </div>
            </div>
        </div>

        {{-- Button --}}
        <div class="text-center mt-10">
            <a href="{{ route('pendaftaran.form') }}"
               class="inline-flex items-center gap-2.5 bg-gradient-to-r from-green-600 to-emerald-700 hover:from-green-700 hover:to-emerald-800 text-white px-8 py-4 rounded-2xl font-black shadow-lg hover:shadow-xl hover:-translate-y-0.5 transition text-base">
                <i class="fa-solid fa-pen-to-square"></i>
                <span>Buka Formulir Pendaftaran</span>
            </a>
        </div>

    </div>
</section>

{{-- ================= FOOTER ================= --}}
@include('layouts.footer')

@endsection