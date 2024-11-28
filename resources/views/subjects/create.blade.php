@extends('layouts.app')

@section('title', 'Crear Materia')

@section('content')
    <h1 class="mb-4">Crear Materia</h1>

    <form action="{{ route('subjects.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Nombre</label>
            <input type="text" id="name" name="name" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Guardar</button>
    </form>
@endsection
