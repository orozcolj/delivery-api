<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http; 

class DashboardController extends Controller
{
    /**
     * Muestra el dashboard con la lista de paquetes del usuario.
     */
    public function index(Request $request)
    {
        // 1. Obtiene el token de la API que guardamos en la sesión durante el login.
            $user = auth()->user();
            $trucker = $user->trucker ?? null;
            $packages = $trucker ? $trucker->packages()->with(['details', 'packageStatus'])->get() : [];
            return view('dashboard', ['packages' => $packages]);
    }
}