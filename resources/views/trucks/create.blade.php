@extends('layouts.app')
@section('content')
<div class="container">
    <h1>Agregar camión</h1>
    <form action="{{ route('trucks.store') }}" method="POST" id="truck-create-form">
        @csrf
        <div class="mb-3">
            <label for="plate" class="form-label">Placa</label>
            <input type="text" name="plate" class="form-control" required value="{{ old('plate') }}">
            <span class="error" style="color:red;font-size:0.8rem;"></span>
        </div>
        <div class="mb-3">
            <label for="model" class="form-label">Modelo</label>
            <input type="text" name="model" class="form-control" required value="{{ old('model') }}">
            <span class="error" style="color:red;font-size:0.8rem;"></span>
        </div>
        <div class="mb-3">
            
            <span class="error" style="color:red;font-size:0.8rem;"></span>
        </div>
        <button type="submit" class="btn btn-success">Guardar</button>
        <a href="{{ route('trucks.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
    <script>
    // Validaciones en tiempo real y feedback visual
    const form = document.getElementById('truck-create-form');
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
        
            clearError(target);
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
        btn.textContent = 'Guardando...';
    });
    </script>
    </form>
</div>
@endsection
