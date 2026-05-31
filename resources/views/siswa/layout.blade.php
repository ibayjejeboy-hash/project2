<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Siswa</title>
    @vite('resources/css/app.css')
    <style>
        #siswa-sidebar { transition: transform 0.3s ease; }
    </style>
</head>

<body class="bg-gray-100 text-black">

    {{-- OVERLAY (Mobile) --}}
    <div id="siswa-overlay"
         class="fixed inset-0 bg-black/50 z-40 hidden md:hidden"
         onclick="closeSiswaSidebar()">
    </div>

    {{-- SIDEBAR --}}
    <aside id="siswa-sidebar"
           class="fixed top-0 left-0 w-64 h-screen bg-[#228b22] text-white shadow-lg flex flex-col z-50
                  -translate-x-full md:translate-x-0">

        {{-- TITLE --}}
        <div class="p-6 text-center font-bold text-xl border-b border-green-700 flex items-center justify-between">
            <span>SISWA PANEL</span>
            <button onclick="closeSiswaSidebar()" class="md:hidden text-white ml-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

        {{-- MENU --}}
        <nav class="flex-1 p-4 space-y-2 overflow-y-auto">

            <a href="{{ route('siswa.dashboard', $siswa->id) }}"
               class="block px-4 py-2 rounded-lg hover:bg-green-700 transition font-medium">
                Dashboard
            </a>

            <a href="{{ route('erapor.hasil', $siswa->id) }}"
               class="block px-4 py-2 rounded-lg hover:bg-green-700 transition font-medium">
                Lihat Rapor
            </a>

            <a href="{{ route('erapor.cetak', $siswa->id) }}"
               class="block px-4 py-2 rounded-lg hover:bg-green-700 transition font-medium">
                Cetak Rapor
            </a>

        </nav>

        {{-- LOGOUT --}}
        <div class="p-4 border-t border-green-700">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="w-full bg-white text-[#228b22] font-semibold py-2 rounded-lg hover:bg-gray-200 transition">
                    Logout
                </button>
            </form>
        </div>

    </aside>

    {{-- WRAPPER CONTENT --}}
    <div class="flex flex-col md:ml-64 min-h-screen">

        {{-- TOP BAR (Mobile Only) --}}
        <header class="md:hidden bg-[#228b22] text-white px-4 py-3 flex items-center gap-3 sticky top-0 z-30 shadow">
            <button onclick="openSiswaSidebar()" class="text-white">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>
            <span class="font-bold text-lg">Siswa Panel</span>
        </header>

        {{-- MAIN CONTENT --}}
        <main class="flex-1 p-4 md:p-8 overflow-x-hidden">

            <div class="bg-white rounded-2xl shadow-md p-4 md:p-6 min-h-full relative overflow-hidden">

                {{-- WATERMARK --}}
                <div class="absolute inset-0 flex items-center justify-center pointer-events-none">
                    <img src="{{ asset('assets/images/1001230752.jpg - Edited.png') }}"
                         alt="logo"
                         class="w-48 md:w-[400px] opacity-10">
                </div>

                {{-- CONTENT --}}
                <div class="relative z-10">
                    @yield('content')
                </div>

            </div>

        </main>

    </div>

    <script>
    function openSiswaSidebar() {
        document.getElementById('siswa-sidebar').style.transform = 'translateX(0)';
        document.getElementById('siswa-overlay').classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }
    function closeSiswaSidebar() {
        document.getElementById('siswa-sidebar').style.transform = 'translateX(-100%)';
        document.getElementById('siswa-overlay').classList.add('hidden');
        document.body.style.overflow = '';
    }
    </script>

</body>
</html>