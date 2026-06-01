<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    @vite('resources/css/app.css')
    <style>
        /* Smooth sidebar transition */
        #sidebar {
            transition: transform 0.3s ease;
        }
        #sidebar-overlay {
            transition: opacity 0.3s ease;
        }
    </style>
</head>
<body class="bg-gray-100">

{{-- ================= SIDEBAR OVERLAY (Mobile) ================= --}}
<div id="sidebar-overlay"
     class="fixed inset-0 bg-black/50 z-40 hidden md:hidden"
     onclick="closeSidebar()">
</div>

<div class="flex min-h-screen">

    {{-- ================= SIDEBAR ================= --}}
    <aside id="sidebar"
    class="fixed md:sticky top-0 left-0 w-64 h-screen bg-gradient-to-b from-lime-400 to-green-600
    text-white shadow-2xl flex flex-col z-50
    -translate-x-full md:translate-x-0">

    {{-- HEADER --}}
    <div class="p-6 border-b border-green-300 flex justify-between items-center">
        <div>
            <h1 class="text-xl font-extrabold">ADMIN PANEL</h1>
            <p class="text-sm opacity-80">RA Al - Musyaffallah</p>
        </div>
        <button onclick="closeSidebar()" class="md:hidden">✕</button>
    </div>

    {{-- MENU (SCROLLABLE) --}}
    <div class="flex-1 overflow-y-auto px-4 py-4">
        <nav class="space-y-3">

            {{-- Dashboard --}}
            <a href="{{ route('admin.dashboard') }}"
               class="flex items-center gap-3 p-3 rounded-xl hover:bg-white hover:text-green-600 transition duration-300 group">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3" />
                </svg>
                <span class="font-semibold">Dashboard</span>
            </a>

            {{-- Galeri --}}
            <a href="{{ route('admin.galeri') }}"
               class="flex items-center gap-3 p-3 rounded-xl hover:bg-white hover:text-green-600 transition duration-300 group">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M4 16l4-4a3 3 0 014 0l4 4m-6-6l2-2a3 3 0 014 0l4 4" />
                </svg>
                <span class="font-semibold">Galeri</span>
            </a>

            {{-- Pendaftaran --}}
            <a href="#"
               class="flex items-center gap-3 p-3 rounded-xl hover:bg-white hover:text-green-600 transition duration-300 group">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M12 14l6.16-3.422A12.083 12.083 0 0121 20.055L12 23 3 20.055a12.083 12.083 0 012.84-9.477L12 14z" />
                </svg>
                <span class="font-semibold">Pendaftaran</span>
            </a>

            {{-- Informasi --}}
            <a href="{{ route('admin.informasi') }}"
               class="flex items-center gap-3 p-3 rounded-xl hover:bg-white hover:text-green-600 transition duration-300 group">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M12 6v6m0 0v6" />
                </svg>
                <span class="font-semibold">Informasi</span>
            </a>

            {{-- Data Siswa --}}
            <a href="{{ route('admin.siswa') }}"
               class="flex items-center gap-3 p-3 rounded-xl hover:bg-white hover:text-green-600 transition duration-300 group">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 flex-shrink-0" fill="none" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M5.121 17.804A10.978 10.978 0 0112 15c2.21 0 4.268.64 6 1.743M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
                <span class="font-semibold">Data Siswa</span>
            </a>

            {{-- Data Guru --}}
            <a href="{{ route('admin.guru') }}"
               class="flex items-center gap-3 p-3 rounded-xl hover:bg-white hover:text-green-600 transition duration-300 group">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 flex-shrink-0" fill="none" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
                <span class="font-semibold">Data Guru</span>
            </a>

        </nav>

         {{-- LOGOUT (FIX DI BAWAH) --}}
    <div class="p-4 border-t border-green-300 bg-green-600/30">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="w-full bg-white text-green-600 font-bold py-2 rounded-xl hover:bg-gray-200 transition">
                Logout
            </button>
        </form>
    </div>

    </aside>

    {{-- ================= MAIN CONTENT ================= --}}
    <div class="flex-1 flex flex-col min-w-0">

        {{-- ================= TOP BAR (Mobile) ================= --}}
        <header class="md:hidden bg-gradient-to-r from-lime-400 to-green-600 text-white px-4 py-3 flex items-center gap-3 sticky top-0 z-30 shadow">
            <button onclick="openSidebar()" class="text-white">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>
            <span class="font-extrabold text-lg">Admin Panel</span>
        </header>

        {{-- ================= PAGE CONTENT ================= --}}
        <main class="flex-1 p-4 md:p-10 overflow-x-hidden">

            {{-- NOTIF SUCCESS --}}
            @if(session('success'))
            <div id="alert-success"
                 class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-xl relative">
                <strong class="font-bold">Berhasil!</strong>
                <span class="block sm:inline"> {{ session('success') }}</span>
            </div>
            <script>
            setTimeout(() => {
                const alert = document.getElementById('alert-success');
                if(alert){ alert.style.display = 'none'; }
            }, 3000);
            </script>
            @endif

            @yield('content')

        </main>

    </div>

</div>

<script>
function openSidebar() {
    const sidebar = document.getElementById('sidebar');
    sidebar.classList.remove('-translate-x-full');
    sidebar.classList.add('translate-x-0');
    document.getElementById('sidebar-overlay').classList.remove('hidden');
    document.body.style.overflow = 'hidden';
}
function closeSidebar() {
    const sidebar = document.getElementById('sidebar');
    sidebar.classList.remove('translate-x-0');
    sidebar.classList.add('-translate-x-full');
    document.getElementById('sidebar-overlay').classList.add('hidden');
    document.body.style.overflow = '';
}
</script>

</body>
</html>