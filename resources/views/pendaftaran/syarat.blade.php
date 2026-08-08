@extends('layouts.app')

@section('title', 'Persyaratan Pendaftaran Siswa Baru - RA Al Musyaffallah')

@section('content')

{{-- ================= HEADER ================= --}}
@include('layouts.navbar')

{{-- ================= CONTENT ================= --}}
<section class="bg-gray-50 min-h-screen py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-4xl mx-auto">

        {{-- Judul --}}
        <div class="text-center mb-12 space-y-3">
            <span class="text-xs font-extrabold text-green-700 uppercase tracking-widest bg-green-100 px-3.5 py-1.5 rounded-full border border-green-200">
                Ketentuan & Berkas
            </span>
            <h1 class="text-3xl sm:text-5xl font-black text-gray-900 mt-2">
                PERSYARATAN PENDAFTARAN
            </h1>
            <p class="text-sm sm:text-base text-gray-600">
                Berikut persyaratan umum dan dokumen yang perlu dipersiapkan oleh calon wali murid.
            </p>
            <div class="w-16 h-1 bg-green-600 mx-auto rounded-full mt-3"></div>
        </div>

        {{-- List Syarat --}}
        <div class="space-y-4">
            @php
                $syarats = [
                    'Calon peserta didik berusia 4–5 tahun untuk Kelompok A atau 5–6 tahun untuk Kelompok B per bulan Juli tahun berjalan.',
                    'Mengisi formulir pendaftaran secara lengkap dan benar melalui website resmi.',
                    'Melampirkan fotokopi / scan Akta Kelahiran anak.',
                    'Melampirkan fotokopi / scan Kartu Keluarga (KK).',
                    'Melampirkan fotokopi / scan KTP Ayah dan Ibu / Wali.',
                    'Menyerahkan pas foto berwarna ukuran 3×4 sebanyak 2 lembar.',
                    'Memiliki Nomor Induk Kependudukan (NIK) yang terdaftar di Dukcapil.',
                    'Orang tua/wali berkomitmen mendukung program pendidikan dan pembiasaan adab Islami di sekolah.',
                    'Bersedia mematuhi tata tertib dan ketentuan yang berlaku di RA Al Musyaffallah.',
                    'Melakukan daftar ulang setelah dinyatakan diterima oleh pihak sekolah.'
                ];
            @endphp

            @foreach($syarats as $i => $syarat)
            <div class="flex items-start gap-4 bg-white p-5 rounded-2xl shadow-sm border border-gray-100 hover:shadow-md hover:border-green-200 transition group">
                <div class="w-10 h-10 flex items-center justify-center bg-green-100 text-green-800 rounded-xl font-bold flex-shrink-0 group-hover:bg-green-600 group-hover:text-white transition">
                    <i class="fa-solid fa-check"></i>
                </div>
                <p class="text-xs sm:text-sm md:text-base text-gray-700 leading-relaxed font-medium pt-1.5">
                    {{ $syarat }}
                </p>
            </div>
            @endforeach
        </div>

        {{-- Button --}}
        <div class="text-center mt-12 pt-6">
            <a href="{{ route('pendaftaran.form') }}"
               class="inline-flex items-center gap-2.5 bg-gradient-to-r from-green-600 to-emerald-700 hover:from-green-700 hover:to-emerald-800 text-white px-8 py-4 rounded-2xl font-black shadow-lg hover:shadow-xl hover:-translate-y-0.5 transition text-base">
                <i class="fa-solid fa-pen-to-square"></i>
                <span>Lanjut Isi Formulir Pendaftaran</span>
            </a>
        </div>

    </div>
</section>

{{-- ================= FOOTER ================= --}}
@include('layouts.footer')

@endsection