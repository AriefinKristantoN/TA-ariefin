<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\Http\Request;

class MapController extends Controller
{
    public function showGPSData()
    {
        $gpsData = Location::all();
        return view('gps_data', ['gpsData' => $gpsData]);
    }
}
