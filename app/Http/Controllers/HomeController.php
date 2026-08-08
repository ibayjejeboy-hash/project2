<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Informasi;
use App\Models\Galeri;

class HomeController extends Controller
{
    public function home()
    {
        $informasi = Informasi::latest()->first();
        $galeris   = Galeri::latest()->take(3)->get();

        return view('home', compact('informasi', 'galeris'));
    }
}
