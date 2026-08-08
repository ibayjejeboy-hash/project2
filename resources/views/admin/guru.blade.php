@extends('layouts.admin')

@section('title', 'Data Guru & Pendidik - RA Al Musyaffallah')
@section('page_title', 'Data Guru (Ustadzah)')

@section('content')

<div class="space-y-8">

    {{-- Page Header --}}
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl sm:text-3xl font-black text-slate-900 tracking-tight">
                Data Guru & Tenaga Pendidik
            </h1>
            <p class="text-xs sm:text-sm text-slate-500 font-medium mt-1">
                Kelola akun dewan guru (ustadzah) dan penetapan tugas wali rombongan belajar.
            </p>
        </div>
        <div class="flex items-center gap-2">
            <a href="{{ route('admin.kelas') }}" 
               class="inline-flex items-center gap-2 px-4 py-2 bg-emerald-50 hover:bg-emerald-100 text-emerald-800 border border-emerald-200 font-bold rounded-xl text-xs transition">
                <i class="fa-solid fa-school"></i>
                <span>Kelola Rombel Kelas</span>
            </a>
            <span class="px-3.5 py-2 bg-blue-100 text-blue-800 font-black rounded-xl text-xs">
                Total Guru: {{ count($gurus) }} Orang
            </span>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
        
        {{-- ================= FORM TAMBAH GURU (Left 4 Cols) ================= --}}
        <div class="lg:col-span-4 bg-white p-6 sm:p-7 rounded-3xl border border-slate-100 shadow-sm space-y-6 sticky top-24">
            <div class="flex items-center gap-3 pb-4 border-b border-slate-100">
                <div class="w-10 h-10 rounded-2xl bg-blue-100 text-blue-700 flex items-center justify-center font-black">
                    <i class="fa-solid fa-user-plus text-base"></i>
                </div>
                <div>
                    <h2 class="text-base font-black text-slate-900">Tambah Guru Baru</h2>
                    <p class="text-[11px] text-slate-500">Buat akun untuk dewan guru / ustadzah</p>
                </div>
            </div>

            <form method="POST" action="{{ route('admin.guru.store') }}" class="space-y-4">
                @csrf

                <div>
                    <label class="block text-xs font-extrabold text-slate-700 uppercase tracking-wider mb-1.5">
                        Nama Lengkap Guru <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                            <i class="fa-solid fa-user text-xs"></i>
                        </div>
                        <input type="text" 
                               name="name" 
                               value="{{ old('name') }}"
                               placeholder="Contoh: Ustadzah Fatimah, S.Pd.I"
                               class="w-full pl-9 pr-3.5 py-2.5 rounded-xl border border-slate-200 focus:border-green-600 focus:ring-2 focus:ring-green-100 outline-none text-xs sm:text-sm text-slate-800 font-semibold"
                               required>
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-extrabold text-slate-700 uppercase tracking-wider mb-1.5">
                        Alamat Email Akun <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                            <i class="fa-solid fa-envelope text-xs"></i>
                        </div>
                        <input type="email" 
                               name="email" 
                               value="{{ old('email') }}"
                               placeholder="guru@almusyafallahi.id"
                               class="w-full pl-9 pr-3.5 py-2.5 rounded-xl border border-slate-200 focus:border-green-600 focus:ring-2 focus:ring-green-100 outline-none text-xs sm:text-sm text-slate-800"
                               required>
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-extrabold text-slate-700 uppercase tracking-wider mb-1.5">
                        Kata Sandi Login <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                            <i class="fa-solid fa-lock text-xs"></i>
                        </div>
                        <input type="password" 
                               name="password" 
                               placeholder="Minimal 6 karakter"
                               class="w-full pl-9 pr-3.5 py-2.5 rounded-xl border border-slate-200 focus:border-green-600 focus:ring-2 focus:ring-green-100 outline-none text-xs sm:text-sm text-slate-800"
                               required>
                    </div>
                </div>

                {{-- MODAL TRIGGER: TUGASKAN WALI KELAS --}}
                <div class="space-y-1.5">
                    <label class="block text-xs font-extrabold text-slate-700 uppercase tracking-wider">
                        Tugaskan Wali Kelas
                    </label>
                    
                    {{-- Hidden Form Input --}}
                    <input type="hidden" name="kelas_id" id="tambahGuruKelasId" value="">

                    {{-- Trigger Card --}}
                    <div onclick="openPickerRombelModal('tambah')" 
                         class="group p-3 bg-slate-50 hover:bg-green-50/50 border border-slate-200 hover:border-green-400 rounded-2xl flex items-center justify-between cursor-pointer transition shadow-2xs">
                        <div class="flex items-center gap-2.5 overflow-hidden">
                            <div id="iconTambahKelas" class="w-8 h-8 rounded-xl bg-slate-200 text-slate-600 group-hover:bg-green-100 group-hover:text-green-700 flex items-center justify-center text-xs shrink-0 transition">
                                <i class="fa-solid fa-user-slash"></i>
                            </div>
                            <div class="truncate">
                                <span id="labelTambahKelas" class="block font-bold text-xs text-slate-800 truncate">
                                    Tanpa Wali Kelas
                                </span>
                                <span id="sublabelTambahKelas" class="block text-[10px] text-slate-400 truncate">
                                    Guru pengajar mapel reguler
                                </span>
                            </div>
                        </div>
                        <span class="inline-flex items-center gap-1 px-2.5 py-1 bg-white group-hover:bg-green-600 text-slate-600 group-hover:text-white border border-slate-200 group-hover:border-green-600 rounded-xl text-[11px] font-bold transition shrink-0 ml-2 shadow-2xs">
                            <i class="fa-solid fa-magnifying-glass text-[9px]"></i>
                            <span>Pilih</span>
                        </span>
                    </div>
                </div>

                <button type="submit" 
                        class="w-full inline-flex items-center justify-center gap-2 bg-gradient-to-r from-green-600 to-emerald-700 hover:from-green-700 hover:to-emerald-800 text-white font-black py-3 px-4 rounded-xl shadow-md transition duration-200 text-xs sm:text-sm uppercase tracking-wide mt-2">
                    <i class="fa-solid fa-user-plus"></i>
                    <span>Simpan Guru Baru</span>
                </button>
            </form>
        </div>

        {{-- ================= DAFTAR GURU TABLE (Right 8 Cols) ================= --}}
        <div class="lg:col-span-8 bg-white p-6 sm:p-7 rounded-3xl border border-slate-100 shadow-sm space-y-5">
            
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                <div>
                    <h3 class="text-base font-black text-slate-900">Daftar Dewan Guru & Wali Kelas</h3>
                    <p class="text-xs text-slate-500">Total guru terdaftar: <span class="font-bold text-slate-800">{{ count($gurus) }} Orang</span></p>
                </div>

                {{-- Live Search Filter --}}
                <div class="relative">
                    <i class="fa-solid fa-magnifying-glass absolute left-3 top-2.5 text-slate-400 text-xs"></i>
                    <input type="text" 
                           id="searchGuruTable" 
                           onkeyup="filterGuruTable()" 
                           placeholder="Cari guru / rombel..." 
                           class="pl-8 pr-3.5 py-2 text-xs rounded-xl border border-slate-200 focus:border-green-600 outline-none w-52">
                </div>
            </div>

            <div class="overflow-x-auto">
                <table id="guruTable" class="w-full text-left text-xs">
                    <thead>
                        <tr class="bg-slate-50 text-slate-500 font-extrabold uppercase tracking-wider border-y border-slate-100">
                            <th class="py-3.5 px-4 rounded-l-xl text-center w-12">No</th>
                            <th class="py-3.5 px-4">Nama & Email</th>
                            <th class="py-3.5 px-4">Penugasan Wali Kelas</th>
                            <th class="py-3.5 px-4 text-center rounded-r-xl w-32">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 font-medium text-slate-700">
                        @forelse($gurus as $i => $g)
                        @php
                            $waliKelas = \App\Models\Kelas::where('wali_kelas_id', $g->id)->first();
                        @endphp
                        <tr class="hover:bg-slate-50/80 transition">
                            <td class="py-3.5 px-4 text-center text-slate-400 font-bold">
                                {{ $i + 1 }}
                            </td>
                            <td class="py-3.5 px-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-9 h-9 rounded-xl bg-gradient-to-tr from-blue-600 to-cyan-500 text-white font-bold flex items-center justify-center text-xs shadow-sm">
                                        {{ strtoupper(substr($g->name, 0, 1)) }}
                                    </div>
                                    <div>
                                        <span class="block font-bold text-slate-900 text-xs sm:text-sm">{{ $g->name }}</span>
                                        <span class="block text-[11px] text-slate-400">{{ $g->email }}</span>
                                    </div>
                                </div>
                            </td>
                            <td class="py-3.5 px-4">
                                @if($waliKelas)
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 bg-green-50 text-green-800 border border-green-200 rounded-lg font-bold text-[11px]">
                                        <i class="fa-solid fa-chalkboard text-green-600"></i>
                                        <span>{{ $waliKelas->nama_kelas }}</span>
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1 px-2 py-0.5 bg-slate-100 text-slate-500 rounded-md text-[11px] font-medium">
                                        Guru Mapel (Bukan Wali)
                                    </span>
                                @endif
                            </td>
                            <td class="py-3.5 px-4 text-center">
                                <div class="flex items-center justify-center gap-1.5">
                                    
                                    {{-- Tombol Edit Modal Toggle --}}
                                    <button type="button" 
                                            onclick="openEditGuruModal({{ $g->id }}, '{{ addslashes($g->name) }}', '{{ addslashes($g->email) }}', '{{ $waliKelas->id ?? '' }}', '{{ addslashes($waliKelas->nama_kelas ?? '') }}')"
                                            title="Edit Data & Wali Kelas"
                                            class="w-7 h-7 rounded-lg bg-blue-50 hover:bg-blue-600 text-blue-600 hover:text-white border border-blue-200 hover:border-blue-600 flex items-center justify-center text-xs transition">
                                        <i class="fa-solid fa-pen-to-square text-[10px]"></i>
                                    </button>

                                    {{-- Tombol Hapus --}}
                                    <form action="{{ route('admin.guru.destroy', $g->id) }}" 
                                          method="POST" 
                                          onsubmit="return confirm('Yakin ingin menghapus guru {{ $g->name }}?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                title="Hapus Guru"
                                                class="w-7 h-7 rounded-lg bg-red-50 hover:bg-red-600 text-red-600 hover:text-white border border-red-200 hover:border-red-600 flex items-center justify-center text-xs transition">
                                            <i class="fa-solid fa-trash-can text-[10px]"></i>
                                        </button>
                                    </form>

                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="py-8 text-center text-slate-400 font-semibold">
                                <i class="fa-solid fa-user-xmark text-2xl mb-1 block"></i>
                                Belum ada data guru.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>

