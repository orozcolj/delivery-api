<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AuthenticatedSessionController extends Controller
{
    /**
     * Muestra la vista de login.
     */
    public function create()
    {
        return view('auth.login');
    }

    /**
     * Maneja la petición de login.
     */
    public function store(Request $request)
    {
        // 1. Validar los datos del formulario (una validación simple es suficiente aquí).
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // 2. Usar el Cliente HTTP para llamar a nuestra API de login.
        $response = Http::post(url('/api/login'), [
            'email' => $credentials['email'],
            'password' => $credentials['password'],
        ]);

        // 3. Revisar la respuesta de la API.
        if ($response->successful()) {
            // Si el login en la API fue exitoso...
            
            // a) Guarda el token en la sesión del usuario.
            $token = $response->json('accessToken');
            $request->session()->put('api_token', $token);
            $request->session()->regenerate();

            // b) Redirige al usuario al dashboard (que crearemos pronto).
            return redirect()->intended('/dashboard');
        }

        // Si el login en la API falló, vuelve al formulario
        // con un mensaje de error.
        return back()->withErrors([
            'email' => 'Las credenciales proporcionadas no son correctas.',
        ])->onlyInput('email');
    }

 public function destroy(Request $request)
    {
        // Borra toda la información de la sesión.
        $request->session()->invalidate();

        // Genera un nuevo token CSRF para la siguiente sesión.
        $request->session()->regenerateToken();

        // Redirige al usuario a la página de inicio.
        return redirect('/');
    }

}
