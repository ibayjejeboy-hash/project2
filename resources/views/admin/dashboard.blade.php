@extends('layouts.admin')

@section('content')

<h1 class="text-3xl font-extrabold mb-8">
    Dashboard Admin
</h1>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6">

    <div class="bg-gradient-to-r from-green-400 to-lime-500 text-white p-6 rounded-2xl shadow-lg">
    <div class="flex items-center justify-between">
        <div>
            <p class="text-lg">Total Galeri</p>
            <h2 class="text-4xl font-bold">{{ $totalGaleri }}</h2>
        </div>

        <svg xmlns="http://www.w3.org/2000/svg"
             class="w-12 h-12 opacity-80"
             fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M4 16l4-4a3 3 0 014 0l4 4" />
        </svg>
    </div>
</div>

    <div class="bg-white p-6 rounded-2xl shadow-lg hover:shadow-2xl transition">
        <h2 class="text-xl font-bold mb-2">Pendaftar</h2>
        <p class="text-gray-500">25 Siswa</p>
    </div>

    <div class="bg-white p-6 rounded-2xl shadow-lg hover:shadow-2xl transition">
        <h2 class="text-xl font-bold mb-2">Informasi Aktif</h2>
        <p class="text-gray-500">3 Pengumuman</p>
    </div>

</div>

@endsection