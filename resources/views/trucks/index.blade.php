@extends('layouts.app')
@section('content')
    <nav style="margin-bottom:2rem; background:#f8f9fa; padding:1rem; border-radius:8px; display:flex; gap:1rem;">
        <a href="{{ route('dashboard') }}" class="btn btn-secondary">Dashboard</a>
        <a href="{{ route('truckers.index') }}" class="btn btn-info">Camioneros</a>
        <a href="{{ route('trucks.index') }}" class="btn btn-info">Camiones</a>
        <a href="{{ route('packages.index') }}" class="btn btn-success">Paquetes</a>
    </nav>
<div class="container">
    <h1>Camiones</h1>
   
        <form method="GET" action="{{ route('trucks.index') }}" class="mb-3" style="display:flex; gap:1rem; align-items:center;">
            <input type="text" name="plate" value="{{ $query ?? '' }}" placeholder="Buscar por placa" class="form-control" style="max-width:200px;">
            <button type="submit" class="btn btn-info">Filtrar</button>
            <a href="{{ route('trucks.index') }}" class="btn btn-secondary">Limpiar</a>
            <a href="{{ route('trucks.create') }}" class="btn btn-primary">Agregar camión</a>
        </form>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Placa</th>
                <th>Modelo</th>
                
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($trucks as $truck)
            <tr>
                <td>{{ $truck->plate }}</td>
                <td>{{ $truck->model }}</td>
                
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
