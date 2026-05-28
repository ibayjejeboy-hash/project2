@extends('erapor.layout')

@section('content')

<h2 class="text-2xl font-bold mb-6">Input Rapor</h2>

<form action="{{ route('erapor.store') }}" method="POST">
@csrf

{{-- ================= PILIH SISWA ================= --}}
<div class="mb-8">
    <label class="block text-sm font-semibold text-gray-700 mb-2">
        Pilih Siswa
    </label>

    <select
        name="siswa_id"
        class="w-full border border-gray-300 rounded-xl p-3 focus:ring-2 focus:ring-green-500 focus:outline-none"
    >
        <option value="">-- Pilih Siswa --</option>

        @foreach($siswas as $siswa)
            <option value="{{ $siswa->id }}">
                {{ $siswa->nama }}
            </option>
        @endforeach
    </select>
</div>

{{-- ================= DESKRIPSI ================= --}}
<div class="space-y-8">

    {{-- AGAMA --}}
    <div>
        <h3 class="text-lg font-bold text-gray-800 mb-3">
            I. Agama & Budi Pekerti
        </h3>

        <textarea
            name="agama"
            rows="4"
            class="w-full border border-gray-300 rounded-xl p-4 focus:ring-2 focus:ring-green-500 focus:outline-none"
            placeholder="Masukkan deskripsi agama & budi pekerti..."
        ></textarea>
    </div>

    {{-- JATI DIRI --}}
    <div>
        <h3 class="text-lg font-bold text-gray-800 mb-3">
            II. Jati Diri
        </h3>

        <textarea
            name="jati_diri"
            rows="4"
            class="w-full border border-gray-300 rounded-xl p-4 focus:ring-2 focus:ring-green-500 focus:outline-none"
            placeholder="Masukkan deskripsi jati diri..."
        ></textarea>
    </div>

    {{-- LITERASI --}}
    <div>
        <h3 class="text-lg font-bold text-gray-800 mb-3">
            III. Literasi & Matematika
        </h3>

        <textarea
            name="literasi"
            rows="4"
            class="w-full border border-gray-300 rounded-xl p-4 focus:ring-2 focus:ring-green-500 focus:outline-none"
            placeholder="Masukkan deskripsi literasi & matematika..."
        ></textarea>
    </div>

</div>

{{-- ================= P5 ================= --}}
<div class="mt-12">

    <h3 class="text-xl font-bold text-gray-800 mb-5">
        IV. Proyek Penguatan Profil Pelajar Pancasila (P5)
    </h3>

    <div class="overflow-x-auto rounded-2xl border border-gray-300">

        <table class="w-full text-sm text-center border-collapse">

            <thead class="bg-gray-100 text-gray-700">
                <tr>
                    <th class="border p-3 font-semibold">No</th>
                    <th class="border p-3 font-semibold">Dimensi</th>
                    <th class="border p-3 font-semibold">Elemen</th>
                    <th class="border p-3 font-semibold">Cukup</th>
                    <th class="border p-3 font-semibold">Baik</th>
                    <th class="border p-3 font-semibold">Sangat Baik</th>
                </tr>
            </thead>

            <tbody class="bg-white">

                @foreach($indikatorP5 as $i => $item)

                <tr class="hover:bg-gray-50 transition">

                    {{-- NO --}}
                    <td class="border p-3 align-top">
                        {{ $i + 1 }}
                    </td>

                    {{-- DIMENSI --}}
                    <td class="border p-3 text-left align-top font-medium text-gray-700">
                        {{ $item->dimensi }}
                    </td>

                    {{-- ELEMEN --}}
                    <td class="border p-3 text-left">

                        <div class="font-medium text-gray-800">
                            {{ $item->elemen }}
                        </div>

                        <div class="text-xs text-gray-500 mt-1 leading-relaxed">
                            {{ $item->deskripsi }}
                        </div>

                    </td>

                    {{-- RADIO --}}
                    <td class="border">
                        <input
                            type="radio"
                            name="p5[{{ $item->id }}]"
                            value="cukup"
                            class="w-4 h-4"
                        >
                    </td>

                    <td class="border">
                        <input
                            type="radio"
                            name="p5[{{ $item->id }}]"
                            value="baik"
                            class="w-4 h-4"
                        >
                    </td>

                    <td class="border">
                        <input
                            type="radio"
                            name="p5[{{ $item->id }}]"
                            value="sangat_baik"
                            class="w-4 h-4"
                        >
                    </td>

                </tr>

                @endforeach

            </tbody>

        </table>

    </div>

</div>

{{-- ================= PPRA ================= --}}
<div class="mt-12">

    <h3 class="text-xl font-bold text-gray-800 mb-5">
        V. Profil Pelajar Rohmatan Lil 'Alamin
    </h3>

    <div class="overflow-x-auto rounded-2xl border border-gray-300">

        <table class="w-full text-sm text-center border-collapse">

            {{-- HEADER --}}
            <thead class="bg-gray-100 text-gray-700">
                <tr>
                    <th class="border p-3 font-semibold">No</th>
                    <th class="border p-3 font-semibold">Nilai</th>
                    <th class="border p-3 font-semibold">Indikator PPRA</th>
                    <th class="border p-3 font-semibold">Cukup</th>
                    <th class="border p-3 font-semibold">Baik</th>
                    <th class="border p-3 font-semibold">Sangat Baik</th>
                </tr>
            </thead>

            {{-- BODY --}}
            <tbody class="bg-white">

                @foreach($indikatorProfil as $i => $item)

                <tr class="hover:bg-gray-50 transition">

                    {{-- NOMOR --}}
                    <td class="border p-3 align-top">
                        {{ $i + 1 }}
                    </td>

                    {{-- NILAI / DIMENSI --}}
                    <td class="border p-3 text-left align-top">

                        <div class="font-medium text-gray-800">
                            {{ $item->dimensi }}
                        </div>

                    </td>

                    {{-- DESKRIPSI --}}
                    <td class="border p-3 text-left">

                        <div class="font-medium text-gray-700">
                            {{ $item->elemen }}
                        </div>

                        <div class="text-xs text-gray-500 mt-1 leading-relaxed">
                            {{ $item->deskripsi }}
                        </div>

                    </td>

                    {{-- RADIO CUKUP --}}
                    <td class="border">
                        <input
                            type="radio"
                            name="profil[{{ $item->id }}]"
                            value="cukup"
                            class="w-4 h-4"
                        >
                    </td>

                    {{-- RADIO BAIK --}}
                    <td class="border">
                        <input
                            type="radio"
                            name="profil[{{ $item->id }}]"
                            value="baik"
                            class="w-4 h-4"
                        >
                    </td>

                    {{-- RADIO SANGAT BAIK --}}
                    <td class="border">
                        <input
                            type="radio"
                            name="profil[{{ $item->id }}]"
                            value="sangat_baik"
                            class="w-4 h-4"
                        >
                    </td>

                </tr>

                @endforeach

            </tbody>

        </table>

    </div>

</div>


<button class="mt-6 bg-green-600 text-white px-6 py-2 rounded">
Simpan
</button>

</form>

@endsection