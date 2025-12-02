@extends('layouts.app')
@section('content')
<div class="container">
    <h1>Agregar conductor</h1>
    <form action="{{ route('drivers.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="first_name" class="form-label">Nombre</label>
            <input type="text" name="first_name" class="form-control" required value="{{ old('first_name') }}">
        </div>
        <div class="mb-3">
            <label for="last_name" class="form-label">Apellido</label>
            <input type="text" name="last_name" class="form-control" required value="{{ old('last_name') }}">
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" class="form-control" required value="{{ old('email') }}">
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Contraseña</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="password_confirmation" class="form-label">Confirmar contraseña</label>
            <input type="password" name="password_confirmation" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="document" class="form-label">Documento</label>
            <input type="text" name="document" class="form-control" required value="{{ old('document') }}">
        </div>
        <div class="mb-3">
            <label for="birth_date" class="form-label">Fecha de nacimiento</label>
            <input type="date" name="birth_date" class="form-control" required value="{{ old('birth_date') }}">
        </div>
        <div class="mb-3">
            <label for="license_number" class="form-label">Número de licencia</label>
            <input type="text" name="license_number" class="form-control" required value="{{ old('license_number') }}">
        </div>
        <div class="mb-3">
            <label for="phone" class="form-label">Teléfono</label>
            <input type="text" name="phone" class="form-control" required value="{{ old('phone') }}">
        </div>
        <button type="submit" class="btn btn-success">Guardar</button>
        <a href="{{ route('drivers.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
