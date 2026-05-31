<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Siswa</title>
    @vite('resources/css/app.css')
    <style>
        /* ===== SISWA LAYOUT ===== */
        #siswa-sidebar {
            position: fixed;
            top: 0; left: 0;
            width: 256px;
            height: 100vh;
            background: linear-gradient(to bottom, #166534, #14532d);
            color: white;
            display: flex;
            flex-direction: column;
            z-index: 50;
            box-shadow: 4px 0 20px rgba(0,0,0,0.15);
            transition: transform 0.3s ease;
            transform: translateX(0);
        }

        #siswa-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.5);
            z-index: 40;
        }

        #siswa-main-wrapper {
            margin-left: 256px;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        #siswa-topbar { display: none; }

        /* ===== MOBILE ===== */
        @media (max-width: 767px) {
            #siswa-sidebar {
                transform: translateX(-100%);
            }
            #siswa-main-wrapper {
                margin-left: 0;
            }
            #siswa-topbar {
                display: flex;
                align-items: center;
                gap: 12px;
                background: linear-gradient(to right, #166534, #14532d);
                color: white;
                padding: 12px 16px;
                position: sticky;
                top: 0;
                z-index: 30;
                box-shadow: 0 2px 8px rgba(0,0,0,0.2);
            }
        }

        .siswa-nav-link {
            display: block;
            padding: 10px 16px;
            border-radius: 8px;
            font-weight: 500;
            color: white;
            text-decoration: none;
            transition: background 0.2s;
        }
        .siswa-nav-link:hover { background: rgba(255,255,255,0.15); }
        .siswa-nav-link.active { background: rgba(255,255,255,0.2); font-weight: 700; }
    </style>
</head>

<body style="background:#f3f4f6; margin:0; font-family: sans-serif;">

    {{-- OVERLAY (Mobile) --}}
    <div id="siswa-overlay" onclick="closeSiswaSidebar()"></div>

    {{-- ===== SIDEBAR ===== --}}
    <aside id="siswa-sidebar">

        {{-- Header Sidebar --}}
        <div style="padding:24px 16px; text-align:center; border-bottom:1px solid rgba(255,255,255,0.2); display:flex; align-items:center; justify-content:space-between;">
            <div>
                <div style="font-size:14px; font-weight:800; letter-spacing:1px;">SISWA PANEL</div>
                <div style="font-size:11px; opacity:0.7; margin-top:2px;">RA Al-Musyaffallah</div>
            </div>
            <button onclick="closeSiswaSidebar()" id="siswa-close-btn"
                    style="display:none; background:none; border:none; color:white; cursor:pointer; padding:4px;">
                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

        {{-- Menu --}}
        <nav style="flex:1; padding:16px; overflow-y:auto;">

            <a href="{{ route('siswa.dashboard', $siswa->id) }}"
               class="siswa-nav-link {{ request()->routeIs('siswa.dashboard') ? 'active' : '' }}">
                📊 Dashboard
            </a>

            <a href="{{ route('erapor.hasil', $siswa->id) }}"
               class="siswa-nav-link {{ request()->routeIs('erapor.hasil') ? 'active' : '' }}"
               style="margin-top:8px;">
                📋 Lihat Rapor
            </a>

            <a href="{{ route('erapor.cetak', $siswa->id) }}"
               class="siswa-nav-link {{ request()->routeIs('erapor.cetak') ? 'active' : '' }}"
               style="margin-top:8px;">
                🖨️ Cetak Rapor
            </a>

        </nav>

        {{-- Logout --}}
        <div style="padding:16px; border-top:1px solid rgba(255,255,255,0.2);">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button style="width:100%; background:white; color:#166534; font-weight:700; padding:10px; border-radius:10px; border:none; cursor:pointer; font-size:14px;">
                    Keluar
                </button>
            </form>
        </div>

    </aside>

    {{-- ===== MAIN WRAPPER ===== --}}
    <div id="siswa-main-wrapper">

        {{-- TOP BAR (Mobile) --}}
        <header id="siswa-topbar">
            <button onclick="openSiswaSidebar()" style="background:none; border:none; color:white; cursor:pointer; padding:4px;">
                <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>
            <span style="font-weight:700; font-size:16px;">Siswa Panel</span>
        </header>

        {{-- MAIN CONTENT --}}
        <main style="flex:1; padding:16px; overflow-x:hidden;">

            <div style="background:white; border-radius:16px; box-shadow:0 2px 12px rgba(0,0,0,0.08); padding:20px; min-height:100%; position:relative; overflow:hidden;">

                {{-- WATERMARK --}}
                <div style="position:absolute; inset:0; display:flex; align-items:center; justify-content:center; pointer-events:none;">
                    <img src="{{ asset('assets/images/1001230752.jpg - Edited.png') }}"
                         alt="logo"
                         style="width:200px; opacity:0.06;">
                </div>

                {{-- CONTENT --}}
                <div style="position:relative; z-index:10;">
                    @yield('content')
                </div>

            </div>

        </main>

    </div>

    <script>
    function openSiswaSidebar() {
        document.getElementById('siswa-sidebar').style.transform = 'translateX(0)';
        document.getElementById('siswa-overlay').style.display = 'block';
        document.getElementById('siswa-close-btn').style.display = 'block';
        document.body.style.overflow = 'hidden';
    }
    function closeSiswaSidebar() {
        if (window.innerWidth < 768) {
            document.getElementById('siswa-sidebar').style.transform = 'translateX(-100%)';
        }
        document.getElementById('siswa-overlay').style.display = 'none';
        document.getElementById('siswa-close-btn').style.display = 'none';
        document.body.style.overflow = '';
    }

    // Show close button on mobile initially hidden
    function handleResize() {
        const sidebar = document.getElementById('siswa-sidebar');
        const topbar = document.getElementById('siswa-topbar');
        const wrapper = document.getElementById('siswa-main-wrapper');
        if (window.innerWidth >= 768) {
            sidebar.style.transform = 'translateX(0)';
            wrapper.style.marginLeft = '256px';
            topbar.style.display = 'none';
        } else {
            if (!document.getElementById('siswa-overlay').style.display || document.getElementById('siswa-overlay').style.display === 'none') {
                sidebar.style.transform = 'translateX(-100%)';
            }
            wrapper.style.marginLeft = '0';
            topbar.style.display = 'flex';
        }
    }
    window.addEventListener('resize', handleResize);
    handleResize();
    </script>

</body>
</html>