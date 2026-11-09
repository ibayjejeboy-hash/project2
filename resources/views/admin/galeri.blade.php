@extends('layouts.admin')

@section('title', 'Kelola Galeri Aktivitas - RA Al-Musyafallahi')
@section('page_title', 'Galeri Aktivitas')

@section('content')

<div class="space-y-8">

    {{-- Page Header --}}
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl sm:text-3xl font-black text-slate-900 tracking-tight">
                Galeri & Dokumentasi Kegiatan
            </h1>
            <p class="text-xs sm:text-sm text-slate-500 font-medium mt-1">
                Kelola foto digital kegiatan siswa dan guru untuk ditampilkan di website serta siap dicetak resmi.
            </p>
        </div>
        <div class="flex items-center gap-2">
            <a href="{{ route('galeri.cetak', ['kategori' => $kategori]) }}" 
               target="_blank"
               class="inline-flex items-center gap-2 px-4 py-2.5 bg-slate-900 hover:bg-slate-800 text-white font-bold rounded-xl text-xs shadow-sm transition">
                <i class="fa-solid fa-print text-green-400"></i>
                <span>Cetak Lembar Dokumen (A4)</span>
            </a>
            <a href="{{ route('galeri') }}" 
               target="_blank"
               class="inline-flex items-center gap-2 px-4 py-2.5 bg-green-50 text-green-700 hover:bg-green-100 border border-green-200 font-bold rounded-xl text-xs transition">
                <i class="fa-solid fa-arrow-up-right-from-square"></i>
                <span>Lihat Halaman Publik</span>
            </a>
        </div>
    </div>

    {{-- ================= FORM UNGGAH GALERI ================= --}}
    <div class="bg-white p-6 sm:p-8 rounded-3xl border border-slate-100 shadow-sm">
        <div class="flex items-center gap-3 pb-4 mb-6 border-b border-slate-100">
            <div class="w-10 h-10 rounded-2xl bg-emerald-100 text-emerald-700 flex items-center justify-center font-black">
                <i class="fa-solid fa-cloud-arrow-up text-base"></i>
            </div>
            <div>
                <h2 class="text-base font-black text-slate-900">Unggah Foto Dokumentasi Baru</h2>
                <p class="text-[11px] text-slate-500">Pilih kategori (Kegiatan Siswa / Kegiatan Guru) dan unggah foto digital (Maks. 5MB)</p>
            </div>
        </div>

        <form action="{{ route('admin.galeri.store') }}" 
              method="POST" 
              enctype="multipart/form-data" 
              class="grid grid-cols-1 md:grid-cols-12 gap-5">
            @csrf

            {{-- Kategori Kegiatan --}}
            <div class="md:col-span-4">
                <label class="block text-xs font-extrabold text-slate-700 uppercase tracking-wider mb-2">
                    Kategori Kegiatan <span class="text-red-500">*</span>
                </label>
                <div class="grid grid-cols-2 gap-2">
                    <label class="relative flex items-center gap-2 p-3 rounded-xl border border-slate-200 cursor-pointer hover:border-green-500 has-[:checked]:border-green-600 has-[:checked]:bg-green-50/60 transition">
                        <input type="radio" name="kategori" value="kegiatan_siswa" checked class="text-green-600 focus:ring-green-500">
                        <span class="text-xs font-bold text-slate-800 flex items-center gap-1.5">
                            <i class="fa-solid fa-shapes text-emerald-600 text-[11px]"></i>
                            <span>Siswa</span>
                        </span>
                    </label>

                    <label class="relative flex items-center gap-2 p-3 rounded-xl border border-slate-200 cursor-pointer hover:border-purple-500 has-[:checked]:border-purple-600 has-[:checked]:bg-purple-50/60 transition">
                        <input type="radio" name="kategori" value="kegiatan_guru" {{ old('kategori') === 'kegiatan_guru' ? 'checked' : '' }} class="text-purple-600 focus:ring-purple-500">
                        <span class="text-xs font-bold text-slate-800 flex items-center gap-1.5">
                            <i class="fa-solid fa-chalkboard-user text-purple-600 text-[11px]"></i>
                            <span>Guru</span>
                        </span>
                    </label>
                </div>
            </div>

            {{-- Judul Kegiatan --}}
            <div class="md:col-span-5">
                <label class="block text-xs font-extrabold text-slate-700 uppercase tracking-wider mb-2">
                    Judul Kegiatan <span class="text-red-500">*</span>
                </label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                        <i class="fa-solid fa-heading text-xs"></i>
                    </div>
                    <input type="text" 
                           name="judul" 
                           value="{{ old('judul') }}"
                           placeholder="Contoh: Praktik Manasik Haji Cilik / Rapat Evaluasi Guru" 
                           class="w-full pl-9 pr-3.5 py-3 rounded-xl border border-slate-200 focus:border-green-600 focus:ring-2 focus:ring-green-100 outline-none text-xs sm:text-sm text-slate-800 font-medium" 
                           required>
                </div>
            </div>

            {{-- Tanggal Pelaksanaan --}}
            <div class="md:col-span-3">
                <label class="block text-xs font-extrabold text-slate-700 uppercase tracking-wider mb-2">
                    Tanggal Kegiatan
                </label>
                <input type="date" 
                       name="tanggal_kegiatan" 
                       value="{{ old('tanggal_kegiatan', date('Y-m-d')) }}"
                       class="w-full px-3.5 py-3 rounded-xl border border-slate-200 focus:border-green-600 focus:ring-2 focus:ring-green-100 outline-none text-xs sm:text-sm text-slate-800">
            </div>

            {{-- Berkas Gambar --}}
            <div class="md:col-span-6">
                <label class="block text-xs font-extrabold text-slate-700 uppercase tracking-wider mb-2">
                    Pilih Berkas Foto Digital <span class="text-red-500">*</span>
                </label>
                <input type="file" 
                       name="gambar" 
                       accept="image/*"
                       class="w-full text-xs text-slate-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-green-100 file:text-green-800 hover:file:bg-green-200 border border-slate-200 rounded-xl p-1 cursor-pointer" 
                       required>
                <span class="text-[11px] text-slate-400 mt-1 block">Format: JPG, JPEG, PNG, WEBP (Resolusi jernih untuk cetak)</span>
            </div>

            {{-- Deskripsi / Catatan Kegiatan --}}
            <div class="md:col-span-6">
                <label class="block text-xs font-extrabold text-slate-700 uppercase tracking-wider mb-2">
                    Keterangan / Deskripsi Singkat
                </label>
                <input type="text" 
                       name="deskripsi" 
                       value="{{ old('deskripsi') }}"
                       placeholder="Catatan tambahan mengenai kegiatan untuk dicantumkan saat print out" 
                       class="w-full px-3.5 py-3 rounded-xl border border-slate-200 focus:border-green-600 focus:ring-2 focus:ring-green-100 outline-none text-xs sm:text-sm text-slate-800">
            </div>

            <div class="md:col-span-12 flex justify-end pt-2">
                <button type="submit" 
                        class="inline-flex items-center gap-2 bg-gradient-to-r from-green-600 to-emerald-700 hover:from-green-700 hover:to-emerald-800 text-white font-black py-3 px-6 rounded-xl shadow-md transition duration-200 text-xs sm:text-sm uppercase tracking-wide">
                    <i class="fa-solid fa-cloud-arrow-up"></i>
                    <span>Unggah ke Galeri</span>
                </button>
            </div>
        </form>
    </div>

    {{-- ================= GRID FOTO GALERI ================= --}}
    <div class="space-y-5">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <h3 class="text-base font-black text-slate-900">
                    Koleksi Galeri ({{ count($galeris) }} Foto)
                </h3>
                <p class="text-xs text-slate-500">Filter berdasarkan kategori atau cetak lembar dokumentasi kegiatan.</p>
            </div>

            {{-- Category Filter Tabs --}}
            <div class="flex items-center gap-2">
                <a href="{{ route('admin.galeri') }}" 
                   class="px-3 py-1.5 rounded-xl text-xs font-bold transition {{ !$kategori ? 'bg-slate-900 text-white' : 'bg-white text-slate-600 hover:bg-slate-100 border border-slate-200' }}">
                    Semua ({{ $countTotal }})
                </a>
                <a href="{{ route('admin.galeri', ['kategori' => 'kegiatan_siswa']) }}" 
                   class="px-3 py-1.5 rounded-xl text-xs font-bold transition {{ $kategori === 'kegiatan_siswa' ? 'bg-emerald-600 text-white' : 'bg-white text-slate-600 hover:bg-emerald-50 border border-slate-200' }}">
                    Siswa ({{ $countSiswa }})
                </a>
                <a href="{{ route('admin.galeri', ['kategori' => 'kegiatan_guru']) }}" 
                   class="px-3 py-1.5 rounded-xl text-xs font-bold transition {{ $kategori === 'kegiatan_guru' ? 'bg-purple-600 text-white' : 'bg-white text-slate-600 hover:bg-purple-50 border border-slate-200' }}">
                    Guru ({{ $countGuru }})
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($galeris as $item)
            <div class="bg-white rounded-3xl border border-slate-100 shadow-sm overflow-hidden flex flex-col justify-between group hover:shadow-xl transition-all duration-300">
                
                {{-- Image Thumbnail with Meta Badges --}}
                <div class="relative h-52 w-full overflow-hidden bg-slate-100">
                    <img src="{{ $item->gambar_url }}" 
                         alt="{{ $item->judul }}" 
                         class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                    
                    {{-- Badges on top --}}
                    <div class="absolute top-3 left-3 right-3 flex items-center justify-between gap-2 pointer-events-none">
                        <span class="px-2.5 py-0.5 rounded-full text-[10px] font-black uppercase tracking-wider backdrop-blur-md shadow-sm {{ $item->kategori === 'kegiatan_guru' ? 'bg-purple-900/90 text-purple-100 border border-purple-400/30' : 'bg-emerald-900/90 text-emerald-100 border border-emerald-400/30' }}">
                            {{ $item->kategori_label }}
                        </span>

                        @if($item->tanggal_kegiatan)
                        <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-black/60 text-white backdrop-blur-md">
                            {{ $item->tanggal_kegiatan->format('d/m/Y') }}
                        </span>
                        @endif
                    </div>

                    {{-- Quick Single Print Action on Hover --}}
                    <div class="absolute inset-0 bg-slate-950/40 opacity-0 group-hover:opacity-100 transition duration-300 flex items-center justify-center gap-2 p-3">
                        <a href="{{ route('galeri.cetak.single', $item->id) }}" 
                           target="_blank"
                           class="px-3 py-1.5 bg-white text-slate-900 text-xs font-bold rounded-xl shadow-lg hover:bg-green-50 transition flex items-center gap-1.5">
                            <i class="fa-solid fa-print text-green-600"></i>
                            <span>Print Dokumen</span>
                        </a>
                        <a href="{{ $item->gambar_url }}" 
                           target="_blank"
                           class="px-3 py-1.5 bg-slate-900/90 text-white text-xs font-bold rounded-xl shadow-lg hover:bg-slate-900 transition flex items-center gap-1.5">
                            <i class="fa-solid fa-expand"></i>
                            <span>Lihat Asli</span>
                        </a>
                    </div>
                </div>

                {{-- Edit & Actions --}}
                <div class="p-5 space-y-4">
                    <form action="{{ route('admin.galeri.update', $item->id) }}" 
                          method="POST" 
                          enctype="multipart/form-data"
                          class="space-y-3">
                        @csrf
                        @method('PUT')

                        {{-- Judul --}}
                        <div>
                            <label class="block text-[11px] font-extrabold text-slate-600 uppercase mb-1">Ubah Judul</label>
                            <input type="text" 
                                   name="judul" 
                                   value="{{ $item->judul }}" 
                                   class="w-full px-3 py-2 text-xs rounded-xl border border-slate-200 focus:border-green-600 outline-none" required>
                        </div>

                        {{-- Kategori & Tanggal --}}
                        <div class="grid grid-cols-2 gap-2">
                            <div>
                                <label class="block text-[11px] font-extrabold text-slate-600 uppercase mb-1">Kategori</label>
                                <select name="kategori" class="w-full px-2.5 py-1.5 text-xs rounded-xl border border-slate-200 focus:border-green-600 outline-none bg-white">
                                    <option value="kegiatan_siswa" {{ $item->kategori === 'kegiatan_siswa' ? 'selected' : '' }}>Kegiatan Siswa</option>
                                    <option value="kegiatan_guru" {{ $item->kategori === 'kegiatan_guru' ? 'selected' : '' }}>Kegiatan Guru</option>
                                </select>
                            </div>

                            <div>
                                <label class="block text-[11px] font-extrabold text-slate-600 uppercase mb-1">Tgl Kegiatan</label>
                                <input type="date" 
                                       name="tanggal_kegiatan" 
                                       value="{{ $item->tanggal_kegiatan ? $item->tanggal_kegiatan->format('Y-m-d') : '' }}" 
                                       class="w-full px-2 py-1.5 text-xs rounded-xl border border-slate-200 focus:border-green-600 outline-none">
                            </div>
                        </div>

                        {{-- Deskripsi --}}
                        <div>
                            <label class="block text-[11px] font-extrabold text-slate-600 uppercase mb-1">Deskripsi Singkat</label>
                            <input type="text" 
                                   name="deskripsi" 
                                   value="{{ $item->deskripsi }}" 
                                   placeholder="Keterangan foto kegiatan"
                                   class="w-full px-3 py-1.5 text-xs rounded-xl border border-slate-200 focus:border-green-600 outline-none">
                        </div>

                        {{-- Ganti Foto --}}
                        <div>
                            <label class="block text-[11px] font-extrabold text-slate-600 uppercase mb-1">Ganti Foto (Opsional)</label>
                            <input type="file" 
                                   name="gambar" 
                                   accept="image/*"
                                   class="w-full text-[11px] text-slate-500 file:mr-2 file:py-1 file:px-2.5 file:rounded-lg file:border-0 file:text-[11px] file:font-semibold file:bg-slate-100 file:text-slate-700 border border-slate-200 rounded-xl p-0.5">
                        </div>

                        <div class="grid grid-cols-2 gap-2 pt-2">
                            <button type="submit" 
                                    class="w-full inline-flex items-center justify-center gap-1.5 bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 rounded-xl text-xs transition">
                                <i class="fa-solid fa-pen-to-square text-[10px]"></i>
                                <span>Perbarui</span>
                            </button>

                            <button type="button" 
                                    onclick="if(confirm('Yakin ingin menghapus foto kegiatan ini?')) { document.getElementById('delete-galeri-{{ $item->id }}').submit(); }"
                                    class="w-full inline-flex items-center justify-center gap-1.5 bg-red-50 hover:bg-red-600 text-red-600 hover:text-white font-bold py-2 rounded-xl border border-red-200 hover:border-red-600 text-xs transition">
                                <i class="fa-solid fa-trash-can text-[10px]"></i>
                                <span>Hapus</span>
                            </button>
                        </div>
                    </form>

                    {{-- Hidden Delete Form --}}
                    <form id="delete-galeri-{{ $item->id }}" 
                          action="{{ route('admin.galeri.destroy', $item->id) }}" 
                          method="POST" 
                          class="hidden">
                        @csrf
                        @method('DELETE')
                    </form>
                </div>

            </div>
            @empty
            <div class="col-span-full bg-white p-12 rounded-3xl border border-slate-100 text-center text-slate-400">
                <i class="fa-solid fa-images text-4xl mb-2 block"></i>
                <span class="font-semibold text-sm">Belum ada foto kegiatan di kategori ini.</span>
            </div>
            @endforelse
        </div>
    </div>

</div>

@endsection
