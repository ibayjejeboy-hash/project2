@extends('layouts.admin')

@section('title', 'Manajemen Data Siswa - RA Al Musyaffallah')
@section('page_title', 'Data Siswa')

@section('content')

<div class="space-y-8">

    {{-- Page Header --}}
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl sm:text-3xl font-black text-slate-900 tracking-tight">
                Manajemen Data Siswa
            </h1>
            <p class="text-xs sm:text-sm text-slate-500 font-medium mt-1">
                Kelola data pokok peserta didik, penempatan rombel kelas, dan pembuatan akun e-rapor wali siswa.
            </p>
        </div>
        <div class="flex items-center gap-3">
            <button type="button" 
                    onclick="toggleFormTambahSiswa()" 
                    class="inline-flex items-center gap-2 bg-gradient-to-r from-green-600 to-emerald-700 hover:from-green-700 hover:to-emerald-800 text-white font-bold py-2.5 px-5 rounded-xl shadow-md transition duration-200 text-xs sm:text-sm">
                <i id="btnFormIcon" class="fa-solid fa-user-plus"></i>
                <span id="btnFormText">Tambah Siswa Baru</span>
            </button>
        </div>
    </div>

    {{-- ================= FORM TAMBAH SISWA (COLLAPSIBLE) ================= --}}
    <div id="formTambahSiswa" class="hidden bg-white p-6 sm:p-8 rounded-3xl border border-slate-100 shadow-sm space-y-8 transition-all duration-300">
        
        <div class="flex items-center justify-between pb-4 border-b border-slate-100">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-2xl bg-green-100 text-green-700 flex items-center justify-center font-black">
                    <i class="fa-solid fa-graduation-cap text-base"></i>
                </div>
                <div>
                    <h2 class="text-base font-black text-slate-900">Formulir Pendaftaran Siswa Baru</h2>
                    <p class="text-[11px] text-slate-500">Lengkapi data pokok peserta didik sesuai dokumen resmi (Akta & KK)</p>
                </div>
            </div>
            <button type="button" onclick="toggleFormTambahSiswa()" class="text-slate-400 hover:text-slate-600 p-2">
                <i class="fa-solid fa-xmark text-lg"></i>
            </button>
        </div>

        <form action="{{ route('admin.siswa.store') }}" 
              method="POST" 
              enctype="multipart/form-data" 
              class="space-y-8">
            @csrf

            {{-- 1. IDENTITAS SISWA --}}
            <div class="space-y-4">
                <div class="flex items-center gap-2 text-xs font-black text-green-800 uppercase tracking-wider bg-green-50 px-3 py-1.5 rounded-lg w-fit">
                    <i class="fa-solid fa-user"></i>
                    <span>1. Data Pokok Peserta Didik</span>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Nama Lengkap Anak <span class="text-red-500">*</span></label>
                        <input type="text" name="nama" value="{{ old('nama') }}" placeholder="Sesuai Akta Kelahiran" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 focus:border-green-600 outline-none text-xs sm:text-sm text-slate-800" required>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Nama Panggilan</label>
                        <input type="text" name="nama_panggilan" value="{{ old('nama_panggilan') }}" placeholder="Nama sapaan anak" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 focus:border-green-600 outline-none text-xs sm:text-sm text-slate-800">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">NISN / NIS</label>
                        <input type="text" name="nis" value="{{ old('nis') }}" placeholder="Nomor Induk Siswa" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 focus:border-green-600 outline-none text-xs sm:text-sm text-slate-800">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Rombongan Belajar (Kelas) <span class="text-red-500">*</span></label>
                        <select name="kelas_id" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 focus:border-green-600 outline-none text-xs sm:text-sm text-slate-800" required>
                            <option value="">-- Pilih Kelas --</option>
                            @foreach($kelas as $item)
                                <option value="{{ $item->id }}">{{ $item->nama_kelas }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Jenis Kelamin <span class="text-red-500">*</span></label>
                        <select name="jenis_kelamin" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 focus:border-green-600 outline-none text-xs sm:text-sm text-slate-800" required>
                            <option value="">-- Pilih --</option>
                            <option value="L">Laki-laki (L)</option>
                            <option value="P">Perempuan (P)</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Tempat Lahir</label>
                        <input type="text" name="tempat_lahir" value="{{ old('tempat_lahir') }}" placeholder="Kota kelahiran" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 focus:border-green-600 outline-none text-xs sm:text-sm text-slate-800">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Tanggal Lahir</label>
                        <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 focus:border-green-600 outline-none text-xs sm:text-sm text-slate-800">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Agama</label>
                        <select name="agama" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 focus:border-green-600 outline-none text-xs sm:text-sm text-slate-800">
                            <option value="Islam">Islam</option>
                            <option value="Kristen">Kristen</option>
                            <option value="Katolik">Katolik</option>
                            <option value="Hindu">Hindu</option>
                            <option value="Budha">Budha</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Anak Ke-</label>
                        <select name="anak_ke" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 focus:border-green-600 outline-none text-xs sm:text-sm text-slate-800">
                            <option value="1">1 (Pertama)</option>
                            <option value="2">2 (Kedua)</option>
                            <option value="3">3 (Ketiga)</option>
                            <option value="4">4 (Keempat)</option>
                            <option value="5">5 (Kelima atau lebih)</option>
                        </select>
                    </div>
                </div>
            </div>

            {{-- 2. DATA ORANG TUA / WALI --}}
            <div class="space-y-4">
                <div class="flex items-center gap-2 text-xs font-black text-blue-800 uppercase tracking-wider bg-blue-50 px-3 py-1.5 rounded-lg w-fit">
                    <i class="fa-solid fa-users"></i>
                    <span>2. Data Orang Tua / Wali</span>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Nama Ayah</label>
                        <input type="text" name="nama_ayah" value="{{ old('nama_ayah') }}" placeholder="Nama lengkap ayah" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 focus:border-green-600 outline-none text-xs sm:text-sm text-slate-800">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Nama Ibu</label>
                        <input type="text" name="nama_ibu" value="{{ old('nama_ibu') }}" placeholder="Nama lengkap ibu" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 focus:border-green-600 outline-none text-xs sm:text-sm text-slate-800">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">No. WhatsApp / HP</label>
                        <input type="text" name="no_hp" value="{{ old('no_hp') }}" placeholder="08xxxxxxxxxx" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 focus:border-green-600 outline-none text-xs sm:text-sm text-slate-800">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Email Orang Tua</label>
                        <input type="email" name="email" value="{{ old('email') }}" placeholder="ortu@email.com" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 focus:border-green-600 outline-none text-xs sm:text-sm text-slate-800">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Pekerjaan Ayah</label>
                        <input type="text" name="pekerjaan_ayah" value="{{ old('pekerjaan_ayah') }}" placeholder="Contoh: Wiraswasta / PNS" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 focus:border-green-600 outline-none text-xs sm:text-sm text-slate-800">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Pekerjaan Ibu</label>
                        <input type="text" name="pekerjaan_ibu" value="{{ old('pekerjaan_ibu') }}" placeholder="Contoh: Ibu Rumah Tangga / Guru" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 focus:border-green-600 outline-none text-xs sm:text-sm text-slate-800">
                    </div>
                </div>
            </div>

            {{-- 3. ALAMAT DOMISILI --}}
            <div class="space-y-4">
                <div class="flex items-center gap-2 text-xs font-black text-amber-800 uppercase tracking-wider bg-amber-50 px-3 py-1.5 rounded-lg w-fit">
                    <i class="fa-solid fa-location-dot"></i>
                    <span>3. Alamat Domisili Siswa</span>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Provinsi</label>
                        <select id="provinsi" name="provinsi" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 focus:border-green-600 outline-none text-xs sm:text-sm text-slate-800">
                            <option value="">Pilih Provinsi</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Kabupaten / Kota</label>
                        <select id="kota" name="kota" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 focus:border-green-600 outline-none text-xs sm:text-sm text-slate-800">
                            <option value="">Pilih Kabupaten</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Kecamatan</label>
                        <select id="kecamatan" name="kecamatan" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 focus:border-green-600 outline-none text-xs sm:text-sm text-slate-800">
                            <option value="">Pilih Kecamatan</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Kode Pos</label>
                        <input type="text" name="kode_pos" placeholder="Kode Pos" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 focus:border-green-600 outline-none text-xs sm:text-sm text-slate-800">
                    </div>

                    <div class="md:col-span-4">
                        <label class="block text-xs font-bold text-slate-700 mb-1">Alamat Lengkap (Jalan, RT/RW, Dusun)</label>
                        <textarea name="alamat" rows="2" placeholder="Nama Jalan / Blok / RT / RW / Dusun" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 focus:border-green-600 outline-none text-xs sm:text-sm text-slate-800"></textarea>
                    </div>
                </div>
            </div>

            {{-- 4. ADM & FOTO --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 pt-2">
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">Tanggal Diterima Masuk</label>
                    <input type="date" name="tanggal_diterima" value="{{ date('Y-m-d') }}" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 focus:border-green-600 outline-none text-xs sm:text-sm text-slate-800">
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">Pas Foto Siswa (3x4)</label>
                    <input type="file" name="foto" accept="image/*" class="w-full text-xs text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-green-100 file:text-green-800 border border-slate-200 rounded-xl p-1">
                </div>
            </div>

            <div class="pt-4 flex justify-end gap-3 border-t border-slate-100">
                <button type="button" onclick="toggleFormTambahSiswa()" class="px-5 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold rounded-xl text-xs sm:text-sm transition">
                    Batal
                </button>
                <button type="submit" class="inline-flex items-center gap-2 bg-gradient-to-r from-green-600 to-emerald-700 hover:from-green-700 hover:to-emerald-800 text-white font-black px-6 py-2.5 rounded-xl shadow-md text-xs sm:text-sm uppercase tracking-wide transition">
                    <i class="fa-solid fa-floppy-disk"></i>
                    <span>Simpan Data Siswa</span>
                </button>
            </div>

        </form>

    </div>


    {{-- ================= TABEL DATA SISWA ================= --}}
    <div class="bg-white p-6 sm:p-7 rounded-3xl border border-slate-100 shadow-sm space-y-5">
        
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <h3 class="text-base font-black text-slate-900">Daftar Seluruh Peserta Didik</h3>
                <p class="text-xs text-slate-500">Total data tercatat: <span class="font-bold text-slate-800">{{ count($siswas) }} Siswa</span></p>
            </div>

            {{-- Instant Search Filter --}}
            <div class="flex items-center gap-2">
                <div class="relative">
                    <i class="fa-solid fa-magnifying-glass absolute left-3 top-2.5 text-slate-400 text-xs"></i>
                    <input type="text" 
                           id="searchSiswa" 
                           onkeyup="filterSiswaTable()" 
                           placeholder="Cari nama siswa / NIS..." 
                           class="pl-8 pr-3.5 py-2 text-xs rounded-xl border border-slate-200 focus:border-green-600 outline-none w-56">
                </div>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table id="siswaTable" class="w-full text-left text-xs">
                <thead>
                    <tr class="bg-slate-50 text-slate-500 font-extrabold uppercase tracking-wider border-y border-slate-100">
                        <th class="py-3.5 px-4 rounded-l-xl text-center w-12">No</th>
                        <th class="py-3.5 px-4">Nama Lengkap & NIS</th>
                        <th class="py-3.5 px-4">Rombel Kelas</th>
                        <th class="py-3.5 px-4 text-center">JK</th>
                        <th class="py-3.5 px-4">Orang Tua / Wali</th>
                        <th class="py-3.5 px-4 text-center rounded-r-xl w-44">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 font-medium text-slate-700">
                    @forelse($siswas as $i => $siswa)
                    <tr class="hover:bg-slate-50/80 transition">
                        <td class="py-3.5 px-4 text-center text-slate-400 font-bold">
                            {{ $i + 1 }}
                        </td>
                        <td class="py-3.5 px-4">
                            <div class="flex items-center gap-3">
                                @if($siswa->foto)
                                    <img src="{{ asset('storage/'.$siswa->foto) }}" alt="{{ $siswa->nama }}" class="w-9 h-9 rounded-xl object-cover shadow-xs">
                                @else
                                    <div class="w-9 h-9 rounded-xl bg-gradient-to-tr from-green-600 to-emerald-500 text-white font-bold flex items-center justify-center text-xs shadow-xs">
                                        {{ strtoupper(substr($siswa->nama, 0, 1)) }}
                                    </div>
                                @endif
                                <div>
                                    <span class="block font-bold text-slate-900 text-xs sm:text-sm">{{ $siswa->nama }}</span>
                                    <span class="block text-[11px] text-slate-400">NIS: {{ $siswa->nis ?? '-' }}</span>
                                </div>
                            </div>
                        </td>
                        <td class="py-3.5 px-4">
                            @if($siswa->kelas)
                                <span class="inline-flex items-center gap-1 px-2.5 py-1 bg-green-50 text-green-800 border border-green-200 rounded-lg font-bold text-[11px]">
                                    <i class="fa-solid fa-chalkboard text-green-600"></i>
                                    <span>{{ $siswa->kelas->nama_kelas }}</span>
                                </span>
                            @else
                                <span class="text-slate-400 text-xs">-</span>
                            @endif
                        </td>
                        <td class="py-3.5 px-4 text-center">
                            @if($siswa->jenis_kelamin == 'L' || $siswa->jenis_kelamin == 'Laki-laki')
                                <span class="inline-flex items-center gap-1 text-blue-700 bg-blue-50 px-2 py-0.5 rounded-md font-bold text-[11px]">
                                    <i class="fa-solid fa-mars"></i> L
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1 text-pink-700 bg-pink-50 px-2 py-0.5 rounded-md font-bold text-[11px]">
                                    <i class="fa-solid fa-venus"></i> P
                                </span>
                            @endif
                        </td>
                        <td class="py-3.5 px-4 text-slate-600">
                            <span class="block font-medium">{{ $siswa->nama_ayah ?? $siswa->nama_ibu ?? '-' }}</span>
                            <span class="block text-[10px] text-slate-400">{{ $siswa->no_hp ?? '' }}</span>
                        </td>
                        <td class="py-3.5 px-4 text-center">
                            <div class="flex items-center justify-center gap-1.5">
                                
                                {{-- Tombol Edit --}}
                                <a href="{{ route('admin.siswa.edit', $siswa->uuid ?? $siswa->id) }}" 
                                   title="Edit Data Siswa"
                                   class="w-7 h-7 rounded-lg bg-amber-50 hover:bg-amber-500 text-amber-600 hover:text-white border border-amber-200 hover:border-amber-500 flex items-center justify-center text-xs transition">
                                    <i class="fa-solid fa-pen-to-square text-[10px]"></i>
                                </a>

                                {{-- Tombol Akun --}}
                                <a href="{{ route('admin.user-create', $siswa->uuid ?? $siswa->id) }}" 
                                   title="Kelola Akun Login Siswa"
                                   class="w-7 h-7 rounded-lg bg-blue-50 hover:bg-blue-600 text-blue-600 hover:text-white border border-blue-200 hover:border-blue-600 flex items-center justify-center text-xs transition">
                                    <i class="fa-solid fa-key text-[10px]"></i>
                                </a>

                                {{-- Tombol Hapus --}}
                                <form action="{{ route('admin.siswa.destroy', $siswa->uuid ?? $siswa->id) }}" 
                                      method="POST"
                                      onsubmit="return confirm('Yakin ingin menghapus data siswa {{ $siswa->nama }}?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            title="Hapus Siswa"
                                            class="w-7 h-7 rounded-lg bg-red-50 hover:bg-red-600 text-red-600 hover:text-white border border-red-200 hover:border-red-600 flex items-center justify-center text-xs transition">
                                        <i class="fa-solid fa-trash-can text-[10px]"></i>
                                    </button>
                                </form>

                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="py-8 text-center text-slate-400 font-semibold">
                            <i class="fa-solid fa-user-xmark text-3xl mb-2 block"></i>
                            Belum ada data siswa terdaftar.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>

</div>

{{-- Dynamic Wilayah Indonesia API & Filter Scripts --}}
<script>
function toggleFormTambahSiswa() {
    const form = document.getElementById('formTambahSiswa');
    const btnText = document.getElementById('btnFormText');
    const btnIcon = document.getElementById('btnFormIcon');

    if (form.classList.contains('hidden')) {
        form.classList.remove('hidden');
        btnText.innerText = 'Tutup Formulir';
        btnIcon.className = 'fa-solid fa-xmark';
    } else {
        form.classList.add('hidden');
        btnText.innerText = 'Tambah Siswa Baru';
        btnIcon.className = 'fa-solid fa-user-plus';
    }
}

function filterSiswaTable() {
    const input = document.getElementById("searchSiswa");
    const filter = input.value.toLowerCase();
    const table = document.getElementById("siswaTable");
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

document.addEventListener("DOMContentLoaded", function () {
    const provinsiSelect = document.getElementById('provinsi');
    const kabupatenSelect = document.getElementById('kota');
    const kecamatanSelect = document.getElementById('kecamatan');

    if (provinsiSelect) {
        async function loadProvinsi() {
            try {
                const response = await fetch('/api/provinsi');
                const result = await response.json();
                provinsiSelect.innerHTML = '<option value="">Pilih Provinsi</option>';
                result.data.forEach(function (provinsi) {
                    provinsiSelect.innerHTML += `<option value="${provinsi.name}" data-code="${provinsi.code}">${provinsi.name}</option>`;
                });
            } catch (e) {
                console.error("Error loading provinsi", e);
            }
        }

        async function loadKabupaten(provinsiCode) {
            try {
                const response = await fetch(`/api/kabupaten/${provinsiCode}`);
                const result = await response.json();
                kabupatenSelect.innerHTML = '<option value="">Pilih Kabupaten</option>';
                kecamatanSelect.innerHTML = '<option value="">Pilih Kecamatan</option>';
                result.data.forEach(function (kabupaten) {
                    kabupatenSelect.innerHTML += `<option value="${kabupaten.name}" data-code="${kabupaten.code}">${kabupaten.name}</option>`;
                });
            } catch (e) {
                console.error("Error loading kabupaten", e);
            }
        }

        async function loadKecamatan(kabupatenCode) {
            try {
                const response = await fetch(`/api/kecamatan/${kabupatenCode.replace('.', '-')}`);
                const result = await response.json();
                kecamatanSelect.innerHTML = '<option value="">Pilih Kecamatan</option>';
                result.data.forEach(function (kecamatan) {
                    kecamatanSelect.innerHTML += `<option value="${kecamatan.name}">${kecamatan.name}</option>`;
                });
            } catch (e) {
                console.error("Error loading kecamatan", e);
            }
        }

        provinsiSelect.addEventListener('change', function () {
            const code = this.options[this.selectedIndex].dataset.code;
            if (code) loadKabupaten(code);
        });

        kabupatenSelect.addEventListener('change', function () {
            const code = this.options[this.selectedIndex].dataset.code;
            if (code) loadKecamatan(code);
        });

        loadProvinsi();
    }
});
</script>

@endsection