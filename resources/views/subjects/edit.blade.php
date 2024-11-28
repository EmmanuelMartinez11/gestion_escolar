@extends('layouts.app')

@section('title', 'Editar Materia')

@section('content')
    <h1 class="mb-4">Editar Materia</h1>

    <form action="{{ route('subjects.update', $subject) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Nombre</label>
            <input type="text" id="name" name="name" class="form-control" value="{{ $subject->name }}" required>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Actualizar</button>
    </form>
@endsection
