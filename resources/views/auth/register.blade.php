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

<form method="POST" action="{{ route('register') }}" class="register-form" id="register-form">
    @csrf
    <h2>Crear Cuenta de Conductor</h2>

    <div class="form-group">
        <label for="first_name">Nombre</label>
        <input type="text" id="first_name" name="first_name" value="{{ old('first_name') }}" required autofocus>
        <span class="error"></span>
        @error('first_name') <span class="error">{{ $message }}</span> @enderror
    </div>

    <div class="form-group">
        <label for="last_name">Apellido</label>
        <input type="text" id="last_name" name="last_name" value="{{ old('last_name') }}" required>
        <span class="error"></span>
        @error('last_name') <span class="error">{{ $message }}</span> @enderror
    </div>

    <div class="form-group">
        <label for="email">Correo Electrónico</label>
        <input type="email" id="email" name="email" value="{{ old('email') }}" required>
        <span class="error"></span>
        @error('email') <span class="error">{{ $message }}</span> @enderror
    </div>
    
    <div class="form-group">
        <label for="password">Contraseña</label>
        <input type="password" id="password" name="password" required>
        <span class="error"></span>
        @error('password') <span class="error">{{ $message }}</span> @enderror
    </div>

    <div class="form-group">
        <label for="password_confirmation">Confirmar Contraseña</label>
        <input type="password" id="password_confirmation" name="password_confirmation" required>
        <span class="error"></span>
    </div>

    <div class="form-group">
        <label for="document">Documento</label>
        <input type="text" id="document" name="document" value="{{ old('document') }}" required>
        <span class="error"></span>
        @error('document') <span class="error">{{ $message }}</span> @enderror
    </div>

    <div class="form-group">
        <label for="birth_date">Fecha de Nacimiento</label>
        <input type="date" id="birth_date" name="birth_date" value="{{ old('birth_date') }}" required>
        <span class="error"></span>
        @error('birth_date') <span class="error">{{ $message }}</span> @enderror
    </div>

    <div class="form-group">
        <label for="license_number">Número de Licencia</label>
        <input type="text" id="license_number" name="license_number" value="{{ old('license_number') }}" required>
        <span class="error"></span>
        @error('license_number') <span class="error">{{ $message }}</span> @enderror
    </div>

    <div class="form-group">
        <label for="phone">Teléfono</label>
        <input type="tel" id="phone" name="phone" value="{{ old('phone') }}" required>
        <span class="error"></span>
        @error('phone') <span class="error">{{ $message }}</span> @enderror
    </div>

    <button type="submit" class="button">Registrarse</button>
    <script>
    // Validaciones en tiempo real y feedback visual
    const form = document.getElementById('register-form');
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
        if (target.name === 'password_confirmation') {
            const pass = form.querySelector('[name="password"]').value;
            if (target.value !== pass) {
                showError(target, 'Las contraseñas no coinciden');
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
                if (input.name === 'password_confirmation') {
                    const pass = form.querySelector('[name="password"]').value;
                    if (input.value !== pass) {
                        showError(input, 'Las contraseñas no coinciden');
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
        btn.textContent = 'Registrando...';
    });
    </script>
</form>
@endsection