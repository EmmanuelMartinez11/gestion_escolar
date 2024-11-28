@extends('layouts.app')

@section('title', 'Crear Inscripción')

@section('content')
    <h1 class="mb-4">Crear Inscripción</h1>

    <form action="{{ route('course_students.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="student_id">Estudiante</label>
            <select name="student_id" id="student_id" class="form-control" required>
                <option value="">Seleccionar Estudiante</option>
                @foreach ($students as $student)
                    <option value="{{ $student->id }}">{{ $student->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group mt-3">
            <label for="course_id">Curso</label>
            <select name="course_id" id="course_id" class="form-control" required>
                <option value="">Seleccionar Curso</option>
                @foreach ($courses as $course)
                    <option value="{{ $course->id }}">{{ $course->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group mt-3">
            <label for="commission_id">Comisión</label>
            <select name="commission_id" id="commission_id" class="form-control" required>
                <option value="">Seleccionar Comisión</option>
                @foreach ($commissions as $commission)
                    <option value="{{ $commission->id }}">{{ $commission->room }} ({{ $commission->schedule }})</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Inscribir</button>
    </form>
@endsection
