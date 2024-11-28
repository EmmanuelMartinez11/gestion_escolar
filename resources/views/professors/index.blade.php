@extends('layouts.app')

@section('title', 'Listado de Profesores')

@section('content')
    <h1>Listado de Profesores</h1>
    <a href="{{ route('professors.create') }}" class="btn btn-primary mb-3">Crear Profesor</a>
    <a href="{{ route('professors.report') }}" class="btn btn-secondary mb-3">Generar Reporte (PDF)</a>

    <form action="{{ route('professors.index') }}" method="GET" class="mb-3">
        <div class="row">
            <div class="col-md-6">
                <input type="text" name="name" class="form-control" placeholder="Buscar por nombre" value="{{ request('name') }}">
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-secondary w-100">Buscar</button>
            </div>
        </div>
    </form>

    @if ($professors->count())
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($professors as $professor)
                    <tr>
                        <td>{{ $professor->id }}</td>
                        <td>{{ $professor->name }}</td>
                        <td>
                            <a href="{{ route('professors.edit', $professor) }}" class="btn btn-warning btn-sm">Editar</a>
                            <form action="{{ route('professors.destroy', $professor) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro?')">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $professors->links() }}
    @else
        <p>No hay profesores registrados.</p>
    @endif
@endsection
