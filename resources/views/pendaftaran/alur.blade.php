@extends('layouts.app')

@section('title', 'Alur Pendaftaran Siswa Baru (PPDB) - RA Al Musyaffallah')

@section('content')

{{-- ================= HEADER ================= --}}
@include('layouts.navbar')

{{-- ================= CONTENT ================= --}}
<section class="bg-gray-50 min-h-screen py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-4xl mx-auto">

        {{-- Judul --}}
        <div class="text-center mb-12 space-y-3">
            <span class="text-xs font-extrabold text-green-700 uppercase tracking-widest bg-green-100 px-3.5 py-1.5 rounded-full border border-green-200">
                Tahapan PPDB
            </span>
            <h1 class="text-3xl sm:text-5xl font-black text-gray-900 mt-2">
                ALUR PENDAFTARAN SISWA
            </h1>
            <p class="text-sm sm:text-base text-gray-600">
                Ikuti 5 tahapan mudah berikut untuk mendaftarkan calon peserta didik di RA Al Musyaffallah.
            </p>
            <div class="w-16 h-1 bg-green-600 mx-auto rounded-full mt-3"></div>
        </div>

        {{-- Timeline Steps --}}
        <div class="space-y-4">
            @php
                $steps = [
                    [
                        'title' => 'Pengisian Formulir Online',
                        'desc' => 'Buka menu Pendaftaran Online dan lengkapi data identitas anak, orang tua/wali, serta nomor WhatsApp aktif.',
                        'icon' => 'fa-solid fa-file-lines'
                    ],
                    [
                        'title' => 'Unggah Dokumen Berkas',
                        'desc' => 'Unggah dokumen pendukung seperti scan/foto Akta Kelahiran, Kartu Keluarga (KK), dan KTP Orang Tua.',
                        'icon' => 'fa-solid fa-cloud-arrow-up'
                    ],
                    [
                        'title' => 'Verifikasi Berkas oleh Panitia',
                        'desc' => 'Panitia PPDB RA Al Musyaffallah akan memverifikasi keabsahan data dan kesesuaian kriteria usia calon siswa.',
                        'icon' => 'fa-solid fa-user-check'
                    ],
                    [
                        'title' => 'Konfirmasi & Pengumuman',
                        'desc' => 'Hasil verifikasi penerimaan akan dikonfirmasi secara langsung via WhatsApp atau Email yang terdaftar.',
                        'icon' => 'fa-solid fa-bullhorn'
                    ],
                    [
                        'title' => 'Daftar Ulang & Orientasi Siswa',
                        'desc' => 'Orang tua/wali hadir ke sekolah untuk pengambilan seragam, buku panduan belajar, dan jadwal masa orientasi ceria.',
                        'icon' => 'fa-solid fa-school'
                    ],
                ];
            @endphp

            @foreach($steps as $i => $step)
            <div class="flex items-start gap-4 sm:gap-6 bg-white p-6 rounded-2xl shadow-sm border border-gray-100 hover:shadow-md hover:border-green-200 transition group">
                <div class="w-12 h-12 flex items-center justify-center bg-green-600 text-white rounded-2xl font-black text-lg flex-shrink-0 shadow-md group-hover:scale-105 transition">
                    {{ $i + 1 }}
                </div>
                <div class="space-y-1">
                    <h3 class="font-black text-gray-900 text-base sm:text-lg group-hover:text-green-700 transition">
                        {{ $step['title'] }}
                    </h3>
                    <p class="text-xs sm:text-sm text-gray-600 leading-relaxed font-medium">
                        {{ $step['desc'] }}
                    </p>
                </div>
            </div>
            @endforeach
        </div>

        {{-- Action Button --}}
        <div class="text-center mt-12 pt-6">
            <a href="{{ route('pendaftaran.form') }}"
               class="inline-flex items-center gap-2.5 bg-gradient-to-r from-green-600 to-emerald-700 hover:from-green-700 hover:to-emerald-800 text-white px-8 py-4 rounded-2xl font-black shadow-lg hover:shadow-xl hover:-translate-y-0.5 transition text-base">
                <i class="fa-solid fa-pen-to-square"></i>
                <span>Isi Formulir Pendaftaran Sekarang</span>
            </a>
        </div>

    </div>
</section>

{{-- ================= FOOTER ================= --}}
@include('layouts.footer')

@endsection