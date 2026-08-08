@extends('erapor.layout')

@section('content')

<div class="mb-8 border-b border-gray-100 pb-5">
    <h2 class="text-2xl font-bold text-gray-800">Input Nilai Rapor</h2>
    <p class="text-sm text-gray-500 mt-1">Masukkan data nilai baru dan perkembangan belajar siswa</p>
</div>

<form action="{{ route('erapor.store') }}" method="POST" class="space-y-10">
    @csrf

    {{-- ================= PILIH SISWA INTERACTIVE PICKER ================= --}}
    @php
        $preselectedSiswa = null;
        if(request('siswa_id')) {
            $preselectedSiswa = $siswas->first(function($s) {
                return $s->id == request('siswa_id') || $s->uuid == request('siswa_id');
            });
        }
    @endphp

    <div class="bg-gradient-to-br from-white to-green-50/40 rounded-3xl p-6 sm:p-7 border border-emerald-100 shadow-sm space-y-4">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 pb-3.5 border-b border-slate-100">
            <div>
                <label class="block text-xs font-black text-slate-800 uppercase tracking-wider flex items-center gap-2">
                    <span class="w-6 h-6 rounded-lg bg-green-100 text-green-700 flex items-center justify-center text-xs shadow-2xs">
                        <i class="fa-solid fa-user-graduate"></i>
                    </span>
                    Pilih Peserta Didik (Siswa) <span class="text-red-500">*</span>
                </label>
                <p class="text-xs text-slate-500 mt-0.5 font-medium">Pilih siswa yang akan diisi laporan penilaian dan deskripsi perkembangannya</p>
            </div>
            
            {{-- Semester Selector Pill --}}
            <div class="flex items-center gap-1.5 bg-slate-100/90 p-1 rounded-xl self-start sm:self-auto border border-slate-200/60 shadow-2xs">
                <span class="text-[11px] font-bold text-slate-600 px-2">Semester:</span>
                <label class="cursor-pointer">
                    <input type="radio" name="semester" value="1" checked class="peer sr-only">
                    <span class="px-3 py-1 text-xs font-extrabold rounded-lg transition inline-block peer-checked:bg-white peer-checked:text-green-800 peer-checked:shadow-xs text-slate-500 hover:text-slate-700">1 (Ganjil)</span>
                </label>
                <label class="cursor-pointer">
                    <input type="radio" name="semester" value="2" class="peer sr-only">
                    <span class="px-3 py-1 text-xs font-extrabold rounded-lg transition inline-block peer-checked:bg-white peer-checked:text-green-800 peer-checked:shadow-xs text-slate-500 hover:text-slate-700">2 (Genap)</span>
                </label>
            </div>
        </div>

        {{-- Hidden Input for selected student ID / UUID --}}
        <input type="hidden" name="siswa_id" id="selectedSiswaId" value="{{ $preselectedSiswa ? ($preselectedSiswa->uuid ?? $preselectedSiswa->id) : '' }}" required>

        {{-- Trigger Card --}}
        <div onclick="openPickerSiswaModal()" 
             id="siswaPickerTrigger"
             class="group p-4 sm:p-5 bg-white hover:bg-green-50/50 border-2 {{ $preselectedSiswa ? 'border-green-500/80 bg-green-50/20' : 'border-dashed border-slate-300 hover:border-green-500' }} rounded-2xl flex flex-col sm:flex-row sm:items-center justify-between gap-4 cursor-pointer transition-all duration-200 shadow-2xs">
            
            {{-- Empty State Placeholder --}}
            <div id="siswaPlaceholder" class="flex items-center gap-3.5 {{ $preselectedSiswa ? 'hidden' : '' }}">
                <div class="w-12 h-12 rounded-2xl bg-slate-100 group-hover:bg-green-100 text-slate-400 group-hover:text-green-700 flex items-center justify-center text-lg shrink-0 transition shadow-2xs">
                    <i class="fa-solid fa-user-plus"></i>
                </div>
                <div>
                    <span class="block font-black text-sm text-slate-800 group-hover:text-green-900 transition">
                        Klik di sini untuk Cari & Pilih Siswa
                    </span>
                    <span class="block text-xs text-slate-400 mt-0.5 font-medium">
                        Cari cepat berdasarkan nama lengkap anak, NIS, atau rombel kelas
                    </span>
                </div>
            </div>

            {{-- Selected State Details --}}
            <div id="siswaSelectedView" class="flex items-center gap-3.5 {{ $preselectedSiswa ? '' : 'hidden' }}">
                <div id="siswaSelectedAvatar" class="w-12 h-12 rounded-2xl bg-gradient-to-tr from-green-600 to-emerald-500 text-white font-black flex items-center justify-center text-base shadow-sm shrink-0">
                    {{ $preselectedSiswa ? strtoupper(substr($preselectedSiswa->nama, 0, 1)) : '-' }}
                </div>
                <div>
                    <div class="flex items-center gap-2 flex-wrap">
                        <span id="siswaSelectedNama" class="block font-black text-sm sm:text-base text-slate-900">
                            {{ $preselectedSiswa->nama ?? 'Nama Siswa' }}
                        </span>
                        <span id="siswaSelectedGender" class="inline-flex items-center gap-1 text-[10px] font-extrabold px-2 py-0.5 rounded-md {{ $preselectedSiswa && ($preselectedSiswa->jenis_kelamin == 'L' || $preselectedSiswa->jenis_kelamin == 'Laki-laki') ? 'bg-blue-50 text-blue-700 border border-blue-200' : 'bg-pink-50 text-pink-700 border border-pink-200' }}">
                            {{ $preselectedSiswa && ($preselectedSiswa->jenis_kelamin == 'L' || $preselectedSiswa->jenis_kelamin == 'Laki-laki') ? 'L' : 'P' }}
                        </span>
                    </div>
                    <div class="flex items-center gap-2 text-xs text-slate-500 font-medium mt-1 flex-wrap">
                        <span id="siswaSelectedNis">NIS: {{ $preselectedSiswa->nis ?? '-' }}</span>
                        <span>•</span>
                        <span id="siswaSelectedKelas" class="inline-flex items-center px-2 py-0.5 bg-green-50 text-green-700 rounded-md font-bold text-[11px] border border-green-200">
                            {{ $preselectedSiswa && $preselectedSiswa->kelas ? $preselectedSiswa->kelas->nama_kelas : 'Tanpa Rombel' }}
                        </span>
                    </div>
                </div>
            </div>

            {{-- Action Button --}}
            <div class="shrink-0 flex items-center">
                <span id="siswaPickerBtnText" class="inline-flex items-center gap-2 px-4 py-2.5 bg-gradient-to-r from-green-600 to-emerald-700 hover:from-green-700 hover:to-emerald-800 text-white rounded-xl text-xs font-bold shadow-sm group-hover:shadow-md transition">
                    <i class="fa-solid {{ $preselectedSiswa ? 'fa-arrows-rotate' : 'fa-magnifying-glass' }} text-[11px]"></i>
                    <span>{{ $preselectedSiswa ? 'Ganti Siswa' : 'Cari & Pilih Siswa' }}</span>
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
                <textarea
                    name="agama"
                    rows="5"
                    required
                    class="w-full border border-gray-300 rounded-xl p-4 focus:ring-2 focus:ring-green-500 focus:border-green-500 focus:outline-none transition text-sm text-gray-700"
                    placeholder="Masukkan deskripsi aspek Agama & Budi Pekerti..."
                ></textarea>
            </div>

            {{-- JATI DIRI --}}
            <div class="space-y-2">
                <label class="block text-sm font-semibold text-gray-700">
                    Jati Diri
                </label>
                <textarea
                    name="jati_diri"
                    rows="5"
                    required
                    class="w-full border border-gray-300 rounded-xl p-4 focus:ring-2 focus:ring-green-500 focus:border-green-500 focus:outline-none transition text-sm text-gray-700"
                    placeholder="Masukkan deskripsi aspek Jati Diri..."
                ></textarea>
            </div>

            {{-- LITERASI --}}
            <div class="space-y-2">
                <label class="block text-sm font-semibold text-gray-700">
                    Literasi & Matematika
                </label>
                <textarea
                    name="literasi"
                    rows="5"
                    required
                    class="w-full border border-gray-300 rounded-xl p-4 focus:ring-2 focus:ring-green-500 focus:border-green-500 focus:outline-none transition text-sm text-gray-700"
                    placeholder="Masukkan deskripsi aspek Literasi & Matematika..."
                ></textarea>
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
                    @foreach($indikatorP5 as $i => $item)
                    <tr class="hover:bg-gray-50/50 transition">
                        <td class="p-4 text-center font-medium">{{ $i+1 }}</td>
                        <td class="p-4">
                            <div class="font-bold text-gray-900">{{ $item->dimensi }}</div>
                            <div class="font-medium text-gray-600 mt-0.5">{{ $item->elemen }}</div>
                            <div class="text-xs text-gray-400 mt-1 leading-relaxed">{{ $item->deskripsi }}</div>
                        </td>
                        @foreach(['cukup', 'baik', 'sangat_baik'] as $val)
                        <td class="p-4 text-center">
                            <input
                                type="radio"
                                name="p5[{{ $item->id }}]"
                                value="{{ $val }}"
                                required
                                class="w-5 h-5 text-green-600 focus:ring-green-500 border-gray-300 accent-green-600 cursor-pointer"
                            >
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
                    @foreach($indikatorProfil as $i => $item)
                    <tr class="hover:bg-gray-50/50 transition">
                        <td class="p-4 text-center font-medium">{{ $i+1 }}</td>
                        <td class="p-4">
                            <div class="font-bold text-gray-900">{{ $item->dimensi }}</div>
                            <div class="font-medium text-gray-600 mt-0.5">{{ $item->elemen }}</div>
                            <div class="text-xs text-gray-400 mt-1 leading-relaxed">{{ $item->deskripsi }}</div>
                        </td>
                        @foreach(['cukup', 'baik', 'sangat_baik'] as $val)
                        <td class="p-4 text-center">
                            <input
                                type="radio"
                                name="profil[{{ $item->id }}]"
                                value="{{ $val }}"
                                required
                                class="w-5 h-5 text-green-600 focus:ring-green-500 border-gray-300 accent-green-600 cursor-pointer"
                            >
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
            Simpan Rapor
        </button>
        <a href="{{ route('erapor.dashboard') }}"
           class="inline-flex items-center gap-2 px-6 py-3 bg-gray-100 hover:bg-gray-200 text-gray-700 font-bold rounded-xl transition duration-200 text-sm">
            Batal
        </a>
    </div>

