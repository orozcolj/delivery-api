<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
        body { font-family: sans-serif; padding: 2rem; }
        .header { display: flex; justify-content: space-between; align-items: center; }
        form button { background: crimson; color: white; border: none; padding: 0.5rem 1rem; cursor: pointer; border-radius: 5px; }
    </style>
</head>
<body>
    <div class="header">
        <h1>¡Bienvenido a tu Dashboard!</h1>
        
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit">Cerrar Sesión</button>
        </form>
    </div>

    <p>Esta es una página protegida. Solo puedes verla si has iniciado sesión.</p>
</body>
</html>