<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Siswa</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100 text-black h-screen overflow-hidden">

    {{-- SIDEBAR (FIXED) --}}
    <aside class="fixed top-0 left-0 w-64 h-screen bg-[#228b22] text-white shadow-lg flex flex-col z-50">

        {{-- TITLE --}}
        <div class="p-6 text-center font-bold text-xl border-b border-green-700">
            SISWA PANEL
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
                <button
                    class="w-full bg-white text-[#228b22] font-semibold py-2 rounded-lg hover:bg-gray-200 transition">
                    Logout
                </button>
            </form>
        </div>

    </aside>

    {{-- CONTENT (YANG SCROLL) --}}
    <main class="ml-64 h-screen overflow-y-auto p-8">

    <div class="bg-white rounded-2xl shadow-md p-6 min-h-full relative overflow-hidden">

        {{-- WATERMARK --}}
        <div class="absolute inset-0 flex items-center justify-center pointer-events-none">
            <img src="{{ asset('assets/images/1001230752.jpg - Edited.png') }}"
                 alt="logo"
                 class="w-[400px] opacity-10">
        </div>

        {{-- CONTENT --}}
        <div class="relative z-10">
            @yield('content')
        </div>

    </div>

</main>

</body>
</html>