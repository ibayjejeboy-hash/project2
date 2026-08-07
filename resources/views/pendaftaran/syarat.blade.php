@extends('layouts.app')

@section('content')

<section class="bg-gray-50 min-h-screen px-6 py-12">

    <div class="text-center mb-12">
        <h1 class="text-4xl font-black text-gray-800">
            Persyaratan Pendaftaran
        </h1>

        <p class="text-gray-500 mt-2">
            Berikut persyaratan yang harus dipenuhi oleh calon peserta didik RA.
        </p>
    </div>

    <div class="max-w-4xl mx-auto space-y-5">

        @foreach([
            "Calon peserta didik berusia 4–5 tahun untuk Kelompok A atau 5–6 tahun untuk Kelompok B.",
            "Mengisi formulir pendaftaran secara lengkap dan benar.",
            "Melampirkan fotokopi Akta Kelahiran.",
            "Melampirkan fotokopi Kartu Keluarga (KK).",
            "Melampirkan fotokopi KTP Ayah dan Ibu/Wali.",
            "Menyerahkan pas foto berwarna ukuran 3×4 sebanyak 2 lembar.",
            "Memiliki Nomor Induk Kependudukan (NIK).",
            "Mengisi data orang tua/wali sesuai formulir.",
            "Bersedia mematuhi tata tertib dan ketentuan yang berlaku di RA.",
            "Melakukan daftar ulang setelah dinyatakan diterima."
        ] as $i => $syarat)

        <div class="flex items-start gap-4 bg-white p-5 rounded-xl shadow-sm border border-gray-200 hover:shadow-md transition">

            <div class="w-10 h-10 flex items-center justify-center bg-green-600 text-white rounded-full font-bold flex-shrink-0">
                {{ $i + 1 }}
            </div>

            <p class="text-gray-700 leading-relaxed">
                {{ $syarat }}
            </p>

        </div>

        @endforeach

    </div>

    <div class="text-center mt-10">

        <a href="{{ route('pendaftaran.form') }}"
           class="bg-green-600 text-white px-8 py-3 rounded-xl font-bold hover:bg-green-700 transition">

            Daftar Sekarang

        </a>

    </div>

</section>

@endsection