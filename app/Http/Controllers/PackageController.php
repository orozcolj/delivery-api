<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PackageController extends Controller
{
    /**
     * Muestra el formulario para crear un nuevo paquete.
     */
    public function create(Request $request)
    {
        $token = $request->session()->get('api_token');

        // Necesitamos obtener los estados y tipos de mercancía para los menús desplegables.
        // NOTA: Aún no hemos creado estos endpoints en la API, pero lo haremos si es necesario.
        // Por ahora, simularemos los datos.
        
        $statuses = [
            ['id' => 1, 'status' => 'In Warehouse'],
            ['id' => 2, 'status' => 'In Transit'],
        ];

        $types = [
            ['id' => 1, 'type' => 'Electronics'],
            ['id' => 2, 'type' => 'Clothing'],
            ['id' => 3, 'type' => 'Documents'],
        ];

        return view('packages.create', [
            'statuses' => $statuses,
            'types' => $types,
        ]);
    }

    /**
     * Guarda el nuevo paquete llamando a la API.
     */
    public function store(Request $request)
    {
        // 1. Obtiene el token de la sesión.
        $token = $request->session()->get('api_token');

        // 2. Llama al endpoint de la API para crear el paquete.
        $response = Http::withToken($token)->post(url('/api/packages'), $request->all());

        // 3. Maneja la respuesta.
        if ($response->status() === 422) {
            // Si hay un error de validación, vuelve al formulario anterior
            // y pasa los errores para que la vista los pueda mostrar.
            return back()->withErrors($response->json('errors'))->withInput();
        }

        if ($response->failed()) {
            // Si ocurre cualquier otro error, simplemente vuelve con un mensaje general.
            return back()->with('error', 'Hubo un problema al crear el paquete.');
        }

        // 4. Si todo salió bien, redirige al dashboard.
        return redirect()->route('dashboard')->with('success', '¡Paquete creado exitosamente!');
    }

    public function edit(Request $request, $id)
{
    $token = $request->session()->get('api_token');
    
    // Llama a la API para obtener los datos del paquete específico.
    $response = Http::withToken($token)->get(url("/api/packages/{$id}"));
    
    if ($response->failed()) {
        // Si falla (ej: no encontrado o no autorizado), redirige al dashboard.
        return redirect()->route('dashboard')->with('error', 'No se pudo encontrar el paquete.');
    }
    
    $package = $response->json('data');
    
    // Aquí también necesitaríamos los estados y tipos, igual que en create().
    $statuses = [ ['id' => 1, 'status' => 'In Warehouse'], /* ... */ ];
    $types = [ ['id' => 1, 'type' => 'Electronics'], /* ... */ ];

    return view('packages.edit', [
        'package' => $package,
        'statuses' => $statuses,
        'types' => $types
    ]);
}

public function update(Request $request, $id)
{
    $token = $request->session()->get('api_token');

    // Llama al endpoint PUT de la API con los nuevos datos.
    $response = Http::withToken($token)->put(url("/api/packages/{$id}"), $request->all());

    if ($response->status() === 422) {
        return back()->withErrors($response->json('errors'))->withInput();
    }

    if ($response->failed()) {
        return back()->with('error', 'Hubo un problema al actualizar el paquete.');
    }

    return redirect()->route('dashboard')->with('success', '¡Paquete actualizado exitosamente!');
}

public function destroy(Request $request, $id)
{
    $token = $request->session()->get('api_token');
    
    // Llama al endpoint DELETE de la API.
    $response = Http::withToken($token)->delete(url("/api/packages/{$id}"));

    if ($response->failed()) {
        return back()->with('error', 'Hubo un problema al eliminar el paquete.');
    }

    return redirect()->route('dashboard')->with('success', 'Paquete eliminado.');
}

    
}
