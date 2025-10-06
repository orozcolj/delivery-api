<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Package;
use App\Models\PackageDetail;
use App\Http\Requests\StorePackageRequest;
use App\Http\Requests\UpdatePackageRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PackageController extends Controller
{
    public function index(Request $request)
    {
        $trucker = $request->user()->trucker;
        
        $packages = Package::with('details.merchandiseType', 'packageStatus')
                            ->where('trucker_id', $trucker->id)
                            ->paginate(10);

        return response()->json($packages);
    }

    public function store(StorePackageRequest $request)
    {
        try {
            DB::beginTransaction();
            
            $trucker = $request->user()->trucker;

            $package = Package::create([
                'address' => $request->address,
                'package_status_id' => $request->package_status_id,
                'trucker_id' => $trucker->id,
            ]);

            PackageDetail::create([
                'package_id' => $package->id,
                'dimensions' => $request->dimensions,
                'weight' => $request->weight,
                'merchandise_type_id' => $request->merchandise_type_id,
            ]);
            
            DB::commit();

            return response()->json([
                'message' => 'Package created successfully.',
                'package' => $package->load('details.merchandiseType', 'packageStatus')
            ], 201);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Error creating package: ' . $e->getMessage()], 500);
        }
    }

    public function show(Package $package)
    {
        if (auth()->user()->trucker->id !== $package->trucker_id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        return response()->json($package->load('details.merchandiseType', 'packageStatus'));
    }

    public function update(UpdatePackageRequest $request, Package $package)
    {
        if (auth()->user()->trucker->id !== $package->trucker_id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $package->update($request->only(['address', 'package_status_id']));
        
        if ($package->details->first()) {
            $package->details->first()->update($request->only(['dimensions', 'weight', 'merchandise_type_id']));
        }
        
        return response()->json([
            'message' => 'Package updated successfully.',
            'package' => $package->load('details.merchandiseType', 'packageStatus')
        ]);
    }

    public function destroy(Package $package)
    {
        if (auth()->user()->trucker->id !== $package->trucker_id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $package->delete();

        return response()->json(['message' => 'Package deleted successfully.']);
    }
}