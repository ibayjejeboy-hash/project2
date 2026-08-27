<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel - RA Al Musyaffallah')</title>
    
    {{-- Favicon --}}
    <link rel="icon" type="image/png" href="{{ asset('assets/images/1001230752.jpg - Edited.png') }}">

    {{-- Tailwind CSS CDN --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            50: '#f0fdf4',
                            100: '#dcfce7',
                            200: '#bbf7d0',
                            300: '#86efac',
                            400: '#4ade80',
                            500: '#22c55e',
                            600: '#16a34a',
                            700: '#15803d',
                            800: '#166534',
                            900: '#14532d',
                            950: '#052e16',
                        }
                    },
                    fontFamily: {
                        sans: ['Plus Jakarta Sans', 'Poppins', 'sans-serif'],
                    }
                }
            }
        }
    </script>

    {{-- Google Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Poppins:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

    {{-- Font Awesome 6 Icons --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        /* Custom scrollbar */
        ::-webkit-scrollbar { width: 6px; height: 6px; }
        ::-webkit-scrollbar-track { background: #0f172a; }
        ::-webkit-scrollbar-thumb { background: #1e293b; border-radius: 4px; }
        ::-webkit-scrollbar-thumb:hover { background: #334155; }
    </style>
    @stack('styles')
</head>
<body class="bg-slate-100 text-slate-800 antialiased selection:bg-green-600 selection:text-white flex min-h-screen">

    {{-- ================= SIDEBAR OVERLAY (Mobile) ================= --}}
    <div id="sidebar-overlay"
         class="fixed inset-0 bg-slate-950/70 backdrop-blur-sm z-40 hidden md:hidden transition-opacity duration-300"
         onclick="closeSidebar()">
    </div>

    {{-- ================= SIDEBAR ================= --}}
    <aside id="sidebar"
           class="fixed md:sticky top-0 left-0 w-72 h-screen bg-slate-900 text-slate-300 shadow-2xl flex flex-col z-50 transition-transform duration-300 -translate-x-full md:translate-x-0 border-r border-slate-800">

        {{-- Brand Header --}}
        <div class="p-5 border-b border-slate-800/80 flex items-center justify-between bg-slate-950/50">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 group">
                <img src="{{ asset('assets/images/1001230752.jpg - Edited.png') }}" 
                     alt="Logo RA" 
                     class="w-10 h-10 object-contain bg-white/10 p-1 rounded-xl group-hover:scale-105 transition-transform duration-300 shadow-md">
                <div>
                    <h1 class="font-black text-white text-base tracking-wider leading-none">AL MUSYAFFALLAH</h1>
                    <div class="flex items-center gap-1.5 mt-1">
                        <span class="text-[10px] font-extrabold bg-green-950 text-lime-400 border border-green-700/50 px-1.5 py-0.5 rounded uppercase tracking-wider">
                            ADMIN PANEL
                        </span>
                    </div>
                </div>
            </a>
            <button onclick="closeSidebar()" class="md:hidden text-slate-400 hover:text-white p-1 rounded-lg hover:bg-slate-800">
                <i class="fa-solid fa-xmark text-lg"></i>
            </button>
        </div>

        {{-- Admin User Profile Snippet --}}
        <div class="p-4 mx-3 my-3 bg-slate-800/60 rounded-2xl border border-slate-700/60 flex items-center gap-3">
            <div class="relative">
                <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-green-600 to-emerald-400 text-white font-black flex items-center justify-center text-sm shadow-md">
                    {{ strtoupper(substr(Auth::user()->name ?? 'A', 0, 1)) }}
                </div>
                <span class="absolute -bottom-0.5 -right-0.5 w-3 h-3 bg-lime-500 border-2 border-slate-900 rounded-full"></span>
            </div>
            <div class="overflow-hidden">
                <span class="block text-xs font-bold text-white truncate">{{ Auth::user()->name ?? 'Administrator' }}</span>
                <span class="block text-[11px] text-lime-400 font-semibold uppercase tracking-wider">Online • Super Admin</span>
            </div>
        </div>

        {{-- Menu Links (Scrollable) --}}
        <div class="flex-1 overflow-y-auto px-3 py-2 space-y-1.5">
            
            <div class="px-3 pt-2 pb-1 text-[11px] font-extrabold text-slate-400 uppercase tracking-widest">
                Menu Utama
            </div>

            {{-- 1. Dashboard --}}
            <a href="{{ route('admin.dashboard') }}"
               class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-xs sm:text-sm font-bold transition-all duration-200 group {{ request()->routeIs('admin.dashboard') ? 'bg-gradient-to-r from-green-600 to-emerald-700 text-white shadow-md shadow-green-900/30' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                <i class="fa-solid fa-house-chimney w-5 text-center {{ request()->routeIs('admin.dashboard') ? 'text-lime-300' : 'text-slate-400 group-hover:text-lime-400' }}"></i>
                <span>Dashboard</span>
            </a>

            {{-- 2. Data Siswa --}}
            <a href="{{ route('admin.siswa') }}"
               class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-xs sm:text-sm font-bold transition-all duration-200 group {{ request()->routeIs('admin.siswa*') ? 'bg-gradient-to-r from-green-600 to-emerald-700 text-white shadow-md shadow-green-900/30' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                <i class="fa-solid fa-user-graduate w-5 text-center {{ request()->routeIs('admin.siswa*') ? 'text-lime-300' : 'text-slate-400 group-hover:text-lime-400' }}"></i>
                <span>Data Siswa</span>
            </a>

            {{-- 3. Data Guru --}}
            <a href="{{ route('admin.guru') }}"
               class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-xs sm:text-sm font-bold transition-all duration-200 group {{ request()->routeIs('admin.guru*') ? 'bg-gradient-to-r from-green-600 to-emerald-700 text-white shadow-md shadow-green-900/30' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                <i class="fa-solid fa-chalkboard-user w-5 text-center {{ request()->routeIs('admin.guru*') ? 'text-lime-300' : 'text-slate-400 group-hover:text-lime-400' }}"></i>
                <span>Data Guru (Ustadzah)</span>
            </a>

            {{-- 4. Rombel Kelas & Wali --}}
            <a href="{{ route('admin.kelas') }}"
               class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-xs sm:text-sm font-bold transition-all duration-200 group {{ request()->routeIs('admin.kelas*') ? 'bg-gradient-to-r from-green-600 to-emerald-700 text-white shadow-md shadow-green-900/30' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                <i class="fa-solid fa-school w-5 text-center {{ request()->routeIs('admin.kelas*') ? 'text-lime-300' : 'text-slate-400 group-hover:text-lime-400' }}"></i>
                <span>Rombel Kelas & Wali</span>
            </a>

            {{-- 5. E-Rapor & Penilaian Digital --}}
            <a href="{{ route('erapor.dashboard') }}"
               class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-xs sm:text-sm font-bold transition-all duration-200 group {{ request()->routeIs('erapor*') ? 'bg-gradient-to-r from-green-600 to-emerald-700 text-white shadow-md shadow-green-900/30' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                <i class="fa-solid fa-graduation-cap w-5 text-center {{ request()->routeIs('erapor*') ? 'text-lime-300' : 'text-slate-400 group-hover:text-lime-400' }}"></i>
                <span>E-Rapor & Penilaian</span>
            </a>

            <div class="px-3 pt-4 pb-1 text-[11px] font-extrabold text-slate-400 uppercase tracking-widest">
                Informasi & PPDB
            </div>

            {{-- 4. Pendaftaran (PPDB) --}}
            <a href="{{ route('admin.pendaftaran') }}"
               class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-xs sm:text-sm font-bold transition-all duration-200 group {{ request()->routeIs('admin.pendaftaran*') ? 'bg-gradient-to-r from-green-600 to-emerald-700 text-white shadow-md shadow-green-900/30' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                <i class="fa-solid fa-file-signature w-5 text-center {{ request()->routeIs('admin.pendaftaran*') ? 'text-lime-300' : 'text-slate-400 group-hover:text-lime-400' }}"></i>
                <span>Pendaftaran PPDB</span>
            </a>

            {{-- 5. Galeri --}}
            <a href="{{ route('admin.galeri') }}"
               class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-xs sm:text-sm font-bold transition-all duration-200 group {{ request()->routeIs('admin.galeri*') ? 'bg-gradient-to-r from-green-600 to-emerald-700 text-white shadow-md shadow-green-900/30' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                <i class="fa-solid fa-images w-5 text-center {{ request()->routeIs('admin.galeri*') ? 'text-lime-300' : 'text-slate-400 group-hover:text-lime-400' }}"></i>
                <span>Galeri Aktivitas</span>
            </a>

            {{-- 6. Informasi Sekolah (Visi Misi) --}}
            <a href="{{ route('admin.informasi') }}"
               class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-xs sm:text-sm font-bold transition-all duration-200 group {{ request()->routeIs('admin.informasi*') ? 'bg-gradient-to-r from-green-600 to-emerald-700 text-white shadow-md shadow-green-900/30' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                <i class="fa-solid fa-bullhorn w-5 text-center {{ request()->routeIs('admin.informasi*') ? 'text-lime-300' : 'text-slate-400 group-hover:text-lime-400' }}"></i>
                <span>Visi, Misi & Info</span>
            </a>

            {{-- 7. Kelola Pengguna Akun --}}
            <a href="{{ route('admin.user') }}"
               class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-xs sm:text-sm font-bold transition-all duration-200 group {{ request()->routeIs('admin.user*') ? 'bg-gradient-to-r from-green-600 to-emerald-700 text-white shadow-md shadow-green-900/30' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                <i class="fa-solid fa-users-gear w-5 text-center {{ request()->routeIs('admin.user*') ? 'text-lime-300' : 'text-slate-400 group-hover:text-lime-400' }}"></i>
                <span>Manajemen Akun</span>
            </a>

            {{-- 8. Pengaturan Dinamis Website --}}
            <a href="{{ route('admin.pengaturan') }}"
               class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-xs sm:text-sm font-bold transition-all duration-200 group {{ request()->routeIs('admin.pengaturan*') ? 'bg-gradient-to-r from-green-600 to-emerald-700 text-white shadow-md shadow-green-900/30' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                <i class="fa-solid fa-sliders w-5 text-center {{ request()->routeIs('admin.pengaturan*') ? 'text-lime-300' : 'text-slate-400 group-hover:text-lime-400' }}"></i>
                <span>Pengaturan Website</span>
            </a>

            <div class="px-3 pt-4 pb-1 text-[11px] font-extrabold text-slate-400 uppercase tracking-widest">
                Pusat Bantuan
            </div>

            {{-- 8. Panduan & Bantuan --}}
            <button onclick="openPanduanModal()" 
                    type="button"
                    class="w-full flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-xs sm:text-sm font-bold text-slate-300 hover:bg-emerald-950/60 hover:text-lime-300 border border-emerald-500/20 bg-slate-800/40 transition-all duration-200 group text-left">
                <i class="fa-solid fa-circle-question w-5 text-center text-lime-400 group-hover:scale-110 transition-transform"></i>
                <span>Panduan &amp; Bantuan</span>
                <span class="ml-auto text-[10px] font-extrabold bg-lime-400/20 text-lime-300 px-1.5 py-0.5 rounded">FAQ</span>
            </button>

        </div>

        {{-- Bottom Action: Back to Web & Logout --}}
        <div class="p-3 border-t border-slate-800 bg-slate-950/60 space-y-2">
            <a href="{{ route('home') }}" 
               target="_blank"
               class="w-full flex items-center justify-center gap-2 px-3 py-2 bg-slate-800 hover:bg-slate-700 text-slate-300 hover:text-white rounded-xl text-xs font-bold transition duration-200">
                <i class="fa-solid fa-arrow-up-right-from-square text-lime-400"></i>
                <span>Lihat Website Utama</span>
            </a>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" 
                        class="w-full flex items-center justify-center gap-2 bg-red-500/15 hover:bg-red-600 text-red-300 hover:text-white font-bold py-2 px-3 rounded-xl border border-red-500/30 hover:border-red-600 transition-all duration-200 text-xs">
                    <i class="fa-solid fa-right-from-bracket"></i>
                    <span>Keluar (Logout)</span>
                </button>
            </form>
        </div>

    </aside>


    {{-- ================= MAIN CONTENT WRAPPER ================= --}}
    <div class="flex-1 flex flex-col min-w-0 bg-slate-100 min-h-screen">

        {{-- ================= TOP BAR HEADER ================= --}}
        <header class="bg-white border-b border-slate-200/80 sticky top-0 z-30 shadow-xs px-4 sm:px-6 lg:px-8 py-3.5 flex items-center justify-between gap-4">
            
            {{-- Left: Mobile Toggle & Page Identifier --}}
            <div class="flex items-center gap-3">
                <button onclick="openSidebar()" 
                        class="md:hidden text-slate-600 hover:text-slate-900 p-2 rounded-xl hover:bg-slate-100 transition">
                    <i class="fa-solid fa-bars text-lg"></i>
                </button>

                <div class="hidden sm:block">
                    <div class="flex items-center gap-2 text-xs text-slate-500 font-semibold">
                        <span class="text-green-700 font-bold">Admin Portal</span>
                        <span>/</span>
                        <span class="text-slate-800 font-extrabold">@yield('page_title', 'Dashboard')</span>
                    </div>
                </div>
            </div>

            {{-- Right: System Status Badges & Quick Links --}}
            <div class="flex items-center gap-3">
                
                {{-- Panduan & Bantuan Header Button --}}
                <button type="button" 
                        onclick="openPanduanModal()" 
                        class="inline-flex items-center gap-2 px-3.5 py-1.5 bg-gradient-to-r from-emerald-600 to-green-600 hover:from-emerald-500 hover:to-green-500 text-white font-extrabold rounded-xl text-xs shadow-sm hover:shadow transition duration-200 cursor-pointer">
                    <i class="fa-solid fa-circle-question text-lime-300"></i>
                    <span class="hidden sm:inline">Panduan &amp; Bantuan</span>
                </button>

                {{-- Semester Badge --}}
                <div class="hidden lg:flex items-center gap-2 px-3 py-1.5 bg-green-50 border border-green-200 text-green-800 rounded-xl text-xs font-bold shadow-xs">
                    <span class="w-2 h-2 rounded-full bg-green-500 animate-pulse"></span>
                    <span>T.A. 2025/2026 Genap</span>
                </div>

                {{-- Live View Link Button --}}
                <a href="{{ route('home') }}" 
                   target="_blank"
                   class="hidden sm:inline-flex items-center gap-1.5 px-3.5 py-1.5 bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold rounded-xl text-xs transition">
                    <i class="fa-solid fa-globe text-green-600"></i>
                    <span>Live Web</span>
                </a>

                {{-- Profile Pill --}}
                <div class="flex items-center gap-2.5 pl-2 sm:border-l sm:border-slate-200">
                    <div class="w-8 h-8 rounded-xl bg-gradient-to-tr from-green-600 to-emerald-500 text-white flex items-center justify-center font-black text-xs shadow-sm">
                        {{ strtoupper(substr(Auth::user()->name ?? 'A', 0, 1)) }}
                    </div>
                    <span class="hidden md:block text-xs font-bold text-slate-700">{{ Auth::user()->name ?? 'Admin' }}</span>
                </div>

            </div>

        </header>

        {{-- ================= PAGE CONTENT ================= --}}
        <main class="flex-1 p-4 sm:p-6 lg:p-8 max-w-7xl mx-auto w-full">

            {{-- Flash Alert Messages --}}
            @if(session('success'))
                <div id="flash-alert-success" 
                     class="mb-6 p-4 bg-emerald-50 border-l-4 border-emerald-500 rounded-2xl shadow-sm flex items-start justify-between gap-3 text-emerald-900 text-xs sm:text-sm">
                    <div class="flex items-start gap-2.5">
                        <i class="fa-solid fa-circle-check text-emerald-600 text-lg mt-0.5"></i>
                        <div>
                            <strong class="font-bold">Sukses!</strong>
                            <p class="mt-0.5 text-emerald-800 font-medium">{{ session('success') }}</p>
                        </div>
                    </div>
                    <button onclick="document.getElementById('flash-alert-success').remove()" class="text-emerald-600 hover:text-emerald-800">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>
            @endif

            @if(session('error'))
                <div id="flash-alert-error" 
                     class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 rounded-2xl shadow-sm flex items-start justify-between gap-3 text-red-900 text-xs sm:text-sm">
                    <div class="flex items-start gap-2.5">
                        <i class="fa-solid fa-circle-exclamation text-red-600 text-lg mt-0.5"></i>
                        <div>
                            <strong class="font-bold">Terjadi Kesalahan!</strong>
                            <p class="mt-0.5 text-red-800 font-medium">{{ session('error') }}</p>
                        </div>
                    </div>
                    <button onclick="document.getElementById('flash-alert-error').remove()" class="text-red-600 hover:text-red-800">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>
            @endif

            @if ($errors->any())
                <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 rounded-2xl shadow-sm text-red-900 text-xs sm:text-sm">
                    <div class="flex items-center gap-2 font-bold mb-1 text-red-800">
                        <i class="fa-solid fa-triangle-exclamation"></i>
                        <span>Mohon periksa kesalahan input berikut:</span>
                    </div>
                    <ul class="list-disc ml-5 space-y-1 text-red-700">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @yield('content')

        </main>

    </div>

    {{-- Script Sidebar Toggle --}}
    <script>
        function openSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebar-overlay');
            if (sidebar && overlay) {
                sidebar.classList.remove('-translate-x-full');
                sidebar.classList.add('translate-x-0');
                overlay.classList.remove('hidden');
                document.body.style.overflow = 'hidden';
            }
        }
        function closeSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebar-overlay');
            if (sidebar && overlay) {
                sidebar.classList.remove('translate-x-0');
                sidebar.classList.add('-translate-x-full');
                overlay.classList.add('hidden');
                document.body.style.overflow = '';
            }
        }
    </script>

    {{-- Modal Pusat Panduan & Bantuan --}}
    @include('components.panduan-modal')

    @stack('scripts')
</body>
</html>