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

        {{-- Info Jadwal & Biaya --}}
        <div class="mt-10 grid md:grid-cols-2 gap-6">
            {{-- Kartu Jadwal --}}
            <div class="bg-blue-50/50 p-6 rounded-2xl border border-blue-100 shadow-sm">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-10 h-10 rounded-xl bg-blue-100 text-blue-700 flex items-center justify-center font-bold">
                        <i class="fa-solid fa-calendar-day"></i>
                    </div>
                    <h3 class="font-black text-blue-900">Jadwal Pendaftaran</h3>
                </div>
                <ul class="space-y-2 text-sm text-blue-800 font-medium">
                    <li class="flex items-center justify-between">
                        <span>Gelombang 1</span>
                        <span class="font-bold">{{ $settings['jadwal_gelombang_1'] ?? '1 Maret - 31 Mei' }}</span>
                    </li>
                    <li class="flex items-center justify-between border-t border-blue-100/50 pt-2">
                        <span>Gelombang 2</span>
                        <span class="font-bold">{{ $settings['jadwal_gelombang_2'] ?? '1 Juni - 31 Juli' }}</span>
                    </li>
                </ul>
                <p class="text-[11px] text-blue-600/80 italic mt-4">* Awal tahun ajaran mengikuti Kaldik Kemenag RI</p>
            </div>

            {{-- Kartu Biaya --}}
            <div class="bg-yellow-50/50 p-6 rounded-2xl border border-yellow-100 shadow-sm">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-10 h-10 rounded-xl bg-yellow-100 text-yellow-700 flex items-center justify-center font-bold">
                        <i class="fa-solid fa-wallet"></i>
                    </div>
                    <h3 class="font-black text-yellow-900">Biaya Pendidikan</h3>
                </div>
                <div class="text-sm text-yellow-800 font-medium space-y-1">
                    <p class="flex items-center justify-between">
                        <span>SPP Bulanan</span>
                        <span class="font-black text-base text-yellow-900">{{ $settings['biaya_spp'] ?? 'Rp 25.000' }}</span>
                    </p>
                    <p class="text-xs text-yellow-700 leading-relaxed pt-2 border-t border-yellow-100/50 mt-2">
                        Pendaftaran, Uang Masuk, Buku, dan Seragam sedang dalam proses rekapitulasi. Silakan hubungi admin untuk rincian lengkapnya.
                    </p>
                    <div class="pt-3 mt-3 border-t border-yellow-100/50 space-y-2">
                        <button onclick="openDocumentModal('Brosur PPDB / SPMB', '{{ asset('assets/dokumen/SPMB 2026-2027.xlsx') }}', 'fa-file-excel')" class="w-full flex items-center justify-between bg-white px-3 py-2.5 rounded-xl border border-yellow-200 text-yellow-800 hover:bg-yellow-100 hover:text-yellow-900 transition focus:outline-none focus:ring-2 focus:ring-yellow-400">
                            <span class="text-xs font-bold"><i class="fa-solid fa-file-excel w-4 text-green-600"></i> Rincian SPMB 2026</span>
                            <i class="fa-solid fa-arrow-up-right-from-square text-[10px] text-yellow-600"></i>
                        </button>
                        <button onclick="openDocumentModal('Contoh Kartu SPP / Syahriyah', '{{ asset('assets/dokumen/Kartu syahriyah RA AM 2026.docx') }}', 'fa-file-word')" class="w-full flex items-center justify-between bg-white px-3 py-2.5 rounded-xl border border-yellow-200 text-yellow-800 hover:bg-yellow-100 hover:text-yellow-900 transition focus:outline-none focus:ring-2 focus:ring-yellow-400">
                            <span class="text-xs font-bold"><i class="fa-solid fa-file-word w-4 text-blue-600"></i> Contoh Kartu Syahriyah</span>
                            <i class="fa-solid fa-arrow-up-right-from-square text-[10px] text-yellow-600"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        {{-- Callout Box Bantuan --}}
        <div class="mt-8 bg-amber-50 border-l-4 border-amber-500 rounded-2xl p-6 shadow-sm">
            <div class="flex items-start gap-3">
                <i class="fa-solid fa-circle-info text-amber-600 text-xl mt-0.5"></i>
                <div class="space-y-1">
                    <h3 class="font-bold text-amber-900 text-sm sm:text-base">Butuh Bantuan Selama Pendaftaran?</h3>
                    <p class="text-xs sm:text-sm text-amber-800 leading-relaxed">
                        Jika menemui kendala teknis dalam pengisian data atau memiliki pertanyaan khusus, silakan hubungi tim panitia PPDB kami via WhatsApp di 
                        <a href="https://wa.me/62{{ ltrim($settings['kontak_wa'] ?? '85314006568', '0') }}" target="_blank" rel="noopener noreferrer" class="font-bold underline">{{ $settings['kontak_wa_display'] ?? '0853-1400-6568' }}</a>.
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