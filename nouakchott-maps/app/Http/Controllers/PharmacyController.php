<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Pharmacy;
use App\Models\Building;
use App\Models\Road;
use App\Models\NaturalElement;
use App\Models\Landuse;

class PharmacyController extends Controller
{
    public function index()
    {
        $pharmacies = Pharmacy::all();
        return view('index', ['pharmacies' => $pharmacies]);

        // return view('index');
    }

    public function getBuildingData()
    {
        $buildings = Building::all(); // Assuming Building model has been defined
        return $buildings->toJson();
    }

    // Controller method to fetch road data
    public function getRoadData()
    {
        $roads = Road::all(); // Assuming Road model has been defined
        return $roads->toJson();
    }

    // Controller method to fetch natural element data
    public function getNaturalData()
    {
        $naturalElements = NaturalElement::all(); // Assuming NaturalElement model has been defined
        return $naturalElements->toJson();
    }
    public function getLanduseData()
    {
        $landuse = Landuse::all(); // Assuming NaturalElement model has been defined
        return $landuse->toJson();
    }

    public function showMap()
    {
        return view('map');
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
