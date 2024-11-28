@extends('layouts.app')

@section('title', 'Gestión de Inscripciones')

@section('content')
    <h1 class="mb-4">Listado de Inscripciones</h1>
    <a href="{{ route('course_students.create') }}" class="btn btn-primary mb-3">Crear Inscripción</a>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Estudiante</th>
                <th>Curso</th>
                <th>Comisión</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($enrollments as $enrollment)
                <tr>
                    <td>{{ $enrollment->id }}</td>
                    <td>{{ $enrollment->student->name }}</td>
                    <td>{{ $enrollment->course->name }}</td>
                    <td>{{ $enrollment->commission->room }} ({{ $enrollment->commission->schedule }})</td>
                    <td>
                        <a href="{{ route('course_students.edit', $enrollment) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form action="{{ route('course_students.destroy', $enrollment) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $enrollments->links() }}
@endsection
