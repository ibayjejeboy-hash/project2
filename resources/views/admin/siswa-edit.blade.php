@extends('layouts.admin')

@section('title', 'Edit Data Siswa - RA Al Musyaffallah')
@section('page_title', 'Edit Data Siswa')

@section('content')

<div class="space-y-8">

    {{-- Page Header --}}
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <div class="flex items-center gap-2 text-xs font-bold text-slate-500 mb-1">
                <a href="{{ route('admin.siswa') }}" class="hover:text-green-700">Data Siswa</a>
                <span>/</span>
                <span class="text-slate-800">Edit Siswa</span>
            </div>
            <h1 class="text-2xl sm:text-3xl font-black text-slate-900 tracking-tight">
                Edit Data: {{ $siswa->nama }}
            </h1>
            <p class="text-xs sm:text-sm text-slate-500 font-medium mt-0.5">
                Perbarui rincian identitas siswa, kelas, dan data orang tua/wali.
            </p>
        </div>
        <a href="{{ route('admin.siswa') }}" 
           class="inline-flex items-center gap-2 px-4 py-2 bg-slate-200 hover:bg-slate-300 text-slate-800 font-bold rounded-xl text-xs sm:text-sm transition">
            <i class="fa-solid fa-arrow-left"></i>
            <span>Kembali ke Daftar</span>
        </a>
    </div>

    {{-- ================= FORM EDIT SISWA ================= --}}
    <div class="bg-white p-6 sm:p-8 rounded-3xl border border-slate-100 shadow-sm space-y-8">
        
        <form action="{{ route('admin.siswa.update', $siswa->id) }}" 
              method="POST" 
              enctype="multipart/form-data" 
              class="space-y-8">
            @csrf
            @method('PUT')

            {{-- 1. IDENTITAS SISWA --}}
            <div class="space-y-4">
                <div class="flex items-center gap-2 text-xs font-black text-green-800 uppercase tracking-wider bg-green-50 px-3 py-1.5 rounded-lg w-fit">
                    <i class="fa-solid fa-user"></i>
                    <span>1. Data Pokok Peserta Didik</span>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Nama Lengkap Anak <span class="text-red-500">*</span></label>
                        <input type="text" name="nama" value="{{ old('nama', $siswa->nama) }}" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 focus:border-green-600 outline-none text-xs sm:text-sm text-slate-800 font-semibold" required>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Nama Panggilan</label>
                        <input type="text" name="nama_panggilan" value="{{ old('nama_panggilan', $siswa->nama_panggilan) }}" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 focus:border-green-600 outline-none text-xs sm:text-sm text-slate-800">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">NISN / NIS</label>
                        <input type="text" name="nis" value="{{ old('nis', $siswa->nis) }}" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 focus:border-green-600 outline-none text-xs sm:text-sm text-slate-800">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Rombongan Belajar (Kelas) <span class="text-red-500">*</span></label>
                        <select name="kelas_id" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 focus:border-green-600 outline-none text-xs sm:text-sm text-slate-800 font-medium" required>
                            <option value="">-- Pilih Kelas --</option>
                            @foreach($kelas as $item)
                                <option value="{{ $item->id }}" {{ $siswa->kelas_id == $item->id ? 'selected' : '' }}>
                                    {{ $item->nama_kelas }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Jenis Kelamin <span class="text-red-500">*</span></label>
                        <select name="jenis_kelamin" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 focus:border-green-600 outline-none text-xs sm:text-sm text-slate-800 font-medium" required>
                            <option value="L" {{ ($siswa->jenis_kelamin == 'L' || $siswa->jenis_kelamin == 'Laki-laki') ? 'selected' : '' }}>Laki-laki (L)</option>
                            <option value="P" {{ ($siswa->jenis_kelamin == 'P' || $siswa->jenis_kelamin == 'Perempuan') ? 'selected' : '' }}>Perempuan (P)</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Tempat Lahir</label>
                        <input type="text" name="tempat_lahir" value="{{ old('tempat_lahir', $siswa->tempat_lahir) }}" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 focus:border-green-600 outline-none text-xs sm:text-sm text-slate-800">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Tanggal Lahir</label>
                        <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir', $siswa->tanggal_lahir) }}" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 focus:border-green-600 outline-none text-xs sm:text-sm text-slate-800">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Agama</label>
                        <select name="agama" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 focus:border-green-600 outline-none text-xs sm:text-sm text-slate-800 font-medium">
                            <option value="Islam" {{ $siswa->agama == 'Islam' ? 'selected' : '' }}>Islam</option>
                            <option value="Kristen" {{ $siswa->agama == 'Kristen' ? 'selected' : '' }}>Kristen</option>
                            <option value="Katolik" {{ $siswa->agama == 'Katolik' ? 'selected' : '' }}>Katolik</option>
                            <option value="Hindu" {{ $siswa->agama == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                            <option value="Budha" {{ $siswa->agama == 'Budha' ? 'selected' : '' }}>Budha</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Anak Ke-</label>
                        <select name="anak_ke" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 focus:border-green-600 outline-none text-xs sm:text-sm text-slate-800 font-medium">
                            @for($k = 1; $k <= 10; $k++)
                                <option value="{{ $k }}" {{ $siswa->anak_ke == $k ? 'selected' : '' }}>{{ $k }}</option>
                            @endfor
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
                        <input type="text" name="nama_ayah" value="{{ old('nama_ayah', $siswa->nama_ayah) }}" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 focus:border-green-600 outline-none text-xs sm:text-sm text-slate-800">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Nama Ibu</label>
                        <input type="text" name="nama_ibu" value="{{ old('nama_ibu', $siswa->nama_ibu) }}" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 focus:border-green-600 outline-none text-xs sm:text-sm text-slate-800">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">No. WhatsApp / HP</label>
                        <input type="text" name="no_hp" value="{{ old('no_hp', $siswa->no_hp) }}" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 focus:border-green-600 outline-none text-xs sm:text-sm text-slate-800">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Email Orang Tua</label>
                        <input type="email" name="email" value="{{ old('email', $siswa->email) }}" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 focus:border-green-600 outline-none text-xs sm:text-sm text-slate-800">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Pekerjaan Ayah</label>
                        <input type="text" name="pekerjaan_ayah" value="{{ old('pekerjaan_ayah', $siswa->pekerjaan_ayah) }}" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 focus:border-green-600 outline-none text-xs sm:text-sm text-slate-800">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Pekerjaan Ibu</label>
                        <input type="text" name="pekerjaan_ibu" value="{{ old('pekerjaan_ibu', $siswa->pekerjaan_ibu) }}" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 focus:border-green-600 outline-none text-xs sm:text-sm text-slate-800">
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
                        <input type="text" name="kode_pos" value="{{ old('kode_pos', $siswa->kode_pos) }}" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 focus:border-green-600 outline-none text-xs sm:text-sm text-slate-800">
                    </div>

                    <div class="md:col-span-4">
                        <label class="block text-xs font-bold text-slate-700 mb-1">Alamat Lengkap</label>
                        <textarea name="alamat" rows="2" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 focus:border-green-600 outline-none text-xs sm:text-sm text-slate-800">{{ old('alamat', $siswa->alamat) }}</textarea>
                    </div>
                </div>
            </div>

            {{-- 4. ADM & FOTO --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pt-2 items-center">
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">Tanggal Diterima Masuk</label>
                    <input type="date" name="tanggal_diterima" value="{{ old('tanggal_diterima', $siswa->tanggal_diterima) }}" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 focus:border-green-600 outline-none text-xs sm:text-sm text-slate-800">
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">Pas Foto Siswa (3x4)</label>
                    <div class="flex items-center gap-3">
                        @if($siswa->foto)
                            <img src="{{ asset('storage/'.$siswa->foto) }}" alt="{{ $siswa->nama }}" class="w-12 h-12 object-cover rounded-xl border border-slate-200">
                        @endif
                        <input type="file" name="foto" accept="image/*" class="flex-1 text-xs text-slate-500 file:mr-3 file:py-2 file:px-3 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-green-100 file:text-green-800 border border-slate-200 rounded-xl p-1">
                    </div>
                </div>
            </div>

            <div class="pt-4 flex justify-end gap-3 border-t border-slate-100">
                <a href="{{ route('admin.siswa') }}" class="px-5 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold rounded-xl text-xs sm:text-sm transition">
                    Batal
                </a>
                <button type="submit" class="inline-flex items-center gap-2 bg-gradient-to-r from-green-600 to-emerald-700 hover:from-green-700 hover:to-emerald-800 text-white font-black px-6 py-2.5 rounded-xl shadow-md text-xs sm:text-sm uppercase tracking-wide transition">
                    <i class="fa-solid fa-floppy-disk"></i>
                    <span>Simpan Perubahan Siswa</span>
                </button>
            </div>

        </form>

    </div>

</div>

{{-- Wilayah Select Dynamic Auto Loader --}}
<script>
document.addEventListener("DOMContentLoaded", function () {
    const selectedProvinsi = "{{ $siswa->provinsi }}";
    const selectedKota = "{{ $siswa->kota }}";
    const selectedKecamatan = "{{ $siswa->kecamatan }}";

    const provinsiSelect = document.getElementById('provinsi');
    const kabupatenSelect = document.getElementById('kota');
    const kecamatanSelect = document.getElementById('kecamatan');

    async function loadProvinsi() {
        try {
            const res = await fetch('/api/provinsi');
            const result = await res.json();
            provinsiSelect.innerHTML = '<option value="">Pilih Provinsi</option>';
            result.data.forEach(function (prov) {
                const isSelected = prov.name === selectedProvinsi ? 'selected' : '';
                provinsiSelect.innerHTML += `<option value="${prov.name}" data-code="${prov.code}" ${isSelected}>${prov.name}</option>`;
            });

            if (provinsiSelect.selectedIndex > 0) {
                const code = provinsiSelect.options[provinsiSelect.selectedIndex].dataset.code;
                if (code) loadKabupaten(code);
            }
        } catch (e) {
            console.error("Error load provinsi", e);
        }
    }

    async function loadKabupaten(provCode) {
        try {
            const res = await fetch(`/api/kabupaten/${provCode}`);
            const result = await res.json();
            kabupatenSelect.innerHTML = '<option value="">Pilih Kabupaten</option>';
            kecamatanSelect.innerHTML = '<option value="">Pilih Kecamatan</option>';
            result.data.forEach(function (kab) {
                const isSelected = kab.name === selectedKota ? 'selected' : '';
                kabupatenSelect.innerHTML += `<option value="${kab.name}" data-code="${kab.code}" ${isSelected}>${kab.name}</option>`;
            });

            if (kabupatenSelect.selectedIndex > 0) {
                const code = kabupatenSelect.options[kabupatenSelect.selectedIndex].dataset.code;
                if (code) loadKecamatan(code);
            }
        } catch (e) {
            console.error("Error load kabupaten", e);
        }
    }

    async function loadKecamatan(kabCode) {
        try {
            const res = await fetch(`/api/kecamatan/${kabCode.replace('.', '-')}`);
            const result = await res.json();
            kecamatanSelect.innerHTML = '<option value="">Pilih Kecamatan</option>';
            result.data.forEach(function (kec) {
                const isSelected = kec.name === selectedKecamatan ? 'selected' : '';
                kecamatanSelect.innerHTML += `<option value="${kec.name}" ${isSelected}>${kec.name}</option>`;
            });
        } catch (e) {
            console.error("Error load kecamatan", e);
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
});
</script>

@endsection