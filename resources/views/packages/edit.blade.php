@extends('layouts.app')

@section('content')
<style>
    .edit-form { display: flex; flex-direction: column; gap: 1rem; }
    .form-group { display: flex; flex-direction: column; }
    .form-group input, .form-group select { padding: 0.5rem; }
    .error { color: red; font-size: 0.8rem; }
</style>

<h2>Editar Paquete</h2>

<form method="POST" action="{{ route('packages.update', $package['id']) }}" class="edit-form">
    @csrf
    @method('PUT')

    <div class="form-group">
        <label for="address">Dirección</label>
        <input type="text" name="address" id="address" value="{{ old('address', $package['address']) }}" required>
        @error('address') <span class="error">{{ $message }}</span> @enderror
    </div>

    <div class="form-group">
        <label for="dimensions">Dimensiones</label>
        <input type="text" name="dimensions" id="dimensions" value="{{ old('dimensions', $package['details']->first()->dimensions ?? '') }}" required>
        @error('dimensions') <span class="error">{{ $message }}</span> @enderror
    </div>

    <div class="form-group">
        <label for="weight">Peso</label>
        <input type="text" name="weight" id="weight" value="{{ old('weight', $package['details']->first()->weight ?? '') }}" required>
        @error('weight') <span class="error">{{ $message }}</span> @enderror
    </div>

    <div class="form-group">
        <label for="package_status_id">Estado del Paquete</label>
        <select name="package_status_id" id="package_status_id" required>
            @foreach ($statuses as $status)
                <option value="{{ $status['id'] }}" {{ old('package_status_id', $package['package_status_id']) == $status['id'] ? 'selected' : '' }}>
                    {{ $status['status'] }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label for="merchandise_type_id">Tipo de Mercancía</label>
        <select name="merchandise_type_id" id="merchandise_type_id" required>
            @foreach ($types as $type)
                <option value="{{ $type['id'] }}" {{ old('merchandise_type_id', $package['details']->first()->merchandise_type_id ?? '') == $type['id'] ? 'selected' : '' }}>
                    {{ $type['type'] }}
                </option>
            @endforeach
        </select>
    </div>

    <button type="submit" class="button">Actualizar Paquete</button>
</form>
@endsection