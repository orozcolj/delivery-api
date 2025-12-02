@extends('layouts.app')

@section('content')
    @if(auth()->user()->role === 'admin')
        <div style="margin-bottom: 2rem;">
            <a href="{{ route('truckers.index') }}" class="btn btn-info" style="margin-right: 1rem;">Gestionar Camioneros</a>
            <a href="{{ route('trucks.index') }}" class="btn btn-info">Gestionar Camiones</a>
        </div>
    @endif
    <h2>Mis Paquetes</h2>
    <a href="{{ route('packages.create') }}" class="button">Crear Nuevo Paquete</a>

    <table>
        <thead>
            <tr>
                <th>Dirección</th>
                <th>Estado</th>
                <th>Tipo de Mercancía</th>
                <th>Dimensiones</th>
                <th>Peso</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($packages as $package)
                <tr>
                    <td data-label="Dirección">{{ $package->address }}</td>
                    <td data-label="Estado">{{ $package->packageStatus->status ?? 'N/A' }}</td>
                    <td data-label="Tipo de Mercancía">{{ $package->details->first() && $package->details->first()->merchandiseType ? $package->details->first()->merchandiseType->type : 'N/A' }}</td>
                    <td data-label="Dimensiones">{{ $package->details->first()->dimensions ?? 'N/A' }}</td>
                    <td data-label="Peso">{{ $package->details->first()->weight ?? 'N/A' }}</td>
                    <td data-label="Acciones">
                        <a href="{{ route('packages.edit', $package->id) }}">Editar</a> |
                        <form method="POST" action="{{ route('packages.destroy', $package->id) }}" style="display:inline;" onsubmit="return confirm('¿Estás seguro de que quieres eliminar este paquete?');">
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
                    <td colspan="6">No tienes paquetes asignados.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection