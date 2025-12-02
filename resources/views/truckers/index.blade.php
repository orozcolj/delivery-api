@extends('layouts.app')
@section('content')
<div class="container">
    <h1>Camioneros</h1>
    <a href="{{ route('truckers.create') }}" class="btn btn-primary mb-3">Agregar camionero</a>
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
