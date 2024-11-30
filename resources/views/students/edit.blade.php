@extends('layouts.app')

@section('title', 'Editar Estudiante')

@section('content')
    <h1>Editar Estudiante</h1>

    <form action="{{ route('students.update', $student) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $student->name) }}" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Correo Electrónico</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $student->email) }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Actualizar Estudiante</button>
    </form>
@endsection
