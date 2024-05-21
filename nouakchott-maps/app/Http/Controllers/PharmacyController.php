<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Pharmacy;

class PharmacyController extends Controller
{
    public function index()
    {
        $pharmacies = Pharmacy::all();
        return view('index', ['pharmacies' => $pharmacies]);

        // return view('index');
    }
    public function find(Request $request)
    {
        $lat = $request->input('latitude');
        $lon = $request->input('longitude');

        $pharmacies = DB::table('export-point')
        ->select('name', 'geom', DB::raw("ST_Y(geom::geometry) as latitude, ST_X(geom::geometry) as longitude, ST_Distance(geom::geography, ST_SetSRID(ST_MakePoint($lon, $lat), 4326)::geography) as distance"))
        ->orderBy('distance')
        ->limit(5)
        ->get();
    
        return view('results', ['pharmacies' => $pharmacies,'lat' => $lat,'lon'=>$lon]);
    }
    
}
