@extends('layouts.admin')

@section('content')

<h2 class="text-2xl font-bold mb-6">Data Guru</h2>

{{-- ================= FORM TAMBAH GURU ================= --}}
<div class="bg-white p-6 rounded-xl shadow mb-6">

    <form method="POST" action="{{ route('admin.guru.store') }}" class="space-y-4">
        @csrf

        <div>
            <label class="block font-semibold mb-1">Nama Guru</label>
            <input type="text" name="name"
                placeholder="Masukkan nama guru"
                class="w-full border p-2 rounded">
        </div>

        <div>
            <label class="block font-semibold mb-1">Email</label>
            <input type="email" name="email"
                placeholder="Masukkan email"
                class="w-full border p-2 rounded">
        </div>

        <div>
            <label class="block font-semibold mb-1">Password</label>
            <input type="password" name="password"
                placeholder="Masukkan password"
                class="w-full border p-2 rounded">
        </div>

        <div>
            <label class="block font-semibold mb-1">Wali Kelas</label>
            <select name="kelas_id" class="w-full border p-2 rounded">
                <option value="">-- Pilih Kelas --</option>

                @foreach($kelas as $k)
                    <option value="{{ $k->id }}">
                        {{ $k->nama_kelas }}
                    </option>
                @endforeach
            </select>
        </div>

        <button class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded font-semibold">
            Tambah Guru
        </button>

    </form>

</div>

{{-- ================= LIST GURU ================= --}}
<div class="bg-white p-6 rounded-xl shadow">

    <h3 class="text-lg font-semibold mb-4">Daftar Guru</h3>

    <table class="w-full text-sm border">
        <thead>
            <tr class="bg-gray-200 text-center">
                <th class="p-2 border">No</th>
                <th class="p-2 border">Nama</th>
                <th class="p-2 border">Email</th>
                <th class="p-2 border">Wali Kelas</th>
            </tr>
        </thead>

        <tbody>
            @foreach($gurus as $i => $g)
            <tr class="text-center hover:bg-gray-50">
                <td class="border p-2">{{ $i+1 }}</td>
                <td class="border p-2 text-left">{{ $g->name }}</td>
                <td class="border p-2">{{ $g->email }}</td>
                <td class="border p-2">
                    {{ \App\Models\Kelas::where('wali_kelas_id', $g->id)->value('nama_kelas') ?? '-' }}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

</div>

@endsection