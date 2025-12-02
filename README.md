API REST de Entregas con Laravel 10
Este proyecto es una API REST segura construida con Laravel 10, diseñada para gestionar una flota de entregas. Incluye un backend robusto con autenticación, validación, pruebas automatizadas y documentación, así como un frontend simple, también en Laravel, para su consumo.

✨ Características Principales
Autenticación Segura: Implementación de autenticación basada en tokens con Laravel Sanctum.

CRUD Completo: Gestión completa de Paquetes (Packages) con validación robusta mediante Form Requests.

Aislamiento de Datos: Un conductor (Trucker) solo puede acceder y gestionar sus propios paquetes.

Respuestas Consistentes: Uso de API Resources para estandarizar las respuestas JSON y controlar la información expuesta.

Base de Datos de Prueba: Seeders y Factories para poblar la base de datos con datos de prueba realistas.

Pruebas Automatizadas: Suite de pruebas con PHPUnit que garantiza la fiabilidad y seguridad de los endpoints.

Documentación Interactiva: Documentación completa de la API generada con Swagger/OpenAPI, permitiendo probar los endpoints directamente desde el navegador.

Frontend de Consumo: Una aplicación web simple construida con Laravel Blade que consume la propia API.

⚙️ Requisitos Previos
Antes de empezar, asegúrate de tener instalado en tu sistema:

PHP >= 8.1

Composer

Un servidor de base de datos (MySQL es el recomendado)

Git

Un cliente de API como Postman o Insomnia

🚀 Guía de Instalación y Puesta en Marcha
Sigue estos pasos para poner en funcionamiento el proyecto en tu entorno local.

1. Clonar el Repositorio
Abre tu terminal y clona el proyecto desde GitHub.

Bash

git clone https://github.com/TU_USUARIO/delivery-api-en.git
cd delivery-api-en

2. Instalar Dependencias
Instala todas las dependencias de PHP con Composer.

Bash

composer install

3. Configurar el Entorno
Copia el archivo de ejemplo para las variables de entorno.

Bash

cp .env.example .env
Ahora, abre el archivo .env y configura la conexión a tu base de datos. Primero, crea una base de datos vacía (por ejemplo, delivery_api_en) y luego actualiza estas líneas:

Fragmento de código

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=delivery_api_en
DB_USERNAME=root
DB_PASSWORD=


4. Generar la Clave de la Aplicación
Este es un paso crucial para la seguridad de Laravel.

Bash

php artisan key:generate

5. Crear la Base de Datos y Poblarla
Este comando ejecutará todas las migraciones para crear la estructura de la base de datos y luego usará los seeders para llenarla con datos de prueba.

Bash

php artisan migrate:fresh --seed
Nota: Esto creará 11 usuarios de prueba. Uno de ellos siempre será test@example.com con la contraseña password, listo para ser usado.

📦 Uso de la Aplicación
Iniciar el Servidor
Para iniciar la aplicación, ejecuta:

Bash

php artisan serve
La aplicación estará disponible en http://127.0.0.1:8000.

Ejecutar las Pruebas
Para verificar que toda la lógica del backend funciona correctamente, puedes ejecutar la suite de pruebas automatizadas:

Bash

php artisan test
📚 Cómo Usar y Probar la API
La mejor manera de explorar la API es a través de la documentación interactiva.

1. Ver la Documentación de Swagger
Con el servidor corriendo, abre tu navegador y ve a:
http://127.0.0.1:8000/api/documentation

Desde esta página, podrás ver todos los endpoints, los datos que requieren y las respuestas que devuelven. ¡Incluso puedes probarlos directamente!

2. Proceso de Autenticación (Ejemplo con Postman)

A. Registrar un Nuevo Usuario
Endpoint: POST /api/register

Body (raw, JSON): Envía los datos del nuevo conductor.

JSON

{
    "first_name": "Carlos",
    "last_name": "Ramirez",
    "email": "carlos.ramirez@example.com",
    "password": "password123",
    "password_confirmation": "password123",
    "document": "987654321",
    "birth_date": "1995-05-20",
    "license_number": "C1-54321",
    "phone": "3109876543"
}

B. Iniciar Sesión para Obtener un Token
Endpoint: POST /api/login

Body (raw, JSON): Usa las credenciales del usuario de prueba.

JSON

{
    "email": "test@example.com",
    "password": "password"
}
Respuesta: La API te devolverá un accessToken. Copia este token.

C. Acceder a Rutas Protegidas
Para llamar a cualquier endpoint que requiera autenticación (como el CRUD de paquetes), debes incluir el token en los encabezados (Headers) de tu petición:

Header 1:

Key: Authorization

Value: Bearer TU_TOKEN_COPIADO_AQUI

Header 2:

Key: Accept

Value: application/json

Con estos encabezados, ya puedes hacer peticiones como GET /api/packages para ver la lista de paquetes del usuario.

3. Probar el Frontend
También puedes probar la aplicación web directamente desde el navegador:

Página de Login: http://127.0.0.1:8000/login

Página de Registro: http://127.0.0.1:8000/register

Inicia sesión con el usuario de prueba para acceder al dashboard y gestionar los paquetes.