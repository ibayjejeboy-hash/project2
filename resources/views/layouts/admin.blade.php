<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100">

<div class="flex">

    {{-- ================= SIDEBAR ================= --}}
    <aside class="w-64 h-screen sticky top-0 bg-gradient-to-b from-lime-400 to-green-600 text-white shadow-2xl flex flex-col">

        {{-- Logo / Judul --}}
        <div class="p-6 text-center border-b border-green-300">
            <h1 class="text-xl font-extrabold tracking-wide">
                ADMIN PANEL
            </h1>
            <p class="text-sm opacity-80">
                RA Al - Musyaffallah
            </p>
        </div>

        {{-- Menu --}}
        <nav class="mt-6 px-4 space-y-3">

    {{-- Dashboard --}}
    <a href="{{ route('admin.dashboard') }}"
       class="flex items-center gap-3 p-3 rounded-xl hover:bg-white hover:text-green-600 transition duration-300 group">

        <svg xmlns="http://www.w3.org/2000/svg"
             class="w-6 h-6 group-hover:text-green-600"
             fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3" />
        </svg>

        <span class="font-semibold">Dashboard</span>
    </a>

    {{-- Galeri --}}
    <a href="{{ route('admin.galeri') }}"
       class="flex items-center gap-3 p-3 rounded-xl hover:bg-white hover:text-green-600 transition duration-300 group">

        <svg xmlns="http://www.w3.org/2000/svg"
             class="w-6 h-6 group-hover:text-green-600"
             fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M4 16l4-4a3 3 0 014 0l4 4m-6-6l2-2a3 3 0 014 0l4 4" />
        </svg>

        <span class="font-semibold">Galeri</span>
    </a>

    {{-- Pendaftaran --}}
    <a href="#"
       class="flex items-center gap-3 p-3 rounded-xl hover:bg-white hover:text-green-600 transition duration-300 group">

        <svg xmlns="http://www.w3.org/2000/svg"
             class="w-6 h-6 group-hover:text-green-600"
             fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M12 14l9-5-9-5-9 5 9 5z" />
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M12 14l6.16-3.422A12.083 12.083 0 0121 20.055L12 23 3 20.055a12.083 12.083 0 012.84-9.477L12 14z" />
        </svg>

        <span class="font-semibold">Pendaftaran</span>
    </a>

    {{-- Informasi --}}
    <a href="{{ route('admin.informasi') }}"
       class="flex items-center gap-3 p-3 rounded-xl hover:bg-white hover:text-green-600 transition duration-300 group">

        <svg xmlns="http://www.w3.org/2000/svg"
             class="w-6 h-6 group-hover:text-green-600"
             fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M13 16h-1v-4h-1m1-4h.01M12 6v6m0 0v6" />
        </svg>

        <span class="font-semibold">Informasi</span>
    </a>

    {{-- Data Siswa --}}
    <a href="{{ route('admin.siswa') }}"
class="flex items-center gap-3 p-3 rounded-xl hover:bg-white hover:text-green-600 transition duration-300 group">

<svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" stroke="currentColor">
<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
d="M5.121 17.804A10.978 10.978 0 0112 15c2.21 0 4.268.64 6 1.743M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
</svg>

<span class="font-semibold">Data Siswa</span>
</a>

<a href="{{ route('admin.guru') }}"
                class="flex items-center gap-3 p-3 rounded-xl hover:bg-white hover:text-green-600">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
                <span class="font-semibold">Data Guru</span>
            </a>

</nav>

        {{-- Logout --}}
        <div class="mt-auto p-6">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="w-full bg-white text-green-600 font-bold py-2 rounded-xl hover:bg-gray-200 transition">
                    Logout
                </button>
            </form>
        </div>

    </aside>

    {{-- ================= CONTENT ================= --}}
    <main class="flex-1 p-10">

        {{-- NOTIF SUCCESS --}}
@if(session('success'))

<div id="alert-success"
     class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-xl relative">

    <strong class="font-bold">
        Berhasil!
    </strong>

    <span class="block sm:inline">
        {{ session('success') }}
    </span>

</div>

<script>

setTimeout(() => {

    const alert = document.getElementById('alert-success');

    if(alert){
        alert.style.display = 'none';
    }

}, 3000);

</script>

@endif

        @yield('content')
    </main>

</div>

</body>
</html>