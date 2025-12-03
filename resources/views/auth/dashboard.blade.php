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
</+    @if(isset($error))
        <div style="color: red; font-weight: bold;">{{ $error }}</div>
    @endif

    @if(isset($trucker))
        <h2>Datos del Conductor</h2>
        <ul>
            <li><strong>Nombre:</strong> {{ $trucker->first_name }} {{ $trucker->last_name }}</li>
            <li><strong>Documento:</strong> {{ $trucker->document }}</li>
            <li><strong>Licencia:</strong> {{ $trucker->license_number }}</li>
            <li><strong>Teléfono:</strong> {{ $trucker->phone }}</li>
            <li><strong>Email:</strong> {{ $trucker->user->email }}</li>
        </ul>

        <h2>Paquetes Asignados</h2>
        @if($packages->count())
            <table border="1" cellpadding="6" style="border-collapse:collapse;">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Dirección</th>
                        <th>Estado</th>
                        <th>Detalles</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($packages as $package)
                        <tr>
                            <td>{{ $package->id }}</td>
                            <td>{{ $package->address }}</td>
                            <td>{{ $package->packageStatus->status ?? 'Sin estado' }}</td>
                            <td>
                                @foreach($package->details as $detail)
                                    <div>
                                        <strong>Dimensiones:</strong> {{ $detail->dimensions }}<br>
                                        <strong>Peso:</strong> {{ $detail->weight }}<br>
                                    </div>
                                @endforeach
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>No tienes paquetes asignados.</p>
        @endif
    @endif
</body>
</html>