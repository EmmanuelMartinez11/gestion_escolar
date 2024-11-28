@extends('layouts.app')

@section('title', 'Gestión de Comisiones')

@section('content')
    <h1 class="mb-4">Listado de Comisiones</h1>
    <a href="{{ route('commissions.create') }}" class="btn btn-primary mb-3">Crear Comisión</a>
    <a href="{{ route('commissions.report') }}" class="btn btn-success mb-3">Generar Reporte</a>

    <form action="{{ route('commissions.index') }}" method="GET" class="mb-3">
        <div class="row">
            <div class="col-md-5">
                <select name="course_id" class="form-control">
                    <option value="">Filtrar por curso</option>
                    @foreach ($courses as $course)
                        <option value="{{ $course->id }}" {{ request('course_id') == $course->id ? 'selected' : '' }}>{{ $course->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-5">
                <input type="text" name="schedule" class="form-control" placeholder="Buscar por horario (ejemplo: 08:00-10:00)" value="{{ request('schedule') }}">
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-secondary w-100">Filtrar</button>
            </div>
        </div>
    </form>

    @if ($commissions->count())
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Aula</th>
                    <th>Horario</th>
                    <th>Curso</th>
                    <th>Profesor</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($commissions as $commission)
                    <tr>
                        <td>{{ $commission->id }}</td>
                        <td>{{ $commission->room }}</td>
                        <td>{{ $commission->schedule }}</td>
                        <td>{{ $commission->course->name }}</td>
                        <td>{{ $commission->professor ? $commission->professor->name : 'Sin asignar' }}</td>
                        <td>
                            <a href="{{ route('commissions.edit', $commission) }}" class="btn btn-warning btn-sm">Editar</a>
                            <form action="{{ route('commissions.destroy', $commission) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro?')">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $commissions->links() }} <!-- Aquí se agrega la paginación -->
    @else
        <p>No hay comisiones registradas.</p>
    @endif

@endsection
