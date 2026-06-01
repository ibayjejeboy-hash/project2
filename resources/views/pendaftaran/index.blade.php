@extends('layouts.admin') {{-- atau layout admin lo --}}

@section('content')

<div class="mb-6">
    <h1 class="text-2xl font-bold">Data Pendaftar</h1>
    <p class="text-gray-500">List calon siswa yang mendaftar</p>
</div>

<div class="bg-white rounded-2xl shadow-md overflow-x-auto">

    <table class="w-full text-left">
        <thead class="bg-gray-100 text-gray-700">
            <tr>
                <th class="p-4">No</th>
                <th class="p-4">Nama Anak</th>
                <th class="p-4">Orang Tua</th>
                <th class="p-4">No HP</th>
                <th class="p-4">Status</th>
                <th class="p-4">Aksi</th>
            </tr>
        </thead>

        <tbody>
            @foreach($data as $item)
            <tr class="border-t">
                <td class="p-4">{{ $loop->iteration }}</td>
                <td class="p-4 font-semibold">{{ $item->nama_anak }}</td>
                <td class="p-4">{{ $item->nama_ortu }}</td>
                <td class="p-4">{{ $item->no_hp }}</td>

                {{-- STATUS --}}
                <td class="p-4">
                    <span class="px-3 py-1 rounded-full text-sm
                        {{ $item->status == 'pending' ? 'bg-yellow-100 text-yellow-600' : '' }}
                        {{ $item->status == 'diterima' ? 'bg-green-100 text-green-600' : '' }}
                        {{ $item->status == 'ditolak' ? 'bg-red-100 text-red-600' : '' }}">
                        {{ $item->status }}
                    </span>
                </td>

                {{-- AKSI --}}
                <td class="p-4 flex gap-2">

                    <a href="#"
                       class="bg-green-500 text-white px-3 py-1 rounded-lg text-sm">
                        Terima
                    </a>

                    <a href="#"
                       class="bg-red-500 text-white px-3 py-1 rounded-lg text-sm">
                        Tolak
                    </a>

                </td>
            </tr>
            @endforeach
        </tbody>

    </table>

</div>

@endsection