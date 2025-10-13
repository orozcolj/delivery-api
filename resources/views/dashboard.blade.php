@extends('layouts.app')

@section('content')
    <h2>Mis Paquetes</h2>
    <a href="{{ route('packages.create') }}" class="button">Crear Nuevo Paquete</a>

    <table>
        <thead>
            <tr>
                <th>Dirección</th>
                <th>Estado</th>
                <th>Dimensiones</th>
                <th>Peso</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($packages as $package)
                <tr>
                    <td>{{ $package['address'] }}</td>
                    <td>{{ $package['status'] }}</td>
                    <td>{{ $package['details']['dimensions'] ?? 'N/A' }}</td>
                    <td>{{ $package['details']['weight'] ?? 'N/A' }}</td>
                    <td>
                        <a href="{{ route('packages.edit', $package['id']) }}">Editar</a> |
                        <form method="POST" action="{{ route('packages.destroy', $package['id']) }}" style="display:inline;" onsubmit="return confirm('¿Estás seguro de que quieres eliminar este paquete?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" style="background:none; border:none; color:crimson; cursor:pointer; padding:0; font-family:inherit; font-size:inherit;">
                                Eliminar
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">No tienes paquetes asignados.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection