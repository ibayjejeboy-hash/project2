<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Rapor Guru - RA Al Musyaffallah</title>
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        /* Smooth sidebar transition */
        #erapor-sidebar {
            transition: transform 0.3s ease;
        }
        #erapor-sidebar-overlay {
            transition: opacity 0.3s ease;
        }
    </style>
</head>

<body class="bg-slate-100/90 text-slate-800 font-sans antialiased overflow-x-hidden">

    {{-- ================= SIDEBAR OVERLAY (Mobile) ================= --}}
    <div id="erapor-sidebar-overlay"
         class="fixed inset-0 bg-black/50 backdrop-blur-sm z-40 hidden md:hidden"
         onclick="closeEraporSidebar()">
    </div>

    <div class="flex min-h-screen">

        {{-- SIDEBAR --}}
        <aside id="erapor-sidebar"
               class="fixed md:sticky top-0 left-0 w-64 h-screen bg-gradient-to-b from-[#14532d] via-[#166534] to-[#0f3a22] text-white shadow-2xl flex flex-col z-50 -translate-x-full md:translate-x-0 transition-transform duration-300">

            {{-- HEADER BRANDING --}}
            <div class="p-5 border-b border-green-700/50 flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <img src="{{ asset('assets/images/1001230752.jpg - Edited.png') }}"
                         alt="Logo RA"
                         class="w-9 h-9 object-contain bg-white/10 p-1 rounded-xl ring-1 ring-white/20">
                    <div>
                        <h1 class="text-sm font-black uppercase tracking-wider text-green-100 leading-tight">E-Rapor Guru</h1>
                        <p class="text-[11px] text-green-300 font-medium">RA Al-Musyaffallah</p>
                    </div>
                </div>
                <button onclick="closeEraporSidebar()" class="md:hidden text-white/70 hover:text-white p-1">
                    <i class="fa-solid fa-xmark text-lg"></i>
                </button>
            </div>

            {{-- USER PROFILE MINI CARD --}}
            <div class="p-4 mx-4 my-3 bg-white/10 rounded-xl border border-white/15 flex items-center gap-3">
                <div class="w-9 h-9 rounded-lg bg-green-500/30 text-green-200 flex items-center justify-center font-black text-sm">
                    <i class="fa-solid fa-chalkboard-user"></i>
                </div>
                <div class="flex-1 min-w-0">
                    <div class="text-xs font-bold text-white truncate">{{ auth()->user()->name ?? 'Ustadzah / Guru' }}</div>
                    <div class="text-[10px] text-green-300 font-medium flex items-center gap-1">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse"></span>
                        <span class="capitalize">{{ auth()->user()->role ?? 'Guru' }}</span>
                    </div>
                </div>
            </div>

            {{-- MENU NAVIGATION --}}
            <nav class="flex-1 px-4 py-2 space-y-1.5 overflow-y-auto">

                <div class="px-2 pb-1 text-[10px] font-bold uppercase tracking-wider text-green-300/80">Menu Utama</div>

                <a href="{{ route('erapor.dashboard') }}"
                   class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl transition duration-200 {{ request()->routeIs('erapor.dashboard') ? 'bg-white text-green-950 font-bold shadow-md shadow-black/10' : 'text-green-100 hover:bg-white/10 font-semibold text-xs' }}">
                    <i class="fa-solid fa-chart-pie w-5 text-center text-sm"></i>
                    <span class="text-xs sm:text-sm">Dashboard Rapor</span>
                </a>

                <a href="{{ route('erapor.input') }}"
                   class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl transition duration-200 {{ request()->routeIs('erapor.input') ? 'bg-white text-green-950 font-bold shadow-md shadow-black/10' : 'text-green-100 hover:bg-white/10 font-semibold text-xs' }}">
                    <i class="fa-solid fa-pen-to-square w-5 text-center text-sm"></i>
                    <span class="text-xs sm:text-sm">Input &amp; Nilai Rapor</span>
                </a>

                @if(auth()->user()->role === 'admin')
                <div class="pt-3 px-2 pb-1 text-[10px] font-bold uppercase tracking-wider text-green-300/80">Akses Admin</div>
                <a href="{{ route('admin.dashboard') }}"
                   class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-green-100 hover:bg-white/10 font-semibold text-xs transition duration-200">
                    <i class="fa-solid fa-shield-halved w-5 text-center text-sm"></i>
                    <span class="text-xs sm:text-sm">Kembali ke Admin Panel</span>
                </a>
                @endif

                <div class="pt-3 px-2 pb-1 text-[10px] font-bold uppercase tracking-wider text-green-300/80">Pusat Bantuan</div>
                <button onclick="openPanduanModal('erapor')"
                        type="button"
                        class="w-full flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-green-100 hover:bg-white/10 font-semibold text-xs transition duration-200 text-left border border-white/10 bg-white/5">
                    <i class="fa-solid fa-circle-question w-5 text-center text-sm text-lime-300"></i>
                    <span class="text-xs sm:text-sm">Panduan E-Rapor</span>
                    <span class="ml-auto text-[9px] font-extrabold bg-lime-400/20 text-lime-300 px-1.5 py-0.5 rounded">FAQ</span>
                </button>

            </nav>

            {{-- LOGOUT --}}
            <div class="p-4 border-t border-green-700/50 bg-green-950/30">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="w-full bg-white/15 hover:bg-red-600 text-white font-bold py-2.5 px-4 rounded-xl transition flex items-center justify-center gap-2 text-xs">
                        <i class="fa-solid fa-arrow-right-from-bracket"></i>
                        <span>Keluar Akun</span>
                    </button>
                </form>
            </div>

        </aside>

        {{-- CONTENT WRAPPER --}}
        <div class="flex-1 flex flex-col min-w-0">

            {{-- TOP BAR (Mobile) --}}
            <header class="md:hidden bg-gradient-to-r from-[#14532d] to-[#166534] text-white px-4 py-3 flex items-center justify-between sticky top-0 z-30 shadow-md">
                <div class="flex items-center gap-2.5">
                    <button onclick="openEraporSidebar()" class="text-white p-1 hover:bg-white/10 rounded-lg">
                        <i class="fa-solid fa-bars text-xl"></i>
                    </button>
                    <span class="font-extrabold text-sm uppercase tracking-wider">E-Rapor Guru</span>
                </div>
                <div class="flex items-center gap-2">
                    <button onclick="openPanduanModal('erapor')" 
                            type="button"
                            class="px-2.5 py-1 bg-white/20 hover:bg-white/30 text-lime-200 text-xs font-bold rounded-lg flex items-center gap-1.5">
                        <i class="fa-solid fa-circle-question"></i>
                        <span>Panduan</span>
                    </button>
                </div>
            </header>

            {{-- MAIN CONTENT --}}
            <main class="flex-1 p-4 md:p-8 overflow-x-hidden">

                <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-4 md:p-6 min-h-full relative overflow-hidden">

                    {{-- WATERMARK --}}
                    <div class="absolute inset-0 flex items-center justify-center pointer-events-none select-none">
                        <img src="{{ asset('assets/images/1001230752.jpg - Edited.png') }}"
                             alt="logo watermark"
                             class="w-[200px] md:w-[350px] opacity-[0.04]">
                    </div>

                    {{-- CONTENT --}}
                    <div class="relative z-10">
                        @yield('content')
                    </div>

                </div>

            </main>

        </div>

    </div>

    <script>
    function openEraporSidebar() {
        const sidebar = document.getElementById('erapor-sidebar');
        sidebar.classList.remove('-translate-x-full');
        sidebar.classList.add('translate-x-0');
        document.getElementById('erapor-sidebar-overlay').classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }
    function closeEraporSidebar() {
        const sidebar = document.getElementById('erapor-sidebar');
        sidebar.classList.remove('translate-x-0');
        sidebar.classList.add('-translate-x-full');
        document.getElementById('erapor-sidebar-overlay').classList.add('hidden');
        document.body.style.overflow = '';
    }
    </script>

    {{-- Modal Pusat Panduan & Bantuan --}}
    @include('components.panduan-modal')

    @stack('modals')
    @stack('scripts')
</body>
</html>