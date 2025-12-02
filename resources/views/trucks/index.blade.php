@extends('layouts.app')
@section('content')
<div class="container">
    <h1>Camiones</h1>
    <a href="{{ route('trucks.create') }}" class="btn btn-primary mb-3">Agregar camión</a>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Placa</th>
                <th>Modelo</th>
                <th>Capacidad</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($trucks as $truck)
            <tr>
                <td>{{ $truck->plate }}</td>
                <td>{{ $truck->model }}</td>
                <td>{{ $truck->capacity }}</td>
                <td>
                    <a href="{{ route('trucks.edit', $truck->id) }}" class="btn btn-sm btn-warning">Editar</a>
                    <form action="{{ route('trucks.destroy', $truck->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Seguro que deseas eliminar este camión?')">Eliminar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
