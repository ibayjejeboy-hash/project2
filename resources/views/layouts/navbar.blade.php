{{-- Navbar Komponen Publik --}}
<header class="w-full bg-white/85 backdrop-blur-md border-b border-green-100/80 sticky top-0 z-50 transition-all duration-300 shadow-sm">
    <div class="max-w-7xl mx-auto flex justify-between items-center px-4 sm:px-6 lg:px-8 py-3.5">

        {{-- Logo & Identitas Sekolah --}}
        <a href="{{ route('home') }}" class="flex items-center gap-3 group">
            <div class="relative">
                <img src="{{ asset('assets/images/1001230752.jpg - Edited.png') }}" 
                     alt="Logo RA Al Musyaffallah" 
                     class="w-11 h-11 sm:w-12 sm:h-12 object-contain group-hover:scale-105 transition-transform duration-300 drop-shadow-sm">
            </div>
            <div>
                <span class="block font-black text-green-900 text-base sm:text-lg tracking-wider group-hover:text-green-700 transition">
                    AL MUSYAFFALLAH
                </span>
                <div class="flex items-center gap-2 -mt-0.5">
                    <span class="block text-[11px] font-bold text-green-600 uppercase tracking-widest">
                        Raudhatul Athfal
                    </span>
                    <span class="hidden sm:inline-block text-[10px] font-extrabold bg-green-100 text-green-800 px-1.5 py-0.2 rounded border border-green-200">
                        AKREDITASI B
                    </span>
                </div>
            </div>
        </a>

        {{-- Desktop Navigation --}}
        <nav class="hidden md:flex items-center gap-7 lg:gap-9 font-extrabold text-sm tracking-wide text-gray-700">
            <a href="{{ route('home') }}" 
               class="hover:text-green-600 transition duration-200 {{ request()->routeIs('home') ? 'text-green-700 font-black relative after:content-[\'\'] after:absolute after:-bottom-1 after:left-0 after:w-full after:h-0.5 after:bg-green-600 after:rounded-full' : '' }}">
                HOME
            </a>
            <a href="{{ route('home') }}#keunggulan" class="hover:text-green-600 transition duration-200">
                KEUNGGULAN
            </a>
            <a href="{{ route('home') }}#visi-misi" class="hover:text-green-600 transition duration-200">
                VISI & MISI
            </a>
            <a href="{{ route('galeri') }}" 
               class="hover:text-green-600 transition duration-200 {{ request()->routeIs('galeri') ? 'text-green-700 font-black relative after:content-[\'\'] after:absolute after:-bottom-1 after:left-0 after:w-full after:h-0.5 after:bg-green-600 after:rounded-full' : '' }}">
                GALERI
            </a>
            <a href="{{ route('pendaftaran') }}" 
               class="hover:text-green-600 transition duration-200 {{ request()->is('pendaftaran*') ? 'text-green-700 font-black relative after:content-[\'\'] after:absolute after:-bottom-1 after:left-0 after:w-full after:h-0.5 after:bg-green-600 after:rounded-full' : '' }}">
                PENDAFTARAN
            </a>
            <a href="{{ route('home') }}#kontak" class="hover:text-green-600 transition duration-200">
                KONTAK
            </a>

            {{-- E-Rapor CTA Button --}}
            <a href="{{ url('/erapor') }}" 
               class="inline-flex items-center gap-2 px-5 py-2.5 bg-gradient-to-r from-green-600 to-emerald-700 hover:from-green-700 hover:to-emerald-800 text-white font-bold rounded-xl shadow-sm hover:shadow-md hover:-translate-y-0.5 transition-all duration-200 text-xs uppercase tracking-wider">
                <i class="fa-solid fa-graduation-cap text-sm"></i>
                <span>E-RAPOR</span>
            </a>
        </nav>

        {{-- Mobile Hamburger Button --}}
        <div class="flex items-center gap-2 md:hidden">
            <a href="{{ url('/erapor') }}" 
               class="inline-flex items-center gap-1 px-3 py-1.5 bg-green-600 text-white font-bold rounded-lg text-xs">
                <i class="fa-solid fa-graduation-cap"></i>
                <span>E-RAPOR</span>
            </a>
            <button id="public-menu-toggle" 
                    type="button"
                    class="text-gray-700 hover:text-green-600 focus:outline-none p-2 hover:bg-green-50 rounded-xl transition" 
                    onclick="togglePublicNavbar()">
                <svg id="menu-icon-bars" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
                <svg id="menu-icon-close" class="w-6 h-6 hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

    </div>

    {{-- Mobile Menu Dropdown --}}
    <div id="public-mobile-dropdown" class="hidden md:hidden bg-white/98 backdrop-blur-lg px-6 py-5 space-y-3 font-extrabold text-sm border-t border-green-100 shadow-xl transition-all duration-300">
        <a href="{{ route('home') }}" class="block py-2.5 text-gray-700 hover:text-green-600 border-b border-gray-100 {{ request()->routeIs('home') ? 'text-green-600 font-black' : '' }}">
            <i class="fa-solid fa-house text-green-600 mr-2 w-5"></i> HOME
        </a>
        <a href="{{ route('home') }}#keunggulan" class="block py-2.5 text-gray-700 hover:text-green-600 border-b border-gray-100" onclick="togglePublicNavbar()">
            <i class="fa-solid fa-star text-green-600 mr-2 w-5"></i> KEUNGGULAN
        </a>
        <a href="{{ route('home') }}#visi-misi" class="block py-2.5 text-gray-700 hover:text-green-600 border-b border-gray-100" onclick="togglePublicNavbar()">
            <i class="fa-solid fa-bullseye text-green-600 mr-2 w-5"></i> VISI & MISI
        </a>
        <a href="{{ route('galeri') }}" class="block py-2.5 text-gray-700 hover:text-green-600 border-b border-gray-100 {{ request()->routeIs('galeri') ? 'text-green-600 font-black' : '' }}">
            <i class="fa-solid fa-images text-green-600 mr-2 w-5"></i> GALERI
        </a>
        <a href="{{ route('pendaftaran') }}" class="block py-2.5 text-gray-700 hover:text-green-600 border-b border-gray-100 {{ request()->is('pendaftaran*') ? 'text-green-600 font-black' : '' }}">
            <i class="fa-solid fa-file-signature text-green-600 mr-2 w-5"></i> PENDAFTARAN (PPDB)
        </a>
        <a href="{{ route('home') }}#kontak" class="block py-2.5 text-gray-700 hover:text-green-600 border-b border-gray-100" onclick="togglePublicNavbar()">
            <i class="fa-solid fa-phone text-green-600 mr-2 w-5"></i> KONTAK & LOKASI
        </a>
        <div class="pt-2">
            <a href="{{ url('/erapor') }}" class="block py-3 text-center bg-gradient-to-r from-green-600 to-emerald-700 text-white rounded-xl font-bold shadow-md">
                <i class="fa-solid fa-graduation-cap mr-1.5"></i> MASUK E-RAPOR
            </a>
        </div>
    </div>
</header>

<script>
function togglePublicNavbar() {
    const menu = document.getElementById('public-mobile-dropdown');
    const iconBars = document.getElementById('menu-icon-bars');
    const iconClose = document.getElementById('menu-icon-close');
    
    if (menu) {
        menu.classList.toggle('hidden');
        if (iconBars && iconClose) {
            iconBars.classList.toggle('hidden');
            iconClose.classList.toggle('hidden');
        }
    }
}
</script>
