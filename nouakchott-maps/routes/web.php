<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PharmacyController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [PharmacyController::class, 'index']);
Route::post('/find', [PharmacyController::class, 'find']);


Route::get('/get-building-data', [PharmacyController::class, 'getBuildingData']);
Route::get('/get-road-data', [PharmacyController::class, 'getRoadData']);
Route::get('/get-natural-data', [PharmacyController::class, 'getNaturalData']);
Route::get('/get-landuse-data', [PharmacyController::class, 'getLanduseData']);

Route::get('/map', [PharmacyController::class, 'showMap']);