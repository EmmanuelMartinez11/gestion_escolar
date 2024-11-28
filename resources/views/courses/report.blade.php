<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Reporte de Cursos por Materia</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        table, th, td { border: 1px solid black; }
        th, td { padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        h1, h2 { text-align: center; }
    </style>
</head>
<body>
    <h1>Reporte de Cursos por Materia</h1>
    @foreach ($courses as $subjectName => $coursesGroup)
        <h2>Materia: {{ $subjectName }}</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre del Curso</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($coursesGroup as $course)
                    <tr>
                        <td>{{ $course->id }}</td>
                        <td>{{ $course->name }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endforeach
</body>
</html>
