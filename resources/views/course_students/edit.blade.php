@extends('layouts.app')

@section('title', 'Editar Inscripción')

@section('content')
    <h1 class="mb-4">Editar Inscripción</h1>

    <form action="{{ route('course_students.update', $courseStudent) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label>Estudiante</label>
            <input type="text" class="form-control" value="{{ $student->name }}" readonly>
        </div>

        <div class="form-group mt-3">
            <label>Materia</label>
            <input type="text" class="form-control" value="{{ $subject->name }}" readonly>
        </div>

        <div class="form-group mt-3">
            <label for="commission_id">Comisión</label>
            <select name="commission_id" id="commission_id" class="form-control" required>
                @foreach ($commissions as $commission)
                    <option value="{{ $commission->id }}" {{ $courseStudent->commission_id == $commission->id ? 'selected' : '' }}>
                        {{ $commission->id }}: ({{ $commission->room }};  {{   $commission->schedule }})
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Actualizar Inscripción</button>
    </form>
@endsection
