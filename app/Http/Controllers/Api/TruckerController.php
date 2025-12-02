<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\Trucker;
use App\Http\Resources\TruckerResource;
use Illuminate\Http\Request;
class TruckerController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->get('per_page', 10);
        $truckers = Trucker::with('user')->paginate($perPage);
        return TruckerResource::collection($truckers);
    }
}
