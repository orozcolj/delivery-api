<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Iniciar Sesión</title>
	<style>
		body { font-family: sans-serif; display: grid; place-content: center; min-height: 100vh; }
		form { display: flex; flex-direction: column; gap: 1rem; border: 1px solid #ccc; padding: 2rem; border-radius: 8px; }
		input { padding: 0.5rem; }
		button { padding: 0.5rem; background: #007bff; color: white; border: none; cursor: pointer; }
	</style>
</head>
<body>
	<form method="POST" action="{{ route('login') }}">
		@csrf
		<h2>Iniciar Sesión</h2>
        @if ($errors->any())
    <div style="color: red; margin-bottom: 1rem;">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif 
		<div>
			<label for="email">Correo Electrónico</label>
			<input type="email" name="email" id="email" required autofocus>
		</div>
		<div>
			<label for="password">Contraseña</label>
			<input type="password" name="password" id="password" required>
		</div>
		<button type="submit">
			Entrar
		</button>
	</form>
</body>
</html>