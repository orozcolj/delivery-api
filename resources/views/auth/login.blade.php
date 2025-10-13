@extends('layouts.app')

@section('content')
<style>
    /* Estilos específicos para el formulario de login */
    .login-form {
        max-width: 400px;
        margin: 2rem auto;
        padding: 2rem;
        border: 1px solid #ccc;
        border-radius: 8px;
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }
</style>

<form method="POST" action="{{ route('login') }}" class="login-form">
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
@endsection