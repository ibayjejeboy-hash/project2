<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Siswa;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    public function login()
{
    return view('erapor.login');
}

public function authenticate(Request $request)
{
    if (Auth::attempt($request->only('email','password')))

          dd($credentials, Auth::attempt($credentials));
    {
        $user = Auth::user();

        // 👑 ADMIN
        if ($user->role == 'admin') {
            return redirect()->route('admin.dashboard');
        }

        // 👨‍🏫 GURU
        if ($user->role == 'guru') {
            return redirect()->route('erapor.dashboard');
        }

        // 🧑‍🎓 SISWA
        if ($user->role == 'siswa') {

            $siswa = Siswa::where('user_id', $user->id)->first();

            if ($siswa) {
                if (auth()->user()->role == 'admin') {

                    return redirect()->route('admin.dashboard');

                } elseif (auth()->user()->role == 'guru') {

                    return redirect()->route('erapor.dashboard');

                } else {

                    return redirect()->route('siswa.dashboard', ['id' => $siswa->id]);

                }
            } else {
                return back()->with('error','Data siswa tidak ditemukan');
            }
        }
    }

    return back()->with('error','Login gagal');
}

public function redirectGoogle()
{
    return Socialite::driver('google')->redirect();
}

public function handleGoogle()
{
    $googleUser = Socialite::driver('google')->user();
    $googleEmail = strtolower(trim($googleUser->getEmail()));

    \Log::info('[Google Login] Email dari Google: ' . $googleEmail);

    // Find User by Google email (case-insensitive)
    $user = User::whereRaw('LOWER(email) = ?', [$googleEmail])->first();

    if (!$user) {
        \Log::info('[Google Login] User tidak ditemukan, membuat baru...');
        $user = User::create([
            'name'     => $googleUser->getName(),
            'email'    => $googleEmail,
            'password' => bcrypt('12345678'), // default password
            'role'     => 'siswa'
        ]);
        \Log::info('[Google Login] User baru dibuat, ID: ' . $user->id);
    } else {
        \Log::info('[Google Login] User ditemukan, ID: ' . $user->id . ' | role: ' . $user->role);
    }

    // Link the student record (Siswa) if exists — case-insensitive email match
    $siswa = Siswa::whereRaw('LOWER(email) = ?', [$googleEmail])->first();
    if ($siswa) {
        \Log::info('[Google Login] Siswa ditemukan: ID=' . $siswa->id . ' nama=' . $siswa->nama . ' user_id=' . $siswa->user_id);
        // Always ensure user_id is linked (even if it was linked before)
        if ((int)$siswa->user_id !== (int)$user->id) {
            $siswa->update(['user_id' => $user->id]);
            \Log::info('[Google Login] user_id diperbarui ke: ' . $user->id);
        }
    } else {
        \Log::warning('[Google Login] Siswa TIDAK ditemukan untuk email: ' . $googleEmail);
    }

    Auth::login($user);

    // Redirect sesuai role
    if ($user->role == 'admin') {
        return redirect('/admin/dashboard');
    } elseif ($user->role == 'guru') {
        return redirect('/erapor/dashboard');
    } else {
        // Refresh relasi untuk mendapatkan data siswa terbaru
        $user->refresh();
        \Log::info('[Google Login] Setelah refresh - siswa: ' . ($user->siswa ? 'ADA id=' . $user->siswa->id : 'NULL'));

        if ($user->siswa) {
            return redirect('/siswa/dashboard/' . $user->siswa->id);
        } else {
            \Log::error('[Google Login] GAGAL - siswa null setelah refresh. user_id=' . $user->id);
            return redirect('/login')->with('error', 'Email Google kamu (' . $googleEmail . ') belum terdaftar sebagai siswa. Hubungi admin!');
        }
    }
}

}
