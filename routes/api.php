<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PackageController; 
use App\Http\Controllers\Api\TruckerController;
use App\Http\Controllers\Api\TruckController;

// Ruta de Bienvenida
Route::get('/', function () {
    return response()->json([
        'api_name' => 'Delivery API',
        'version' => '1.0.0',
        'status' => 'OK',
        'documentation_url' => url('/api/documentation'),
    ]);
});

// Rutas públicas
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Rutas protegidas por Sanctum
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::middleware('auth:sanctum')->put('/user', [\App\Http\Controllers\Api\UserController::class, 'update']);
    Route::apiResource('packages', PackageController::class);
    Route::apiResource('truckers', TruckerController::class);
    Route::apiResource('trucks', TruckController::class);
});
