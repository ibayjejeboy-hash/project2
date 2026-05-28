@extends($layout)

@section('content')

<div class="bg-white p-6 rounded-xl shadow">

    {{-- DATA SISWA --}}
    <h2 class="text-2xl font-bold mb-4">RAPOR SISWA</h2>

   
</div>

    <div class="grid grid-cols-2 gap-4 mb-6">
        <p><b>Nama:</b> {{ $siswa->nama }}</p>
        <p><b>NIS:</b> {{ $siswa->nis }}</p>
        <p><b>Kelas:</b> {{ $siswa->kelas->nama_kelas ?? '-' }}</p>
        <p><b>Semester:</b> {{ $nilai->semester ?? '-' }}</p>
    </div>

    {{-- NILAI DESKRIPSI --}}
    <h3 class="text-xl font-bold mb-2">Penilaian</h3>

    <div class="mb-6 space-y-2">
        <p><b>Agama & Budi Pekerti:</b> {{ $nilai->agama ?? '-' }}</p>
        <p><b>Jati Diri:</b> {{ $nilai->jati_diri ?? '-' }}</p>
        <p><b>Literasi & Matematika:</b> {{ $nilai->literasi ?? '-' }}</p>
    </div>

    {{-- P5 --}}
    <h3 class="text-xl font-bold mb-2">Profil Pelajar Pancasila (P5)</h3>

    <table class="w-full border text-sm text-center">
        <tr class="bg-gray-200">
            <th class="border p-2">No</th>
            <th class="border p-2">Indikator</th>
            <th class="border p-2">Nilai</th>
        </tr>

        @foreach($indikator as $i => $item)
        @php
            $cek = $nilaiP5->where('indikator_id', $item->id)->first();
        @endphp

        <tr>
            <td class="border p-2">{{ $i+1 }}</td>

            <td class="border p-2 text-left">
                <b>{{ $item->dimensi }}</b><br>
                {{ $item->elemen }} <br>
                <span class="text-xs text-gray-500">{{ $item->deskripsi }}</span>
            </td>

            <td class="border p-2">
                {{ $cek->nilai ?? '-' }}
            </td>
        </tr>
        @endforeach
        

    </table>

    <h3 class="text-xl font-bold mt-6 mb-2">
    Profil Pelajar Rahmatan Lil Alamin
</h3>

<table class="w-full border text-sm text-center">
    <tr class="bg-gray-200">
        <th class="border p-2">No</th>
        <th class="border p-2">Indikator</th>
        <th class="border p-2">Nilai</th>
    </tr>

    @foreach($indikatorRahmatan as $i => $item)
    @php
        $cek = $nilaiRahmatan->where('indikator_id', $item->id)->first();
    @endphp

    <tr>
        <td class="border p-2">{{ $i+1 }}</td>

        <td class="border p-2 text-left">
            <b>{{ $item->dimensi ?? '-' }}</b><br>
            {{ $item->elemen ?? '-' }} <br>
            <span class="text-xs text-gray-500">
                {{ $item->deskripsi ?? '-' }}
            </span>
        </td>

        <td class="border p-2">
            {{ $cek->nilai ?? '-' }}
        </td>
    </tr>
    @endforeach

    

</table>

 @auth
@if(auth()->user()->role == 'guru' || auth()->user()->role == 'admin')

    <div class="mt-6">
        <a href="{{ route('erapor.edit', $siswa->id) }}"
           class="inline-block bg-yellow-500 text-white px-4 py-2 rounded-lg hover:bg-yellow-600 transition">
             Edit Nilai
        </a>
    </div>

@endif
@endauth

</div>

@endsection