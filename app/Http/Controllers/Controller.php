<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use OpenApi\Annotations as OA;

/**
 * @OA\Info(
 * version="1.0.0",
 * title="Delivery API Documentation",
 * description="API para gestionar una flota de entregas."
 * )
 * @OA\Server(
 * url=L5_SWAGGER_CONST_HOST,
 * description="Servidor Principal de la API"
 * )
 * @OA\SecurityScheme(
 * securityScheme="bearerAuth",
 * type="http",
 * scheme="bearer",
 * description="Autenticación por Token (Bearer)"
 * )
 * @OA\Response(
 * response="Unauthorized",
 * description="No autenticado. Falta el token o es inválido.",
 * @OA\JsonContent(
 * @OA\Property(property="message", type="string", example="Unauthenticated.")
 * )
 * )
 * @OA\Response(
 * response="Forbidden",
 * description="Acceso denegado. No tiene permisos para acceder a este recurso."
 * )
 * @OA\Response(
 * response="ValidationError",
 * description="Error de validación. Los datos enviados son incorrectos.",
 * )
 * @OA\Response(
 * response="NotFound",
 * description="El recurso solicitado no fue encontrado."
 * )
 */
class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
}