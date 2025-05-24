<?php

namespace App\Http\Controllers;

use App\Models\PraProyek;
use Illuminate\Http\Request;

class MonitoringController extends Controller
{
    public function monitoring()
    {
        $praProyeks = PraProyek::all();
        return view('monitoring', compact('praProyeks'));
    }
}
