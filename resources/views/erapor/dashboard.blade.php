@extends('erapor.layout')

@section('content')

<div class="mb-6 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
    <div>
        <h2 class="text-2xl font-bold text-gray-800">
            Data Rapor Siswa
        </h2>
        <p class="text-sm text-gray-500 mt-1">
            Daftar siswa untuk pengisian dan cetak E-Rapor
        </p>
    </div>
</div>

<div class="overflow-x-auto rounded-xl border border-gray-200">
    <table class="w-full text-sm text-left border-collapse">
        <thead>
            <tr class="bg-gray-50 text-gray-700 border-b border-gray-200">
                <th class="p-4 font-semibold text-center w-16">No</th>
                <th class="p-4 font-semibold">Nama Siswa</th>
                <th class="p-4 font-semibold text-center">NIS</th>
                <th class="p-4 font-semibold text-center">Kelas</th>
                <th class="p-4 font-semibold text-center w-48">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100 text-gray-700 bg-white">
            @foreach($siswas as $i => $siswa)
            <tr class="hover:bg-gray-50/70 transition">
                <td class="p-4 text-center font-medium">{{ $i+1 }}</td>
                <td class="p-4 font-semibold text-gray-900">{{ $siswa->nama }}</td>
                <td class="p-4 text-center">{{ $siswa->nis }}</td>
                <td class="p-4 text-center">
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-50 text-green-700 border border-green-200">
                        {{ $siswa->kelas->nama_kelas ?? '-' }}
                    </span>
                </td>
                <td class="p-4 text-center">
                    <div class="flex items-center justify-center gap-2">
                        {{-- LIHAT --}}
                        <a href="{{ route('erapor.hasil', $siswa->id) }}"
                           class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-blue-50 text-blue-700 border border-blue-200 hover:bg-blue-100 font-medium rounded-lg text-xs transition duration-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                            Lihat
                        </a>

                        {{-- CETAK --}}
                        <a href="{{ route('erapor.cetak', $siswa->id) }}"
                           class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-emerald-50 text-emerald-700 border border-emerald-200 hover:bg-emerald-100 font-medium rounded-lg text-xs transition duration-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4"/>
                            </svg>
                            Cetak
                        </a>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection