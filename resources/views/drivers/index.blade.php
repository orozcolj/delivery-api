@extends('layouts.app')
@section('content')
<div class="container">
    <h1>Conductores</h1>
    <a href="{{ route('drivers.create') }}" class="btn btn-primary mb-3">Agregar conductor</a>
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
            @foreach($drivers as $driver)
            <tr>
                <td>{{ $driver->first_name }} {{ $driver->last_name }}</td>
                <td>{{ $driver->document }}</td>
                <td>{{ $driver->birth_date }}</td>
                <td>{{ $driver->license_number }}</td>
                <td>{{ $driver->phone }}</td>
                <td>{{ $driver->user->email ?? '' }}</td>
                <td>
                    <a href="{{ route('drivers.edit', $driver->id) }}" class="btn btn-sm btn-warning">Editar</a>
                    <form action="{{ route('drivers.destroy', $driver->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Seguro que deseas eliminar este conductor?')">Eliminar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
