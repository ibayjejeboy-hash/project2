@extends('layouts.admin')

@section('content')

<h2 class="text-2xl font-bold mb-6">

    {{ $siswa->user_id ? 'Edit Akun Siswa' : 'Buat Akun Siswa' }}

</h2>

<div class="bg-white p-6 rounded-2xl shadow">

<form method="POST"

    action="{{ $siswa->user_id
        ? route('admin.user-create.update', $siswa->id)
        : route('admin.user.store') }}">

    @csrf

    @if($siswa->user_id)
        @method('PUT')
    @endif

    <input type="hidden"
           name="siswa_id"
           value="{{ $siswa->id }}">

    {{-- NAMA --}}
    <div class="mb-4">

        <label class="font-semibold">
            Nama Akun
        </label>

        <input type="text"
               name="name"

               value="{{ $user->name ?? $siswa->nama }}"

               class="w-full border p-3 rounded-xl mt-1">

    </div>

    {{-- EMAIL --}}
    <div class="mb-4">

        <label class="font-semibold">
            Email
        </label>

        <input type="email"
               name="email"

               value="{{ $user->email ?? (strtolower(str_replace(' ', '', $siswa->email)) . '') }}"

               class="w-full border p-3 rounded-xl mt-1">

    </div>

    {{-- PASSWORD --}}
<div class="mb-6">

    <label class="font-semibold">
        Password
    </label>

    <div class="relative">

        <input
            type="password"
            name="password"
            id="password"

            value="{{ $user ? '' : $siswa->nis }}"

            placeholder="Kosongkan jika tidak ingin mengganti password"

            class="w-full border p-3 rounded-xl mt-1 pr-14">

        {{-- BUTTON SHOW --}}
        <button
    type="button"
    onclick="togglePassword()"

    class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-500 hover:text-blue-600">

    <svg xmlns="http://www.w3.org/2000/svg"
         fill="none"
         viewBox="0 0 24 24"
         stroke-width="1.5"
         stroke="currentColor"
         class="w-5 h-5">

        <path stroke-linecap="round"
              stroke-linejoin="round"
              d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.964-7.178Z" />

        <path stroke-linecap="round"
              stroke-linejoin="round"
              d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />

    </svg>

</button>

    </div>

    {{-- INFO --}}
    <p class="text-xs text-gray-500 mt-2">
        Password lama tidak dapat ditampilkan karena terenkripsi.
    </p>

</div>

<script>

function togglePassword() {

    const input = document.getElementById('password');

    if (input.type === 'password') {

        input.type = 'text';

    } else {

        input.type = 'password';

    }

}

</script>

    {{-- ROLE --}}
    <input type="hidden"
           name="role"
           value="siswa">

    <button class="bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-xl font-bold">

        {{ $siswa->user_id ? 'Update Akun' : 'Buat Akun' }}

    </button>

</form>

</div>

@endsection