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
        $token = $request->session()->get('api_token');

        // 2. Hace una petición GET a nuestro propio endpoint de la API.
        // ->withToken($token) adjunta automáticamente el encabezado de autorización.
        $response = Http::withToken($token)->get(url('/api/packages'));

        // 3. Prepara los datos para la vista.
        $packages = [];
        if ($response->successful()) {
            // Si la API respondió correctamente, extraemos los paquetes.
            // Usamos ->json('data') porque nuestro API Resource envuelve todo en una clave 'data'.
            $packages = $response->json('data');
        }

        // 4. Muestra la vista 'dashboard' y le pasa la variable 'packages'.
        return view('dashboard', ['packages' => $packages]);
    }
}