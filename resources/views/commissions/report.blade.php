<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Reporte de Comisiones y Horarios</title>
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
    <h1>Reporte de Comisiones y Horarios</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Aula</th>
                <th>Horario</th>
                <th>Curso</th>
                <th>Materia</th>
                <th>Profesor</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($commissions as $commission)
                <tr>
                    <td>{{ $commission->id }}</td>
                    <td>{{ $commission->room }}</td>
                    <td>{{ $commission->schedule }}</td>
                    <td>{{ $commission->course->name }}</td>
                    <td>{{ $commission->course->subject->name }}</td>
                    <td>{{ $commission->professor->name ?? 'Sin asignar' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
