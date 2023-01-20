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

// Route::post('/register', [AkunController::class, 'register'])->middleware('guest');
// Route::post('/login', [AkunController::class, 'login'])->middleware('guest');

// Route::middleware('auth:sanctum')->group(function(){
    // Route::post('/logout', [AkunController::class, 'logout']);
    // Route::post('/user', [AkunController::class, 'getLogin']);
    // Route::put('/updateuser/{id}', [AkunController::class, 'update']);
    // Route::get('/alluser', [AkunController::class, 'index']);
    
    // Laporan Controller
    //     Route::resource('/laporan', LaporanController::class)->except('show');
    //     Route::post('/upload', [LaporanController::class, 'image']);
    //     Route::get('/history', [LaporanController::class, 'history']);
    // });
    // Route::get('/alluser', [AkunController::class, 'index']);
    
    
    
    








    

    
Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    Route::post('register', [AkunController::class, 'register']);
    Route::post('login', [AkunController::class, 'login']);

    Route::post('logout', [AkunController::class, 'logout']);
    Route::post('refresh', [AkunController::class, 'refresh']);
    Route::post('user', [AkunController::class, 'getLogin']);

    Route::put('/updateuser/{id}', [AkunController::class, 'update']);
    Route::delete('/deleteuser/{id}', [AkunController::class, 'destroy']);
    Route::get('/getuser', [AkunController::class, 'getUser']);
    Route::get('/detailuser/{id}', [AkunController::class, 'showUser']);
    Route::get('/getadmin', [AkunController::class, 'getAdmin']);
    Route::get('/detailadmin/{id}', [AkunController::class, 'showAdmin']);
    
    // Laporan Controller
    Route::resource('/laporan', LaporanController::class);
    Route::post('/upload', [LaporanController::class, 'image']);
    Route::get('/history', [LaporanController::class, 'history']);
    Route::get('/history/{id}', [LaporanController::class, 'historyUser']);
});