</div>

{{-- ================= MODAL EDIT GURU ================= --}}
<div id="modalEditGuru" class="fixed inset-0 bg-slate-900/60 backdrop-blur-xs z-50 hidden flex items-center justify-center p-4">
    <div class="bg-white w-full max-w-lg rounded-3xl p-6 sm:p-7 space-y-6 shadow-2xl border border-slate-100 transform transition-all">
        
        <div class="flex items-center justify-between pb-3 border-b border-slate-100">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-2xl bg-blue-100 text-blue-700 flex items-center justify-center font-black">
                    <i class="fa-solid fa-user-pen text-base"></i>
                </div>
                <div>
                    <h3 class="text-base font-black text-slate-900">Edit Data & Penugasan Guru</h3>
                    <p class="text-[11px] text-slate-500">Perbarui profil atau penugasan wali kelas</p>
                </div>
            </div>
            <button type="button" onclick="closeEditGuruModal()" class="text-slate-400 hover:text-slate-600 p-2">
                <i class="fa-solid fa-xmark text-lg"></i>
            </button>
        </div>

        <form id="formEditGuru" method="POST" action="" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-xs font-extrabold text-slate-700 uppercase tracking-wider mb-1">Nama Guru</label>
                <input type="text" id="editGuruName" name="name" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 focus:border-green-600 outline-none text-xs sm:text-sm font-semibold" required>
            </div>

            <div>
                <label class="block text-xs font-extrabold text-slate-700 uppercase tracking-wider mb-1">Email Login</label>
                <input type="email" id="editGuruEmail" name="email" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 focus:border-green-600 outline-none text-xs sm:text-sm" required>
            </div>

            <div>
                <label class="block text-xs font-extrabold text-slate-700 uppercase tracking-wider mb-1">Password Baru (Opsional)</label>
                <input type="password" name="password" placeholder="Kosongkan jika tidak ingin ganti password" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 focus:border-green-600 outline-none text-xs sm:text-sm">
            </div>

            {{-- MODAL TRIGGER: EDIT WALI KELAS --}}
            <div class="space-y-1.5">
                <label class="block text-xs font-extrabold text-slate-700 uppercase tracking-wider">Penugasan Wali Kelas</label>
                
                {{-- Hidden Input for Edit --}}
                <input type="hidden" name="kelas_id" id="editGuruKelasId" value="">

                <div onclick="openPickerRombelModal('edit')" 
                     class="group p-3 bg-slate-50 hover:bg-green-50/50 border border-slate-200 hover:border-green-400 rounded-2xl flex items-center justify-between cursor-pointer transition shadow-2xs">
                    <div class="flex items-center gap-2.5 overflow-hidden">
                        <div id="iconEditKelas" class="w-8 h-8 rounded-xl bg-slate-200 text-slate-600 group-hover:bg-green-100 group-hover:text-green-700 flex items-center justify-center text-xs shrink-0 transition">
                            <i class="fa-solid fa-user-slash"></i>
                        </div>
                        <div class="truncate">
                            <span id="labelEditKelas" class="block font-bold text-xs text-slate-800 truncate">
                                Tanpa Wali Kelas
                            </span>
                            <span id="sublabelEditKelas" class="block text-[10px] text-slate-400 truncate">
                                Guru pengajar mapel reguler
                            </span>
                        </div>
                    </div>
                    <span class="inline-flex items-center gap-1 px-2.5 py-1 bg-white group-hover:bg-green-600 text-slate-600 group-hover:text-white border border-slate-200 group-hover:border-green-600 rounded-xl text-[11px] font-bold transition shrink-0 ml-2 shadow-2xs">
                        <i class="fa-solid fa-arrows-rotate text-[9px]"></i>
                        <span>Ganti</span>
                    </span>
                </div>
            </div>

            <div class="pt-3 flex justify-end gap-2 border-t border-slate-100">
                <button type="button" onclick="closeEditGuruModal()" class="px-4 py-2 bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold rounded-xl text-xs sm:text-sm transition">
                    Batal
                </button>
                <button type="submit" class="px-5 py-2 bg-gradient-to-r from-green-600 to-emerald-700 hover:from-green-700 hover:to-emerald-800 text-white font-black rounded-xl text-xs sm:text-sm shadow-md transition">
                    Simpan Perubahan
                </button>
            </div>
        </form>

    </div>
