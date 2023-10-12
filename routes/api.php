<?php

use App\Models\District;
use App\Models\Thana;
use App\Models\Village;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('guest')->get('/districts', function (Request $request) {
    $district = District::all();
    return response()->json(['districts' => $district]);
});

Route::middleware('guest')->get('/thana/{id}', function (Request $request) {
    $thana = Thana::where('district_id', $request->id)->get();
    return response()->json(['thana' => $thana]);
});

Route::middleware('guest')->get('/village/{id}', function (Request $request) {
    $village = Village::where('thana_id', $request->id)->get();
    return response()->json(['village' => $village]);
});
