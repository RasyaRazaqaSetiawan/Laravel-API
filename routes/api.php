<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\LigaController;

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

Route::get('liga', [Ligacontroller::class, 'index']);
Route::post('liga', [Ligacontroller::class, 'store']);
Route::get('liga/{id}', [Ligacontroller::class, 'show']);
Route::put('liga/{id}', [Ligacontroller::class, 'update']);
Route::delete('liga/{id}', [Ligacontroller::class, 'delete']);
