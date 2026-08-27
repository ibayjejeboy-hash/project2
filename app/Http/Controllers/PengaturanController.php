<?php

namespace App\Http\Controllers;

use App\Models\Pengaturan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class PengaturanController extends Controller
{
    public function index()
    {
        $pengaturans = Pengaturan::all()->groupBy('grup');
        return view('admin.pengaturan', compact('pengaturans'));
    }

    public function update(Request $request)
    {
        $data = $request->except('_token', '_method');
        
        foreach ($data as $kunci => $nilai) {
            Pengaturan::where('kunci', $kunci)->update(['nilai' => $nilai]);
        }

        // Clear cache
        Cache::forget('global_settings');

        return redirect()->back()->with('success', 'Pengaturan berhasil diperbarui!');
    }
}
