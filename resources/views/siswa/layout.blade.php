<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Siswa</title>
    @vite('resources/css/app.css')
    <style>
        /* Smooth sidebar transition */
        #siswa-sidebar {
            transition: transform 0.3s ease;
        }
        #siswa-sidebar-overlay {
            transition: opacity 0.3s ease;
        }
    </style>
</head>

<body class="bg-gray-100 font-sans m-0">

    {{-- ================= SIDEBAR OVERLAY (Mobile) ================= --}}
    <div id="siswa-sidebar-overlay"
         class="fixed inset-0 bg-black/50 z-40 hidden md:hidden"
         onclick="closeSiswaSidebar()">
    </div>

    <div class="flex min-h-screen">

        {{-- ===== SIDEBAR ===== --}}
        <aside id="siswa-sidebar"
               class="fixed md:sticky top-0 left-0 w-64 h-screen bg-gradient-to-b from-[#166534] to-[#14532d] text-white shadow-2xl flex flex-col z-50 -translate-x-full md:translate-x-0">

            {{-- Header Sidebar --}}
            <div class="p-6 border-b border-green-700 flex justify-between items-center">
                <div>
                    <h1 class="text-xl font-extrabold uppercase tracking-wide">Siswa Panel</h1>
                    <p class="text-sm opacity-80">RA Al-Musyaffallah</p>
                </div>
                <button onclick="closeSiswaSidebar()" class="md:hidden text-white">✕</button>
            </div>

            {{-- Menu --}}
            <nav class="flex-1 p-4 space-y-3 overflow-y-auto">

                <a href="{{ route('siswa.dashboard', $siswa->id) }}"
                   class="flex items-center gap-3 p-3 rounded-xl hover:bg-white hover:text-green-800 transition duration-300 {{ request()->routeIs('siswa.dashboard') ? 'bg-white text-green-800 font-bold' : 'font-semibold' }}">
                    <span class="text-xl">📊</span>
                    <span>Dashboard</span>
                </a>

                <a href="{{ route('erapor.hasil', $siswa->id) }}"
                   class="flex items-center gap-3 p-3 rounded-xl hover:bg-white hover:text-green-800 transition duration-300 {{ request()->routeIs('erapor.hasil') ? 'bg-white text-green-800 font-bold' : 'font-semibold' }}">
                    <span class="text-xl">📋</span>
                    <span>Lihat Rapor</span>
                </a>

                <a href="{{ route('erapor.cetak', $siswa->id) }}"
                   class="flex items-center gap-3 p-3 rounded-xl hover:bg-white hover:text-green-800 transition duration-300 {{ request()->routeIs('erapor.cetak') ? 'bg-white text-green-800 font-bold' : 'font-semibold' }}">
                    <span class="text-xl">🖨️</span>
                    <span>Cetak Rapor</span>
                </a>

            </nav>

            {{-- Logout (FIX DI BAWAH) --}}
            <div class="p-4 border-t border-green-700 bg-green-950/30">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="w-full bg-white text-green-800 font-bold py-2 rounded-xl hover:bg-gray-200 transition">
                        Keluar
                    </button>
                </form>
            </div>

        </aside>

        {{-- ===== MAIN WRAPPER ===== --}}
        <div id="siswa-main-wrapper" class="flex-1 flex flex-col min-w-0">

            {{-- TOP BAR (Mobile) --}}
            <header id="siswa-topbar" class="md:hidden bg-gradient-to-r from-[#166534] to-[#14532d] text-white px-4 py-3 flex items-center gap-3 sticky top-0 z-30 shadow">
                <button onclick="openSiswaSidebar()" class="text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
                <span class="font-extrabold text-lg">Siswa Panel</span>
            </header>

            {{-- MAIN CONTENT --}}
            <main class="flex-1 p-4 md:p-10 overflow-x-hidden">

                <div class="bg-white rounded-2xl shadow-md p-4 md:p-6 min-h-full relative overflow-hidden">

                    {{-- WATERMARK --}}
                    <div class="absolute inset-0 flex items-center justify-center pointer-events-none">
                        <img src="{{ asset('assets/images/1001230752.jpg - Edited.png') }}"
                             alt="logo"
                             class="w-[200px] md:w-[350px] opacity-10">
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
    function openSiswaSidebar() {
        const sidebar = document.getElementById('siswa-sidebar');
        sidebar.classList.remove('-translate-x-full');
        sidebar.classList.add('translate-x-0');
        document.getElementById('siswa-sidebar-overlay').classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }
    function closeSiswaSidebar() {
        const sidebar = document.getElementById('siswa-sidebar');
        sidebar.classList.remove('translate-x-0');
        sidebar.classList.add('-translate-x-full');
        document.getElementById('siswa-sidebar-overlay').classList.add('hidden');
        document.body.style.overflow = '';
    }
    </script>

</body>
</html>