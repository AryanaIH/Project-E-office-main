<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class suratKeluarController extends Controller
{
    public function index()
    {
        return view('suratkeluar.blade.php'); // pastikan view ini ada
    }
}


