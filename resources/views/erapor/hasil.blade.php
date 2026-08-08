@extends($layout)

@section('content')

<div class="mb-8 border-b border-gray-100 pb-5">
    <h2 class="text-2xl font-bold text-gray-800">RAPOR SISWA</h2>
    <p class="text-sm text-gray-500 mt-1">Laporan Hasil Belajar (Rapor) Kurikulum Merdeka</p>
</div>

{{-- DATA IDENTITAS --}}
<div class="bg-gray-50 rounded-2xl p-6 mb-8 border border-gray-100">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <div>
            <span class="block text-xs font-semibold text-gray-400 uppercase tracking-wider">Nama Lengkap</span>
            <span class="block text-base font-bold text-gray-800 mt-1">{{ $siswa->nama }}</span>
        </div>
        <div>
            <span class="block text-xs font-semibold text-gray-400 uppercase tracking-wider">Nomor Induk Siswa (NIS)</span>
            <span class="block text-base font-bold text-gray-800 mt-1">{{ $siswa->nis }}</span>
        </div>
        <div>
            <span class="block text-xs font-semibold text-gray-400 uppercase tracking-wider">Kelas</span>
            <span class="block text-base font-bold text-gray-800 mt-1">
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-50 text-green-700 border border-green-200">
                    {{ $siswa->kelas->nama_kelas ?? '-' }}
                </span>
            </span>
        </div>
        <div>
            <span class="block text-xs font-semibold text-gray-400 uppercase tracking-wider">Semester</span>
            <span class="block text-base font-bold text-gray-800 mt-1">Semester {{ $nilai->semester ?? '-' }}</span>
        </div>
    </div>
</div>

{{-- NILAI DESKRIPSI --}}
<div class="mb-8">
    <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center gap-2">
        <span class="flex items-center justify-center w-6 h-6 rounded-full bg-blue-50 text-blue-600 text-xs font-bold">1</span>
        Nilai Deskripsi & Perkembangan
    </h3>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        {{-- AGAMA --}}
        <div class="bg-white rounded-xl border border-gray-100 p-5 shadow-sm hover:shadow transition">
            <h4 class="font-bold text-gray-800 border-b border-gray-100 pb-2 mb-3 text-sm flex items-center justify-between">
                <span>Nilai Agama & Budi Pekerti</span>
                <span class="px-2 py-0.5 bg-indigo-50 text-indigo-700 text-xxs font-semibold rounded uppercase">Aspek I</span>
            </h4>
            <p class="text-sm text-gray-600 leading-relaxed whitespace-pre-line">{{ $nilai->agama ?? 'Belum ada deskripsi.' }}</p>
        </div>

        {{-- JATI DIRI --}}
        <div class="bg-white rounded-xl border border-gray-100 p-5 shadow-sm hover:shadow transition">
            <h4 class="font-bold text-gray-800 border-b border-gray-100 pb-2 mb-3 text-sm flex items-center justify-between">
                <span>Jati Diri</span>
                <span class="px-2 py-0.5 bg-rose-50 text-rose-700 text-xxs font-semibold rounded uppercase">Aspek II</span>
            </h4>
            <p class="text-sm text-gray-600 leading-relaxed whitespace-pre-line">{{ $nilai->jati_diri ?? 'Belum ada deskripsi.' }}</p>
        </div>

        {{-- LITERASI --}}
        <div class="bg-white rounded-xl border border-gray-100 p-5 shadow-sm hover:shadow transition">
            <h4 class="font-bold text-gray-800 border-b border-gray-100 pb-2 mb-3 text-sm flex items-center justify-between">
                <span>Literasi & Matematika</span>
                <span class="px-2 py-0.5 bg-amber-50 text-amber-700 text-xxs font-semibold rounded uppercase">Aspek III</span>
            </h4>
            <p class="text-sm text-gray-600 leading-relaxed whitespace-pre-line">{{ $nilai->literasi ?? 'Belum ada deskripsi.' }}</p>
        </div>
    </div>
</div>

