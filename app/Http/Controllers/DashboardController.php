<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http; 

class DashboardController extends Controller
{
    /**
     * Muestra el dashboard con la lista de paquetes del usuario.
     */
    public function index(Request $request)
    {
        $user = auth()->user();
        if ($user->role === 'admin') {
            $usersCount = \App\Models\User::count();
            $truckersCount = \App\Models\Trucker::count();
            $trucksCount = \App\Models\Truck::count();
            $packagesCount = \App\Models\Package::count();
            $latestPackages = \App\Models\Package::with(['trucker', 'packageStatus'])->latest()->take(10)->get();
            return view('admin-dashboard', compact('usersCount', 'truckersCount', 'trucksCount', 'packagesCount', 'latestPackages'));
        } else {
            // Mostrar dashboard de trucker
            $trucker = $user->trucker;
            if (!$trucker) {
                return view('auth.dashboard')->with('error', 'No tienes perfil de conductor asociado.');
            }
            $packages = $trucker->packages()->with(['packageStatus', 'details'])->latest()->get();
            return view('auth.dashboard', compact('trucker', 'packages'));
        }
    }
}