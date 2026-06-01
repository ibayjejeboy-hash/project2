@extends('layouts.app')

@section('content')

<section class="bg-gray-50 min-h-screen px-6 py-12">

    <div class="text-center mb-12">
        <h1 class="text-4xl font-black text-gray-800">Alur Pendaftaran</h1>
        <p class="text-gray-500 mt-2">Ikuti langkah berikut untuk mendaftar</p>
    </div>

    <div class="max-w-3xl mx-auto space-y-6">

        {{-- Step --}}
        @foreach([
            "Buka halaman pendaftaran",
            "Isi form data siswa",
            "Submit data",
            "Menunggu verifikasi admin",
            "Pengumuman hasil"
        ] as $i => $step)

        <div class="flex items-center gap-4 bg-white p-5 rounded-xl shadow-sm border">
            <div class="w-10 h-10 flex items-center justify-center bg-green-600 text-white rounded-full font-bold">
                {{ $i+1 }}
            </div>
            <p class="font-semibold text-gray-700">{{ $step }}</p>
        </div>

        @endforeach

    </div>

    {{-- Button --}}
    <div class="text-center mt-10">
        <a href="{{ route('pendaftaran.form') }}"
           class="bg-green-600 text-white px-8 py-3 rounded-xl font-bold hover:bg-green-700">
            Daftar Sekarang
        </a>
    </div>

</section>

@endsection