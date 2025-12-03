@extends('layouts.app')

@section('content')
    <nav style="margin-bottom:2rem; background:#f8f9fa; padding:1rem; border-radius:8px; display:flex; gap:1rem;">
        <a href="{{ route('dashboard') }}" class="btn btn-secondary">Dashboard</a>
        <a href="{{ route('truckers.index') }}" class="btn btn-info">Camioneros</a>
        <a href="{{ route('trucks.index') }}" class="btn btn-info">Camiones</a>
        <a href="{{ route('packages.index') }}" class="btn btn-success">Paquetes</a>
    </nav>
    <h2>Gestión Global de Paquetes</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Dirección</th>
                <th>Camionero</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($packages as $package)
                <tr>
                    <td>{{ $package->id }}</td>
                    <td>{{ $package->address }}</td>
                    <td>{{ $package->trucker->first_name }} {{ $package->trucker->last_name }}</td>
                    <td>{{ $package->packageStatus->status ?? 'N/A' }}</td>
                    <td>
                        <a href="{{ route('packages.edit', $package->id) }}">Editar</a> |
                        <form method="POST" action="{{ route('packages.destroy', $package->id) }}" style="display:inline;" onsubmit="return confirm('¿Eliminar paquete?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" style="background:none; border:none; color:crimson; cursor:pointer; padding:0; font-family:inherit; font-size:inherit;">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