</div>

{{-- ================= MODAL POP-UP PICKER: CARI & PILIH ROMBEL KELAS ================= --}}
<div id="modalPickerRombel" class="fixed inset-0 bg-slate-900/60 backdrop-blur-xs z-60 hidden flex items-center justify-center p-4">
    <div class="bg-white w-full max-w-lg rounded-3xl p-6 sm:p-7 space-y-5 shadow-2xl border border-slate-100 transform transition-all max-h-[90vh] flex flex-col">
        
        {{-- Header --}}
        <div class="flex items-center justify-between pb-3 border-b border-slate-100 shrink-0">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-2xl bg-green-100 text-green-700 flex items-center justify-center font-black">
                    <i class="fa-solid fa-school text-base"></i>
                </div>
                <div>
                    <h3 class="text-base font-black text-slate-900">Pilih Rombongan Belajar</h3>
                    <p class="text-[11px] text-slate-500">Tugaskan ustadzah ini sebagai wali di rombel kelas</p>
                </div>
            </div>
            <button type="button" onclick="closePickerRombelModal()" class="text-slate-400 hover:text-slate-600 p-2">
                <i class="fa-solid fa-xmark text-lg"></i>
            </button>
        </div>

        {{-- Live Search Input --}}
        <div class="relative shrink-0">
            <i class="fa-solid fa-magnifying-glass absolute left-3.5 top-3 text-slate-400 text-xs"></i>
            <input type="text" 
                   id="searchModalPickerRombel"
                   onkeyup="filterModalRombelCards()"
                   placeholder="Ketik untuk mencari rombel kelas..." 
                   class="w-full pl-9 pr-4 py-2.5 text-xs sm:text-sm rounded-2xl bg-slate-50 border border-slate-200 focus:border-green-600 focus:bg-white focus:ring-2 focus:ring-green-100 outline-none">
        </div>

        {{-- Scrollable List of Class Options --}}
        <div id="containerModalRombelList" class="overflow-y-auto space-y-2.5 pr-1 flex-1">
            
            {{-- Default Option: Tanpa Wali Kelas --}}
            <div onclick="selectRombelFromModal('', 'Tanpa Wali Kelas', 'Guru pengajar mapel reguler', false)"
                 class="card-modal-rombel p-4 rounded-2xl border border-slate-200 hover:border-green-500 bg-slate-50/70 hover:bg-green-50/50 cursor-pointer flex items-center justify-between transition group">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-slate-200 text-slate-600 group-hover:bg-slate-300 flex items-center justify-center text-sm font-bold shrink-0 transition">
                        <i class="fa-solid fa-user-xmark"></i>
                    </div>
                    <div>
                        <h4 class="font-black text-slate-900 text-xs sm:text-sm">Tanpa Wali Kelas (Guru Mapel)</h4>
                        <p class="text-[11px] text-slate-500 mt-0.5">Pengajar mata pelajaran reguler / umum / tahfidz</p>
                    </div>
                </div>
                <span class="px-3 py-1 bg-white text-slate-600 group-hover:bg-green-600 group-hover:text-white border border-slate-200 group-hover:border-green-600 rounded-xl text-xs font-bold transition shadow-2xs">
                    Pilih
                </span>
            </div>

            {{-- Class Cards --}}
            @foreach($kelas as $k)
            <div onclick="selectRombelFromModal('{{ $k->id }}', '{{ addslashes($k->nama_kelas) }}', '{{ $k->waliKelas ? 'Wali Saat Ini: ' . addslashes($k->waliKelas->name) : 'Belum ada wali (Tersedia)' }}', true)"
                 class="card-modal-rombel p-4 rounded-2xl border border-slate-200 hover:border-green-500 bg-white hover:bg-green-50/40 cursor-pointer flex items-center justify-between transition group shadow-2xs">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-green-100 text-green-700 group-hover:bg-green-600 group-hover:text-white flex items-center justify-center text-sm font-bold shrink-0 transition shadow-xs">
                        <i class="fa-solid fa-chalkboard"></i>
                    </div>
                    <div>
                        <h4 class="font-black text-slate-900 text-xs sm:text-sm rombel-title">{{ $k->nama_kelas }}</h4>
                        <div class="flex items-center gap-2 mt-1">
                            <span class="text-[10px] font-bold text-slate-500 bg-slate-100 px-2 py-0.5 rounded-md">
                                <i class="fa-solid fa-user-graduate text-green-600 mr-1"></i>{{ $k->siswa_count }} Siswa
                            </span>
                            @if($k->waliKelas)
                                <span class="text-[10px] font-bold text-amber-800 bg-amber-100 px-2 py-0.5 rounded-md">
                                    <i class="fa-solid fa-user-tie mr-1"></i>Wali: {{ $k->waliKelas->name }}
                                </span>
                            @else
                                <span class="text-[10px] font-bold text-emerald-800 bg-emerald-100 px-2 py-0.5 rounded-md">
                                    <i class="fa-solid fa-circle-check mr-1"></i>Tersedia (Belum ada wali)
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
            <button type="button" onclick="closePickerRombelModal()" class="px-4 py-2 bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold rounded-xl text-xs transition">
                Tutup
            </button>
        </div>

    </div>
