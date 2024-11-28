<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Reporte de Asistencia de Profesores</title>
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
    <h1>Reporte de Asistencia de Profesores</h1>
    <table>
        <thead>
            <tr>
                <th>Profesor</th>
                <th>Comisión</th>
                <th>Curso</th>
                <th>Materia</th>
                <th>Aula</th>
                <th>Horario</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($professors as $professor)
                @foreach ($professor->commissions as $commission)
                    <tr>
                        <td>{{ $professor->name }}</td>
                        <td>{{ $commission->id }}</td>
                        <td>{{ $commission->course->name }}</td>
                        <td>{{ $commission->course->subject->name }}</td>
                        <td>{{ $commission->room }}</td>
                        <td>{{ $commission->schedule }}</td>
                    </tr>
                @endforeach
            @endforeach
        </tbody>
    </table>
</body>
</html>
