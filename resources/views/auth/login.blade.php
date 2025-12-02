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

<form method="POST" action="{{ route('login') }}" class="login-form" id="login-form">
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
        <span class="error" style="color:red;font-size:0.8rem;"></span>
    </div>

    <div>
        <label for="password">Contraseña</label>
        <input type="password" name="password" id="password" required>
        <span class="error" style="color:red;font-size:0.8rem;"></span>
    </div>

    <button type="submit">
        Entrar
    </button>
    <script>
    // Validaciones en tiempo real y feedback visual
    const form = document.getElementById('login-form');
    const showError = (input, message) => {
        let errorSpan = input.parentElement.querySelector('.error');
        if (errorSpan) errorSpan.textContent = message;
    };
    const clearError = (input) => {
        let errorSpan = input.parentElement.querySelector('.error');
        if (errorSpan) errorSpan.textContent = '';
    };
    form.addEventListener('input', function(e) {
        const target = e.target;
        if (target.value.trim() === '') {
            showError(target, 'Este campo es obligatorio');
        } else {
            clearError(target);
        }
        if (target.name === 'email' && target.value.trim() !== '') {
            const emailRegex = /^[^@\s]+@[^@\s]+\.[^@\s]+$/;
            if (!emailRegex.test(target.value)) {
                showError(target, 'Email inválido');
            } else {
                clearError(target);
            }
        }
    });
    form.addEventListener('submit', function(e) {
        let valid = true;
        Array.from(form.elements).forEach(input => {
            if (input.tagName === 'INPUT' && input.type !== 'submit') {
                if (input.value.trim() === '') {
                    showError(input, 'Este campo es obligatorio');
                    valid = false;
                }
                if (input.name === 'email' && input.value.trim() !== '') {
                    const emailRegex = /^[^@\s]+@[^@\s]+\.[^@\s]+$/;
                    if (!emailRegex.test(input.value)) {
                        showError(input, 'Email inválido');
                        valid = false;
                    }
                }
            }
        });
        if (!valid) {
            e.preventDefault();
            return;
        }
        // Feedback visual de envío
        const btn = form.querySelector('button[type="submit"]');
        btn.disabled = true;
        btn.textContent = 'Entrando...';
    });
    </script>
</form>
 <div style="text-align: center; margin-top: 1rem;">
        <a href="{{ route('register') }}">¿No tienes una cuenta? Regístrate aquí</a>
    </div>
@endsection