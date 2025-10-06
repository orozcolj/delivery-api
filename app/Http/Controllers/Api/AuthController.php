<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Trucker;
use OpenApi\Annotations as OA;

class AuthController extends Controller
{
/**
     * @OA\Post(
     * path="/api/register",
     * tags={"Auth"},
     * summary="Registrar un nuevo usuario/conductor",
     * @OA\RequestBody(
     * required=true,
     * description="Datos para el registro",
     * @OA\JsonContent(
     * required={"first_name", "last_name", "email", "password", "password_confirmation", "document", "birth_date", "license_number", "phone"},
     * @OA\Property(property="first_name", type="string", example="Juan"),
     * @OA\Property(property="last_name", type="string", example="Pérez"),
     * @OA\Property(property="email", type="string", format="email", example="juan.perez@example.com"),
     * @OA\Property(property="password", type="string", format="password", example="password123"),
     * @OA\Property(property="password_confirmation", type="string", format="password", example="password123"),
     * @OA\Property(property="document", type="string", example="123456789"),
     * @OA\Property(property="birth_date", type="string", format="date", example="1990-01-15"),
     * @OA\Property(property="license_number", type="string", example="B1-12345"),
     * @OA\Property(property="phone", type="string", example="+573001234567"),
     * )
     * ),
     * @OA\Response(
     * response=201,
     * description="Usuario registrado exitosamente."
     * ),
     * @OA\Response(response=422, ref="#/components/responses/ValidationError")
     * )
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:45',
            'last_name' => 'required|string|max:45',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'document' => 'required|string|max:10|unique:truckers',
            'birth_date' => 'required|date',
            'license_number' => 'required|string|max:10',
            'phone' => 'required|string|max:20',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        try {
            DB::beginTransaction();

            $user = User::create([
                'name' => $request->first_name . ' ' . $request->last_name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            $trucker = Trucker::create([
                'user_id' => $user->id,
                'document' => $request->document,
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'birth_date' => $request->birth_date,
                'license_number' => $request->license_number,
                'phone' => $request->phone,
            ]);
            
            DB::commit();

            return response()->json([
                'message' => 'User registered successfully!',
                'user' => $user,
                'trucker' => $trucker
            ], 201);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'message' => 'Error during registration.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
/**
     * @OA\Post(
     * path="/api/login",
     * tags={"Auth"},
     * summary="Iniciar sesión",
     * @OA\RequestBody(
     * required=true,
     * description="Credenciales de usuario",
     * @OA\JsonContent(
     * required={"email", "password"},
     * @OA\Property(property="email", type="string", format="email", example="test@example.com"),
     * @OA\Property(property="password", type="string", format="password", example="password"),
     * )
     * ),
     * @OA\Response(
     * response=200,
     * description="Inicio de sesión exitoso, devuelve el token de acceso."
     * ),
     * @OA\Response(response=401, ref="#/components/responses/Unauthorized")
     * )
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $user = User::where('email', $request['email'])->firstOrFail();
        
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'Hi ' . $user->name,
            'accessToken' => $token,
            'token_type' => 'Bearer',
            'user' => $user,
        ]);
    }
/**
     * @OA\Post(
     * path="/api/logout",
     * tags={"Auth"},
     * summary="Cerrar sesión",
     * security={{"bearerAuth":{}}},
     * @OA\Response(
     * response=200,
     * description="Sesión cerrada exitosamente."
     * ),
     * @OA\Response(response=401, ref="#/components/responses/Unauthorized")
     * )
     */
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'Successfully logged out.']);
    }
}