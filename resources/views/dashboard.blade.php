<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Dashboard</h1>
        <div class="row mt-4">
            <div class="col-md-4">
                <a href="{{ route('students.index') }}" class="btn btn-primary w-100">Gestión de Estudiantes</a>
            </div>
            <div class="col-md-4">
                <a href="{{ route('subjects.index') }}" class="btn btn-secondary w-100">Gestión de Materias</a>
            </div>
            <div class="col-md-4">
                <a href="{{ route('courses.index') }}" class="btn btn-success w-100">Gestión de Cursos</a>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-4">
                <a href="{{ route('commissions.index') }}" class="btn btn-warning w-100">Gestión de Comisiones</a>
            </div>
            <div class="col-md-4">
                <a href="{{ route('professors.index') }}" class="btn btn-info w-100">Gestión de Profesores</a>
            </div>
            <div class="col-md-4">
                <a href="{{ route('course_students.index') }}" class="btn btn-dark w-100">Gestión de Inscripciones</a>
            </div>
        </div>
    </div>
</body>
</html>
