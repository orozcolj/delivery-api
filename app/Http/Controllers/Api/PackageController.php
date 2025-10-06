<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Package;
use App\Models\PackageDetail;
use App\Http\Requests\StorePackageRequest;
use App\Http\Requests\UpdatePackageRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use OpenApi\Annotations as OA;
use App\Http\Resources\PackageResource;

class PackageController extends Controller
{
    /**
     * @OA\Get(
     * path="/api/packages",
     * tags={"Packages"},
     * summary="Listar los paquetes del conductor autenticado",
     * security={{"bearerAuth":{}}},
     * @OA\Response(
     * response=200,
     * description="Lista de paquetes paginada."
     * ),
     * @OA\Response(response=401, ref="#/components/responses/Unauthorized")
     * )
     */
    public function index(Request $request)
    {
        $trucker = $request->user()->trucker;
        
        $packages = Package::with('details.merchandiseType', 'packageStatus')
                            ->where('trucker_id', $trucker->id)
                            ->paginate(10);

        return PackageResource::collection($packages);
    }

    /**
     * @OA\Post(
     * path="/api/packages",
     * tags={"Packages"},
     * summary="Crear un nuevo paquete",
     * security={{"bearerAuth":{}}},
     * @OA\RequestBody(
     * required=true,
     * description="Datos del nuevo paquete",
     * @OA\JsonContent(
     * required={"address", "package_status_id", "dimensions", "weight", "merchandise_type_id"},
     * @OA\Property(property="address", type="string", example="Carrera 10 #20-30"),
     * @OA\Property(property="package_status_id", type="integer", example=1),
     * @OA\Property(property="dimensions", type="string", example="Medium"),
     * @OA\Property(property="weight", type="string", example="10 kg"),
     * @OA\Property(property="merchandise_type_id", type="integer", example=1)
     * )
     * ),
     * @OA\Response(response=201, description="Paquete creado exitosamente."),
     * @OA\Response(response=401, ref="#/components/responses/Unauthorized"),
     * @OA\Response(response=422, ref="#/components/responses/ValidationError")
     * )
     */
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
    'package' => new PackageResource($package->load('details.merchandiseType', 'packageStatus'))
], 201);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Error creating package: ' . $e->getMessage()], 500);
        }
    }

    /**
     * @OA\Get(
     * path="/api/packages/{id}",
     * tags={"Packages"},
     * summary="Mostrar un paquete específico",
     * security={{"bearerAuth":{}}},
     * @OA\Parameter(
     * name="id",
     * in="path",
     * required=true,
     * description="ID del paquete",
     * @OA\Schema(type="integer")
     * ),
     * @OA\Response(response=200, description="Datos del paquete."),
     * @OA\Response(response=401, ref="#/components/responses/Unauthorized"),
     * @OA\Response(response=403, ref="#/components/responses/Forbidden"),
     * @OA\Response(response=404, ref="#/components/responses/NotFound")
     * )
     */
    public function show(Package $package)
    {
        if (auth()->user()->trucker->id !== $package->trucker_id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        return new PackageResource($package->load('details.merchandiseType', 'packageStatus'));
    }

    /**
     * @OA\Put(
     * path="/api/packages/{id}",
     * tags={"Packages"},
     * summary="Actualizar un paquete",
     * security={{"bearerAuth":{}}},
     * @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     * @OA\RequestBody(description="Datos a actualizar (pueden ser parciales)", @OA\JsonContent()),
     * @OA\Response(response=200, description="Paquete actualizado exitosamente."),
     * @OA\Response(response=401, ref="#/components/responses/Unauthorized"),
     * @OA\Response(response=403, ref="#/components/responses/Forbidden"),
     * @OA\Response(response=422, ref="#/components/responses/ValidationError")
     * )
     */
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
    'package' => new PackageResource($package->load('details.merchandiseType', 'packageStatus'))
]);
    }
/**
     * @OA\Delete(
     * path="/api/packages/{id}",
     * tags={"Packages"},
     * summary="Eliminar un paquete",
     * security={{"bearerAuth":{}}},
     * @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     * @OA\Response(response=200, description="Paquete eliminado exitosamente."),
     * @OA\Response(response=401, ref="#/components/responses/Unauthorized"),
     * @OA\Response(response=403, ref="#/components/responses/Forbidden")
     * )
     */
    public function destroy(Package $package)
    {
        if (auth()->user()->trucker->id !== $package->trucker_id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $package->delete();

        return response()->json(['message' => 'Package deleted successfully.']);
    }
}