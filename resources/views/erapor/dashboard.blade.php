@extends('erapor.layout')

@section('content')

{{-- Header & Statistik Singkat --}}
<div class="mb-6 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
    <div>
        <h2 class="text-2xl font-black text-slate-800">
            Data E-Rapor Siswa
        </h2>
        <p class="text-xs sm:text-sm text-slate-500 font-medium mt-0.5">
            Kelola pengisian capaian pembelajaran, perkembangan P5, PPRA, dan cetak rapor resmi.
        </p>
    </div>
    <div class="flex items-center gap-2">
        <a href="{{ route('erapor.input') }}"
           class="inline-flex items-center gap-2 px-4 py-2.5 bg-green-600 hover:bg-green-700 text-white rounded-xl text-xs sm:text-sm font-bold shadow-md shadow-green-600/20 transition">
            <i class="fa-solid fa-pen-to-square"></i>
            <span>Input Nilai Baru</span>
        </a>
    </div>
</div>

@php
    $totalSiswa = $siswas->count();
    $sudahDinilai = $siswas->filter(fn($s) => $s->nilais->count() > 0)->count();
    $belumDinilai = $totalSiswa - $sudahDinilai;
@endphp

{{-- Stat Cards --}}
<div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-6">
    <div class="bg-white p-4 rounded-2xl border border-slate-100 shadow-sm flex items-center gap-3.5">
        <div class="w-11 h-11 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center text-lg font-bold">
            <i class="fa-solid fa-users"></i>
        </div>
        <div>
            <span class="text-[11px] font-bold text-slate-400 uppercase tracking-wider">Total Siswa</span>
            <h3 class="text-xl font-black text-slate-800 leading-tight">{{ $totalSiswa }}</h3>
        </div>
    </div>

    <div class="bg-white p-4 rounded-2xl border border-slate-100 shadow-sm flex items-center gap-3.5">
        <div class="w-11 h-11 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center text-lg font-bold">
            <i class="fa-solid fa-circle-check"></i>
        </div>
        <div>
            <span class="text-[11px] font-bold text-emerald-600 uppercase tracking-wider">Sudah Dinilai</span>
            <h3 class="text-xl font-black text-emerald-700 leading-tight">{{ $sudahDinilai }}</h3>
        </div>
    </div>

    <div class="bg-white p-4 rounded-2xl border border-slate-100 shadow-sm flex items-center gap-3.5">
        <div class="w-11 h-11 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center text-lg font-bold">
            <i class="fa-solid fa-clock"></i>
        </div>
        <div>
            <span class="text-[11px] font-bold text-amber-600 uppercase tracking-wider">Belum Dinilai</span>
            <h3 class="text-xl font-black text-amber-700 leading-tight">{{ $belumDinilai }}</h3>
        </div>
    </div>
</div>

{{-- Tabel Siswa --}}
<div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-xs sm:text-sm text-left border-collapse">
            <thead>
                <tr class="bg-slate-50/80 text-slate-600 border-b border-slate-100 text-[11px] uppercase tracking-wider">
                    <th class="py-3.5 px-4 font-bold text-center w-14">No</th>
                    <th class="py-3.5 px-4 font-bold">Nama Siswa</th>
                    <th class="py-3.5 px-4 font-bold text-center">NIS</th>
                    <th class="py-3.5 px-4 font-bold text-center">Kelas / Rombel</th>
                    <th class="py-3.5 px-4 font-bold text-center">Status Rapor</th>
                    <th class="py-3.5 px-4 font-bold text-center w-60">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 text-slate-700">
                @forelse($siswas as $i => $siswa)
                @php
                    $hasNilai = $siswa->nilais->count() > 0;
                @endphp
                <tr class="hover:bg-slate-50/60 transition">
                    <td class="py-3.5 px-4 text-center font-bold text-slate-400">{{ $i+1 }}</td>
                    <td class="py-3.5 px-4">
                        <div class="font-bold text-slate-800">{{ $siswa->nama }}</div>
                        <span class="text-[11px] text-slate-400 font-medium">{{ $siswa->jenis_kelamin ?? 'Peserta Didik' }}</span>
                    </td>
                    <td class="py-3.5 px-4 text-center font-mono font-bold text-slate-600">{{ $siswa->nis ?? '-' }}</td>
                    <td class="py-3.5 px-4 text-center">
                        <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-bold bg-green-50 text-green-700 border border-green-200">
                            {{ $siswa->kelas->nama_kelas ?? 'Belum Diatur' }}
                        </span>
                    </td>
                    <td class="py-3.5 px-4 text-center">
                        @if($hasNilai)
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[11px] font-bold bg-emerald-100 text-emerald-800 border border-emerald-200">
                                <i class="fa-solid fa-circle-check text-[10px]"></i> Sudah Dinilai
                            </span>
                        @else
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[11px] font-bold bg-amber-100 text-amber-800 border border-amber-200">
                                <i class="fa-solid fa-clock text-[10px]"></i> Belum Dinilai
                            </span>
                        @endif
                    </td>
                    <td class="py-3.5 px-4 text-center">
                        <div class="flex items-center justify-center gap-1.5">
                            @if($hasNilai)
                                {{-- LIHAT --}}
                                <a href="{{ route('erapor.hasil', $siswa->uuid ?? $siswa->id) }}"
                                   class="inline-flex items-center gap-1 px-2.5 py-1.5 bg-blue-50 hover:bg-blue-600 text-blue-700 hover:text-white border border-blue-200 hover:border-blue-600 font-bold rounded-lg text-xs transition">
                                    <i class="fa-solid fa-eye text-[11px]"></i>
                                    <span>Lihat</span>
                                </a>

                                {{-- EDIT --}}
                                <a href="{{ route('erapor.edit', $siswa->uuid ?? $siswa->id) }}"
                                   class="inline-flex items-center gap-1 px-2.5 py-1.5 bg-amber-50 hover:bg-amber-600 text-amber-700 hover:text-white border border-amber-200 hover:border-amber-600 font-bold rounded-lg text-xs transition">
                                    <i class="fa-solid fa-pen text-[11px]"></i>
                                    <span>Edit</span>
                                </a>

                                {{-- CETAK PDF --}}
                                <a href="{{ route('erapor.cetak', $siswa->uuid ?? $siswa->id) }}"
                                   class="inline-flex items-center gap-1 px-2.5 py-1.5 bg-emerald-600 hover:bg-emerald-700 text-white font-bold rounded-lg text-xs shadow-sm transition">
                                    <i class="fa-solid fa-print text-[11px]"></i>
                                    <span>Cetak</span>
                                </a>
                            @else
                                {{-- INPUT NILAI --}}
                                <a href="{{ route('erapor.input') }}"
                                   class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-green-600 hover:bg-green-700 text-white font-bold rounded-lg text-xs shadow-sm transition">
                                    <i class="fa-solid fa-pen-to-square text-[11px]"></i>
                                    <span>Isi Nilai</span>
                                </a>
                            @endif
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="py-10 text-center text-slate-400 font-medium">
                        <i class="fa-solid fa-user-graduate text-3xl mb-2 block text-slate-300"></i>
                        Belum ada data siswa yang terdaftar di kelas ini.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection