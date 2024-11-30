<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Reporte de Estudiantes Inscritos</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        table, th, td { border: 1px solid black; }
        th, td { padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        h1 { text-align: center; }
    </style>
</head>
<body>
    <h1>Reporte de Estudiantes Inscritos</h1>
    <table>
        <thead>
            <tr>
                <th>Estudiante</th>
                <th>Curso</th>
                <th>Comisión</th>
                <th>Aula</th>
                <th>Horario</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($students as $student)
                @if ($student->courses->isEmpty())
                    <tr>
                        <td>{{ $student->name }}</td>
                        <td colspan="4">Sin inscripción</td>
                    </tr>
                @else
                    @foreach ($student->courses as $course)
                        @if ($course->commissions->isEmpty())
                            <tr>
                                <td>{{ $student->name }}</td>
                                <td>{{ $course->name }}</td>
                                <td colspan="3">Sin comisión asignada</td>
                            </tr>
                        @else
                            @foreach ($course->commissions as $commission)
                                <tr>
                                    <td>{{ $student->name }}</td>
                                    <td>{{ $course->name }}</td>
                                    <td>{{ $commission->id }}</td>
                                    <td>{{ $commission->room }}</td>
                                    <td>{{ $commission->schedule }}</td>
                                </tr>
                            @endforeach
                        @endif
                    @endforeach
                @endif
            @endforeach
        </tbody>

    </table>
</body>
</html>
