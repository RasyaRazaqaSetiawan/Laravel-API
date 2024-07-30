<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\LigaController;
use App\Http\Controllers\Api\KlubController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Route Manual
// Route::get('liga', [Ligacontroller::class, 'index']);
// Route::post('liga', [Ligacontroller::class, 'store']);
// Route::get('liga/{id}', [Ligacontroller::class, 'show']);
// Route::put('liga/{id}', [Ligacontroller::class, 'update']);
// Route::delete('liga/{id}', [Ligacontroller::class, 'destroy']);

//Route Matic
Route::resource('liga', LigaController::class)->except(['edit', 'create']);
Route::resource('klub', KlubController::class)->except(['edit', 'create']);
