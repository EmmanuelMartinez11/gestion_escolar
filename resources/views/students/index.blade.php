@extends('layouts.app')

@section('title', 'Listado de Estudiantes')

@section('content')
    <h1>Listado de Estudiantes</h1>
    <a href="{{ route('students.create') }}" class="btn btn-primary mb-3">Crear Estudiante</a>
    <a href="{{ route('students.report') }}" class="btn btn-secondary mb-3">Generar Reporte (PDF)</a>

    <form action="{{ route('students.index') }}" method="GET" class="mb-3">
        <div class="row">
            <div class="col-md-6">
                <input type="text" name="name" class="form-control" placeholder="Buscar por nombre" value="{{ request('name') }}">
            </div>
            <div class="col-md-4">
                <select name="course_id" class="form-control">
                    <option value="">Filtrar por curso</option>
                    @foreach ($courses as $course)
                        <option value="{{ $course->id }}" {{ request('course_id') == $course->id ? 'selected' : '' }}>{{ $course->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-secondary w-100">Filtrar</button>
            </div>
        </div>
    </form>

    @if ($students->count())
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($students as $student)
                    <tr>
                        <td>{{ $student->id }}</td>
                        <td>{{ $student->name }}</td>
                        <td>{{ $student->email }}</td>
                        <td>
                            <a href="{{ route('students.edit', $student) }}" class="btn btn-warning btn-sm">Editar</a>
                            <form action="{{ route('students.destroy', $student) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro?')">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="d-flex justify-content-center">
            {{ $students->links('pagination::bootstrap-4') }}
        </div>
    @else
        <p>No hay estudiantes registrados.</p>
    @endif
@endsection
