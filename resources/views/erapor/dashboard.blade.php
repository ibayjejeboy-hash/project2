@extends('erapor.layout')

@section('content')

<h2 class="text-2xl font-bold mb-6">
    Data Siswa
</h2>

<div class="bg-white p-6 rounded-xl shadow">

    <table class="w-full text-sm border">
        <tr class="bg-gray-200 text-center">
            <th class="p-2 border">No</th>
            <th class="p-2 border">Nama</th>
            <th class="p-2 border">NIS</th>
            <th class="p-2 border">Kelas</th>
            <th class="p-2 border">Aksi</th>
        </tr>

        @foreach($siswas as $i => $siswa)
        <tr class="text-center">
            <td class="border p-2">{{ $i+1 }}</td>
            <td class="border p-2 text-left">{{ $siswa->nama }}</td>
            <td class="border p-2">{{ $siswa->nis }}</td>
            <td class="border p-2">{{ $siswa->kelas->nama_kelas ?? '-' }}</td>

            <td class="border p-2 space-x-2">

                {{-- LIHAT --}}
                <a href="{{ route('erapor.hasil', $siswa->id) }}"
                   class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600">
                    Lihat
                </a>

                {{-- CETAK --}}
                <a href="{{ route('erapor.cetak', $siswa->id) }}"
                   class="bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600">
                    Cetak
                </a>

            </td>
        </tr>
        @endforeach

    </table>

</div>

@endsection