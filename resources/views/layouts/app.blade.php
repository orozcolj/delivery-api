<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delivery App</title>
    <style>
        body { font-family: sans-serif; margin: 0; }
        .container { max-width: 1000px; margin: 2rem auto; padding: 0 1rem; }
        .header { display: flex; justify-content: space-between; align-items: center; padding: 1rem; background-color: #f8f9fa; border-bottom: 1px solid #dee2e6; }
        form button, .button { display: inline-block; padding: 0.5rem 1rem; background: #007bff; color: white; border: none; text-decoration: none; border-radius: 5px; cursor: pointer; }
        .button-danger { background-color: crimson; }
        table { width: 100%; border-collapse: collapse; margin-top: 1rem; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <header class="header">
        <a href="{{ route('dashboard') }}"><h2>Delivery App</h2></a>
        <nav>
            @auth
                <span>Hola, {{ auth()->user()->name }}</span>
                <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                    @csrf
                    <button type="submit" class="button-danger">Cerrar Sesión</button>
                </form>
            @endauth
        </nav>
    </header>

    <main class="container">
        @yield('content')
    </main>
</body>
</html>