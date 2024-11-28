@extends('layouts.app')

@section('title', 'Gestión de Materias')

@section('content')
    <h1 class="mb-4">Listado de Materias</h1>
    <a href="{{ route('subjects.create') }}" class="btn btn-primary mb-3">Crear Materia</a>

    <form action="{{ route('subjects.index') }}" method="GET" class="mb-3">
        <div class="row">
            <div class="col-md-6">
                <input type="text" name="name" class="form-control" placeholder="Buscar por nombre" value="{{ request('name') }}">
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-secondary w-100">Buscar</button>
            </div>
        </div>
    </form>

    @if ($subjects->count())
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($subjects as $subject)
                    <tr>
                        <td>{{ $subject->id }}</td>
                        <td>{{ $subject->name }}</td>
                        <td>
                            <a href="{{ route('subjects.edit', $subject) }}" class="btn btn-warning btn-sm">Editar</a>
                            <form action="{{ route('subjects.destroy', $subject) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro?')">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{ $subjects->links() }}
    @else
        <p>No hay materias registradas.</p>
    @endif
@endsection
