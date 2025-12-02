    @if (session('success'))
        <div style="color: green; margin-bottom: 1rem;">
            {{ session('success') }}
        </div>
    @endif
    @if (session('error'))
        <div style="color: red; margin-bottom: 1rem;">
            {{ session('error') }}
        </div>
    @endif
@extends('layouts.app')

@section('content')
<style>
    .register-form { max-width: 500px; margin: 2rem auto; padding: 2rem; border: 1px solid #ccc; border-radius: 8px; display: flex; flex-direction: column; gap: 1rem; }
    .form-group { display: flex; flex-direction: column; }
    .form-group input { padding: 0.5rem; }
    .error { color: red; font-size: 0.8rem; }
</style>

<form method="POST" action="{{ route('register') }}" class="register-form">
    @csrf
    <h2>Crear Cuenta de Conductor</h2>

    <div class="form-group">
        <label for="first_name">Nombre</label>
        <input type="text" id="first_name" name="first_name" value="{{ old('first_name') }}" required autofocus>
        @error('first_name') <span class="error">{{ $message }}</span> @enderror
    </div>

    <div class="form-group">
        <label for="last_name">Apellido</label>
        <input type="text" id="last_name" name="last_name" value="{{ old('last_name') }}" required>
        @error('last_name') <span class="error">{{ $message }}</span> @enderror
    </div>

    <div class="form-group">
        <label for="email">Correo Electrónico</label>
        <input type="email" id="email" name="email" value="{{ old('email') }}" required>
        @error('email') <span class="error">{{ $message }}</span> @enderror
    </div>
    
    <div class="form-group">
        <label for="password">Contraseña</label>
        <input type="password" id="password" name="password" required>
        @error('password') <span class="error">{{ $message }}</span> @enderror
    </div>

    <div class="form-group">
        <label for="password_confirmation">Confirmar Contraseña</label>
        <input type="password" id="password_confirmation" name="password_confirmation" required>
    </div>

    <div class="form-group">
        <label for="document">Documento</label>
        <input type="text" id="document" name="document" value="{{ old('document') }}" required>
        @error('document') <span class="error">{{ $message }}</span> @enderror
    </div>

    <div class="form-group">
        <label for="birth_date">Fecha de Nacimiento</label>
        <input type="date" id="birth_date" name="birth_date" value="{{ old('birth_date') }}" required>
        @error('birth_date') <span class="error">{{ $message }}</span> @enderror
    </div>

    <div class="form-group">
        <label for="license_number">Número de Licencia</label>
        <input type="text" id="license_number" name="license_number" value="{{ old('license_number') }}" required>
        @error('license_number') <span class="error">{{ $message }}</span> @enderror
    </div>

    <div class="form-group">
        <label for="phone">Teléfono</label>
        <input type="tel" id="phone" name="phone" value="{{ old('phone') }}" required>
        @error('phone') <span class="error">{{ $message }}</span> @enderror
    </div>

    <button type="submit" class="button">Registrarse</button>
</form>
@endsection