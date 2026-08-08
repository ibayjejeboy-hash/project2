@extends('layouts.admin')

@section('title', 'Informasi Profil Sekolah - RA Al Musyaffallah')
@section('page_title', 'Visi, Misi & Profil')

@section('content')

<div class="space-y-8">

    {{-- Page Header --}}
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl sm:text-3xl font-black text-slate-900 tracking-tight">
                Visi, Misi & Informasi Sekolah
            </h1>
            <p class="text-xs sm:text-sm text-slate-500 font-medium mt-1">
                Kelola profil lembaga, visi misi, dan sambutan yang tampil di halaman beranda website.
            </p>
        </div>
        <div>
            <button type="button" 
                    id="btnToggleEdit"
                    onclick="toggleEditMode()" 
                    class="inline-flex items-center gap-2 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-bold py-2.5 px-5 rounded-xl shadow-md transition duration-200 text-xs sm:text-sm">
                <i id="editIcon" class="fa-solid fa-pen-to-square"></i>
                <span id="editText">Aktifkan Mode Edit</span>
            </button>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
        
        {{-- ================= FORM EDIT (Left 7 Cols) ================= --}}
        <div class="lg:col-span-7 bg-white p-6 sm:p-8 rounded-3xl border border-slate-100 shadow-sm space-y-6">
            
            <form action="{{ route('admin.informasi.store') }}" 
                  method="POST" 
                  enctype="multipart/form-data" 
                  class="space-y-5">
                @csrf

                {{-- Visi --}}
                <div>
                    <label class="block text-xs font-extrabold text-slate-700 uppercase tracking-wider mb-2">
                        Visi Sekolah
                    </label>
                    <textarea id="visi" 
                              name="visi" 
                              rows="3" 
                              class="w-full p-3.5 rounded-xl border border-slate-200 bg-slate-50 text-slate-800 text-xs sm:text-sm focus:bg-white focus:border-green-600 focus:ring-2 focus:ring-green-100 outline-none transition" 
                              readonly>{{ $informasi->visi ?? '' }}</textarea>
                </div>

                {{-- Misi --}}
                <div>
                    <label class="block text-xs font-extrabold text-slate-700 uppercase tracking-wider mb-2">
                        Misi Sekolah (Pisahkan dengan baris baru)
                    </label>
                    <textarea id="misi" 
                              name="misi" 
                              rows="5" 
                              class="w-full p-3.5 rounded-xl border border-slate-200 bg-slate-50 text-slate-800 text-xs sm:text-sm focus:bg-white focus:border-green-600 focus:ring-2 focus:ring-green-100 outline-none transition" 
                              readonly>{{ $informasi->misi ?? '' }}</textarea>
                </div>

                {{-- Deskripsi / Sambutan --}}
                <div>
                    <label class="block text-xs font-extrabold text-slate-700 uppercase tracking-wider mb-2">
                        Sambutan / Deskripsi Selayang Pandang
                    </label>
                    <textarea id="deskripsi" 
                              name="deskripsi" 
                              rows="5" 
                              class="w-full p-3.5 rounded-xl border border-slate-200 bg-slate-50 text-slate-800 text-xs sm:text-sm focus:bg-white focus:border-green-600 focus:ring-2 focus:ring-green-100 outline-none transition" 
                              readonly>{{ $informasi->deskripsi ?? '' }}</textarea>
                </div>

                {{-- Upload Foto Profil --}}
                <div>
                    <label class="block text-xs font-extrabold text-slate-700 uppercase tracking-wider mb-2">
                        Foto Dewan Guru / Pendidik
                    </label>
                    <input type="file" 
                           id="foto" 
                           name="foto" 
                           accept="image/*"
                           class="w-full text-xs text-slate-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-slate-100 file:text-slate-700 border border-slate-200 rounded-xl p-1 bg-slate-50 cursor-not-allowed" 
                           disabled>
                </div>

                {{-- Tombol Simpan --}}
                <div id="saveContainer" class="hidden pt-2">
                    <button type="submit" 
                            class="w-full inline-flex items-center justify-center gap-2 bg-gradient-to-r from-green-600 to-emerald-700 hover:from-green-700 hover:to-emerald-800 text-white font-black py-3.5 px-6 rounded-xl shadow-lg transition duration-200 text-xs sm:text-sm uppercase tracking-wider">
                        <i class="fa-solid fa-floppy-disk"></i>
                        <span>Simpan Perubahan Informasi</span>
                    </button>
                </div>

            </form>
        </div>

        {{-- ================= LIVE PREVIEW CARD (Right 5 Cols) ================= --}}
        <div class="lg:col-span-5 bg-white p-6 sm:p-7 rounded-3xl border border-slate-100 shadow-sm space-y-5 sticky top-24">
            <h3 class="text-sm font-black text-slate-800 uppercase tracking-wider flex items-center gap-2 pb-3 border-b border-slate-100">
                <i class="fa-solid fa-eye text-green-600"></i>
                <span>Pratinjau Tampilan Web</span>
            </h3>

            @if(!empty($informasi->foto))
            <div class="rounded-2xl overflow-hidden shadow-sm border border-slate-100">
                <img src="{{ asset('storage/'.$informasi->foto) }}" 
                     alt="Foto Dewan Guru" 
                     class="w-full h-44 object-cover">
            </div>
            @endif

            <div class="space-y-3 text-xs">
                <div>
                    <span class="font-extrabold text-green-800 uppercase tracking-wider block text-[11px] mb-1">Visi Kami</span>
                    <p class="text-slate-600 italic bg-green-50/50 p-3 rounded-xl border border-green-100/60 leading-relaxed font-medium">
                        "{{ $informasi->visi ?? 'Visi belum diatur.' }}"
                    </p>
                </div>

                <div>
                    <span class="font-extrabold text-slate-700 uppercase tracking-wider block text-[11px] mb-1">Legalitas & Status</span>
                    <div class="grid grid-cols-2 gap-2 text-[11px]">
                        <span class="bg-slate-50 p-2 rounded-lg border border-slate-100 font-bold text-slate-700 text-center">Akreditasi B</span>
                        <span class="bg-slate-50 p-2 rounded-lg border border-slate-100 font-bold text-slate-700 text-center">SK Kemenkumham</span>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>

