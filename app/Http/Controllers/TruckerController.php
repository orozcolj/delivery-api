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
        return view('truckers.index', compact('truckers'));
    }
    public function create()
    {
        return view('truckers.create');
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
        return redirect()->route('truckers.index')->with('success', 'Camionero creado exitosamente.');
    }
    public function edit($id)
    {
        $trucker = Trucker::with('user')->findOrFail($id);
        return view('truckers.edit', compact('trucker'));
    }
    public function update(UpdateDriverRequest $request, $id)
    {
        $trucker = Trucker::findOrFail($id);
        $data = $request->validated();
        $trucker->update($data);
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