</div>

<script>
/* ================= GLOBAL CONTEXT FOR ROMBEL MODAL PICKER ================= */
let activePickerContext = 'tambah'; // 'tambah' or 'edit'

function openPickerRombelModal(context) {
    activePickerContext = context;
    const modal = document.getElementById('modalPickerRombel');
    modal.classList.remove('hidden');
    
    // Reset search
    const searchInput = document.getElementById('searchModalPickerRombel');
    searchInput.value = '';
    filterModalRombelCards();
    setTimeout(() => searchInput.focus(), 50);
}

function closePickerRombelModal() {
    document.getElementById('modalPickerRombel').classList.add('hidden');
}

function filterModalRombelCards() {
    const input = document.getElementById('searchModalPickerRombel');
    const filter = input.value.toLowerCase();
    const container = document.getElementById('containerModalRombelList');
    const cards = container.getElementsByClassName('card-modal-rombel');

    for (let i = 0; i < cards.length; i++) {
        const text = cards[i].textContent || cards[i].innerText;
        if (text.toLowerCase().indexOf(filter) > -1) {
            cards[i].style.display = "";
        } else {
            cards[i].style.display = "none";
        }
    }
}

function selectRombelFromModal(id, label, sublabel, hasClass) {
    if (activePickerContext === 'tambah') {
        document.getElementById('tambahGuruKelasId').value = id;
        document.getElementById('labelTambahKelas').innerText = label;
        document.getElementById('sublabelTambahKelas').innerText = sublabel;
        
        const iconBox = document.getElementById('iconTambahKelas');
        if (hasClass && id) {
            iconBox.className = 'w-8 h-8 rounded-xl bg-green-100 text-green-700 flex items-center justify-center text-xs shrink-0 font-bold';
            iconBox.innerHTML = '<i class="fa-solid fa-chalkboard"></i>';
        } else {
            iconBox.className = 'w-8 h-8 rounded-xl bg-slate-200 text-slate-600 flex items-center justify-center text-xs shrink-0';
            iconBox.innerHTML = '<i class="fa-solid fa-user-slash"></i>';
        }
    } else if (activePickerContext === 'edit') {
        document.getElementById('editGuruKelasId').value = id;
        document.getElementById('labelEditKelas').innerText = label;
        document.getElementById('sublabelEditKelas').innerText = sublabel || 'Guru pengajar mapel reguler';
        
        const iconBox = document.getElementById('iconEditKelas');
        if (hasClass && id) {
            iconBox.className = 'w-8 h-8 rounded-xl bg-green-100 text-green-700 flex items-center justify-center text-xs shrink-0 font-bold';
            iconBox.innerHTML = '<i class="fa-solid fa-chalkboard"></i>';
        } else {
            iconBox.className = 'w-8 h-8 rounded-xl bg-slate-200 text-slate-600 flex items-center justify-center text-xs shrink-0';
            iconBox.innerHTML = '<i class="fa-solid fa-user-slash"></i>';
        }
    }

    closePickerRombelModal();
}

