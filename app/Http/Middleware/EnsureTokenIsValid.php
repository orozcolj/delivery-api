<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureTokenIsValid
{
    public function handle(Request $request, Closure $next): Response
    {
        // Revisa si la sesión NO tiene un token guardado.
        if (!session()->has('api_token')) {
            // Si no hay token, redirige al usuario a la página de login.
            return redirect()->route('login');
        }

        // Si hay un token, permite que la petición continúe.
        return $next($request);
    }
}
