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
        // Validar todos los datos del formulario
        $data = $request->validate([
            'first_name' => ['required', 'string', 'max:45'],
            'last_name' => ['required', 'string', 'max:45'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'document' => ['required', 'string', 'max:10', 'unique:truckers'],
            'birth_date' => ['required', 'date'],
            'license_number' => ['required', 'string', 'max:10'],
            'phone' => ['required', 'string', 'max:20'],
        ]);

        try {
            // Crear el usuario
            $user = \App\Models\User::create([
                'name' => $data['first_name'] . ' ' . $data['last_name'],
                'email' => $data['email'],
                'password' => \Hash::make($data['password']),
                'email_verified_at' => now(),
                'remember_token' => \Str::random(10),
            ]);

            // Crear el trucker asociado
            \App\Models\Trucker::create([
                'user_id' => $user->id,
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name'],
                'document' => $data['document'],
                'birth_date' => $data['birth_date'],
                'license_number' => $data['license_number'],
                'phone' => $data['phone'],
            ]);

            return redirect()->route('login')->with('success', '¡Registro exitoso! Por favor, inicia sesión.');
        } catch (\Exception $e) {
            return back()->with('error', 'No se pudo registrar el usuario.')->withInput();
        }
    }
}