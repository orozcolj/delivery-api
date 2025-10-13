<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\DashboardController;
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
// --- Rutas Públicas ---
Route::get('/', function () {
    return view('welcome');
});
// Ruta para mostrar el formulario de login
Route::get('login', [AuthenticatedSessionController::class, 'create'])
    ->name('login');

// Ruta para procesar el envío del formulario
Route::post('login', [AuthenticatedSessionController::class, 'store']);

// --- Rutas Protegidas ---
Route::middleware('ensure.token')->group(function () {
    
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

});