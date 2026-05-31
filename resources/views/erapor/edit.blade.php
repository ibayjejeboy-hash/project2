@extends('erapor.layout')

@section('content')

<div class="mb-8 border-b border-gray-100 pb-5 flex items-center justify-between">
    <div>
        <h2 class="text-2xl font-bold text-gray-800">Edit Nilai Rapor</h2>
        <p class="text-sm text-gray-500 mt-1">Perbarui hasil penilaian belajar siswa</p>
    </div>
    <a href="{{ route('erapor.hasil', $siswa->id) }}" class="inline-flex items-center gap-1 text-sm font-semibold text-green-600 hover:text-green-700 transition">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
        </svg>
        Kembali ke Rapor
    </a>
</div>

<form action="{{ route('erapor.update', $siswa->id) }}" method="POST" class="space-y-10">
    @csrf
    @method('PUT')

    {{-- ================= SISWA INFO ================= --}}
    <div class="bg-gray-50 rounded-2xl p-6 border border-gray-100">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
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
        </div>
    </div>

    {{-- ================= DESKRIPSI ================= --}}
    <div class="space-y-6">
        <h3 class="text-lg font-bold text-gray-800 flex items-center gap-2 border-b border-gray-100 pb-3">
            <span class="flex items-center justify-center w-6 h-6 rounded-full bg-blue-50 text-blue-600 text-xs font-bold">I</span>
            Nilai Deskripsi & Perkembangan
        </h3>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            {{-- AGAMA --}}
            <div class="space-y-2">
                <label class="block text-sm font-semibold text-gray-700">
                    Nilai Agama & Budi Pekerti
                </label>
                <textarea name="agama" rows="5"
                    class="w-full border border-gray-300 rounded-xl p-4 focus:ring-2 focus:ring-green-500 focus:border-green-500 focus:outline-none transition text-sm text-gray-700"
                    placeholder="Masukkan deskripsi aspek Agama & Budi Pekerti...">{{ $nilai->agama ?? '' }}</textarea>
            </div>

            {{-- JATI DIRI --}}
            <div class="space-y-2">
                <label class="block text-sm font-semibold text-gray-700">
                    Jati Diri
                </label>
                <textarea name="jati_diri" rows="5"
                    class="w-full border border-gray-300 rounded-xl p-4 focus:ring-2 focus:ring-green-500 focus:border-green-500 focus:outline-none transition text-sm text-gray-700"
                    placeholder="Masukkan deskripsi aspek Jati Diri...">{{ $nilai->jati_diri ?? '' }}</textarea>
            </div>

            {{-- LITERASI --}}
            <div class="space-y-2">
                <label class="block text-sm font-semibold text-gray-700">
                    Literasi & Matematika
                </label>
                <textarea name="literasi" rows="5"
                    class="w-full border border-gray-300 rounded-xl p-4 focus:ring-2 focus:ring-green-500 focus:border-green-500 focus:outline-none transition text-sm text-gray-700"
                    placeholder="Masukkan deskripsi aspek Literasi & Matematika...">{{ $nilai->literasi ?? '' }}</textarea>
            </div>
        </div>
    </div>

    {{-- ================= P5 ================= --}}
    <div>
        <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center gap-2 border-b border-gray-100 pb-3">
            <span class="flex items-center justify-center w-6 h-6 rounded-full bg-emerald-50 text-emerald-600 text-xs font-bold">II</span>
            Profil Pelajar Pancasila (P5)
        </h3>

        <div class="overflow-x-auto rounded-xl border border-gray-200">
            <table class="w-full text-sm text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50 text-gray-700 border-b border-gray-200">
                        <th class="p-4 font-semibold text-center w-16">No</th>
                        <th class="p-4 font-semibold">Dimensi / Elemen / Deskripsi</th>
                        <th class="p-4 font-semibold text-center w-28">Cukup</th>
                        <th class="p-4 font-semibold text-center w-28">Baik</th>
                        <th class="p-4 font-semibold text-center w-28">Sangat Baik</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 text-gray-700 bg-white">
                    @foreach($indikator as $i => $item)
                    @php
                        $cek = $nilaiP5->where('indikator_id', $item->id)->first();
                    @endphp
                    <tr class="hover:bg-gray-50/50 transition">
                        <td class="p-4 text-center font-medium">{{ $i+1 }}</td>
                        <td class="p-4">
                            <div class="font-bold text-gray-900">{{ $item->dimensi }}</div>
                            <div class="font-medium text-gray-600 mt-0.5">{{ $item->elemen }}</div>
                            <div class="text-xs text-gray-400 mt-1 leading-relaxed">{{ $item->deskripsi }}</div>
                        </td>
                        @foreach(['cukup', 'baik', 'sangat_baik'] as $val)
                        <td class="p-4 text-center">
                            <input type="radio"
                                name="p5[{{ $item->id }}]"
                                value="{{ $val }}"
                                class="w-5 h-5 text-green-600 focus:ring-green-500 border-gray-300 accent-green-600 cursor-pointer"
                                {{ ($cek->nilai ?? '') == $val ? 'checked' : '' }}>
                        </td>
                        @endforeach
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- ================= PPRA ================= --}}
    <div>
        <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center gap-2 border-b border-gray-100 pb-3">
            <span class="flex items-center justify-center w-6 h-6 rounded-full bg-amber-50 text-amber-600 text-xs font-bold">III</span>
            Profil Pelajar Rahmatan Lil Alamin (PPRA)
        </h3>

        <div class="overflow-x-auto rounded-xl border border-gray-200">
            <table class="w-full text-sm text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50 text-gray-700 border-b border-gray-200">
                        <th class="p-4 font-semibold text-center w-16">No</th>
                        <th class="p-4 font-semibold">Dimensi / Elemen / Deskripsi</th>
                        <th class="p-4 font-semibold text-center w-28">Cukup</th>
                        <th class="p-4 font-semibold text-center w-28">Baik</th>
                        <th class="p-4 font-semibold text-center w-28">Sangat Baik</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 text-gray-700 bg-white">
                    @foreach($indikatorRahmatan as $i => $item)
                    @php
                        $cek = $nilaiRahmatan->where('indikator_id', $item->id)->first();
                    @endphp
                    <tr class="hover:bg-gray-50/50 transition">
                        <td class="p-4 text-center font-medium">{{ $i+1 }}</td>
                        <td class="p-4">
                            <div class="font-bold text-gray-900">{{ $item->dimensi ?? '-' }}</div>
                            <div class="font-medium text-gray-600 mt-0.5">{{ $item->elemen ?? '-' }}</div>
                            <div class="text-xs text-gray-400 mt-1 leading-relaxed">{{ $item->deskripsi ?? '-' }}</div>
                        </td>
                        @foreach(['cukup', 'baik', 'sangat_baik'] as $val)
                        <td class="p-4 text-center">
                            <input type="radio"
                                name="profil[{{ $item->id }}]"
                                value="{{ $val }}"
                                class="w-5 h-5 text-green-600 focus:ring-green-500 border-gray-300 accent-green-600 cursor-pointer"
                                {{ ($cek->nilai ?? '') == $val ? 'checked' : '' }}>
                        </td>
                        @endforeach
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- BUTTON --}}
    <div class="pt-5 border-t border-gray-100 flex gap-3">
        <button type="submit"
            class="inline-flex items-center gap-2 px-6 py-3 bg-green-600 hover:bg-green-700 text-white font-bold rounded-xl shadow transition duration-200 text-sm cursor-pointer">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"/>
            </svg>
            Simpan Perubahan
        </button>
        <a href="{{ route('erapor.hasil', $siswa->id) }}"
           class="inline-flex items-center gap-2 px-6 py-3 bg-gray-100 hover:bg-gray-200 text-gray-700 font-bold rounded-xl transition duration-200 text-sm">
            Batal
        </a>
    </div>

</form>

@endsection