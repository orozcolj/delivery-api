@extends('layouts.app')

@section('content')
    <nav style="margin-bottom:2rem; background:#f8f9fa; padding:1rem; border-radius:8px; display:flex; gap:1rem;">
        <a href="{{ route('dashboard') }}" class="btn btn-secondary">Dashboard</a>
        <a href="{{ route('truckers.index') }}" class="btn btn-info">Camioneros</a>
        <a href="{{ route('trucks.index') }}" class="btn btn-info">Camiones</a>
        <a href="{{ route('packages.index') }}" class="btn btn-success">Paquetes</a>
    </nav>
    <h2>Gestión Global de Paquetes</h2>
    <form method="GET" action="{{ route('packages.index') }}" class="mb-3" style="display:flex; gap:1rem; align-items:center;">
        <input type="number" name="id" value="{{ $query ?? '' }}" placeholder="Buscar por ID" class="form-control" style="max-width:200px;">
        <button type="submit" class="btn btn-info">Filtrar</button>
        <a href="{{ route('packages.index') }}" class="btn btn-secondary">Limpiar</a>
        <a href="{{ route('packages.create') }}" class="btn btn-primary">Agregar Paquete</a>
    </form>

    <form method="POST" action="{{ route('packages.assign') }}" class="mb-3" style="display:flex; gap:1rem; align-items:center;">
        @csrf
        <select name="package_id" class="form-control" required style="max-width:200px;">
            <option value="">Selecciona paquete disponible</option>
            @foreach($packages as $package)
                @if(!$package->trucker)
                    <option value="{{ $package->id }}">Paquete #{{ $package->id }} - {{ $package->address }}</option>
                @endif
            @endforeach
        </select>
        <select name="trucker_id" class="form-control" required style="max-width:200px;">
            <option value="">Selecciona camionero</option>
            @foreach(\App\Models\Trucker::all() as $trucker)
                <option value="{{ $trucker->id }}">{{ $trucker->first_name }} {{ $trucker->last_name }} ({{ $trucker->document }})</option>
            @endforeach
        </select>
        <button type="submit" class="btn btn-success">Asignar Paquete</button>
    </form>
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