{{-- P5 --}}
<div class="mb-8">
    <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center gap-2">
        <span class="flex items-center justify-center w-6 h-6 rounded-full bg-emerald-50 text-emerald-600 text-xs font-bold">2</span>
        Profil Pelajar Pancasila (P5)
    </h3>

    <div class="overflow-x-auto rounded-xl border border-gray-200">
        <table class="w-full text-sm text-left border-collapse">
            <thead>
                <tr class="bg-gray-50 text-gray-700 border-b border-gray-200">
                    <th class="p-4 font-semibold text-center w-16">No</th>
                    <th class="p-4 font-semibold">Dimensi / Elemen / Deskripsi</th>
                    <th class="p-4 font-semibold text-center w-36">Ketercapaian</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 text-gray-700 bg-white">
                @foreach($indikator as $i => $item)
                @php
                    $cek = $nilaiP5->where('indikator_id', $item->id)->first();
                    $badgeClass = 'bg-gray-100 text-gray-800 border border-gray-200';
                    $valRaw = strtolower($cek->nilai ?? '');
                    $valText = '-';

                    if(in_array($valRaw, ['sangat_baik', 'bsb'])) {
                        $badgeClass = 'bg-emerald-100 text-emerald-800 border border-emerald-200';
                        $valText = 'BSB (Sangat Baik)';
                    } elseif(in_array($valRaw, ['baik', 'bsh'])) {
                        $badgeClass = 'bg-blue-100 text-blue-800 border border-blue-200';
                        $valText = 'BSH (Sesuai Harapan)';
                    } elseif(in_array($valRaw, ['cukup', 'mb'])) {
                        $badgeClass = 'bg-amber-100 text-amber-800 border border-amber-200';
                        $valText = 'MB (Mulai Berkembang)';
                    } elseif(in_array($valRaw, ['kurang', 'bb'])) {
                        $badgeClass = 'bg-rose-100 text-rose-800 border border-rose-200';
                        $valText = 'BB (Belum Berkembang)';
                    }
                @endphp
                <tr class="hover:bg-gray-50/50 transition">
                    <td class="p-4 text-center font-medium">{{ $i+1 }}</td>
                    <td class="p-4">
                        <div class="font-bold text-gray-900">{{ $item->dimensi }}</div>
                        <div class="font-medium text-gray-600 mt-0.5">{{ $item->elemen }}</div>
                        <div class="text-xs text-gray-400 mt-1 leading-relaxed">{{ $item->deskripsi }}</div>
                    </td>
                    <td class="p-4 text-center">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold {{ $badgeClass }}">
                            {{ $valText }}
                        </span>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

{{-- PPRA --}}
<div class="mb-8">
    <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center gap-2">
        <span class="flex items-center justify-center w-6 h-6 rounded-full bg-amber-50 text-amber-600 text-xs font-bold">3</span>
        Profil Pelajar Rahmatan Lil Alamin (PPRA)
    </h3>

    <div class="overflow-x-auto rounded-xl border border-gray-200">
        <table class="w-full text-sm text-left border-collapse">
            <thead>
                <tr class="bg-gray-50 text-gray-700 border-b border-gray-200">
                    <th class="p-4 font-semibold text-center w-16">No</th>
                    <th class="p-4 font-semibold">Dimensi / Elemen / Deskripsi</th>
                    <th class="p-4 font-semibold text-center w-36">Ketercapaian</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 text-gray-700 bg-white">
                @foreach($indikatorRahmatan as $i => $item)
                @php
                    $cek = $nilaiRahmatan->where('indikator_id', $item->id)->first();
                    $badgeClass = 'bg-gray-100 text-gray-800 border border-gray-200';
                    $valRaw = strtolower($cek->nilai ?? '');
                    $valText = '-';

                    if(in_array($valRaw, ['sangat_baik', 'bsb'])) {
                        $badgeClass = 'bg-emerald-100 text-emerald-800 border border-emerald-200';
                        $valText = 'BSB (Sangat Baik)';
                    } elseif(in_array($valRaw, ['baik', 'bsh'])) {
                        $badgeClass = 'bg-blue-100 text-blue-800 border border-blue-200';
                        $valText = 'BSH (Sesuai Harapan)';
                    } elseif(in_array($valRaw, ['cukup', 'mb'])) {
                        $badgeClass = 'bg-amber-100 text-amber-800 border border-amber-200';
                        $valText = 'MB (Mulai Berkembang)';
                    } elseif(in_array($valRaw, ['kurang', 'bb'])) {
                        $badgeClass = 'bg-rose-100 text-rose-800 border border-rose-200';
                        $valText = 'BB (Belum Berkembang)';
                    }
                @endphp
                <tr class="hover:bg-gray-50/50 transition">
                    <td class="p-4 text-center font-medium">{{ $i+1 }}</td>
                    <td class="p-4">
                        <div class="font-bold text-gray-900">{{ $item->dimensi ?? '-' }}</div>
                        <div class="font-medium text-gray-600 mt-0.5">{{ $item->elemen ?? '-' }}</div>
                        <div class="text-xs text-gray-400 mt-1 leading-relaxed">{{ $item->deskripsi ?? '-' }}</div>
                    </td>
                    <td class="p-4 text-center">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold {{ $badgeClass }}">
                            {{ $valText }}
                        </span>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@auth
@if(auth()->user()->role == 'guru' || auth()->user()->role == 'admin')
<div class="mt-8 pt-5 border-t border-gray-100 flex flex-wrap items-center gap-3">
    <a href="{{ route('erapor.edit', $siswa->uuid ?? $siswa->id) }}"
       class="inline-flex items-center gap-2 px-5 py-2.5 bg-amber-500 hover:bg-amber-600 text-white font-bold rounded-xl shadow transition duration-200 text-sm">
        <i class="fa-solid fa-pen-to-square text-xs"></i>
        <span>Edit Nilai Rapor</span>
    </a>
    <a href="{{ route('erapor.cetak', $siswa->uuid ?? $siswa->id) }}"
       class="inline-flex items-center gap-2 px-5 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white font-bold rounded-xl shadow transition duration-200 text-sm">
        <i class="fa-solid fa-print text-xs"></i>
        <span>Cetak Rapor (PDF)</span>
    </a>
</div>
@endif
@endauth

@endsection