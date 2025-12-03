<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PackageController extends Controller
{
    /**
     * Asigna un paquete disponible a un camionero
     */
    public function assign(Request $request)
    {
        $request->validate([
            'package_id' => 'required|exists:packages,id',
            'trucker_id' => 'required|exists:truckers,id',
        ]);
        $package = \App\Models\Package::findOrFail($request->package_id);
        if ($package->trucker_id) {
            return back()->with('error', 'El paquete ya está asignado a un camionero.');
        }
        $package->trucker_id = $request->trucker_id;
        $package->save();
        return back()->with('success', 'Paquete asignado correctamente.');
    }
    /**
     * Muestra todos los paquetes para el admin.
     */
    public function index()
    {
        $query = request('id');
        $packages = \App\Models\Package::with(['trucker', 'packageStatus'])
            ->when($query, function($q) use ($query) {
                $q->where('id', $query);
            })
            ->latest()->paginate(20);
        return view('packages.index', compact('packages', 'query'));
    }
    /**
     * Muestra el formulario para crear un nuevo paquete.
     */
    public function create(Request $request)
    {
        $statuses = \App\Models\PackageStatus::all();
        $types = \App\Models\MerchandiseType::all();
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
        $validated = $request->validate([
            'address' => 'required|string|max:100',
            'package_status_id' => 'required|exists:package_statuses,id',
            'dimensions' => 'required|string|max:45',
            'weight' => 'required|string|max:45',
            'merchandise_type_id' => 'required|exists:merchandise_types,id',
        ]);

        $user = auth()->user();
        $trucker = $user->trucker;
        if (!$trucker) {
            return back()->with('error', 'No tienes permisos para crear paquetes.');
        }

        $package = \App\Models\Package::create([
            'address' => $validated['address'],
            'trucker_id' => $trucker->id,
            'package_status_id' => $validated['package_status_id'],
        ]);

        $package->details()->create([
            'dimensions' => $validated['dimensions'],
            'weight' => $validated['weight'],
            'merchandise_type_id' => $validated['merchandise_type_id'],
        ]);

        return redirect()->route('dashboard')->with('success', '¡Paquete creado exitosamente!');
    }

    public function edit(Request $request, $id)
{
    $package = \App\Models\Package::with(['details', 'packageStatus'])->findOrFail($id);
    $statuses = \App\Models\PackageStatus::all();
    $types = \App\Models\MerchandiseType::all();

    return view('packages.edit', [
        'package' => $package,
        'statuses' => $statuses,
        'types' => $types
    ]);
}

public function update(Request $request, $id)
{
    $package = \App\Models\Package::findOrFail($id);
    $package->update($request->only(['address', 'package_status_id']));
    $details = $package->details->first();
    if ($details) {
        $details->update($request->only(['dimensions', 'weight', 'merchandise_type_id']));
    }
    return redirect()->route('dashboard')->with('success', '¡Paquete actualizado exitosamente!');
}

public function destroy(Request $request, $id)
{
    $package = \App\Models\Package::findOrFail($id);
    $package->delete();
    return redirect()->route('dashboard')->with('success', '¡Paquete eliminado exitosamente!');
}

    
}
