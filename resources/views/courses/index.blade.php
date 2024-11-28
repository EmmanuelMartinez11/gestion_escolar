@extends('layouts.app')

@section('title', 'Gestión de Cursos')

@section('content')
    <h1 class="mb-4">Listado de Cursos</h1>
    <a href="{{ route('courses.create') }}" class="btn btn-primary mb-3">Crear Curso</a>
    <a href="{{ route('courses.report') }}" class="btn btn-success mb-3">Generar Reporte</a>

    <form action="{{ route('courses.index') }}" method="GET" class="mb-3">
        <div class="row">
            <div class="col-md-10">
                <select name="subject_id" class="form-control">
                    <option value="">Filtrar por materia</option>
                    @foreach ($subjects as $subject)
                        <option value="{{ $subject->id }}" {{ request('subject_id') == $subject->id ? 'selected' : '' }}>{{ $subject->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-secondary w-100">Filtrar</button>
            </div>
        </div>
    </form>

    @if ($courses->count())
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Materia</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($courses as $course)
                    <tr>
                        <td>{{ $course->id }}</td>
                        <td>{{ $course->name }}</td>
                        <td>{{ $course->subject->name }}</td>
                        <td>
                            <a href="{{ route('courses.edit', $course) }}" class="btn btn-warning btn-sm">Editar</a>
                            <form action="{{ route('courses.destroy', $course) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro?')">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $courses->links() }} <!-- Aquí se agrega la paginación -->
    @else
        <p>No hay cursos registrados.</p>
    @endif

@endsection
