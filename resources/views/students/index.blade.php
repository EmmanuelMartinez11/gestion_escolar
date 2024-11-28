@extends('layouts.app')

@section('title', 'Listado de Estudiantes')

@section('content')
    <h1>Listado de Estudiantes</h1>
    <!-- Botón para abrir el modal de Crear Estudiante -->
    <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#createStudentModal">Crear Estudiante</button>

    <a href="{{ route('students.report') }}" class="btn btn-secondary mb-3">Generar Reporte (PDF)</a>

    <form action="{{ route('students.index') }}" method="GET" class="mb-3">
        <div class="row">
            <div class="col-md-6">
                <input type="text" name="name" class="form-control" placeholder="Buscar por nombre" value="{{ request('name') }}">
            </div>
            <div class="col-md-4">
                <select name="course_id" class="form-control">
                    <option value="">Filtrar por curso</option>
                    @foreach ($courses as $course)
                        <option value="{{ $course->id }}" {{ request('course_id') == $course->id ? 'selected' : '' }}>{{ $course->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-secondary w-100">Filtrar</button>
            </div>
        </div>
    </form>

    @if ($students->count())
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($students as $student)
                    <tr>
                        <td>{{ $student->id }}</td>
                        <td>{{ $student->name }}</td>
                        <td>{{ $student->email }}</td>
                        <td>
                            <!-- Botón Editar Estudiante que abre el modal -->
                            <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editStudentModal"
                                data-id="{{ $student->id }}"
                                data-name="{{ $student->name }}"
                                data-email="{{ $student->email }}"
                                data-courses="{{ $student->courses->pluck('id')->join(',') }}">
                                Editar
                            </button>
                            <!-- Formulario para Eliminar Estudiante -->
                            <form action="{{ route('students.destroy', $student) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro?')">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $students->links() }}
    @else
        <p>No hay estudiantes registrados.</p>
    @endif

    <!-- Modal para Crear Estudiante -->
    <div class="modal fade" id="createStudentModal" tabindex="-1" aria-labelledby="createStudentModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createStudentModalLabel">Crear Estudiante</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('students.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="name" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Correo Electrónico</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="course_ids" class="form-label">Cursos</label>
                            <select name="course_ids[]" class="form-control" multiple required>
                                @foreach ($courses as $course)
                                    <option value="{{ $course->id }}">{{ $course->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Crear Estudiante</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal para Editar Estudiante -->
    <div class="modal fade" id="editStudentModal" tabindex="-1" aria-labelledby="editStudentModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editStudentModalLabel">Editar Estudiante</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                    <form id="editStudentForm" action="" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="editName" class="form-label">Nombre</label>
                                <input type="text" class="form-control" id="editName" name="name" required>
                            </div>
                            <div class="mb-3">
                                <label for="editEmail" class="form-label">Correo Electrónico</label>
                                <input type="email" class="form-control" id="editEmail" name="email" required>
                            </div>
                            <div class="mb-3">
                                <label for="editCourse_ids" class="form-label">Cursos</label>
                                <select name="course_ids[]" class="form-control" multiple required>
                                    @foreach ($courses as $course)
                                        <option value="{{ $course->id }}">{{ $course->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary">Actualizar Estudiante</button>
                        </div>
                    </form>


            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script>
        // JavaScript para llenar los campos del formulario de edición al hacer clic en el botón de Editar
        const editButtons = document.querySelectorAll('[data-bs-target="#editStudentModal"]');

        editButtons.forEach(button => {
            button.addEventListener('click', function () {
                const studentId = this.getAttribute('data-id');
                const studentName = this.getAttribute('data-name');
                const studentEmail = this.getAttribute('data-email');
                console.log("Formulario de edición con action:", formAction); // Verificar la URL

                const studentCourses = this.getAttribute('data-courses').split(',');

                // Establecer la acción del formulario
                const formAction = `/students/${studentId}`;
                document.getElementById('editStudentForm').action = formAction;

                // Llenar los campos del formulario
                document.getElementById('editName').value = studentName;
                document.getElementById('editEmail').value = studentEmail;

                // Seleccionar los cursos que tiene el estudiante
                const courseSelect = document.querySelector('#editStudentForm select');
                for (let option of courseSelect.options) {
                    option.selected = studentCourses.includes(option.value);
                }
            });
        });
    </script>
@endsection