function openEditGuruModal(id, name, email, kelasId, kelasName) {
    const modal = document.getElementById('modalEditGuru');
    const form = document.getElementById('formEditGuru');
    const nameInput = document.getElementById('editGuruName');
    const emailInput = document.getElementById('editGuruEmail');

    form.action = `/admin/guru/${id}`;
    nameInput.value = name;
    emailInput.value = email;
    
    if (kelasId && kelasName) {
        document.getElementById('editGuruKelasId').value = kelasId;
        document.getElementById('labelEditKelas').innerText = kelasName;
        document.getElementById('sublabelEditKelas').innerText = 'Wali Kelas Terdaftar';
        
        const iconBox = document.getElementById('iconEditKelas');
        iconBox.className = 'w-8 h-8 rounded-xl bg-green-100 text-green-700 flex items-center justify-center text-xs shrink-0 font-bold';
        iconBox.innerHTML = '<i class="fa-solid fa-chalkboard"></i>';
    } else {
        document.getElementById('editGuruKelasId').value = '';
        document.getElementById('labelEditKelas').innerText = 'Tanpa Wali Kelas';
        document.getElementById('sublabelEditKelas').innerText = 'Guru pengajar mapel reguler';
        
        const iconBox = document.getElementById('iconEditKelas');
        iconBox.className = 'w-8 h-8 rounded-xl bg-slate-200 text-slate-600 flex items-center justify-center text-xs shrink-0';
        iconBox.innerHTML = '<i class="fa-solid fa-user-slash"></i>';
    }

    modal.classList.remove('hidden');
}

function closeEditGuruModal() {
    document.getElementById('modalEditGuru').classList.add('hidden');
}

function filterGuruTable() {
    const input = document.getElementById("searchGuruTable");
    const filter = input.value.toLowerCase();
    const table = document.getElementById("guruTable");
    const tr = table.getElementsByTagName("tr");

    for (let i = 1; i < tr.length; i++) {
        const tdText = tr[i].textContent || tr[i].innerText;
        if (tdText.toLowerCase().indexOf(filter) > -1) {
            tr[i].style.display = "";
        } else {
            tr[i].style.display = "none";
        }
    }
}
</script>

@endsection