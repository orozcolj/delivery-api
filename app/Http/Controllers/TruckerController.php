<?php
namespace App\Http\Controllers;
use App\Http\Requests\StoreDriverRequest;
use App\Http\Requests\UpdateDriverRequest;
use App\Models\Trucker;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
class TruckerController extends Controller
{
    public function index()
    {
        $truckers = Trucker::with('user')->get();
            $query = request('document');
            $truckers = Trucker::with('user')
                ->when($query, function($q) use ($query) {
                    $q->where('document', 'like', "%$query%");
                })
                ->get();
            return view('truckers.index', compact('truckers', 'query'));
    }
    public function create()
    {
        $assignedTruckIds = \App\Models\Truck::whereHas('truckers')->pluck('id')->toArray();
        $trucks = \App\Models\Truck::whereNotIn('id', $assignedTruckIds)->get();
        return view('truckers.create', compact('trucks'));
    }
    public function store(StoreDriverRequest $request)
    {
        $data = $request->validated();
        $user = User::create([
            'name' => $data['first_name'] . ' ' . $data['last_name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => 'driver',
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
        ]);
        $trucker = Trucker::create([
            'user_id' => $user->id,
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'document' => $data['document'],
            'birth_date' => $data['birth_date'],
            'license_number' => $data['license_number'],
            'phone' => $data['phone'],
        ]);
        if ($request->filled('truck_id')) {
            $trucker->trucks()->attach($request->truck_id);
        }
        return redirect()->route('truckers.index')->with('success', 'Camionero creado exitosamente.');
    }
    public function edit($id)
    {
        $trucker = Trucker::with('user', 'trucks')->findOrFail($id);
        $assignedTruckIds = \App\Models\Truck::whereHas('truckers')->pluck('id')->toArray();
        // Permitir que el camión actualmente asignado al trucker aparezca en el select
        $currentTruckId = $trucker->trucks->first() ? $trucker->trucks->first()->id : null;
        $trucks = \App\Models\Truck::whereNotIn('id', $assignedTruckIds)
            ->orWhere('id', $currentTruckId)
            ->get();
        return view('truckers.edit', compact('trucker', 'trucks', 'currentTruckId'));
    }
    public function update(UpdateDriverRequest $request, $id)
    {
        $trucker = Trucker::findOrFail($id);
        $data = $request->validated();
        $trucker->update($data);
        // Actualizar camión asignado
        if ($request->filled('truck_id')) {
            $trucker->trucks()->sync([$request->truck_id]);
        }
        if ($request->filled('password')) {
            $trucker->user->update([
                'password' => Hash::make($request->password)
            ]);
        }
        return redirect()->route('truckers.index')->with('success', 'Camionero actualizado.');
    }
    public function destroy($id)
    {
        $trucker = Trucker::findOrFail($id);
        $trucker->user->delete();
        $trucker->delete();
        return redirect()->route('truckers.index')->with('success', 'Camionero eliminado.');
    }
}
