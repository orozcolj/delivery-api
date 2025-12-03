@extends('layouts.app')
@section('content')
    <nav style="margin-bottom:2rem; background:#f8f9fa; padding:1rem; border-radius:8px; display:flex; gap:1rem;">
        <a href="{{ route('dashboard') }}" class="btn btn-secondary">Dashboard</a>
        <a href="{{ route('truckers.index') }}" class="btn btn-info">Camioneros</a>
        <a href="{{ route('trucks.index') }}" class="btn btn-info">Camiones</a>
        <a href="{{ route('packages.index') }}" class="btn btn-success">Paquetes</a>
    </nav>
<div class="container">
    <h1>Camioneros</h1>
    
        <form method="GET" action="{{ route('truckers.index') }}" class="mb-3" style="display:flex; gap:1rem; align-items:center;">
            <input type="text" name="document" value="{{ $query ?? '' }}" placeholder="Buscar por documento" class="form-control" style="max-width:200px;">
            <button type="submit" class="btn btn-info">Filtrar</button>
            <a href="{{ route('truckers.index') }}" class="btn btn-secondary">Limpiar</a>
            <a href="{{ route('truckers.create') }}" class="btn btn-primary">Agregar camionero</a>
        </form>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Documento</th>
                <th>Fecha de nacimiento</th>
                <th>Licencia</th>
                <th>Teléfono</th>
                <th>Email</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($truckers as $trucker)
            <tr>
                <td>{{ $trucker->first_name }} {{ $trucker->last_name }}</td>
                <td>{{ $trucker->document }}</td>
                <td>{{ $trucker->birth_date }}</td>
                <td>{{ $trucker->license_number }}</td>
                <td>{{ $trucker->phone }}</td>
                <td>{{ $trucker->user->email ?? '' }}</td>
                <td>
                    <a href="{{ route('truckers.edit', $trucker->id) }}" class="btn btn-sm btn-warning">Editar</a>
                    <form action="{{ route('truckers.destroy', $trucker->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Seguro que deseas eliminar este camionero?')">Eliminar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
