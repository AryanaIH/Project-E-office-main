<?php

namespace App\Http\Controllers;

use App\Models\PraProyek;
use Illuminate\Http\Request;

class MonitoringController extends Controller
{
    public function PraProyek()
    {
        $praProyeks = PraProyek::all();
        $klienList = PraProyek::select('client')->distinct()->pluck('client');

        return view('monitoringProyek', compact('praProyeks', 'klienList'));
    }
}
