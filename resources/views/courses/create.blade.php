@extends('layouts.app')

@section('title', 'Crear Curso')

@section('content')
    <h1>Crear Curso</h1>
    <form action="{{ route('courses.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="mb-3">
            <label for="subject_id" class="form-label">Materia</label>
            <select name="subject_id" class="form-control" required>
                <option value="">Seleccionar Materia</option>
                @foreach ($subjects as $subject)
                    <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Crear Curso</button>
    </form>
@endsection
