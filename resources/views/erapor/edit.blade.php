@extends('erapor.layout')

@section('content')

<h2 class="text-2xl font-bold mb-6">Edit Rapor</h2>

<form action="{{ route('erapor.update', $siswa->id) }}" method="POST">
@csrf
@method('PUT')

{{-- ================= SISWA ================= --}}
<div class="mb-8">
    <label class="block text-sm font-semibold text-gray-700 mb-2">
        Siswa
    </label>

    <input type="text"
        value="{{ $siswa->nama }}"
        class="w-full border border-gray-300 rounded-xl p-3 bg-gray-100"
        readonly>
</div>

{{-- ================= DESKRIPSI ================= --}}
<div class="space-y-8">

    {{-- AGAMA --}}
    <div>
        <h3 class="text-lg font-bold text-gray-800 mb-3">
            I. Agama & Budi Pekerti
        </h3>

        <textarea name="agama" rows="4"
            class="w-full border rounded-xl p-4 focus:ring-2 focus:ring-green-500">
            {{ $nilai->agama ?? '' }}
        </textarea>
    </div>

    {{-- JATI DIRI --}}
    <div>
        <h3 class="text-lg font-bold text-gray-800 mb-3">
            II. Jati Diri
        </h3>

        <textarea name="jati_diri" rows="4"
            class="w-full border rounded-xl p-4 focus:ring-2 focus:ring-green-500">
            {{ $nilai->jati_diri ?? '' }}
        </textarea>
    </div>

    {{-- LITERASI --}}
    <div>
        <h3 class="text-lg font-bold text-gray-800 mb-3">
            III. Literasi & Matematika
        </h3>

        <textarea name="literasi" rows="4"
            class="w-full border rounded-xl p-4 focus:ring-2 focus:ring-green-500">
            {{ $nilai->literasi ?? '' }}
        </textarea>
    </div>

</div>

{{-- ================= P5 ================= --}}
<div class="mt-12">

    <h3 class="text-xl font-bold mb-5">
        IV. P5
    </h3>

    <table class="w-full text-sm border text-center">

        <tr class="bg-gray-100">
            <th class="border p-2">No</th>
            <th class="border p-2">Dimensi</th>
            <th class="border p-2">Elemen</th>
            <th class="border p-2">Cukup</th>
            <th class="border p-2">Baik</th>
            <th class="border p-2">Sangat Baik</th>
        </tr>

        @foreach($indikator as $i => $item)
        @php
            $cek = $nilaiP5->where('indikator_id', $item->id)->first();
        @endphp

        <tr>
            <td class="border p-2">{{ $i+1 }}</td>

            <td class="border p-2">{{ $item->dimensi }}</td>

            <td class="border p-2 text-left">
                {{ $item->elemen }}
            </td>

            {{-- RADIO --}}
            @foreach(['cukup','baik','sangat_baik'] as $val)
            <td class="border">
                <input type="radio"
                    name="p5[{{ $item->id }}]"
                    value="{{ $val }}"
                    {{ ($cek->nilai ?? '') == $val ? 'checked' : '' }}>
            </td>
            @endforeach

        </tr>
        @endforeach

    </table>

</div>

{{-- ================= PROFIL ================= --}}
<div class="mt-12">

    <h3 class="text-xl font-bold mb-5">
        V. Profil Rahmatan Lil Alamin
    </h3>

    <table class="w-full text-sm border text-center">

        <tr class="bg-gray-100">
            <th class="border p-2">No</th>
            <th class="border p-2">Indikator</th>
            <th class="border p-2">Cukup</th>
            <th class="border p-2">Baik</th>
            <th class="border p-2">Sangat Baik</th>
        </tr>

        @foreach($indikatorRahmatan as $i => $item)
        @php
            $cek = $nilaiRahmatan->where('indikator_id', $item->id)->first();
        @endphp

        <tr>
            <td class="border p-2">{{ $i+1 }}</td>

            <td class="border p-2 text-left">
                {{ $item->elemen }}
            </td>

            @foreach(['cukup','baik','sangat_baik'] as $val)
            <td class="border">
                <input type="radio"
                    name="profil[{{ $item->id }}]"
                    value="{{ $val }}"
                    {{ ($cek->nilai ?? '') == $val ? 'checked' : '' }}>
            </td>
            @endforeach

        </tr>
        @endforeach

    </table>

</div>

{{-- BUTTON --}}
<button class="mt-6 bg-green-600 text-white px-6 py-2 rounded">
    Update
</button>

</form>

@endsection