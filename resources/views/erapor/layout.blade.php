<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>E-Rapor Guru</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100 text-black overflow-x-hidden">

    {{-- SIDEBAR (FIXED) --}}
    <aside class="fixed top-0 left-0 w-64 h-screen bg-[#228b22] text-white shadow-lg flex flex-col z-50">

        {{-- TITLE --}}
        <div class="p-6 text-center font-bold text-xl border-b border-green-700">
            E - RAPOR GURU
        </div>

        {{-- MENU --}}
        <nav class="flex-1 p-4 space-y-2">

            <a href="{{ route('erapor.dashboard') }}"
               class="block px-4 py-2 rounded-lg font-medium hover:bg-green-700 transition
               {{ request()->routeIs('erapor.dashboard') ? 'bg-green-800' : '' }}">
                Dashboard
            </a>

            <a href="{{ route('erapor.input') }}"
               class="block px-4 py-2 rounded-lg font-medium hover:bg-green-700 transition
               {{ request()->routeIs('erapor.input') ? 'bg-green-800' : '' }}">
                Input Nilai
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

    {{-- CONTENT --}}
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