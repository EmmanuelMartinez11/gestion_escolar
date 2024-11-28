@extends('layouts.app')

@section('title', 'Crear Profesor')

@section('content')
    <h1>Crear Profesor</h1>
    <form action="{{ route('professors.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <button type="submit" class="btn btn-primary">Crear Profesor</button>
    </form>
@endsection
