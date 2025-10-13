<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class RegisteredUserController extends Controller
{
    /**
     * Muestra la vista de registro.
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Maneja una petición de registro.
     */
    public function store(Request $request)
    {
        // Llama al endpoint de registro de nuestra API con todos los datos del formulario.
        $response = Http::post(url('/api/register'), $request->all());

        // Si la API devuelve un error de validación (422)...
        if ($response->status() === 422) {
            // ...vuelve al formulario anterior con los mensajes de error de la API.
            return back()->withErrors($response->json('errors'))->withInput();
        }

        // Si la API devuelve cualquier otro error...
        if ($response->failed()) {
            // ...vuelve con un mensaje de error general.
            return back()->with('error', 'Hubo un problema durante el registro.');
        }

        // Si el registro en la API fue exitoso...
        // ...redirige al usuario a la página de login con un mensaje de éxito.
        return redirect()->route('login')->with('success', '¡Registro exitoso! Por favor, inicia sesión.');
    }
}