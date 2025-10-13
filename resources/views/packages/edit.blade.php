<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Nuevo Paquete</title>
    <style>
        body { font-family: sans-serif; padding: 2rem; }
        form { display: flex; flex-direction: column; gap: 1rem; max-width: 500px; margin: auto; }
        input, select { padding: 0.5rem; }
        button { padding: 0.75rem; background: #007bff; color: white; border: none; cursor: pointer; border-radius: 5px; }
        .form-group { display: flex; flex-direction: column; }
        .error { color: red; font-size: 0.8rem; }
    </style>
</head>
<body>
     <h1>Editar Paquete</h1>

    <form method="POST" action="{{ route('packages.update', $package['id']) }}">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="address">Dirección</label>
            <input type="text" name="address" id="address" value="{{ old('address', $package['address']) }}" required>
            @error('address') <span class="error">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label for="dimensions">Dimensiones</label>
            <input type="text" name="dimensions" id="dimensions" value="{{ old('dimensions', $package['details']['dimensions']) }}" required>
            @error('dimensions') <span class="error">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label for="weight">Peso</label>
            <input type="text" name="weight" id="weight" value="{{ old('weight', $package['details']['weight']) }}" required>
            @error('weight') <span class="error">{{ $message }}</span> @enderror
        </div>

        <button type="submit">Actualizar Paquete</button>
    </form>
</body>
</html>