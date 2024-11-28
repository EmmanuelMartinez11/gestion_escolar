@extends('layouts.app')

@section('title', 'Crear Comisión')

@section('content')
    <h1>Crear Comisión</h1>
    <form action="{{ route('commissions.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="aula" class="form-label">Aula</label>
            <input type="text" class="form-control" id="aula" name="aula" required>
        </div>
        <div class="mb-3">
            <label for="horario" class="form-label">Horario</label>
            <input type="text" class="form-control" id="horario" name="horario" required>
        </div>
        <div class="mb-3">
            <label for="course_id" class="form-label">Curso</label>
            <select name="course_id" class="form-control" required>
                <option value="">Seleccionar Curso</option>
                @foreach ($courses as $course)
                    <option value="{{ $course->id }}">{{ $course->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="professor_id" class="form-label">Profesor</label>
            <select name="professor_id" class="form-control">
                <option value="">Seleccionar Profesor (Opcional)</option>
                @foreach ($professors as $professor)
                    <option value="{{ $professor->id }}">{{ $professor->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Crear Comisión</button>
    </form>
@endsection
