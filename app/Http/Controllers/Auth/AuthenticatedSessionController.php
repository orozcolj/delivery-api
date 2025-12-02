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
        // Validar los datos del formulario
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Autenticar directamente con Laravel
        if (\Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/dashboard');
        }

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
