<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

class WilayahController extends Controller
{
    public function provinsi()
    {
        $response = Http::get('https://wilayah.id/api/provinces.json');

        return response()->json($response->json());
    }

    public function kabupaten($id)
    {
        $response = Http::get("https://wilayah.id/api/regencies/$id.json");

        return response()->json($response->json());
    }

    public function kecamatan($id)
    {
        $id = str_replace('-', '.', $id);
        $response = Http::get("https://wilayah.id/api/districts/$id.json");

        return response()->json($response->json());
    }
}