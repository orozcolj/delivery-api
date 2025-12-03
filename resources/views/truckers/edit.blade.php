@extends('layouts.app')
@section('content')
<div class="container">
    <h1>Editar camionero</h1>
    <form action="{{ route('truckers.update', $trucker->id) }}" method="POST" id="trucker-edit-form">
        @csrf
        @method('PUT')
        <div class="mb-3">
                    <div class="mb-3">
                        <label for="truck_id" class="form-label">Camión asignado</label>
                        <select name="truck_id" class="form-control" required>
                            <option value="">Selecciona un camión</option>
                            @foreach($trucks as $truck)
                                <option value="{{ $truck->id }}" @if(isset($currentTruckId) && $truck->id == $currentTruckId) selected @endif>{{ $truck->plate }} - {{ $truck->model }}</option>
                            @endforeach
                        </select>
                    </div>
            <label for="first_name" class="form-label">Nombre</label>
            <input type="text" name="first_name" class="form-control" required value="{{ old('first_name', $trucker->first_name) }}">
            <span class="error" style="color:red;font-size:0.8rem;"></span>
        </div>
        <div class="mb-3">
            <label for="last_name" class="form-label">Apellido</label>
            <input type="text" name="last_name" class="form-control" required value="{{ old('last_name', $trucker->last_name) }}">
            <span class="error" style="color:red;font-size:0.8rem;"></span>
        </div>
        <div class="mb-3">
            <label for="document" class="form-label">Documento</label>
            <input type="text" name="document" class="form-control" required value="{{ old('document', $trucker->document) }}">
            <span class="error" style="color:red;font-size:0.8rem;"></span>
        </div>
        <div class="mb-3">
            <label for="birth_date" class="form-label">Fecha de nacimiento</label>
            <input type="date" name="birth_date" class="form-control" required value="{{ old('birth_date', $trucker->birth_date) }}">
            <span class="error" style="color:red;font-size:0.8rem;"></span>
        </div>
        <div class="mb-3">
            <label for="license_number" class="form-label">Número de licencia</label>
            <input type="text" name="license_number" class="form-control" required value="{{ old('license_number', $trucker->license_number) }}">
            <span class="error" style="color:red;font-size:0.8rem;"></span>
        </div>
        <div class="mb-3">
            <label for="phone" class="form-label">Teléfono</label>
            <input type="text" name="phone" class="form-control" required value="{{ old('phone', $trucker->phone) }}">
            <span class="error" style="color:red;font-size:0.8rem;"></span>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Nueva contraseña (opcional)</label>
            <input type="password" name="password" class="form-control">
            <span class="error" style="color:red;font-size:0.8rem;"></span>
        </div>
        <button type="submit" class="btn btn-success">Actualizar</button>
        <a href="{{ route('truckers.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
    <script>
    // Validaciones en tiempo real y feedback visual
    const form = document.getElementById('trucker-edit-form');
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
        if (target.name === 'password' && target.value.length > 0 && target.value.length < 8) {
            showError(target, 'La contraseña debe tener al menos 8 caracteres');
        } else if (target.name === 'password') {
            clearError(target);
        }
    });
    form.addEventListener('submit', function(e) {
        let valid = true;
        Array.from(form.elements).forEach(input => {
            if (input.tagName === 'INPUT' && input.type !== 'submit') {
                if (input.value.trim() === '' && input.name !== 'password') {
                    showError(input, 'Este campo es obligatorio');
                    valid = false;
                }
                if (input.name === 'password' && input.value.length > 0 && input.value.length < 8) {
                    showError(input, 'La contraseña debe tener al menos 8 caracteres');
                    valid = false;
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
        btn.textContent = 'Actualizando...';
    });
    </script>
    </form>
</div>
@endsection
