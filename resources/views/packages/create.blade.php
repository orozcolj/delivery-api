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
    <h1>Crear Nuevo Paquete</h1>

    <form method="POST" action="{{ route('packages.store') }}">
        @csrf

        <div class="form-group">
            <label for="address">Dirección</label>
            <input type="text" name="address" id="address" value="{{ old('address') }}" required>
            @error('address') <span class="error">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label for="dimensions">Dimensiones</label>
            <input type="text" name="dimensions" id="dimensions" value="{{ old('dimensions') }}" required>
            @error('dimensions') <span class="error">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label for="weight">Peso</label>
            <input type="text" name="weight" id="weight" value="{{ old('weight') }}" required>
            @error('weight') <span class="error">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label for="package_status_id">Estado del Paquete</label>
            <select name="package_status_id" id="package_status_id" required>
                @foreach ($statuses as $status)
                    <option value="{{ $status['id'] }}">{{ $status['status'] }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="merchandise_type_id">Tipo de Mercancía</label>
            <select name="merchandise_type_id" id="merchandise_type_id" required>
                @foreach ($types as $type)
                    <option value="{{ $type['id'] }}">{{ $type['type'] }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit">Guardar Paquete</button>
    </form>
</body>
</html>