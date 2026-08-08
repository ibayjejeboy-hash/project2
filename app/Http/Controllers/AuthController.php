<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Siswa;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    public function login()
    {
        return view('admin.login');
    }

    public function redirectGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogle()
    {
        try {
            $googleUser = Socialite::driver('google')->user();
        } catch (\Exception $e) {
            Log::error('[Google Login Error] Gagal mengambil data user: ' . $e->getMessage());
            return redirect()->route('login')->with('error', 'Gagal melakukan login dengan Google. Silakan coba lagi.');
        }

        $googleEmail = strtolower(trim($googleUser->getEmail()));

        // Cari user berdasarkan email Google
        $user = User::whereRaw('LOWER(email) = ?', [$googleEmail])->first();

        if (!$user) {
            // Buat user baru dengan password acak yang aman (Anti-Default Password)
            $user = User::create([
                'name'     => $googleUser->getName(),
                'email'    => $googleEmail,
                'password' => Hash::make(Str::random(32)),
                'role'     => 'siswa'
            ]);
        }

        // Tautkan data Siswa jika email cocok
        $siswa = Siswa::whereRaw('LOWER(email) = ?', [$googleEmail])->first();
        if ($siswa) {
            if ((int)$siswa->user_id !== (int)$user->id) {
                $siswa->update(['user_id' => $user->id]);
            }
        }

        Auth::login($user, true);

        // Redirect dinamis sesuai role pengguna
        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        } elseif ($user->role === 'guru') {
            return redirect()->route('erapor.dashboard');
        } else {
            // Ambil data siswa milik user ini
            $siswaData = Siswa::where('user_id', $user->id)->first();

            if ($siswaData) {
                return redirect()->route('siswa.dashboard', ['id' => $siswaData->id]);
            } else {
                return redirect()->route('login')->with('error', 'Email Google Anda (' . $googleEmail . ') belum terhubung dengan data siswa di database. Silakan hubungi admin sekolah!');
            }
        }
    }
}
