@extends('layouts.app')

@section('title', 'Editar Profesor')

@section('content')
    <h1>Editar Profesor</h1>
    <form action="{{ route('professors.update', $professor) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="name" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $professor->name) }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Actualizar Profesor</button>
    </form>
@endsection
