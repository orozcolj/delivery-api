# Manual Técnico

## Arquitectura General
- **Backend:** Laravel 10, API RESTful, autenticación con Sanctum.
- **Frontend:** Laravel Blade, consumo de la API vía AJAX y formularios.
- **Base de datos:** MySQL, migraciones y seeders para datos de prueba.

## Principales Componentes
- **Controladores:**
  - `PackageController`: CRUD de paquetes.
  - `TruckerController`: Gestión de conductores.
  - `TruckController`: Gestión de camiones.
  - `AuthController`: Registro y login.
  - `UserController`: Gestión de usuarios.
- **Modelos:**
  - `Package`, `Trucker`, `Truck`, `User`, `MerchandiseType`, `PackageStatus`.
- **Rutas:**
  - `routes/api.php`: Endpoints de la API.
  - `routes/web.php`: Rutas del frontend.

## Validaciones
- Validación robusta con Form Requests.
- Mensajes de error claros y feedback visual en frontend.

## Extensión de la API
- Para agregar nuevos recursos, crea el modelo, migración, controlador y actualiza `openapi.yaml`.
- Usa API Resources para respuestas consistentes.

## Pruebas
- Ejecuta `php artisan test` para validar la lógica.
- Pruebas en `tests/Feature` y `tests/Unit`.

## Documentación
- Swagger/OpenAPI en `openapi.yaml`.
- Acceso en `/api/documentation`.

## Seguridad
- Rutas protegidas con middleware `auth:sanctum`.
- Validación de datos y control de acceso por usuario.

---
Para dudas técnicas, revisa el README o abre un Issue.