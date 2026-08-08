@extends('layouts.admin')

@section('title', 'Manajemen Akun Pengguna - RA Al Musyaffallah')
@section('page_title', 'Manajemen Pengguna')

@section('content')

<div class="space-y-8">

    {{-- Page Header --}}
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl sm:text-3xl font-black text-slate-900 tracking-tight">
                Manajemen Akun Pengguna
            </h1>
            <p class="text-xs sm:text-sm text-slate-500 font-medium mt-1">
                Kelola hak akses pengguna sistem untuk Administrator, Tenaga Pendidik, dan Siswa/Wali Murid.
            </p>
        </div>
        <div class="flex items-center gap-2">
            <span class="px-3.5 py-1.5 bg-green-100 text-green-800 font-black rounded-xl text-xs">
                Total Akun: {{ count($users) }} Pengguna
            </span>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
        
        {{-- ================= FORM TAMBAH USER (Left 4 Cols) ================= --}}
        <div class="lg:col-span-4 bg-white p-6 sm:p-7 rounded-3xl border border-slate-100 shadow-sm space-y-6 sticky top-24">
            <div class="flex items-center gap-3 pb-4 border-b border-slate-100">
                <div class="w-10 h-10 rounded-2xl bg-emerald-100 text-emerald-700 flex items-center justify-center font-black">
                    <i class="fa-solid fa-user-shield text-base"></i>
                </div>
                <div>
                    <h2 class="text-base font-black text-slate-900">Tambah Akun Baru</h2>
                    <p class="text-[11px] text-slate-500">Buat kredensial login pengguna baru</p>
                </div>
            </div>

            <form method="POST" action="{{ route('admin.user.store') }}" class="space-y-4">
                @csrf

                <div>
                    <label class="block text-xs font-extrabold text-slate-700 uppercase tracking-wider mb-1.5">
                        Nama Lengkap Pengguna <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                            <i class="fa-solid fa-user text-xs"></i>
                        </div>
                        <input type="text" 
                               name="name" 
                               value="{{ old('name') }}"
                               placeholder="Nama lengkap"
                               class="w-full pl-9 pr-3.5 py-2.5 rounded-xl border border-slate-200 focus:border-green-600 focus:ring-2 focus:ring-green-100 outline-none text-xs sm:text-sm text-slate-800"
                               required>
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-extrabold text-slate-700 uppercase tracking-wider mb-1.5">
                        Alamat Email <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                            <i class="fa-solid fa-envelope text-xs"></i>
                        </div>
                        <input type="email" 
                               name="email" 
                               value="{{ old('email') }}"
                               placeholder="nama@email.com"
                               class="w-full pl-9 pr-3.5 py-2.5 rounded-xl border border-slate-200 focus:border-green-600 focus:ring-2 focus:ring-green-100 outline-none text-xs sm:text-sm text-slate-800"
                               required>
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-extrabold text-slate-700 uppercase tracking-wider mb-1.5">
                        Kata Sandi <span class="text-red-500">*</span>
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

                <div>
                    <label class="block text-xs font-extrabold text-slate-700 uppercase tracking-wider mb-1.5">
                        Peran / Hak Akses (Role) <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                            <i class="fa-solid fa-id-badge text-xs"></i>
                        </div>
                        <select name="role" 
                                class="w-full pl-9 pr-3.5 py-2.5 rounded-xl border border-slate-200 focus:border-green-600 focus:ring-2 focus:ring-green-100 outline-none text-xs sm:text-sm text-slate-800 font-medium"
                                required>
                            <option value="admin">Administrator (Super Admin)</option>
                            <option value="guru">Guru (Ustadzah)</option>
                            <option value="siswa">Siswa / Wali Murid</option>
                        </select>
                    </div>
                </div>

                <button type="submit" 
                        class="w-full inline-flex items-center justify-center gap-2 bg-gradient-to-r from-green-600 to-emerald-700 hover:from-green-700 hover:to-emerald-800 text-white font-black py-3 px-4 rounded-xl shadow-md transition duration-200 text-xs sm:text-sm uppercase tracking-wide mt-2">
                    <i class="fa-solid fa-user-plus"></i>
                    <span>Buat Akun Pengguna</span>
                </button>
            </form>
        </div>

        {{-- ================= DAFTAR USER TABLE (Right 8 Cols) ================= --}}
        <div class="lg:col-span-8 bg-white p-6 sm:p-7 rounded-3xl border border-slate-100 shadow-sm space-y-5">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                <div>
                    <h3 class="text-base font-black text-slate-900">Daftar Seluruh Pengguna</h3>
                    <p class="text-xs text-slate-500">Semua akun yang terdaftar dalam basis data sistem.</p>
                </div>
                
                {{-- Search filter --}}
                <div class="relative">
                    <i class="fa-solid fa-magnifying-glass absolute left-3 top-2.5 text-slate-400 text-xs"></i>
                    <input type="text" 
                           id="searchUser" 
                           onkeyup="filterUserTable()" 
                           placeholder="Cari user..." 
                           class="pl-8 pr-3.5 py-2 text-xs rounded-xl border border-slate-200 focus:border-green-600 outline-none w-48">
                </div>
            </div>

            <div class="overflow-x-auto">
                <table id="userTable" class="w-full text-left text-xs">
                    <thead>
                        <tr class="bg-slate-50 text-slate-500 font-extrabold uppercase tracking-wider border-y border-slate-100">
                            <th class="py-3.5 px-4 rounded-l-xl text-center w-12">No</th>
                            <th class="py-3.5 px-4">Nama Pengguna</th>
                            <th class="py-3.5 px-4">Email</th>
                            <th class="py-3.5 px-4 text-center rounded-r-xl">Peran (Role)</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 font-medium text-slate-700">
                        @forelse($users as $i => $u)
                        <tr class="hover:bg-slate-50/80 transition">
                            <td class="py-3.5 px-4 text-center text-slate-400 font-bold">
                                {{ $i + 1 }}
                            </td>
                            <td class="py-3.5 px-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-xl bg-gradient-to-tr {{ $u->role === 'admin' ? 'from-purple-600 to-indigo-500' : ($u->role === 'guru' ? 'from-blue-600 to-cyan-500' : 'from-green-600 to-emerald-500') }} text-white font-bold flex items-center justify-center text-xs shadow-xs">
                                        {{ strtoupper(substr($u->name, 0, 1)) }}
                                    </div>
                                    <span class="font-bold text-slate-900 text-xs sm:text-sm">{{ $u->name }}</span>
                                </div>
                            </td>
                            <td class="py-3.5 px-4 text-slate-600">
                                {{ $u->email }}
                            </td>
                            <td class="py-3.5 px-4 text-center">
                                @if($u->role === 'admin')
                                    <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-[10px] font-extrabold bg-purple-100 text-purple-800 border border-purple-200 uppercase tracking-wider">
                                        <i class="fa-solid fa-shield-halved"></i> Admin
                                    </span>
                                @elseif($u->role === 'guru')
                                    <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-[10px] font-extrabold bg-blue-100 text-blue-800 border border-blue-200 uppercase tracking-wider">
                                        <i class="fa-solid fa-chalkboard-user"></i> Guru
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-[10px] font-extrabold bg-green-100 text-green-800 border border-green-200 uppercase tracking-wider">
                                        <i class="fa-solid fa-user-graduate"></i> Siswa
                                    </span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="py-8 text-center text-slate-400 font-semibold">
                                Belum ada data pengguna.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>

</div>

<script>
function filterUserTable() {
    const input = document.getElementById("searchUser");
    const filter = input.value.toLowerCase();
    const table = document.getElementById("userTable");
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
