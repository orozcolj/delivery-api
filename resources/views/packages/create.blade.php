@extends('layouts.app')

@section('content')
<style>
    .create-form { display: flex; flex-direction: column; gap: 1rem; }
    .form-group { display: flex; flex-direction: column; }
    .form-group input, .form-group select { padding: 0.5rem; }
    .error { color: red; font-size: 0.8rem; }
</style>

<h2>Crear Nuevo Paquete</h2>

<form method="POST" action="{{ route('packages.store') }}" class="create-form">
    @csrf

    <div class="form-group">
        <label for="address">Dirección</label>
        <input type="text" name="address" id="address" value="{{ old('address') }}" required>
        @error('address') <span class="error">{{ $message }}</span> @enderror
    </div>

    <div class="form-group">
        <label>Dimensiones (cm)</label>
        <div style="display: flex; gap: 0.5rem;">
            <input type="number" name="height" id="height" value="{{ old('height') }}" min="1" placeholder="Alto" required style="width: 80px;">
            <input type="number" name="length" id="length" value="{{ old('length') }}" min="1" placeholder="Largo" required style="width: 80px;">
            <input type="number" name="width" id="width" value="{{ old('width') }}" min="1" placeholder="Ancho" required style="width: 80px;">
        </div>
        @if ($errors->has('dimensions')) <span class="error">{{ $errors->first('dimensions') }}</span> @endif
    </div>
    <script>
    document.querySelector('.create-form').addEventListener('submit', function(e) {
        const height = document.getElementById('height').value;
        const length = document.getElementById('length').value;
        const width = document.getElementById('width').value;
        // Unir las dimensiones en el formato requerido
        const dimensions = `${height}x${length}x${width} cm`;
        // Crear o actualizar el input hidden
        let dimInput = document.getElementById('dimensions');
        if (!dimInput) {
            dimInput = document.createElement('input');
            dimInput.type = 'hidden';
            dimInput.name = 'dimensions';
            dimInput.id = 'dimensions';
            this.appendChild(dimInput);
        }
        dimInput.value = dimensions;
    });
    </script>

    <div class="form-group">
        <label for="weight">Peso</label>
        <input type="text" name="weight" id="weight" value="{{ old('weight') }}" required>
        @error('weight') <span class="error">{{ $message }}</span> @enderror
    </div>

    <div class="form-group">
        <label for="package_status_id">Estado del Paquete</label>
        <select name="package_status_id" id="package_status_id" required>
            @foreach ($statuses as $status)
                <option value="{{ $status['id'] }}" {{ old('package_status_id') == $status['id'] ? 'selected' : '' }}>
                    {{ $status['status'] }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label for="merchandise_type_id">Tipo de Mercancía</label>
        <select name="merchandise_type_id" id="merchandise_type_id" required>
            @foreach ($types as $type)
                <option value="{{ $type['id'] }}" {{ old('merchandise_type_id') == $type['id'] ? 'selected' : '' }}>
                    {{ $type['type'] }}
                </option>
            @endforeach
        </select>
    </div>

    <button type="submit" class="button">Guardar Paquete</button>
</form>
@endsection