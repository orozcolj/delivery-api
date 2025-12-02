<?php
namespace App\Http\Controllers;
use App\Http\Requests\StoreDriverRequest;
use App\Http\Requests\UpdateDriverRequest;
use App\Models\Trucker;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
class DriverController extends Controller
{
    public function index()
    {
        $drivers = Trucker::with('user')->get();
        return view('drivers.index', compact('drivers'));
    }
    public function create()
    {
        return view('drivers.create');
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
        Trucker::create([
            'user_id' => $user->id,
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'document' => $data['document'],
            'birth_date' => $data['birth_date'],
            'license_number' => $data['license_number'],
            'phone' => $data['phone'],
        ]);
        return redirect()->route('drivers.index')->with('success', 'Conductor creado exitosamente.');
    }
    public function edit($id)
    {
        $driver = Trucker::with('user')->findOrFail($id);
        return view('drivers.edit', compact('driver'));
    }
    public function update(UpdateDriverRequest $request, $id)
    {
        $driver = Trucker::findOrFail($id);
        $data = $request->validated();
        $driver->update($data);
        if ($request->filled('password')) {
            $driver->user->update([
                'password' => Hash::make($request->password)
            ]);
        }
        return redirect()->route('drivers.index')->with('success', 'Conductor actualizado.');
    }
    public function destroy($id)
    {
        $driver = Trucker::findOrFail($id);
        $driver->user->delete();
        $driver->delete();
        return redirect()->route('drivers.index')->with('success', 'Conductor eliminado.');
    }
}