<script>
let isEditing = false;

function toggleEditMode() {
    isEditing = !isEditing;
    
    const visi = document.getElementById('visi');
    const misi = document.getElementById('misi');
    const deskripsi = document.getElementById('deskripsi');
    const foto = document.getElementById('foto');
    const saveContainer = document.getElementById('saveContainer');
    const editText = document.getElementById('editText');
    const editIcon = document.getElementById('editIcon');
    const btnToggleEdit = document.getElementById('btnToggleEdit');

    if (isEditing) {
        visi.removeAttribute('readonly');
        visi.classList.remove('bg-slate-50');
        
        misi.removeAttribute('readonly');
        misi.classList.remove('bg-slate-50');

        deskripsi.removeAttribute('readonly');
        deskripsi.classList.remove('bg-slate-50');

        foto.removeAttribute('disabled');
        foto.classList.remove('bg-slate-50', 'cursor-not-allowed');

        saveContainer.classList.remove('hidden');
        editText.innerText = 'Batal Edit';
        editIcon.className = 'fa-solid fa-xmark';
        btnToggleEdit.className = 'inline-flex items-center gap-2 bg-slate-600 hover:bg-slate-700 text-white font-bold py-2.5 px-5 rounded-xl shadow-md transition duration-200 text-xs sm:text-sm';
    } else {
        visi.setAttribute('readonly', true);
        visi.classList.add('bg-slate-50');
        
        misi.setAttribute('readonly', true);
        misi.classList.add('bg-slate-50');

        deskripsi.setAttribute('readonly', true);
        deskripsi.classList.add('bg-slate-50');

        foto.setAttribute('disabled', true);
        foto.classList.add('bg-slate-50', 'cursor-not-allowed');

        saveContainer.classList.add('hidden');
        editText.innerText = 'Aktifkan Mode Edit';
        editIcon.className = 'fa-solid fa-pen-to-square';
        btnToggleEdit.className = 'inline-flex items-center gap-2 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-bold py-2.5 px-5 rounded-xl shadow-md transition duration-200 text-xs sm:text-sm';
    }
}
</script>

@endsection