@extends('layouts.app')

@section('title', 'Editar Inscripción')

@section('content')
    <h1 class="mb-4">Editar Inscripción</h1>

    <form action="{{ route('course_students.update', $courseStudent) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="student_id">Estudiante</label>
            <select name="student_id" id="student_id" class="form-control" required>
                @foreach ($students as $student)
                    <option value="{{ $student->id }}" {{ $courseStudent->student_id == $student->id ? 'selected' : '' }}>{{ $student->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group mt-3">
            <label for="course_id">Curso</label>
            <select name="course_id" id="course_id" class="form-control" required>
                @foreach ($courses as $course)
                    <option value="{{ $course->id }}" {{ $courseStudent->course_id == $course->id ? 'selected' : '' }}>{{ $course->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group mt-3">
            <label for="commission_id">Comisión</label>
            <select name="commission_id" id="commission_id" class="form-control" required>
                @foreach ($commissions as $commission)
                    <option value="{{ $commission->id }}" {{ $courseStudent->commission_id == $commission->id ? 'selected' : '' }}>{{ $commission->aula }} ({{ $commission->horario }})</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Actualizar Inscripción</button>
    </form>
@endsection
