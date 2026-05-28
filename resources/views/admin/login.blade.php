@extends('layouts.app')

@section('content')

<section class="min-h-screen relative flex">

    {{-- BACKGROUND IMAGE FULL --}}
    <div class="absolute inset-0">
        <img src="{{ asset('assets/images/612919327_800651653029679_8741154945121478353_n.jpg') }}"
             class="w-full h-full object-cover">

        {{-- OVERLAY GRADIENT HALUS --}}
        <div class="absolute inset-0 
            bg-gradient-to-r 
            from-black/65
            via-black/40 
            to-gray-100">
        </div>
    </div>

    {{-- CONTENT --}}
    <div class="relative z-10 flex w-full">

        {{-- LEFT TEXT --}}
        <div class="hidden md:flex w-1/2 items-center p-12 text-white">
            <div>
                <h1 class="text-4xl font-extrabold mb-4 leading-tight">
                    Sistem E-Rapor Digital
                </h1>
                <p class="text-lg opacity-90">
                    Kelola data siswa, nilai, dan rapor dengan mudah dan modern.
                </p>
            </div>
        </div>

        {{-- RIGHT FORM --}}
        <div class="w-full md:w-1/2 flex items-center justify-center">

            <div class="bg-white/90 backdrop-blur-md w-[420px] rounded-2xl shadow-2xl p-10">

                <h2 class="text-3xl font-extrabold text-center mb-6 text-gray-800">
                    Login
                </h2>

                {{-- GOOGLE LOGIN --}}
                <a href="{{ url('/auth/google') }}"
                   class="w-full flex items-center justify-center gap-3 border py-3 rounded-xl mb-5 hover:bg-gray-100 transition">

                    <img src="https://www.svgrepo.com/show/475656/google-color.svg"
                         class="w-5 h-5">

                    <span class="font-semibold text-gray-700">
                        Login dengan Google
                    </span>
                </a>

                <div class="text-center text-gray-400 text-sm mb-4">
                    atau login manual
                </div>

                <form method="POST" action="{{ route('admin.authenticate') }}">
                    @csrf

                    <div class="mb-4">
                        <label class="block font-semibold mb-2 text-gray-700">
                            Email
                        </label>
                        <input type="email" name="email"
                            class="w-full p-3 rounded-lg border focus:ring-2 focus:ring-green-500 outline-none"
                            required>
                    </div>

                    <div class="mb-6">
                        <label class="block font-semibold mb-2 text-gray-700">
                            Password
                        </label>
                        <input type="password" name="password"
                            class="w-full p-3 rounded-lg border focus:ring-2 focus:ring-green-500 outline-none"
                            required>
                    </div>

                    <button type="submit"
                        class="w-full bg-green-600 hover:bg-green-700 text-white font-bold py-3 rounded-xl transition duration-300 shadow-md">
                        MASUK
                    </button>

                </form>

            </div>

        </div>

    </div>

</section>

@endsection