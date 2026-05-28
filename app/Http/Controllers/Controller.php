<?php

namespace App\Http\Controllers;

use App\Models\Informasi;

abstract class Controller
{
    public function home()
{
    $informasi = Informasi::latest()->first();

    return view('home', compact('informasi'));
}
}
