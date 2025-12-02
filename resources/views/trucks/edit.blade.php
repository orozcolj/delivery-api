@extends('layouts.app')
@section('content')
<div class="container">
    <h1>Editar camión</h1>
    <form action="{{ route('trucks.update', $truck->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="plate" class="form-label">Placa</label>
            <input type="text" name="plate" class="form-control" required value="{{ old('plate', $truck->plate) }}">
        </div>
        <div class="mb-3">
            <label for="model" class="form-label">Modelo</label>
            <input type="text" name="model" class="form-control" required value="{{ old('model', $truck->model) }}">
        </div>
        <div class="mb-3">
            <label for="capacity" class="form-label">Capacidad</label>
            <input type="number" name="capacity" class="form-control" required value="{{ old('capacity', $truck->capacity) }}">
        </div>
        <button type="submit" class="btn btn-success">Actualizar</button>
        <a href="{{ route('trucks.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
