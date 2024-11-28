@extends('layouts.app')

@section('title', 'Editar Curso')

@section('content')
    <h1>Editar Curso</h1>
    <form action="{{ route('courses.update', $course) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="name" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $course->name) }}" required>
        </div>
        <div class="mb-3">
            <label for="subject_id" class="form-label">Materia</label>
            <select name="subject_id" class="form-control" required>
                <option value="">Seleccionar Materia</option>
                @foreach ($subjects as $subject)
                    <option value="{{ $subject->id }}" {{ $course->subject_id == $subject->id ? 'selected' : '' }}>{{ $subject->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Actualizar Curso</button>
    </form>
@endsection
