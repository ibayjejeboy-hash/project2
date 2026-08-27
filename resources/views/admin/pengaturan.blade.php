@extends('layouts.admin')

@section('title', 'Pengaturan Website - RA Al Musyaffallah')
@section('page_title', 'Pengaturan Website')

@section('content')

<div class="space-y-8">
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl sm:text-3xl font-black text-slate-900 tracking-tight">
                Pengaturan Umum & PPDB
            </h1>
            <p class="text-xs sm:text-sm text-slate-500 font-medium mt-1">
                Kelola informasi dinamis website seperti kontak, jadwal, biaya, dan kecerdasan buatan Chatbot AI.
            </p>
        </div>
    </div>

    @if(session('success'))
    <div class="bg-green-50 border-l-4 border-green-500 p-4 rounded-r-xl shadow-sm">
        <div class="flex">
            <div class="flex-shrink-0">
                <i class="fa-solid fa-circle-check text-green-500"></i>
            </div>
            <div class="ml-3">
                <p class="text-sm text-green-700 font-medium">
                    {{ session('success') }}
                </p>
            </div>
        </div>
    </div>
    @endif

    <form action="{{ route('admin.pengaturan.update') }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')
        
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            @foreach($pengaturans as $grup => $items)
            <div class="bg-white p-6 sm:p-8 rounded-3xl border border-slate-100 shadow-sm space-y-6 @if($grup == 'Chatbot AI') lg:col-span-2 @endif">
                <h3 class="text-lg font-black text-slate-800 uppercase tracking-wider flex items-center gap-2 pb-3 border-b border-slate-100">
                    @if($grup == 'Kontak & Identitas') <i class="fa-solid fa-address-book text-blue-600"></i>
                    @elseif($grup == 'Jadwal & Biaya PPDB') <i class="fa-solid fa-calendar-check text-green-600"></i>
                    @elseif($grup == 'Chatbot AI') <i class="fa-solid fa-robot text-purple-600"></i>
                    @else <i class="fa-solid fa-gear text-slate-600"></i>
                    @endif
                    <span>{{ $grup }}</span>
                </h3>

                <div class="space-y-5">
                    @foreach($items as $item)
                    <div>
                        <label class="block text-xs font-extrabold text-slate-700 uppercase tracking-wider mb-2">
                            {{ $item->label }}
                        </label>
                        
                        @if($item->tipe == 'textarea')
                        <textarea name="{{ $item->kunci }}" rows="5" class="w-full p-3.5 rounded-xl border border-slate-200 bg-white text-slate-800 text-sm focus:border-green-600 focus:ring-2 focus:ring-green-100 outline-none transition">{{ $item->nilai }}</textarea>
                        @elseif($item->tipe == 'boolean')
                        <select name="{{ $item->kunci }}" class="w-full p-3.5 rounded-xl border border-slate-200 bg-white text-slate-800 text-sm focus:border-green-600 focus:ring-2 focus:ring-green-100 outline-none transition">
                            <option value="Buka" {{ $item->nilai == 'Buka' ? 'selected' : '' }}>Aktif / Buka</option>
                            <option value="Tutup" {{ $item->nilai == 'Tutup' ? 'selected' : '' }}>Nonaktif / Tutup</option>
                        </select>
                        @else
                        <input type="text" name="{{ $item->kunci }}" value="{{ $item->nilai }}" class="w-full p-3.5 rounded-xl border border-slate-200 bg-white text-slate-800 text-sm focus:border-green-600 focus:ring-2 focus:ring-green-100 outline-none transition">
                        @endif
                    </div>
                    @endforeach
                </div>
            </div>
            @endforeach
        </div>

        <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm flex justify-end">
            <button type="submit" class="inline-flex items-center justify-center gap-2 bg-gradient-to-r from-green-600 to-emerald-700 hover:from-green-700 hover:to-emerald-800 text-white font-black py-3.5 px-8 rounded-xl shadow-lg transition duration-200 text-sm uppercase tracking-wider">
                <i class="fa-solid fa-floppy-disk"></i>
                <span>Simpan Seluruh Pengaturan</span>
            </button>
        </div>
    </form>
</div>
@endsection
