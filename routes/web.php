<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\TruckerController;
use App\Http\Controllers\TruckController;
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

Route::get('register', [RegisteredUserController::class, 'create'])->name('register');
Route::post('register', [RegisteredUserController::class, 'store']);

// --- Rutas Protegidas ---

Route::middleware('auth')->group(function () {
    
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

    // --- NUEVAS RUTAS PARA PAQUETES ---
    Route::get('/packages/create', [PackageController::class, 'create'])->name('packages.create');
    Route::post('/packages', [PackageController::class, 'store'])->name('packages.store');
    

    Route::get('/packages/{package}/edit', [PackageController::class, 'edit'])->name('packages.edit');
    Route::put('/packages/{package}', [PackageController::class, 'update'])->name('packages.update');
    Route::delete('/packages/{package}', [PackageController::class, 'destroy'])->name('packages.destroy');
});

// Rutas solo para admin
Route::middleware(['auth', 'role:admin'])->group(function () {
    // Aquí irían rutas de gestión de conductores, camiones y paquetes globales
    // Ejemplo:
    Route::get('/truckers', [TruckerController::class, 'index'])->name('truckers.index');
    Route::get('/truckers/create', [TruckerController::class, 'create'])->name('truckers.create');
    Route::post('/truckers', [TruckerController::class, 'store'])->name('truckers.store');
    Route::get('/truckers/{trucker}/edit', [TruckerController::class, 'edit'])->name('truckers.edit');
    Route::put('/truckers/{trucker}', [TruckerController::class, 'update'])->name('truckers.update');
    Route::delete('/truckers/{trucker}', [TruckerController::class, 'destroy'])->name('truckers.destroy');

    Route::get('/trucks', [TruckController::class, 'index'])->name('trucks.index');
    Route::get('/trucks/create', [TruckController::class, 'create'])->name('trucks.create');
    Route::post('/trucks', [TruckController::class, 'store'])->name('trucks.store');
    Route::get('/trucks/{truck}/edit', [TruckController::class, 'edit'])->name('trucks.edit');
    Route::put('/trucks/{truck}', [TruckController::class, 'update'])->name('trucks.update');
    Route::delete('/trucks/{truck}', [TruckController::class, 'destroy'])->name('trucks.destroy');

    // Ruta para gestión global de paquetes
    Route::get('/packages', [PackageController::class, 'index'])->name('packages.index');
    // Route::get('/trucks', [TruckController::class, 'index'])->name('trucks.index');
    // Route::post('/admin/add', [AdminController::class, 'store'])->name('admin.add');
});

// Rutas solo para conductor
Route::middleware(['auth', 'role:driver'])->group(function () {
    // Aquí irían rutas para que el conductor vea y edite solo sus datos y paquetes
    // Ejemplo:
    // Route::get('/my-packages', [DashboardController::class, 'index'])->name('my.packages');
    // Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
});

