<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class WilayahController extends Controller
{
    public function provinsi()
    {
        try {
            $data = Cache::remember('wilayah_provinsi', 86400 * 7, function () {
                $response = Http::timeout(5)->get('https://wilayah.id/api/provinces.json');
                return $response->successful() ? $response->json() : [];
            });

            return response()->json($data);
        } catch (\Exception $e) {
            Log::warning('[Wilayah API Warning] Gagal mengambil provinsi: ' . $e->getMessage());
            return response()->json([], 200);
        }
    }

    public function kabupaten($id)
    {
        try {
            $cacheKey = 'wilayah_kabupaten_' . $id;
            $data = Cache::remember($cacheKey, 86400 * 7, function () use ($id) {
                $response = Http::timeout(5)->get("https://wilayah.id/api/regencies/{$id}.json");
                return $response->successful() ? $response->json() : [];
            });

            return response()->json($data);
        } catch (\Exception $e) {
            Log::warning("[Wilayah API Warning] Gagal mengambil kabupaten {$id}: " . $e->getMessage());
            return response()->json([], 200);
        }
    }

    public function kecamatan($id)
    {
        try {
            $idClean = str_replace('-', '.', $id);
            $cacheKey = 'wilayah_kecamatan_' . $idClean;
            $data = Cache::remember($cacheKey, 86400 * 7, function () use ($idClean) {
                $response = Http::timeout(5)->get("https://wilayah.id/api/districts/{$idClean}.json");
                return $response->successful() ? $response->json() : [];
            });

            return response()->json($data);
        } catch (\Exception $e) {
            Log::warning("[Wilayah API Warning] Gagal mengambil kecamatan {$id}: " . $e->getMessage());
            return response()->json([], 200);
        }
    }
}