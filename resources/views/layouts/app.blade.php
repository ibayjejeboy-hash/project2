<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <title>@yield('title', 'RA Al Musyaffallah - Gabuswetan Indramayu')</title>
    <meta name="description" content="Website Resmi & Sistem E-Raport RA Al Musyaffallah Gabuswetan Indramayu. Membentuk generasi cerdas, berkarakter Islami, dan berakhlak mulia.">
    <meta name="keywords" content="RA Al Musyaffallah, Raudhatul Athfal, TK Islam Indramayu, E-Raport RA, Gabuswetan">

    {{-- Favicon --}}
    <link rel="icon" type="image/png" href="{{ asset('assets/images/1001230752.jpg - Edited.png') }}">

    {{-- Tailwind CDN & Flowbite / Alpine if needed --}}
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
                        sans: ['Poppins', 'Plus Jakarta Sans', 'sans-serif'],
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
        body { 
            font-family: 'Poppins', sans-serif; 
            overflow-x: hidden;
        }
        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }
        ::-webkit-scrollbar-track {
            background: #f1f5f9;
        }
        ::-webkit-scrollbar-thumb {
            background: #86efac;
            border-radius: 4px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #22c55e;
        }
    </style>
    @stack('styles')
</head>
<body id="top" class="bg-gray-50 text-gray-800 antialiased selection:bg-green-500 selection:text-white">

@yield('content')

<x-chatbot-widget />

@stack('scripts')
</body>
</html>