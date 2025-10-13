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
        table { width: 100%; border-collapse: collapse; margin-top: 2rem; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        .button { display: inline-block; padding: 0.5rem 1rem; background: #28a745; color: white; text-decoration: none; border-radius: 5px; }
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

    <hr>

    <h2>Mis Paquetes</h2>
    <a href="#" class="button">Crear Nuevo Paquete</a>

    <table>
        <thead>
            <tr>
                <th>Dirección</th>
                <th>Estado</th>
                <th>Dimensiones</th>
                <th>Peso</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($packages as $package)
                <tr>
                    <td>{{ $package['address'] }}</td>
                    <td>{{ $package['status'] }}</td>
                    <td>{{ $package['details']['dimensions'] ?? 'N/A' }}</td>
                    <td>{{ $package['details']['weight'] ?? 'N/A' }}</td>
                    <td>
                        <a href="#">Editar</a> | <a href="#">Eliminar</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">No tienes paquetes asignados.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>