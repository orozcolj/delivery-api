<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\Truck;
use App\Http\Resources\TruckResource;
use Illuminate\Http\Request;
class TruckController extends Controller
{
    public function index(Request $request)
    {
        $trucks = Truck::paginate(10);
        return TruckResource::collection($trucks);
    }
}
