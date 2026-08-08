@extends('layouts.admin')

@section('title', 'Manajemen Rombel & Wali Kelas - RA Al Musyaffallah')
@section('page_title', 'Rombongan Belajar (Kelas)')

@section('content')

<div class="space-y-8">

    {{-- Page Header --}}
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl sm:text-3xl font-black text-slate-900 tracking-tight">
                Manajemen Rombel & Wali Kelas
            </h1>
            <p class="text-xs sm:text-sm text-slate-500 font-medium mt-1">
                Kelola data rombongan belajar (kelompok usia) dan penetapan penugasan dewan guru sebagai wali kelas.
            </p>
        </div>
        <div class="flex items-center gap-2">
            <span class="px-3.5 py-1.5 bg-green-100 text-green-800 font-black rounded-xl text-xs">
                Total Rombel: {{ count($kelas) }} Kelas
            </span>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
        
        {{-- ================= FORM TAMBAH KELAS (Left 4 Cols) ================= --}}
        <div class="lg:col-span-4 bg-white p-6 sm:p-7 rounded-3xl border border-slate-100 shadow-sm space-y-6 sticky top-24">
            <div class="flex items-center gap-3 pb-4 border-b border-slate-100">
                <div class="w-10 h-10 rounded-2xl bg-green-100 text-green-700 flex items-center justify-center font-black">
                    <i class="fa-solid fa-school text-base"></i>
                </div>
                <div>
                    <h2 class="text-base font-black text-slate-900">Tambah Kelas Baru</h2>
                    <p class="text-[11px] text-slate-500">Buat rombel atau kelompok usia baru</p>
                </div>
            </div>

            <form method="POST" action="{{ route('admin.kelas.store') }}" class="space-y-4">
                @csrf

                <div>
                    <label class="block text-xs font-extrabold text-slate-700 uppercase tracking-wider mb-1.5">
                        Nama Rombel / Kelas <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                            <i class="fa-solid fa-chalkboard text-xs"></i>
                        </div>
                        <input type="text" 
                               name="nama_kelas" 
                               value="{{ old('nama_kelas') }}"
                               placeholder="Contoh: Kelompok Bermain (KB) / Kelompok A"
                               class="w-full pl-9 pr-3.5 py-2.5 rounded-xl border border-slate-200 focus:border-green-600 focus:ring-2 focus:ring-green-100 outline-none text-xs sm:text-sm text-slate-800 font-semibold"
                               required>
                    </div>
                </div>

                {{-- MODAL TRIGGER: TUGASKAN WALI KELAS --}}
                <div class="space-y-1.5">
                    <label class="block text-xs font-extrabold text-slate-700 uppercase tracking-wider">
                        Tugaskan Wali Kelas
                    </label>
                    
                    {{-- Hidden Form Input --}}
                    <input type="hidden" name="wali_kelas_id" id="tambahWaliKelasId" value="">

                    {{-- Trigger Card --}}
                    <div onclick="openPickerWaliModal('tambah')" 
                         class="group p-3 bg-slate-50 hover:bg-green-50/50 border border-slate-200 hover:border-green-400 rounded-2xl flex items-center justify-between cursor-pointer transition shadow-2xs">
                        <div class="flex items-center gap-2.5 overflow-hidden">
                            <div id="iconTambahWali" class="w-8 h-8 rounded-xl bg-slate-200 text-slate-600 group-hover:bg-green-100 group-hover:text-green-700 flex items-center justify-center text-xs shrink-0 transition">
                                <i class="fa-solid fa-user-slash"></i>
                            </div>
                            <div class="truncate">
                                <span id="labelTambahWali" class="block font-bold text-xs text-slate-800 truncate">
                                    Belum Ditentukan
                                </span>
                                <span id="sublabelTambahWali" class="block text-[10px] text-slate-400 truncate">
                                    Kosongkan / Belum ada wali
                                </span>
                            </div>
                        </div>
                        <span class="inline-flex items-center gap-1 px-2.5 py-1 bg-white group-hover:bg-green-600 text-slate-600 group-hover:text-white border border-slate-200 group-hover:border-green-600 rounded-xl text-[11px] font-bold transition shrink-0 ml-2 shadow-2xs">
                            <i class="fa-solid fa-magnifying-glass text-[9px]"></i>
                            <span>Pilih</span>
                        </span>
                    </div>
                    <p class="text-[11px] text-slate-400">
                        *Satu guru hanya dapat menjadi wali di 1 rombel kelas.
                    </p>
                </div>

                <button type="submit" 
                        class="w-full inline-flex items-center justify-center gap-2 bg-gradient-to-r from-green-600 to-emerald-700 hover:from-green-700 hover:to-emerald-800 text-white font-black py-3 px-4 rounded-xl shadow-md transition duration-200 text-xs sm:text-sm uppercase tracking-wide mt-2">
                    <i class="fa-solid fa-plus"></i>
                    <span>Simpan Rombel Kelas</span>
                </button>
            </form>
        </div>

        {{-- ================= DAFTAR KELAS & EDIT (Right 8 Cols) ================= --}}
        <div class="lg:col-span-8 space-y-6">
            
            <div class="bg-white p-6 sm:p-7 rounded-3xl border border-slate-100 shadow-sm space-y-5">
                
                {{-- Table Header & Live Search --}}
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                    <div>
                        <h3 class="text-base font-black text-slate-900">Daftar Rombongan Belajar (Kelas)</h3>
                        <p class="text-xs text-slate-500">Ubah nama kelas, ganti wali kelas, atau pantau siswa aktif.</p>
                    </div>

                    {{-- Search Filter Kelas --}}
                    <div class="relative">
                        <i class="fa-solid fa-magnifying-glass absolute left-3 top-2.5 text-slate-400 text-xs"></i>
                        <input type="text" 
                               id="searchKelasTable" 
                               onkeyup="filterKelasCards()" 
                               placeholder="Cari rombel / wali..." 
                               class="pl-8 pr-3.5 py-2 text-xs rounded-xl border border-slate-200 focus:border-green-600 outline-none w-52">
                    </div>
                </div>

                <div id="containerListKelas" class="space-y-4">
                    @forelse($kelas as $k)
                    <div class="card-kelas-item p-5 rounded-2xl border border-slate-200/80 bg-slate-50/50 hover:bg-slate-50 transition-all duration-200 space-y-4">
                        
                        {{-- Class Info Header --}}
                        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-xl bg-green-700 text-lime-300 font-black flex items-center justify-center text-sm shadow-xs">
                                    <i class="fa-solid fa-users-rectangle"></i>
                                </div>
                                <div>
                                    <h4 class="font-extrabold text-slate-900 text-sm sm:text-base nama-rombel-text">{{ $k->nama_kelas }}</h4>
                                    <div class="flex items-center gap-2 mt-0.5">
                                        <span class="inline-flex items-center gap-1 text-[11px] font-bold text-slate-600">
                                            <i class="fa-solid fa-user-graduate text-green-600"></i>
                                            <span>{{ $k->siswa_count }} Siswa Terdaftar</span>
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class="flex items-center gap-2">
                                <button type="button" 
                                        onclick="toggleEditKelasModal({{ $k->id }})" 
                                        class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-blue-50 hover:bg-blue-600 text-blue-700 hover:text-white border border-blue-200 hover:border-blue-600 rounded-xl text-xs font-bold transition">
                                    <i class="fa-solid fa-pen-to-square text-[11px]"></i>
                                    <span>Edit & Ganti Wali</span>
                                </button>

                                <form action="{{ route('admin.kelas.destroy', $k->id) }}" 
                                      method="POST" 
                                      onsubmit="return confirm('Yakin ingin menghapus rombel kelas {{ $k->nama_kelas }}?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-red-50 hover:bg-red-600 text-red-600 hover:text-white border border-red-200 hover:border-red-600 rounded-xl text-xs font-bold transition">
                                        <i class="fa-solid fa-trash-can text-[11px]"></i>
                                        <span>Hapus</span>
                                    </button>
                                </form>
                            </div>
                        </div>

                        {{-- Current Wali Kelas Badge --}}
                        <div class="pt-3 border-t border-slate-200/60 flex items-center justify-between text-xs">
                            <div class="flex items-center gap-2">
                                <span class="text-slate-500 font-semibold">Wali Kelas:</span>
                                @if($k->waliKelas)
                                    <span class="nama-wali-text inline-flex items-center gap-1.5 px-2.5 py-1 bg-green-100 text-green-900 font-bold rounded-lg text-xs">
                                        <i class="fa-solid fa-circle-check text-green-600 text-[10px]"></i>
                                        <span>{{ $k->waliKelas->name }}</span>
                                    </span>
                                @else
                                    <span class="nama-wali-text inline-flex items-center gap-1.5 px-2.5 py-1 bg-amber-100 text-amber-900 font-bold rounded-lg text-xs">
                                        <i class="fa-solid fa-triangle-exclamation text-amber-600 text-[10px]"></i>
                                        <span>Belum Ditentukan</span>
                                    </span>
                                @endif
                            </div>
                        </div>

                        {{-- Collapsible Quick Edit Form for this Class --}}
                        <div id="editKelasForm-{{ $k->id }}" class="hidden pt-4 border-t border-slate-200 space-y-3 bg-white p-4 rounded-2xl border border-slate-200">
                            <h5 class="text-xs font-black text-slate-800 uppercase tracking-wider">
                                Edit Rombel: {{ $k->nama_kelas }}
                            </h5>
                            <form action="{{ route('admin.kelas.update', $k->id) }}" method="POST" class="space-y-3">
                                @csrf
                                @method('PUT')

                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                    <div>
                                        <label class="block text-[11px] font-bold text-slate-700 mb-1">Nama Rombel Kelas</label>
                                        <input type="text" 
                                               name="nama_kelas" 
                                               value="{{ $k->nama_kelas }}" 
                                               class="w-full px-3 py-2 text-xs rounded-xl border border-slate-200 focus:border-green-600 outline-none font-semibold" 
                                               required>
                                    </div>

                                    <div>
                                        <label class="block text-[11px] font-bold text-slate-700 mb-1">Penugasan Wali Kelas</label>
                                        <select name="wali_kelas_id" class="w-full px-3 py-2 text-xs rounded-xl border border-slate-200 focus:border-green-600 outline-none font-medium">
                                            <option value="">-- Tanpa Wali Kelas (Kosongkan) --</option>
                                            @foreach($gurus as $guru)
                                                @php
                                                    $isCurrentWali = ($k->wali_kelas_id == $guru->id);
                                                    $assignedToOther = \App\Models\Kelas::where('wali_kelas_id', $guru->id)->where('id', '!=', $k->id)->first();
                                                @endphp
                                                <option value="{{ $guru->id }}" {{ $isCurrentWali ? 'selected' : '' }}>
                                                    {{ $guru->name }} {{ $isCurrentWali ? '(Wali Saat Ini)' : ($assignedToOther ? "(Saat ini di {$assignedToOther->nama_kelas})" : '') }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="flex justify-end gap-2 pt-1">
                                    <button type="button" 
                                            onclick="toggleEditKelasModal({{ $k->id }})" 
                                            class="px-3 py-1.5 bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold rounded-lg text-xs transition">
                                        Batal
                                    </button>
                                    <button type="submit" 
                                            class="px-4 py-1.5 bg-green-600 hover:bg-green-700 text-white font-bold rounded-lg text-xs transition flex items-center gap-1.5">
                                        <i class="fa-solid fa-floppy-disk text-[10px]"></i>
                                        <span>Simpan Perubahan</span>
                                    </button>
                                </div>
                            </form>
                        </div>

                    </div>
                    @empty
                    <div class="text-center py-10 text-slate-400 font-semibold">
                        <i class="fa-solid fa-school text-4xl mb-2 block"></i>
                        Belum ada rombel kelas yang dibuat.
                    </div>
                    @endforelse
                </div>

            </div>

        </div>

    </div>

</div>

{{-- ================= MODAL POP-UP PICKER: CARI & PILIH WALI GURU ================= --}}
<div id="modalPickerWali" class="fixed inset-0 bg-slate-900/60 backdrop-blur-xs z-60 hidden flex items-center justify-center p-4">
    <div class="bg-white w-full max-w-lg rounded-3xl p-6 sm:p-7 space-y-5 shadow-2xl border border-slate-100 transform transition-all max-h-[90vh] flex flex-col">
        
        {{-- Header --}}
        <div class="flex items-center justify-between pb-3 border-b border-slate-100 shrink-0">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-2xl bg-blue-100 text-blue-700 flex items-center justify-center font-black">
                    <i class="fa-solid fa-chalkboard-user text-base"></i>
                </div>
                <div>
                    <h3 class="text-base font-black text-slate-900">Pilih Dewan Guru (Wali Kelas)</h3>
                    <p class="text-[11px] text-slate-500">Tugaskan ustadzah sebagai wali rombel kelas ini</p>
                </div>
            </div>
            <button type="button" onclick="closePickerWaliModal()" class="text-slate-400 hover:text-slate-600 p-2">
                <i class="fa-solid fa-xmark text-lg"></i>
            </button>
        </div>

        {{-- Live Search Input --}}
        <div class="relative shrink-0">
            <i class="fa-solid fa-magnifying-glass absolute left-3.5 top-3 text-slate-400 text-xs"></i>
            <input type="text" 
                   id="searchModalPickerWali"
                   onkeyup="filterModalWaliCards()"
                   placeholder="Ketik untuk mencari nama ustadzah / guru..." 
                   class="w-full pl-9 pr-4 py-2.5 text-xs sm:text-sm rounded-2xl bg-slate-50 border border-slate-200 focus:border-green-600 focus:bg-white focus:ring-2 focus:ring-green-100 outline-none">
        </div>

        {{-- Scrollable List of Teachers --}}
        <div id="containerModalWaliList" class="overflow-y-auto space-y-2.5 pr-1 flex-1">
            
            {{-- Option: Belum Ditentukan --}}
            <div onclick="selectWaliFromModal('', 'Belum Ditentukan', 'Kosongkan / Belum ada wali', false)"
                 class="card-modal-wali p-4 rounded-2xl border border-slate-200 hover:border-green-500 bg-slate-50/70 hover:bg-green-50/50 cursor-pointer flex items-center justify-between transition group">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-slate-200 text-slate-600 group-hover:bg-slate-300 flex items-center justify-center text-sm font-bold shrink-0 transition">
                        <i class="fa-solid fa-user-xmark"></i>
                    </div>
                    <div>
                        <h4 class="font-black text-slate-900 text-xs sm:text-sm">Belum Ditentukan (Tanpa Wali)</h4>
                        <p class="text-[11px] text-slate-500 mt-0.5">Biarkan rombel ini tanpa wali kelas saat ini</p>
                    </div>
                </div>
                <span class="px-3 py-1 bg-white text-slate-600 group-hover:bg-green-600 group-hover:text-white border border-slate-200 group-hover:border-green-600 rounded-xl text-xs font-bold transition shadow-2xs">
                    Pilih
                </span>
            </div>

            {{-- Teachers List --}}
            @foreach($gurus as $guru)
            @php
                $assignedClass = \App\Models\Kelas::where('wali_kelas_id', $guru->id)->first();
            @endphp
            <div onclick="selectWaliFromModal('{{ $guru->id }}', '{{ addslashes($guru->name) }}', '{{ $assignedClass ? 'Saat ini di ' . addslashes($assignedClass->nama_kelas) : 'Guru Mapel (Tersedia)' }}', true)"
                 class="card-modal-wali p-4 rounded-2xl border border-slate-200 hover:border-green-500 bg-white hover:bg-green-50/40 cursor-pointer flex items-center justify-between transition group shadow-2xs">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-blue-600 to-cyan-500 text-white font-bold flex items-center justify-center text-sm shadow-xs shrink-0">
                        {{ strtoupper(substr($guru->name, 0, 1)) }}
                    </div>
                    <div>
                        <h4 class="font-black text-slate-900 text-xs sm:text-sm guru-title">{{ $guru->name }}</h4>
                        <div class="flex items-center gap-2 mt-1">
                            <span class="text-[10px] text-slate-400 font-medium">
                                {{ $guru->email }}
                            </span>
                            @if($assignedClass)
                                <span class="text-[10px] font-bold text-amber-800 bg-amber-100 px-2 py-0.5 rounded-md">
                                    <i class="fa-solid fa-school mr-1"></i>Di {{ $assignedClass->nama_kelas }}
                                </span>
                            @else
                                <span class="text-[10px] font-bold text-emerald-800 bg-emerald-100 px-2 py-0.5 rounded-md">
                                    <i class="fa-solid fa-circle-check mr-1"></i>Tersedia
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
                <span class="px-3 py-1 bg-slate-50 text-slate-700 group-hover:bg-green-600 group-hover:text-white border border-slate-200 group-hover:border-green-600 rounded-xl text-xs font-bold transition shadow-2xs">
                    Pilih
                </span>
            </div>
            @endforeach

        </div>

        {{-- Footer --}}
        <div class="pt-3 border-t border-slate-100 flex justify-end shrink-0">
            <button type="button" onclick="closePickerWaliModal()" class="px-4 py-2 bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold rounded-xl text-xs transition">
                Tutup
            </button>
        </div>

    </div>
</div>

<script>
/* ================= MODAL PICKER LOGIC FOR WALI ================= */
function openPickerWaliModal() {
    const modal = document.getElementById('modalPickerWali');
    modal.classList.remove('hidden');
    
    // Reset search
    const searchInput = document.getElementById('searchModalPickerWali');
    searchInput.value = '';
    filterModalWaliCards();
    setTimeout(() => searchInput.focus(), 50);
}

function closePickerWaliModal() {
    document.getElementById('modalPickerWali').classList.add('hidden');
}

function filterModalWaliCards() {
    const input = document.getElementById('searchModalPickerWali');
    const filter = input.value.toLowerCase();
    const container = document.getElementById('containerModalWaliList');
    const cards = container.getElementsByClassName('card-modal-wali');

    for (let i = 0; i < cards.length; i++) {
        const text = cards[i].textContent || cards[i].innerText;
        if (text.toLowerCase().indexOf(filter) > -1) {
            cards[i].style.display = "";
        } else {
            cards[i].style.display = "none";
        }
    }
}

function selectWaliFromModal(id, label, sublabel, hasTeacher) {
    document.getElementById('tambahWaliKelasId').value = id;
    document.getElementById('labelTambahWali').innerText = label;
    document.getElementById('sublabelTambahWali').innerText = sublabel || 'Kosongkan / Belum ada wali';
    
    const iconBox = document.getElementById('iconTambahWali');
    if (hasTeacher && id) {
        iconBox.className = 'w-8 h-8 rounded-xl bg-blue-100 text-blue-700 flex items-center justify-center text-xs shrink-0 font-bold';
        iconBox.innerHTML = '<i class="fa-solid fa-chalkboard-user"></i>';
    } else {
        iconBox.className = 'w-8 h-8 rounded-xl bg-slate-200 text-slate-600 flex items-center justify-center text-xs shrink-0';
        iconBox.innerHTML = '<i class="fa-solid fa-user-slash"></i>';
    }
    
    closePickerWaliModal();
}

function toggleEditKelasModal(id) {
    const form = document.getElementById(`editKelasForm-${id}`);
    if (form) {
        form.classList.toggle('hidden');
    }
}

function filterKelasCards() {
    const input = document.getElementById("searchKelasTable");
    const filter = input.value.toLowerCase();
    const container = document.getElementById("containerListKelas");
    const cards = container.getElementsByClassName("card-kelas-item");

    for (let i = 0; i < cards.length; i++) {
        const text = cards[i].textContent || cards[i].innerText;
        if (text.toLowerCase().indexOf(filter) > -1) {
            cards[i].style.display = "";
        } else {
            cards[i].style.display = "none";
        }
    }
}
</script>

@endsection
