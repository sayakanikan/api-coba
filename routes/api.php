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

Route::post('/register', [AkunController::class, 'store'])->middleware('guest');
Route::post('/login', [AkunController::class, 'login'])->middleware('guest');

Route::middleware('auth:sanctum')->group(function(){
    Route::post('/logout', [AkunController::class, 'logout']);
    Route::post('/user', [AkunController::class, 'getLogin']);
    Route::put('/updateuser/{id}', [AkunController::class, 'update']);
    Route::get('/alluser', [AkunController::class, 'index']);

    // Laporan Controller
    Route::resource('/laporan', LaporanController::class)->except('show');
    Route::post('/upload', [LaporanController::class, 'image']);
    Route::get('/history', [LaporanController::class, 'history']);
});