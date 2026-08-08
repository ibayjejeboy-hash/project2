@extends('layouts.admin')

@section('title', 'Kelola Galeri Aktivitas - RA Al Musyaffallah')
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
                Unggah foto dokumentasi kegiatan siswa untuk ditampilkan pada halaman publik website.
            </p>
        </div>
    </div>

    {{-- ================= FORM UNGGAH GALERI ================= --}}
    <div class="bg-white p-6 sm:p-8 rounded-3xl border border-slate-100 shadow-sm">
        <div class="flex items-center gap-3 pb-4 mb-6 border-b border-slate-100">
            <div class="w-10 h-10 rounded-2xl bg-purple-100 text-purple-700 flex items-center justify-center font-black">
                <i class="fa-solid fa-cloud-arrow-up text-base"></i>
            </div>
            <div>
                <h2 class="text-base font-black text-slate-900">Unggah Foto Baru</h2>
                <p class="text-[11px] text-slate-500">Format gambar JPG, PNG, WEBP (Maksimal 2MB)</p>
            </div>
        </div>

        <form action="{{ route('admin.galeri.store') }}" 
              method="POST" 
              enctype="multipart/form-data" 
              class="grid grid-cols-1 md:grid-cols-12 gap-5">
            @csrf

            <div class="md:col-span-6">
                <label class="block text-xs font-extrabold text-slate-700 uppercase tracking-wider mb-2">
                    Judul / Keterangan Foto <span class="text-red-500">*</span>
                </label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                        <i class="fa-solid fa-heading text-xs"></i>
                    </div>
                    <input type="text" 
                           name="judul" 
                           value="{{ old('judul') }}"
                           placeholder="Contoh: Kegiatan Praktik Shalat Dhuha Bersama" 
                           class="w-full pl-9 pr-3.5 py-3 rounded-xl border border-slate-200 focus:border-green-600 focus:ring-2 focus:ring-green-100 outline-none text-xs sm:text-sm text-slate-800" 
                           required>
                </div>
            </div>

            <div class="md:col-span-6">
                <label class="block text-xs font-extrabold text-slate-700 uppercase tracking-wider mb-2">
                    Pilih Berkas Gambar <span class="text-red-500">*</span>
                </label>
                <input type="file" 
                       name="gambar" 
                       accept="image/*"
                       class="w-full text-xs text-slate-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-green-100 file:text-green-800 hover:file:bg-green-200 border border-slate-200 rounded-xl p-1 cursor-pointer" 
                       required>
            </div>

            <div class="md:col-span-12 flex justify-end">
                <button type="submit" 
                        class="inline-flex items-center gap-2 bg-gradient-to-r from-green-600 to-emerald-700 hover:from-green-700 hover:to-emerald-800 text-white font-black py-3 px-6 rounded-xl shadow-md transition duration-200 text-xs sm:text-sm uppercase tracking-wide">
                    <i class="fa-solid fa-cloud-arrow-up"></i>
                    <span>Unggah ke Galeri</span>
                </button>
            </div>
        </form>
    </div>

    {{-- ================= GRID FOTO GALERI ================= --}}
    <div>
        <div class="flex items-center justify-between mb-5">
            <h3 class="text-base font-black text-slate-900">
                Koleksi Galeri ({{ count($galeris) }} Foto)
            </h3>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($galeris as $item)
            <div class="bg-white rounded-3xl border border-slate-100 shadow-sm overflow-hidden flex flex-col justify-between group hover:shadow-xl transition-all duration-300">
                
                {{-- Image Thumbnail --}}
                <div class="relative h-48 w-full overflow-hidden bg-slate-100">
                    <img src="{{ asset('storage/'.$item->gambar) }}" 
                         alt="{{ $item->judul }}" 
                         class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-950/70 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition duration-300 flex items-end p-4">
                        <span class="text-xs text-white font-bold">{{ $item->judul }}</span>
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

                        <div>
                            <label class="block text-[11px] font-extrabold text-slate-600 uppercase mb-1">Ubah Judul</label>
                            <input type="text" 
                                   name="judul" 
                                   value="{{ $item->judul }}" 
                                   class="w-full px-3 py-2 text-xs rounded-xl border border-slate-200 focus:border-green-600 outline-none">
                        </div>

                        <div>
                            <label class="block text-[11px] font-extrabold text-slate-600 uppercase mb-1">Ganti Foto (Opsional)</label>
                            <input type="file" 
                                   name="gambar" 
                                   accept="image/*"
                                   class="w-full text-[11px] text-slate-500 file:mr-2 file:py-1 file:px-2.5 file:rounded-lg file:border-0 file:text-[11px] file:font-semibold file:bg-slate-100 file:text-slate-700 border border-slate-200 rounded-xl p-0.5">
                        </div>

                        <div class="grid grid-cols-2 gap-2 pt-1">
                            <button type="submit" 
                                    class="w-full inline-flex items-center justify-center gap-1.5 bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 rounded-xl text-xs transition">
                                <i class="fa-solid fa-pen-to-square text-[10px]"></i>
                                <span>Update</span>
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
                <span class="font-semibold text-sm">Belum ada foto kegiatan di galeri.</span>
            </div>
            @endforelse
        </div>
    </div>

</div>

@endsection