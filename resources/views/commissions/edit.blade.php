@extends('layouts.app')

@section('title', 'Editar Comisión')

@section('content')
    <h1>Editar Comisión</h1>
    <form action="{{ route('commissions.update', $commission) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="aula" class="form-label">Aula</label>
            <input type="text" class="form-control" id="aula" name="aula" value="{{ old('aula', $commission->aula) }}" required>
        </div>
        <div class="mb-3">
            <label for="horario" class="form-label">Horario</label>
            <input type="text" class="form-control" id="horario" name="horario" value="{{ old('horario', $commission->horario) }}" required>
        </div>
        <div class="mb-3">
            <label for="course_id" class="form-label">Curso</label>
            <select name="course_id" class="form-control" required>
                <option value="">Seleccionar Curso</option>
                @foreach ($courses as $course)
                    <option value="{{ $course->id }}" {{ $commission->course_id == $course->id ? 'selected' : '' }}>{{ $course->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="professor_id" class="form-label">Profesor</label>
            <select name="professor_id" class="form-control">
                <option value="">Seleccionar Profesor (Opcional)</option>
                @foreach ($professors as $professor)
                    <option value="{{ $professor->id }}" {{ $commission->professor_id == $professor->id ? 'selected' : '' }}>{{ $professor->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Actualizar Comisión</button>
    </form>
@endsection
