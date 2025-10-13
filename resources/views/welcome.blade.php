<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Delivery API Project</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <style>
        body {
            font-family: 'Figtree', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-color: #f3f4f6;
            margin: 0;
        }
        .welcome-container {
            text-align: center;
            background: white;
            padding: 3rem;
            border-radius: 12px;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        }
        h1 {
            font-size: 2.25rem;
            font-weight: 600;
            color: #111827;
        }
        p {
            margin-top: 1rem;
            color: #4b5563;
        }
        .actions {
            margin-top: 2rem;
            display: flex;
            gap: 1rem;
            justify-content: center;
        }
        .button {
            display: inline-block;
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            transition: background-color 0.2s;
        }
        .button-primary {
            background-color: #007bff;
            color: white;
        }
        .button-primary:hover {
            background-color: #0056b3;
        }
        .button-secondary {
            background-color: #6c757d;
            color: white;
        }
        .button-secondary:hover {
            background-color: #5a6268;
        }
    </style>
</head>
<body class="antialiased">
    <div class="welcome-container">
        <h1>Bienvenido al Proyecto Delivery API</h1>
        <p>Una solución completa para la gestión de entregas.</p>
        
        <div class="actions">
            @if (Route::has('login'))
                <a href="{{ route('login') }}" class="button button-primary">Iniciar Sesión</a>
            @endif

            @if (Route::has('register'))
                <a href="{{ route('register') }}" class="button button-secondary">Registrarse</a>
            @endif
        </div>
    </div>
</body>
</html>