</form>

@endsection

@push('modals')
{{-- ================= MODAL POP-UP PICKER: CARI & PILIH SISWA ================= --}}
<div id="modalPickerSiswa" class="fixed inset-0 bg-slate-900/60 backdrop-blur-xs z-[9999] hidden flex items-center justify-center p-4">
    <div class="bg-white w-full max-w-2xl rounded-3xl p-6 sm:p-7 space-y-5 shadow-2xl border border-slate-100 transform transition-all max-h-[90vh] flex flex-col">
        
        {{-- Modal Header --}}
        <div class="flex items-center justify-between pb-3.5 border-b border-slate-100 shrink-0">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-2xl bg-green-100 text-green-700 flex items-center justify-center font-black shadow-2xs">
                    <i class="fa-solid fa-users text-base"></i>
                </div>
                <div>
                    <h3 class="text-base font-black text-slate-900">Pilih Peserta Didik (Siswa)</h3>
                    <p class="text-[11px] text-slate-500 font-medium">Pilih siswa yang akan diinput nilai rapor Kurikulum Merdeka</p>
                </div>
            </div>
            <button type="button" onclick="closePickerSiswaModal()" class="text-slate-400 hover:text-slate-600 p-2 rounded-xl hover:bg-slate-100 transition">
                <i class="fa-solid fa-xmark text-lg"></i>
            </button>
        </div>

        {{-- Live Search Input --}}
        <div class="relative shrink-0">
            <i class="fa-solid fa-magnifying-glass absolute left-3.5 top-3.5 text-slate-400 text-xs"></i>
            <input type="text" 
                   id="searchModalPickerSiswa"
                   onkeyup="filterModalSiswaCards()"
                   placeholder="Ketik nama anak, NIS, atau rombel kelas..." 
                   class="w-full pl-9 pr-9 py-2.5 rounded-xl border border-slate-200 focus:border-green-600 focus:ring-2 focus:ring-green-100 outline-none text-xs sm:text-sm font-semibold text-slate-800 placeholder:font-normal placeholder:text-slate-400">
            <button type="button" 
                    id="clearSearchSiswaBtn"
                    onclick="clearModalSiswaSearch()" 
                    class="hidden absolute right-3 top-2.5 text-slate-400 hover:text-slate-600 p-1 text-xs">
                <i class="fa-solid fa-circle-xmark"></i>
            </button>
        </div>

        {{-- Student Counter & Info --}}
        <div class="flex items-center justify-between text-xs text-slate-500 px-1 shrink-0">
            <span class="font-medium">Daftar Siswa Tersedia:</span>
            <span id="siswaCounterText" class="font-bold text-green-700 bg-green-50 px-2.5 py-0.5 rounded-lg text-[11px] border border-green-200">
                {{ count($siswas) }} Siswa
            </span>
        </div>

        {{-- Scrollable Student List --}}
        <div id="siswaModalListContainer" class="overflow-y-auto space-y-2.5 pr-1 flex-1 max-h-[50vh]">
            @forelse($siswas as $s)
                @php
                    $hasNilai = $s->nilais && $s->nilais->count() > 0;
                    $gender = $s->jenis_kelamin;
                    $isLaki = ($gender == 'L' || $gender == 'Laki-laki');
                    $genderLabel = $isLaki ? 'L' : 'P';
                    $genderColor = $isLaki ? 'bg-blue-50 text-blue-700 border-blue-200' : 'bg-pink-50 text-pink-700 border-pink-200';
                    $initial = strtoupper(substr($s->nama, 0, 1));
                    $namaKelas = $s->kelas->nama_kelas ?? 'Tanpa Rombel';
                    $identifier = $s->uuid ?? $s->id;
                @endphp
                <div onclick="selectSiswaFromModal('{{ $identifier }}', '{{ addslashes($s->nama) }}', '{{ $s->nis }}', '{{ addslashes($namaKelas) }}', '{{ $genderLabel }}', '{{ $initial }}')"
                     data-nama="{{ strtolower($s->nama) }}"
                     data-nis="{{ strtolower($s->nis) }}"
                     data-kelas="{{ strtolower($namaKelas) }}"
                     class="siswa-modal-card p-3.5 bg-slate-50 hover:bg-green-50/70 border border-slate-200 hover:border-green-400 rounded-2xl flex items-center justify-between cursor-pointer transition-all duration-150 group shadow-2xs">
                    
                    <div class="flex items-center gap-3 overflow-hidden">
                        <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-green-600 to-emerald-500 text-white font-black flex items-center justify-center text-sm shrink-0 shadow-2xs group-hover:scale-105 transition">
                            {{ $initial }}
                        </div>
                        <div class="truncate">
                            <div class="flex items-center gap-2 flex-wrap">
                                <span class="block font-black text-xs sm:text-sm text-slate-800 group-hover:text-green-900 truncate">
                                    {{ $s->nama }}
                                </span>
                                <span class="inline-flex items-center gap-1 text-[10px] font-extrabold px-1.5 py-0.2 rounded border {{ $genderColor }}">
                                    {{ $genderLabel }}
                                </span>
                            </div>
                            <div class="flex items-center gap-2 text-[11px] text-slate-500 font-medium mt-0.5 truncate">
                                <span>NIS: {{ $s->nis ?? '-' }}</span>
                                <span>•</span>
                                <span class="text-slate-700 font-semibold">{{ $namaKelas }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center gap-2 shrink-0 ml-3">
                        @if($hasNilai)
                            <span class="hidden sm:inline-flex items-center gap-1 text-[10px] font-bold px-2 py-0.5 rounded-lg bg-emerald-100 text-emerald-800 border border-emerald-200">
                                <i class="fa-solid fa-check text-[9px]"></i> Rapor Ada
                            </span>
                        @else
                            <span class="hidden sm:inline-flex items-center gap-1 text-[10px] font-bold px-2 py-0.5 rounded-lg bg-slate-200/80 text-slate-600">
                                Nilai Baru
                            </span>
                        @endif
                        <span class="px-3 py-1.5 bg-white group-hover:bg-green-600 text-slate-700 group-hover:text-white border border-slate-200 group-hover:border-green-600 rounded-xl text-xs font-black transition shadow-2xs">
                            Pilih
                        </span>
                    </div>

                </div>
            @empty
                <div class="text-center py-8 text-slate-400 font-semibold">
                    <i class="fa-solid fa-user-slash text-3xl mb-2 block"></i>
                    Belum ada data siswa di kelas yang Anda ampu.
                </div>
            @endforelse

            {{-- Empty Search Result State --}}
            <div id="noMatchSiswa" class="hidden text-center py-8 text-slate-400 font-semibold">
                <i class="fa-solid fa-magnifying-glass text-3xl mb-2 text-slate-300 block"></i>
                Tidak ada siswa yang cocok dengan pencarian Anda.
            </div>
        </div>

        {{-- Modal Footer --}}
        <div class="pt-3 border-t border-slate-100 flex justify-end shrink-0">
            <button type="button" onclick="closePickerSiswaModal()" class="px-4 py-2 bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold rounded-xl text-xs sm:text-sm transition">
                Tutup
            </button>
        </div>

    </div>
</div>
@endpush

@push('scripts')
<script>
    function openPickerSiswaModal() {
        const modal = document.getElementById('modalPickerSiswa');
        modal.classList.remove('hidden');
        document.body.classList.add('overflow-hidden');
        
        // Focus search bar
        setTimeout(() => {
            const input = document.getElementById('searchModalPickerSiswa');
            if (input) {
                input.focus();
                input.select();
            }
        }, 100);
    }

    function closePickerSiswaModal() {
        const modal = document.getElementById('modalPickerSiswa');
        modal.classList.add('hidden');
        document.body.classList.remove('overflow-hidden');
    }

    function clearModalSiswaSearch() {
        const input = document.getElementById('searchModalPickerSiswa');
        input.value = '';
        filterModalSiswaCards();
        input.focus();
    }

    function filterModalSiswaCards() {
        const query = (document.getElementById('searchModalPickerSiswa').value || '').toLowerCase().trim();
        const clearBtn = document.getElementById('clearSearchSiswaBtn');
        const cards = document.querySelectorAll('.siswa-modal-card');
        const noMatch = document.getElementById('noMatchSiswa');
        const counter = document.getElementById('siswaCounterText');

        if (clearBtn) {
            clearBtn.classList.toggle('hidden', query.length === 0);
        }

        let visibleCount = 0;
        cards.forEach(card => {
            const nama = card.getAttribute('data-nama') || '';
            const nis = card.getAttribute('data-nis') || '';
            const kelas = card.getAttribute('data-kelas') || '';

            if (nama.includes(query) || nis.includes(query) || kelas.includes(query)) {
                card.classList.remove('hidden');
                visibleCount++;
            } else {
                card.classList.add('hidden');
            }
        });

        if (noMatch) {
            noMatch.classList.toggle('hidden', visibleCount > 0);
        }

        if (counter) {
            counter.innerText = `${visibleCount} Siswa`;
        }
    }

    function selectSiswaFromModal(id, nama, nis, kelas, gender, initial) {
        // Set hidden input value
        const inputHidden = document.getElementById('selectedSiswaId');
        inputHidden.value = id;

        // Update trigger UI
        const placeholder = document.getElementById('siswaPlaceholder');
        const selectedView = document.getElementById('siswaSelectedView');
        const trigger = document.getElementById('siswaPickerTrigger');
        const btnText = document.getElementById('siswaPickerBtnText');

        placeholder.classList.add('hidden');
        selectedView.classList.remove('hidden');

        document.getElementById('siswaSelectedNama').innerText = nama;
        document.getElementById('siswaSelectedNis').innerText = `NIS: ${nis || '-'}`;
        document.getElementById('siswaSelectedKelas').innerText = kelas || 'Tanpa Rombel';
        document.getElementById('siswaSelectedAvatar').innerText = initial || nama.charAt(0).toUpperCase();

        const genderBadge = document.getElementById('siswaSelectedGender');
        if (gender === 'L') {
            genderBadge.innerText = 'L';
            genderBadge.className = 'inline-flex items-center gap-1 text-[10px] font-extrabold px-2 py-0.5 rounded-md bg-blue-50 text-blue-700 border border-blue-200';
        } else {
            genderBadge.innerText = 'P';
            genderBadge.className = 'inline-flex items-center gap-1 text-[10px] font-extrabold px-2 py-0.5 rounded-md bg-pink-50 text-pink-700 border border-pink-200';
        }

        trigger.classList.remove('border-dashed', 'border-slate-300');
        trigger.classList.add('border-green-500/80', 'bg-green-50/20');

        btnText.innerHTML = `<i class="fa-solid fa-arrows-rotate text-[11px]"></i><span>Ganti Siswa</span>`;

        // Close modal
        closePickerSiswaModal();
    }

    // Close on click outside or Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closePickerSiswaModal();
        }
    });

    document.getElementById('modalPickerSiswa')?.addEventListener('click', function(e) {
        if (e.target === this) {
            closePickerSiswaModal();
        }
    });
</script>
@endpush