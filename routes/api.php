<?php

use App\Http\Controllers\API\AkunController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\LaporanController;

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


Route::resource('/register', AkunController::class);
Route::post('/login', [AkunController::class, 'login']);

Route::middleware('auth:sanctum')->group(function(){
    Route::post('/user', [AkunController::class, 'getLogin']);
    Route::post('/logout', [AkunController::class, 'logout']);
    Route::resource('/laporan', LaporanController::class);
    Route::post('/upload', [LaporanController::class, 'image']);
});