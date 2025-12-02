@extends('layouts.app')
@section('content')
<div class="container">
    <h1>Agregar camionero</h1>
    <form action="{{ route('truckers.store') }}" method="POST" id="trucker-create-form">
        @csrf
        <div class="mb-3">
            <label for="first_name" class="form-label">Nombre</label>
            <input type="text" name="first_name" class="form-control" required value="{{ old('first_name') }}">
            <span class="error" style="color:red;font-size:0.8rem;"></span>
        </div>
        <div class="mb-3">
            <label for="last_name" class="form-label">Apellido</label>
            <input type="text" name="last_name" class="form-control" required value="{{ old('last_name') }}">
            <span class="error" style="color:red;font-size:0.8rem;"></span>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" class="form-control" required value="{{ old('email') }}">
            <span class="error" style="color:red;font-size:0.8rem;"></span>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Contraseña</label>
            <input type="password" name="password" class="form-control" required>
            <span class="error" style="color:red;font-size:0.8rem;"></span>
        </div>
        <div class="mb-3">
            <label for="password_confirmation" class="form-label">Confirmar contraseña</label>
            <input type="password" name="password_confirmation" class="form-control" required>
            <span class="error" style="color:red;font-size:0.8rem;"></span>
        </div>
        <div class="mb-3">
            <label for="document" class="form-label">Documento</label>
            <input type="text" name="document" class="form-control" required value="{{ old('document') }}">
            <span class="error" style="color:red;font-size:0.8rem;"></span>
        </div>
        <div class="mb-3">
            <label for="birth_date" class="form-label">Fecha de nacimiento</label>
            <input type="date" name="birth_date" class="form-control" required value="{{ old('birth_date') }}">
            <span class="error" style="color:red;font-size:0.8rem;"></span>
        </div>
        <div class="mb-3">
            <label for="license_number" class="form-label">Número de licencia</label>
            <input type="text" name="license_number" class="form-control" required value="{{ old('license_number') }}">
            <span class="error" style="color:red;font-size:0.8rem;"></span>
        </div>
        <div class="mb-3">
            <label for="phone" class="form-label">Teléfono</label>
            <input type="text" name="phone" class="form-control" required value="{{ old('phone') }}">
            <span class="error" style="color:red;font-size:0.8rem;"></span>
        </div>
        <button type="submit" class="btn btn-success">Guardar</button>
        <a href="{{ route('truckers.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
    <script>
    // Validaciones en tiempo real y feedback visual
    const form = document.getElementById('trucker-create-form');
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
        btn.textContent = 'Guardando...';
    });
    </script>
    </form>
</div>
@endsection
