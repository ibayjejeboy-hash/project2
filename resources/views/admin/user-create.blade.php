@extends('layouts.admin')

@section('title', ($siswa->user_id ? 'Edit Akun Siswa' : 'Buat Akun Siswa') . ' - RA Al Musyaffallah')
@section('page_title', 'Kelola Akun Siswa')

@section('content')

<div class="max-w-2xl mx-auto space-y-8">

    {{-- Header --}}
    <div class="flex items-center justify-between">
        <div>
            <div class="flex items-center gap-2 text-xs font-bold text-slate-500 mb-1">
                <a href="{{ route('admin.siswa') }}" class="hover:text-green-700">Data Siswa</a>
                <span>/</span>
                <span class="text-slate-800">Akun Siswa</span>
            </div>
            <h1 class="text-2xl sm:text-3xl font-black text-slate-900 tracking-tight">
                {{ $siswa->user_id ? 'Perbarui Akun Login' : 'Buat Akun Login Baru' }}
            </h1>
            <p class="text-xs sm:text-sm text-slate-500 font-medium mt-0.5">
                Kredensial login portal E-Rapor untuk wali dari ananda <strong class="text-slate-800">{{ $siswa->nama }}</strong>.
            </p>
        </div>
        <a href="{{ route('admin.siswa') }}" 
           class="inline-flex items-center gap-2 px-4 py-2 bg-slate-200 hover:bg-slate-300 text-slate-800 font-bold rounded-xl text-xs sm:text-sm transition">
            <i class="fa-solid fa-arrow-left"></i>
            <span>Kembali</span>
        </a>
    </div>

    {{-- Form Card --}}
    <div class="bg-white p-6 sm:p-8 rounded-3xl border border-slate-100 shadow-sm space-y-6">
        
        <div class="flex items-center gap-3 pb-4 border-b border-slate-100">
            <div class="w-12 h-12 rounded-2xl bg-gradient-to-tr from-green-600 to-emerald-500 text-white font-bold flex items-center justify-center text-base shadow-sm">
                {{ strtoupper(substr($siswa->nama, 0, 1)) }}
            </div>
            <div>
                <h2 class="text-base font-black text-slate-900">{{ $siswa->nama }}</h2>
                <p class="text-xs text-slate-500">NIS: {{ $siswa->nis ?? '-' }} • Kelas: {{ $siswa->kelas->nama_kelas ?? '-' }}</p>
            </div>
        </div>

        <form method="POST" 
              action="{{ $siswa->user_id ? route('admin.user-create.update', $siswa->id) : route('admin.user.store') }}" 
              class="space-y-5">
            @csrf

            @if($siswa->user_id)
                @method('PUT')
            @endif

            <input type="hidden" name="siswa_id" value="{{ $siswa->id }}">
            <input type="hidden" name="role" value="siswa">

            <div>
                <label class="block text-xs font-extrabold text-slate-700 uppercase tracking-wider mb-2">
                    Nama Akun Pengguna <span class="text-red-500">*</span>
                </label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                        <i class="fa-solid fa-user text-xs"></i>
                    </div>
                    <input type="text" 
                           name="name" 
                           value="{{ old('name', $user->name ?? $siswa->nama) }}" 
                           class="w-full pl-9 pr-3.5 py-3 rounded-xl border border-slate-200 focus:border-green-600 focus:ring-2 focus:ring-green-100 outline-none text-xs sm:text-sm text-slate-800 font-semibold" 
                           required>
                </div>
            </div>

            <div>
                <label class="block text-xs font-extrabold text-slate-700 uppercase tracking-wider mb-2">
                    Alamat Email Login <span class="text-red-500">*</span>
                </label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                        <i class="fa-solid fa-envelope text-xs"></i>
                    </div>
                    <input type="email" 
                           name="email" 
                           value="{{ old('email', $user->email ?? (strtolower(str_replace(' ', '', $siswa->email ?: $siswa->nis.'@almusyafallahi.id')))) }}" 
                           class="w-full pl-9 pr-3.5 py-3 rounded-xl border border-slate-200 focus:border-green-600 focus:ring-2 focus:ring-green-100 outline-none text-xs sm:text-sm text-slate-800" 
                           required>
                </div>
            </div>

            <div>
                <label class="block text-xs font-extrabold text-slate-700 uppercase tracking-wider mb-2">
                    Kata Sandi (Password) {{ $siswa->user_id ? '(Opsional)' : '*' }}
                </label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                        <i class="fa-solid fa-lock text-xs"></i>
                    </div>
                    <input type="password" 
                           id="passwordInput"
                           name="password" 
                           value="{{ $user ? '' : ($siswa->nis ?: '123456') }}" 
                           placeholder="{{ $siswa->user_id ? 'Kosongkan jika tidak ingin mengubah password' : 'Masukkan password akun' }}" 
                           class="w-full pl-9 pr-10 py-3 rounded-xl border border-slate-200 focus:border-green-600 focus:ring-2 focus:ring-green-100 outline-none text-xs sm:text-sm text-slate-800"
                           {{ $siswa->user_id ? '' : 'required' }}>
                    <button type="button" 
                            onclick="togglePasswordVisibility()" 
                            class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-slate-400 hover:text-slate-600">
                        <i id="eyeIcon" class="fa-solid fa-eye text-xs"></i>
                    </button>
                </div>
                @if($siswa->user_id)
                <p class="text-[11px] text-slate-400 mt-1.5 flex items-center gap-1">
                    <i class="fa-solid fa-circle-info"></i> Password lama dienkripsi secara aman dan tidak dapat ditampilkan.
                </p>
                @endif
            </div>

            <div class="pt-3 flex items-center justify-end gap-3">
                <a href="{{ route('admin.siswa') }}" 
                   class="px-5 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold rounded-xl text-xs sm:text-sm transition">
                    Batal
                </a>
                <button type="submit" 
                        class="inline-flex items-center gap-2 bg-gradient-to-r from-green-600 to-emerald-700 hover:from-green-700 hover:to-emerald-800 text-white font-black px-6 py-3 rounded-xl shadow-md text-xs sm:text-sm uppercase tracking-wide transition">
                    <i class="fa-solid fa-key"></i>
                    <span>{{ $siswa->user_id ? 'Perbarui Akun' : 'Buat Akun Siswa' }}</span>
                </button>
            </div>

        </form>

    </div>

</div>

<script>
function togglePasswordVisibility() {
    const input = document.getElementById('passwordInput');
    const icon = document.getElementById('eyeIcon');
    if (input.type === 'password') {
        input.type = 'text';
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
    } else {
        input.type = 'password';
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
    }
}
</script>

@endsection