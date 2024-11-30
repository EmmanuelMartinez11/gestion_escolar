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
            <label for="subject_id">Materia</label>
            <select name="subject_id" id="subject_id" class="form-control" required>
                <option value="">Seleccionar Materia</option>
                @foreach ($subjects as $subject)
                    <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group mt-3">
            <label for="course_id">Curso</label>
            <select name="course_id" id="course_id" class="form-control" required disabled>
                <option value="">Seleccionar Curso</option>
            </select>
        </div>

        <div class="form-group mt-3">
            <label for="commission_id">Comisión</label>
            <select name="commission_id" id="commission_id" class="form-control" required disabled>
                <option value="">Seleccionar Comisión</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Inscribir</button>
    </form>

    <script>
        // Cuando se selecciona una materia, se cargan los cursos asociados
        document.getElementById('subject_id').addEventListener('change', function() {
            let subjectId = this.value;
            let courseSelect = document.getElementById('course_id');
            let commissionSelect = document.getElementById('commission_id');

            // Resetear los cursos y comisiones
            courseSelect.innerHTML = '<option value="">Seleccionar Curso</option>';
            commissionSelect.innerHTML = '<option value="">Seleccionar Comisión</option>';
            commissionSelect.disabled = true;

            if (subjectId) {
                // Realizar una solicitud AJAX para obtener los cursos de esta materia
                fetch(`/courses/subject/${subjectId}`)
                    .then(response => response.json())
                    .then(data => {
                        courseSelect.disabled = false;
                        data.courses.forEach(course => {
                            let option = document.createElement('option');
                            option.value = course.id;
                            option.textContent = course.name;
                            courseSelect.appendChild(option);
                        });
                    });
            } else {
                courseSelect.disabled = true;
            }
        });

        // Cuando se selecciona un curso, se cargan las comisiones
        document.getElementById('course_id').addEventListener('change', function() {
            let courseId = this.value;
            let commissionSelect = document.getElementById('commission_id');

            commissionSelect.innerHTML = '<option value="">Seleccionar Comisión</option>';
            commissionSelect.disabled = true;

            if (courseId) {
                // Realizar una solicitud AJAX para obtener las comisiones de este curso
                fetch(`/commissions/course/${courseId}`)
                    .then(response => response.json())
                    .then(data => {
                        commissionSelect.disabled = false;
                        data.commissions.forEach(commission => {
                            let option = document.createElement('option');
                            option.value = commission.id;
                            option.textContent = `${commission.id}:  ${commission.room}; (${commission.schedule})`;
                            commissionSelect.appendChild(option);
                        });
                    });
            }
        });
    </script>
@endsection
