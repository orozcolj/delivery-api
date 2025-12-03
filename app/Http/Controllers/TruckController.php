<?php
namespace App\Http\Controllers;
use App\Http\Requests\StoreTruckRequest;
use App\Http\Requests\UpdateTruckRequest;
use App\Models\Truck;
class TruckController extends Controller
{
    public function index()
    {
        $trucks = Truck::all();
            $query = request('plate');
            $trucks = Truck::when($query, function($q) use ($query) {
                    $q->where('plate', 'like', "%$query%");
                })
                ->get();
            return view('trucks.index', compact('trucks', 'query'));
    }
    public function create()
    {
        return view('trucks.create');
    }
    public function store(StoreTruckRequest $request)
    {
        $data = $request->validated();
        Truck::create($data);
        return redirect()->route('trucks.index')->with('success', 'Camión creado exitosamente.');
    }
    public function edit($id)
    {
        $truck = Truck::findOrFail($id);
        return view('trucks.edit', compact('truck'));
    }
    public function update(UpdateTruckRequest $request, $id)
    {
        $truck = Truck::findOrFail($id);
        $data = $request->validated();
        $truck->update($data);
        return redirect()->route('trucks.index')->with('success', 'Camión actualizado.');
    }
    public function destroy($id)
    {
        $truck = Truck::findOrFail($id);
        $truck->delete();
        return redirect()->route('trucks.index')->with('success', 'Camión eliminado.');
    }
}
