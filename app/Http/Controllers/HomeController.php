<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Informasi;

class HomeController extends Controller
{
    public function home()
{
    $informasi = Informasi::latest()->first();

    return view('home', compact('informasi'));
}
}
